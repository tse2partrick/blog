<?php 
session_start();
require_once '../common/database/conn.php';
if(empty($_SESSION['username'])){
	header('location:login.php');
}
if(empty($_GET['search'])){
	$everyPageShow = 5;

	if(isset($_GET['page'])){
		$currentPage = $_GET['page'];
	}else{
		$currentPage = 1;
	}

	if(isset($_GET['type'])){
		$type = $_GET['type'];
	}else{
		$type = 'all';
	}

	if($type == 'all'){
		$sql = 'select title,author,art_type,create_time from article limit '.($currentPage-1)*$everyPageShow.','.$everyPageShow;
		$stmt = $conn->prepare($sql);
		$totalData = (int)$conn->query('select count(*) from article')->fetch()[0];
	}else if($type == 'prose'){
		$sql = 'select title,author,art_type,create_time from article where art_type=:type limit '.($currentPage-1)*$everyPageShow.','.$everyPageShow;
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':type', $type);
		$totalData = (int)$conn->query('select count(*) from article where art_type="'.$type.'"')->fetch()[0];
	}else if($type == 'webtec'){
		$sql = 'select title,author,art_type,create_time from article where art_type=:type limit '.($currentPage-1)*$everyPageShow.','.$everyPageShow;
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':type', $type);
		$totalData = (int)$conn->query('select count(*) from article where art_type="'.$type.'"')->fetch()[0];
	}
}else{
	$everyPageShow = 5;

	if(isset($_GET['page'])){
		$currentPage = $_GET['page'];
	}else{
		$currentPage = 1;
	}

	$search = $_GET['search'];
	$sql = 'select title,author,art_type,create_time from article where title like "%'.$search.'%" limit '.($currentPage-1)*$everyPageShow.','.$everyPageShow;
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':search', $search);
	$totalData = (int)$conn->query('select count(*) from article where title like "%'.$search.'%"')->fetch()[0];
}
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$pageNum = ceil($totalData / $everyPageShow);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>网站后台</title>
	<style>
		a:link{
			text-decoration: none;
		}
		.content{
			width:800px;
			margin:0 auto;
			
		}
		.banner{
			position: relative;
			background-color: #ABCDEF;
		}
		.banner_title{
			font-size: 44px;
			background-color: ;
			display: inline-block;
			float:left;
			margin-right: 20px;
		}
		.banner_function{
			display: inline-block;
			background-color: ;
			font-size: 18px;
			line-height: 20px;
			margin-right: 20px;
		}
		.banner_function > li{
			display: inline-block;
			list-style: none;
		}
		.banner_user{
			background-color:;
			font-size: 18px;
		}
		.page_num{
			border:1px solid #6FB7B7;
			display: inline-block;
			background-color: #f0f0f0;
			margin-right: 5px;
			padding: 5px;
			color: #2828FF;
		}
		.page_num:hover{
			background-color: #999;
		}
		.page_active{
			background-color: #999;
		}
		table, table tr td{
			border:1px solid;
			border-collapse: collapse;
			text-align: center;
			margin:0 auto;
			padding: 20px;
		}
		table tr:nth-child(even){
			background-color: #ABCDEF;
		}
		.float_R{
			float:right;
		}
		a{
			color:blue;
		}
		a:hover{
			color:#000079;
		}
	</style>
	<script src='../jquery/jquery.js'></script>
	<script>
		$(function(){
			$(window).keydown(function(event){
				if(event.keyCode == 13){
					window.location.href = 'article.php?search=' + $('#art_search').val();
				}
			})
			$('#type').change(function(){
				window.location.href='article.php?type='+$('#type').val();
			});
			$('.del').click(function(){
				if(!confirm('您确定要删除么？')){
					return false;
				}
				$.ajax({
					type:'GET',
					url:'article_del.php?title=' + $(this).attr('name'),
					success:function(msg){
						//如果是搜索页面删除后回到搜索页面
						if($('#isSearch').val() == 1){
							window.location.href='article.php?search=' + $('#searchVal').val() + '&page=' + $('#page').val() ;
						}else{
							window.location.href='article.php?type=' + $('#type').val() + '&page=' + $('#page').val() ;
						}
					}
				});
			});

			$('#goSearch').click(function(){
				window.location.href = 'article.php?search=' + $('#art_search').val();
			})
		});
	</script>
