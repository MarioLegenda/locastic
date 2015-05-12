angular.module('locastic.directives', [])
    .directive('managment', ['List', function (List) {
        return {
            restrict: 'E',
            replace: true,
            scope: {},
            templateUrl: 'managment.html',
            controller: function ($scope) {
                var privateHandler = {
                    makeLists: function() {
                    }
                };

                privateHandler.makeLists();

                // proxy between addList directive and listing directive. Not the best solution but keeps scopes separate
                $scope.$on('action.proxy.refresh_list', function() {
                    $scope.$broadcast('action.refresh_list', {});
                });


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
                                $scope.$emit('action.proxy.refresh_list', {});
                            }, function(data) {
                                $scope.list.errors.error = true;
                                $scope.list.errors.messages.push(data.data);
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
    .directive('listHandler', ['List', function(List) {
        return {
            restrict: 'A',
            replace: false,
            controller: function($scope) {
                $scope.dom = {
                    addList: false
                };

                $scope.listHandler = {
                    addList: function($event) {
                        $event.preventDefault();

                        $scope.dom.addList = !$scope.dom.addList;
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
                        var promise = List.getLists({
                            type: type,
                            order: $scope.listHandler.listingOrder.makeOrder(type)
                        });

                        promise.then(function(data) {
                            $scope.directiveData.listing = data.data.lists;
                        });
                    }
                };


                var promise = List.getLists({
                    type: 'date',
                    order: 'DESC'
                });

                promise.then(function(data) {
                    $scope.$emit('action.lists_listing', {
                        listing: data.data.lists
                    });
                });

                $scope.$on('action.refresh_list', function() {
                    var promise = List.getLists({
                        type: 'date',
                        order: 'DESC'
                    });

                    promise.then(function(data) {
                        $scope.directiveData.listing = data.data.lists;
                    });
                })
            }
        }
    }])
    .directive('listRow', ['Toggle', 'List', function(Toggle, List) {
        return {
            restrict: 'E',
            replace: true,
            scope: {
                listItem: '=listItem'
            },
            templateUrl: 'listRow.html',
            controller: function($scope) {
                $scope.directiveData = {
                };

                Toggle.create($scope.listItem.listname, {
                    enter: function() {
                        this.elem.css({
                            height: '500px'
                        });
                    },
                    exit: function() {
                        this.elem.css({
                            height: this.originalHeight + 'px'
                        });
                    }
                });
            },
            link: function($scope, elem, attrs) {

                var originalHeight = elem.innerHeight() + 3;

                // event fired when clicked on a particular list
                $scope.directiveData.expand = function($event) {
                    $event.preventDefault();

                    Toggle.toggle($scope.listItem.listname, {
                        elem: elem,
                        originalHeight: originalHeight
                    });
                    return false;
                }
            }
        }
    }]);