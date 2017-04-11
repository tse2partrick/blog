<?php 
require_once '../common/database/conn.php';
if(empty($_SESSION['username'])){
	header('location:login.php');
}
if(isset($_GET['type']) && $_GET['type'] == 'user'){
	if(isset($_GET['username']) && !empty($_GET['username'])){
		if(strlen($_GET['username']) > 12){
			echo '<span style="color:red">用户名超出12个字符</span>';
			exit;
		}
		$username = htmlspecialchars(trim($_GET['username']));
		$sql = 'select username from adminuser where username = :username';
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':username', $username);
		$stmt->execute();
		if($stmt->fetchAll()){
			echo '<span style="color:red">此用户名已存在</span>';
		}else{
			echo '<span style="color:blue">用户名可用</span>';
			echo '<input type="hidden" id="user_check" value="1">';
		}
	}else{
		echo '<span style="color:red">用户名不能为空</span>';
	}
}

if(isset($_GET['type']) && $_GET['type'] == 'pass'){
	if(isset($_GET['password']) && !empty($_GET['password'])){
		if(strlen($_GET['password']) > 12 or strlen($_GET['password']) < 6){
			echo '<span style="color:red">密码请设置在6-12个字符之间</span>';
			exit;
		}
		echo '<span style="color:blue">OK</span>';
		echo '<input type="hidden" id="pass_check" value="1">';
	}else{
		echo '<span style="color:red">密码不能为空</span>';
	}
}

if(isset($_GET['type']) && $_GET['type'] == 'email'){
	$pattern = '/^([0-9a-z_-])+@([0-9a-z])+\.[a-z.]+$/';
	$email = trim($_GET['email']);
	if(!preg_match($pattern, $email)){
		echo '<span style="color:red">请输入正确的邮箱！</span>';
		exit;
	}
	echo '<span style="color:blue">OK</span>';
	echo '<input type="hidden" id="email_check" value="1">';
}
 ?>