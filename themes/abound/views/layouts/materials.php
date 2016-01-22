<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div id="content">
	<div class="row-fluid">
		<div class="offset2 span8">
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