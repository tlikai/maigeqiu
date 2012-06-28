<?php
$this->breadcrumbs=array(
	'商品管理'=>array('index'),
	'修改',
);

$this->menu=array(
	/*array('label'=>'创建商品', 'url'=>array('create')),*/
	array('label'=>'商品列表', 'url'=>array('admin')),
);
?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
