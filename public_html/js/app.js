angular.module("locastic.app", [
        'locastic.directives',
        'locastic.rest',
        'locastic.helpers'
    ])
    .config(['$interpolateProvider', function ($interpolateProvider) {
            $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
}]);