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



<?php
    $this->beginWidget('application.libs.widgets.MaterialPortlet', array(
        'material_model'=>$model,
    ));
?>
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
    <div class="clearfix"></div>
    <div class=''>
    <h3>Required materials <?php echo CHtml::link('[Add More]', array('/product/requirement','product_id'=>$model->id)); ?> </h3>
        <ul>
            <?php foreach ($requiredMaterials as $key => $currentRequiredMaterial): ?>
                <li>
                    <h4>
                        <?php echo $currentRequiredMaterial->material->name ?> 
                        - 
                        <small>
                        <?php 
                            echo sprintf("%s %s", $currentRequiredMaterial->quantity , $currentRequiredMaterial->material->unit_measurement) 
                        ?>
                        </small>
                        
                    </h4>
                </li>
            <?php endforeach ?>
        </ul>
    </div>



<?php
    $this->endWidget();
?>
