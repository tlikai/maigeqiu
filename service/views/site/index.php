<!-- start vmc 3.1 -->
<div id="site-nav" role="navigation">
<div id="site-nav-bd">
    	
    <p class="login-info">
       &nbsp;亲，欢迎来到秒杀专区！
    </p>
        <ul class="quick-menu">
        <li class="home"><a href="javascript:window.external.addFavorite('http://maigeqiu.com','秒杀专区应用-淘宝网超优汇！天天精品秒杀！9.9/19.9元包邮秒杀活动,名牌折扣品牌特卖5折封顶');
		" title="将[秒杀专区应用]加入收藏夹" style="color:#F00">加入收藏</a>
		</li>
    <li class="home"><a href="@" target="_blank">关注微博</a></li>
   
    </ul>
</div></div>
<!-- system-announce -->

<!-- end vmc 3.1 -->    	<script>
    	    TB.Global.init({mc:-1});
    	</script>
    	
    <!-- 特价页头 -->
             <div id="t-hd">
            <div id="te-header">
                 <h1 id="logo">
                   <a target="_top" href="/"><img height="31" width="190" src="./static/T2jcBmXndNXXXXXXXX_!!407025033.jpg" alt="秒杀专区应用-物超所值 省钱更省心"></a>
                </h1>
    			<!-- 去掉beta   <i class="beta"></i> 就一行 --> 
				<div id="te-slogan">
					<img src="./static/T2yIRYXhlcXXXXXXXX_!!407025033.png" title="每天10:00上新，记得每天都要来哟！">
				</div>
            </div>
        </div>
    	<div id="nav">
	<div class="nav-box">
		<div class="te-nav">
			<ul class="te-navigation">
					<li <?php if(empty($_GET['cat'])) : ?>class="list-cur"<?php endif; ?>><a href="/">首页</a></li>
              		<?php foreach( Category::getCategoryNames( '0' ) as $key => $val ) : ?>
              			<li <?php if(isset($_GET['cat']) && $key == $_GET['cat']) : ?>class="list-cur"<?php endif; ?>><a href="<?php echo $this->createUrl('site/index', array('cat' => $key ) ); ?>"><?php echo $val; ?></a></li>
					<?php endforeach;?>
            </ul>
            
        </div>
    </div>
</div>

		<link rel="stylesheet" href="./static/index_v2.css" type="text/css">

	<?php if ( $catId == 11 ) {?>
	<div class="te-subnav">
		<div class="te-subnav-b">
	     <?php foreach($cats as $id => $cat) : ?>
	       <span><a href="<?php echo $this->createUrl('site/index', array( 'cat' => $catId , 'child' => $id) ); ?>"><?php echo $cat['name']; ?></a></span>
		<?php endforeach; ?>
		</div>
	</div>
	<div style="height:8px;">
	</div>
	<?php } else if ( $catId != null ) {?>
	<div style="height:8px;">
	</div>
	
	
	<?php }?>
	
<!--插入function-->

    <div id="content">
    <?php if ( $catId == null ) {?>
        <div class="layout layout-fb">
        <div class="col-main">
            <!--9天开始-->
            <div class="tuan" id="ten"> <!--根据id切换展示的默认开始-->
                <div class="tuan-nav ten-nav">
                    <div class="s-ten"></div>
                </div>
                <div class="tuan-bd">
                    <div class="t-ten tcon" id="J_Ten" style="display: block; ">
                        <ul>
						<?php $goodsRecomment = Goods::getRecommentGoods( '3' ); ?>
						<?php foreach ( $goodsRecomment as $key => $val) { ?>
						<li class="lists">
							<a href="<?php echo $val->url;?>" target="_blank" class="pro-img">
								<img src="<?php echo $val->image_url; ?>">
								<span></span>
								<i class="pro-cheap"></i>
							</a>
							
							<p class="pro-name">
                                <a href="<?php echo $val->url;?>" target="_blank"><?php echo $val->title; ?></a>
                            </p>
                            
                            <div class="list-buy">
									<p class="pro-primary">原价：<em><?php echo $val->sale_price;?></em></p>
									<span id="item33162" class="salescount">限量<b><?php echo $val->quantity; ?></b>件</span>
							</div>
							
							<div class="buy">
                            	<p class="pro-price">
                            		<strong><?php echo $val->price > 0 ? $val->price : $val->sale_price;?></strong>/包邮
                                </p>
                                <a href="<?php echo $val->url;?>" target="_blank" class="btn buybtn">立即抢购</a>
                             </div>
							
						</li>
						<?php } ?>
                    </div>
                </div>
            </div>
            <!--9end-->
        </div>
		<div class="col-sub">
			<div class="slogan">
                <a class="no-postage"> <!--class后href="#" target="_blank"-->
                    <i></i>全场包邮
                </a>
                <a class="return-goods">
                    <i></i>七天退货
                </a>
                <a class="handpick"><i></i>精选特价</a>
            </div>
            <div class="te-tab">
				<div class="tab-hd">
                    <ul class="tab-nav" id="J_Tab">
                        <li class="first tab-cur" data-index="0">公告</li><!-- tab-cur用于切换显示的默认值-->
                        <li class="last" data-index="1">热点</li>
                    </ul>
                </div>
					<div class="tab-bd" id="J_Tabbd">
	                    <div class="te-notice" style="display: none; ">
	                        <ul>
	                           
	                                                       <li class=""><p><a href="http://bangpai.taobao.com/group/thread/14389084-274510895.htm" target="_blank">【公告】秒杀活动招商总则</a></p></li>
	                                                        <li class=""><p><a href="http://bangpai.taobao.com/group/thread/14389084-274999287.htm" target="_blank"><font color="#FF0000">【公告】9.9元包邮秒杀招商</font></a></p></li>
	                                                        <li class=""><p><a href="http://bangpai.taobao.com/group/thread/14389084-274510895.htm" target="_blank">【指南】</a></p></li>
	                                                        <li class="last"><p><a href="http://bangpai.taobao.com/group/thread/14389084-274510895.htm" target="_blank">【公告】</a></p></li>
	                                                        
	                        </ul>
	                    </div>
	                    <div class="te-hotnews" style="display: block; ">
	                        <ul>
	                            
	                                                       <li class=""><p><a href="http://bangpai.taobao.com/group/thread/14389084-273227432.htm" target="_blank">日销百单 见证奇迹的时刻</a></p></li>
	                                                        <li class=""><p><a href="http://bangpai.taobao.com/group/thread/14389084-274580396.htm" target="_blank"><font color="#FF0000">产品瞬间秒完 掌柜HOLD不住了</font></a></p></li>
	                                                        <li class=""><p><a href="http://bangpai.taobao.com/group/thread/14389084-273227789.htm" target="_blank">参加活动带来的火爆效应</a></p></li>
	                                                        <li class="last"><p><a href="http://bangpai.taobao.com/group/thread/14389084-274510895.htm" target="_blank">热帖推荐申请</a></p></li>
	                                                        
	                        </ul>
	                    </div>
                	</div>
		</div>
			<div class="convenience">
                <div class="convenience-weibo"><a class="" href="http://widget.weibo.com/relationship/followlogin.php?uid=2393429324" target="_blank"><i></i><span>官方微博</span></a></div>
                <div class="convenience-notice"><em class="subscribe-btn"><i style="cursor:pointer;" class="J_SubscribeRss" href=" "></i><span class="J_SubscribeRss" href=" ">特价通知</span></em></div><!--这个链接一样-->
                <div class="convenience-suggest"><a class="" href="http://bangpai.taobao.com/group/thread/14389084-274510895.htm" target="_blank"><i></i><span>意见建议</span></a></div><!--href="mailto:***@qq.com"-->
            </div>
		</div>
    </div>
    
    
    
    
    
<?php }?>


