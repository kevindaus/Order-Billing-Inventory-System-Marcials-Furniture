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


/*include angular datepicker*/
Yii::app()->clientScript->registerCssFile($baseUrl.'/bower_components/angularjs-datepicker/dist/angular-datepicker.min.css');
Yii::app()->clientScript->registerScriptFile($baseUrl.'/bower_components/angularjs-datepicker/dist/angular-datepicker.min.js', CClientScript::POS_END);

/*include invoice actual scipt*/
Yii::app()->clientScript->registerScriptFile($baseUrl.'/js/create_invoice_script.js', CClientScript::POS_END);

$registerBaseUrlCode = sprintf("window.BASEURL = '%s'", Yii::app()->getHomeUrl());
Yii::app()->clientScript->registerScript('baseurl', $registerBaseUrlCode, CClientScript::POS_HEAD);


$dateToday = date("F d,Y");


?>
<style type="text/css">
	.required-field {
		color: red;
	}
</style>
<br>
<br>
<div class="container" ng-app="InvoiceModule">
	<div class="span11" ng-controller="IndexCtrl as indexCtrl">
		<div class="row">
			<center>
				<h1>Create Invoice</h1>
			</center>
		</div>
		<div class="row">
			<div class="span7">
				<h3><?php echo Yii::app()->params['company_name'] ?> </h3>
				<strong><?php echo Yii::app()->params['company_street'] ?></strong> <br>
				<strong><?php echo Yii::app()->params['company_city'] ?>,<?php echo Yii::app()->params['company_zipcode'] ?></strong> <br>
				<strong><?php echo Yii::app()->params['company_tel_number'] ?></strong> <br>
			</div>
			<div class="span4">
				<br>
				<br>
				<br>
				<strong>Date : <?php echo $dateToday ?></strong>
				<br>
				<strong ng-model="orderInformation.invoice_number" ng-init="orderInformation.invoice_number='<?php echo uniqid() ?>'">Invoice # : {{::orderInformation.invoice_number}}</strong>
			</div>
		</div>
		<div class='row'>
			<div class="span11">
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="span5 well">
				<form name="billToForm">
					BILL TO :  <br>
					<input ng-init="customerModel.title='Mr'" type="text" class="form-control" required="required" title="" ng-model="customerModel.title" name="bill_to_title">
					<div ng-messages="billToForm.bill_to_title.$error" role="alert">
						<div ng-message="required"  class='required-field'>Please select a title</div>
					</div>

					<br>
					<input ng-model="customerModel.firstname" type="text" name="bill_to_firstname" class="form-control" required placeholder='Firstname (*required)'> 
					<div ng-messages="billToForm.bill_to_firstname.$error" role="alert">
						<div class='required-field' ng-message="required">This field is required</div>
					</div>
					<br>
					<input ng-model="customerModel.middlename" type="text" name="bill_to_middlename"  class="form-control" required="required" title="" placeholder='Middlename (*required)'> 
					<div ng-messages="billToForm.bill_to_middlename.$error" role="alert">
						<div class='required-field' ng-message="required">This field is required</div>
					</div>
					<br>
					<input ng-model="customerModel.lastname" type="text" name="bill_to_lastname" class="form-control" required="required" placeholder='Lastname (*required)'> 
					<div ng-messages="billToForm.bill_to_lastname.$error" role="alert">
						<div class='required-field' ng-message="required">This field is required</div>
					</div>
					<br>
					<input ng-model="customerModel.contact_number" type="text" name="contact_number" class="form-control" placeholder='Contact number (optional)'> 
					<br>
				</form>
			</div>
			<div class="span5 well">
				<form name='shippingAddressForm'>
					SHIP TO : 
					<br>
					<input ng-model="shippingAddressModel.shipping_address_street" type="text" name="shipping_address_street" class="form-control" value="" required="required" placeholder='Street (*required)'>
					<div ng-messages="shippingAddressForm.shipping_address_street.$error" role="alert">
						<div class='required-field' ng-message="required">This field is required</div>
					</div>
					<br>
					<input ng-model="shippingAddressModel.shipping_address_city" type="text" name="shipping_address_city" class="form-control" value="" required="required" placeholder='City/Municipality'>
					<div ng-messages="shippingAddressForm.shipping_address_city.$error" role="alert">
						<div class='required-field' ng-message="required">This field is required</div>
					</div>					
					<br>
					<input ng-model="shippingAddressModel.shipping_address_province" type="text" name="shipping_address_province" class="form-control" value="" required="required" placeholder='Province' readonly="readonly">
					<div ng-messages="shippingAddressForm.shipping_address_province.$error" role="alert">
						<div class='required-field' ng-message="required">This field is required</div>
					</div>					
					<br>
					<input ng-model="shippingAddressModel.shipping_address_country" type="text" name="shipping_address_country" class="form-control" value="" required="required" placeholder='Country' readonly="readonly">
					<div ng-messages="shippingAddressForm.shipping_address_country.$error" role="alert">
						<div class='required-field' ng-message="required">This field is required</div>
					</div>					
					<br>
				</form>
			</div>
		</div>
		<div class="row">
			<form name=""></form>
			<div class="span11">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Sales Person</th>
							<th>Ship Date</th>
							<th>Order Date</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<input ng-init="orderInformation.sales_person='<?php echo Yii::app()->params['company_name'] ?>'" type="text" id="input" class="form-control" required="required" pattern="" title="" ng-model="orderInformation.sales_person">
							</td>
							<td>
							 	<datepicker
							      date-format="MMMM d,y"
							      button-prev='<i class="fa fa-arrow-circle-left"></i>'
							      button-next='<i class="fa fa-arrow-circle-right"></i>'>
							      <input ng-model="orderInformation.ship_date" type="text" class="font-fontawesome font-light radius3" placeholder="Choose a date"/>
							    </datepicker>							
							</td>
							<td>
								<input ng-init="orderInformation.order_date='<?php echo $dateToday ?>'" type="text" id="input" class="form-control" value="" required="required" title="" ng-model="orderInformation.order_date" ng-readonly="true">
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="span11">
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="span11">
				<table class="table table-bordered table-hover table-stripped">
					<thead>
						<tr>
							<th>Product Name</th>
							<th>Description</th>
							<th>Qty.</th>
							<th>Unit Price</th>
							<th>Line Total</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="(key, value) in orderInformation.ordered_products">
							<td>
								{{value.product_name}}
							</td>
							<td>
								{{value.description}}
							</td>
							<td>
								{{value.quantity}}
							</td>
							<td>
								{{value.unit_price}}
							</td>
							<td>
								{{value.line_total}}
							</td>
							<td>
								<button type="button" class="btn btn-link" ng-click="indexCtrl.removeOrderedProduct(key)">
									remove
								</button>
							</td>
						</tr>
						
					</tbody>
					<tfoot>
						<tr class='well'>
							<td>
								<select class="form-control"  ng-model="currentOrderedProduct.product_name">
									<option ng-repeat="(key, value) in productList" value="{{value.product_name}}">{{value.product_name}}</option>
								</select>
							</td>
							<td>
								{{currentOrderedProduct.description}}
							</td>
							<td>
								<input type="number" class="form-control" name="ordered_quantity" ng-model="currentOrderedProduct.ordered_quantity" min=0 max=9999 step="" required="required">
								<br>
									<small ng-show="currentOrderedProduct.ordered_quantity < 0 || currentOrderedProduct.remaining_quantity < currentOrderedProduct.ordered_quantity ">
										*only {{currentOrderedProduct.remaining_quantity}} left
									</small>
							</td>
							<td>
								{{currentOrderedProduct.unit_price}}
							</td>
							<td>
								{{ currentOrderedProduct.line_total }}
							</td>
							<td>
								<button ng-disabled="currentOrderedProduct.ordered_quantity < 0 || currentOrderedProduct.remaining_quantity < currentOrderedProduct.ordered_quantity " ng-click="indexCtrl.addOrderedProduct(currentOrderedProduct)" type="button" class="btn btn-primary">Add</button>	
							</td>
						</tr>						
					</tfoot>
                    
				</table>
			</div>
		</div>
		<div class="row">
			<div class="span6">
				Notes : 
				<textarea ng-model="orderInformation.notes" class="span4" name="" id="input" class="form-control" rows="3" style="margin: 0px 0px 8.99148px; width: 570px; height: 147px;">
				</textarea>
			</div>
			<div class="span4 well">
			<table class="table table-hover table-bordered">
					<tbody>
						<tr>
							<td>Sub Total : </td>
							<td>
								<button type="button" class="btn btn-link">
									{{orderInformation.sub_total | number}}
								</button>
							</td>
						</tr>
						<tr>
							<td>Tax : </td>
							<td>
								<button type="button" class="btn btn-link" ng-click="indexCtrl.changeTax()">
									{{orderInformation.tax| number}} %
								</button> 
								<small>
									{{  (orderInformation.tax * orderInformation.sub_total)/100 | number }}
								</small>
							</td>
						</tr>
						<tr>
							<td>Shipping Fee:</td>
							<td> 
								<button type="button" class="btn btn-link" ng-click="indexCtrl.changeShippingCost()">
									{{orderInformation.shipping | number}} 
								</button>
							</td>
						</tr>
						<tr>
							<td>Total : </td>
							<td>
								<button type="button" class="btn btn-link">
									{{   (orderInformation.total = orderInformation.shipping + (orderInformation.tax * orderInformation.sub_total)/100   + orderInformation.sub_total)  | number}}
								</button>
							</td>
							<td></td>
						</tr>
						<tr>
							<td>Paid : </td>
							<td>
								<input type="number" class="form-control" value="" min="0" required="required" ng-model="orderInformation.paid">
							</td>
						</tr>
						<tr>
							<td>Change : </td>
							<td>
								<button ng-show="orderInformation.change > -1" type="button" class="btn btn-link">{{  (orderInformation.change =  orderInformation.paid - orderInformation.total )  | number}} </button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="span7">
				<hr>
			</div>
			<div class="span3 ">
                <div class="alert alert-info" ng-show=" !(customerModel.isValid() && orderInformation.isValid() && shippingAddressModel.isValid() )">
                    <strong>
                        <span class='icon-info-sign'></span>
                        * Please fix the following issue :
                    </strong>
                    <hr>
                    <ol>
                        <li  ng-show="!customerModel.isValid()">
                            <small>
                                Please provide some details on to whom the product/s will be delivered.
                            </small>
                        </li>
                        <li  ng-show="!orderInformation.isValid()">
                            <small>You forgot to add a product in your cart. Tip : Click the 'Add' button to add the selected product to your list.</small>
                        </li>
                        <li  ng-show="!shippingAddressModel.isValid()">
                            <small>Please provide some details in the shipping address</small>
                        </li>
                    </ol>
                </div>
				<button type="button" class="btn btn-default btn-block btn-primary" ng-disabled=" !(customerModel.isValid() && orderInformation.isValid() && shippingAddressModel.isValid() && !isSendingPurchaseRequest)" ng-click="indexCtrl.submitInvoice(shippingAddressModel,orderInformation,customerModel)">
                    {{purchaseLabelStr}}
                </button>

			</div>
		</div>
	</div>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>