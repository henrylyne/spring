<?php

include 'lib/curl.php';
require_once('class/Spring.php');

# If we have a URL to fetch
if ($_GET["url"] != null) {

	include "include/header.html";

	# Don't allow the hosting site to be called, to avoid an endless loop.
	$pos = strpos($_GET["url"], $_SERVER['HTTP_HOST']);
	if ($pos !== false) {
		echo("You can't fetch URLs under " . $_SERVER['HTTP_HOST'] . ".<br/>");
		return;
	}

	# Get the URL
	echo("<h1>" . htmlspecialchars($_GET["url"]) . "</h1>\n");
	$response = curl_get($_GET["url"]);
	
	# Fail if not a 200 status
	if ($response['http_status'] != 200) {
		echo("The URL " . htmlspecialchars($_GET["url"]) . " returned an HTTP status code of " . $response['http_status'] . "<br/>\n");
		return;
	}

	$pageHTML = new Spring($response['content']);
	# Get a hash of HTML elements [Element, Count]
	echo("<div class='tag_cloud'>\n");
	$elements = $pageHTML->getElementCounts();
	foreach ($elements as $tag => $count) {
		echo("<span class='tags' id='$tag'>" . htmlspecialchars($tag) . " :: " . htmlspecialchars($count) . "</span>\n");
	}
	echo("</div>\n");


	# Display the HTML source
	echo("<div class='html_source'>\n");
	echo($pageHTML->display());
	echo("\n</div>\n");

	include "include/footer.html";
	
# No URL, redirect to home page
} else {
	header('Location: index.html');
}
?>