<?php

/**
 * 商品
 * 
 * @property integer $id
 * @property string $title
 * @property string $short_title
 * @property double $price
 * @property double $origin_price
 * @property integer $quantity
 * @property integer $start_time
 * @property integer $end_time
 * @property string $url
 * @property string $shop_url
 * @property integer $add_time
 * @property string $image_url
 * @property integer $recommend
 */
class Goods extends CActiveRecord
{
	public $keyword = null;
	public $cid = null;
	public $tbid = null;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{goods}}';
	}

	public function rules()
	{
		return array(
			array('title, url, shop_url', 'required'),
			array('cat_id, quantity, start_time, end_time, recommend, add_time', 'numerical', 'integerOnly' => true),
			array('price, sale_price', 'numerical'),
			array('title, url, shop_url, image_url, shop_name', 'length', 'max' => 255),
			array('short_title,tb_id', 'length', 'max' => 100),
		        
			array('id, title, tb_id, shop_name, recommend, commission, short_title, price, sale_price, quantity, start_time, end_time, url, shop_url, add_time, image_url', 'safe', 'on'=>'search'),
		);
	}

	public static function checkTbId($tb_id)
	{
		$resetGoods = Goods::model()->find(array(
            'condition'=>'tb_id=:tb_id',
            'params'=>array(':tb_id'=>$tb_id)
		));
		return $resetGoods;
	}
	
	public function relations()
	{
		return array();
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
            'cat_id' => '分类',
			'title' => '标题',
			'short_title' => '自定义标题',
			'price' => '现价',
			'sale_price' => '原价',
			'quantity' => '购买数量',
			'start_time' => '开始时间',
			'end_time' => '结束时间',
			'url' => '淘宝URL',
			'shop_url' => '商家URL',
			'add_time' => '入库时间',
			'image_url' => '图片路径',
			'shop_name' => '商家名称',
			'commission' => '佣金',
			'commission_rate' => '佣金率',
			'sort' => '排序',
			'tb_id'=>'淘宝ID',
			'recommend' => '推荐商品',
		);
	}

	public function search()
	{
        $criteria = new CDbCriteria();
        
        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('short_title', $this->short_title, true);
        $criteria->compare('price', $this->price);
        $criteria->compare('sale_price', $this->sale_price);
        $criteria->compare('quantity', $this->quantity);
        $criteria->compare('start_time', $this->start_time);
        $criteria->compare('end_time', $this->end_time);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('shop_url', $this->shop_url, true);
        $criteria->compare('add_time', $this->add_time);
        $criteria->compare('image_url', $this->image_url, true);
        $criteria->compare('tb_id', $this->tb_id, true);
        $criteria->compare('recommend', $this->recommend, true);
		$criteria->order = 't.id Desc';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function getTaobaoKeLink($num_iids)
    {
		$click_urls = array();
        foreach($num_iids as $num_iid)
        {
            if(!isset($click_urls[$num_iid]))
            {
                $tbapi_num_iids_arr[] = $num_iid;
            }
        }
        
        if(!empty($tbapi_num_iids_arr))
        {
            $numbers = count($tbapi_num_iids_arr);
            $numbers_max = 40; // 淘宝 API 限制最大返回40条记录
            if($numbers > 0)
            {
                $numbers_times = ceil($numbers / $numbers_max); // 第一层循环的循环次数
                $numbers_start = 0;
                $numbers_end = $numbers_max;
                for($numbers_i = 1; $numbers_i <= $numbers_times; $numbers_i++)
                {
                    for($numbers_j = $numbers_start; $numbers_j < $numbers_end; $numbers_j++)
                    {
                        if($numbers_j >= $numbers)
                        {
                            break;
                        }
                        $tbapi_num_iids_arr_sp[] = $tbapi_num_iids_arr[$numbers_j];
                    }
                    
                    $numbers_start = $numbers_start + $numbers_max;
                    $numbers_end = $numbers_end + $numbers_max;
                    $tbapi_num_iids = implode(",", $tbapi_num_iids_arr_sp);
                    
                    $req = new TaobaokeItemsConvertRequest();
                    $req->setFields("num_iid,title,nick,pic_url,price,click_url,commission,commission_rate,commission_num,commission_volume,shop_click_url,seller_credit_score,item_location,volume");
                    $req->setNumIids($tbapi_num_iids);
                    $req->setPid(Yii::app()->params['pid']); // 淘宝联盟（阿里妈妈）PID
                    
                    $resp = Yii::app()->topClient->execute($req);
                    $res = Yii::app()->topClient->processResponse($resp);
                    
                    if(isset($res["taobaoke_items"]["taobaoke_item"]))
                    {
                        $links = $res["taobaoke_items"]["taobaoke_item"];
                        foreach($links as $value)
                        {
                            $click_urls[] = $value;
                        }
                    }
                    
                    unset($tbapi_num_iids_arr_sp);
                    unset($tbapi_num_iids);
                    unset($resp);
                    unset($res);
                    unset($links);
                    unset($value);
                }
            }
        }
        
        return $click_urls;
	}

    /**
     * 处理商品数据
     */
    public static function processingItems($ids)
    {
		if(count($ids) > 20)
        {
            $tmp1 = array_splice($ids, 0, 20);
            
            $req = new ItemsListGetRequest();
            $req->setFields("delist_time,list_time,num_iid,has_showcase");
            $req->setNumIids(implode(',', $tmp1));
            
            $resp = Yii::app()->topClient->execute($req);
            $res1 = Yii::app()->topClient->processResponse($resp);
            
            $req->setNumIids(implode(',', $ids));
            $resp = Yii::app()->topClient->execute($req);
            $res2 = Yii::app()->topClient->processResponse($resp);
            
            return array_merge($res1['items']['item'], $res2['items']['item']);
        }
        
        $req = new ItemsListGetRequest();
        $req->setFields("detail_url,num_iid,title,nick,type,cid,seller_cids,props,input_pids,input_str,desc,pic_url,num,valid_thru,list_time,delist_time,stuff_status,location,price,post_fee,express_fee,ems_fee,has_discount,freight_payer,has_invoice,has_warranty,has_showcase,modified,increment,approve_status,postage_id,product_id,auction_point,property_alias,item_img,prop_img,sku,video,outer_id,is_virtual");
        $req->setNumIids(implode(',', $ids));
        $resp = Yii::app()->topClient->execute($req);
        $res1 = Yii::app()->topClient->processResponse($resp);
        
        return $res['items']['item'];
	}

    public static function processingPromotion($id)
    {
		$promotion = new UmpPromotionGetRequest();
        $promotion->setItemId($id);
        $resp = Yii::app()->topClient->execute($promotion);
        $res = Yii::app()->topClient->processResponse($resp);
        
        if(!$res)
            return false;
        
        if(!isset($res['promotions']) || !isset($res['promotions']['promotion_in_item']['promotion_in_item']))
			return false;
		
		$promotionArr = $res['promotions']['promotion_in_item']['promotion_in_item']['0'];
		
		return array(
			'price' => $promotionArr['item_promo_price'],
			'start_time' => $promotionArr['start_time'],
			'end_time' => $promotionArr['end_time'],
		);
	}

	/**
	 * 关键词搜索淘宝客数据
	 */
	public static function processingIndex($array)
	{
		$res = array();

		if(empty($array['keyword']) && empty($array['tbid']))
			return false;

		$req = new TaobaokeItemsGetRequest;
		$req->setFields("num_iid,title,nick,pic_url,price,click_url,commission,commission_rate,commission_num,commission_volume,shop_click_url,seller_credit_score,item_location,volume");
		$req->setPid(Yii::app()->params['pid']); // 淘宝联盟（阿里妈妈）PID
		$req->setPageNo($array['page']);
		$req->setStartPrice(Yii::app()->params['start_price']);
		$req->setEndPrice(Yii::app()->params['end_price']);
		$req->setSort(Yii::app()->params['sort']);
                
        if(!empty($array['keyword']))
        {
            $req->setKeyword($array['keyword']);
        }
        else
        {
            $newId = array();
            $newId = explode(',', $array['tbid']);
            return self::getTaobaoKeLink($newId);
        }

		$resp = Yii::app()->topClient->execute($req);
		$res = Yii::app()->topClient->processResponse($resp);
                
        if(!empty($res))
            return $res['taobaoke_items']['taobaoke_item'];
	}
	

	public static function getRecommentGoodsCacheKey( $number ) {
	    return 'goods_recomment_'.$number;
	}
	
	/**
	 * 获取推荐商品
	 * @param unknown_type $number
	 */
	public static function getRecommentGoods( $number = '3' )
	{
	    $data = false;
	    $data = Yii::app()->cache->get( self::getRecommentGoodsCacheKey( $number ) );
	
	    if ( $data != false ) {
	        return $data;
	    }
	
	    $goods = self::model()->findAll( array (
	            'limit' => '3',
	            'order' => 'recommend Desc',
	    ) );
	
	    Yii::app()->cache->set( self::getRecommentGoodsCacheKey( $number ) , $goods , 3600 );
	    return $goods;
	}
	
	
	public static function getGoodsCacheKey($appId, $catId, $page)
	{
	    return 'goods_cache_'.$appId.'_'.$catId.'_'.$page;
	}
	
	public static function getGoodsCountCacheKey($catId, $page)
	{
	    return 'goods_cache_count_'.$catId.'_'.$page;
	}
	
	
	
	public static function getGoods($appId = 1, $catId = 0, $page = 1)
	{
	    $data = array('data'=>null);
	    $data = Yii::app()->cache->get(self::getGoodsCacheKey($appId, $catId, $page));
	    if($data == false)
	    {
	        $criteria = new CDbCriteria;
	        $criteria->condition = 't.end_time > '.time();
	        $criteria ->order = 't.quantity DESC';
	        $catId && $criteria->compare('cat_id', $catId);
	        $count = Goods::model()->count($criteria);
	        $pager = new CPagination($count);
	        $pager->pageSize = 10;
	        $pager->applyLimit($criteria);
	        $data =  Goods::model()->findAll($criteria);
	
	        if ($appId != 1) {
	            shuffle($data);
	        }
	
	        $data = array('data'=>$data,'pager'=>$pager);
	
	        Yii::app()->cache->set(self::getGoodsCacheKey($appId, $catId, $page),$data,1800);
	    }
	    return $data;
	}

    public static function handleData($array, $appId)
    {
    	if(!$array || $appId == 1)
        	return false;
        echo $appId;
    	return shuffle($array);
	}
}
