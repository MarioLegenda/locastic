angular.module('locastic.rest', [])
    .factory('RestProvider', ['$http', 'Path', function($http, Path) {
        function RestProvider() {
            var instances = {
                list: null,
                task: null
            };

            var factories = {
                list: function() {
                    return {
                        addItem: function(data) {
                            return $http({
                                method: 'POST',
                                url: Path.namespace('list.addList').construct(),
                                data: {
                                    name: data.name
                                }
                            });
                        },
                        getItems: function(data) {
                            return $http({
                                method: 'POST',
                                url: Path.namespace('list.getLists').construct(),
                                data: data
                            });
                        }
                    }
                },
                task: function() {
                    return {
                        addItem: function(data) {
                            return $http({
                                method: 'POST',
                                url: Path.namespace('task.addTask').construct(),
                                data: data
                            });
                        }
                    }
                }
            };

            this.create = function(type) {
                if(['list', 'task'].indexOf(type) === -1) {
                    throw new Error('RestProvider: Invalid type ' + type + ' supplied');
                }

                if(instances[type] !== null) {
                    return instances[type];
                }

                instances[type] = factories[type]();
                return instances[type];
            }
        }

        return new RestProvider();
    }]);
