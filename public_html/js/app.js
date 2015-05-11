angular.module("locastic.app", [
        'locastic.directives'
    ])
    .config(['$interpolateProvider', function ($interpolateProvider) {
            $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
}]);