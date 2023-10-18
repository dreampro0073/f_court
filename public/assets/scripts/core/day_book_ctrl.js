app.controller('dayBookCtrl', function($scope , $http, $timeout , DBService) {
    $scope.formData = {
        
    }

    $scope.selectConfig = {
        valueField: 'id',
        labelField: 'bank_name',
        maxItems:1,
        searchField: 'bank_name',
        create: false,
        onInitialize: function(selectize){
            
        }
    }
  
    $scope.day_book_id = 0;
    
    $scope.onEdit = (day_book_id) => {
        $scope.day_book_id = day_book_id;

        DBService.postCall({ day_book_id:$scope.day_book_id}, '/api/day-book/init').then((data) => {
            
            if(data.success) {
                $scope.formData = data.day_book;                
            }
        }); 
    }
  
    
    $scope.store = function () {
        
        DBService.postCall($scope.formData, '/api/day-book/store').then((data) => {
            
            
            if(data.success){
                window.location = data.redirect_url;
                
                $scope.formData = {};
                alert(data.message);
            }  else{
                alert(data.message);
            } 
        });
    }

})
