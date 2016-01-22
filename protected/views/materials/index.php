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


<h1>Materials</h1>
<hr>
<div class="pull-right">
	<?php echo CHtml::beginForm(array(), 'POST', array()); ?>
	<div class="input-append">
		<input class="span9"  type="text" name='searchTerm' placeholder='Search..'>
		<button class="btn btn-primary" type="button">Search</button>
	</div>
	<?php echo CHtml::endForm(); ?>
</div>
<div class="pull-left">
	<div class="btn-group">
		<?php echo CHtml::link("<span class='icon icon-list-alt'></span> List", array("index"), array('class'=>'btn btn-default')); ?>
		<?php echo CHtml::link("<span class='icon  icon-th'></span> Grid", array("admin"), array('class'=>'btn btn-default','prompt'=>"Are you sure you want to delete this record ?")); ?>
	</div>
</div>
<div class="clearfix">

</div>

<br>
<br>

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
