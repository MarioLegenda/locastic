angular.module('locastic.directives', [])
    .directive('managment', [function () {
        return {
            restrict: 'E',
            replace: true,
            scope: {},
            templateUrl: 'managment.html',
            controller: function ($scope) {
                // proxy between addList directive and listing directive. Not the best solution but keeps scopes separate
                $scope.$on('action.proxy.refresh_list', function() {
                    $scope.$broadcast('action.refresh_list', {});
                });

                $scope.$on('action.proxy.refresh_task', function() {
                    $scope.$broadcast('action.refresh_taska', {});
                });
            }
        }
    }])
    .directive('addList', ['RestProvider', function(RestProvider) {
        return {
            restrict: 'E',
            replace: true,
            scope: {},
            templateUrl: 'newListForm.html',
            controller: function($scope) {
                var List = RestProvider.create('list');

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
                            var promise = List.addItem({
                                name: $scope.list.name
                            });

                            promise.then(function() {
                                $scope.$emit('action.proxy.refresh_list', {});
                            }, function(data) {
                                console.log(data);
                                $scope.list.errors.error = true;
                                $scope.list.errors.messages = data.data;
                            });
                        }
                        else if($scope.list.name == '') {
                            $scope.list.errors.error = true;
                            $scope.list.errors.messages.push('You have to provide a list name');
                        }

                        return false;
                    }
                }
            }
        }
    }])
    .directive('listing', [function() {
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
                    listing: []
                };

                $scope.$on('action.lists_listing', function($event, data) {
                    $scope.directiveData.listing = data.listing;
                    $scope.dom.listing = true;
                });

                $scope.$on('action.refresh_list', function($event, data) {
                    $scope.directiveData.listing = data.listing;
                });
            }
        }
    }])
    .directive('listHandler', ['RestProvider', function(RestProvider) {
        return {
            restrict: 'A',
            replace: false,
            controller: function($scope) {
                var List = RestProvider.create('list');

                $scope.dom = {
                    addList: false,
                    lists: true,
                    tasks: false,
                    addTask: false
                };

                $scope.listHandler = {

                    selectedListId: null,

                    addList: function($event) {
                        $event.preventDefault();

                        $scope.dom.addList = !$scope.dom.addList;
                        return false;
                    },
                    addTask: function($event) {
                        $event.preventDefault();
                        $scope.dom.addTask = !$scope.dom.addTask;

                        return false;
                    },
                    listingOrder: {
                        date: true,
                        name: false,
                        makeOrder: function(type) {
                            var order = (this[type] === true) ? 'ASC' : 'DESC';
                            this[type] = !this[type];

                            return order;
                        }
                    },
                    // function called when sorting lists
                    sort: function(type) {
                        var promise = List.getItems({
                            type: type,
                            order: $scope.listHandler.listingOrder.makeOrder(type)
                        });

                        promise.then(function(data) {
                            $scope.directiveData.listing = data.data.lists;
                        });
                    },
                    back: function($event) {
                        $event.preventDefault();
                        $scope.dom.tasks = !$scope.dom.tasks;
                        $scope.dom.lists = !$scope.dom.lists;

                        $scope.dom.addList = false;
                        $scope.dom.addTask = false;
                        return false;
                    }
                };


                var promise = List.getItems({
                    type: 'date',
                    order: 'DESC'
                });

                promise.then(function(data) {
                    $scope.$emit('action.lists_listing', {
                        listing: data.data.lists
                    });
                });

                $scope.$on('action.refresh_list', function() {
                    var promise = List.getItems({
                        type: 'date',
                        order: 'DESC'
                    });

                    promise.then(function(data) {
                        $scope.directiveData.listing = data.data.lists;
                    });
                });

                $scope.$on('action.change_listing', function($event, data) {
                    $scope.listHandler.selectedListId = data.listId;
                    $scope.dom.addList = false;
                    $scope.dom.tasks = !$scope.dom.tasks;
                    $scope.dom.lists = !$scope.dom.lists;
                });
            }
        }
    }])
    .directive('listRow', ['Toggle', function(Toggle) {
        return {
            restrict: 'E',
            replace: true,
            scope: {
                listItem: '=listItem'
            },
            templateUrl: 'listRow.html',
            controller: function($scope) {
                $scope.directiveData = {
                    taskList: function($event) {
                        $event.preventDefault();

                        $scope.$emit('action.change_listing', {
                            listId: $scope.listItem.listid
                        });
                        return false;
                    }
                }
            }
        }
    }]);