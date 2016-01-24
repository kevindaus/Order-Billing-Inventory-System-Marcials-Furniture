<?php
/* @var $this MaterialsController */
/* @var $model Materials */

$this->breadcrumbs=array(
	'Materials'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Materials', 'url'=>array('index')),
	array('label'=>'Create Material', 'url'=>array('create')),
);

?>


<h1>Materials</h1>
<hr>
<div>
<div class="pull-right">
</div>
<div class="pull-left">
	<div class="btn-group">
		<?php echo CHtml::link("<span class='icon icon-list-alt'></span> List", array("index"), array('class'=>'btn btn-default')); ?>
		<?php echo CHtml::link("<span class='icon  icon-th'></span> Grid", array("admin"), array('class'=>'btn btn-default')); ?>
	</div>
</div>
<div class="clearfix">
</div>

<div>
	<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
	</p>
</div>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'materials-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'sku',
		'description',
		'quantity',
		'cost',
		'unit_measurement',
		array(
			'class'=>'CButtonColumn',
			'header'=>'Action'
		),
	),
)); ?>
