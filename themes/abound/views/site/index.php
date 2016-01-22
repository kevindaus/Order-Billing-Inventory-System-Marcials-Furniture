<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl; 
Yii::app()->clientScript->registerCss('labelscss', '
.upper-label{
    box-sizing: border-box;
    display: block;
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-size: 12px;
    width: 105.497px;
    color: #1D2E7B;
    font-weight: bold;
    font-size: 20px;
    margin-top: 14px;
}
.upper-label-description {
    color: rgb(153, 153, 153);
    display: inline;
    font-family: "Carrois Gothic", sans-serif;
    font-size: 14px;
    font-weight: normal;
    height: auto;
    line-height: 12.7273px;
    width: auto;
}

');





?>


<div class="row-fluid">
    <div class="span4 offset1 well">
        <div class="span4">
            <?php echo CHtml::image($baseUrl.'/img/Actions-view-calendar-week-icon.png', 'alt'); ?>
        </div>
        <div class="span8">
            <div class="upper-label"> 
                <?php echo Yii::app()->numberFormatter->formatCurrency($thisWeeksSale, 'P') ?>
            </div>
            <div class="upper-label-description">This Week's Sale</div>
        </div>
    </div>
    <div class="span4 well">
        <div class="span4">
            <?php echo CHtml::image($baseUrl.'/img/Actions-view-calendar-month-icon.png', 'alt'); ?>
        </div>
        <div class="span8">
            <div class="upper-label"> 
            <div class="upper-label"> 
            <?php echo Yii::app()->numberFormatter->formatCurrency($wholeMonthSale, 'P') ?>
            </div>
            </div>
            <div class="upper-label-description">This Month's Sale</div>
        </div>
    </div>
</div>
<hr>

<div class="row-fluid">

	<div class="span6">

        <?php
            $this->beginWidget('zii.widgets.CPortlet', array(
                'title'=>'<span class="icon-th-list"></span> Materials Inventory Report '.CHtml::link("<i class='icon-plus'></i> register material", array("materials/create"), array('class'=>'btn pull-right','style'=>'border-top-width: -10;margin-top: -4px;')).'<div class="cleafix"></div>',
                'titleCssClass'=>''
            ));
        ?>


        <?php $this->widget('yiiwheels.widgets.grid.WhGridView', array(
            'id'=>'materials-grid',
            'ajaxUpdate'=>false,
            'itemsCssClass'=>'table-bordered table-stripped',
            'dataProvider'=>$materialModel->search(),
            'filter'=>$materialModel,
            'columns'=>array(
                'name',
                'sku',
                array(
                        'header'=>"Quantity",
                        'type'=>"raw",
                        'name'=>"quantity",
                        'value'=>'$data->quantity .\' \'. $data->unit_measurement',
                    ),
                'cost',
                array(
                    'header'=>'Update supply',
                    'type'=>'raw',
                    'value'=>'CHtml::link("<span class=\' icon-repeat\'></span>", array(\'materials/resupply\',\'material_id\'=>$data->id))',
                ),
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

        <?php $this->widget('yiiwheels.widgets.grid.WhGridView', array(
            'id'=>'product-grid',
            'ajaxUpdate'=>false,
            'dataProvider'=>$productModel->search(),
            'filter'=>$productModel,
            'columns'=>array(
                // 'id',
                // 'sku',
                array(
                    "header"=>"Product name",
                    "name"=>"name",
                    "type"=>"raw",
                    "value"=>'$data->name." -<strong> ".$data->quantity." left</strong>"',
                ),
                // 'name',
                // 'quantity',
                'price',
                array(
                    'header'=>'Update supply',
                    'type'=>'raw',
                    'value'=>'CHtml::link("<span class=\' icon-repeat\'></span>", array(\'product/resupply\',\'product_id\'=>$data->id))',
                ),
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



<div class="row-fluid">
    <div class="span12">
      <?php
        $this->beginWidget('zii.widgets.CPortlet', array(
            'title'=>'<span class="icon-th-large"></span>Income Chart',
            'titleCssClass'=>''
        ));
        ?>

        <?php
            $this->widget(
                'yiiwheels.widgets.highcharts.WhHighCharts',
                array(
                    'pluginOptions' => array(
                        'title'  => array('text' => 'Monthly Sale'),
                        'xAxis'  => array(
                            'categories' => array("January","February","March","April","May","June","July","August","September","October","November","December")
                        ),
                        'yAxis'  => array(
                            'title' => array('text' => 'Sale')
                        ),
                        'series' => array(
                            array(
                                'name' => 'Sale', 
                                'data' => array_values($annualMonthlyReport)
                                ),
                        )
                    )
                )
            );
        ?>

        <?php $this->endWidget(); ?>
    </div>
</div><!--/row-->

          
