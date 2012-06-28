<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>全场9块9</title>
<link rel="stylesheet" type="text/css" href="./app/2/app.css?v=2">
<style type="text/css"></style>
	<style>.goods_box:hover{border:1px solid orange;}</style>
</head>
<body>

	<div class="main" style="width: 950px; overflow: hidden; margin: 0 auto;">
		<div class="piece zhe_top" style="background: url(http://img01.taobaocdn.com/imgextra/i1/224713363/T2KtFnXeXNXXXXXXXX_!!224713363.png);">
			<div class="subscription">
				<p class="sub_btn"></p>
			</div>
			<div class="android">
				
			</div>
		</div>
		<style>
.yiiPager li {float:left}

.buy-ed {
	float: right;
	font-size: 12px;
	padding-right: 6px;
	}
.buy-ed strong{
	color:#B0E553;
	font-family:Arial;
	font-weight:700;
}
</style>
		<div class="piece zhe_goods">
			<div class="white_top">
				<div class="white_top_left"></div>
				<div class="white_top_middle"></div>
				<div class="white_top_right"></div>
			</div>
			
		<div class="white_bg">
				<div class="cardlist03" style="height: 10px;">
<?php 
$this->widget('CLinkPager',array(
   'header'=>'',  
   'firstPageLabel' => '首页',  
   'lastPageLabel' => '末页',  
   'prevPageLabel' => '上一页',  
   'nextPageLabel' => '下一页',  
   'pages' => $pager,  
   'maxButtonCount'=>10,  
   'cssFile'=>false
));  
?>

</div>

				<div class="zhe_bd">

					<ul class="clearfix">
<?php
foreach($data as $key => $val) {
?>
												<li class="goods_box ">

							<div class="inner_box tag_buy">
								<h3>
								<span class="green"></span><a class="inform_title" href="<?php echo $val['url']; ?>" title="<?php echo $val['title'];?>" target="_blank"><?php echo $val['title'];?></a>
								</h3>

								<div class="pic">
								<a href="<?php echo $val['url'];?>" target="_blank"><img src="<?php echo $val['image_url'].'_310x310.jpg'; ?>">
									
									</a>
								</div>
								<div class="buy_mask"></div>
								<a target="_blank" href="<?php echo $val['url'];?>" class="buy_action clearfix"> <span class="price"><em>¥</em><?php echo ($val['price'] > 0) ? $val['price'] :$val['sale_price'];?></span> <b class="btn"></b> </a>
							</div>
						</li>
<?php } ?>
			<div class="page">
<?php 
$this->widget('CLinkPager',array(
   'header'=>'',  
   'firstPageLabel' => '首页',  
   'lastPageLabel' => '末页',  
   'prevPageLabel' => '上一页',  
   'nextPageLabel' => '下一页',  
   'pages' => $pager,  
   'maxButtonCount'=>10,  
   'cssFile'=>false,
));  
?>
				</div>
			</div>
			<div class="white_bottom">
				<div class="white_bottom_left"></div>
				<div class="white_bottom_middle"></div>
				<div class="white_bottom_right"></div>
			</div>
		</div>
		<div class="piece_border"></div>
	</div>
	

<div style=”display:none”>
<script src="http://s15.cnzz.com/stat.php?id=4164261&web_id=4164261&show=pic" language="JavaScript"></script>
</div>
</body></html>

