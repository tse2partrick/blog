<?php 
session_start();
if(empty($_SESSION['username'])){
	echo '请不要尝试非法操作！';
	exit;
}
require_once '../common/database/conn.php';
$title = htmlspecialchars(trim($_GET['title']));

//判断文章下面有没有评论
$hasComment = $conn->query('select id from art_comment where art_title="'.$title.'"')->fetchAll(PDO::FETCH_ASSOC);

if($hasComment){

	//循环所有评论看有没有回复
	for($i=0; $i<count($hasComment); $i++){
		$hasReply = $conn->query('select id from cmt_reply where comment_id='.$hasComment[$i]['id'].'')->fetchAll();

		//如果有回复就删除回复
		if($hasReply){
			$conn->exec('delete from cmt_reply where comment_id = '.$hasComment[$i]['id'].'');
		}

		//删除没有回复的评论
		$conn->exec('delete from art_comment where id='.$hasComment[$i]['id'].'');
	}
}

//删除浏览数
$conn->exec('delete from art_visit where visit_title = "'.$title.'"');

$res = $conn->exec('delete from article where title="'.$title.'"');
if($res){
	echo '删除成功';
}else{
	echo '删除失败';
}
 ?>