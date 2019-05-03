<?php

//
// ini_set('display_errors', 1);
//

header('Access-Control-Allow-Origin: *');
date_default_timezone_set('Asia/Tokyo');

//

require_once '../vendor/autoload.php';

use \Ramsey\Uuid\Uuid;
define('FIREBASE_URL', 'https://myfirstfirebase-8a01a.firebaseio.com');
define('FIREBASE_TOKEN', ''); // FIREBASE_TOKEN from Firebase

//

$firebase = new \Firebase\FirebaseLib(FIREBASE_URL, FIREBASE_TOKEN);

//

if (isset($_POST['userId'])) {
	$userId = $_POST['userId'];
}
else {
	$userId = 'not provided';
}

if (isset($_POST['created'])) {
	$created = $_POST['created'];
}

if (isset($created) && ($created == 'true')) {
	$createdAt = microtime(true);
	$createdAt = str_replace('.', '', $createdAt);
	$createdAt = substr($createdAt, 0, -1);
}

if (isset($_SERVER['HTTP_USER_AGENT'])) {
	$ua = $_SERVER['HTTP_USER_AGENT'];
}
else {
	$ua = 'not provided';
}

if (isset($_SERVER['REMOTE_HOST'])) {
	$remote = $_SERVER['REMOTE_HOST'];
}
else {
	$remote = 'not provided';
}

$accessId = Uuid::uuid4();
$timestamp = microtime(true);
$timestamp = str_replace('.', '', $timestamp);
$timestamp = substr($timestamp, 0, -1);

if (isset($_POST['href'])) {
	$href = $_POST['href'];
}
else {
	$href = 'not provided';
}

if (isset($_POST['referrer']) && !empty($_POST['referrer'])) {
	$referrer = $_POST['referrer'];
}
else {
	$referrer = 'not provided';
}

if (isset($_SERVER['REMOTE_ADDR'])) {
	$ip = $_SERVER['REMOTE_ADDR'];
}
else {
	$ip = 'not provided';
}

$date = date(DATE_RFC2822);

//

$firebase->set('/accesses/' . $accessId, array(
	'accessId' => $accessId,
	'userId' => $userId,
	'href' => $href,
	'referrer' => $referrer,
	'date' => $date,
	'timestamp' => $timestamp
));

if (isset($createdAt)) {
	$firebase->set('/users/' . $userId, array(
		'userId' => $userId,
		'ua' => $ua,
		'ip' => $ip,
		'remote' => $remote,
		'date' => $date,
		'timestamp' => $timestamp
	));
	$firebase->update('/users/' . $userId, array(
		'createdAt' => $createdAt
	));
}
else {
	$firebase->set('/users/' . $userId, array(
		'userId' => $userId,
		'ua' => $ua,
		'ip' => $ip,
		'remote' => $remote,
		'date' => $date,
		'timestamp' => $timestamp
	));
}
