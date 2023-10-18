app.controller('type6Ctrl', function($scope , $http, $timeout , DBService) {
    $scope.formData = {
        emi_ar: [{emi_amount:''}],
    }
    $scope.emi_obj = {emi_amount:''};

    $scope.court_case_id= 0;

    // $scope.entries = [];

    $scope.all_banks = [];
    $scope.billing_types = [];
    $scope.days = [];
    $scope.status_ar = [];

    $scope.source_city_id = 0;
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
       
        DBService.postCall({court_case_id:$scope.court_case_id}, '/api/data-entry/type6/init').then((data) => {
            if(data.success) {
                $scope.all_banks = data.banks;
                $scope.billing_types = data.billing_types;
                $scope.days = data.days; 
                $scope.status_ar = data.status_ar; 

                if(data.court_case){
                    $scope.formData = data.court_case;

                }
            }
        });
    }

    $scope.onSubmit = () =>{
         DBService.postCall($scope.formData, '/api/data-entry/type6/store').then((data) => {
            if(data.success) {
                alert(data.message);
                window.location = data.redirect_url; 
            }else{
                alert(data.message);
            }

        })
    }

    $scope.addEMI = () => {
        $scope.formData.emi_ar.push(JSON.parse(JSON.stringify($scope.emi_obj)));

    }

    $scope.remove= function(index){
        $scope.formData.emi_ar.splice(index,1);
    }
});
