<?php
namespace phpformbuilder;

use phpformbuilder\Validator\Validator;
use phpformbuilder\database\Mysql;
use common\Utils;

class FormExtended extends Form
{

    /* =============================================
    CRUD GENERATOR
    ============================================= */

    public function startRowCol($row_class, $col_class)
    {
        $this->addHtml('<div class="' . $row_class . '">');
        $this->addHtml('<div class="' . $col_class . '">');
    }

    public function endRowCol()
    {
        $this->addHtml('</div>');
        $this->addHtml('</div>');
    }

    public function startCard($title, $classname = 'card-default', $heading_elements = '', $has_body = true)
    {
        $start_card = Utils::startCard($title, $classname, $heading_elements, $has_body);
        $this->addHtml($start_card);
    }

    public function endCard($has_body = true)
    {
        $end_card = Utils::endCard($has_body);
        $this->addHtml($end_card);
    }

    public function startPanel($title, $classname = 'panel-default border-top-slate border-top-xlg', $heading_elements = '', $has_body = true)
    {
        $start_panel = Utils::startPanel($title, $classname, $heading_elements, $has_body);
        $this->addHtml($start_panel);
    }

    public function endPanel($has_body = true)
    {
        $end_panel = Utils::endPanel($has_body);
        $this->addHtml($end_panel);
    }

    public function addValidationAutoFields($column_name, $index, $function, $value, $validation_helper_text = '')
    {
        $input_function = 'cu_auto_validation_function_' . $column_name . '-' . $index;
        $input_arguments  = 'cu_auto_validation_arguments_' . $column_name . '-' . $index;
        $this->groupInputs($input_function, $input_arguments);
        $this->addHtml('<div class="row"><div class="col mb-2">');
        $options = array(
               'horizontalLabelCol'       => 'col-md-4 mb-md-2 mb-lg-0 col-lg-2',
               'horizontalElementCol'     => 'col-md-8 mb-md-2 mb-lg-0 col-lg-3'
        );
        $this->setOptions($options);
        $this->addInput('text', $input_function, $function, FUNCTION_CONST, 'class=form-control-sm, data-index=' . $index . ', data-column-name=' . $column_name . ', readonly');
        if (!empty($validation_helper_text)) {
            $this->addHelper($validation_helper_text, $input_arguments);
        }
        $options = array(
               'horizontalLabelCol'       => 'col-md-4 mb-md-2 mb-lg-0 col-lg-2',
               'horizontalElementCol'     => 'col-md-8 mb-md-2 mb-lg-0 col-lg-5'
        );
        $this->setOptions($options);
        $this->addInput('text', $input_arguments, $value, ARGUMENTS, 'class=form-control-sm, readonly');
        $this->addHtml('</div></div>');
    }

