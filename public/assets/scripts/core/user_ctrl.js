app.controller('type6Ctrl', function($scope , $http, $timeout , DBService) {
    $scope.formData = {
        
    }

    $scope.user_id= 0;

    // $scope.entries = [];
    
   
    $scope.init = function () {
       
        DBService.postCall({user_id:$scope.user_id}, '/api/users/init').then((data) => {
            if(data.success) {
               
                if(data.user){
                    $scope.formData = data.user;

                }
            }
        });
    }

    $scope.onSubmit = () =>{
         DBService.postCall($scope.formData, '/api/users/store').then((data) => {
            if(data.success) {
                alert(data.message);
                window.location = data.redirect_url; 
            }else{
                alert(data.message);
            }

        })
    }
});
