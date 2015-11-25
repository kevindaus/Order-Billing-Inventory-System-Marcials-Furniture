<?php 

$baseUrl = Yii::app()->theme->baseUrl; 

?>
<div class="row">
    <div class="span9" style="margin-left :30px;">
        <div class="view">
            <div class="row">
                <div class="span6 offset1">
                    <small>
                        <span class="label label-info">
                            
                            <?php 
                                echo count($data->productOrders).' '.Yii::t('app','n<=1#item|n>=2#items',count($data->productOrders));
                            ?>
                        </span>
                    </small>
                    <h1><?php echo sprintf("%s %s %s" , $data->customer->title,$data->customer->firstname,$data->customer->lastname) ?></h1>
                    <strong><?php echo date("F d,Y",strtotime($data->order_date)) ?></strong>
                </div>
                <div class="span4">
                    <small>ID #<?php echo $data->invoice_number ?></small>
                    <h1>P <?php echo number_format($data->total_amt) ?></h1>
                    <strong>
                        <?php echo CHtml::link('<span class="icon-print icon-white"></span> View/Print', array('invoice/print','id'=>$data->invoice_number), array('class'=>"btn btn-success")); ?>
                    </strong>
                </div>
                
            </div>
        </div>
    </div>
</div>