    public function addCustomValidationFields($column_name, $index, $validation_helper_text = '')
    {
        $select_name = 'cu_validation_function_' . $column_name . '-' . $index;
        $input_name  = 'cu_validation_arguments_' . $column_name . '-' . $index;
        $div_attr    = ' class="row validation-dynamic" data-index="' . $index . '"';
        $this->groupInputs($select_name, $input_name, 'validation_remove-' . $index);
        $this->addHtml('<div' . $div_attr . '><div class="col">');
        $options = array(
               'horizontalLabelCol'       => 'col-md-4 mb-md-2 mb-lg-0 col-lg-2',
               'horizontalElementCol'     => 'col-md-8 mb-md-2 mb-lg-0 col-lg-3'
        );
        $this->setOptions($options);
        $this->addOption($select_name, 'required', 'required');
        $this->addOption($select_name, 'email', 'email');
        $this->addOption($select_name, 'float', 'float');
        $this->addOption($select_name, 'integer', 'integer');
        $this->addOption($select_name, 'min', 'min');
        $this->addOption($select_name, 'max', 'max');
        $this->addOption($select_name, 'between', 'between');
        $this->addOption($select_name, 'minLength', 'minLength');
        $this->addOption($select_name, 'maxLength', 'maxLength');
        $this->addOption($select_name, 'length', 'length');
        $this->addOption($select_name, 'startsWith', 'startsWith');
        $this->addOption($select_name, 'notStartsWith', 'notStartsWith');
        $this->addOption($select_name, 'endsWith', 'endsWith');
        $this->addOption($select_name, 'notEndsWith', 'notEndsWith');
        $this->addOption($select_name, 'ip', 'ip');
        $this->addOption($select_name, 'url', 'url');
        $this->addOption($select_name, 'date', 'date');
        $this->addOption($select_name, 'minDate', 'minDate');
        $this->addOption($select_name, 'maxDate', 'maxDate');
        $this->addOption($select_name, 'ccnum', 'ccnum');
        $this->addOption($select_name, 'oneOf', 'oneOf');
        $this->addOption($select_name, 'hasLowercase', 'hasLowercase');
        $this->addOption($select_name, 'hasUppercase', 'hasUppercase');
        $this->addOption($select_name, 'hasNumber', 'hasNumber');
        $this->addOption($select_name, 'hasSymbol', 'hasSymbol');
        $this->addOption($select_name, 'hasPattern', 'hasPattern');
        $this->addSelect($select_name, FUNCTION_CONST, 'data-index=' . $index . ', data-column-name=' . $column_name);
        if (!empty($validation_helper_text)) {
            $this->addHtml('<span class="form-text text-muted">' . $validation_helper_text . '</span>', $input_name, $pos = 'after');
        }
        $options = array(
               'horizontalLabelCol'       => 'col-md-4 mb-md-2 col-lg-2',
               'horizontalElementCol'     => 'col-md-8 mb-md-2 col-lg-4'
        );
        $this->setOptions($options);
        $this->addInput('text', $input_name, '', ARGUMENTS);

        // remove button
        $options = array(
               'horizontalElementCol'     => 'col-12 mb-md-4 col-lg-1 mb-lg-0'
        );
        $this->setOptions($options);
        $this->addBtn('button', 'validation_remove-' . $index, $index, '<span aria-hidden="true">&times;</span>', 'class=close validation-remove-element-button, aria-label=Close, data-index=' . $index);
        $this->addHtml('</div></div>');
    }

    public function addFilterFields($table, $index)
    {
        $this->setCols(2, 7);
        $this->groupInputs('filter-mode-' . $index, 'filter_remove-' . $index);

        // filter mode
        $this->addHtml('<div class="row filters-dynamic" data-index="' . $index . '"><div class="col-sm-12 pt-2 pb-5">');
        $this->addRadio('filter-mode-' . $index, SIMPLE, 'simple', 'checked');
        $this->addRadio('filter-mode-' . $index, ADVANCED, 'advanced');
        $this->printRadioGroup('filter-mode-' . $index, '');

        // remove button
        $this->setCols(0, 5);
        $this->addBtn('button', 'filter_remove-' . $index, $index, '<span aria-hidden="true">&times;</span>', 'class=close filters-remove-element-button, aria-label=Close, data-index=' . $index);

        // simple filters
        $this->startDependentFields('filter-mode-' . $index, 'simple');
        $db = new Mysql();
        $columns = $db->GetColumnNames($table);
        foreach ($columns as $column_name) {
            $this->addOption('filter_field_A-' . $index, $column_name, $table . '.' . $column_name);
        }
        $this->setCols(2, 5);
        $this->addHtml('<span class="form-text text-muted">' . FILTER_HELP_1 . '</span>', 'filter_field_A-' . $index, 'after');
        $this->addSelect('filter_field_A-' . $index, FIELDS_TO_FILTER);

        $this->endDependentFields();

        // advanced filters
        $this->startDependentFields('filter-mode-' . $index, 'advanced');
        $this->setCols(2, 4);
        $this->groupInputs('filter_select_label-' . $index, 'filter_option_text-' . $index);
        $this->addInput('text', 'filter_select_label-' . $index, '', LABEL);
        $this->addInput('text', 'filter_option_text-' . $index, '', VALUE_S);

        $this->groupInputs('filter_fields-' . $index, 'filter_field_to_filter-' . $index);
        $this->addInput('text', 'filter_fields-' . $index, '', FIELDS);
        $this->addInput('text', 'filter_field_to_filter-' . $index, '', FIELDS_TO_FILTER);

        $this->groupInputs('filter_from-' . $index, 'filter_column-' . $index);
        $this->addInput('text', 'filter_from-' . $index, '', SQL_FROM);
        $this->addInput('text', 'filter_column-' . $index, '', COLUMN_INDEX);
        if (!isset($_SESSION['form-select-fields']['filter_type-' . $index])) {
            $_SESSION['form-select-fields']['filter_type-' . $index] = 'text';
        }
        $this->setCols(2, 6);
        $this->groupInputs('filter_type-' . $index, 'filter_test-' . $index);
        $this->addRadio('filter_type-' . $index, TEXT, 'text');
        $this->addRadio('filter_type-' . $index, BOOLEAN_CONST, 'boolean');
        $this->printRadioGroup('filter_type-' . $index, VALUES_TYPE);
        $this->setCols(0, 4);
        $this->addBtn('button', 'filter_test-' . $index, $index, TEST, 'class=btn btn-sm btn-success pull-right');
        $this->endDependentFields();

        $this->addHtml('</div></div>');
    }

