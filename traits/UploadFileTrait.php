<?php

namespace traits;

trait UploadFileTrait
{
	private string $upload_dir_name = '';

	protected function validate(array $file, string $type, int $max_size, string $ext): bool
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

	protected function setUploadDirName($dirName): void
	{
		$this->upload_dir_name = $dirName;
	}

	protected function getUploadDirName(): string|int
	{
		return $this->upload_dir_name;
	}

    protected function createDirUploadFile(): bool
    {
        if (!is_dir($this->upload_dir_name)) {
            if (!mkdir($this->upload_dir_name, 0777, true)) {
                return false;
            }
        }
        return true;
    }

	protected function uploadFile(array $file): bool
	{
		$target = "$this->upload_dir_name\\{$file['name']}";
		return move_uploaded_file($file['tmp_name'], $target);
	}

}
