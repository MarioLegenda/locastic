<?php

/* _restPartials/listRow.html.twig */
class __TwigTemplate_97b2634bae9292383785fe82830366bba2c8c055047d80629c16f2619557cbe0 extends Twig_Template
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
        echo "<script type=\"text/ng-template\" id=\"listRow.html\">
    <div class=\"RowWrapper\">
        <div class=\"Row  ListRow\">
            <a class=\"Expandable\" ng-click=\"directiveData.taskList(\$event)\">
                <span class=\"RowInfo\">{[{ listItem.listname }]}</span>
                <span class=\"RowInfo\">{[{ listItem.listcreated | dateParse }]}</span>
                <span class=\"RowInfo\">Total tasks: {[{ listItem.total_tasks }]}</span>
                <span class=\"RowInfo\">Pending tasks: {[{ listItem.unfinished }]}</span>
                <span class=\"RowInfo\">Progress: {[{ listItem.completed }]}%</span>
            </a>
        </div>

        <button class=\"Button RemoveList\" ng-click=\"directiveData.removeList(\$event)\">RemoveList</button>
    </div>
</script>";
    }

    public function getTemplateName()
    {
        return "_restPartials/listRow.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
