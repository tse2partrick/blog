<?php 
$dsn = 'mysql:host=localhost;dbname=test2;';
$user = 'root';
$pass = 'abcdef';

try{
	$conn = new PDO($dsn, $user, $pass);
	$conn->query('set names utf8');
	//$conn->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);		//设置关闭自动提交，让PDO无法execute改动数据库内容
	//$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	//设置错误模式，实现事务处理
}catch(PDOException $e){
	echo 'PDO连接失败！'.$e->getMessage();
}
 ?>