<?php 

if ( $catId == null ) {
	$this->renderPartial('index_list'); 
} else if ( $catId == '13' ) {
	$this->renderPartial('cat11_list',array(
			'pager' => $pager,
	)); 
} else {
	$this->renderPartial('cat13_list',array(
			'pager' => $pager,
	)); 
}

?>
		
      
                     
					
					
					
					
					
					
					
					
 <style>
.cuxiaohui-hd {
    position: relative;
    width: 990px;
    margin: 0 auto;
    font-size: 0;
}
.cuxiaohui-hd .hui-more {
    position: absolute;
    right: 14px;
    top:15px;
    font-size: 12px;
    color: #333;
	padding-right:18px;
}
.cuxiaohui-hd .hui-more:hover {
	color: #F60;
	text-decoration: none;
}
.cuxiaohui-bd {
    width: 990px;
    margin: 0 auto;
    background: #fff;
    *padding-bottom: 20px;
}
.cuxiaohui-hd .hui-more i {
	position: absolute;
	top:1px;
	right:0;
	display: block;
	width: 15px;
	height: 15px;
	overflow: hidden;
	cursor: pointer;
	background: url(http://img02.taobaocdn.com/tps/i2/T1it6kXf0cXXaiRLHE-791-450.png) no-repeat -401px -399px transparent;

}
.cuxiaohui-hd .hui-more:hover i {
	background-position:-401px -424px;
}
.hui-item-list {
    padding: 20px 0 0 14px;
    *padding: 20px 0 0 14px;
    *zoom:1;
}
.hui-item-list .hui-item {
    float: left;
    display: inline-block;
    width: 230px;
    margin-right: 14px;
    margin-bottom: 20px;
}
.hui-item-list .hui-item-last {
    _margin-right: 0;
}
.hui-item .hui-item-link {
    display: inline-block;
    font-size: 0;
    text-decoration: none;
    width: 230px;
    height: 190px;
}
.hui-item .hui-item-link:hover {
    text-decoration: none;
}
.hui-item .hui-item-link .hui-item-img {
    width: 230px;
    height: 160px;
}
.hui-item .hui-item-link .hui-item-title {
    font-size: 12px;
    height: 30px;
    line-height: 30px;
    padding-left: 5px;
    color: #333;
    background: url("http://img04.taobaocdn.com/tps/i4/T16zfmXdlqXXbFFtbo-230-60.png") no-repeat 0 0 #eee;
}
.hui-item .hui-item-link:hover .hui-item-title {
    color: #f50;
    background: url("http://img04.taobaocdn.com/tps/i4/T16zfmXdlqXXbFFtbo-230-60.png") no-repeat 0 -30px #fff3c7;
}
</style>
	
</div>
<div id="friends">
            <li>
	  温馨提示：<br><br>1、【秒杀专区】所有产品特价信息仅供参考，具体产品的售价以实际售价为准，个别商品可能已经不在活动时间范围，但是未能及时下架；请勿以【秒杀专区】的促销信息为由强行要求卖家给予对应优惠。
		<br><br>2、本活动并未对展示产品进行质量检测和各类品质认定，购买时敬请留意和选择货真价实的产品，注意辨别产品真伪，以免造成不必要的损失。
		</li>
            </div>
	
	<!--浮动条start-->

    <!--浮动条end-->
</div>

<!-- 页面脚本 -->
<!-- 一个页面内仅引用一个页面级脚本，在页面脚本内可引用模块化即 pix-mod 的脚本或样式 -->


<!-- 自动适应的js代码-->
