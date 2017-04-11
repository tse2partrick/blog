<?php 
session_start();
require_once '../common/database/conn.php';
if(empty($_SESSION['username'])){
	header('location:login.php');
}

if(!isset($_GET['id'])){
	exit;
}

$id = htmlspecialchars(trim($_GET['id']));

//先查询这条评论下有没有回复
$hasReply = (int)$conn->query('select * from cmt_reply where comment_id = "'.$id.'"')->fetch();

//如果没有评论
if(!$hasReply){
	$res = $conn->exec('delete from art_comment where id = "'.$id.'"');
}else{
	//如果有回复，先删除回复，在删除评论
	$res = $conn->exec('delete from cmt_reply where comment_id = "'.$id.'"');
	if($res){
		$res = $conn->exec('delete from art_comment where id = "'.$id.'"');
	}
}

if($res){
	echo '删除成功';
}else{
	echo '删除失败';
}
 ?>