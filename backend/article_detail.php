<?php 
session_start();
require_once '../common/database/conn.php';
if(empty($_SESSION['username'])){
	header('location:login.php');
}
//设置从首页进来GET到的参数
$title = htmlspecialchars(trim($_GET['title']));
$type = isset($_GET['type']) ? htmlspecialchars(trim($_GET['type'])) : 'all';

//分页
$everyPageShow = 10;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$sql = 'select * from art_comment where art_title=:title limit '.($current_page-1)*$everyPageShow.','.$everyPageShow;
$stmt = $conn->prepare($sql);
$stmt->bindParam(':title', $title);
$stmt->execute();
$allCommentArr = $stmt->fetchAll(PDO::FETCH_ASSOC);
$totalDataNum = (int)$conn->query('select num from cmtnumview where title="'.$title.'"')->fetch()[0];
$totalPageNum = ceil($totalDataNum / $everyPageShow);

//从数据库取出相应标题的文章
$sql = 'select * from article where title=:title';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':title', $title);
if(!$stmt->execute()){
	echo '请不要进行非法操作！';
	exit;
}
$res = $stmt->fetch(PDO::FETCH_ASSOC);

//属性标签设置
$attrArr =  ['prose' => '散文随笔', 'webtec' => 'WEB技术'];
if($res['last_change_time']){$changeTime = $res['last_change_time'];}else{$changeTime = '无修改';}

/*$allCommentArr = $conn->query('select * from art_comment where art_title="'.$res['title'].'"')->fetchAll(PDO::FETCH_ASSOC);*/
//日期--离现在多久--几分几时几天几月几年
$dateArr = [];
$resultDateArr = [];
$now = time();
for($i=1; $i<=12; $i++){
    $month[$i] = strtotime('-'.$i.'month');
}
for($i=1; $i<=count($allCommentArr); $i++){
	$dateArr[$i] = strtotime($allCommentArr[$i-1]['create_time']);
}
for($i=1; $i<=count($dateArr); $i++){
    $result = ($now-$dateArr[$i]) / 60;
    if($result>(60*24*365)){
        $resultDateArr[$i-1] = floor($result/(60*24*365)).'年前';
    }elseif($result>(60*24*30)){
        for($x=12; $x>=1; $x--){
            if($month[$x] > $dateArr[$i]){
                $resultDateArr[$i-1] = $x.'个月前';
                break;
            }
        }
    }elseif($result > (60*24)){
        $resultDateArr[$i-1] = floor($result/(60*24)).'天前';
    }elseif($result > 60){
        $resultDateArr[$i-1] = floor($result/60).'小时前';
    }elseif($result > 1){
        $resultDateArr[$i-1] = floor($result).'分钟前';
    }else{
    	$resultDateArr[$i-1] = '刚刚';
    }
}

//获取评论条数
$commentNum = $conn->query('select num from article,cmtnumview where article.title="'.$res['title'].'" and article.title=cmtnumview.title')->fetch()[0];

//插入浏览数
$sql = 'select * from art_visit where visit_ip = :ip and visit_title = :title';
$ip = $_SERVER['REMOTE_ADDR'];
$stmt = $conn->prepare($sql);
$stmt->bindParam(':ip', $ip);
$stmt->bindParam(':title',  $res['title']);
$stmt->execute();
if(!$stmt->rowCount()){
	$sql = 'insert into art_visit(visit_ip, visit_title) values(:ip, :title)';
	$stmt = $conn->prepare($sql);
	$stmt->execute([':ip'=>$ip, ':title'=>$res['title']]);
}

//这篇文章的所有回复数据
$allReplyNum = $conn->query('select * from cmtreplyview where title="'.$res['title'].'"')->fetchAll(PDO::FETCH_ASSOC);

if(!empty($allReplyNum)){
	$allReplyNumArr = [];	//每一条评论下面对应多条回复或零回复
	$allCommentIdArr = [];	//所有评论的ID值
	for($i=0; $i<count($allCommentArr); $i++){
		for($y=count($allReplyNum)-1; $y>=0; $y--){
			if($allReplyNum[$y]['comment_id'] == $allCommentArr[$i]['id']){
				array_push($allReplyNumArr,$allReplyNum[$y]['reply_num']);
				break;
			}
			if(empty($y)){
				array_push($allReplyNumArr,'0');
			}elseif($y == 0){
				array_push($allReplyNumArr,'0');
			}
		}
		array_push($allCommentIdArr, $allCommentArr[$i]['id']);
	}

	//获取每一条评论下的当前页
	$allReplyCurrentPage = [];
	for($i=0; $i<count($allCommentArr); $i++){
		if(isset($_GET['replyCurrentPage_'.$i])){
			$allReplyCurrentPage['replyCurrentPage_'.$i] = $_GET['replyCurrentPage_'.$i];
		}else{
			$allReplyCurrentPage['replyCurrentPage_'.$i] = 1;
		}
	}


	$replyEveryPageShow = 8;

	//计算有回复的评论下具体有多少回复
	$replyTotal = $conn->query('select comment_id,reply_num from cmtreplyview where title="'.$res['title'].'" order by comment_id asc')->fetchAll(PDO::FETCH_ASSOC);


	//计算每一条评论下的回复可以分多少页
	for($i=0; $i<count($allCommentIdArr); $i++){
		$replyTotalPageNum[$i] = ceil($allReplyNumArr[$i] / $replyEveryPageShow);
	}



	$everyIdReplyDataArr = [];
	for($i=0; $i<count($allCommentArr); $i++){
		if(!empty($allReplyNumArr[$i])){
			$everyIdReplyData = $conn->query('select * from cmt_reply where comment_id="'.$allCommentIdArr[$i].'" limit '.($allReplyCurrentPage['replyCurrentPage_'.$i] - 1)*$replyEveryPageShow.','.$replyEveryPageShow)->fetchAll(PDO::FETCH_ASSOC);
			array_push($everyIdReplyDataArr, $everyIdReplyData);
		}else{
			array_push($everyIdReplyDataArr, '0');
		}
	}
}else{
	$allReplyNumArr = [];	//每一条评论下面对应多条回复或零回复
	$allCommentIdArr = [];	//所有评论的ID值
	for($i=0; $i<count($allCommentArr); $i++){
		array_push($allReplyNumArr,'0');
		array_push($allCommentIdArr, $allCommentArr[$i]['id']);
	}
}


