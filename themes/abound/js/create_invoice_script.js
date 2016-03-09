'use strict';

(function () {

    var invoiceModule = angular.module('InvoiceModule', ['ngMessages', '720kb.datepicker']);
    invoiceModule.controller('IndexCtrl', ['$scope', '$http','$timeout', function ($scope, $http,$timeout) {
        var baseUrl = window.BASEURL;
        var currentController = this;
        $scope.oldCustomers = [];
        $scope.purchaseLabelStr = "Purchase";
        $scope.errorAssistPurchase = "";
        $scope.isSendingPurchaseRequest = false;
        $scope.isOldCustomerDialogOpened = false;
        $scope.shippingAddressModel = {
            "shipping_address_street": "",
            "shipping_address_city": "",
            "shipping_address_province": "Nueva Vizcaya",
            "shipping_address_country": "Philippines",
            isValid:function(){
                var isValidRet = true;
                if(
                    this.shipping_address_city === '' ||
                    this.shipping_address_city == undefined ||
                    this.shipping_address_city == null ||
                    this.shipping_address_city=== ''
                ){
                    isValidRet = false;
                }
                return isValidRet;
            }
        }
        $scope.currentOrderedProduct = {
            "product_name": "",
            "description": "",
            "remaining_quantity": "",
            "ordered_quantity": "",
            "unit_price": "",
            "line_total": ""
        };

        $scope.customerModel = {
            "title": "",
            "firstname": "",
            "middlename": "",
            "lastname": "",
            "contact_number": null,
            "address": "",
            "isModelValid": false,
        }
        $scope.orderInformation = {
            "notes": "",
            "invoice_number": "",
            "sales_person": "",
            "ship_date": "",
            "order_date": "",
            "ordered_products": [],
            "sub_total": "",
            "tax": "",
            "shipping": "",
            "total": "",
            "paid": "",
            "change": "",
            'isValid':function(){
                var isValidRet = true;
                if( this.ordered_products.length === 0 ){
                    isValidRet = false;
                }
                return isValidRet;
            }
        }

        $scope.$watchCollection('orderInformation.ordered_products', function (newVal, oldVal) {
            var tempSubTotalContainer = 0;
            angular.forEach($scope.orderInformation.ordered_products, function (value, key) {
                /*calculate sub total*/
                tempSubTotalContainer += value.line_total;
            });
            $scope.orderInformation.sub_total = tempSubTotalContainer;
            /*compute tax using 0.5%   */
        });



        currentController.openOldCustomerDialog = function(){
            $scope.isOldCustomerDialogOpened = true;
            $("#oldCustomer").dialog("open"); return false;
        }
        // currentController.loadSelectedOldCustomer = function(){
        //     var custName = jQuery("#city").val();
        //     console.log('loading old customer');
        //     $http({
        //       method: 'GET',
        //       url: "/invoice/getCustomerInfo?customerName="+custName
        //     }).then(function successCallback(response) {
        //         $scope.customerModel = response.data;
        //         $("#oldCustomer").dialog("close");
        //       }, function errorCallback(response) {
        //         console.log("Sorry cant load customer information")
        //         $("#oldCustomer").dialog("close");
        //       });
        // }

        currentController.changeTax = function () {
            var newTax = prompt("Enter new tax (percentrage)", "0.5");
            newTax = parseFloat(newTax);
            if (newTax >= 0 && newTax <= 100) {
                $scope.orderInformation.tax = newTax;
            } else {
                alert('Invalid tax input');
            }
        }


        currentController.loadAllOldCustomers = function(){
            $http.get("/invoice/allOldCustomers")
                .then(function (response) {
                    $scope.oldCustomers = response.data;
                }, function () {
                    alert("Failed to retrieve list of old customers");
                });
        }

        currentController.loadAllOldCustomers();


        $scope.$watch("customerModel",function(newvalue,oldvalue){
            var addressArr = [];

            if (newvalue && newvalue.address) {
                addressArr = newvalue.address.split(","); 
                $scope.shippingAddressModel.shipping_address_street = addressArr[0];
                $scope.shippingAddressModel.shipping_address_city = addressArr[1];            
            }else{
                if ($scope.isOldCustomerDialogOpened) {
                    $scope.shippingAddressModel.shipping_address_street = "";
                    $scope.shippingAddressModel.shipping_address_city = "";
                }
            }
            $scope.customerModel['title'] = newvalue['title'];
            $scope.customerModel.firstname = newvalue.firstname;
            $scope.customerModel.middlename = newvalue.middlename;
            $scope.customerModel.lastname = newvalue.lastname;
            console.log(newvalue);
            if (newvalue.contact_number) {
                $scope.customerModel.contact_number = parseFloat(newvalue.contact_number);
            }
            if (newvalue.contactNumber) {
                $scope.customerModel.contact_number = parseFloat(newvalue.contactNumber);
            }
            

            /*check customer model validity*/
            if(
                $scope.customerModel.firstname === '' ||
                $scope.customerModel.firstname == undefined ||
                $scope.customerModel.firstname == null ||
                $scope.customerModel.lastname=== '' ||
                $scope.customerModel.lastname == undefined ||
                $scope.customerModel.lastname == null
            ){
                $scope.customerModel.isModelValid = false;
            }else{
                $scope.customerModel.isModelValid = true;
            }

        },true);



        currentController.closeDialog = function(){
            $scope.isOldCustomerDialogOpened = false;
            $("#oldCustomer").dialog("close");
        }

        currentController.changeShippingCost = function () {
            var shipping = prompt("Enter cost of shipping", "0");
            shipping = parseFloat(shipping);
            $scope.orderInformation.shipping = shipping;
        }
        /* array collection of product name*/
        $scope.productList = [];
        currentController.getProductList = function () {
            /*retrieves data from product/json */
            $http.get("/product/json")
                .then(function (response) {
                    angular.forEach(response.data, function (value, key) {
                        $scope.productList.push({
                            "product_name": value.product_name,
                            "description": value.description,
                            "remaining_quantity": parseFloat(value.quantity),
                            "unit_price": parseFloat(value.unit_price)
                        });
                    })
                }, function () {
                    alert("Failed to retrieve list of products");
                });
        }
        /**
         * Add new product in the  $scope.orderInformation.ordered_products
         * deduct the ordered quantity with the
         * data from remote
         */
        currentController.addOrderedProduct = function (currentOrderedProduct) {
            angular.forEach($scope.productList, function (value, key) {
                // deduct the ordered quantity to remaining
                if (value.product_name === currentOrderedProduct.product_name) {
                    var tempSelectedProduct = $scope.productList[key];
                    tempSelectedProduct.remaining_quantity -= currentOrderedProduct.ordered_quantity;
                }
            });
            $scope.orderInformation.ordered_products.push({
                product_name: currentOrderedProduct.product_name,
                description: currentOrderedProduct.description,
                quantity: currentOrderedProduct.ordered_quantity,
                unit_price: currentOrderedProduct.unit_price,
                line_total: currentOrderedProduct.line_total
            });
            /* clear the ordered product */
            $scope.currentOrderedProduct = {
                "product_name": "",
                "description": "",
                "remaining_quantity": "",
                "ordered_quantity": "",
                "unit_price": "",
                "line_total": ""
            };

        }

        /**
         *Remove current product from ordered product
         */
        currentController.removeOrderedProduct = function (indexOfOrderedProduct) {
            /* return back the deducted  - quantity */
            var tempOrderedProduct = $scope.orderInformation.ordered_products[indexOfOrderedProduct];
            angular.forEach($scope.productList, function (value, key) {
                // deduct the ordered quantity to remaining
                if (value.product_name === tempOrderedProduct.product_name) {
                    var tempSelectedProduct = $scope.productList[key];
                    tempSelectedProduct.remaining_quantity += tempOrderedProduct.quantity;

                }
            });
            /*pop the removed data*/
            $scope.orderInformation.ordered_products.splice(indexOfOrderedProduct, 1);
            /* clear the ordered product */
            $scope.currentOrderedProduct = {
                "product_name": "",
                "description": "",
                "remaining_quantity": "",
                "ordered_quantity": "",
                "unit_price": "",
                "line_total": ""
            };
        }

        /**
         * @TODO - Submit to remote server , if response is OK , alert saved and redirect
         */
        currentController.submitInvoice = function (shippingAddress, orderInformation,customerModel) {
            $scope.isSendingPurchaseRequest = true;
            /*make sure it orders something*/
            if (orderInformation.ordered_products.length === 0) {
                $scope.errorAssistPurchase = "You forgot to order something";
                return false;
            }
            //make sure shipping address is complete
            if(shippingAddress.shipping_address_street === "" || shippingAddress.shipping_address_city === ""){
                $scope.purchaseLabelStr = "Sending..";
                return false;
            }
            $scope.purchaseLabelStr = "Sending..";
            $http.post(baseUrl + '/invoice/save', {
                "shippingAddress": shippingAddress,
                "orderInformation": orderInformation,
                "customerModel": customerModel
            })
            .then(
            function (response) {
                if (response.data.status === "success") {
                    $scope.purchaseLabelStr = "Invoice created!";
                }
                $scope.isSendingPurchaseRequest = true;
                $timeout(function () {
                    window.location.href = baseUrl + '/invoice/list';
                }, 500);
            }, function () {
                alert('Sorry I cant send your data now. ');
            });

        }
        $scope.$watch(
            "currentOrderedProduct.product_name",
            function handleFooChange(newValue, oldValue) {
                var tempObj = currentController.getObjectByProductName(newValue);
                if (tempObj !== null) {
                    $scope.currentOrderedProduct.description = tempObj.description;
                    $scope.currentOrderedProduct.unit_price = parseFloat(tempObj.unit_price);
                    $scope.currentOrderedProduct.remaining_quantity = parseFloat(tempObj.remaining_quantity);
                }
            }
        );
        $scope.$watch('currentOrderedProduct.ordered_quantity', function (newValue, oldValue) {
            if (newValue !== "" || newValue !== null) {
                /*compute line total*/
                $scope.currentOrderedProduct.line_total = $scope.currentOrderedProduct.unit_price * newValue;
                if (typeof newValue === 'undefined') {
                    $scope.currentOrderedProduct.line_total = 0;
                }
            }
        });

        currentController.getObjectByProductName = function (productName) {
            var tempObject = null;
            angular.forEach($scope.productList, function (value, key) {
                if (productName === value.product_name) {
                    tempObject = $scope.productList[key];
                }
            });
            return tempObject;
        }
        /*initialize content of prodcuts*/
        currentController.getProductList();

    }]);


    


}());