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
                                $scope.list.name = '';
                                $scope.$emit('action.proxy.refresh_list', {});
                            }, function(data) {
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
    .directive('listing', ['$timeout', function($timeout) {
        return {
            restrict: 'E',
            replace: true,
            scope: {},
            templateUrl: 'listHandler.html',
            controller: function($scope) {
                $scope.directiveData = {
                    listing: [],
                    recompile: false
                };

                $scope.$on('action.refresh_list', function($event, data) {
                    $scope.directiveData.listing = data.listing;
                });

                $scope.$on('action.change_interface', function($event, data) {
                    $scope.$broadcast('action.fetch_data', {
                        interfaceType: data.interfaceType,
                        listId: data.listId
                    });
                });

                $timeout(function() {
                    $scope.$broadcast('action.fetch_data', {
                        interfaceType: 'list'
                    });
                }, 1000);
            }
        }
    }])
    .directive('listHandler', ['RestProvider', '$timeout', function(RestProvider, $timeout) {
        return {
            restrict: 'A',
            replace: false,
            controller: function($scope) {
                var RestInterface;

                $scope.dom = {
                    lists: false,
                    tasks: false
                };

                $scope.listHandler = {
                    interfaceType: null,
                    selectedListId: null,

                    listingOrder: {
                        date: true,
                        name: false,
                        deadline: false,
                        priority: false,
                        makeOrder: function(type) {
                            var order = (this[type] === true) ? 'ASC' : 'DESC';
                            this[type] = !this[type];

                            return order;
                        }
                    },
                    // function called when sorting lists
                    sort: function(type) {
                        var promise = RestInterface.getItems({
                            listId: $scope.listHandler.selectedListId,
                            entity: $scope.listHandler.interfaceType,
                            type: type,
                            order: $scope.listHandler.listingOrder.makeOrder(type)
                        });

                        promise.then(function(data) {
                            $scope.directiveData.listing = data.data.lists;
                        });
                    },
                    back: function($event) {
                        $event.preventDefault();
                        $scope.listHandler.interfaceType = 'list';
                        $scope.dom.tasks = false;
                        $scope.dom.lists = true;

                        var promise = RestInterface.getItems({
                            entity: $scope.listHandler.interfaceType,
                            type: 'date',
                            order: 'DESC'
                        });

                        promise.then(function(data) {
                            $scope.directiveData.listing = data.data.lists;
                        });
                        return false;
                    }
                };

                $scope.$on('action.fetch_data', function($event, data) {
                    $scope.listHandler.interfaceType = data.interfaceType;

                    RestInterface = RestProvider.create($scope.listHandler.interfaceType);

                    var promise = RestInterface.getItems({
                        listId: data.listId,
                        entity: $scope.listHandler.interfaceType,
                        type: 'date',
                        order: 'DESC'
                    });

                    promise.then(function(data) {
                        $scope.directiveData.listing = data.data.lists;

                        if($scope.listHandler.interfaceType === 'task') {
                            $scope.dom.lists = false;

                            $timeout(function() {
                                $scope.dom.tasks = true;
                            }, 500);
                        }
                        else {
                            $scope.dom.lists = $scope.listHandler.interfaceType === 'list';
                            $scope.dom.tasks = $scope.listHandler.interfaceType === 'task';
                        }
                    });
                });

                $scope.$on('action.refresh_list', function() {
                    var promise = RestInterface.getItems({
                        listId: $scope.listHandler.selectedListId,
                        entity: $scope.listHandler.interfaceType,
                        type: 'date',
                        order: 'DESC'
                    });

                    promise.then(function(data) {
                        $scope.directiveData.listing = data.data.lists;
                    });
                });

                $scope.$on('action.change_interface', function($event, data) {
                    $scope.listHandler.selectedListId = data.listId;
                })
            }
        }
    }])
    .directive('listRow', ['RestProvider', function(RestProvider) {
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

                        $scope.$emit('action.change_interface', {
                            listId: $scope.listItem.listid,
                            interfaceType: 'task'
                        });
                        return false;
                    },
                    removeList: function($event) {
                        $event.preventDefault();

                        var List, promise;

                        List = RestProvider.create('list');

                        promise = List.deleteItem({
                            listId: $scope.listItem.listid
                        });

                        promise.then(function() {
                            $scope.$emit('action.proxy.refresh_list', {});
                        }, function() {
                        });

                        return false;
                    }
                }
            }
        }
    }]);