<?php 
session_start();
@$refer = $_SERVER['HTTP_REFERER'];
if($refer != 'http://localhost/test2/backend/adminuser.php'){
	echo '请不要尝试非法操作！';
	exit;
}
if(empty($_SESSION['username'])){
	header('location:login.php');
}
$username = $_GET['username'];
if(!empty($username)){
	require_once '../common/database/conn.php';
	$sql = 'delete from adminuser where username = :username';
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':username', $username);
	$stmt->execute();
	if($stmt->rowCount()){
		echo '<script>alert("删除成功！");window.location.href="adminuser.php";</script>';
	}
}
 ?>