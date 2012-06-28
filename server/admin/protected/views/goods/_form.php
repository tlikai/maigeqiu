<?php Yii::app()->clientScript->registerCoreScript('jquery');?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'goods-form',
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<label for="Goods_short_title">淘宝ID</label>		
		<input size="20" maxlength="30" name="" id="taoId" type="text">
		<input type="button" id="taoButton" value="采集"/>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'short_title'); ?>
		<?php echo $form->textField($model,'short_title',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'short_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sale_price'); ?>
		<?php echo $form->textField($model,'sale_price'); ?>
		<?php echo $form->error($model,'sale_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quantity'); ?>
		<?php echo $form->textField($model,'quantity'); ?>
		<?php echo $form->error($model,'quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_time'); ?>
		<?php echo $form->textField($model,'start_time',array('class'=>'Wdate','value'=>$model->start_time ? date("Y-m-d H:i:s",$model->start_time) : "",'onclick'=>'WdatePicker({dateFmt:"yyyy-MM-dd H:mm:ss",startDate:"%y-%M-%d 0:00:00"})')); ?>
		<?php echo $form->error($model,'start_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_time'); ?>
		<?php echo $form->textField($model,'end_time',array('class'=>'Wdate','value'=>$model->end_time ? date("Y-m-d H:i:s",$model->end_time) : "",'onclick'=>'WdatePicker({dateFmt:"yyyy-MM-dd H:mm:ss",startDate:"%y-%M-%d 0:00:00"})')); ?>
		<?php echo $form->error($model,'end_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'shop_url'); ?>
		<?php echo $form->textField($model,'shop_url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'shop_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'add_time'); ?>
		<?php echo $form->textField($model,'add_time',array('value'=>$model->add_time ? date("Y-m-d H:i:s",$model->add_time) : "",'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'add_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image_url'); ?>
		<?php echo $form->textField($model,'image_url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'image_url'); ?>
		<br>
	<img src="<?php echo $model->image_url;?>" id="imgUrl" />
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tb_id'); ?>
		<?php echo $form->textField($model,'tb_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'tb_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'shop_name'); ?>
		<?php echo $form->textField($model,'shop_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'shop_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'commission'); ?>
		<?php echo $form->textField($model,'commission'); ?>
		<?php echo $form->error($model,'commission'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'commission_rate'); ?>
		<?php echo $form->textField($model,'commission_rate'); ?>
		<?php echo $form->error($model,'commission_rate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sort'); ?>
		<?php echo $form->textField($model,'sort'); ?>
		<?php echo $form->error($model,'sort'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script >
$('#taoButton').click(function (){
	var taoId = $('#taoId').val();
	$.getJSON('index.php?r=goods/getGoodsItem',{id:taoId},function (json){
		if(json)
		{
			$('#Goods_title').val(json.title);
			$('#Goods_sale_price').val(json.price);
			$('#Goods_price').val(json.sale_price);
			$('#Goods_quantity').val(json.volume);
			$('#Goods_start_time').val(json.start_time);
			$('#Goods_end_time').val(json.end_time);
			$('#Goods_url').val(json.click_url);
			$('#Goods_shop_url').val(json.shop_click_url);
			$('#Goods_add_time').val(json.add_time);
			$('#Goods_image_url').val(json.pic_url);
			$('#imgUrl').attr('src',json.pic_url+'_310x310.jpg');
			
			$('#Goods_tb_id').val(json.num_iid);
			$('#Goods_shop_name').val(json.nick);
			$('#Goods_commission').val(json.commission);
			$('#Goods_commission_rate').val(json.commission_rate);
			$('#Goods_sort').val('0');
		}
		else
		{
			$('input[type="text"]').val(null);
		}
	});
});
</script>
