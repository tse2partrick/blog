<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Partrick's Site</title>
	<link rel="stylesheet" href="">
	<style>
		body{
			background-image: url('../images/background2.jpg');
			background-repeat: repeat;
		}
		.frame{
			width: 1024px;
			margin:0 auto;
			background-color: #EEE;
		}
		.content{
			
		}
		.nav_bar{

			text-align: center;
			width:100%;
			margin:0 auto;
			background-color:#484891;
		}
		.nav_bar_title{
			margin:0 30px;
			display: inline-block;
		}
		.nav_pic > img{
			width:100%;
			height:200px;
		}
		.content ul{
			
			width: 100%;
			margin: 0 auto;

		}
		.content ul > li{
			list-style: none;
			display: inline-block;
			float:;
			width:300px;
			height:300px;
			margin:10px;
		}
		.article_frame{
			width: 100%;
			height:100%;
			border:2px solid #ccc;
		}
		.article_title{
			margin:0 auto;
			width:100%;
			height: 50px;
			font-size: 25px;
			text-align: center;
			line-height: 60px;
			display: inline-block;
			font-weight: bold;
		}
		.article_content{
			text-indent: 2em;
			width: 280px;
			height:200px;
			border-top: 2px solid #ccc;
			margin:0 auto;
			margin-top:10px;
			margin-bottom: 8px;
		}
		.article_data{
			position:relative;
			width:90%;
			height:30px;
			border-top: 2px solid #ccc;
			line-height: 10px;
			text-align: right;
			margin-top: 3px;
			left:25px;
		}
		.myPagination{
			text-align: center;
		}
		.myPagination span{
			color: ;
			display: inline-block;
			width:30px;
			height: 30px;
			line-height: 30px;
			margin-right: 5px;
			background-color: #FFFFF4;
			border: 1px solid #ABCDEF;
		}
		.myPagination .myActive{
			background-color: #484891;
			color:white;
		}
		.myPagination .myActive:hover{
			background-color: #484891;
			color:white;
		}
		.myPagination span:hover{
			background-color: #C7C7E2;
			color: #484891;
		}
		.nav_bar_list{
			display: inline-block;
			height: 30px;
			line-height: 30px;
			color:white;
			width:80px;
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
			top:0px;
			width:1024px;
			margin:0 auto;
			color:white;
		}
		#allsort:hover{
			cursor: pointer;
		}
		.glyphicon_add{
			cursor: default;
		}
		.nav_bar .myActive{
			border-bottom: 3px solid white;
			color:black;
			background-color: #E6E6F2;
		}
		 .nav_bar_list_hover{
			border-bottom: 3px solid #E6E6F2;
		}
		.nav_bar_list:hover{

		}
	</style>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
	<script src='../jquery/jquery.js'></script>
	<script>
		$(function(){
			$('.myMenu').hide();
			$(window).scroll(function(){
				if($(this).scrollTop() >= 225){
					$('.nav_bar').addClass('nav_bar_add');
				}else{
					$('.nav_bar').removeClass('nav_bar_add');
				}
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
		});
	</script>
</head>
<body>
	<div class='frame'>
		<div class='nav'>
			<div class='nav_pic'><img src="../images/nav.jpg" alt=""></div>
			<br>
			<div class='nav_bar'>
					<div class='nav_bar_title'><a href='index.php'><span class='nav_bar_list'>全部</span></a></div>
					<div class='nav_bar_title'>
						<a><span id='allsort' class='nav_bar_list'>更多<span class='glyphicon glyphicon-chevron-down'></span></span></a>
						<div class='myMenu'>
							<a href="#"><div class='myMenu_title'>散文随笔</div></a>
							<a href="#"><div class='myMenu_title'>WEB技术</div></a>
						</div>
					</div>
					<!-- <div class='nav_bar_title'><a href='about_me.php'><span class='nav_bar_list myActive'>About Me</span></a></div> -->
			</div>
		</div>
		<br>
		<div class='content'>
			
		</div>
	</div>
</body>
</html>