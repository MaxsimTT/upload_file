<?php

namespace controllers;

use models\FilesModel;

class UploadFile
{

	public function __construct(private array $params)
	{
	}

	public static function create(array $params): UploadFile
	{
		return new UploadFile($params);
	}

	public function index()
	{
		$params = $this->getParams();

		if (isset($_POST['uploadfile'])) {
			
			$file = $_FILES['text_file'];
			
			if ($file['error']) {
				$_SESSION['upload_file'] = false;
				return header("Refresh:0");
			}

			try
			{
				$file = FilesModel::uploadFile(
												$file,
												$params['type_file'],
												$params['max_size_file'],
												$params['extension_file'],
												$params['dir_name']
												);
				$_SESSION['upload_file'] = true;

			}
			catch (\Exception $e)
			{
				$_SESSION['upload_file'] = false;
				$_SESSION['error_message'] = $e->getMessage();
			}

			return header("Refresh:0");
			
		}

		$files = new FilesModel(ROOT . $params['dir_name']);
		$count_digital = $files->getCountDigitsFromStr();

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
