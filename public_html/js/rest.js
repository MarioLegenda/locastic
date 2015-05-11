angular.module('locastic.rest', [])
    .factory('List', ['$http', 'Path', function($http, Path) {
        function List() {
            this.addList = function(data) {
                return $http({
                    method: 'POST',
                    url: Path.namespace('list.addList').construct(),
                    data: {
                        name: data.name
                    }
                });
            };

            this.getLists = function(data) {
                return $http({
                    method: 'POST',
                    url: Path.namespace('list.getLists').construct(),
                    data: data
                });
            }
        }

        return new List();
    }]);
