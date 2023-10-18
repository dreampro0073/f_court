var app = angular.module('app', [
	'jcs-autoValidate',
  'ngFileUpload',
  'selectize'
]);

angular.module('jcs-autoValidate')
    .run([
    'defaultErrorMessageResolver',
    function (defaultErrorMessageResolver) {
        defaultErrorMessageResolver.getErrorMessages().then(function (errorMessages) {
          errorMessages['patternInt'] = 'Please fill a numeric value';
          errorMessages['patternFloat'] = 'Please fill a numeric/decimal value';
        });
    }
]);

app.directive('convertToNumber', function() {
  return {
    require: 'ngModel',
    link: function(scope, element, attrs, ngModel) {
      ngModel.$parsers.push(function(val) {
        return val != null ? parseInt(val, 10) : null;
      });
      ngModel.$formatters.push(function(val) {
        return val != null ? '' + val : null;
      });
    }
  };
});