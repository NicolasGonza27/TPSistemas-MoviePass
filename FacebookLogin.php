<?php 

include_once(ROOT.'fb-config.php');
if(isset($_SESSION['fbUserId']) and $_SESSION['fbUserId']!=""){
	header('location: http://localhost/dashboard/TPSistemas-MoviePass/Home/ShowHomeClientViews');
	exit;
}

$permissions = ['email'];
$loginUrl = $helper->getLoginUrl('http://localhost/dashboard/TPSistemas-MoviePass/fb-callback.php', $permissions);
$_SESSION['loginUrl'] = $loginUrl;

?>