//var_dump($commentNum);		//当前页所有评论数
//var_dump($allReplyNumArr);	//当前页所有评论下的所有回复数组，键=>第几条评论，值=>评论回复数
//var_dump($allCommentIdArr);	//当前页所有评论本身的ID数组，键=>第几条评论，值=>评论自身ID
//var_dump($replyTotal);		//这篇文章带有回复的所有评论的二维数组，[[评论id=>x, 回复数=>y], [...]]
//var_dump($replyTotalPageNum);	//这篇文章所有评论如果有回复的话，回复可以分成多少页
//var_dump($everyIdReplyDataArr);	//当前页所有评论下的有回复的所有回复数据 三维数组 [第一条评论=>0, 第二条评论=>[[第一组回复内容=>[回复内容数组]]]]
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Partrick's Site</title>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
	<style>
		body{
			/* background-image: url('../images/background2.jpg'); */
			background-repeat: repeat;
		}
		.frame{
			width: 1024px;
			margin:0 auto;
			background-color: #EEE;
		}
/* 		.nav_bar{

	text-align: center;
	width:100%;
	margin:0 auto;
	background-color:#484891;
} */
		.nav_bar{
			width:100%;
			margin:0 auto;
			background-color:#484891;
		}
/* 		.nav_bar_title{
	margin:0 30px;
	display: inline-block;
} */	
		.nav_bar_title{
			display: inline-block;
			margin-right: 50px;
		}
		.nav_pic > img{
			width:100%;
			height:200px;
		}
		.nav_bar_list{
			display: inline-block;
			height: 30px;
			line-height: 30px;
			color:white;
			width:80px;
		}
		.bar{
			position: relative;
			width:100%;
			display: inline-block;
			text-align: center;
		}
		.mysearch{
			display: inline;
			position: absolute;
			height:25px;
			line-height: 23px;
			vertical-align: middle;
			left:77.2%;
			color:black;
		}
		.mysearch input{
			color:black;
		}
		.mysearch span{
			padding: 5px;
			margin-left:4px;
			vertical-align: middle;
			background-color:#E6E6F2;
			color:#999;
		}
		.mysearch span:hover{
			padding: 5px;
			margin-left:4px;
			vertical-align: middle;
			cursor: pointer;
			background-color:#E6E6F2;
			color: 	black;
		}
		.myMenu{
			position: absolute;
			display: inline-block;
			width:90px;
			background-color: #FFFFF4;
			border:1px solid #ccc;
		}
		.myMenu a:hover{
			text-decoration: none;
		}
	 	.myMenu_title{
			width:100%;
			height:40px;
			line-height: 40px;
			color:#484891;
		}
		.myMenu_title:hover{
			background-color: #E6E6F2;
		}
		.nav_bar_add{
			position: fixed;
			z-index: 100;
			top:0px;
			width:1024px;
			margin:0 auto;
			color:white;
		}
		#allsort:hover{
			cursor: pointer;
		}
		.nav_bar .myActive{
			border-bottom: 3px solid white;
			color:black;
			background-color: #E6E6F2;
		}
		 .nav_bar_list_hover{
			border-bottom: 3px solid #E6E6F2;
		}
		.article_frame{
				width: 800px;
				margin:0 auto;
		}
		.article_title{

			text-align: center;
		}
		.article_author{
			margin-right: 30px;
			
		}
		.article_create{
		}
		.article_content{
			clear:both;
			text-indent: 2em;
			padding-top: 10px;
			padding-bottom: 10px;
			margin:10px;
		}
		.article_last_change{
			position: relative;
			display: inline-block;
			float:right;
			margin-top: 20px;
			border-top: 2px solid #999;
			text-align: right;
		}
		.article_two{
			float:right;
			width:35%;
			text-align: right;
			margin-right: 10px;
		}
		.showLeftContent_hover{
			cursor: pointer;
		}
		.goTop{
			position: fixed;
			width:80px;
			height:80px;
			text-align: center;
			line-height: 80px;
			top:80%;
			left:90%;
		} 
		.article_comment{
			float:left;
			display: inline-block;
			margin-bottom: 12px;
			margin-left:39px;
			color:blue;
		}
		.article_comment:hover{
			cursor: pointer;
			color:#9393FF;
		}
		.comment_menu{
			position: relative;
			clear:both;
			float:left;
			width:650px;
			height: 100%;
			margin-bottom: 20px;
			border-radius: 5px;
			border:1px solid #E0E0E0;
		}
		.comment_menu:before{
			position: absolute;
			content:"";
			width:0;
			height:0;
			top:-10px;
			left:50px;
			border-right:5px solid transparent;
			border-left:5px solid transparent;
			border-bottom:10px solid #E0E0E0;
		}
		.comment_menu:after{
			position: absolute;
			content:"";
			width:0;
			height:0;
			top:-8px;
			left:51px;
			border-right: 4px solid transparent;
			border-left:4px solid transparent;
			border-bottom: 10px solid white;
		}
		.menu_frame{
			position: relative;
			width:90%;
			margin:0 auto;
			text-align: center;
			border-bottom: 1px solid #D0D0D0;
			margin-top:20px;
		}
		.menu_face{
			display: inline-block;
			vertical-align: top;
			margin-right: 20px;
			width:8%;
			height:8%;
		}
		.menu_face_img{
			width:100%;
			height:100%;
		}
		.menu_three{
			position: relative;
			display: inline-block;
			width:88%;
			height:100%;
			text-align: left;
		}
		.menu_three_name{
			margin-bottom: 5px;
		}
		.menu_three_floor{
			float:right;
		}
		.menu_three_content{
			word-wrap:break-word;
			margin-bottom: 5px;
		}
		.menu_three_create_time{
			color:#999;
			margin-bottom: 15px;
		}
		.writeCommentFrame{
			background-color: #F0F0F0;
			padding: 2px;
		}
		.writeComment{
			margin: 10px auto;
			width:90%;
			border:1px solid #999;
			border-radius: 5px;
			padding:10px;
			background-color: white;
		}
		.writeComment:empty:before{
			content:attr(placeholder);
			color:#999;
		}
		.writeComment:focus:before{
			content:none;
		}
		.writeReply{
			margin: 10px auto;
			width:100%;
			border:1px solid #999;
			border-radius: 5px;
			color:black;
			background-color: white;
			resize:none;
		}
		.writeComment:focus, .writeReply:focus{
			outline: none;
		}
		.goComment{
			text-align: right;
			margin-right: 37px;
			padding-bottom: 10px;
		}
		.commentFoot{
			background-color: #F0F0F0;
		}
		 .goReply{
		 	clear:both;
		 	text-align: right;
			margin-bottom: 10px;
		 }
		#goComment_down, .goReply_down{
			margin-right: 20px;
			color:#999;
		}
		#goComment_down:hover, .goReply_down:hover{
			text-decoration: none;
			cursor: pointer;
		}
		.myPagination{
			margin-top:20px;
			margin-bottom: 20px;
			text-align: center;
		}
		.myPagination a{
			margin-left:5px;
			margin-right: 5px;
		}
		.myPagination a:hover{
			text-decoration: none;
		}
		.pageActive:hover, .pageActive{
			color:#999;
		}
		.reply{
			background-color: ;
			margin-bottom: 0px;
			padding-top: 20px;
			border-bottom: 1px solid gray;
		}
		.cmt_reply{
			margin:0 8px;
			cursor: pointer;
		}
		.cmt_reply:hover{
			margin:0 8px;
			color:blue;
		}
		.replyFrame{
			position: relative;
			background-color: #F0F0F0;
			padding:15px;
			margin-bottom: 10px;
		}
		.replyFrame:before{
			position: absolute;
			content:"";
			width:0;
			height:0;
			left:80px;
			top:-8px;
			border-right:5px solid transparent;
			border-left:5px solid transparent;
			border-bottom:8px solid #F0F0F0;
		}
		.replyFace{
			display: inline-block;
			vertical-align: top;
			margin-right: 5px;
			width:7%;
			height:7%;
		}
		.replyFace_img{
			width:100%;
			height:100%;
		}
		.replyContentFrame{
			position: relative;
			display: inline-block;
			width:90%;
			margin-bottom: 10px;
		}
		
		.delReply{
			float:right;
			font-size: 15px;
			cursor:pointer;
		}
		.delReply:hover{
			color:red;
		}
		.replyContent{
			display: inline-block;
			width:100%;
			word-wrap:break-word;
			margin-bottom: 5px;
		}
		.replyTime{
			text-align: right;
			margin-bottom: 5px;
		}
		.replyPaginationFrame{
			margin-bottom: 10px;
		}
		.replyPagination{
			width:100%;
			
			display: inline-block;
			text-align: center;
			margin-top: 35px;
		}
		.replyPaginationNormal{
			background-color: #428BCA;
			padding: 5px;
			margin-left: 3px;
			margin-right: 3px;
			color:white;
		}
		.replyPaginationNormal:hover{
			background-color: #316796;
		}
		.replyPaginationActive, .replyPaginationActive:hover{
			background-color: #999;
			padding: 5px;
			margin-left: 3px;
			margin-right: 3px;
			color:white;
		}
		.replyPagination a:hover{
			text-decoration: none;
		}
		.wantReply{
			display: inline-block;
			float: right;
		}
		.wantReply:hover{
			cursor:pointer;
		}
		.replyTo{
			margin-left: 10px;
		}
		.barframe{
			height:30px;
		}
		.wrap-outer {
    		padding-left: calc(100vw - 100%);
		}
		.content{
			width:800px;
			margin:0 auto;
		}
		.banner{
			position: relative;
			background-color: #ABCDEF;
			margin-top: 10px;
		}
		.banner_title{
			font-size: 44px;
			background-color: ;
			display: inline-block;
			margin-right: 20px;
		}
		.banner_function{
			display: inline-block;
			position: relative;
			font-size: 20px;
			margin-right: 20px;
			bottom:5px;
		}
		.banner_function > li{
			display: inline-block;
			list-style: none;
		}
		.banner_user{
			position: relative;
			background-color:;
			font-size: 18px;
			bottom:5px;
		}
		.logout{
			position: relative;
			background-color:;
			font-size: 18px;
			bottom:5px;
			margin-left:3px;
		}
		.menu_three_floor{
			cursor:pointer;
		}
		.menu_three_floor:hover{
			color:red;
			cursor:pointer;
		}
	</style>

	<script src='../jquery/jquery.js'></script>
	<script src='../bootstrap/js/bootstrap.js'></script>
	<script>
		$(function(){
			var isFirst = true;

			/*//搜索
			$('#goSearch').click(function(){
				if($.trim($('#search').val()) == ''){
					$('#search').focus();
					return false;
				}

				var data = $('#search').val();
				window.location.href = 'search.php?data=' + data;
			});

			//回车键搜索
			$(window).keydown(function(event){
				if(event.keyCode == 13){
					if($.trim($('#search').val()) == ''){
						$('#search').focus();
						return false;
					}

					var data = $('#search').val();
					window.location.href = 'search.php?data=' + data;
				}
			});*/


			$("body").css("width", $(window).width()); //避免滚动条晃动页面	CSS设置overflow
			$('.myMenu').hide();
			$('.goTop').hide();
			$('.comment_menu').show();
			$('.goComment').hide();
			$('.goReply').hide();
			$('.writeReply').hide();
			$('.empty').hide();

			/*//回复所需验证码框  隐藏
			$('.modal').on('hidden.bs.modal', function(){
				 $('.yzmimg').attr('src', '../common/class/captcha_frontend.php?'+Math.random());
			});*/
			

			//回复所需验证码框  出现			失败。验证码框比模态框出现快
			/*$('.modal').on('show.bs.modal', function(){
				 var id = $(this).attr('id').split('_')[1];
				 $('#yzm'id).focus();
			});*/
			
			$('.article_comment').click(function(){
				$('.comment_menu').fadeToggle(300);
			});
			$(window).scroll(function(){
				/*if($(this).scrollTop() >= 220){
					$('.nav_bar').addClass('nav_bar_add');
				}else{
					$('.nav_bar').removeClass('nav_bar_add');
				}*/

				if($(this).scrollTop() >= 450){
					$('.goTop').show();
				}else{
					$('.goTop').hide();
				}
			});
			$('.goTop').mouseover(function(){
				$('#goTopPic').attr('src', '../images/goTopHover.jpg');
				$('#goTopPic').css({'cursor':'pointer'});
			});
			$('.goTop').mouseout(function(){
				$('#goTopPic').attr('src', '../images/goTop.jpg');
			});
			$('#allsort').click(function(e){
				$('.myMenu').slideToggle();
				e.stopPropagation();
			});

			$(window).click(function(){
				$('.myMenu').slideUp();
			});

			$('.nav_bar_list').mouseover(function(){
				$(this).addClass('nav_bar_list_hover');
			});
			$('.nav_bar_list').mouseout(function(){
					$('.nav_bar_list').removeClass('nav_bar_list_hover');
			});
			$('.myMenu_title').click(function(){
				if($(this).text() == '散文随笔'){
					window.location.href = 'index.php?type=prose';
				}
				if($(this).text() == 'WEB技术'){
					window.location.href = 'index.php?type=webtec';
				}
			});
			$('#showLeftContent').click(function(){
				$(this).hide();
				$('#leftContent').removeClass('hide');
			});
			$('#showLeftContent').mouseover(function(){
				$(this).addClass('showLeftContent_hover');
			});
			$('.goTop').click(function(){
				$(window).scrollTop(0);
			});

			//删除评论回复
			$('.delReply').click(function(){
				var delId = $(this).attr('id').split('_')[1] + '_' + $(this).attr('id').split('_')[2];
				var id = $(this).attr('id').split('_')[1];
				var replyId = $('#delReplyVal_'+delId).val();
				
				if(!confirm('您确定要删除这条回复么？')){
					return false;
				}
				
				$.ajax({
					type:'GET',
					url:'replyDel.php?id=' + replyId,
					success:function(msg){
						if(msg && msg == '删除成功'){
						window.location.href = 'article_detail.php?type=' +  $('#type').val() + '&title=' + $('#article_title').text() + '&page=' + $('#replyCurrentCmtPage').val() + '&goR=' + id + '&replyCurrentPage_'+id + '=' + $('#replyPage_'+id).val();
						}else{
							alert(msg);
						}
					}
				});
			});


/*			$('.writeComment').focus(function(){
				if(isFirst){
					$('.goComment').show();
					isFirst = false;
				}*/
				/*if($.trim($(this).text()) == '' || $.trim($(this).text()) == '写下你的评论...'){
					$(this).text('');
				}*/
			//});
			/*$('.writeComment').blur(function(){
				if($.trim($(this).text()) == ''){
					$(this).text('写下你的评论...');
				}
			});*/
/*
			$('#goComment_down').click(function(){
				$('.writeComment').text('写下你的评论...');
				$('.goComment').hide();
				isFirst = true;
			});

			$('#goComment_up_guest').click(function(){
				if($.trim($('.writeComment').text()) == ''){
					alert('评论不能为空！');
					return false;
				}*/

				//自定义评论ID
/*				$('#myModal_13').modal();

			    $('#refresh').click(function(){
			          $('#img1').attr('src', '../common/class/captcha_frontend.php?'+Math.random());
			    });
			});*/


			
/*			$('#truego').click(function(){
	          		$.ajax({
	               		type:'get',
	               		url:'yzmcheck.php?yzm=' + $('#yzm_13').val() + '&' + Math.random(),
	               		success:function(msg){
			            	$('#mysp1').text('');
			                $('#mysp1').text(msg);
			                if(msg && msg == '验证码输入错误'){
			                	$('#img1').attr('src', '../common/class/captcha_frontend.php?'+Math.random());
			                     return false;
			                }else{
			                     $('#myModal').hide();
			                     $.ajax({
									 type:'POST',
									 url:'comment_add.php',
									 data: {comment:$('.writeComment').text(), title:$('#article_title').text()},
									 success:function(msg){
										if(msg && msg=='评论成功'){
											window.location.href = 'article_detail.php?type=' +  $('#type').val() + '&title=' + $('#article_title').text() + '&page=' + $('#page').val() + '&go=true';
										}else{
											alert(msg);
										}
									 }
								});
			                }
	               		}
	          		});
    			});*/
			

			//评论总回复数标签
    		/*$('.cmt_reply').click(function(){
    			var id = $(this).attr('id').split('_')[2];
    			$('#replyFrame_'+id).toggle();
    		});

    		$('.goReply_down').click(function(){
    			var id = $(this).attr('id').split('_')[2];
    			$('#writeReply_'+id).toggle();
    			$('#writeReply_'+id).val('');
    			$('#goReply_'+id).toggle();
    		});
			$('.wantReply').click(function(){
				var id = $(this).attr('id').split('_')[1];
				if($('#writeReply_'+id).val() != ''){
					$('#writeReply_'+id).val('');
					$('#writeReply_'+id).focus();
					return false;
				}

				if($('#writeReply_'+id).is(':hidden')){
					$('#writeReply_'+id).show();
					$('#goReply_'+id).show();
					$('#writeReply_'+id).focus();
				}else{
					$('#goReply_'+id).hide();
					$('#writeReply_'+id).hide();
				}
			});
			$('.replyTo').click(function(){
				var id = $(this).attr('id').split('_')[1];
				$('#goReply_'+id).show();
				$('#writeReply_'+id).show();
				$('#writeReply_'+id).focus();
				$('#writeReply_'+id).val('回复 ' + $(this).attr('value') + '：');
			});

			$('.goReply_up_guest').click(function(){
				var id = $(this).attr('id').split('_')[3];
				if($.trim($('#writeReply_'+id).val()) == ''){
					alert('回复不能为空！');
					return false;
				}
				$('#myModal_'+id).modal(function(){
					$('#yzm_'+id).focus();
				});
			    $('#refresh_'+id).click(function(){
			          $('#img_'+id).attr('src', '../common/class/captcha_frontend.php?'+Math.random());
			    });
				
			});

			$('.truego').click(function(){
				var id = $(this).attr('id').split('_')[1];
	          		$.ajax({
	               		type:'get',
	               		url:'yzmcheck.php?yzm=' + $('#yzm_'+id).val() + '&' + Math.random(),
	               		success:function(msg){
			            	$('#mysp_'+id).text('');
			                $('#mysp_'+id).text(msg);
			                if(msg && msg == '验证码输入错误'){
			                	$('#img_'+id).attr('src', '../common/class/captcha_frontend.php?'+Math.random());
			                     return false;
			                }else{
			                     $('#myModal_'+id).hide();
			                     $.ajax({
									 type:'POST',
									 url:'cmt_reply_add.php',
									 data: {reply:$('#writeReply_'+id).val(), cmt_id:$('#cmt_id_'+id).val()},
									 success:function(msg){
										if(msg && msg=='评论成功'){
											window.location.href = 'article_detail.php?type=' +  $('#type').val() + '&title=' + $('#article_title').text() + '&page=' + $('#replyCurrentCmtPage').val() + '&goR=' + id + '&replyCurrentPage_'+id + '=' + $('#replyPage_'+id).val();
										}else{
											alert(msg);
										}
									 }
								});
			                }
	               		}
	          		});
    			});*/

				$('.menu_three_floor').click(function(){
					var id = $(this).attr('id').split('_')[3]
					var cmtId = $('#floorId_'+id).val();

					if(!confirm('您确定删除这条评论以及这条评论下的所有回复么？')){
						return false;
					}

					$.ajax({
						url:'cmtDel.php?id=' + cmtId,
						type:'GET',
						success:function(msg){
							if(msg && msg=='删除成功'){
								window.location.href = 'article_detail.php?type=' +  $('#type').val() + '&title=' + $('#article_title').text() + '&page=' + $('#page').val() + '&go=' + (id-1);
							}else{
								alert(msg);
							}
						}
					});
				});

				$('.menu_three').mouseover(function(){
					var id = $(this).attr('id').split('_')[1];
					$('#menu_three_floor_'+id).text('x');
				});

				$('.menu_three').mouseout(function(){
					var id = $(this).attr('id').split('_')[1];
					var floorText = $('#floorVal_'+id).val();
					$('#menu_three_floor_'+id).text(floorText);
				});

});
	</script>
