angular.module('locastic.directives')
    .directive('addTask', ['RestProvider', 'Range', function(RestProvider, Range) {
        return {
            restrict: 'E',
            replace: true,
            templateUrl: 'newTaskForm.html',
            controller: function($scope) {
                var Task = RestProvider.create('task');

                $scope.task = {
                    name: '',
                    priority: '',
                    deadline: {
                        day: Range.range(1, 31, true),
                        month: Range.range(1, 12, true),
                        year: Range.range(2015, 2020, true)
                    },
                    selected: {
                        day: null,
                        month: null,
                        year: null
                    },
                    errors: {
                        error: false,
                        messages: []
                    },
                    submit: function($event) {
                        $event.preventDefault();

                        console.log($scope.task.selected);
                        return false;
                    }
                };

                console.log($scope.task.deadline);
                $scope.task.selected.day = $scope.task.deadline.day[0];
                $scope.task.selected.month = $scope.task.deadline.month[0];
                $scope.task.selected.year = $scope.task.deadline.year[0];


            }
        }
    }]);
