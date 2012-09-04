<?php
$this->breadcrumbs=array(
	'分类'=>array('index'),
	'添加',
);

$this->menu=array(
	array('label'=>'分类列表', 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>