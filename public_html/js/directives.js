angular.module('locastic.directives', [])
    .directive('managment', [function () {
        return {
            restrict: 'E',
            replace: true,
            templateUrl: 'managment.html',
            controller: function ($scope) {

            },
            link: function ($scope, elem, attrs) {

            }
        }
    }])
    .directive('listHandler', [function() {
        return {
            restrict: 'E',
            replace: true,
            templateUrl: 'listHandler.html',
            controller: function($scope) {
                
            },
            link: function($scope, elem, attrs) {

            }
        }
    }]);