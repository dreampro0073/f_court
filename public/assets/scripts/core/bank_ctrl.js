app.controller('bankCtrl', function($scope , $http, $timeout , DBService,Upload) {
    
    $scope.bank_name = "";
    $scope.purpose_loading = false;

    $scope.addBank = function(){
        $("#bankModal").modal("show"); 
    }

    $scope.submitBank = function(){
        $scope.purpose_loading = true;
        DBService.postCall({bank_name : $scope.bank_name}, '/api/banks/store').then((data) => {
            alert(data.message);
            $scope.bank_name = "";
            $scope.purpose_loading = false;
            $("#bankModal").modal("hide"); 
            location.reload();
        });
    }

});
