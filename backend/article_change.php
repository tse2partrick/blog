<?php 
session_start();
if(empty($_SESSION['username'])){
	header('location:login.php');
}
require_once '../common/database/conn.php';
$title = htmlspecialchars(trim($_GET['title']));
$sql = 'select * from article where title = :title';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':title', $title);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$artID = $result['id'];
$artTitle = $result['title'];
$artAuthor = $result['author'];
$artContent = $result['content'];
$artCreateTime = $result['create_time'];
$artChangeTime = $result['last_change_time'];
$artType = $result['art_type'];
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
		a{
			color:blue;
		}
		a:hover{
			color:#000079;
		}
		a:link{
			text-decoration: none;
		}
	</style>
	<script src='../jquery/jquery.js'></script>
	<script>
		$(function(){
			$('#goBack').click(function(){
				window.location.href='article.php';
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
			<span class='banner_user'>管理员：<?= $_SESSION['username'] ?></span>
			<a href="logout.php">退出</a>
		</div>
		<br>
		您的位置：<a href="index.php">首页</a>-><a href="article.php">文章管理</a>->修改文章
		<br>
		<br>
		<div class='info'>
			<form action="" method='post'>
				文章标题：<input type="text" name='title' autofocus='1' value=<?= $artTitle; ?>>
				<br>
				文章内容：<textarea name="content" cols="30" rows="10"><?= $artContent; ?></textarea>
				<br>
				所属分类：<?php
					if($artType == 'prose'){
						echo '<select name="type" id="type">';
						echo '<option value="prose" selected="selected">散文随笔</option>';
						echo '<option value="webtec">Web技术</option>';
						echo '</select>';
					}
					if($artType == 'webtec'){
						echo '<select name="type" id="type">';
						echo '<option value="prose">散文随笔</option>';
						echo '<option value="webtec"  selected="selected">Web技术</option>';
						echo '</select>';
					}
				?>
				<br>
				<input type="submit" name='submit' value='修改'>
				<input type='button' id='goBack' value='返回'>
			</form>

		</div>
	</div>
</body>
</html>
<?php 
if(isset($_POST['submit'])){
	$newTitle = $_POST['title'];
	$author = $_SESSION['username'];
	$newContent = $_POST['content'];
	$last_change_time = date('Y-m-d H:i:s', time());
	$art_type = $_POST['type'];
	$sql = 'update article set title=:title, author=:author, content=:content, last_change_time=:last_change_time, art_type=:type where id=:id';
	//$changeArr = [':title'=>$newTitle, ':author'=>$author, ':content'=>$newContent, ':last_change_time'=>$last_change_time, ':id'=>$artID];
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':title', $newTitle);
	$stmt->bindParam(':author', $author);
	$stmt->bindParam(':content', $newContent);
	$stmt->bindParam(':last_change_time', $last_change_time);
	$stmt->bindParam(':id', $artID);
	$stmt->bindParam(':type', $art_type);
	$stmt->execute();
	if($stmt->rowCount()){
		echo '<script>alert("文章修改成功！");window.location.href="article.php";</script>';
	}else{
		echo '<script>alert("文章修改失败！");window.location.href="article.php";</script>';
	}
}
 ?>