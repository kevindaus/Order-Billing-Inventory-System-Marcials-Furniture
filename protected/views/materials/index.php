<?php
/* @var $this MaterialsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Materials',
);

$this->menu=array(
	array('label'=>'Create Material', 'url'=>array('create')),
	array('label'=>'Manage Materials', 'url'=>array('admin')),
);
?>
<div class="row-fluid">

	<div class="span3">
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'<i class=\'icon-search\'></i> Find Material ',
			));
		?>
			<?php echo CHtml::beginForm(array('/materials/index'), 'GET', array()); ?>
			<br>
			<?php echo CHtml::activeLabelEx($searchModel, 'name', array()); ?>
			<?php echo CHtml::activeTextField($searchModel, 'name', array()); ?>
			<?php echo CHtml::activeLabelEx($searchModel, 'sku', array()); ?>
			<?php echo CHtml::activeTextField($searchModel, 'sku', array()); ?>
			<?php echo CHtml::activeLabelEx($searchModel, 'description', array()); ?>
			<?php echo CHtml::activeTextField($searchModel, 'description', array()); ?>
			<?php echo CHtml::activeLabelEx($searchModel, 'quantity', array()); ?>
			<?php echo CHtml::activeTextField($searchModel, 'quantity', array()); ?>
			<?php echo CHtml::activeLabelEx($searchModel, 'cost', array()); ?>
			<?php echo CHtml::activeTextField($searchModel, 'cost', array()); ?>
			<?php echo CHtml::activeLabelEx($searchModel, 'unit_measurement', array()); ?>
			<?php echo CHtml::activeTextField($searchModel, 'unit_measurement', array()); ?>
			<button type='submit' class='btn btn-primary'><span class='icon-white icon-search'></span> Search</button>
			<?php echo CHtml::endForm(); ?>
		<?php
			$this->endWidget();
		?>
	</div>
	<div class="span9">
		<?php
		$this->widget('bootstrap.widgets.TbAlert', array(
		    'fade'=>true, // use transitions?
		    'closeText'=>'×', // close link text - if set to false, no close link is displayed
		    'alerts'=>array( // configurations per alert type
			    'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
			    'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
			    'warning'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
		    ),
		)); ?>
		<h1>
			<?php echo CHtml::image(Yii::app()->theme->baseUrl.'/img/Product-sale-report-icon.png', '', array()); ?>
			Materials
			<small><?php echo CHtml::link('[create new]', array('create')); ?></small>
		</h1>
		<hr>
		<div class="pull-right">
		</div>
		<div class="pull-left">
			<div class="btn-group">
				<?php echo CHtml::link("<span class='icon icon-list-alt'></span> List", array("index"), array('class'=>'btn btn-default')); ?>
				<?php echo CHtml::link("<span class='icon  icon-th'></span> Grid", array("admin"), array('class'=>'btn btn-default','prompt'=>"Are you sure you want to delete this record ?")); ?>
			</div>
		</div>
		<div class="clearfix"></div>

		<br>
		<br>
		<div style="border : 1px solid #eee; padding: 10px;border-radius: 10px">
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'template'=>"<div style='float:right'>{summary}</div>\n<div style='float:left'>{sorter}</div><div class='clearfix'></div>\n{items}\n{pager}",
			'itemView'=>'_view',
		      'sortableAttributes'=>array(
		          'sku',
		          'name',
		          'quantity',
		          'cost',
		          'unit_measurement'=>'Unit of measurement',
		      ),
		)); ?>
		</div>
	</div>
</div>

