<?php

/* :_restPartials:listRow.html.twig */
class __TwigTemplate_9095371e31a6f12b75b773157b8527f5750836941df8632aff100ecc122a0d03 extends Twig_Template
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
        return ":_restPartials:listRow.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
