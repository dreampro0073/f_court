app.controller('type5Ctrl', function($scope , $http, $timeout , DBService) {
    $scope.formData = {
        emi_ar: [{e_amount:''}],
    }
    $scope.emi_obj = {e_amount:''};
    
    $scope.banks = [];
    $scope.years = [];
    $scope.through = [];
    $scope.billing_types = [];

    $scope.entries = [];

    $scope.mutation_id = 0;

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
   
    $scope.Init = function () {

        DBService.postCall({mutation_id:$scope.mutation_id}, '/api/data-entry/type5/init').then((data) => {
            
            if(data.success) {
                if(data.mutation){
                    $scope.formData = data.mutation; 

                }
                $scope.tehsils = data.tehsils; 
                $scope.villages = data.villages; 
                $scope.days = data.days; 
                $scope.status_ar = data.status_ar; 
            }
        });
    }
    
    $scope.storeType5 = function () {
        $scope.loading= true;


        DBService.postCall($scope.formData, '/api/data-entry/type5/store').then((data) => {
            alert(data.message);
            $scope.loading= false;


            if(data.success){
                window.location = data.redirect_url;
            }
            
        });
    }
    $scope.addEMI = () => {
        // console.log('hasjahjshja');
        $scope.formData.emi_ar.push(JSON.parse(JSON.stringify($scope.emi_obj)));

    }

    $scope.remove= function(index){
        $scope.formData.emi_ar.splice(index,1);
    }


});
