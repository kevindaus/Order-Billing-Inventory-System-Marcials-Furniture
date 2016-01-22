<?php
/* @var $this MaterialsController */
/* @var $data Materials */

$baseUrl = Yii::app()->theme->baseUrl; 

?>


<div class="view">
<h1>
    <div>
        <div class="btn-group">
          <a class="btn btn-primary" href="#">
            <i class="icon-book icon-white"></i>
            Action
        </a>
          <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li>
                <?php echo CHtml::link('<i class="icon-pencil"></i> Update', array('update','id'=>$data->id), array()); ?>
            </li>
            <li>
                <?php echo CHtml::link('<i class="icon-trash"></i> Delete', array('delete','id'=>$data->id), array()); ?>
            </li>
          </ul>
        </div>            
    </div>

</h1>
<div class="">
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
</div>


</div>