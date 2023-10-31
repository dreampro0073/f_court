app.controller('type2Ctrl', function($scope , $http, $timeout , DBService,Upload) {
    $scope.formData = {
        emi_ar: [{emi_amount:''}],
    }
    $scope.emi_obj = {emi_amount:''};
    
    $scope.banks = [];
    $scope.billing_types = [];
    $scope.status_ar = [];
    $scope.days = [];
    

    $scope.notice_id = 0;

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
   
    $scope.addNoticeInit = function () {

        DBService.postCall({ notice_id:$scope.notice_id}, '/api/data-entry/type2/init').then((data) => {
            
            if(data.success) {
                if(data.notice){
                    $scope.formData = data.notice; 
                }
                $scope.banks = data.banks; 
                $scope.billing_types = data.billing_types; 
                $scope.status_ar = data.status_ar; 
                $scope.days = data.days; 


            }
        });
    }
    
    $scope.storeType2 = function () {
        $scope.loading= true;

        DBService.postCall($scope.formData, '/api/data-entry/type2/store').then((data) => {
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
