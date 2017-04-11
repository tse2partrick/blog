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
		a:link{
			text-decoration: none;
		}
		a{
			color:blue;
		}
		a:hover{
			color:#000079;
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
			<span class='banner_user'>管理员：<?= $_SESSION['username']; ?></span>
			<a href="logout.php">退出</a>
		</div>
		<br>
		您的位置：<a href="index.php">首页</a>-><a href="article.php">文章管理</a>->添加文章
		<br>
		<br>
		<div class='info'>
			<form action="" method='post'>
				文章标题：<input type="text" name='title' autofocus='1'>
				<br>
				文章内容：<textarea name="content" cols="30" rows="10"></textarea>
				<br>
				文章分类：<select name="type" id="type">
					<option value="prose">散文随笔</option>
					<option value="webtec">WEB技术</option>
				</select>
				<br>
				<input type="submit" name='submit' value='添加'>
			</form>
		</div>
	</div>
</body>
</html>
<?php 
if(isset($_POST['submit'])){
	$title = $_POST['title'];
	$author = $_SESSION['username'];
	$content = $_POST['content'];
	$type = $_POST['type'];
	$create_time = date('Y-m-d H:i:s', time());

	$sql = 'insert into article(title, author, content, create_time, art_type) values(:title, :author, :content, :createTime, :type)';
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':title', $title);
	$stmt->bindParam(':author', $author);
	$stmt->bindParam(':content', $content);
	$stmt->bindParam(':createTime', $create_time);
	$stmt->bindParam(':type', $type);
	$stmt->execute();
	if($stmt->rowCount()){
		echo '<script>alert("文章添加成功！");window.location.href="article.php";</script>';
	}else{
		echo '<script>alert("文章添加失败！");window.location.href="article.php";</script>';
	}
}
 ?>