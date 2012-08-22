<?php

class SiteController extends Controller
{
	
	public $categoryFlag = array(
		'1' => array(
			'id' => 'ladies',
			'title' => '精选百款初夏爆款 全场享特惠惊喜价',
			'more'	=> '更多特价女装',
		),
		'2'	=> array(
			'id' => 'men',
			'title' => '百搭T恤 潮流所选',
			'more'	=> '更多特价男装',
		),
		'3'	=> array(
			'id' => 'shoes',
			'title'=>'潮范儿凉鞋 疯狂促销',
			'more' => '更多款特价男女鞋',
		),
		'4' => array(
			'id' => 'bags',
			'title' => '改变只需要一点装饰',
			'more' => '更多款特价商品',
		),
		'5'	=> array(
			'id' => 'baby',
			'title' => '辣妈潮童精品，火热促销',
			'more' => '更多款特价商品',
		),
		'6' => array(
			'id' => 'home',
			'title' => '百货品质大促 汇聚全网精品',
			'more' => '更多款特价商品',
		),
		'7' => array(
			'id' => 'beauty',
			'title' => '护肤精选特惠中 打响防晒保卫战',
			'more' => '更多款特价商品',
		),
		'8' => array(
			'id' => 'food',
			'title' => '夏日美味享不停',
			'more' => '更多款特价商品',
		),
		'9' => array(
			'id' => 'digit',
			'title' => '酷暑冰凉家电促',
			'more' => '更多款特价商品',
		),
		'10'=> array(
			'id' => 'outdoors',
			'title' => '城市运动 维护健康',
			'more' => '更多款特价商品',
		)
			
	);
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$page = Yii::app()->request->getQuery('page', 1);
        $catId = Yii::app()->request->getQuery('cat', null );
		$appId = Yii::app()->params['appId'];

        $view = 'index';
        $layout = $this->layout;

        $goods = Goods::getGoods($appId, $catId, $page);
        $cats = Category::model()->getByAppId( $catId  );
        $this->layout = $layout;
        $this->render($view, array(
            'cats' => $cats,
            'data' => $goods['data'],
            'pager' => $goods['pager'],
        	'catId' => $catId,
        ));
	}

    public function actionSearch()
    {
		$appId = Yii::app()->params['appId'];
        $cats = Category::model()->getByAppId($appId);
        $catId = Yii::app()->request->getQuery('cat', 0);
        $price = Yii::app()->request->getQuery('price', 0);
        $sort = Yii::app()->request->getQuery('sort', 'price');
        $order = Yii::app()->request->getQuery('order', 'desc');
        $keyword = Yii::app()->request->getQuery('keyword', '');
        $dataProvider = null;

        if(!empty($keyword))
        {
            $criteria = new CDbCriteria();
            $criteria->compare('end_time', '>' . time());
            $criteria->compare('title', $keyword, true);
            $catId && $criteria->compare('cat_id', $catId);
            $price && $criteria->compare('price', '<=' . $price);

            if(!in_array($sort, array('price', 'time')))
                $sort = 'time';
            if(!in_array($order, array('asc', 'desc')))
                $order = 'desc';
            $criteria->order = $sort . ' ' . $order;

            $dataProvider = new CActiveDataProvider('Goods', array(
                'criteria' => $criteria
            ));
        }

        $this->render('search', array(
            'cats' => $cats,
            'dataProvider' => $dataProvider,
        ));
    }
	
	public function actionClearCache()
	{
		$files = Array();
		$path  = Yii::app()->runtimePath.'/cache/';
		
		
		$files = ListFiles($path);
		if ( !$files ) {
			die('拒绝访问');
		}
			
		foreach($files as $key => $val)
		{
			unlink($val);
		}
	
	}
	
	public function actionTaoBaoApp()
	{
		$id = Yii::app()->request->getQuery('id');
		
		$this->layout = 'app2';
		
		$page = Yii::app()->request->getQuery('page','1');
		$goods = Goods::getGoods($page);


		$this->render('../app/index',array(
 				'data'=>$goods['data'],
 				'pager'=>$goods['pager'],
		));
		
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}

function ListFiles($dir) {

	if($dh = opendir($dir)) {

		$files = Array();
		$inner_files = Array();

		while($file = readdir($dh)) {
			if($file != "." && $file != ".." && $file[0] != '.') {
				if(is_dir($dir . "/" . $file)) {
					$inner_files = ListFiles($dir . "/" . $file);
					if(is_array($inner_files)) $files = array_merge($files, $inner_files);
				} else {
					array_push($files, $dir . "/" . $file);
				}
			}
		}

		closedir($dh);
		return $files;
	}
}

