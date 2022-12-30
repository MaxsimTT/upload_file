<?php

session_start();

require_once(__DIR__ . '/conf/app.php');

$post = "Hello, World";

if (isset($_SESSION['main_file'])) {
	// debug($_SESSION['main_file']);
	$file = $_SESSION['main_file'];
	unset($_SESSION['main_file']);
	// debug($_SESSION);
}

if (isset($file)) {
	$file_name = $file['main_file']['name'];
}

if ($_FILES) {
	// debug($_FILES);
	$_SESSION['main_file'] = $_FILES;
	header("Refresh:0");
}

include(VIEWS . 'upload_file.php');
