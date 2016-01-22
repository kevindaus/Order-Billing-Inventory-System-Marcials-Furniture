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
<div style="margin-left: 33px;"> 

<div class="row">
    <div class="span8">
        <h1>View Product <small><?php echo $model->name; ?></small></h1>
        <?php
            $this->widget('bootstrap.widgets.TbAlert', array(
                'fade'=>true, 
                'closeText'=>'×',
                'alerts'=>array(
                    'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'),
                    'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'),
                ),
            )); 
        ?>
    </div>
</div>
<div class="row">
    <div class="span3">
        <?php
            if (isset($model->image) && !empty($model->image)) {
                echo CHtml::image($baseUrl.'/uploads/'.$model->image,"",array('style'=>'height: 200px;','class'=>'img-polaroid'));
            }else{
                echo CHtml::image($baseUrl.'/uploads/not available.png',"",array('style'=>'height: 200px;','class'=>'img-polaroid'));
            }
        
        ?>
    </div>
    <div class="span8">
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
<div class='row'>
    <h3>Required materials : </h3>
    <ul>
        <?php foreach ($requiredMaterials as $key => $currentRequiredMaterial): ?>
            <li>
                <h4>
                    <?php echo $currentRequiredMaterial->material->name ?> 
                    - 
                    <small>
                    <?php 
                        echo $currentRequiredMaterial->quantity 
                    ?> piece(s)
                    </small>
                    
                </h4>
            </li>
        <?php endforeach ?>
    </ul>
</div>

</div>