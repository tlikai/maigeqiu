<?php
$this->breadcrumbs=array(
	'商品'=>array('index'),
	'管理',
);
$this->menu=array(
	array('label'=>'添加商品', 'url'=>array('create')),
	array('label'=>'商品列表', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('goods-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<?php echo CHtml::link('搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'goods-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'filterPosition'=>false,
	'columns'=>array(
		'id',
		'title'=>array(
			'name'=>'title',
			'type'=>'raw',
			'value'=>'CHtml::link($data->title,$data->url,array("target"=>"_blank"))',
			'htmlOptions'=>array('width'=>'300')
		),
		'price',
		'sale_price',
		'quantity',
		'start_time'=>array(
			'name'=>'start_time',
			'type'=>'raw',
			'value'=>'date("Y-m-d H:i:s",$data->start_time)',
		),
		'end_time'=>array(
			'name'=>'end_time',
			'type'=>'raw',
			'value'=>'date("Y-m-d H:i:s",$data->end_time)',
		),
		/*
		'url',
		'shop_url',
		'add_time',
		'image_url',
		'tb_id',
		'shop_name',
		'commission',
		'commission_rate',
		'sort',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
