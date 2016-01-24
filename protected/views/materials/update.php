<?php
/* @var $this MaterialsController */
/* @var $model Materials */

$this->breadcrumbs=array(
	'Materials'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Materials', 'url'=>array('index')),
	array('label'=>'Create Material', 'url'=>array('create')),
	array('label'=>'View Material', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Material', 'url'=>array('admin')),
);
?>
<legend>Update Material Information : <small><?php echo $model->name; ?></small></legend>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>