app.controller('attendanceCtrl', function($scope , $http, $timeout , DBService) {
    $scope.formData = {
        
    }

    $scope.user_id= 0;

    $scope.users = [];

    $scope.loading = false;
    
   
    $scope.init = function () {
        // alert('hello');
        $scope.loading = true;

        DBService.postCall({date:$scope.date}, '/api/attendance/init').then((data) => {
            if(data.success) {
                $scope.date = data.date;
                $scope.users = data.users;
            }
            $scope.loading = false;

        });
    }

    $scope.onSubmit = () =>{
        
        DBService.postCall({users:$scope.users}, '/api/attendance/store').then((data) => {
            if(data.success) {
                alert(data.message);
                window.location = data.redirect_url; 
            }else{
                alert(data.message);
            }

        });
    }
});
