<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs = array(
    'Products' => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => 'List Products', 'url' => array('index')),
    array('label' => 'Create Product', 'url' => array('create')),
    array('label' => 'Update Product', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Product', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Products', 'url' => array('admin')),
);

$baseUrl = Yii::app()->theme->baseUrl; 
?>

<h1>View Product <small><?php echo $model->name; ?></small></h1>
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
                'sku',
                'name',
                'description',
                'quantity',
                'price',
                'date_created',
                'date_updated',
            ),
        ));

        ?>
        
    </div>
</div>

