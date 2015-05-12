angular.module('locastic.directives')
    .directive('addTask', ['RestProvider', 'Range', 'FormHandler', function(RestProvider, Range, FormHandler) {
        return {
            restrict: 'E',
            replace: true,
            templateUrl: 'newTaskForm.html',
            controller: function($scope) {
                var Task = RestProvider.create('task');



                $scope.task = {
                    form: FormHandler.init($scope, 'newTask'),
                    name: '',
                    priority: {
                        values: [
                            { id: 1, value: 'Low'},
                            { id: 2, value: 'Normal'},
                            { id: 3, value: 'Maximum'}
                        ]
                    },
                    deadline: {
                        day: Range.range(1, 31, true),
                        month: Range.range(1, 12, true),
                        year: Range.range(2015, 2020, true)
                    },
                    selected: {
                        day: null,
                        month: null,
                        year: null,
                        priority: null
                    },
                    errors: {
                        error: false,
                        messages: []
                    },
                    submit: function($event) {
                        $event.preventDefault();

                        if($scope.task.form.isValidForm()) {

                            /* Checks if entered date is a valid one */
                            var validDate = ( function(dates, today) {
                                    var selected = new Date(dates.year.value, dates.month.value, dates.day.value);

                                    return selected > today;
                                } ($scope.task.selected, new Date()));

                            if(validDate === false) {
                                $scope.task.errors.error = true;
                                $scope.task.errors.messages.push('You cannot select past dates as deadlines');

                                return;
                            }


                        }

                        return false;
                    }
                };

                $scope.task.selected.day = $scope.task.deadline.day[0];
                $scope.task.selected.month = $scope.task.deadline.month[0];
                $scope.task.selected.year = $scope.task.deadline.year[0];
                $scope.task.selected.priority = $scope.task.priority.values[1];


            }
        }
    }]);
