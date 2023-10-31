app.controller('type4Ctrl', function($scope , $http, $timeout , DBService) {
    $scope.formData = {
        emi_ar: [{emi_amount:''}],
    }
    $scope.emi_obj = {emi_amount:''};
    
    $scope.banks = [];
    $scope.years = [];
    $scope.through = [];
    $scope.billing_types = [];

    $scope.entries = [];

    $scope.draft_id = 0;
    $scope.days = [];
    $scope.status_ar = [];


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
   
    $scope.addDraftInit = function () {

        DBService.postCall({draft_id:$scope.draft_id}, '/api/data-entry/type4/init').then((data) => {
            
            if(data.success) {
                if(data.draft_data){
                    $scope.formData = data.draft_data; 

                }
                $scope.drafts = data.drafts; 
                $scope.through = data.through; 
                $scope.billing_types = data.billing_types; 
                $scope.days = data.days; 
                $scope.status_ar = data.status_ar; 
            }
        });
    }
    
    $scope.storeType4 = function () {
        $scope.loading= true;


        DBService.postCall($scope.formData, '/api/data-entry/type4/store').then((data) => {
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