    /* =============================================
        Complete contact form
    ============================================= */

    public function createContactForm()
    {
        $this->startFieldset('Please fill in this form to contact us');
        $this->addHtml('<p class="text-warning">All fields are required</p>');
        $this->groupInputs('user-name', 'user-first-name');
        $this->setCols(0, 6, 'sm');
        $user_icon = '<span class="glyphicon glyphicon-user"></span>';
        if ($this->framework == 'bs4') {
            $user_icon = '<i class="fa fa-user" aria-hidden="true"></i>';
        }
        $this->addIcon('user-name', $user_icon, 'before');
        $this->addInput('text', 'user-name', '', '', 'required, placeholder=Name');
        $this->addIcon('user-first-name', $user_icon, 'before');
        $this->addInput('text', 'user-first-name', '', '', 'required, placeholder=First Name');
        $this->setCols(0, 12, 'sm');
        $email_icon = '<span class="glyphicon glyphicon-envelope"></span>';
        if ($this->framework == 'bs4') {
            $email_icon = '<i class="fa fa-envelope" aria-hidden="true"></i>';
        }
        $this->addIcon('user-email', $email_icon, 'before');
        $this->addInput('email', 'user-email', '', '', 'required, placeholder=Email');
        $phone_icon = '<span class="glyphicon glyphicon-earphone"></span>';
        if ($this->framework == 'bs4') {
            $phone_icon = '<i class="fa fa-phone" aria-hidden="true"></i>';
        }
        $this->addIcon('user-phone', $phone_icon, 'before');
        $this->addInput('text', 'user-phone', '', '', 'required, placeholder=Phone');
        $this->addTextarea('message', '', '', 'cols=30, rows=4, required, placeholder=Message');
        $this->addPlugin('word-character-count', '#message', 'default', array('%maxAuthorized%' => 100));
        $this->addCheckbox('newsletter', 'Suscribe to Newsletter', 1, 'checked=checked');
        $this->printCheckboxGroup('newsletter', '');
        $this->setCols(3, 9, 'sm');
        $this->addInput('text', 'captcha', '', 'Type the following characters :', 'size=15');
        $this->addPlugin('captcha', '#captcha');
        $this->addBtn('submit', 'submit-btn', 1, 'Send <span class="glyphicon glyphicon-envelope append"></span>', 'class=btn btn-success');
        $this->endFieldset();

        // Custom radio & checkbox css
        if ($this->framework != 'material') {
            $this->addPlugin('nice-check', 'form', 'default', ['%skin%' => 'green']);
        }

        // jQuery validation
        $this->addPlugin('formvalidation', '#' . $this->form_ID);

        return $this;
    }

    /* =============================================
        Complete Foundation contact form
    ============================================= */

