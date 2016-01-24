<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div id="content">
	<div class="row-fluid">
		<div class="span2">
			<?php echo CHtml::link('<span class="icon-arrow-left"></span> Back to list', array('index'), array('class'=>'btn btn-block ')); ?>
		</div>
		<div class="span8">
			<?php if(isset($this->breadcrumbs)):?>
				<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		            'links'=>$this->breadcrumbs,
					'homeLink'=>CHtml::link('Dashboard',array('/home')),
					'htmlOptions'=>array('class'=>'breadcrumb')
		        )); ?><!-- breadcrumbs -->
		    <?php endif?>			
		    <?php echo $content; ?>
		</div>
	</div>
</div><!-- content -->
<?php $this->endContent(); ?>