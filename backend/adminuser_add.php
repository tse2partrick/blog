<?php 
session_start();
require_once '../common/database/conn.php';
if(empty($_SESSION['username'])){
	header('location:login.php');
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>网站后台</title>
	<style>
		.content{
			width:800px;
			margin:0 auto;
			
		}
		.banner{
			position: relative;
			background-color: #ABCDEF;
		}
		.banner_title{
			font-size: 44px;
			background-color: ;
			display: inline-block;
			float:left;
			margin-right: 20px;
		}
		.banner_function{
			display: inline-block;
			background-color: ;
			font-size: 18px;
			line-height: 20px;
			margin-right: 20px;
		}
		.banner_function > li{
			display: inline-block;
			list-style: none;
		}
		.banner_user{
			background-color:;
			font-size: 18px;
		}
		.info{
			background-color: #ABCDEF;
		}
		.info table, table tr td{
			border:1px solid;
			border-collapse: collapse;
			text-align: center;
		}
	</style>
	<script src='../jquery/jquery.js'></script>
	<script>
		$(function(){
			$('#username').prop('autofocus', '1');
			$('#username').blur(function(){
				$.ajax({
					type:'GET',
					url:'adminuser_check.php?type=user&username=' + $('#username').val(),
					success:function(message){
						$('#adminuser_check').html(message);
					}
				});
			});

			$('#password').blur(function(){
				$.ajax({
					type:'GET',
					url:'adminuser_check.php?type=pass&password=' + $('#password').val(),
					success:function(msg){
						$('#adminpass_check').html(msg);
					}
				});
			});

			$('#email').blur(function(){
				$.ajax({
					type:'GET',
					url:'adminuser_check.php?type=email&email=' + $('#email').val(),
					success:function(msg){
						$('#adminemail_check').html(msg);
					}
				});
			});

			$('#add').click(function(){
				if($('#user_check').attr('value') != 1 || $('#pass_check').attr('value') != 1 || $('#email_check').attr('value') != 1){
					alert('添加信息有误，请检查');
					if($('#user_check').attr('value') != 1){
						$('#username').focus();
					}else if($('#pass_check').attr('value') != 1){
						$('#password').focus();
					}else{
						$('#email').focus();
					}
					return false;
				}
			});
		});
	</script>
</head>
<body>
	<div class='content'>
		<div class='banner'>
			<span class='banner_title'>网站后台</span>
			<ul class='banner_function'>
				<li><a href='article.php'>文章管理</a></li>
				<li><a href='user.php'>前台用户管理</a></li>
				<li><a href='adminuser.php'>后台管理员管理</a></li>
			</ul>
			<span class='banner_user'>欢迎回来，管理员</span>
		</div>
		<br>
		您的位置：<a href="index.php">首页</a>-><a href="adminuser.php">后台用户管理</a>->添加管理员
		<br>
		<br>
		<div class='info'>
			<form action="" method='post'>
				用户名：<input type="text" id='username' name='username' maxlength='12'>
				<span id='adminuser_check'></span>
				<br>
				密&nbsp;码：<input type="password" id='password' name='password' maxlength='12'>
				<span id='adminpass_check'></span>
				<br>
				邮&nbsp;箱：<input type="text" name='email' id='email'>
				<span id='adminemail_check'></span>
				<br>
				<input type="submit" name='submit' value='添加' id='add'>
			</form>
		</div>
	</div>
</body>
</html>
<?php 
if(isset($_POST['submit'])){
	$username = htmlspecialchars(trim($_POST['username']));
	$password = md5(htmlspecialchars(trim($_POST['password'])));
	$email = htmlspecialchars(trim($_POST['email']));
/*	if(empty($username)){
		echo '<script>alert("用户名不能为空！")</script>';
		exit;
	}*/
	$stmt = $conn->prepare('select username from adminuser where username = :username');
	$stmt->bindParam(':username', $username);
	$stmt->execute();

	if($stmt->fetchAll()){
		exit;
	}

	$sql = 'insert into adminuser(username, password, email) values(:username, :password, :email)';

	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':username', $username);
	$stmt->bindParam(':password', $password);
	$stmt->bindParam(':email', $email);
	$stmt->execute();

	if($stmt->rowCount()){
		echo '<script>alert("添加成功！");window.location.href="adminuser.php"</script>';
	}

}
 ?>