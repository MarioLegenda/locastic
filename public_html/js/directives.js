angular.module('locastic.directives', [])
    .directive('managment', [function () {
        return {
            restrict: 'E',
            replace: true,
            templateUrl: 'managment.html',
            controller: function ($scope) {
                $scope.dom = {
                    addList: false
                };

                $scope.managment = {
                    addList: function($event) {
                        $event.preventDefault();

                        $scope.dom.addList = !$scope.dom.addList;
                        return false;
                    }
                }
            },
            link: function ($scope, elem, attrs) {

            }
        }
    }])
    .directive('addList', ['List', function(List) {
        return {
            restrict: 'E',
            replace: true,
            scope: {},
            templateUrl: 'newListForm.html',
            controller: function($scope) {
                $scope.list = {
                    name: '',
                    errors: {
                        error: false,
                        messages: []
                    },
                    submit: function($event) {
                        $event.preventDefault();

                        // not the proper way of handling errors but speed is of the essence
                        if($scope.list.name != '') {
                            var promise = List.addList({
                                name: $scope.list.name
                            });

                            promise.then(function() {

                            }, function(data) {
                                $scope.list.errors.error = true;
                                $scope.list.errors.messages.push(data.data);
                            })
                        }
                        else if($scope.list.name == '') {
                            $scope.list.errors.error = true;
                            $scope.list.errors.messages.push('You have to provide a list name');
                        }

                        return false;
                    }
                }
            },
            link: function($scope, elem, attr) {

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