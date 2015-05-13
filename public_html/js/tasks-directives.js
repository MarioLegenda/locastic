angular.module('locastic.directives')
    .directive('addTask', ['RestProvider', 'Range', 'FormHandler', '$timeout', function(RestProvider, Range, FormHandler, $timeout) {
        return {
            restrict: 'E',
            replace: true,
            scope: {
                listId: '@listId',
                prepopulated: '@prepopulated',
                taskItem: '@taskItem'
            },
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
                            { id: 3, value: 'High'}
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

                            // removes previous errors if any
                            $scope.task.errors.error = false;

                            var date = {
                                year: $scope.task.selected.year.value,
                                month: $scope.task.selected.month.value,
                                day: $scope.task.selected.day.value
                            };

                            if($scope.prepopulated == 'true') {
                                Task = RestProvider.create('task');
                                    var task = JSON.parse($scope.taskItem),
                                    promise;

                                promise = Task.modifyItem({
                                    taskId: task.taskid,
                                    name: $scope.task.name,
                                    deadline: date,
                                    priority: $scope.task.selected.priority.id
                                });

                                promise.then(function() {
                                    $scope.$emit('action.proxy.refresh_list', {});
                                });

                                return;
                            }

                            console.log(Task);
                            var promise = Task.addItem({
                                listId: $scope.listId,
                                name: $scope.task.name,
                                deadline: date,
                                priority: $scope.task.selected.priority.id
                            });

                            promise.then(function() {
                                $scope.task.selected.day = $scope.task.deadline.day[0];
                                $scope.task.selected.month = $scope.task.deadline.month[0];
                                $scope.task.selected.year = $scope.task.deadline.year[0];
                                $scope.task.selected.priority = $scope.task.priority.values[1];

                                $scope.$emit('action.proxy.refresh_list', {});
                            }, function(data) {
                                $scope.task.errors.error = true;
                                $scope.task.errors.messages = data.data;
                            })
                        }

                        return false;
                    }
                };

                $scope.task.selected.day = $scope.task.deadline.day[0];
                $scope.task.selected.month = $scope.task.deadline.month[0];
                $scope.task.selected.year = $scope.task.deadline.year[0];
                $scope.task.selected.priority = $scope.task.priority.values[1];

                $timeout(function() {

                    /* This is so dirty that it cannot be dirtier. */

                    if($scope.prepopulated == 'true') {
                        var task = JSON.parse($scope.taskItem),
                            priorities = $scope.task.priority.values,
                            deadline = new Date(task.deadline.date);

                        console.log(task);

                        $scope.task.name = task.tasktitle;

                        for(var i = 0; i < priorities.length; i++) {
                            if(priorities[i].hasOwnProperty('value')) {
                                if(priorities[i].value === task.priority) {
                                    $scope.task.selected.priority = priorities[i];
                                }
                            }
                        }

                        var yearIndex = ( function(year) {
                            var years = $scope.task.deadline.year;

                            for(var i = 0; i < years.length; i++) {
                                if(years[i].value === year) {
                                    return i;
                                }
                            }
                        } (deadline.getFullYear()) );

                        $scope.task.selected.day = $scope.task.deadline.day[deadline.getDate() - 1];
                        $scope.task.selected.month = $scope.task.deadline.month[deadline.getMonth()];
                        $scope.task.selected.year = $scope.task.deadline.year[yearIndex];
                    }
                }, 1000);


            }
        }
    }])
    .directive('taskRow', ['Toggle', 'RestProvider', function(Toggle, RestProvider) {
        return {
            restrict: 'E',
            replace: true,
            scope: {
                listId: '@listId',
                taskItem: '=taskItem'
            },
            templateUrl: 'taskRow.html',
            controller: function($scope) {
                $scope.directiveData = {
                    prepopulated: false,
                    taskItem: $scope.taskItem
                };

                Toggle.create($scope.taskItem.taskid, {
                    enter: function() {
                        this.elem.css({
                            height:'450px'
                        })
                    },
                    exit: function() {
                        this.elem.css({
                            height: this.originalHeight
                        })
                    }
                });

            },
            link: function($scope, elem, attrs) {
                var originalHeight = '41px';
                $scope.taskRow = {
                    expand: function($event) {
                        $event.preventDefault();

                        Toggle.toggle($scope.taskItem.taskid, {
                            elem: elem,
                            originalHeight: originalHeight
                        });

                        $scope.directiveData.prepopulated = false;

                        return false;
                    },
                    deleteTask: function($event) {
                        $event.preventDefault();

                        var Task, promise;

                        Task = RestProvider.create('task');

                        promise = Task.deleteItem({
                            taskId: $scope.taskItem.taskid
                        });

                        promise.then(function() {
                            $scope.$emit('action.proxy.refresh_list', {});
                        }, function() {

                        });


                        return false;
                    },
                    changeMetadata: function($event) {
                        $event.preventDefault();

                        elem.css({
                            height: '700px'
                        });

                        $scope.directiveData.prepopulated = true;

                        return false;
                    }
                }
            }
        }
    }]);
