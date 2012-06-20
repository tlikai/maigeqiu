<?php
$this->breadcrumbs=array(
	'Goods'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Goods', 'url'=>array('index')),
	array('label'=>'Create Goods', 'url'=>array('create')),
	array('label'=>'Update Goods', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Goods', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Goods', 'url'=>array('admin')),
);
?>

<h1>View Goods #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'short_title',
		'price',
		'sale_price',
		'quantity',
		'start_time',
		'end_time',
		'url',
		'shop_url',
		'add_time',
		'image_url',
		'tb_id',
		'shop_name',
		'commission',
		'commission_rate',
		'sort',
	),
)); ?>