    public function createFoundationContactForm()
    {
        $this->startFieldset('Please fill in this form to contact us', 'class=fieldset');
        $this->addHtml('<p class="text-warning">All fields are required</p>');
        $this->groupInputs('user-name', 'user-first-name');
        $this->setCols(0, 6, 'xs');
        $this->addIcon('user-name', '<i class="input-group-label fi fi-torso"></i>', 'before');
        $this->addInput('text', 'user-name', '', '', 'class=input-group-field, required, placeholder=Name');
        $this->addIcon('user-first-name', '<i class="input-group-label fi fi-torso"></i>', 'before');
        $this->addInput('text', 'user-first-name', '', '', 'class=input-group-field, required, placeholder=First Name');
        $this->setCols(0, 12, 'xs');
        $this->addIcon('user-email', '<i class="input-group-label fi fi-mail"></i>', 'before');
        $this->addInput('email', 'user-email', '', '', 'class=input-group-field, required, placeholder=Email');
        $this->addIcon('user-phone', '<i class="input-group-label fi fi-telephone"></i>', 'before');
        $this->addInput('text', 'user-phone', '', '', 'class=input-group-field, required, placeholder=Phone');
        $this->addTextarea('message', '', '', 'cols=30, rows=4, required, placeholder=Message');
        $this->addPlugin('word-character-count', '#message', 'default', array('%maxAuthorized%' => 100));
        $this->addCheckbox('newsletter', 'Suscribe to Newsletter', 1, 'checked=checked');
        $this->printCheckboxGroup('newsletter', '');
        $this->setCols(3, 9, 'sm');
        $this->addInput('text', 'captcha', '', 'Type the following characters :', 'size=15');
        $this->addPlugin('captcha', '#captcha');
        $this->addBtn('submit', 'submit-btn', 1, 'Send <i class="fi fi-mail append"></i>', 'class=button success');
        $this->endFieldset();

        // Custom radio & checkbox css
        $this->addPlugin('nice-check', 'form', 'default', ['%skin%' => 'green']);

        // jQuery validation
        // not available yet - waiting for the version 1.0 - http://formvalidation.io/
        // $this->addPlugin('formvalidation', '#' . $this->form_ID, 'foundation');

        return $this;
    }

    /* Contact form validation */

    public static function validateContactForm()
    {
        // create validator & auto-validate required fields
        $validator = self::validate('extended-contact-form');

        // additional validation
        $validator->maxLength(100)->validate('message');
        $validator->email()->validate('user-email');
        $validator->captcha('captcha')->validate('captcha');

        // check for errors

        if ($validator->hasErrors()) {
            $_SESSION['errors']['extended-contact-form'] = $validator->getAllErrors();

            return false;
        } else {
            return true;
        }
    }

    /* Contact form e-mail sending */

    public static function sendContactEmail($address, $form_ID)
    {

        // get hostname
        $hostname = 'phpformbuilder.pro'; // replace hostname with yours
        $email_config = array(
            'sender_email'    => 'contact@' . $hostname,
            'recipient_email' => $address,
            'subject'         => 'Message from ' . $hostname,
            'filter_values'   => $form_ID . ', captcha, submit-btn, captchaHash'
        );
        $sent_message = self::sendMail($email_config);
        self::clear($form_ID);

        return $sent_message;
    }

    /* =============================================
        Fields shorcuts and groups for users
    ============================================= */

    public function addAddress($i = '')
    {
        $index = $this->getIndex($i);
        $index_text = $this->getIndexText($i);
        $this->setCols(3, 9, 'md');
        $this->addTextarea('address' . $index, '', 'Address' . $index_text, 'required');
        $this->groupInputs('zip_code' . $index, 'city' . $index);
        $this->setCols(3, 4, 'md');
        $this->addInput('text', 'zip_code' . $index, '', 'Zip Code' . $index_text, 'required');
        $this->setCols(2, 3, 'md');
        $this->addInput('text', 'city' . $index, '', 'City' . $index_text, 'required');
        $this->setCols(3, 9, 'md');
        $this->addCountrySelect('country' . $index, 'Country' . $index_text, 'data-width=100%, required', ['flag_size' => 16, 'live_search' => true]);

        return $this;
    }

    public function addBirth($i = '')
    {
        $index = $this->getIndex($i);
        $index_text = $this->getIndexText($i);
        $this->setCols(3, 4, 'md');
        $this->groupInputs('birth_date' . $index, 'birth_zip_code' . $index);
        $this->addInput('text', 'birth_date' . $index, '', 'Birth Date' . $index_text, 'placeholder=click to open calendar');
        if ($this->framework == 'material') {
            $date_plugin = 'pickadate-material';
        } else {
            $date_plugin = 'pickadate';
        }
        $this->addPlugin($date_plugin, '#birth_date' . $index);
        $this->setCols(2, 3, 'md');
        $this->addInput('text', 'birth_zip_code' . $index, '', 'Birth Zip Code' . $index_text);
        $this->setCols(3, 4, 'md');
        $this->groupInputs('birth_city' . $index, 'birth_country' . $index);
        $this->addInput('text', 'birth_city' . $index, '', 'Birth  City' . $index_text);
        $this->setCols(2, 3, 'md');
        $this->addCountrySelect('birth_country' . $index, 'Birth Country' . $index_text, 'data-width=100%', ['flag_size' => 16, 'live_search' => true]);

        return $this;
    }

