<?php

/**
 * This is the model class for table "goods".
 *
 * The followings are the available columns in table 'goods':
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
 */
class Goods extends CActiveRecord
{
	public $keyword = null;
	public $cid = null;
	public $tbid = null;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Goods the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'goods';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, url, shop_url', 'required'),
			array('quantity, start_time, end_time, add_time', 'numerical', 'integerOnly'=>true),
			array('price, sale_price', 'numerical'),
			array('title, url, shop_url, image_url,shop_name', 'length', 'max'=>255),
			array('short_title,tb_id', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, tb_id,shop_name,commission,short_title, price, sale_price, quantity, start_time, end_time, url, shop_url, add_time, image_url', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
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


	public static function getGoodsCacheKey($appId, $catId, $page,$limit)
	{
        return 'goods_cache_'.$appId.'_'.$catId.'_'.$page.'_'.$limit;
	}

	public static function getGoodsCountCacheKey($catId, $page)
	{
		return 'goods_cache_count_'.$catId.'_'.$page;
	}

	
	
	public static function getGoods($appId = 1, $catId = 0, $page = 1 , $limit = '10')
	{
		$data = array('data'=>null);
		$data = Yii::app()->cache->get(self::getGoodsCacheKey($appId, $catId, $page,$limit));
		if($data == false)
		{
			$criteria = new CDbCriteria;
			$criteria->condition = 't.end_time > '.time();
			$criteria ->order = 't.quantity DESC';
            $catId && $criteria->compare('cat_id', $catId);
			$count = Goods::model()->count($criteria);
			$pager = new CPagination($count);
			$pager->pageSize = $limit;
			$pager->applyLimit($criteria);
			$data =  Goods::model()->findAll($criteria);

			if ($appId != 1) {
				shuffle($data);
			}

			$data = array('data'=>$data,'pager'=>$pager);

			Yii::app()->cache->set(self::getGoodsCacheKey($appId, $catId, $page,$limit),$data,1800);
		}
		return $data;
	}


	public static function handleData($array , $appId)
	{

		if ( !$array || $appId == 1) {
			return false;
		}
		echo $appId;

		return shuffle($array);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
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
			'tb_id'=>'淘宝ID'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('short_title',$this->short_title,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('sale_price',$this->sale_price);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('start_time',$this->start_time);
		$criteria->compare('end_time',$this->end_time);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('shop_url',$this->shop_url,true);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('image_url',$this->image_url,true);
		$criteria->compare('tb_id',$this->tb_id,true);
		$criteria->order = 't.id Desc';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	
}
