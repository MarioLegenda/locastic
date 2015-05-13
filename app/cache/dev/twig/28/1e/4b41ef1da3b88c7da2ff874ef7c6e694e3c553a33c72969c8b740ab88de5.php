<?php

/* _restPartials/taskRow.html.twig */
class __TwigTemplate_281e4b41ef1da3b88c7da2ff874ef7c6e694e3c553a33c72969c8b740ab88de5 extends Twig_Template
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
        echo "<script type=\"text/ng-template\" id=\"taskRow.html\">
    <div class=\"Row  ListRow  FixedHeight\">
        <a class=\"Expandable\" ng-click=\"taskRow.expand(\$event)\">
            <span class=\"RowInfo  TaskInfo\">Task name: {[{ taskItem.tasktitle }]}</span>
        </a>

        <div class=\"ListInfo\">
            <label>Task created: {[{ taskItem.taskcreated | dateParse }]}</label>
        </div>

        <div class=\"ListInfo\">
            <label>Deadline: {[{ taskItem.deadline | dateParse }]}</label>
        </div>

        <div class=\"ListInfo\">
            <label>Priority: {[{ taskItem.priority }]}</label>
        </div>

        <div class=\"ListInfo\">
            <label>Status: {[{ taskItem.isfinished }]}</label>
        </div>

        <div class=\"ListInfo\">
            <label>Days to complete: </label>
        </div>

        <div class=\"TaskManagment\">
            <button class=\"Button\" ng-click=\"taskRow.deleteTask(\$event)\">Delete task</button>
            <button class=\"Button\" ng-click=\"taskRow.changeMetadata(\$event)\">Change task information</button>
        </div>

        <add-task ng-if=\"directiveData.prepopulated == true\" list-id=\"{[{ listHandler.selectedListId }]}\" prepopulated=\"{[{ directiveData.prepopulated }]}\" task-item=\"{[{ directiveData.taskItem }]}\"></add-task>
    </div>
</script>";
    }

    public function getTemplateName()
    {
        return "_restPartials/taskRow.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
