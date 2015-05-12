angular.module('locastic.helpers', [])
    .factory('Path', ['$location', function ($location) {
        function Path() {
            var environment = null,
                domain = null,
                path = null,
                url = null;

            var namespaces = {
                list: {
                    addList: 'list-managment/add-list',
                    getLists: 'list-managment/get-lists'
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
    }])
    .factory('Toggle', [function() {
        function Toggle() {
            var faze = false, config = {},
                valueIs = function (value, type) {
                    if (({}).toString.call(value).match(/\s([a-zA-Z]+)/)[1].toLowerCase() == type) {
                        return true;
                    }

                    return false;
                },
                hasEntered = false;

            this.create = function(name, c) {
                if( ! c.hasOwnProperty('enter')) {
                    throw new Error('Toggle: Toggle should have a \'enter\' property');
                }

                if( ! c.hasOwnProperty('exit')) {
                    throw new Error('Toggle: Toggle should have a \'exit\' property');
                }

                if( ! valueIs(c.enter, 'function') || ! valueIs(c.exit, 'function')) {
                    throw new Error('Toggle: Toggle.enter and Toggle.exit should be functions');
                }

                config[name] = c;
                config[name].faze = false;

                return this;
            };

            this.toggle = function(name, context) {
                if(config[name].faze === false) {
                    if(typeof context !== 'undefined') {
                        config[name].enter.call(context);
                    }
                    else {
                        config[name].enter();
                    }

                    config[name].faze = true;
                    config[name].hasEntered = true;
                }
                else if(config[name].faze === true) {
                    if(typeof context !== 'undefined') {
                        config[name].exit.call(context);
                    }
                    else {
                        config[name].exit();
                    }

                    config[name].faze = false;
                }
            };

            this.hasEntered = function(name) {
                if( ! config[name].hasOwnProperty('hasEntered')) {
                    return false;
                }

                return config[name].hasEntered;
            };

            this.isEntered = function() {
                return faze;
            };

            this.isExited = function() {
                return faze;
            };
        }

        return new Toggle();
    }])
    .factory('Range', [function() {
        function Range() {
            this.range = function(min, max, asObject) {
                var range = [], i, obj;

                if(asObject === true) {
                    for(i = min; i <= max; i++) {
                        obj = { id: i, value: i};

                        range.push(obj);
                    }

                    return range;
                }

                for(i = min; i <= max; i++) {
                    range.push(i);
                }

                return range;
            }
        }

        return new Range();
    }]);
