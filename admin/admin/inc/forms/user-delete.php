<?php
use phpformbuilder\Form;
use phpformbuilder\Validator\Validator;
use phpformbuilder\database\Mysql;
use common\Utils;

// get referer pagination
$page_url_qry = '';
if (isset($_SESSION['user-page']) && is_numeric($_SESSION['user-page'])) {
    $page_url_qry = '/p' . $_SESSION['user-page'];
}

/* =============================================
    delete if posted
============================================= */

if ($_SERVER["REQUEST_METHOD"] == "POST" && Form::testToken('form-delete-user') === true) {
    if ($_POST['delete-user'] > 0) {
        $db = new Mysql();
        $db->throwExceptions = true;
        try {

            // begin transaction
            $db->transactionBegin();

            // Delete from target table
            $filter = array();
            $filter["id"] = Mysql::SQLValue($_POST['id']);
            if (DEMO === true || $db->deleteRows('user', $filter)) {

                // ALL OK
                $db->transactionEnd();
                $_SESSION['msg'] = Utils::alert(UPDATE_SUCCESS_MESSAGE, 'alert-success has-icon');
            } else {
                $error = $db->error();
                $db->transactionRollback();
                throw new \Exception($error);
            }
        } catch(\Exception $e) {
            $msg_content = DB_ERROR;
            if (ENVIRONMENT == 'development') {
                $msg_content .= '<br>' . $e->getMessage() . '<br>' . $db->getLastSql();
            }
            $_SESSION['msg'] = Utils::alert($msg_content, 'alert-danger has-icon');
        }
    }

    // reset form values
    Form::clear('form-delete-user');

    // redirect to list page
    if (isset($_SESSION['active_list_url'])) {
        header('Location:' . $_SESSION['active_list_url']);
    } else {
        header('Location:https://wibu-checker.com/admin/admin/user');
    }

    // if we don't exit here, $_SESSION['msg'] will be unset
    exit();

} // END if POST

$id = $pk;

// select name to display for confirmation
$qry = 'SELECT id FROM user WHERE id = "' . $id . '" LIMIT 1';
$db = new Mysql();
$db->query($qry);
$count = $db->rowCount();
if (!empty($count)) {
        $row = $db->row();
        $display_value = $row->id;
} else {

    // this should never happen
    // echo $db->getLastSql();
    exit('QRY ERROR');
}

$form = new Form('form-delete-user', 'vertical', 'novalidate', 'bs4');
$form->setAction('/admin/admin/user/delete/' . $id);
$form->startFieldset();
$form->addInput('hidden', 'id', $id);
$form->addHtml('<div class="text-center p-md">');
$form->addRadio('delete-user', YES, 1);
$form->addRadio('delete-user', NO, 0);
$form->printRadioGroup('delete-user', '<span class="mr-20">' . DELETE_CONST . ' "' . $display_value . '" ?</span>');
$form->addBtn('button', 'cancel', 0, '<i class="' . ICON_BACK . ' position-left"></i>' . CANCEL, 'class=btn btn-warning legitRipple, onclick=history.go(-1)', 'btn-group');
$form->addBtn('submit', 'submit-btn', 1, SUBMIT . '<i class="' . ICON_CHECKMARK . ' position-right"></i>', 'class=btn btn-success legitRipple', 'btn-group');
$form->setCols(0, 12);
$form->centerButtons(true);
$form->printBtnGroup('btn-group');
$form->addHtml('</div>');
$form->endFieldset();
$form->addPlugin('nice-check', 'form', 'default', array('%skin%' => 'green'));
$form->addPlugin('select2', 'select', 'default');
