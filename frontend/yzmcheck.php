<?php 
session_start();
$yzm = $_GET['yzm'];
if($yzm != $_SESSION['captcha_frontend']){
	echo '验证码输入错误';
	exit;
}
$_SESSION['yzmcheck'] = true;
 ?>