<?php

/**
 * 分类
 *
 * @property string $id
 * @property integer $app_id
 * @property integer $parent_id
 * @property string $name
 * @property integer $listorder
 */
class Category extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{category}}';
	}

	public function rules()
	{
		return array(
			array('name', 'required'),
			array('app_id, listorder, parent_id', 'numerical', 'integerOnly' => true),
			array('name', 'length', 'max' => 255),

			array('id, app_id, name, listorder, parent_id', 'safe', 'on' => 'search'),
		);
	}
	
	public function relations()
	{
		return array(
			'parent' => array(self::BELONGS_TO, 'Category', 'parent_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'app_id' => '应用',
			'name' => '名称',
			'listorder' => '排序',
			'parent_id' => '所属分类',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id', $this->id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('listorder', $this->listorder);

		return new CActiveDataProvider('Category', array(
			'criteria'=>$criteria,
		));
	}

	public static function getTree($categoryName = '顶级分类', $sid = '-1')
	{
	    $categorys = self::model()->findAll();
	    $array = array();
	
	    foreach($categorys as $key => $val)
	    {
	        $array[] = array(
                'id' => $val->id,
                'parent_id' => $val->parent_id,
                'name' => $val->name
	        );
	    }
	
	    // 下拉列表
	    $tree = '<option value="0" selected>' . $categoryName . '</option>';
	    Tree::$arr = $array;
	    $tree .= Tree::getTree(0, "<option value=\$id \$selected>\$spacer\$name</option>", $sid, true);
	
	    return $tree;
	}
	
	public function getAppList()
	{
	    return array(
			1 => '9块9包邮',
			2 => '更多特价商品',
	    );
	}

    public static function getParentCategoryCache($parentId)
    {
        return 'get_parent_category_cache_' . $parentId;
    }
	
	public static function getCategoryNames($parentId = '0')
    {
        $data = false;
        $data = Yii::app()->cache->get(self::getParentCategoryCache($parentId));
        
        if($data != false)
            return $data;
	
	    $categoryResult = self::model()->findALl(array(
			'condition' => 'parent_id=:parent_id',
            'params' => array(
            	':parent_id' => $parentId
            ),
            'order' => 'listorder ASC',
	    ));
	
	    $tmpArray = array();
        foreach($categoryResult as $key => $val)
            $tmpArray[$val->id] = $val->name;
        Yii::app()->cache->set(self::getParentCategoryCache($parentId), $tmpArray, 3600);
        
		return $tmpArray;
	}

    public function getByAppIdCacheKey($appId)
    {
        return 'get_by_app_id_cache_key' . $appId;
    }
	
	/**
	 * 根据应用ID获取分类
	 *
	 * @param  integer $appId
	 * @return array
	 */
	public function getByAppId($appId)
    {
        $data = false;
        $data = Yii::app()->cache->get(self::getByAppIdCacheKey($appId));
        if($data != false)
            return $data;
	     
	    $criteria = new CDbCriteria();
	    $criteria->index = 'id';
	    $criteria->condition = 'app_id=:app_id';
	    $criteria->params = array(
			':app_id' => $appId,
	    );
        $criteria->order = 'listorder ASC';
        
        return $this->findAll($criteria);
	}
}
