<?php
/* @var $this ProductController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Products',
);

$this->menu=array(
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Manage Products', 'url'=>array('admin')),
);

$toggleAdvanceSearch = <<<EOL
	$("#toggleAdvanceSearch").toggle(function() {
		$("#advanceSearchForm").show();
	}, function() {
		/* Stuff to do every *even* time the element is clicked */
		$("#advanceSearchForm").hide();
	});

	$("body").on('click', '#toggleAdvanceSearch', function(event) {
		$("#toggleAdvanceSearch").toggle();
	});



EOL;
Yii::app()->clientScript->registerScript('toggleAdvanceSearch', $toggleAdvanceSearch, CClientScript::POS_READY);
?>

<div class="row-fluid">
	<div class="span3" style="">
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'<i class=\'icon-search\'></i> Search Product',
			));
		?>
			<?php echo CHtml::beginForm(array(), 'post', array('class'=>'form','style'=>"padding-left: 10px")); ?>
				<br>
				<label>Quick Search :</label>
				<input class='quick-search-field' type="search" name="quick_search" value="" required="required" title="" placeholder='Search..'> <br>
				<hr>
				<a href="#" id="toggleAdvanceSearch">Advance search &raquo;</a>
				<div id="advanceSearchForm" style="display:none">
					@TODO
				</div>
			<?php echo CHtml::endForm(); ?>
			
		<?php
			$this->endWidget();
		?>
	</div>
	<div class="span9">
		<h1>
			<img src="//icons.iconarchive.com/icons/custom-icon-design/flatastic-5/64/Product-sale-report-icon.png">
			All Products
		</h1>

		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'template'=>"<div class='pull-right'>{summary}</div>\n<div class='pull-left'>{sorter}</div><div class='clearfix'></div>\n{items}\n{pager}",
			'sortableAttributes'=>array('sku','name','quantity','price'),
			'itemView'=>'_view',
		)); ?>
	</div>



</div>