</head>
<body>
	<div class='content'>
		<div class='banner'>
			<span class='banner_title'>网站后台</span>
			<ul class='banner_function'>
				<li><a href='article.php'>文章管理</a></li>
				<li><a href='user.php'>前台用户管理</a></li>
				<li><a href='adminuser.php'>后台管理员管理</a></li>
			</ul>
			<span class='banner_user'>管理员：<?php echo $_SESSION['username']; ?></span>
			<a href="logout.php">退出</a>
		</div>
		<br>
		您的位置：<a href="index.php">首页</a>->文章管理
		<br>
		<br>
		<div class='info'>
			<span><a href="article_add.php">添加文章</a></span>
			<span class='float_R'>搜索文章：<input type="text" id='art_search' placeholder="请输入要搜索的关键字">&nbsp;<button id='goSearch'>查找</button></span>
		</div>
		<br>
		<div>
			<table>
				<?php if(empty($search)){ echo '<input type="hidden" id="isSearch" value="0" />'; ?>
				<caption><h3>文章管理后台</h3></caption>
				<?php }else{ ?>
				<caption><h3>搜索标题带有"<?php echo $search; echo '<input type="hidden" id="isSearch" value="1" />'; echo '<input id="searchVal" type="hidden" value="'.$_GET['search'].'">'; ?>"的结果<?php echo '<a class="float_R" href="article.php">返回所有文章</a>'; ?></h3></caption>
				<?php } ?>
				<tr id='title'>
					<td>标题</td>
					<td>作者</td>
					<td>
						
							<?php 
											if($currentPage == $pageNum && $currentPage != 1){
												if(count($result) == 1){
													echo '<input id="page" type="hidden" value="'.($currentPage-1).'">';
												}else{
													echo '<input id="page" type="hidden" value="'.$currentPage.'">';
												}
											}else{
												echo '<input id="page" type="hidden" value="'.$currentPage.'">';
											}
							if(empty($search)){
									if($type == 'all'){
										echo '<select name="type" id="type">';
										echo '<option value="all" selected="selected">全部分类</option>';
										echo '<option value="prose">散文随笔</option>';
										echo '<option value="webtec">Web技术</option>';
										echo '</select>';
									}
									if($type == 'prose'){
										echo '<select name="type" id="type">';
										echo '<option value="all" >全部分类</option>';
										echo '<option value="prose" selected="selected">散文随笔</option>';
										echo '<option value="webtec">Web技术</option>';
										echo '</select>';
									}
									if($type == 'webtec'){
										echo '<select name="type" id="type">';
										echo '<option value="all">全部分类</option>';
										echo '<option value="prose">散文随笔</option>';
										echo '<option value="webtec" selected="selected">Web技术</option>';
										echo '</select>';
									}
								}else{
									echo '文章分类';
								}
							 ?>
					</td>
					<td>发表时间</td>
					<td>操作</td>
				</tr>
				<?php 
				if(empty($search)){
				if(empty($result)){
					echo '</table><center>没有找到任何文章</center>';
					var_dump($stmt);
					return;
				}

				//删除跳转，如果删除不是尾页，跳回到当前页，如果是尾页，判断是否是最后一条数据，是的话当前页-1



				$attrArr = [''=>'无分类', 'prose' => '散文随笔', 'webtec' => 'Web技术'];
					foreach($result as $k=>$v){
							echo '<tr>';
							foreach($v as $key=>$value){
								if($key == 'title'){
									echo '<td>';
									echo '<a href="article_detail.php?title='.$value.'">'.$value.'</a>';
									echo '</td>';
								}else{
										if($key == 'art_type'){
											echo '<td>';
											echo $attrArr[$value];
											echo '</td>';
										}else{
											echo '<td>'.$value.'</td>';
										}
								}
							}
							echo '<td><a href="article_change.php?title='.$v['title'].'">修改</a>&nbsp;<a class="del" href="#" name='.$v['title'].'>删除</a></td>';
							echo '</tr>';
						}
				 
			echo '</table>';
			echo '<br>';
			echo '<center>';

			$pagination = 10;
			if($pageNum <= $pagination){
				for($i=1; $i<=$pageNum; $i++){
					echo '<a href="article.php?type='.$type.'&page='.$i.'"><span class="page_num">'.$i.'</span></a>';
				}
			}
			if($pageNum > $pagination){
				if($currentPage <= ($pagination-2)){
					for($i=1; $i<=$pagination; $i++){
						if($i == $currentPage){
							echo '<a href="article.php?type='.$type.'&page='.$i.'"><span class="page_num page_active">'.$i.'</span></a>';
						}else{
							echo '<a href="article.php?type='.$type.'&page='.$i.'"><span class="page_num">'.$i.'</span></a>';
						}
					}
					echo '..';
					echo '<a href="article.php?type='.$type.'&page='.$pageNum.'"><span class="page_num">'.$pageNum.'</span></a>';
				}else{
					echo '<a href="article.php?type='.$type.'&page=1"><span class="page_num">1</span></a>';
					echo '..';
					for($i=$currentPage-(floor($pagination/2)); $i<$currentPage; $i++){
						echo '<a href="article.php?type='.$type.'&page='.$i.'"><span class="page_num">'.$i.'</span></a>';
					}
					echo '<a href="article.php?type='.$type.'&page='.$currentPage.'"><span class="page_active page_num">'.$currentPage.'</span></a>';
					for($i=$currentPage+1; $i<=$currentPage+2; $i++){
						if($i > $pageNum){
							break;
						}
						echo '<a href="article.php?type='.$type.'&page='.$i.'"><span class="page_num">'.$i.'</span></a>';
					}
					if(($pageNum - $currentPage) > 3){
						echo '..';
						echo '<a href="article.php?type='.$type.'&page='.$pageNum.'"><span class="page_num">'.$pageNum.'</span></a>';
					}elseif($pageNum - $currentPage > 2){
						echo '<a href="article.php?type='.$type.'&page='.$pageNum.'"><span class="page_num">'.$pageNum.'</span></a>';
					}
				}
			}

			echo '</center>';
		}else{
			if(empty($result)){
					echo '</table><center>没有找到任何文章</center>';
					return;
				}
				$attrArr = [''=>'无分类', 'prose' => '散文随笔', 'webtec' => 'Web技术'];
					foreach($result as $k=>$v){
							echo '<tr>';
							foreach($v as $key=>$value){
								if($key == 'title'){
									echo '<td>';
									echo '<a href="article_detail.php?title='.$value.'">'.$value.'</a>';
									echo '</td>';
								}else{
										if($key == 'art_type'){
											echo '<td>';
											echo $attrArr[$value];
											echo '</td>';
										}else{
											echo '<td>'.$value.'</td>';
										}
								}
							}
							echo '<td><a href="article_change.php?title='.$v['title'].'">修改</a>&nbsp;<a class="del" href="#" name='.$v['title'].'>删除</a></td>';
							echo '</tr>';
						}
				 
			echo '</table>';
			echo '<br>';
			echo '<center>';

			$pagination = 10;
			if($pageNum <= $pagination){
				for($i=1; $i<=$pageNum; $i++){
					echo '<a href="article.php?search='.$search.'&page='.$i.'"><span class="page_num">'.$i.'</span></a>';
				}
			}
			if($pageNum > $pagination){
				if($currentPage <= ($pagination-2)){
					for($i=1; $i<=$pagination; $i++){
						if($i == $currentPage){
							echo '<a href="article.php?search='.$search.'&page='.$i.'"><span class="page_num page_active">'.$i.'</span></a>';
						}else{
							echo '<a href="article.php?search='.$search.'&page='.$i.'"><span class="page_num">'.$i.'</span></a>';
						}
					}
					echo '..';
					echo '<a href="article.php?search='.$search.'&page='.$pageNum.'"><span class="page_num">'.$pageNum.'</span></a>';
				}else{
					echo '<a href="article.php?search='.$search.'&page=1"><span class="page_num">1</span></a>';
					echo '..';
					for($i=$currentPage-(floor($pagination/2)); $i<$currentPage; $i++){
						echo '<a href="article.php?search='.$search.'&page='.$i.'"><span class="page_num">'.$i.'</span></a>';
					}
					echo '<a href="article.php?search='.$search.'&page='.$currentPage.'"><span class="page_active page_num">'.$currentPage.'</span></a>';
					for($i=$currentPage+1; $i<=$currentPage+2; $i++){
						if($i > $pageNum){
							break;
						}
						echo '<a href="article.php?search='.$search.'&page='.$i.'"><span class="page_num">'.$i.'</span></a>';
					}
					if(($pageNum - $currentPage) > 3){
						echo '..';
						echo '<a href="article.php?search='.$search.'&page='.$pageNum.'"><span class="page_num">'.$pageNum.'</span></a>';
					}elseif($pageNum - $currentPage > 2){
						echo '<a href="article.php?search='.$search.'&page='.$pageNum.'"><span class="page_num">'.$pageNum.'</span></a>';
					}
				}
			}

			echo '</center>';
		}
					 ?>
		</div>
	</div>
</body>
</html>