<div class="wrap">
	<!-- /header -->
	<div class="container">
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

	<ins class="our_price">¥<?php echo ($val['price'] > 0) ? $val['price'] :$val['sale_price'];?></ins> </div>
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
