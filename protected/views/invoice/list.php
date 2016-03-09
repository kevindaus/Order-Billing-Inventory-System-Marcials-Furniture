<?php
	$baseUrl = Yii::app()->theme->baseUrl; 
	$this->menu = array();
	$dataProvider = $model->search();
	$dataProvider->criteria->order = 'date_created DESC';

?>
<style type="text/css">
	.item .view {
		color: #808080;
	}
	.list-view div.view {
		padding: 20px;
	}
</style>

<script type="text/javascript">
	
function searchWhatChangeEvent(currentDom) {
	if (currentDom.value == "name") {
		jQuery("#stringSearchKeyField").show();
		jQuery("#dateSearchStringField").hide();
	}else if(currentDom.value == "order_date"){
		jQuery("#stringSearchKeyField").hide();
		jQuery("#dateSearchStringField").show();
	}
}

</script>

<h1>
	Invoices
</h1>
<hr>
<div class="">
	<div class="row">
    	<div class="span9 well" style="margin-left :30px;">
			<h4>Search Invoice Record</h4>
			<?php echo CHtml::beginForm(array('/invoice/list'), 'POST'); ?>
			<?php 
				echo CHtml::dropDownList('searchWhat', 'name', array('name'=>'Customer name','order_date'=>"Order date"), array('onchange'=>'searchWhatChangeEvent(this)','prompt'=>'Search what')); 
			?>
			<?php echo CHtml::textField('searchName', '', array('placeholder'=>'Search string','id'=>'stringSearchKeyField')); ?>
			<?php 
				$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				    'id'=>'dateSearchStringField',
				    'name'=>'searchOrderDate',
				    'options'=>array(
				        'showAnim'=>'fold',
				        'changeMonth'=>true,
				        'changeYear'=>true,
				    ),
				    'htmlOptions'=>array(
				        'style'=>'height:20px;display:none;'
				    ),
				));
			?>
			<button type="submit" class="btn btn-primary" style="margin-top: -10px;">Submit</button>
			<?php echo CHtml::endForm(); ?>
			<?php if (isset($_POST['searchWhat'])): ?>
				<hr>
				<h3>You searched : 
					<small>
						<?php if ($_POST['searchWhat'] == 'name'): ?>
							<?php echo $_POST['searchName'] ?>
						<?php endif ?>
						<?php if ($_POST['searchWhat'] == 'order_date'): ?>
							<?php echo $_POST['searchOrderDate'] ?>
						<?php endif ?>
					</small>
				</h3>
			<?php endif ?>
    	</div>
	</div>

</div>
<?php 	
	$this->widget('zii.widgets.CListView', array(
	    'template'=>"<div class=\"pull-left\"><br>{summary}<br>{sorter}</div><br><div class='clearfix'></div>{items}<br>{pager}",
	    'itemView'=>'_list_view',
		// 'sortableAttributes'=>array(
		//   'order_date'=>'Order date',
		// ),	    
	    'dataProvider'=>$listDataProvider,
	));
?>