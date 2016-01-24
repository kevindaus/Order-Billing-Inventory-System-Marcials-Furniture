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
//         $updateLink = CHtml::link('<i class="icon-pencil"></i> Update', array('update', 'id' => $model->id), array());
//         $deleteLink = CHtml::link('<i class="icon-trash"></i> Delete', array('delete', 'id' => $model->id), array('confirm'=>"Are you sure you want to delete this record ?"));
//         $toggleLink = <<<EOL
//     <div>
//         <div class="btn-group">
//           <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">Action<span class="caret"></span></a>
//           <ul class="dropdown-menu">
//             <li>
//             </li>
//             <li>
//             </li>
//           </ul>
//         </div>
//     </div>
// EOL;
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
            echo CHtml::link(CHtml::image($baseUrl . "/uploads/$model->image", "", array('style' => 'height: 200px;', 'class' => 'img-polaroid')), array('materials/view', 'id' => $model->id));
        }else{
            echo CHtml::link(CHtml::image($baseUrl . '/uploads/not available.png', "", array('style' => 'height: 200px;', 'class' => 'img-polaroid')), array('materials/view', 'id' => $model->id));
        }
        
        ?>
        <br>
    </div>
    <div class="span9">
        <?php $this->widget('zii.widgets.CDetailView', array(
            'data' => $model,
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

