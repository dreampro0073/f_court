app.controller('type1Ctrl', function($scope , $http, $timeout , DBService,Upload) {
    $scope.formData = {
        emi_ar: [{emi_amount:''}],
    }
    $scope.emi_obj = {emi_amount:''};
    
    $scope.banks = [];
    $scope.years = [];
    $scope.through = [];
    $scope.days = [];
    $scope.billing_types = [];

    $scope.entries = [];
    $scope.status_ar = [];

    $scope.opinion_id = 0;

    // $scope.emi_ar = [{emi_amount:''}];




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
   
    $scope.addOpinionInit = function () {

        DBService.postCall({opinion_id:$scope.opinion_id}, '/api/data-entry/type1/init').then((data) => {
            
            if(data.success) {
                if (data.opinion) {
                    $scope.formData = data.opinion; 

                }
                $scope.banks = data.banks; 
                $scope.years = data.years; 
                $scope.through = data.through; 
                $scope.billing_types = data.billing_types; 
                $scope.days = data.days; 
                $scope.status_ar = data.status_ar; 
            }
        });
    }
    
    $scope.storeType1 = function () {

        $scope.loading= true;

        DBService.postCall($scope.formData, '/api/data-entry/type1/store').then((data) => {
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

    $scope.uploadFile = function(file, field_name,obj){
         // console.log(obj);return;

        if($scope.uploading) return;

        if(file){
            $scope.uploading = true;
            var url = base_url+'/admin/upload-file';
            Upload.upload({
                url:url,
                data: {
                    media:file,
                }
            }).then(function (resp){
                if(resp.data.success){
                    // $scope.questions[field_name] = resp.data.path;


                    obj['bill_file'] = resp.data.path;
                    obj['path_url'] = resp.data.path_url;

                } else {
                     alert(resp.data.message);
                }
                $scope.uploading = false;
            }, function (resp) {

                console.log('Error status: ' + resp.status);
               
            }, function (evt) {

            });
        }
    }

    $scope.removeFile = function(question){
        $scope.formData.bill_file = '';
        $scope.formData.path_url = '';
    }

})
