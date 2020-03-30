<?php
use fileuploader\server\FileUploader;

session_start();

include('../../server/class.fileuploader.php');

$values = array('input_name', 'hash', 'form_id');

foreach ($values as $v) {
    if (!isset($_POST[$v])) {
        exit('EXIT 1');
    }
}

$input_name = $_POST['input_name'];
$hash       = $_POST['hash'];
$form_id    = $_POST['form_id'];

if (!isset($_SESSION[$form_id]['upload_config'][$input_name])) {
    exit('EXIT 2');
}

$upload_config = $_SESSION[$form_id]['upload_config'][$input_name];

$upload_config_values = array('limit', 'file_max_size', 'extensions', 'upload_dir');

foreach ($upload_config_values as $v) {
    if (!isset($upload_config[$v])) {
        exit('EXIT 3');
    }
}

$valid_hash = sha1($upload_config['limit'] . $upload_config['file_max_size'] . $upload_config['extensions'] . $upload_config['upload_dir']);

if ($valid_hash !== $hash) {
    exit('EXIT 4');
}

if (!is_writable($upload_config['limit'])) {
    exit('UPLOAD ERROR: ' . $upload_config['limit'] . ' IS NOT WRITABLE - Try to increase your CHMOD and double-check that your folder exists');
}

// initialize FileUploader
$FileUploader = new FileUploader($input_name, array(
    'limit'       => $upload_config['limit'],
    'maxSize'     => null,
    'fileMaxSize' => $upload_config['file_max_size'],
    'extensions'  => json_decode($upload_config['extensions']),
    'required'    => false,
    'uploadDir'   => $upload_config['upload_dir'],
    'title'       => 'name',
    'replace'     => false,
    'listInput'   => true,
    'files'       => null
));

// call to upload the files
$data = $FileUploader->upload();

// export to js
echo json_encode($data);
exit;
