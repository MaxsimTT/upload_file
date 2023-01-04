<?php

namespace controllers;

use traits\UploadFileTrait;
use libs\DFileHelper;

class UploadFile
{

	use UploadFileTrait
	{
		UploadFileTrait::setUploadDirName as public;
		UploadFileTrait::getUploadDirName as public;
	}

	public function __construct(private array $params)
	{
	}

	public function index()
	{
		$params = $this->getParams();

		if (isset($_POST['uploadfile'])) {
			
			$file = $_FILES['text_file'];
			
			if ($file['error']) {
				return header("Refresh:0");
			}

			if (! $this->validate(
									$file, $params['type_file'],
									$params['max_size_file'],
									$params['extension_file']
								)) {
				return header("Refresh:0");
			}

			$this->setUploadDirName($params['dir_name']);
			$this->createDirUploadFile();

			$file['name'] = DFileHelper::getRandomFileName(
											$this->getUploadDirName(),
											$params['extension_file']
											) . ".{$params['extension_file']}";

			if ($this->uploadFile($file)) {
				$_SESSION['upload_file'] = true;
			} else {
				$_SESSION['upload_file'] = false;
			}

			return header("Refresh:0");
			
		}

		debug(getListFiles(ROOT . $params['dir_name']));

		if (isset($_SESSION['upload_file'])) {
			$res = $_SESSION['upload_file'];
			unset($_SESSION['upload_file']);
		}

		return include(VIEWS . 'upload_file.php');
	}

	public function getParams(): array
	{
		return $this->params;
	}
}
