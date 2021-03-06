<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
 			'enctype' => 'multipart/form-data'
		)
	
)); ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php echo $form->errorSummary($model); ?>
	<hr>
	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'sku'); ?>
			<?php echo $form->textField($model,'sku',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'sku'); ?>			
		</div>
		<div class="span4">
			<?php echo $form->labelEx($model,'name'); ?>
			<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'name'); ?>
		</div>
		<div class="span4">
			<?php echo $form->labelEx($model,'price'); ?>
			<?php echo $form->numberField($model,'price'); ?>
			<?php echo $form->error($model,'price'); ?>			
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<?php echo $form->labelEx($model,'description'); ?>
			<?php echo $form->textArea($model,'description',array('class'=>"span12",'size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'description'); ?>
		</div>
	</div>

	<?php if ($model->isNewRecord): ?>
		<div class="row">
			<?php echo $form->labelEx($model,'quantity'); ?>
			<?php echo $form->numberField($model,'quantity'); ?>
			<?php echo $form->error($model,'quantity'); ?>
		</div>
	<?php endif ?>
	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->fileField($model,'image',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>
	<hr>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->