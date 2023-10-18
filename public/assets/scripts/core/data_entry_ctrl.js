app.controller('dataEntryCtrl', function($scope , $http, $timeout , DBService) {
    $scope.formData = {
        
    }

    $scope,entries = [];
   
    $scope.init = function () {
       
        DBService.postCall({}, '/api/data-entry/init').then((data) => {
            if(data.success) {
                $scope.entries = data.entries;
            }
        });
    }

    $scope.save = function () {
        DBService.postCall($scope.formData, '/test/save/' + $scope.student_id).then((data) => {
            if(data.success) {
                window.location = base_url + '/test';
            }else{
                alert(data.message);
            }

        })
    }

})
