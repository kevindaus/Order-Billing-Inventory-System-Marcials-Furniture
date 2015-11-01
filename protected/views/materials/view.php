<?php
/* @var $this MaterialsController */
/* @var $model Materials */

$this->breadcrumbs=array(
	'Materials'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Materials', 'url'=>array('index')),
	array('label'=>'Create Material', 'url'=>array('create')),
	array('label'=>'Update Material', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Material', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Material', 'url'=>array('admin')),
);
$baseUrl = Yii::app()->theme->baseUrl;
?>



<h1>View Material <small><?php echo $model->name; ?></small></h1>
<div class="">
    <div class="span3">
        <?php
            if (isset($model->image) && !empty($model->image)) {
                echo CHtml::image($baseUrl.'/uploads/'.$model->image,"",array('style'=>'height: 200px;','class'=>'img-polaroid'));
            }else{
                echo CHtml::image($baseUrl.'/uploads/not available.png',"",array('style'=>'height: 200px;','class'=>'img-polaroid'));
            }

        ?>
    </div>
    <div class="span9">
        <?php $this->widget('zii.widgets.CDetailView', array(
            'data' => $model,
            'attributes' => array(
                'id',
                'name',
                'sku',
                'description',
//                'image',
                'quantity',
                'last_update',
            ),
        ));

        ?>

    </div>
</div>

