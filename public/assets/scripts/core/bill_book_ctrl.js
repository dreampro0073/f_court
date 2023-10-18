app.controller('tempBills', function($scope , $http, $timeout , DBService) {
    $scope.formData = {
        
    }
    
    $scope.banks = [];
    $scope.temp_bill_id = 0;

    $scope.selectConfig = {
        valueField: 'id',
        labelField: 'bank_name',
        maxItems:1,
        searchField: 'bank_name',
        create: false,
        onInitialize: function(selectize){
        }
    }
   
    $scope.addTempInit = function () {

        DBService.postCall({temp_bill_id:$scope.temp_bill_id}, '/api/bill-books/type1/init').then((data) => {
            
            if(data.success) {
                $scope.formData = data.tempBill; 
                $scope.banks = data.banks; 
            }
        });
    }
    
    $scope.storeType1 = function () {

        DBService.postCall($scope.formData, '/api/bill-books/type1/store').then((data) => {
             alert(data.message);

            if(data.success){
                window.location = data.redirect_url;
            }
            
        });
    }

});

app.controller('BillBooks', function($scope , $http, $timeout , DBService) {
    $scope.formData = {
        
    }

    $scope.banks = [];
    $scope.bill_book_id = 0;

    $scope.selectConfig = {
        valueField: 'id',
        labelField: 'bank_name',
        maxItems:1,
        searchField: 'bank_name',
        create: false,
        onInitialize: function(selectize){
        }
    }

    $scope.addType2 = function () {

        DBService.postCall({bill_book_id:$scope.bill_book_id}, '/api/bill-books/type2/init').then((data) => {
            
            if(data.success) {
                $scope.formData = data.tempBill; 
                $scope.banks = data.banks; 
            }
        });
    }
    
    $scope.storeType2 = function () {
        alert("hhjhj");return;

        DBService.postCall($scope.formData, '/api/bill-books/type2/store').then((data) => {
             alert(data.message);

            if(data.success){
                window.location = data.redirect_url;
            }
            
        });
    }

});
