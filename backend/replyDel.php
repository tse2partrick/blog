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

$res = $conn->exec('delete from cmt_reply where id = '.$id.';');

if($res){
	echo '删除成功';
}else{
	echo '删除失败';
}
 ?>