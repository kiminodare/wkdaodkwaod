<?php
use phpformbuilder\Form;
use phpformbuilder\Validator\Validator;
use phpformbuilder\database\Mysql;
use common\Utils;
use secure\Secure;

include_once ADMIN_DIR . 'secure/class/secure/Secure.php';

/* =============================================
    validation if posted
============================================= */

if ($_SERVER["REQUEST_METHOD"] == "POST" && Form::testToken('form-edit-user') === true) {
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
        $_SESSION['errors']['form-edit-user'] = $validator->getAllErrors();
    } else {
        require_once CLASS_DIR . 'phpformbuilder/database/db-connect.php';
        require_once CLASS_DIR . 'phpformbuilder/database/Mysql.php';
        $db = new Mysql();
        $update['username'] = Mysql::SQLValue($_POST['username'], Mysql::SQLVALUE_TEXT);
        $update['password'] = Mysql::SQLValue($_POST['password'], Mysql::SQLVALUE_TEXT);
        $update['credit'] = Mysql::SQLValue($_POST['credit'], Mysql::SQLVALUE_NUMBER);
        $filter["id"] = Mysql::SQLValue($_SESSION['user_editable_primary_key'], Mysql::SQLVALUE_NUMBER);
        $db->throwExceptions = true;
        try {
            // begin transaction
            $db->transactionBegin();

            // update user
            if (DEMO !== true && !$db->updateRows('user', $update, $filter)) {
                $error = $db->error();
                $db->transactionRollback();
                throw new \Exception($error);
            } else {
                if (!isset($error)) {
                    // ALL OK
                    $db->transactionEnd();
                    $_SESSION['msg'] = Utils::alert(UPDATE_SUCCESS_MESSAGE, 'alert-success has-icon');

                    // reset form values
                    Form::clear('form-edit-user');

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
$id = $pk;

// register editable primary key, which is NOT posted and will be the query update filter
$_SESSION['user_editable_primary_key'] = $id;

if (!isset($_SESSION['errors']['form-edit-user']) || empty($_SESSION['errors']['form-edit-user'])) { // If no error registered
    $qry = "SELECT * FROM `user`";

    $transition = 'WHERE';

    // if restricted rights
    if (ADMIN_LOCKED === true && Secure::canUpdateRestricted('user')) {
        $qry .= Secure::getRestrictionQuery('user');
        $transition = 'AND';
    }
    $qry .= ' ' . $transition . " user.id = '$id'";

    $db = new Mysql();

    // echo $qry . '<br>';

    $db->query($qry);
    if ($db->rowCount() < 1) {
        if (DEBUG === true) {
            exit($db->getLastSql() . ' : No Record Found');
        } else {
            Secure::logout();
        }
    }
    $row = $db->row();
    $_SESSION['form-edit-user']['id'] = $row->id;
    $_SESSION['form-edit-user']['username'] = $row->username;
    $_SESSION['form-edit-user']['password'] = $row->password;
    $_SESSION['form-edit-user']['credit'] = $row->credit;
}
$form = new Form('form-edit-user', 'horizontal', 'novalidate', 'bs4');
$form->setAction('/admin/admin/user/edit/' . $id);
$form->startFieldset();

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
