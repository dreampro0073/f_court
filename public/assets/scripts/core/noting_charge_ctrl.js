app.controller('notingCtrl', function($scope , $http, $timeout , DBService) {
    $scope.formData = {
        
    }
    
    $scope.banks = [];
    $scope.days = [];
    $scope.tehsils = [];
    $scope.banks = [];
    $scope.through = []; 
    $scope.status_ar = []; 
    $scope.villages = []; 

  

    $scope.noting_id = 0;

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

        DBService.postCall({ noting_id:$scope.noting_id}, '/api/data-entry/noting-charge/init').then((data) => {
            
            if(data.success) {
                $scope.formData = data.notinig_charge; 
                $scope.banks = data.banks; 
                $scope.tehsils = data.tehsils; 
                $scope.days = data.days; 
                $scope.through = data.through; 
                $scope.status_ar = data.status_ar; 
                $scope.villages = data.villages; 
               
            }
        });
    }
    
    $scope.storeType1 = function () {
        DBService.postCall($scope.formData, '/api/data-entry/noting-charge/store').then((data) => {
            alert(data.message);
            
            if(data.success){
                window.location = data.redirect_url;
            }   
        });
    }

})
