<?php
/* @var $this MaterialsController */
/* @var $model Materials */

$this->breadcrumbs=array(
	'Materials'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Materials', 'url'=>array('index')),
	array('label'=>'Manage Materials', 'url'=>array('admin')),
);
?>

<legend>Create Material Record</legend>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>