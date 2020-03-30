<?php
@ini_set('display_errors', 1);

/*==========================================================
=            Protection against unauthorized access            =
==========================================================*/

/*  TO AUTHORIZE ACCESS:
                -   REPLACE false WITH true LINE 15
                -   OPEN (OR REFRESH) THIS FILE IN YOUR BROWSER

    IMPORTANT:  WHEN YOU HAVE FINISHED REPLACE true WITH false on LINE 15 TO LOCK THE ACCESS.
                THIS FILE MUST NOT STAY UNLOCKED ON YOUR PRODUCTION SERVER;
*/
define('AUTHORIZE', false);

/*=====  End of Protection against unauthorized access  ======*/

if (AUTHORIZE === true) {
    $form_class_path = dirname(__FILE__);
    $plugins_path = $form_class_path . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR;

    // reliable document_root (https://gist.github.com/jpsirois/424055)
    $root_path = str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['SCRIPT_FILENAME']);

    // reliable document_root with symlinks resolved
    $info = new \SplFileInfo($root_path);

    // var_dump($info);
    $real_root_path = $info->getRealPath();

    // sanitize directory separator
    $form_class_path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $form_class_path);
    $real_root_path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $real_root_path);

    $plugins_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . ltrim(str_replace(array($real_root_path, DIRECTORY_SEPARATOR), array('', '/'), $plugins_path), '/');

    $current_dir = str_replace(basename(__FILE__), '', $_SERVER['SCRIPT_NAME']);
    $phpformbuilder_include_code = 'include_once rtrim($_SERVER[\'DOCUMENT_ROOT\'], DIRECTORY_SEPARATOR) . \'' . $current_dir . 'Form.php\';';
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Php Form Builder - Help file for include and other paths</title>
    <meta name="description" content="Php Form Builder - Help file for include and other paths">
    <meta name="author" content="Gilles Migliori">
    <meta name="copyright" content="Gilles Migliori">
    <meta name="robots" content="noindex">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <?php require_once '../documentation/inc/css-includes.php'; ?>
    <!-- adaptative-images -->
    <script>document.cookie='resolution='+Math.max(screen.width,screen.height)+("devicePixelRatio" in window ? ","+devicePixelRatio : ",1")+'; path=/';</script>
</head>
<body style="padding-top:76px;" data-spy="scroll" data-target="#navbar-left-wrapper" data-offset="180">
    <!-- Main navbar -->
    <nav id="website-navbar" class="navbar navbar-dark bg-dark navbar-expand-lg fixed-top">
        <div class="container-fluid px-0">
            <a class="navbar-brand mr-3" href="index.html"><img src="../documentation/assets/images/phpformbuilder-logo.png" width="60" height="60" class="mr-3" alt="PHP Form Builder" title="PHP Form Builder">PHP Form Builder</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">

                    <!-- https://www.phpformbuilder.pro navbar -->

                    <li class="nav-item" role="presentation"><a class="nav-link active" href="../index.html">Home</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="wordpress-cms-users.php">Wordpress &amp; CMS users</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="quick-start-guide.php">Quick Start Guide</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="../templates/index.php">Form Templates</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="jquery-plugins.php">jQuery Plugins</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="code-samples.php">Code Samples</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="class-doc.php">Class Doc.</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="functions-reference.php">Functions Reference</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="help-center.php">Help Center</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

        <?php include_once '../documentation/inc/top-section.php'; ?>

        <h1>Php Form Builder - Help file for include and other paths</h1>
        <?php if (AUTHORIZE === true) { ?>
        <section class="mb-6">
            <h2>PHP Version</h2>
            <p class="lead ml-5">Your PHP Version is <?php echo phpversion(); ?></p>
        </section>
        <section class="mb-6">
            <h2>Solve Error 500</h2>
            <p class="lead ml-5">The correct include statement to include <strong>Form.php</strong> is the following:</p>
            <pre class="ml-5 mb-5"><code class="language-php"><?php echo $phpformbuilder_include_code; ?></code></pre>
            <?php if ($phpformbuilder_include_code != 'include_once rtrim($_SERVER[\'DOCUMENT_ROOT\'], DIRECTORY_SEPARATOR) . \'/phpformbuilder/Form.php\';') { ?>
            <hr>
            <p class="ml-5 mb-5"><strong>You have to replace the following code:<br> <code class="language-php">include_once rtrim($_SERVER['DOCUMENT_ROOT'], DIRECTORY_SEPARATOR) . '/phpformbuilder/Form.php';</code><br>in your forms - the template files or your own forms php files - with the correct include statement shown above.</strong></p>
            <?php } else { ?>
                <p class="ml-5 mb-5"><strong>This is the default path used in all templates. You've got nothing to change.</strong></p>
            <?php } // end if ?>
            <p class="alert alert-danger has-icon ml-5">Don't forget to revert <strong class="var-value bg-red text-white">true</strong> to <strong class="var-value bg-red text-white">false</strong> Line 15 to protect this file against unauthorized access</p>
        </section>
        <section class="mb-6">
            <h3>The variables below provide some useful debugging information about your server configuration</h3>
            <dl class="dl-horizontal">
                <dt>$plugins_path</dt>
                <dd><code class="language-php"><?php echo $plugins_path; ?></code></dd>
                <dd class="line-break"></dd>
                <dt>$_SERVER['SCRIPT_NAME']</dt>
                <dd><code class="language-php"><?php echo $_SERVER['SCRIPT_NAME']; ?></code></dd>
                <dd class="line-break"></dd>
                <dt>$_SERVER['SCRIPT_FILENAME']</dt>
                <dd><code class="language-php"><?php echo $_SERVER['SCRIPT_FILENAME']; ?></code></dd>
                <dd class="line-break"></dd>
                <dt>$root_path</dt>
                <dd><code class="language-php"><?php echo $root_path; ?></code></dd>
                <dd class="line-break"></dd>
                <dt>$real_root_path</dt>
                <dd><code class="language-php"><?php echo $real_root_path; ?></code></dd>
                <dd class="line-break"></dd>
                <dt>$form_class_path</dt>
                <dd><code class="language-php"><?php echo $form_class_path; ?></code></dd>
                <dd class="line-break"></dd>
                <dt>$real_root_path</dt>
                <dd><code class="language-php"><?php echo $real_root_path; ?></code></dd>
                <dd class="line-break"></dd>
                <dt>$plugins_url</dt>
                <dd><code class="language-php"><?php echo $plugins_url; ?></code></dd>
                <dd class="line-break"></dd>
            </dl>
        </section>
        <?php } else { ?>
        <p class="alert alert-warning has-icon">This file is protected against unauthorized access.</p>
        <p><strong>To allow access and display information, open this file in your code editor and replace <strong class="var-value">false</strong> with <strong class="var-value">true</strong> Line 15.</p>
        <?php } // end if ?>
    </div>
    <?php require_once '../documentation/inc/js-includes.php'; ?>
</body>
</html>
