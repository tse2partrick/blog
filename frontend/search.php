<?php 
require_once '../common/database/conn.php';

//获取数据
if(!isset($_GET['data'])){
	exit;
}
$data = htmlspecialchars(trim($_GET['data']));



//设置默认属性
$type = isset($_GET['type']) ? $_GET['type'] : 'all';

//分页需要
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

//分类分页显示文章数据
$everyPageShow = 8;

	$sql = 'select title, content, create_time from article where title like "%'.$data.'%" limit '.($currentPage-1)*$everyPageShow.','.$everyPageShow;
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$totalDataNum = (int)$conn->query('select count(*) from article where title like "%'.$data.'%"')->fetch()[0];

$totalPageNum = ceil($totalDataNum / $everyPageShow);


//获取评论条数
$cmtNum = [];
for($i=0; $i<count($res); $i++){
	$sql = 'select num from article,cmtnumview where article.title="'.$res[$i]['title'].'" and article.title=cmtnumview.title';
	$result = $conn->query($sql)->fetch()[0];
	if(empty($result)){
		array_push($cmtNum, '0');
	}else{
		array_push($cmtNum, $result);
	}
}

//for循环前先获取循环总数
$artNum = count($res);

//设置标签属性
$attrArr =  ['prose' => '散文随笔', 'webtec' => 'WEB技术'];

