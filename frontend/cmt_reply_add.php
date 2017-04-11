<?php
require_once '../common/database/conn.php';
$replyContent = $_POST['reply'];
$cmt_id = $_POST['cmt_id'];
$ip = $_SERVER['REMOTE_ADDR'];
$name = $ip == '::1' ? '站长_::1' : '匿名网友_'.$_SERVER['REMOTE_ADDR'];
if($ip == '::1'){
	$face = '../images/123.jpg';
}elseif($res = $conn->query('select face from art_comment where name="匿名网友_'.$ip.'"')->fetch()[0]){
	$face = $res;
}else{
	$face = '../images/'.rand(1,30).'.jpg';
}
$replyCreatetime = date('Y-m-d H:i:s', time());

$sql = 'insert into cmt_reply(reply_name, reply_face, reply_content, reply_time, comment_id) values(:name, :face, :content, :time, :id)';
$stmt = $conn->prepare($sql);
$dataArr = [':name'=>$name, ':face'=>$face, ':content'=>$replyContent, ':time'=>$replyCreatetime, ':id'=>$cmt_id];
$stmt->execute($dataArr);
if($stmt->rowCount()){
	echo '评论成功';
}else{
	echo '评论失败';
}
 ?>