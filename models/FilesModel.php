<?php

namespace models;

use traits\UploadFileTrait;
use libs\DFileHelper;

class FilesModel
{

	use UploadFileTrait
	{
		UploadFileTrait::uploadFile as upload;
	}

	private array $list_files = [];

	public function __construct(private string $files_dir)
	{
		$this->setListFiles();
	}

	public function getDirName(): string
	{
		return $this->files_dir;
	}

	public function getListFiles(): array
	{
		return $this->list_files;
	}

	private function setListFiles(): void
	{

		if (! is_dir($this->getDirName())) {
			$this->list_files = [];
		} else {
			if ($handle = opendir($this->getDirName())) {
			    while (false !== ($entry = readdir($handle))) {
			        if ($entry != "." && $entry != "..") {
			            $this->list_files[] = $entry;
			        }
			    }
			    closedir($handle);
			}
		}
	}

	public function getCountDigitsFromStr(): array|bool
	{
		$file_strings = [];
		$result = [];

		if (empty($this->getListFiles())) {
			return false;
		}

		foreach ($this->getListFiles() as $file) {
			if (!file_exists($this->getDirName() . '/' . $file)) {
				return false;
			}
	    	$file_strings[$file] = file($this->getDirName() . '/' . $file, FILE_IGNORE_NEW_LINES);
	    }

		foreach ($file_strings as $name_file => $data) {
			foreach ($data as $key => $str) {
				$result[$name_file][$key + 1] = preg_match_all('/[0-9]/', $str, $matches);
			}
		}

	    return $result;
	}

	public static function uploadFile(array $file, string $type, int $max_size, string $ext, string $dir_name): array
	{

		if (! self::validate($file, $type, $max_size, $ext)) {
			throw new \Exception("file '{$file['name']}' didn't validate");
		}

		if (! self::createDirUploadFile($dir_name)) {
			throw new \Exception("directory '$dir_name' didn't created");
		}

		$file_orig_name = $file['name'];

		$file['name'] = DFileHelper::getRandomFileName($dir_name, $ext) . ".{$ext}";

		if (! self::upload($file, $dir_name)) {
			throw new \Exception("file '{$file_orig_name}' didn't upload");
		}

		return $file;
	}

	public static function deleteFile($file): void
	{

		if (preg_match('/\\\\/', $file)) {
			$file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
		}

		if (file_exists($file) !== false) {
			unlink($file);
		} else {
			throw new \Exception("file '{$file} don't exist");
		}

	}

}
