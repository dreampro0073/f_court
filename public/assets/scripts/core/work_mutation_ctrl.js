app.controller('workCtrl', function($scope , $http, $timeout , DBService) {
    $scope.formData = {
        
    }
    
    $scope.banks = [];
    $scope.days = [];
    $scope.tehsils = [];
    $scope.banks = [];
    $scope.through = []; 
    $scope.status_ar = []; 
    $scope.villages = [];  

    $scope.work_id = 0;

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

        DBService.postCall({ work_id:$scope.work_id}, '/api/data-entry/workstation-mutation/init').then((data) => {
            
            if(data.success) {
                if(data.workstation){
                    $scope.formData = data.workstation; 
                }
                $scope.banks = data.banks; 
                $scope.tehsils = data.tehsils; 
                $scope.days = data.days; 
                $scope.through = data.through; 
                $scope.status_ar = data.status_ar; 
                $scope.villages = data.villages; 
               
            }
        });
    }
    
    $scope.storeWork = function () {
        
        DBService.postCall($scope.formData, '/api/data-entry/workstation-mutation/store').then((data) => {
            alert(data.message);
            
            if(data.success){
                window.location = data.redirect_url;
            }   
        });
    }

})

