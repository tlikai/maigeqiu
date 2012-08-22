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
			array('app_id, listorder', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, app_id, name, listorder', 'safe', 'on'=>'search'),
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'app_id' => '应用ID',
			'name' => '名称',
			'listorder' => '排序',
		);
	}

    /**
     * 获取应用列表
     *
     * @return array
     */
	public function getAppList()
	{
		return array(
				1 => '9块9包邮',
				2 => '更多特价商品',
		);
	}
	

    /**
     * 根据应用ID获取分类
     *
     * @param  integer $appId
     * @return array
     */
    public function getByAppId($appId)
    {
        $criteria = new CDbCriteria();
        $criteria->index = 'id';
        $criteria->condition = 'app_id=:app_id';
        $criteria->params = array(
            ':app_id' => $appId,
        );
        $criteria->order = 'listorder ASC';
        return $this->findAll($criteria);
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