</head>
<body>
	<?php 
		//评论后跳转到相对应的锚点
		if(isset($_GET['go'])){
			$id = $_GET['go'];
			echo "<script>window.location.hash = '#$id'</script>";
		}

		//回复评论后跳转到相对应的评论锚点
		if(isset($_GET['goR'])){
			$id = $_GET['goR'];
			echo "<script>window.location.hash = '#$id'</script>";
		}

		//删除回复后 跳转到 刚删除的界面
			for($i=0; $i<count($allReplyNumArr); $i++){
				if(!empty($allReplyNumArr[$i])){

					//如果在最后的回复页开始删除，判断下面语句，否则删除后留在本页
					if($allReplyCurrentPage['replyCurrentPage_'.$i] == $replyTotalPageNum[$i]){

						//如果没有删除到最后一条，删除后在本页，否则删除后跳到上一页
						if($allReplyNumArr[$i] % 8 != 1){
							echo '<input type="hidden" id="replyPage_'.$i.'" value="'.$allReplyCurrentPage['replyCurrentPage_'.$i].'">';
						}else{
							echo '<input type="hidden" id="replyPage_'.$i.'" value="'.($allReplyCurrentPage['replyCurrentPage_'.$i]-1).'">';
						}
					}else{
						echo '<input type="hidden" id="replyPage_'.$i.'" value="'.$allReplyCurrentPage['replyCurrentPage_'.$i].'">';
					}
				}else{
					echo '<input type="hidden" id="replyPage_'.$i.'" value="1">';
				}
			}

		//文章类型
		echo '<input id="type" type="hidden" value='.$type.' />';
		
		//当前评论页
		echo '<input type="hidden" id="replyCurrentCmtPage" value="'.$current_page.'" />';
		

		//删除评论的时候计算当前页总评论条数，如果剩下一条，判断下面语句，否则当前页
		if(count($allCommentArr) == 1){

			//如果还剩下一条的时候判断是否在评论第一页，不在第一页当前评论页码-1
			if($current_page != 1){
				$pageValue = $current_page - 1;
			}else{
				$pageValue = 1;
			}
		}else{
			$pageValue = $current_page;
		}
		echo '<input type="hidden" id="page" value="'.$pageValue.'" >';
	?>
	
	<div class='content'>
		<div class='banner'>
			<span class='banner_title'>网站后台</span>
			<ul class='banner_function'>
				<li><a href='article.php'>文章管理</a></li>
				<li><a href='user.php'>前台用户管理</a></li>
				<li><a href='adminuser.php'>后台管理员管理</a></li>
			</ul>
			<span class='banner_user'>管理员：<?php echo $_SESSION['username']; ?></span>
			<a class='logout' href="logout.php">退出</a>
		</div>
		<br>
		<br>
	</div>
		<br>
		<div class='article_frame'>
			<div class='article_title'><h1 id='article_title'><?= $res['title']; ?></h1></div>
			<div class='article_two'>
				<span class='article_author'>作者：<?= $res['author']; ?></span>
				<span class='article_create'>发表于：<?= $res['create_time'] ?></span>
			</div>
			<div class='article_content'><?php 
				if(mb_strlen($res['content'], 'utf-8') > 5000){
					$str = mb_substr($res['content'], 0, 1785, 'utf-8');
					$strLeft = mb_substr($res['content'], 1785, mb_strlen($res['content'], 'utf-8'), 'utf-8').'<span class="article_last_change" id="goArtCmt">最后修改于：'.$changeTime.'</span>';
					echo $str;
					$leftPercent = ceil((1-mb_strlen($str, 'utf-8') / mb_strlen($res['content'], 'utf-8'))*100);
					echo '<a id="showLeftContent">点击展开剩下的'.$leftPercent.'%</a>';
					echo '<span id="leftContent" class="hide">'.$strLeft.'</span>';
				}else{
					echo $res['content'].'<span class="article_last_change" id="goArtCmt">最后修改于：'.$changeTime.'</span>';
				}
			?></div>
			<div class='article_comment'>评论(<?php echo $commentNum>0 ? $commentNum : '0'; ?>)</div>

			<div class='comment_menu'>
				<?php
					for($i=0; $i<count($allCommentArr); $i++){
						//把IP第一段设为*
						$name = explode('_', $allCommentArr[$i]['name']);
						if($name[1] == '::1'){
							$ip = '站长';
						}else{
							$ip = explode('.', $name[1]);
							$ip[0] = '*';
							$ip = $name[0].'_'.implode('.', $ip);
						}
						$cmtFloor = ($current_page-1)*10 + $i + 1 . '楼';
						echo '<div class="menu_frame" id="'.$i.'">';
							echo '<div class="menu_face"><img class="menu_face_img" src="'.$allCommentArr[$i]['face'].'" /></div>';
							echo '<div class="menu_three" id="floor_'.$i.'">';
								echo '<div class="menu_three_name">'.$ip.'<span class="menu_three_floor" id="menu_three_floor_'.$i.'">'.$cmtFloor.'</span></div><input id="floorVal_'.$i.'" type="hidden" value="'.$cmtFloor.'" />';
								echo '<input type="hidden" id="floorId_'.$i.'" value="'.$allCommentIdArr[$i].'" />';
								echo '<div class="menu_three_content">'.$allCommentArr[$i]['cmt_content'].'</div>';
								echo '<div class="menu_three_create_time">'.$resultDateArr[$i].'<span " class="glyphicon glyphicon-share-alt cmt_reply" id="cmt_reply_'.$i.'">回复('.$allReplyNumArr[$i].')</span></div>';
								
								
								if(!empty($everyIdReplyDataArr[$i])){
								//有内容回复框DIV开始
									echo '<div class="replyFrame" id="replyFrame_'.$i.'">';
									foreach($everyIdReplyDataArr[$i] as $k => $v){
											echo '<input type="hidden" class="cmt_id" id="cmt_id_'.$i.'" value="'.$v['comment_id'].'" />';
											echo '<div class="reply"><div class="replyFace"><img class="replyFace_img" src="'.$v['reply_face'].'" /></div>';
												echo '<div class="replyContentFrame">';
													echo '<div class="replyName" >'.$v['reply_name'].'<span class="delReply" id="delReply_'.$i.'_'.$k.'">x</span><input id="delReplyVal_'.$i.'_'.$k.'" type="hidden" value="'.$everyIdReplyDataArr[$i][$k]['id'].'" /></div>';
													echo '<div class="replyContent">'.$v['reply_content'].'</div>';
													echo '<div class="replyTime">'.$v['reply_time'].'<span class="replyTo" id="replyTo_'.$i.'_'.$k.'" value="'.$v['reply_name'].'">回复</span></div>';
												echo '</div></div>';

											}//foreach循环结束
								?>
<!-- 
								<div class="modal fade" id="myModal_<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								    <div class="modal-dialog">
								        <div class="modal-content">
								            <div class="modal-header">
								                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								                <h4 class="modal-title" id="myModal2Label">请输入验证码</h4>
								            </div>
								            <div class="modal-body">
								                 <input type="text" class='yzm' id='yzm_<?php echo $i; ?>' maxlength='4' size='4'>
								                 <a id='refresh_<?php echo $i; ?>'><img class='yzmimg' id='img_<?php echo $i; ?>' src="../common/class/captcha_frontend.php" alt=""></a>
								                 <span id='mysp_<?php echo $i; ?>' style='color:red'></span>
								            </div>
								            <div class="modal-footer">
								                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
								                <button type="button" class="btn btn-primary truego" id='truego_<?php echo $i; ?>'>提交</button>
								            </div>
								        </div>/.modal-content
								    </div>/.modal-dialog
								</div>
							/.modal -->



				 <?php 

				 		//回复分页开始
				 		echo '<div class="replyPaginationFrame">';
								echo '<div class="replyPagination">';

								//如果当条评论下有回复数
								if(!empty($allReplyNumArr[$i])){

									//如果回复总页数小于7页
									if($replyTotalPageNum[$i] < 7){
										for($j=1; $j<=$replyTotalPageNum[$i]; $j++){

											//设置当前页样式
											if($j == $allReplyCurrentPage['replyCurrentPage_'.$i]){
												echo '<a><span class="replyPaginationActive">'.$j.'</span></a>';
											}else{
											echo '<a href="article_detail.php?type='.$type.'&title='.$res['title'].'&page='.$current_page.'&goR='.$i.'&replyCurrentPage_'.$i.'='.$j.'"><span class="replyPaginationNormal">'.$j.'</span></a>';
											}
										}
									}else{

										//当在第一到第五页的时候分页不变
										if((7 - $allReplyCurrentPage['replyCurrentPage_'.$i]) > 2){
											for($j=1; $j<=7; $j++){
													if($j == $allReplyCurrentPage['replyCurrentPage_'.$i]){
													echo '<a><span class="replyPaginationActive">'.$j.'</span></a>';
												}else{
													echo '<a href="article_detail.php?type='.$type.'&title='.$res['title'].'&page='.$current_page.'&goR='.$i.'&replyCurrentPage_'.$i.'='.$j.'"><span class="replyPaginationNormal">'.$j.'</span></a>';
												}
											}
												//显示最后一页
												echo '…';
												echo '<a href="article_detail.php?type='.$type.'&title='.$res['title'].'&page='.$current_page.'&goR='.$i.'&replyCurrentPage_'.$i.'='.$replyTotalPageNum[$i].'"><span class="replyPaginationNormal">'.$replyTotalPageNum[$i].'</span></a>';
										}else{
											//第五页之后

											//显示首页
											echo '<a href="article_detail.php?type='.$type.'&title='.$res['title'].'&page='.$current_page.'&goR='.$i.'&replyCurrentPage_'.$i.'=1"><span  class="replyPaginationNormal">1</span></a>';
											echo '…';

											//分页中间页数进行变动
											for($j=$allReplyCurrentPage['replyCurrentPage_'.$i]-2; $j<$allReplyCurrentPage['replyCurrentPage_'.$i]; $j++){
												echo '<a href="article_detail.php?type='.$type.'&title='.$res['title'].'&page='.$current_page.'&goR='.$i.'&replyCurrentPage_'.$i.'='.$j.'"><span class="replyPaginationNormal">'.$j.'</span></a>';
											}

											echo '<a><span class="replyPaginationActive">'.$allReplyCurrentPage['replyCurrentPage_'.$i].'</span></a>';

											for($j=$allReplyCurrentPage['replyCurrentPage_'.$i]+1; $j<=$allReplyCurrentPage['replyCurrentPage_'.$i]+2; $j++){
												if($j >= $replyTotalPageNum[$i]){
													break;
												}
												echo '<a href="article_detail.php?type='.$type.'&title='.$res['title'].'&page='.$current_page.'&goR='.$i.'&replyCurrentPage_'.$i.'='.$j.'"><span class="replyPaginationNormal">'.$j.'</span></a>';
											}

											//如果快到尾页
											if($replyTotalPageNum[$i] - $allReplyCurrentPage['replyCurrentPage_'.$i] > 3){
												echo '…';
												echo '<a href="article_detail.php?type='.$type.'&title='.$res['title'].'&page='.$current_page.'&goR='.$i.'&replyCurrentPage_'.$i.'='.$replyTotalPageNum[$i].'"><span class="replyPaginationNormal">'.$replyTotalPageNum[$i].'</span></a>';
											}else{
												if($allReplyCurrentPage['replyCurrentPage_'.$i] != $replyTotalPageNum[$i]){
														echo '<a href="article_detail.php?type='.$type.'&title='.$res['title'].'&page='.$current_page.'&goR='.$i.'&replyCurrentPage_'.$i.'='.$replyTotalPageNum[$i].'"><span class="replyPaginationNormal">'.$replyTotalPageNum[$i].'</span></a>';
													}
											}
										}
									}
								}
								echo '</div>';
								//echo '<div class="btn btn-primary wantReply" id="wantReply_'.$i.'">我也说一句</div>';
						echo '</div>';

						//echo '<textarea class="writeReply" id="writeReply_'.$i.'"></textarea>';
						//echo '<div id="goReply_'.$i.'" class="goReply">';
								//echo '<a class="goReply_down" id="goReply_down_'.$i.'">取消</a>';
								//echo '<button id="goReply_up_guest_'.$i.'" class="btn btn-primary goReply_up_guest">回复</button>';
						//echo '</div>';
				 	echo '</div>'; //<!-- 有内容回复框DIV -->
				 }else{
?>
<!-- 								无内容回复框开始
							<div class="replyFrame empty" id="replyFrame_<= $i ?>"> 
<input type="hidden" class="cmt_id" id="cmt_id_<= $i ?>" value=<= $allCommentArr[$i]['id']; ?>>
<div class='replyFace'></div>
<div class='replyContentFrame'>
	<div class='replyName'></div>
	<div class='replyContent'></div>
	<div class='replyTime'><span class='replyTo' id='replyTo_<= $i ?>'></span></div>
</div>
<div class='replyPaginationFrame'>
	<div class='replyPagination'></div>
	<div class='btn btn-primary wantReply' id="wantReply_<= $i ?>">我也说一句</div>
</div>
<textarea class="writeReply" id="writeReply_<= $i ?>"></textarea>
<div id="goReply_<= $i ?>" class="goReply">
<a class="goReply_down" id="goReply_down_<= $i ?>">取消</a>
<button id="goReply_up_guest_<= $i ?>" class="btn btn-primary goReply_up_guest">回复</button>
</div>
 </div>回复框DIV -->


<!-- 								<div class="modal fade" id="myModal_<php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModal2Label">请输入验证码</h4>
            </div>
            <div class="modal-body">
                 <input type="text" class='yzm' id='yzm_<php echo $i; ?>' maxlength='4' size='4'>
                 <a id='refresh_<php echo $i; ?>'><img class='yzmimg' id='img_<php echo $i; ?>' src="../common/class/captcha_frontend.php" alt=""></a>
                 <span id='mysp_<php echo $i; ?>' style='color:red'></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary truego" id='truego_<php echo $i; ?>'>提交</button>
            </div>
        </div>/.modal-content
    </div>/.modal-dialog
</div>
							/.modal -->
			<?php
				 }//if判断有没有回复
				 echo '</div>';
				echo '</div>';

			}//评论for循环
				  ?>
				<div class='myPagination'>
					<?php 
						$pagination = 7;

						if($totalPageNum < $pagination){
							for($i=1; $i<=$totalPageNum; $i++){
								if($i == $current_page){
									echo '<a class="pageActive">'.$i.'</a>';
								}else{
									echo '<a href="article_detail.php?type='.$type.'&title='.$title.'&page='.$i.'&#goArtCmt">'.$i.'</a>';
								}
							}
						}else{
							if($current_page+2 <= $pagination){
								if($current_page > 0 && $current_page == 1){
									echo '<a class="pageActive">上一页</a>';
								}else{ 
									echo '<a href="article_detail.php?type='.$type.'&title='.$title.'&page='.($current_page-1).'&#goArtCmt">上一页</a>';
								}
								for($i=1; $i<=$pagination; $i++){
									if($i == $current_page){
										echo '<a class="pageActive">'.$i.'</a>';
									}else{
										echo '<a href="article_detail.php?type='.$type.'&title='.$title.'&page='.$i.'&#goArtCmt">'.$i.'</a>';
									}
								}
								echo '…';
								echo '<a href="article_detail.php?type='.$type.'&title='.$title.'&page='.$totalPageNum.'&#goArtCmt">'.$totalPageNum.'</a>';
								if($current_page < $totalPageNum && $current_page > 0){
									echo '<a href="article_detail.php?type='.$type.'&title='.$title.'&page='.($current_page+1).'&#goArtCmt">下一页</a>';
								}else{
									echo '<a class="pageActive">下一页</a>';
								}
							}else{
								if($current_page > 0 && $current_page == 1){
									echo '<a class="pageActive">上一页</a>';
								}else{ 
									echo '<a href="article_detail.php?type='.$type.'&title='.$title.'&page='.($current_page-1).'&#goArtCmt">上一页</a>';
								}
								echo '<a href="article_detail.php?type='.$type.'&title='.$title.'&page=1&#goArtCmt">1</a>';
								echo '…';
								for($i=$current_page-floor($pagination/2); $i<$current_page; $i++){
									echo '<a href="article_detail.php?type='.$type.'&title='.$title.'&page='.$i.'&#goArtCmt">'.$i.'</a>';
								}
								echo '<a class="pageActive">'.$current_page.'</a>';

								for($i=$current_page+1; $i<=$current_page+2; $i++){
									if($i >= $totalPageNum){
										break;
									}
									echo '<a href="article_detail.php?type='.$type.'&title='.$title.'&page='.$i.'&#goArtCmt">'.$i.'</a>';
								}
								if($totalPageNum - $current_page > floor($pagination/2)){
									echo '…';
									echo '<a href="article_detail.php?type='.$type.'&title='.$title.'&page='.$totalPageNum.'&#goArtCmt">'.$totalPageNum.'</a>';
								}elseif($totalPageNum - $current_page >= 1){
									echo '<a href="article_detail.php?type='.$type.'&title='.$title.'&page='.$totalPageNum.'&#goArtCmt">'.$totalPageNum.'</a>';
								}
								if($current_page < $totalPageNum && $current_page > 0){
									echo '<a href="article_detail.php?type='.$type.'&title='.$title.'&page='.($current_page+1).'&#goArtCmt"> 下一页</a>';
								}else{
									echo '<a class="pageActive">下一页</a>';
								}
							}
						}
					 ?>
				</div>
<!-- 				<div class="commentFoot">
	<div class='writeCommentFrame'>
		<div class='writeComment' contenteditable='true' placeholder='请写下你的评论...'></div>
	</div>
	<div class='goComment'>
		<a id='goComment_down'>取消</a>
		<button id='goComment_up_guest' class='btn btn-primary'>评论</button>
	</div>
</div> -->
			</div>
		</div>
	</div>
	
	<div class='goTop'><a title="回到顶部"><img id='goTopPic' src="../images/goTop.jpg" alt="" /></a></div>

<!-- 	<div class="modal fade" id="myModal_13" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">请输入验证码</h4>
            </div>
            <div class="modal-body">
                 <input type="text" id='yzm_13' class='yzm' maxlength='4' size='4'>
                 <a id='refresh'><img id='img1' class='yzmimg' src="../common/class/captcha_frontend.php" alt=""></a>
                 <span id='mysp1' style='color:red'></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" id='truego'>提交</button>
            </div>
        </div>/.modal-content
    </div>/.modal-dialog
</div>
/.modal -->
</body>
</html>