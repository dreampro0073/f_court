app.controller('certiCopyCtrl', function($scope , $http, $timeout , DBService) {
    $scope.formData = {
        
    }

    $scope.selectConfig = {
        valueField: 'id',
        labelField: 'bank_name',
        maxItems:1,
        searchField: 'bank_name',
        create: false,
        onInitialize: function(selectize){
            
        }
    }
  
    $scope.certifide_id = 0;
    $scope.days = [];
    $scope.banks = [];
    $scope.tehsils = [];
    $scope.through = [];
    $scope.status_ar = [];
    $scope.sro_ar = [];
   
    $scope.add = function () {

        DBService.postCall({ certifide_id:$scope.certifide_id}, '/api/data-entry/certified-copy/init').then((data) => {
            
            if(data.success) {
                $scope.formData = data.certifide_copy; 
                $scope.days = data.days; 
                $scope.banks = data.banks; 
                $scope.tehsils = data.tehsils; 
                $scope.through = data.through; 
                $scope.status_ar = data.status_ar; 
                $scope.sro_ar = data.sro_ar; 
               
            }
        });
    }
    
    $scope.storeCertified = function () {
        $scope.loading= true;

        
        DBService.postCall($scope.formData, '/api/data-entry/certified-copy/store').then((data) => {
            alert(data.message);
            $scope.loading= false;

            
            if(data.success){
                window.location = data.redirect_url;
            }   
        });
    }

})
