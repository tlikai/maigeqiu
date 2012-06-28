<?php
$this->breadcrumbs=array(
	'商品管理'=>array('index'),
	'创建',
);

$this->menu=array(
	array('label'=>'List Goods', 'url'=>array('index')),
	array('label'=>'Manage Goods', 'url'=>array('admin')),
);
?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
