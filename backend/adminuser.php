<?php 
session_start();
require_once '../common/database/conn.php';
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
			padding: 15px;
		}
		table tr:nth-child(even){
			background:#ABCDEF;
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
		您的位置：<a href="index.php">首页</a>->后台用户管理
		<br>
		<br>
		<div>
			<a href="adminuser_add.php">添加管理员</a>
		</div>
		<br>
		<div class='info'>
			<table>
				<tr>
					<td>管理员用户名</td>
					<td>联系邮箱</td>
					<td>操作</td>
				</tr>
			<?php 
				$sql = 'select username,email from adminuser';
				$stmt = $conn->prepare($sql);
				$stmt->execute();
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
				foreach($result as $key=>$value){
					echo '<tr>';
					foreach($value as $k=>$v){
						echo '<td>';
						echo $v;
						echo '</td>';
					}
					echo '<td><a href="adminuser_del.php?username='.$value['username'].'">删除</a></td>';
					echo '</tr>';
				}
			 ?>
			</table>
		</div>
	</div>
</body>
</html>