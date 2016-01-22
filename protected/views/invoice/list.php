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

<h1>
	Invoices
</h1>
<hr>
<?php 	
	$this->widget('zii.widgets.CListView', array(
	    'template'=>"<div class=\"pull-left\"><br>{summary}<br>{sorter}</div><br><div class='clearfix'></div>{items}<br>{pager}",
	    'itemView'=>'_list_view',
	    'dataProvider'=>$dataProvider,
	));
?>