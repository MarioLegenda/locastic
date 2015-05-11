angular.module('locastic.helpers', [])
    .factory('Path', ['$location', function ($location) {
        function Path() {
            var environment = null,
                domain = null,
                path = null,
                url = null;

            var namespaces = {
                list: {
                    addList: 'list-managment/add-list'
                }
            };

            this.namespace = function (nms) {
                var splitted = nms.split('.');
                var namespaceType = splitted[0],
                    namespaceUrl = splitted[1];

                if (!namespaces.hasOwnProperty(namespaceType)) {
                    throw new Error('Unknown namespace ' + namespaceType);
                }

                if (!namespaces[namespaceType].hasOwnProperty(namespaceUrl)) {
                    throw new Error('Unknown url ' + namespaceUrl);
                }

                url = namespaces[namespaceType][namespaceUrl];
                return this;
            };

            this.construct = function () {
                if (environment === null || path === null || url === null) {
                    throw new Error('Url cannot be constructed beacuse some of the parameters are null');
                }

                return domain + path + environment + url;
            };

            if ($location.host() === 'localhost') {
                domain = $location.protocol() + '://' + $location.host() + ':' + $location.port();
                path = $location.absUrl().slice(domain.length);

                if (/app_dev.php\/?/.test(path)) {
                    path = path.replace(/app_dev.php\/?/, '');
                    environment = 'app_dev.php/';
                }
                else {
                    environment = '';
                }

                return this;
            }

            domain = $location.protocol() + '://' + $location.host() + ':' + $location.port();
            path = '/';
            environment = (/app_dev.php\/?/.test($location.absUrl())) ? 'app_dev.php/' : '';
        }

        return new Path();
    }]);
