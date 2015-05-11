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
            }
        }

        return new List();
    }]);