//获取浏览数
$visitNum = [];
for($i=0; $i<count($res); $i++){
	$sql = 'select num from article, artvisitnum where article.title="'.$res[$i]['title'].'" and article.title=artvisitnum.title';
	$result = $conn->query($sql)->fetch()[0];
	if(empty($result)){
		array_push($visitNum, '0');
	}else{
		array_push($visitNum, $result);
	}
}
 ?>
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
			/* width:1024px; */
			width: 100%;
			margin:0 auto;
			background-color: #EEE;
		}
		.nav_bar{
			width:100%;
			margin:0 auto;
			background-color:#484891;
		}
		.nav_bar_title{
			display: inline-block;
			margin-right: 50px;
		}
		.nav_pic > img{
			width:100%;
			height:200px;
		}
		.content ul{
			width: 100%;
			margin: 0 auto;
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
			/* width:1024px; */
			width:100%;
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
		.fRight{
			float:right;
		}
		.barframe{
			height:30px;
		}
	</style>
	<link rel="stylesheet" href="../../../bootstrap/css/bootstrap.css">
	<script src='../../../jquery/jquery.js'></script>
	<script>
		$(function(){
			$('.myMenu').hide();
			$(window).scroll(function(){
				if($(this).scrollTop() >= 220){
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
					window.location.href = '/index/prose/1.html';
				}
				if($(this).text() == 'WEB技术'){
					window.location.href = '/index/webtec/1.html';
				}
			});

			$('#goSearch').click(function(){
				if($.trim($('#search').val()) == ''){
					$('#search').focus();
					return false;
				}

				var data = $('#search').val();
				window.location.href = '/search/' + $('#mytype').val() + '/' + data + '/1';
			});

			//回车键搜索
			$(window).keydown(function(event){
				if(event.keyCode == 13){
					if($.trim($('#search').val()) == ''){
						$('#search').focus();
						return false;
					}

					var data = $('#search').val();
					window.location.href = '/search/' + $('#mytype').val()  + '/' + data + '/1';
				}
			});
		});
	</script>
</head>
<body>
	<?php echo '<input type="hidden" id="mytype" value="'.$type.'" />'; ?>
	<div class='headnav'></div>
	<div class='frame'>
		<div class='nav'>
			<div class='nav_pic'><img src="../../../images/nav.jpg" alt=""></div>
			<br>
			<div class='barframe'>
				<div class='nav_bar'>
					<div class='bar'>
						<div class='nav_bar_title'>
							<a href='/index/all/1.html'><span class='nav_bar_list <?php if($type=="all"){ echo 'myActive';} ?> '>全部</span></a>
						</div>
						<div class='nav_bar_title'>
							<a><span id='allsort' class='nav_bar_list <?php 
							if($type=="prose" || $type=="webtec"){ 
								echo 'myActive';
							} 
							?>'>
							<?php 
								if($type=="all"){ echo "更多"; }else{ echo $attrArr[$type]; } 
							?>
							<span class='glyphicon glyphicon-chevron-down'></span></span></a>
							<div class='myMenu'>
								<a href="#"><div class='myMenu_title'>散文随笔</div></a>
								<a href="#"><div class='myMenu_title'>WEB技术</div></a>
							</div>
						</div>
						 
						 <div class='mysearch'>
							<input type="text" id='search' placeholder="搜索文章">
							<span id='goSearch'>搜索</span>
						</div>
						</div>
						<!-- <div class='nav_bar_title'><a href='about_me.php'><span class='nav_bar_list'>About Me</span></a></div> -->
				</div>
			</div>
		</div>
		<br>
		<div class='content'>
			<ul>
				<?php 
					for($i=0; $i<$artNum; $i++){
						echo '<li>';
						echo '<div class="article_frame">';
						echo '<a href="/frontend/article_detail.php?type='.$type.'&title='.$res[$i]["title"].'"><span class="article_title">'.$res[$i]["title"].'</span></a>';
						echo "<div class='article_content'>";
							if(mb_strlen($res[$i]['content'], 'utf8') > 140){
								$str = mb_substr($res[$i]['content'], 0, 140, 'utf8');
								echo $str.'...';
							}else{
								echo $res[$i]['content'];
							}
						echo '</div>';
						echo "<div class='article_data'>";
						echo '<a title="浏览数"><span class="glyphicon glyphicon-eye-open glyphicon_add">('.$visitNum[$i].')</span></a>';
						echo '<a title='.$cmtNum[$i].'条评论><span class="glyphicon glyphicon-comment glyphicon_add">('.$cmtNum[$i].')</span></a>';
						echo '<a title="发表时间""><span class="glyphicon glyphicon-time glyphicon_add">('.$res[$i]['create_time'].')</span></a>';
						echo '</div>';
						echo '</div>';
						echo '</li>';
					}
				 ?>
				
			</ul>
			<div class='myPagination'>
			<?php 
			if(empty($res)){
				echo '<br/>对不起，没有你要找的文章<br/><br/><br/>';
			}
				if($type == 'all'){
					$pagination = 7;
					if($totalPageNum < $pagination){
						for($i=1; $i<=$totalPageNum; $i++){
							echo '<a href="/search/all/'.$data.'/'.$i.'"><span>'.$i.'</span></a>';
						}
					}else{
						if($currentPage+2 <= $pagination){
							for($i=1; $i<=$pagination; $i++){
								if($i == $currentPage){
									echo '<a><span class="myActive">'.$i.'</span></a>';
								}else{
									echo '<a href="/search/all/'.$data.'/'.$i.'"><span>'.$i.'</span></a>';
								}
							}
							echo '…';
							echo '<a href="/search/all/'.$data.'/'.$totalPageNum.'"><span>'.$totalPageNum.'</span></a>';
						}elseif(($pagination - $currentPage) <= 1){
							echo '<a href="/search/all/'.$data.'/1"><span>1</span></a>';
							echo '…';
							for($i=$currentPage-floor($pagination/2); $i<$currentPage; $i++){
								echo '<a href="/search/all/'.$data.'/'.$i.'"><span>'.$i.'</span></a>';
							}
							echo '<a><span class="myActive">'.$currentPage.'</span></a>';
							for($i=$currentPage+1; $i<=$currentPage+2; $i++){
								if($i >= $totalPageNum){
									break;
								}
								echo '<a href="/search/all/'.$data.'/'.$i.'"><span>'.$i.'</span></a>';
							}
							if($totalPageNum - $currentPage > floor($pagination/2)){
								echo '…';
								echo '<a href="/search/all/'.$data.'/'.$totalPageNum.'"><span>'.$totalPageNum.'</span></a>';
							}else{
								if($currentPage != $totalPageNum){
									echo '<a href="/search/all/'.$data.'/'.$totalPageNum.'"><span>'.$totalPageNum.'</span></a>';
								}
							}
						}
					}
				}else{
					$pagination = 7;
					if($totalPageNum < $pagination){
						for($i=1; $i<=$totalPageNum; $i++){
							echo '<a href="/search/'.$data.'/'.$type.'/'.$i.'"><span>'.$i.'</span></a>';
						}
					}else{
						if($currentPage+2 <= $pagination){
							for($i=1; $i<=$pagination; $i++){
								if($i == $currentPage){
									echo '<a><span class="myActive">'.$i.'</span></a>';
								}else{
									echo '<a href="/search/'.$data.'/'.$type.'/'.$i.'"><span>'.$i.'</span></a>';
								}
							}
							echo '…';
							echo '<a href="/search/'.$data.'/'.$type.'/'.$totalPageNum.'"><span>'.$totalPageNum.'</span></a>';
						}else{
							echo '<a href="/search/'.$data.'/'.$type.'/1"><span>1</span></a>';
							echo '…';
							for($i=$currentPage-floor($pagination/2); $i<$currentPage; $i++){
								echo '<a href="/search/'.$data.'/'.$type.'/'.$i.'"><span>'.$i.'</span></a>';
							}
							echo '<a><span class="myActive">'.$currentPage.'</span></a>';
							for($i=$currentPage+1; $i<=$currentPage+2; $i++){
								if($i >= $totalPageNum){
									break;
								}
								echo '<a href="/search/'.$data.'/'.$type.'/'.$i.'"><span>'.$i.'</span></a>';
							}
							if($totalPageNum - $currentPage > floor($pagination/2)){
								echo '…';
								echo '<a href="/search/'.$data.'/'.$type.'/'.$totalPageNum.'"><span>'.$totalPageNum.'</span></a>';
							}else{
								if($currentPage != $totalPageNum){
									echo '<a href="/search/'.$data.'/'.$type.'/'.$totalPageNum.'"><span>'.$totalPageNum.'</span></a>';
								}
							}
						}
					}
				}
			 ?>
			</div>
		</div>
	</div>
</body>
</html>