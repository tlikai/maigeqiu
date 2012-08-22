<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property string $id
 * @property string $name
 * @property integer $listorder
 */
class Category extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Category the static model class
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
		return 'category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				
			array('name', 'required'),
			array('app_id, listorder,parent_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, app_id, name, listorder,parent_id', 'safe', 'on'=>'search'),
		);
	}

	
	public static function getTree( $categoryName = '顶级分类' )
	{
		$get_actions = self::model()->findAll();
		$actions_array = array();
	
		foreach($get_actions as $key => $val){
			$actions_array[] = array('id'=>$val->id,'parent_id'=>$val->parent_id,'name'=>$val->name);
		}
		// 下拉列表
		$tree_arr  = '<option value="0" selected>'.$categoryName.'</option>';
		Tree::$arr = $actions_array;
		$tree_arr .= Tree::getTree(0,"<option value=\$id \$selected>\$spacer\$name</option>",'-1',true);
		return $tree_arr;
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
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

    public function getAppList()
    {
        return array(
            1 => '主站',
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

		$criteria->compare('id',$this->id,true);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('listorder',$this->listorder);

		return new CActiveDataProvider('Category', array(
			'criteria'=>$criteria,
		));
	}

    protected function beforeSave()
    {
        if($this->isNewRecord)
        {
            $this->listorder = isset($this->listorder) ? $this->listorder : 0;
        }

        return parent::beforeSave();
    }
}
