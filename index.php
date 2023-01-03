<?php

session_start();

use controllers\UploadFile;

require_once(__DIR__ . '/conf/app.php');
spl_autoload_register('autoloader');

$app = new UploadFile($params_for_upload_txt_file);
$app->index();
