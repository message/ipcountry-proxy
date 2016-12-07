<?php

error_reporting(0);

require_once 'vendor/autoload.php';

use Desarrolla2\Cache\Adapter\File;
use Desarrolla2\Cache\Cache;

$adapter = new File(__DIR__ . DIRECTORY_SEPARATOR . "cache");
$cache = new Cache($adapter);

$ip = $_SERVER['REMOTE_ADDR'];
$ipKey = "cache_ip_{$ip}";


if ( ! $cache->has($ipKey)) {
	$data = file_get_contents("https://ipinfo.io/{$ip}/json");
	if ($data == false) {
		header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
		return;
	}
	$cache->set($ipKey, $data, 5 * 60);
}

header('Content-Type: application/json');
echo $cache->get($ipKey);