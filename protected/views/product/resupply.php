<?php 

/* @var $model Product */

?>
<div class="span6">
<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>'Re-supply Product - <strong>'.$model->name.'</strong>',
	));
?>
<?php echo CHtml::beginForm(Yii::app()->request->requestUri, 'post', array('class'=>'form-vertical')); ?>
<?php echo CHtml::activeHiddenField($model, 'id'); ?>
<?php 
	$this->widget('bootstrap.widgets.TbAlert', array(
	    'fade'=>true,
	    'closeText'=>'×',
	    'alerts'=>array(
		    'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'),
		    'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'),
		    'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'),
	    ),
	)); 
?>
<table class="table table-hover">
	<tbody>
		<tr>
			<td>
				<?php echo CHtml::activeLabel($model, 'name', array()); ?>
			</td>
			<td>
				<?php echo CHtml::activeTextField($model, 'name', array('readonly'=>'readonly')); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo CHtml::activeLabel($model, 'sku', array()); ?>
			</td>
			<td>
				<?php echo CHtml::activeTextField($model, 'sku', array('readonly'=>'readonly')); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo CHtml::activeLabel($model, 'description', array()); ?>
			</td>
			<td>
				<?php echo CHtml::activeTextArea($model, 'description', array('readonly'=>'readonly')); ?>
			</td>
		</tr>
		<tr>
			<td>
				Current Quantity
			</td>
			<td>
				<?php echo CHtml::activeTextField($model, 'quantity', array('readonly'=>'readonly')); ?>
			</td>
		</tr>
		<tr>
			<td>
				<span class='icon-plus-sign'></span>
				Add Quantity
			</td>
			<td>
				<?php echo CHtml::textField('quantityToBeAdded', 0); ?>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<button type="submit" class="btn btn-primary btn-block">Submit</button>
			</td>
		</tr>
	</tbody>
</table>
<?php echo CHtml::endForm(); ?>

<?php
	$this->endWidget();
?>
</div>