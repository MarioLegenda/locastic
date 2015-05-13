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
            console.log(d.getDate() + '.' + (d.getMonth() + 1) + '.' + d.getFullYear());
            return d.getDate() + '.' + (d.getMonth() + 1) + '.' + d.getFullYear();
        }
    });