    public function addCivilitySelect($i = '')
    {
        $index = $this->getIndex($i);
        $index_text = $this->getIndexText($i);
        $this->addOption('civility' . $index, 'M.', 'M.');
        $this->addOption('civility' . $index, 'M<sup>rs</sup>', 'Mrs');
        $this->addOption('civility' . $index, 'M<sup>s</sup>', 'Ms');
        $this->addSelect('civility' . $index, 'Civility' . $index_text, 'class=select2, required');

        return $this;
    }

    public function addContact($i = '')
    {
        $index = $this->getIndex($i);
        $index_text = $this->getIndexText($i);
        $this->groupInputs('phone' . $index, 'mobile_phone' . $index);
        $this->setCols(3, 4, 'md');
        $this->addInput('text', 'phone' . $index, '', 'Phone' . $index_text);
        $this->setCols(2, 3, 'md');
        $this->addInput('text', 'mobile_phone' . $index, '', 'Mobile' . $index_text, 'required');
        $this->setCols(3, 9, 'md');
        $this->addInput('email', 'email_professional' . $index, '', 'BuisnessE-mail' . $index_text, 'required');
        $this->addInput('email', 'email_private' . $index, '', 'Personal E-mail' . $index_text);

        return $this;
    }

    public function addIdentity($i = '')
    {
        $index = $this->getIndex($i);
        $index_text = $this->getIndexText($i);
        $this->groupInputs('civility' . $index, 'name' . $index);
        $this->setCols(3, 2, 'md');
        $this->addCivilitySelect($i);
        $this->setCols(2, 5, 'md');
        $this->addInput('text', 'name' . $index, '', 'Name' . $index_text, 'required');
        $this->setCols(3, 9, 'md');
        $this->startDependentFields('civility' . $index, 'Mrs');
        $this->addInput('text', 'maiden_name' . $index, '', 'Maiden Name' . $index_text);
        $this->endDependentFields();
        $this->groupInputs('firstnames' . $index, 'citizenship' . $index);
        $this->setCols(3, 4, 'md');
        $this->addInput('text', 'firstnames' . $index, '', 'Firstnames' . $index_text, 'required');
        $this->setCols(2, 3, 'md');
        $this->addInput('text', 'citizenship' . $index, '', 'Citizenship' . $index_text);

        return $this;
    }

    /* Submit buttons */

    public function addBackSubmit()
    {
        $this->setCols(0, 12);
        $this->addHtml('<p>&nbsp;</p>');
        $this->addBtn('submit', 'back-btn', 1, 'Back', 'class=btn btn-warning', 'submit_group');
        $this->addBtn('submit', 'submit-btn', 1, 'Submit', 'class=btn btn-success', 'submit_group');
        $this->printBtnGroup('submit_group');

        return $this;
    }

    public function addCancelSubmit()
    {
        $this->setCols(3, 9);
        $this->addHtml('<p>&nbsp;</p>');
        $cancel_class = 'btn btn-default';
        $submit_class = 'btn btn-success';
        if ($this->framework == 'foundation') {
            $cancel_class = 'button warning';
            $submit_class = 'button primary';
        }
        $this->addBtn('button', 'cancel-btn', 1, 'Cancel', 'class=' . $cancel_class, 'submit_group');
        $this->addBtn('submit', 'submit-btn', 1, 'Submit', 'class=' . $submit_class, 'submit_group');
        $this->printBtnGroup('submit_group');

        return $this;
    }

    private function getIndex($i)
    {
        if ($i !== '') {
            return '-' . $i;
        }

        return false;
    }
    private function getIndexText($i)
    {
        if ($i !== '') {
            return ' ' . $i;
        }

        return false;
    }
}
