<?php
/* @var $this MaterialsController */
/* @var $model Materials */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'materials-form',
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
	<div class="row">
		<?php echo $form->errorSummary($model); ?>
	</div>
	<hr>
	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'name'); ?>
			<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'name'); ?>
		</div>
		<div class="span4">
			<?php echo $form->labelEx($model,'sku'); ?>
			<?php echo $form->textField($model,'sku',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'sku'); ?>
		</div>		
		<div class="span4">
			<?php echo $form->labelEx($model,'cost'); ?>
			<div class="input-prepend">
			  <span class="add-on">P</span>
			  <?php echo $form->textField($model,'cost',array('size'=>60,'maxlength'=>255,'class'=>'span8')); ?>
			</div>		
			<?php echo $form->error($model,'cost'); ?>
		</div>		
	</div>
	<hr>
	<div class="row">
		<div class="span4">
			<?php echo $form->labelEx($model,'sku'); ?>
			<?php echo $form->textField($model,'sku',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'sku'); ?>
		
		</div>
		<div class="span4">
			<?php echo $form->labelEx($model,'quantity'); ?>
			<?php echo $form->textField($model,'quantity'); ?>
			<?php echo $form->error($model,'quantity'); ?>
		</div>
		<div class="span4">
			<?php echo $form->labelEx($model,'unit_measurement'); ?>
			<?php echo $form->textField($model,'unit_measurement',array('size'=>60,'maxlength'=>255,'class'=>'span9')); ?>
			<?php echo $form->error($model,'unit_measurement'); ?>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="span11">
			<?php echo $form->labelEx($model,'description'); ?>
			<?php echo $form->textArea($model,'description',array('size'=>60,'maxlength'=>255,'class'=>"span12")); ?>
			<?php echo $form->error($model,'description'); ?>			
		</div>
	</div>
	<br>
	<div class="row">
	</div>


	<div class="row">
	</div>
	<br>
	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->fileField($model,'image',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>



	<hr>

	<div class="row buttons well">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->