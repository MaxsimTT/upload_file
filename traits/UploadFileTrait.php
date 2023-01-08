<?php

namespace traits;

trait UploadFileTrait
{
	
	public static function validate(array $file, string $type, int $max_size, string $ext): bool
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

    public static function createDirUploadFile($dir_name): bool
    {
        if (!is_dir($dir_name)) {
            if (!mkdir($dir_name, 0777, true)) {
                return false;
            }
        }
        return true;
    }

	public static function uploadFile(array $file, string $dir_name): bool
	{
		$target = "$dir_name\\{$file['name']}";
		return move_uploaded_file($file['tmp_name'], $target);
	}

}
