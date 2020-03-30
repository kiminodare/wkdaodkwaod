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

if ($_SERVER["REQUEST_METHOD"] == "POST" && Form::testToken('form-edit-phpcg-users-profiles') === true) {
    include_once CLASS_DIR . 'phpformbuilder/Validator/Validator.php';
    include_once CLASS_DIR . 'phpformbuilder/Validator/Exception.php';
    $validator = new Validator($_POST);
    $validator->required()->validate('profile_name');
    $validator->maxLength(100)->validate('profile_name');
    $validator->required()->validate('read_log_activity');
    $validator->integer()->validate('read_log_activity');
    $validator->min(-9)->validate('read_log_activity');
    $validator->max(9)->validate('read_log_activity');
    $validator->required()->validate('update_log_activity');
    $validator->integer()->validate('update_log_activity');
    $validator->min(-9)->validate('update_log_activity');
    $validator->max(9)->validate('update_log_activity');
    $validator->required()->validate('create_delete_log_activity');
    $validator->integer()->validate('create_delete_log_activity');
    $validator->min(-9)->validate('create_delete_log_activity');
    $validator->max(9)->validate('create_delete_log_activity');
    $validator->maxLength(255)->validate('constraint_query_log_activity');
    $validator->required()->validate('read_user');
    $validator->integer()->validate('read_user');
    $validator->min(-9)->validate('read_user');
    $validator->max(9)->validate('read_user');
    $validator->required()->validate('update_user');
    $validator->integer()->validate('update_user');
    $validator->min(-9)->validate('update_user');
    $validator->max(9)->validate('update_user');
    $validator->required()->validate('create_delete_user');
    $validator->integer()->validate('create_delete_user');
    $validator->min(-9)->validate('create_delete_user');
    $validator->max(9)->validate('create_delete_user');
    $validator->maxLength(255)->validate('constraint_query_user');
    $validator->required()->validate('read_phpcg_users');
    $validator->integer()->validate('read_phpcg_users');
    $validator->min(-9)->validate('read_phpcg_users');
    $validator->max(9)->validate('read_phpcg_users');
    $validator->required()->validate('update_phpcg_users');
    $validator->integer()->validate('update_phpcg_users');
    $validator->min(-9)->validate('update_phpcg_users');
    $validator->max(9)->validate('update_phpcg_users');
    $validator->required()->validate('create_delete_phpcg_users');
    $validator->integer()->validate('create_delete_phpcg_users');
    $validator->min(-9)->validate('create_delete_phpcg_users');
    $validator->max(9)->validate('create_delete_phpcg_users');
    $validator->maxLength(255)->validate('constraint_query_phpcg_users');
    $validator->required()->validate('read_phpcg_users_profiles');
    $validator->integer()->validate('read_phpcg_users_profiles');
    $validator->min(-9)->validate('read_phpcg_users_profiles');
    $validator->max(9)->validate('read_phpcg_users_profiles');
    $validator->required()->validate('update_phpcg_users_profiles');
    $validator->integer()->validate('update_phpcg_users_profiles');
    $validator->min(-9)->validate('update_phpcg_users_profiles');
    $validator->max(9)->validate('update_phpcg_users_profiles');
    $validator->required()->validate('create_delete_phpcg_users_profiles');
    $validator->integer()->validate('create_delete_phpcg_users_profiles');
    $validator->min(-9)->validate('create_delete_phpcg_users_profiles');
    $validator->max(9)->validate('create_delete_phpcg_users_profiles');
    $validator->maxLength(255)->validate('constraint_query_phpcg_users_profiles');

    // check for errors
    if ($validator->hasErrors()) {
        $_SESSION['errors']['form-edit-phpcg-users-profiles'] = $validator->getAllErrors();
    } else {
        require_once CLASS_DIR . 'phpformbuilder/database/db-connect.php';
        require_once CLASS_DIR . 'phpformbuilder/database/Mysql.php';
        $db = new Mysql();
        $update['profile_name'] = Mysql::SQLValue($_POST['profile_name'], Mysql::SQLVALUE_TEXT);
        if (is_array($_POST['read_log_activity'])) {
            $json_values = json_encode($_POST['read_log_activity'], JSON_UNESCAPED_UNICODE);
            $update['read_log_activity'] = Mysql::SQLValue($json_values);
        } else {
            $update['read_log_activity'] = Mysql::SQLValue($_POST['read_log_activity'], Mysql::SQLVALUE_TEXT);
        }
        if (is_array($_POST['update_log_activity'])) {
            $json_values = json_encode($_POST['update_log_activity'], JSON_UNESCAPED_UNICODE);
            $update['update_log_activity'] = Mysql::SQLValue($json_values);
        } else {
            $update['update_log_activity'] = Mysql::SQLValue($_POST['update_log_activity'], Mysql::SQLVALUE_TEXT);
        }
        if (is_array($_POST['create_delete_log_activity'])) {
            $json_values = json_encode($_POST['create_delete_log_activity'], JSON_UNESCAPED_UNICODE);
            $update['create_delete_log_activity'] = Mysql::SQLValue($json_values);
        } else {
            $update['create_delete_log_activity'] = Mysql::SQLValue($_POST['create_delete_log_activity'], Mysql::SQLVALUE_TEXT);
        }
        $update['constraint_query_log_activity'] = Mysql::SQLValue($_POST['constraint_query_log_activity'], Mysql::SQLVALUE_TEXT);
        if (is_array($_POST['read_user'])) {
            $json_values = json_encode($_POST['read_user'], JSON_UNESCAPED_UNICODE);
            $update['read_user'] = Mysql::SQLValue($json_values);
        } else {
            $update['read_user'] = Mysql::SQLValue($_POST['read_user'], Mysql::SQLVALUE_TEXT);
        }
        if (is_array($_POST['update_user'])) {
            $json_values = json_encode($_POST['update_user'], JSON_UNESCAPED_UNICODE);
            $update['update_user'] = Mysql::SQLValue($json_values);
        } else {
            $update['update_user'] = Mysql::SQLValue($_POST['update_user'], Mysql::SQLVALUE_TEXT);
        }
        if (is_array($_POST['create_delete_user'])) {
            $json_values = json_encode($_POST['create_delete_user'], JSON_UNESCAPED_UNICODE);
            $update['create_delete_user'] = Mysql::SQLValue($json_values);
        } else {
            $update['create_delete_user'] = Mysql::SQLValue($_POST['create_delete_user'], Mysql::SQLVALUE_TEXT);
        }
        $update['constraint_query_user'] = Mysql::SQLValue($_POST['constraint_query_user'], Mysql::SQLVALUE_TEXT);
        if (is_array($_POST['read_phpcg_users'])) {
            $json_values = json_encode($_POST['read_phpcg_users'], JSON_UNESCAPED_UNICODE);
            $update['read_phpcg_users'] = Mysql::SQLValue($json_values);
        } else {
            $update['read_phpcg_users'] = Mysql::SQLValue($_POST['read_phpcg_users'], Mysql::SQLVALUE_TEXT);
        }
        if (is_array($_POST['update_phpcg_users'])) {
            $json_values = json_encode($_POST['update_phpcg_users'], JSON_UNESCAPED_UNICODE);
            $update['update_phpcg_users'] = Mysql::SQLValue($json_values);
        } else {
            $update['update_phpcg_users'] = Mysql::SQLValue($_POST['update_phpcg_users'], Mysql::SQLVALUE_TEXT);
        }
        if (is_array($_POST['create_delete_phpcg_users'])) {
            $json_values = json_encode($_POST['create_delete_phpcg_users'], JSON_UNESCAPED_UNICODE);
            $update['create_delete_phpcg_users'] = Mysql::SQLValue($json_values);
        } else {
            $update['create_delete_phpcg_users'] = Mysql::SQLValue($_POST['create_delete_phpcg_users'], Mysql::SQLVALUE_TEXT);
        }
        $update['constraint_query_phpcg_users'] = Mysql::SQLValue($_POST['constraint_query_phpcg_users'], Mysql::SQLVALUE_TEXT);
        if (is_array($_POST['read_phpcg_users_profiles'])) {
            $json_values = json_encode($_POST['read_phpcg_users_profiles'], JSON_UNESCAPED_UNICODE);
            $update['read_phpcg_users_profiles'] = Mysql::SQLValue($json_values);
        } else {
            $update['read_phpcg_users_profiles'] = Mysql::SQLValue($_POST['read_phpcg_users_profiles'], Mysql::SQLVALUE_TEXT);
        }
        if (is_array($_POST['update_phpcg_users_profiles'])) {
            $json_values = json_encode($_POST['update_phpcg_users_profiles'], JSON_UNESCAPED_UNICODE);
            $update['update_phpcg_users_profiles'] = Mysql::SQLValue($json_values);
        } else {
            $update['update_phpcg_users_profiles'] = Mysql::SQLValue($_POST['update_phpcg_users_profiles'], Mysql::SQLVALUE_TEXT);
        }
        if (is_array($_POST['create_delete_phpcg_users_profiles'])) {
            $json_values = json_encode($_POST['create_delete_phpcg_users_profiles'], JSON_UNESCAPED_UNICODE);
            $update['create_delete_phpcg_users_profiles'] = Mysql::SQLValue($json_values);
        } else {
            $update['create_delete_phpcg_users_profiles'] = Mysql::SQLValue($_POST['create_delete_phpcg_users_profiles'], Mysql::SQLVALUE_TEXT);
        }
        $update['constraint_query_phpcg_users_profiles'] = Mysql::SQLValue($_POST['constraint_query_phpcg_users_profiles'], Mysql::SQLVALUE_TEXT);
        $filter["ID"] = Mysql::SQLValue($_SESSION['phpcg_users_profiles_editable_primary_key'], Mysql::SQLVALUE_NUMBER);
        $db->throwExceptions = true;
        try {
            // begin transaction
            $db->transactionBegin();

            // update phpcg_users_profiles
            if (DEMO !== true && !$db->updateRows('phpcg_users_profiles', $update, $filter)) {
                $error = $db->error();
                $db->transactionRollback();
                throw new \Exception($error);
            } else {
                if (!isset($error)) {
                    // ALL OK
                    $db->transactionEnd();
                    $_SESSION['msg'] = Utils::alert(UPDATE_SUCCESS_MESSAGE, 'alert-success has-icon');

                    // reset form values
                    Form::clear('form-edit-phpcg-users-profiles');

                    // redirect to list page
                    if (isset($_SESSION['active_list_url'])) {
                        header('Location:' . $_SESSION['active_list_url']);
                    } else {
                        header('Location:https://wibu-checker.com/admin/admin/phpcgusersprofiles');
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
$ID = $pk;

// register editable primary key, which is NOT posted and will be the query update filter
$_SESSION['phpcg_users_profiles_editable_primary_key'] = $ID;

if (!isset($_SESSION['errors']['form-edit-phpcg-users-profiles']) || empty($_SESSION['errors']['form-edit-phpcg-users-profiles'])) { // If no error registered
    $qry = "SELECT * FROM `phpcg_users_profiles`";

    $transition = 'WHERE';

    // if restricted rights
    if (ADMIN_LOCKED === true && Secure::canUpdateRestricted('phpcg_users_profiles')) {
        $qry .= Secure::getRestrictionQuery('phpcg_users_profiles');
        $transition = 'AND';
    }
    $qry .= ' ' . $transition . " phpcg_users_profiles.ID = '$ID'";

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
    $_SESSION['form-edit-phpcg-users-profiles']['ID'] = $row->ID;
    $_SESSION['form-edit-phpcg-users-profiles']['profile_name'] = $row->profile_name;
    $_SESSION['form-edit-phpcg-users-profiles']['read_log_activity'] = $row->read_log_activity;
    $_SESSION['form-edit-phpcg-users-profiles']['update_log_activity'] = $row->update_log_activity;
    $_SESSION['form-edit-phpcg-users-profiles']['create_delete_log_activity'] = $row->create_delete_log_activity;
    $_SESSION['form-edit-phpcg-users-profiles']['constraint_query_log_activity'] = $row->constraint_query_log_activity;
    $_SESSION['form-edit-phpcg-users-profiles']['read_user'] = $row->read_user;
    $_SESSION['form-edit-phpcg-users-profiles']['update_user'] = $row->update_user;
    $_SESSION['form-edit-phpcg-users-profiles']['create_delete_user'] = $row->create_delete_user;
    $_SESSION['form-edit-phpcg-users-profiles']['constraint_query_user'] = $row->constraint_query_user;
    $_SESSION['form-edit-phpcg-users-profiles']['read_phpcg_users'] = $row->read_phpcg_users;
    $_SESSION['form-edit-phpcg-users-profiles']['update_phpcg_users'] = $row->update_phpcg_users;
    $_SESSION['form-edit-phpcg-users-profiles']['create_delete_phpcg_users'] = $row->create_delete_phpcg_users;
    $_SESSION['form-edit-phpcg-users-profiles']['constraint_query_phpcg_users'] = $row->constraint_query_phpcg_users;
    $_SESSION['form-edit-phpcg-users-profiles']['read_phpcg_users_profiles'] = $row->read_phpcg_users_profiles;
    $_SESSION['form-edit-phpcg-users-profiles']['update_phpcg_users_profiles'] = $row->update_phpcg_users_profiles;
    $_SESSION['form-edit-phpcg-users-profiles']['create_delete_phpcg_users_profiles'] = $row->create_delete_phpcg_users_profiles;
    $_SESSION['form-edit-phpcg-users-profiles']['constraint_query_phpcg_users_profiles'] = $row->constraint_query_phpcg_users_profiles;
}
$form = new Form('form-edit-phpcg-users-profiles', 'horizontal', 'novalidate', 'bs4');
$form->setAction('/admin/admin/phpcgusersprofiles/edit/' . $ID);

$form->addHtml(USERS_PROFILES_HELPER);


$form->startFieldset();

// profile_name --

$form->setCols(2, 10);
$form->addInput('text', 'profile_name', '', 'Profile Name', 'required');

$form->endFieldset();

// read_log_activity --

$form->startFieldset('log_activity', 'class=my-5');

$form->groupInputs('read_log_activity', 'update_log_activity');

$form->setCols(2, 4);
$form->addOption('read_log_activity', '2', 'Yes');
$form->addOption('read_log_activity', '1', 'Restricted');
$form->addOption('read_log_activity', '0', 'No');
$form->addSelect('read_log_activity', 'Read Log Activity', 'required, class=select2');

// update_log_activity --
$form->addOption('update_log_activity', '2', 'Yes');
$form->addOption('update_log_activity', '1', 'Restricted');
$form->addOption('update_log_activity', '0', 'No');
$form->addSelect('update_log_activity', 'Update Log Activity', 'required, class=select2');

// create_delete_log_activity --

$form->setCols(2, 10);
$form->addOption('create_delete_log_activity', '2', 'Yes');
$form->addOption('create_delete_log_activity', '1', 'Restricted');
$form->addOption('create_delete_log_activity', '0', 'No');
$form->addSelect('create_delete_log_activity', 'Create Delete Log Activity', 'required, class=select2');

// constraint_query_log_activity --
$uniqid = uniqid();
$form->addHtml('<div id="' . $uniqid . '" style="display:none">
<p>WHERE query if limited rights.</p><p>Example: <br><em>, users WHERE table.users_ID = users.ID AND users.ID = CURRENT_USER_ID</em></p><p><em>CURRENT_USER_ID</em> will be automatically replaced by the connected user\'s ID.</p></div>');
$form->addInput('text', 'constraint_query_log_activity', '', 'Constraint Query Log Activity<a href="#" data-tooltip="#' . $uniqid . '" data-delay="500" class="position-right"><span class="badge badge-secondary">?</span></a>', '');

$form->endFieldset();

// read_user --

$form->startFieldset('user', 'class=my-5');

$form->groupInputs('read_user', 'update_user');

$form->setCols(2, 4);
$form->addOption('read_user', '2', 'Yes');
$form->addOption('read_user', '1', 'Restricted');
$form->addOption('read_user', '0', 'No');
$form->addSelect('read_user', 'Read User', 'required, class=select2');

// update_user --
$form->addOption('update_user', '2', 'Yes');
$form->addOption('update_user', '1', 'Restricted');
$form->addOption('update_user', '0', 'No');
$form->addSelect('update_user', 'Update User', 'required, class=select2');

// create_delete_user --

$form->setCols(2, 10);
$form->addOption('create_delete_user', '2', 'Yes');
$form->addOption('create_delete_user', '1', 'Restricted');
$form->addOption('create_delete_user', '0', 'No');
$form->addSelect('create_delete_user', 'Create Delete User', 'required, class=select2');

// constraint_query_user --
$uniqid = uniqid();
$form->addHtml('<div id="' . $uniqid . '" style="display:none">
<p>WHERE query if limited rights.</p><p>Example: <br><em>, users WHERE table.users_ID = users.ID AND users.ID = CURRENT_USER_ID</em></p><p><em>CURRENT_USER_ID</em> will be automatically replaced by the connected user\'s ID.</p></div>');
$form->addInput('text', 'constraint_query_user', '', 'Constraint Query User<a href="#" data-tooltip="#' . $uniqid . '" data-delay="500" class="position-right"><span class="badge badge-secondary">?</span></a>', '');

$form->endFieldset();

// read_phpcg_users --

$form->startFieldset('phpcg_users', 'class=my-5');

$form->groupInputs('read_phpcg_users', 'update_phpcg_users');

$form->setCols(2, 4);
$form->addOption('read_phpcg_users', '2', 'Yes');
$form->addOption('read_phpcg_users', '1', 'Restricted');
$form->addOption('read_phpcg_users', '0', 'No');
$form->addSelect('read_phpcg_users', 'Read Phpcg Users', 'required, class=select2');

// update_phpcg_users --
$form->addOption('update_phpcg_users', '2', 'Yes');
$form->addOption('update_phpcg_users', '1', 'Restricted');
$form->addOption('update_phpcg_users', '0', 'No');
$form->addSelect('update_phpcg_users', 'Update Phpcg Users', 'required, class=select2');

// create_delete_phpcg_users --

$form->setCols(2, 10);
$form->addOption('create_delete_phpcg_users', '2', 'Yes');
$form->addOption('create_delete_phpcg_users', '0', 'No');
$form->addSelect('create_delete_phpcg_users', 'Create Delete Phpcg Users', 'required, class=select2');

// constraint_query_phpcg_users --
$form->addHtml('<span class="form-text text-muted">CREATE/DELETE rights on users table cannot be limited - this would be a nonsense</span>', 'constraint_query_phpcg_users', 'after');
$form->addInput('text', 'constraint_query_phpcg_users', '', 'Constraint Query Phpcg Users', '');

$form->endFieldset();

// read_phpcg_users_profiles --

$form->startFieldset('phpcg_users_profiles', 'class=my-5');

$form->groupInputs('read_phpcg_users_profiles', 'update_phpcg_users_profiles');

$form->setCols(2, 4);
$form->addOption('read_phpcg_users_profiles', '2', 'Yes');
$form->addOption('read_phpcg_users_profiles', '1', 'Restricted');
$form->addOption('read_phpcg_users_profiles', '0', 'No');
$form->addSelect('read_phpcg_users_profiles', 'Read Phpcg Users Profiles', 'required, class=select2');

// update_phpcg_users_profiles --
$form->addOption('update_phpcg_users_profiles', '2', 'Yes');
$form->addOption('update_phpcg_users_profiles', '1', 'Restricted');
$form->addOption('update_phpcg_users_profiles', '0', 'No');
$form->addSelect('update_phpcg_users_profiles', 'Update Phpcg Users Profiles', 'required, class=select2');

// create_delete_phpcg_users_profiles --

$form->setCols(2, 10);
$form->addOption('create_delete_phpcg_users_profiles', '2', 'Yes');
$form->addOption('create_delete_phpcg_users_profiles', '1', 'Restricted');
$form->addOption('create_delete_phpcg_users_profiles', '0', 'No');
$form->addSelect('create_delete_phpcg_users_profiles', 'Create Delete Phpcg Users Profiles', 'required, class=select2');

// constraint_query_phpcg_users_profiles --
$uniqid = uniqid();
$form->addHtml('<div id="' . $uniqid . '" style="display:none">
<p>WHERE query if limited rights.</p><p>Example: <br><em>, users WHERE table.users_ID = users.ID AND users.ID = CURRENT_USER_ID</em></p><p><em>CURRENT_USER_ID</em> will be automatically replaced by the connected user\'s ID.</p></div>');
$form->addInput('text', 'constraint_query_phpcg_users_profiles', '', 'Constraint Query Phpcg Users Profiles<a href="#" data-tooltip="#' . $uniqid . '" data-delay="500" class="position-right"><span class="badge badge-secondary">?</span></a>', '');
$form->addBtn('button', 'cancel', 0, '<i class="' . ICON_BACK . ' position-left"></i>' . CANCEL, 'class=btn btn-warning ladda-button legitRipple, onclick=history.go(-1)', 'btn-group');
$form->addBtn('submit', 'submit-btn', 1, SUBMIT . '<i class="' . ICON_CHECKMARK . ' position-right"></i>', 'class=btn btn-success ladda-button legitRipple', 'btn-group');
$form->setCols(0, 12);
$form->centerButtons(true);
$form->printBtnGroup('btn-group');
$form->endFieldset();
$form->addPlugin('nice-check', 'form', 'default', array('%skin%' => 'green'));
