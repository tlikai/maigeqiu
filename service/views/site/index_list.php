  <div class="layout" id="main">
        	<?php $categoryCount = count( Category::model()->getByAppId() );?>
        	<?php for( $i = 1 ; $i <= $categoryCount ; $i++ ){?>
        	<?php 
	        	$getGoods = Goods::getGoods( '' , $i );
	        	$currentGoodsCount = count( $getGoods['data'] );
	        	if ( $currentGoodsCount == 0 ) {
	        		continue;
	        	}
        	
        	?>		  
				 <div id="<?php echo $this->categoryFlag[$i]['id']; ?>" class="<?php echo $this->categoryFlag[$i]['id']; ?> pros">
                        <div class="title">
                            <a href="<?php echo $this->createUrl( 'site/index' , array( 'cat' => '11' , 'child' => $i ) )?>" class="h2"></a>
							<a class="title-info" href="<?php echo $this->createUrl( 'site/index' , array( 'cat' => '11' , 'child' => $i ) )?>"><?php echo $this->categoryFlag[$i]['title']; ?></a>
                            <a href="<?php echo $this->createUrl( 'site/index' , array( 'cat' => '11' , 'child' => $i ) )?>" class="more"><?php echo $this->categoryFlag[$i]['more']; ?><i></i></a>
                        </div>
                        
                        
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
                        </div>
                        <?php }?>