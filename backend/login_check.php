<?php 
session_start();
@$refer = $_SERVER['HTTP_REFERER'];
if($refer != 'http://localhost/test2/backend/login.php'){
	die('请从登录页面进行登录！');
}
require_once '../common/database/conn.php';
var_dump($_REQUEST);
var_dump($_SESSION);
if(empty($_POST['username']) || empty($_POST['password'])){
	echo '<script>alert("用户名和密码不能为空！");window.location.href="login.php"</script>';
	exit;
}
 ?>