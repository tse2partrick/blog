<?php 
require_once '../common/database/conn.php';

$title = '第一篇文章';
$res = $conn->query('select * from article where title="'.$title.'"')->fetchAll();

var_dump($res);
 ?>