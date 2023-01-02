<?php

function debug(array|string $data): void
{
	echo '<pre>' . print_r($data, true) . '</pre>';
}

function autoloader($class): void
{
	require_once $class . '.php';
}
