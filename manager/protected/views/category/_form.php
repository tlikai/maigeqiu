<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'app_id'); ?>
		<?php echo $form->dropDownList($model, 'app_id', $model->getAppList()); ?>
		<?php echo $form->error($model,'app_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'listorder'); ?>
		<?php echo $form->textField($model,'listorder'); ?>
		<?php echo $form->error($model,'listorder'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
