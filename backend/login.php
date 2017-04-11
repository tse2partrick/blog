<?php 
session_start();
require_once '../common/database/conn.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台登录</title>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
	<script src='../jquery/jquery.js'></script>
	<script>
		$(function(){
			$('#username').focus();
		});
	</script>
</head>
<body>
	<div id='login-form'>
		<form action="" method='post'>
			<span>用户名:</span>
			<input type="text" name='username' id='username'>
			<br>
			<br>
			<span>密&nbsp;&nbsp;&nbsp;&nbsp;码:</span>
			<input type="password" name='password' id='password'>
			<br>
			<br>
			<span>验证码:</span>
			<input type="text" name='captcha' maxlength='4' size='4' id='captcha'>
			<img src="../common/class/captcha_backend.php" alt="">
			<br>
			<br>
			<input type="submit" name='submit' value='登录'>
		</form>
	</div>
</body>
</html>
<?php 
if(isset($_POST['submit'])){
	$username = htmlspecialchars(trim($_POST['username']));
	$password = md5(htmlspecialchars(trim($_POST['password'])));
	$captcha = htmlspecialchars(trim($_POST['captcha']));
	if(empty($_POST['username']) || empty($_POST['password'])){
		echo '<script>alert("用户名或密码不能为空！")</script>';
		exit;
	}
	if(empty($captcha) || $captcha!==$_SESSION['captcha_backend']){
		echo '<script>alert("验证码错误！")</script>';
		exit;
	}
	$sql = 'select username from adminuser where username=:username and password=:password';
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':username', $username);
	$stmt->bindParam(':password', $password);
	$stmt->execute();
	if($stmt->rowCount()){
		$_SESSION['username'] = $username;
		//更新最后登录时间地点
		$sql = 'select login_time, login_ip from adminuser where username=:username';
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':username', $username);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$lastTime = $result[0]['login_time'];
		$lastIp = $result[0]['login_ip'];
		$sql = 'update adminuser set last_login_time = :lastTime, last_login_ip = :lastIp where username = :username';
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':lastTime', $lastTime);
		$stmt->bindParam(':lastIp', $lastIp);
		$stmt->bindParam(':username', $username);
		$stmt->execute();
		//更新当前登录时间地点
		$loginTime = date('Y-m-d H:i:s', time());
		$loginIp = $_SERVER['REMOTE_ADDR'];
		$sql = 'update adminuser set login_time = :logintime, login_ip = :loginip where username=:username';
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':logintime', $loginTime);
		$stmt->bindParam(':loginip', $loginIp);
		$stmt->execute();
		header('location:index.php');
	}else{
		echo '<script>alert("用户名或密码错误！")</script>';
	}
}
 ?>