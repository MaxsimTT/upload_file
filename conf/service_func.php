<?php

function debug(array|string $data): void
{
	echo '<pre>' . print_r($data, true) . '</pre>';
}

function autoloader(string $path): void
{
	if (preg_match('/\\\\/', $path)) {
		$path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
	}

	if (\stream_resolve_include_path("{$path}.php") !== false) {
		require_once "{$path}.php";
	}
}

function getListFiles(string $path): array|bool
{
	$list_files = [];

	if (! is_dir($path)) {
		return false;
	}

	if ($handle = opendir($path)) {
	    while (false !== ($entry = readdir($handle))) {
	        if ($entry != "." && $entry != "..") {
	            $list_files[] = $entry;
	        }
	    }
	    closedir($handle);
	}
	return $list_files;
}

function countStringSymbols(array $list_files, string $path): array|bool
{
	$file_strings = [];
	$result = [];

	foreach ($list_files as $file) {
		if (!file_exists($path . '/' . $file)) {
			return false;
		}
    	$file_strings[$file] = file($path . '/' . $file, FILE_IGNORE_NEW_LINES);
    }

    foreach ($file_strings as $name => $data) {
		foreach ($data as $v) {
			$str = str_replace(' ', '', $v);
			$result[$name][] = mb_strlen($str, "ASCII") . "<br>";
		}
    }

    return $result;
}

function getCountDigitsFromStr(array $list_files, string $path): array|bool
{
	$file_strings = [];
	$result = [];

	foreach ($list_files as $file) {
		if (!file_exists($path . '/' . $file)) {
			return false;
		}
    	$file_strings[$file] = file($path . '/' . $file, FILE_IGNORE_NEW_LINES);
    }

    foreach ($file_strings as $name_file => $data) {
    	foreach ($data as $key => $str) {
    		$result[$name_file][$key + 1] = preg_match_all('/[0-9]/', $str, $matches);
    	}
    }

	return $result;
}
