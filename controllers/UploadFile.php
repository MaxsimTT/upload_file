<?php

namespace controllers;

use traits\UploadFileTrait;

class UploadFile
{

	use UploadFileTrait;

	public function upload()
	{

		if (isset($_POST['uploadfile'])) {
			
			$file = $_FILES['text_file'];
			
			if ($file['error']) {
				return header("Refresh:0");
			}

			if (! $this->validate($file, TYPE_FILE, MAX_SIZE_FILE, EXTENSION_FILE)) {
				return header("Refresh:0");
			}

			debug($file);
			
		}

		return include(VIEWS . 'upload_file.php');
	}
}
