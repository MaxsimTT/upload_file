<?php

session_start();

use controllers\UploadFile;

require_once(__DIR__ . '/conf/app.php');
spl_autoload_register('autoloader');

$app = UploadFile::create($params_for_upload_txt_file);
$app->index();

// debug(get_declared_classes());
// debug(get_class_methods(UploadFile::class));
// debug(get_class_methods(models\FilesModel::class));
