<?php
session_start();
require_once '../common/database/conn.php';

if($_SESSION['yzmcheck'] == false){
	exit;
}
$content = $_POST['comment'];
$title = $_POST['title'];
$ip = $_SERVER['REMOTE_ADDR'];
$name = $ip == '::1' ? '站长_::1' : '匿名网友_'.$_SERVER['REMOTE_ADDR'];
if($ip == '::1'){
	$face = '../images/123.jpg';
}elseif($res = $conn->query('select face from art_comment where name="匿名网友_'.$ip.'"')->fetch()[0]){
	$face = $res;
}else{
	$face = '../images/'.rand(1,30).'.jpg';
}
$cmt_createtime = date('Y-m-d H:i:s', time());

$sql = 'insert into art_comment(face, name, cmt_content, create_time, art_title) values(:face, :name, :content, :createtime, :title)';
$stmt = $conn->prepare($sql);
$dataArr = [':face'=>$face, ':name'=>$name, ':content'=>$content, ':createtime'=>$cmt_createtime, ':title'=>$title];
$stmt->execute($dataArr);
if($stmt->rowCount()){
	echo '评论成功';
}else{
	echo '评论失败';
}
 ?>