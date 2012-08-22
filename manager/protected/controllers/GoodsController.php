<?php

class GoodsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	
	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
		);
	}
	
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated users to access all actions
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{

		$model=new Goods;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Goods']))
		{
			$tbId = $_POST['Goods']['tb_id'];

			if ( $tbId <= 0 ) {
				return false;
			}

			$existence = Goods::checkTbId($tbId);
			if ( $existence ) {
				$model=$this->loadModel($existence->id);
				
			}


			$_POST['Goods']['start_time'] = !empty($_POST['Goods']['start_time']) ? strtotime($_POST['Goods']['start_time']) : '';
			$_POST['Goods']['end_time'] = !empty($_POST['Goods']['end_time']) ? strtotime($_POST['Goods']['end_time']) : '';
			$_POST['Goods']['add_time'] = !empty($_POST['Goods']['add_time']) ? strtotime($_POST['Goods']['add_time']) : '';
			$model->attributes=$_POST['Goods'];

			if($model->save())
				$this->redirect(array('admin','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionGetGoodsItem()
	{
		$taoArr = $numIidArr = $taoRequest= array();
		$taoArr[]= Yii::app()->request->getQuery('id');
		if ( !$taoArr ) {
			die('0');
		}
		$taoRequest = Goods::getTaobaoKeLink($taoArr);
		if ( !$taoRequest ) {
			die('0');
		}
		$numIidArr[] = $taoRequest['0']['num_iid'];


		$items = Goods::processingItems($numIidArr);
		if ( !$items ) {
			die('0');
		}

		$taoRequest['0']['start_time'] = $items['0']['list_time'];
		$taoRequest['0']['end_time'] = $items['0']['delist_time'];
		$taoRequest['0']['add_time'] = date("Y-m-d H:i:s",time());

		$promotion = Goods::processingPromotion($taoRequest['0']['num_iid']);
		
		if ( $promotion ) {
			$taoRequest['0']['start_time'] = $promotion['start_time'];
			$taoRequest['0']['end_time'] = $promotion['end_time'];
			$taoRequest['0']['sale_price'] = $promotion['price'];
		} else {
			$taoRequest['0']['sale_price'] = 0.00;
		}

		echo CJSON::encode($taoRequest['0']);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Goods']))
		{
			$_POST['Goods']['start_time'] = !empty($_POST['Goods']['start_time']) ? strtotime($_POST['Goods']['start_time']) : '';
			$_POST['Goods']['end_time'] = !empty($_POST['Goods']['end_time']) ? strtotime($_POST['Goods']['end_time']) : '';
			$_POST['Goods']['add_time'] = !empty($_POST['Goods']['add_time']) ? strtotime($_POST['Goods']['add_time']) : '';

			$model->attributes=$_POST['Goods'];

			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$res = $list = $errorList = $ids = $hasShowcase = array();
		$model=new Goods;
		
		if(isset($_POST['Goods']))
		{
			$model->keyword = trim($_POST['Goods']['keyword']);
			$model->tbid = trim($_POST['Goods']['tbid']);
			$_POST['Goods']['page'] = ($_POST['Goods']['page'] > 1) ? $_POST['Goods']['page'] : 1;

			$res = Goods::processingIndex($_POST['Goods']);
			
			if ( $res )
			{
				foreach($res as $key => $val) {
					$resetGoods = Goods::model()->find(array(
						'condition'=>'tb_id=:tb_id',
						'params'=>array(':tb_id'=>$val['num_iid'])
					));
					if ( $resetGoods ) {
						$val['goods_id'] = $resetGoods->id;
						$errorList[] = $val;
						continue;
					}

					$goods = new Goods;
					$goods->url = $val['click_url'];
					$goods->title = strip_tags( $val['title'] );
					$goods->shop_url = $val['shop_click_url'];
					$goods->sale_price = $val['price'];
					$goods->tb_id = $val['num_iid'];
					$goods->shop_name = $val['nick'];
					$goods->commission = $val['commission'];
					$goods->quantity = $val['volume'];
					$goods->add_time = time();
					$goods->image_url = $val['pic_url'];
					$goods->commission_rate = $val['commission_rate'] / 100;
					$goods->sort = $val['volume'];
					$goods->cat_id = intval($_POST['Goods']['cat_id']);
					// Goods::processingPromotion($val['num_iid']);

					if ( $goods->save() )
					{
						$ids[] = $val['num_iid'];
						$val['goods_id'] = $goods->id;
						$list[] = $val;
						$list[]['goods_id'] = $goods->id;
					}
				}

				if( $ids )
				{
					$goodsInfo = Goods::processingItems($ids);
					foreach($goodsInfo as $key => $val)
					{
						foreach($ids as $k => $v)
						{
							if( $val['num_iid'] != $v) {
								continue;
							}

							$val['sale_price'] = 0.00;
							if ( $val['has_showcase'] )
							{
								$promotion = Goods::processingPromotion($val['num_iid']);
								if ( $promotion )
								{
									$val['start_time'] = $promotion['start_time'];
									$val['end_time'] = $promotion['end_time'];
									$val['sale_price'] = $promotion['price'];
								}
							}

							Goods::model()->updateAll(array(
								'start_time'=>strtotime($val['list_time']),
								'end_time'=>strtotime($val['delist_time']),
								'price'=>$val['sale_price']
							),'tb_id=:tb_id',array(
								':tb_id'=>$v
							));
						}
					}
					
				}
				get_headers(Yii::app()->params['cacheDomain']);
			}
		}

		$cats = Category::model()->findAll();
		array_unshift($cats, array('id' => 0, 'name' => '无'));

		$this->render('index',array(
			'model'=>$model,
			'cats' => $cats,
			'list'=>$list,
			'errorList'=>$errorList,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Goods('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Goods']))
			$model->attributes=$_GET['Goods'];

		$model->end_time = '>'. time();
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Goods::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='goods-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
