<?php

namespace controllers;

use traits\UploadFileTrait;

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

		if (isset($_POST['uploadfile'])) {

			$params = $this->getParams();
			
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
			$this->uploadFile($file);

			echo $this->getUploadDirName();

			debug($file);
			
		}

		return include(VIEWS . 'upload_file.php');
	}

	public function getParams(): array
	{
		return $this->params;
	}
}
