<?php
if(!session_id()) {
    session_start();
}
include_once('php-graph-sdk-5.x/src/Facebook/autoload.php');
$fb = new Facebook\Facebook(array(
	'app_id' => '708463153105249', // Replace with your app id
	'app_secret' => '6f29c20c4f23905de0ab1a7f09655b3f',  // Replace with your app secret
	'default_graph_version' => 'v3.2',
));

$helper = $fb->getRedirectLoginHelper();
?>