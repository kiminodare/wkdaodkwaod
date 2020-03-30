<?php

if (file_exists('conf/conf.php')) {
    include_once 'conf/conf.php';
} elseif (file_exists('../conf/conf.php')) {
    include_once '../conf/conf.php';
} elseif (file_exists('../../conf/conf.php')) {
    include_once '../../conf/conf.php';
} else {
    exit('Configuration file not found (10)');
}
if (file_exists('../../vendor/autoload.php')) {
    // if PHPCG is installed in a sub-directory
    require_once '../../vendor/autoload.php';
} else {
    require_once ROOT . 'vendor/autoload.php';
}

use \VisualAppeal\AutoUpdate;

$user_msg = '';

$update = new AutoUpdate(__DIR__ . '/temp', ROOT, 60);

// get current PHPCG version

if (!defined('VERSION')) {
    define('VERSION', '1.0');
}

$update->setCurrentVersion(VERSION);
$update->setUpdateUrl('https://www.phpcrudgenerator.com/server-update');
// Optional:
$update->addLogHandler(new Monolog\Handler\StreamHandler(__DIR__ . '/update.log'));
$update->setCache(new Desarrolla2\Cache\Adapter\File(__DIR__ . '/cache'), 3600);

//Check for a new update
if ($update->checkUpdate() === false) {
    $user_msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Could not check for updates! See log file at generator/update/update.log for details.</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>';
} else {
    if ($update->newVersionAvailable()) {
        if (!isset($_POST['update'])) {
            /* =============================================
                Display the update button
            ============================================= */

            $user_msg = '<div class="alert bg-success-100 text-center alert-dismissible fade show" role="alert">';
            $user_msg .= '<p class="text-green-700 mb-4"><strong>PHP CRUD GENERATOR version ' . $update->getLatestVersion() . ' is available</strong></p>';
            $user_msg .= '<button type="button" name="update" id="update-btn" class="btn btn-outline-success mx-auto mb-4">Install<i class="fas fa-check position-right"></i></button>';
            $user_msg .= '<p class="text-gray-700 mb-0">Just click &amp; relax, the updater is safe, it won\'t break anything</p>';
            $user_msg .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            $user_msg .= '    <span aria-hidden="true">&times;</span>';
            $user_msg .= '</button>';
            $user_msg .= '</div>';
            $user_msg .= '<script>';
            $user_msg .= '    var head= document.getElementsByTagName("head")[0];';
            $user_msg .= '    var newScript= document.createElement("script");';
            $user_msg .= '    newScript.type= "text/javascript";';
            $user_msg .= '    var scriptContent = document.createTextNode(\'var body = document.getElementsByTagName("body")[0];';
            $user_msg .= '      setTimeout(function() {';
            $user_msg .= '        var url = $(\\\'input[name="generator-url"]\\\').val();';
            $user_msg .= '        if ($("#update-btn")[0]) {';
            $user_msg .= '            $("#update-btn").on("click", function() {';
            $user_msg .= '                $.ajax({';
            $user_msg .= '                    url: url + "update/index.php",';
            $user_msg .= '                    type: "POST",';
            $user_msg .= '                    data: {';
            $user_msg .= '                        update: true';
            $user_msg .= '                    }';
            $user_msg .= '                })';
            $user_msg .= '                    .done(function(data) {';
            $user_msg .= '                        $("#remodal-content").html(data);';
            $user_msg .= '                        var inst = $($(\\\'div[data-remodal-id="modal"]\\\')).remodal();';
            $user_msg .= '                        inst.open();';
            $user_msg .= '                    })';
            $user_msg .= '                    .fail(function() {';
            $user_msg .= '                        console.log("error");';
            $user_msg .= '                    });';
            $user_msg .= '';
            $user_msg .= '                $(document)';
            $user_msg .= '                    .off("closed")';
            $user_msg .= '                    .on("closed", ".remodal", function(e) {';
            $user_msg .= '                        location.reload();';
            $user_msg .= '                    });';
            $user_msg .= '            });';
            $user_msg .= '        }';
            $user_msg .= '    }, 2000);\');';
            $user_msg .= '   newScript.appendChild(scriptContent);';
            $user_msg .= '   head.appendChild(newScript);';
            $user_msg .= '</script>';
        } else {
            /* =============================================
                Do update
            ============================================= */

            $simulate = false;

            echo '<div class="text-center">';

            $updated_versions = array_map(function ($version) {
                    return (string) $version;
            }, $update->getVersionsToUpdate());

            echo 'New Version: ' . $update->getLatestVersion() . '<br>';
            echo 'Installing Updates: <br>';
            // empty log file
            $f = @fopen(__DIR__ . '/update.log', 'r+');
            if ($f !== false) {
                ftruncate($f, 0);
                fclose($f);
            }
            if ($simulate === true) {
                echo '<pre>';
                var_dump(array_map(function ($version) {
                    return (string) $version;
                }, $update->getVersionsToUpdate()));
                echo '</pre>';

                // This call will only simulate an update.
                // Set the first argument (simulate) to "false" to install the update
                // i.e. $update->update(false);
                $result = $update->update();
            } else {
                //Install new update
                $result = $update->update(false);
            }

            if ($result === true) {
                if ($simulate === true) {
                    echo '<p class="text-success mb-3">Update simulation successful</p>';
                } else {
                    echo '<p class="text-success mb-3">Update successful</p><p>Open <a href="https://www.phpcrudgenerator.com/documentation/index#changelog">/documentation/index</a> to see the changelog.</p>';
                }
            } else {
                if ($simulate === true) {
                    echo '<p class="text-danger mb-3">Update simulation failed: ' . $result . '!</p>';
                } else {
                    echo '<p class="text-danger mb-3">Update failed: ' . $result . '!</p><p><a href="https://www.phpcrudgenerator.com/help-center#update-errors" target="_blank">Help me please!</a></p>';
                }

                if ($result == AutoUpdate::ERROR_SIMULATE) {
                    echo '<pre>';
                    var_dump($update->getSimulationResults());
                    echo '</pre>';
                }
            }

            if ($simulate === true) {
                echo 'Log:<br>';
                echo nl2br(file_get_contents(__DIR__ . '/update.log'));
                echo '<br>';
            }

            echo '<p>Close this frame to reload the page</p>';
            echo '<p>If you see some PHP warnings after reloading, clear your PHP SESSION (or just close and reopen your browser).</p>';
            echo '</div>';
        }
    } else {
        //  shouldn't occur, as there's no update button if version is up to date
        echo '<p class="text-right bg-indigo-600 text-indigo-200 px-4 py-1">Current Version is up to date</p>';
    }
}

if (!empty($user_msg)) {
    echo $user_msg;
}
