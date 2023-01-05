<?php

function debug(array|string $data): void
{
	echo '<pre>' . print_r($data, true) . '</pre>';
}

function autoloader($class): void
{
	require_once $class . '.php';
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
