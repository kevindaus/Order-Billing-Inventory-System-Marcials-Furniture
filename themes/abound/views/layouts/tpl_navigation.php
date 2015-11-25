<?php
/*
 * @var $this Controller
 * */

Yii::app()->clientScript->registerCss('topNavClass', '
.top-nav-button {
  margin-bottom: 8px;
}

  ');
?>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
    <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <?php echo CHtml::link(Yii::app()->name, array('site/index'), array('class'=>'brand')); ?>  
          <!-- Be sure to leave the brand out there if you want it shown -->
          <div class="nav-collapse">
			     <?php $this->widget('zii.widgets.CMenu',array(
                    'htmlOptions'=>array('class'=>'pull-right nav'),
                    'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
					           'itemCssClass'=>'item-test',
                    'encodeLabel'=>false,
                    'items'=>array(
                        array('label'=>'Dashboard', 'url'=>array('/site/index'),'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Product', 'url'=>array('/product/index'),'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Materials', 'url'=>array('/materials/index'),'visible'=>!Yii::app()->user->isGuest),
                        array('label'=>'Invoices <span class="caret"></span>', 'url'=>'#','visible'=>!Yii::app()->user->isGuest,'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
                            array('label'=>'List invoices ', 'url'=>Yii::app()->createUrl("invoice/list")),
                              array('label'=>'Create invoice ', 'url'=>Yii::app()->createUrl("invoice/create")),
                        )),                        
                        array('label'=>'Login', 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest),
                    ),
                )); ?>
    	</div>
    </div>
	</div>
</div>

<div class="subnav navbar navbar-fixed-top">
    <div class="navbar-inner">
    </div><!-- navbar-inner -->
</div><!-- subnav -->