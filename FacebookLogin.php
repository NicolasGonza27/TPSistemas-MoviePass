<?php 

include_once(ROOT.'fb-config.php');

$permissions = ['email'];
$loginUrl = $helper->getLoginUrl('http://localhost/dashboard/TPSistemas-MoviePass/fb-callback.php', $permissions);
$_SESSION['loginUrl'] = $loginUrl;

?>
