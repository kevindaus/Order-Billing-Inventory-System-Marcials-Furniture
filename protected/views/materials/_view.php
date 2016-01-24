<?php
/* @var $this MaterialsController */
/* @var $data Materials */

$baseUrl = Yii::app()->theme->baseUrl; 

?>

<?php
    $this->beginWidget('application.libs.widgets.MaterialPortlet', array(
        'material_model'=>$data,
    ));
?>

    <div class="span3">
        <?php
        if (isset($data->image) && !empty($data->image)) {
            echo CHtml::link(CHtml::image($baseUrl . "/uploads/$data->image", "", array('style' => 'height: 200px;', 'class' => 'img-polaroid')), array('materials/view', 'id' => $data->id));
        }else{
            echo CHtml::link(CHtml::image($baseUrl . '/uploads/not available.png', "", array('style' => 'height: 200px;', 'class' => 'img-polaroid')), array('materials/view', 'id' => $data->id));
        }
        
        ?>
        <br>
    </div>
    <div class="span9">
        <?php $this->widget('zii.widgets.CDetailView', array(
            'data' => $data,
            'attributes' => array(
                'name',
                'sku',
                'description',
                // 'image',
                'quantity',
                'unit_measurement',
                'cost',
            ),
        ));
        ?>
    </div>
    <div class="clearfix"></div>
<?php
    $this->endWidget();
?>

