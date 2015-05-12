angular.module("locastic.app", [
        'locastic.directives',
        'locastic.rest',
        'locastic.helpers'
    ])
    .config(['$interpolateProvider', '$filterProvider', function ($interpolateProvider, $filterProvider) {
        $interpolateProvider.startSymbol('{[{').endSymbol('}]}');


}])
    .filter('dateParse', function() {
        return function(date) {
            var d = new Date(date.date);
            return d.getDate() + '.' + (d.getMonth() + 1) + '.' + d.getFullYear();
        }
    });