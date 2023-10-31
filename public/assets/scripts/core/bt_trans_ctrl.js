app.controller('btTransCtrl', function($scope , $http, $timeout , DBService) {
    $scope.formData = {
        
    }
    
    $scope.banks = [];
    $scope.days = [];
    $scope.status_ar = []; 

  

    $scope.bt_id = 0;

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

        DBService.postCall({ bt_id:$scope.bt_id}, '/api/data-entry/bt-transaction/init').then((data) => {
            
            if(data.success) {
                $scope.formData = data.bt_trans; 
                $scope.banks = data.banks; 
                $scope.days = data.days; 
                $scope.status_ar = data.status_ar; 
            }
        });
    }
    
    $scope.storeBtTrans = function () {
        $scope.loading= true;

        DBService.postCall($scope.formData, '/api/data-entry/bt-transaction/store').then((data) => {
            alert(data.message);
            $scope.loading= false;

            
            if(data.success){
                window.location = data.redirect_url;
            }   
        });
    }

})

