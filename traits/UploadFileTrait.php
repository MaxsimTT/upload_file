<?php

namespace traits;

trait UploadFileTrait
{

	public function validate(array $file, string $type, int $max_size, string $ext): bool
	{

		$extension = strtolower(substr(strrchr($file['name'], '.'), 1));

		if (strstr($file['type'], '/', true) != $type) {
			return false;
		}

		if ($file['size'] > $max_size) {
			return false;
		}

		if ($extension !== $ext) {
			return false;
		}

		return true;		
	}

}
