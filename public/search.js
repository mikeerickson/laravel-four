function SearchCtrl($scope, $http) {
    $scope.url = 'http://localhost:8000/angular'; // The url of our search
      
    // The function that will be executed on button click (ng-click="search()")
    $scope.search = function() {
         
        $http.post($scope.url, { "data" : $scope.keywords}).
          success(function(data, status, headers, config) {
          	$scope.status = status;
            $scope.data = data;
            $scope.result = data;
          }).
          error(function(data, status, headers, config) {
            $scope.data = data || "Request failed";
            $scope.status = status;         
          });        
    };

}

angular.module('ng').filter('tel', function () {
    return function (tel) {
        if (!tel) { return ''; }

        var value = tel.toString().trim().replace(/^\+/, '');

        if (value.match(/[^0-9]/)) {
            return tel;
        }

        var country, city, number;

        switch (value.length) {
            case 10: // +1PPP####### -> C (PPP) ###-####
                country = 1;
                city = value.slice(0, 3);
                number = value.slice(3);
                break;

            case 11: // +CPPP####### -> CCC (PP) ###-####
                country = value[0];
                city = value.slice(1, 4);
                number = value.slice(4);
                break;

            case 12: // +CCCPP####### -> CCC (PP) ###-####
                country = value.slice(0, 3);
                city = value.slice(3, 5);
                number = value.slice(5);
                break;

            default:
                return tel;
        }

        if (country == 1) {
            country = "";
        }

        number = number.slice(0, 3) + '-' + number.slice(3);

        return (country + " (" + city + ") " + number).trim();
    };
});