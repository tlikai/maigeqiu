<div class="wrap"> 

<div class="header">
		<div class="inner_header">
			<p class="detail">每日精选 天天折扣</p><br>
			<span class="tell_frd">喜欢我就收藏我吧！</span>
			<span class="frd_like"></span>
			<div class="menu">
				<a class="current" title="淘宝折扣热销" href="index.php">全部商品</a>
				<a class="sale_mode" title="9.9元包邮" href="index.php?type=hot" target="_self">最新发布<sup class="ico_hot">HOT</sup></a>
				<a class="sale_mode" title="9.9元包邮" href="index.php?type=quantity" target="_self">销量排行<sup class="ico_hot">HOT</sup></a> 
				<a class="nice_store" href="index.php?type=pop" target="_self">人气推荐</a> 
			</div>
		</div>
	</div>

	<!-- /header -->
	<div class="container">

<div class="index_banner">
	<img src="./css/banner.jpg">
</div>





		<!-- /cate_type -->
		<div class="pager">
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
   'htmlOptions'=>array(
   'template'=>'<a href="{url}">{lable}</a>'
   )
));  
?>

		</div>
		<!-- /pager -->
		<div class="product_list">
			<ul>

<?php
foreach($data as $key => $val) {
?>
<li>
  <div class="pro_info">
  <div class="pic"><a target="_blank" href="<?php echo $val['url'];?>"><img width="280" height="280" alt="<?php echo $val['title']; ?>" src="<?php echo $val['image_url']?>_310x310.jpg"></a></div>
  <h2 class="pro_tit"><strong>【17号10点】</strong><a target="_blank" href="<?php echo $val['url'];?>"><?php echo $val['title'];?></a></h2>

	<ins class="our_price">¥<?php echo ($val['price'] > 0) ? $val['price'] : $val['sale_price'];?></ins> </div>
  <div class="buy_pro"> <a class="buy_now" target="_blank" href="<?php echo $val['url'];?>">去购买</a> </div>
</li>
<?php 
}
?>



			</ul>
		</div>
		<!-- /product_list -->
		<div class="pager">
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
		<!-- /pager -->

	<!-- /container -->
