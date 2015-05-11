angular.module('locastic.directives', [])
    .directive('managment', ['List', function (List) {
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
                    },

                    // function called when sorting lists
                    sort: function(type) {
                        $scope.$broadcast('managment.sort_by_' + type, {});
                    }
                };

                $scope.$on('dom.start_listing', function() {
                    console.log('works');
                })
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
    .directive('listing', ['List', function(List) {
        return {
            restrict: 'E',
            replace: true,
            scope: {},
            templateUrl: 'listHandler.html',
            controller: function($scope) {
                $scope.dom = {
                    listing: false
                };

                $scope.directiveData = {
                    listing: [],
                    /*
                    * if listingOrder.date == true then 'DESC' else 'ASC'
                    * */
                    listingOrder: {
                        date: true,
                        name: false,
                        makeOrder: function(type) {
                            var order = (this[type] === true) ? 'ASC' : 'DESC';
                            this[type] = !this[type];

                            return order;
                        }
                    }
                };

                var promise = List.getLists({
                    type: 'date',
                    order: 'DESC'
                });

                promise.then(function(data) {
                    $scope.directiveData.listing = data.data.lists;
                    $scope.dom.listing = true;
                });

                $scope.$on('managment.sort_by_date', function() {
                    var promise = List.getLists({
                        type: 'date',
                        order: $scope.directiveData.listingOrder.makeOrder('date')
                    });

                    promise.then(function(data) {
                        $scope.directiveData.listing = data.data.lists;
                    });
                });

                $scope.$on('managment.sort_by_name', function() {
                    var promise = List.getLists({
                        type: 'name',
                        order: $scope.directiveData.listingOrder.makeOrder('name')
                    });

                    promise.then(function(data) {
                        $scope.directiveData.listing = data.data.lists;
                    });
                });
            }
        }
    }])
    .directive('listRow', [function() {
        return {
            restrict: 'E',
            replace: true,
            scope: {
                listItem: '=listItem'
            },
            templateUrl: 'listRow.html',
            controller: function($scope) {
            }
        }
    }]);