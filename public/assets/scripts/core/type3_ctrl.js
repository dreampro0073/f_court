app.controller('type3Ctrl', function($scope , $http, $timeout , DBService) {
    $scope.formData = {
        emi_ar: [{emi_amount:''}],
    }
    $scope.emi_obj = {emi_amount:''};
    
    $scope.banks = [];
    $scope.years = [];
    $scope.through = [];
    $scope.billing_types = [];
    $scope.days = [];
    $scope.status_ar = [];
    $scope.finance_types = [];

    $scope.agr_id = 0;


    $scope.selectConfig = {
        valueField: 'id',
        labelField: 'bank_name',
        maxItems:1,
        searchField: 'bank_name',
        create: false,
        onInitialize: function(selectize){
            // console.log('Initialized', selectize);
        }
    }
   
    $scope.init = function () {
        console.log($scope.agr_id);
        DBService.postCall({agr_id:$scope.agr_id}, '/api/data-entry/type3/init').then((data) => {
            
            if(data.success) {
                if(data.agri_fin){
                    $scope.formData = data.agri_fin; 
                }
                $scope.banks = data.banks; 
                $scope.years = data.years; 
                $scope.through = data.through; 
                $scope.billing_types = data.billing_types; 
                $scope.days = data.days; 
                $scope.status_ar = data.status_ar; 
                $scope.finance_types = data.finance_types; 
            }
        });
    }
    
    $scope.storeType3 = function () {
        $scope.loading= true;

        DBService.postCall($scope.formData, '/api/data-entry/type3/store').then((data) => {
            alert(data.message);
            $scope.loading= false;


            if(data.success){
                window.location = data.redirect_url;
            }
            
        });
    }
    $scope.addEMI = () => {
        $scope.formData.emi_ar.push(JSON.parse(JSON.stringify($scope.emi_obj)));

    }

    $scope.remove= function(index){
        $scope.formData.emi_ar.splice(index,1);
    }

});
