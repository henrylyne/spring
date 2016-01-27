<?php

#
# Fetch a URL and return the status and HTML
#
function curl_get($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$content = curl_exec($ch);
	$info = curl_getinfo($ch);
	curl_close($ch);
	return array('http_status' => $info['http_code'], 'content' => $content);
}

?>