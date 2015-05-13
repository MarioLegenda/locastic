<?php

/* _restPartials/addTask.html.twig */
class __TwigTemplate_a2914124603dd9f9b182bd6bca2f8f23040cda34cbd57c6aff1456d067bab439 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<script type=\"text/ng-template\" id=\"newTaskForm.html\">
    <div class=\"ListCreation\">
        <form name=\"newTask\" action=\"\" method=\"POST\">
            <div class=\"FormRow\" ng-if=\"task.errors.error == true\">
                <div class=\"GlobalErrors\" ng-repeat=\"message in task.errors.messages\">
                    <label class=\"GlobalError\">{[{ message }]}</label>
                </div>
            </div>

            <div class=\"FormRow\">
                <div class=\"FormError  BasicError  TaskError\" ng-show=\"task.form.notExists('task_name')\">
                    <p>Task name has to be provided</p>
                </div>
                <input type=\"text\" name=\"task_name\" class=\"FormRow--field BasicField\" ng-model=\"task.name\" placeholder=\"Task name\" required>
            </div>

            <div class=\"FormRow\">
                <select class=\"BasicSelect  TaskSelect\" ng-model=\"task.selected.priority\" ng-options=\"priority.value for priority in task.priority.values track by priority.id\"></select>
            </div>

            <div class=\"FormRow\">
                <label class=\"TaskFormField  BasicLabel  TaskLabel\">Deadline</label>
                <select class=\"BasicSelect  TaskSelect\" ng-model=\"task.selected.day\" ng-options=\"day.value for day in task.deadline.day\"></select>
                <select class=\"BasicSelect  TaskSelect\" ng-model=\"task.selected.month\" ng-options=\"month.value for month in task.deadline.month\"></select>
                <select class=\"BasicSelect  TaskSelect\" ng-model=\"task.selected.year\" ng-options=\"year.value for year in task.deadline.year\"></select>
            </div>

            <div class=\"FormRow\">
                <input ng-if=\"prepopulated != 'true'\" type=\"submit\" class=\"BasicField BasicSubmitButton\" ng-click=\"task.submit(\$event)\" value=\"Create task\">
                <input ng-if=\"prepopulated == 'true'\" type=\"submit\" class=\"BasicField BasicSubmitButton\" ng-click=\"task.submit(\$event)\" value=\"Modify task\">
            </div>
        </form>
    </div>
</script>";
    }

    public function getTemplateName()
    {
        return "_restPartials/addTask.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
