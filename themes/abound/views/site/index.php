<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl; 
?>


<div class="row-fluid">

	<div class="span6">

        <?php
            $this->beginWidget('zii.widgets.CPortlet', array(
                'title'=>'<span class="icon-th-list"></span> Materials Inventory Report '.CHtml::link("<i class='icon-plus'></i> register material", array("materials/create"), array('class'=>'btn pull-right','style'=>'border-top-width: -10;margin-top: -4px;')).'<div class="cleafix"></div>',
                'titleCssClass'=>''
            ));
        ?>


        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'materials-grid',
            'dataProvider'=>$materialModel->search(),
            'filter'=>$materialModel,
            'columns'=>array(
                // 'id',
                'name',
                'sku',
                'quantity',
                array(
                    'class'=>'CButtonColumn',
                    'viewButtonUrl'=>'Yii::app()->controller->createUrl("materials/view",array("id"=>$data->primaryKey))',
                    'updateButtonUrl'=>'Yii::app()->controller->createUrl("materials/update",array("id"=>$data->primaryKey))',
                    'deleteButtonUrl'=>'Yii::app()->controller->createUrl("materials/delete",array("id"=>$data->primaryKey))',
                ),
                /*
                'description',
                'image',
                'last_update',
                */
            ),
        )); ?>
        
        
        <?php $this->endWidget(); ?>


	</div><!--/span-->
	<div class="span6">
        <?php
            $this->beginWidget('zii.widgets.CPortlet', array(
                'title'=>'<span class="icon-th-list"></span> Product Inventory Report'.CHtml::link("<i class='icon-plus'></i> register product", array("product/create"), array('class'=>'btn pull-right','style'=>'border-top-width: -10;margin-top: -4px;')).'<div class="cleafix"></div>',
            ));
        ?>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'product-grid',
            'dataProvider'=>$productModel->search(),
            'filter'=>$productModel,
            'columns'=>array(
                // 'id',
                'sku',
                'name',
                'quantity',
                'price',
                array(
                    'class'=>'CButtonColumn',
                    'viewButtonUrl'=>'Yii::app()->controller->createUrl("product/view",array("id"=>$data->primaryKey))',
                    'updateButtonUrl'=>'Yii::app()->controller->createUrl("product/update",array("id"=>$data->primaryKey))',
                    'deleteButtonUrl'=>'Yii::app()->controller->createUrl("product/delete",array("id"=>$data->primaryKey))',

                ),
                /*
                'description',
                'image',
                'date_created',
                'date_updated',
                */
            ),
        )); ?>

    
        <?php
            $this->endWidget();
        ?>

        	
	</div><!--/span-->
</div><!--/row-->

