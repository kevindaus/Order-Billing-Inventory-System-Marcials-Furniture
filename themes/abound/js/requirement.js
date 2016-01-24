'use strict';
(function(window){

    var IndexCtrl = function($scope,$http){
            $scope.requiredProductCollection = [];
            $scope.materials = [];
            $scope.selectedIndex =  null;
            $scope.currentQuantity=  null;

            this.addMoreRequiredProduct = function(selectedIndex,currentQuantity){
                /*get material object using key*/
                var currentSelectedMaterial = $scope.materials[selectedIndex];
                $scope.requiredProductCollection.push({
                    material_id : currentSelectedMaterial.id,
                    material_name : currentSelectedMaterial['name'],
                    unit_measurement : currentSelectedMaterial['unit_measurement'],
                    quantity : currentQuantity,
                });                    
                console.log(currentQuantity);
                $scope.selectedIndex =  null;
                $scope.currentQuantity = null;
            }
            this.removeRequiredMaterial = function(current_required_product_key){
                $scope.requiredProductCollection.splice(current_required_product_key,1);
            }

            $http.post("/materials/json")
                .then(function(response){
                    $scope.materials = response.data;
                 }, function(){
                    alert('Error: Cant retrieve materials data');
                });
    }

    angular.module('ProductRequirement', [])
        .controller('IndexCtrl', ['$scope','$http', IndexCtrl])
}(window));