<?php 
session_start();
require_once '../common/database/conn.php';
if(empty($_SESSION['username'])){
	header('location:login.php');
}
$sql = 'select last_login_time, last_login_ip from adminuser where username=:username';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $_SESSION['username']);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$last_login_time = $result[0]['last_login_time'];
$last_login_ip = $result[0]['last_login_ip'];
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
			
		}
		table, table tr td{
			border:1px solid;
			border-collapse: collapse;
			text-align: center;
			margin:0 auto;
			padding: 20px;
		}
	</style>
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
			<span class='banner_user'>管理员：<?php echo $_SESSION['username']; ?></span>
			<a href="logout.php">退出</a>
		</div>
		<br>
		<br>
		<div class='info'>
			<center><h3>欢迎回来，管理员<?= $_SESSION['username']; ?></h3></center>
			<table>
				<tr>
					<td>上次登录时间：</td>
					<td><?= $last_login_time; ?></td>
				</tr>
				<tr>
					<td>上次登录地点：</td>
					<td><?= $last_login_ip; ?></td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>