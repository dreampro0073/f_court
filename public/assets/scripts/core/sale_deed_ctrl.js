app.controller('saleCtrl', function($scope , $http, $timeout , DBService) {
    $scope.formData = {
        
    }
    
    $scope.banks = [];
    $scope.days = [];
    $scope.tehsils = [];
    $scope.sro = []; 
    $scope.status_ar = []; 
    $scope.through = []; 
    $scope.document_types = []; 


    $scope.sale_id = 0;
    $scope.selectConfig = {
        valueField: 'id',
        labelField: 'bank_name',
        maxItems:1,
        searchField: 'bank_name',
        create: false,
        onInitialize: function(selectize){
            
        }
    }
   
    $scope.add = function () {

        DBService.postCall({ sale_id:$scope.sale_id}, '/api/data-entry/sale-deed/init').then((data) => {
            
            if(data.success) {
                $scope.formData = data.sale_deed; 
                $scope.banks = data.banks; 
                $scope.tehsils = data.tehsils; 
                $scope.days = data.days; 
                $scope.sro_ar = data.sro_ar; 
                $scope.status_ar = data.status_ar; 
                $scope.through = data.through; 
                $scope.document_types = data.document_types; 
               
            }
        });
    }
    
    $scope.storeSaleDeed = function () {
        $scope.loading= true;

        DBService.postCall($scope.formData, '/api/data-entry/sale-deed/store').then((data) => {
            alert(data.message);
            $scope.loading= false;
            
            if(data.success){
                window.location = data.redirect_url;
            }   
        });
    }

});


