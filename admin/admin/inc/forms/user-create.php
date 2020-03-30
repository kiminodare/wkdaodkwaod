<?php
use phpformbuilder\Form;
use phpformbuilder\Validator\Validator;
use phpformbuilder\database\Mysql;
use common\Utils;
use secure\Secure;

/* =============================================
    validation if posted
============================================= */

if ($_SERVER["REQUEST_METHOD"] == "POST" && Form::testToken('form-create-user') === true) {
    include_once CLASS_DIR . 'phpformbuilder/Validator/Validator.php';
    include_once CLASS_DIR . 'phpformbuilder/Validator/Exception.php';
    $validator = new Validator($_POST);
    $validator->required()->validate('username');
    $validator->maxLength(255)->validate('username');
    $validator->required()->validate('password');
    $validator->maxLength(255)->validate('password');
    $validator->required()->validate('credit');
    $validator->float()->validate('credit');
    $validator->integer()->validate('credit');
    $validator->min(-1.0E+255)->validate('credit');
    $validator->max(999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999)->validate('credit');

    // check for errors
    if ($validator->hasErrors()) {
        $_SESSION['errors']['form-create-user'] = $validator->getAllErrors();
    } else {
        require_once CLASS_DIR . 'phpformbuilder/database/db-connect.php';
        require_once CLASS_DIR . 'phpformbuilder/database/Mysql.php';
        $db = new Mysql();
        $insert['id'] = Mysql::SQLValue('');
        $insert['username'] = Mysql::SQLValue($_POST['username'], Mysql::SQLVALUE_TEXT);
        $insert['password'] = Mysql::SQLValue($_POST['password'], Mysql::SQLVALUE_TEXT);
        $insert['credit'] = Mysql::SQLValue($_POST['credit'], Mysql::SQLVALUE_NUMBER);
        $db->throwExceptions = true;
        try {
            // begin transaction
            $db->transactionBegin();

            // insert new user

            if (DEMO !== true && !$db->insertRow('user', $insert)) {
                $error = $db->error();
                $db->transactionRollback();
                throw new \Exception($error);
            } else {
                $user_last_insert_ID = $db->getLastInsertID();
                if (!isset($error)) {
                    // ALL OK - NO DB ERROR
                    $db->transactionEnd();
                    $_SESSION['msg'] = Utils::alert(INSERT_SUCCESS_MESSAGE, 'alert-success has-icon');

                    // reset form values
                    Form::clear('form-create-user');

                    // redirect to list page
                    if (isset($_SESSION['active_list_url'])) {
                        header('Location:' . $_SESSION['active_list_url']);
                    } else {
                        header('Location:https://wibu-checker.com/admin/admin/user');
                    }

                    // if we don't exit here, $_SESSION['msg'] will be unset
                    exit();
                }
            }
        } catch (\Exception $e) {
            $msg_content = DB_ERROR;
            if (ENVIRONMENT == 'development') {
                $msg_content .= '<br>' . $e->getMessage() . '<br>' . $db->getLastSql();
            }
            $_SESSION['msg'] = Utils::alert($msg_content, 'alert-danger has-icon');
        }
    } // END else
} // END if POST
$form = new Form('form-create-user', 'horizontal', 'novalidate', 'bs4');
$form->setAction('/admin/admin/user/create');
$form->startFieldset();

// id --
$form->setCols(2, 10);
$form->addInput('hidden', 'id', '');

// username --
$form->setCols(2, 10);
$form->addInput('text', 'username', '', 'Username', 'required');

// password --
$form->addInput('text', 'password', '', 'Password', 'required');

// credit --
$form->addInput('number', 'credit', '', 'Credit', 'required');
$form->addBtn('button', 'cancel', 0, '<i class="' . ICON_BACK . ' position-left"></i>' . CANCEL, 'class=btn btn-warning ladda-button legitRipple, onclick=history.go(-1)', 'btn-group');
$form->addBtn('submit', 'submit-btn', 1, SUBMIT . '<i class="' . ICON_CHECKMARK . ' position-right"></i>', 'class=btn btn-success ladda-button legitRipple', 'btn-group');
$form->setCols(0, 12);
$form->centerButtons(true);
$form->printBtnGroup('btn-group');
$form->endFieldset();
$form->addPlugin('nice-check', 'form', 'default', array('%skin%' => 'green'));
