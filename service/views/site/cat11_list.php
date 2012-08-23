  <div class="layout" id="main">
        	<?php $categoryCount = count( Category::model()->getByAppId() );?>
        	<?php 
	        	$getGoods = Goods::getGoods( '1' , '13' , '1' , 60);
	        	$currentGoodsCount = count( $getGoods['data'] );
	        	if ( $currentGoodsCount == 0 ) {
	        		continue;
	        	}
        	
        	?>		  
				 <div id="shoes" class="shoes pros">
                        
                        <div class="section">
                            <ul class="list">
    							   		                                
    							   		<?php foreach( $getGoods['data'] as $key => $val ) {?>
    								    <li class="lists lists-first">
											<div class="lists-box">							
                                                 <a href="<?php echo $val->url;?>" target="_blank" class="pro-img">
                        							<img src="<?php echo $val->image_url;?>">
                                                </a>
								                  <p class="pro-name">
                                                    <a href="<?php echo $val->url;?>" target="_blank"><?php echo $val->title;?></a>
                                                  </p>
                                                <div class="list-buy">
                                                    <p class="pro-primary">原价：<em><?php echo $val->sale_price;?></em></p>
                                                    <span id="item33005" class="salescount">已售出<b><?php echo $val->quantity;?></b>件</span>
                                                </div>
                                                <div class="buy">
                                                    <p class="pro-price">
                                                        <strong><?php echo $val->price > 0 ? $val->price : $val->sale_price;?></strong>/包邮
                                                    </p>
                                                     <a href="<?php echo $val->url;?>" target="_blank" class="btn buybtn">立即抢购</a>
                                                </div>
                                        </li>
                                        <?php } ?>
    								                               
  		  							    
    						 </ul>
    						 </div>
    						 
    						 
    						 
    						 
    	<div id="pages">
      <div class="page_box">
            <?php 
            $this->widget('CLinkPager',array(
               'header'=>'',  
               'firstPageLabel' => '首页',  
               'lastPageLabel' => '末页',  
               'prevPageLabel' => '上一页',  
               'nextPageLabel' => '下一页',  
               'pages' => $pager,  
               'maxButtonCount'=>5,  
               'cssFile'=>false,
               'htmlOptions'=>array(
              // 'template'=>'<li><a href="{url}">{lable}</a></li>'
               )
            ));  
            ?>
	   </div>
   </div>
    						 
    						 
    						 
    						 
    						 
    						 
                        </div>