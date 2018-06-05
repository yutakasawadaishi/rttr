<?php

//
// ini_set('display_errors', 1);
//

require_once '../../vendor/autoload.php';

//

$userId = $_POST['userId'];
$ua = $_POST['ua'];
$ip = $_POST['ip'];
$remote = $_POST['remote'];
$date = $_POST['date'];
$accesses = $_POST['accesses'];

//

$sorts = array();

foreach($accesses as $k => $v) {
	$sorts[$k] = $v['timestamp'];
}

array_multisort($sorts, SORT_DESC, $accesses);

//

function getItem($userId, $ua, $ip, $remote, $itemsLength, $items, $date)
{
	return "<div class=\"item\"><div class=\"heading\"><div class=\"title\">@${userId}</div><div class=\"attr\">${date}</div></div><div class=\"item\"><div class=\"text\"><div class=\"head\">UA</div>${ua}</div></div><div class=\"item\"><div class=\"text\"><div class=\"head\">IP</div>${ip}</div></div><div class=\"item\"><div class=\"text\"><div class=\"head\">REMOTE</div>${remote}</div></div><div class=\"item\"><div class=\"heading js-hidden-button\"><div class=\"title\">ACCESSES</div><div class=\"attr\">(${itemsLength})</div></div><div class=\"items js-hidden-item\">${items}</div></div></div>";
}

function getItems($accessId, $href, $referrer, $date)
{
	return "<div class=\"item\"><div class=\"heading\"><div class=\"title\">#${accessId}</div><div class=\"attr\">${date}</div></div><div class=\"text\"><div class=\"head\">href</div><a class=\"href\" href=\"${href}\" target=\"_blank\">${href}</a></div><div class=\"text\"><div class=\"head\">referrer</div><a class=\"href\" href=\"${referrer}\" target=\"_blank\">${referrer}</a></div></div>";
}

//

$items = '';
$itemsLength = count($accesses);

foreach($accesses as $access) {
	$items.= getItems($access['accessId'], $access['href'], $access['referrer'], $access['date']);
}

echo getItem($userId, $ua, $ip, $remote, $itemsLength, $items, $date);