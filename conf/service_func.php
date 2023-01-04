<?php

function debug(array|string $data): void
{
	echo '<pre>' . print_r($data, true) . '</pre>';
}

function autoloader($class): void
{
	require_once $class . '.php';
}

function getListFiles(string $path): array
{
	$list_files = [];
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
