<?php 

/**
 * @var InvoiceController $this 
 */
$baseUrl = Yii::app()->theme->baseUrl; 

/*include font awesome*/
Yii::app()->clientScript->registerCssFile($baseUrl.'/bower_components/font-awesome/css/font-awesome.min.css');

/*include angularjs*/
Yii::app()->clientScript->registerScriptFile($baseUrl.'/node_modules/angular/angular.min.js', CClientScript::POS_END);

/*include ng-message*/
Yii::app()->clientScript->registerScriptFile($baseUrl.'/node_modules/angular-messages/angular-messages.min.js', CClientScript::POS_END);

/*include invoice actual scipt*/
Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/requirement.js', CClientScript::POS_END);


?>
<style type="text/css">
	.clear-list-style {
	}
</style>
<div ng-app="ProductRequirement">
	<div ng-controller="IndexCtrl as indexCtrl">
		<?php echo CHtml::beginForm(Yii::app()->request->requestUri, 'post'); ?>
			<?php echo CHtml::activeHiddenField($model, 'id'); ?>
			<legend>
				Specify default materials used to produce : <strong><?php echo $model->name ?></strong>
			</legend>
			<br>
			<div class="row">
				<div class="span4 offset1">
					<strong>List of materials to be used : </strong>
					<br>
					<ul class='clear-list-style'>
						<li ng-repeat="(current_required_product_key, current_required_product) in requiredProductCollection">
							<input type="hidden" name="required_material_id[]" class="form-control" value="{{current_required_product.material_id}}">
							<input type="hidden" name="required_material_quantity[]" class="form-control" value="{{current_required_product.quantity}}">
							{{current_required_product.material_name}} - <strong>{{current_required_product.quantity}} piece/s</strong>
							<button type="button" class="btn btn-link" ng-click="indexCtrl.removeRequiredMaterial(current_required_product_key)">remove</button>
						</li>
					</ul>
					<br>					
				</div>
				<div class="span6">
					<div class='well'>
						<select ng-model="selectedIndex">
							<option ng-repeat="(current_material_key, current_material) in materials" value="{{current_material_key}}">
								{{current_material.name}}
							</option>
						</select>
						<input type="number" ng-model="currentQuantity" placeholder="Quantity">
						<button ng-click="indexCtrl.addMoreRequiredProduct(selectedIndex,currentQuantity)" type="button" class="btn btn-default btn-block">
							<span class=' icon-plus'></span>
							Add
						</button>
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="span6 offset2">
					<button type="submit" class="btn btn-primary btn-block">
						Submit
					</button>
				</div>
			</div>
		<?php echo CHtml::endForm(); ?>
	</div>
</div>