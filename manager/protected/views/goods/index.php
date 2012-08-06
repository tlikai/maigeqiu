<div class="form">

<pre class="errorSummary" style="background-color:#CAE1FF; border:1px solid #BCD2EE; ">
试例
标题	: 空间 免费
淘宝ID	: 3156005936,3156005936
页数	: API 返回结果翻页,API每页最大显示40条数据
</pre>
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
)); ?>
	<strong>关键字</strong>
	
	<?php echo $form->textField($model,'keyword'); ?>
	<strong>淘宝ID</strong>
	<?php echo $form->textField($model,'tbid'); ?>
	<strong>分类</strong>
	<?php echo $form->dropDownList($model, 'cat_id', CHtml::listData($cats, 'id', 'name')); ?>
	<strong>页数</strong>
	<select name="Goods[page]">

	<?php 
		for($i = 1 ; $i < 99 ; $i++){
			echo "<option>{$i}</option>";
		}
	?>
	</select>

	<input type="submit" value="采集" id="search"/>
<?php $this->endWidget(); ?>

<?php if(count($errorList) > 0) { ?>
<div class="errorSummary"><p>重复商品ID:</p>
<ul>
<?php 
foreach($errorList as $key => $val) {
	if(is_array($val)) {
?>
	<li><a href="<?php echo $val['click_url'];?>" target="_blank"><?php echo $val['title'];?></a> 淘宝ID:<?php echo $val['num_iid'];?> <a target="_blank" href="index.php?r=goods/update&id=<?php echo $val['goods_id'];?>"> 修改商品</a></li>
<?php } }?>
</ul>
</div>
<?php } ?>

<?php if(count($list) > 0) { ?>
<div class="errorSummary" style="background-color:#fedcbd; border-color:#f47920;"><p>成功添加:</p>
<ul>
<?php 
		foreach($list as $key => $val) {
				if(is_array($val)) {

					if(!isset($val['click_url'])) {
						continue;
					}

?>
	<li><a href="<?php echo $val['click_url'];?>" target="_blank"><?php echo $val['title'];?></a> 淘宝ID:<?php echo $val['num_iid'];?> <a target="_blank" href="index.php?r=goods/update&id=<?php echo $val['goods_id'];?>"> 修改商品</a></li>
<?php }} ?>
</ul>
</div>
<?php } ?>


</div>


