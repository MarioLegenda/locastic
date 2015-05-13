<?php

/* :_restPartials:listHandler.html.twig */
class __TwigTemplate_aa9bb0c66cc0aa337feffb96d39662ef9703f4c81d725f6db7addd15569f2ba6 extends Twig_Template
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
        echo "<script type=\"text/ng-template\" id=\"listHandler.html\">
    <div class=\"ListHandler\">
        <div class=\"DirectiveWrapper\" list-handler>
            <div class=\"ListingManager\" ng-if=\"dom.lists == true\">
                <div class=\"Sorting\">
                    <p class=\"SortingTitle\">Sort by</p>

                    <button class=\"Button\" ng-click=\"listHandler.sort('name')\">Name</button>
                    <button class=\"Button\" ng-click=\"listHandler.sort('date')\">Date created</button>
                </div>
            </div>

            <div class=\"TaskManager\" ng-if=\"dom.tasks == true\">
                <div class=\"Sorting\">
                    <p class=\"SortingTitle\">Sort by</p>

                    <button class=\"Button\" ng-click=\"listHandler.sort('name')\">Name</button>
                    <button class=\"Button\" ng-click=\"listHandler.sort('date')\">Date created</button>
                    <button class=\"Button  ButtonRight\" ng-if=\"dom.tasks == true\" ng-click=\"listHandler.sort('deadline')\">Deadline</button>
                    <button class=\"Button  ButtonRight\" ng-if=\"dom.tasks == true\" ng-click=\"listHandler.sort('priority')\">Priority</button>
                </div>

                <div class=\"\">
                    <button class=\"Button\" ng-click=\"listHandler.back(\$event)\">Back to lists</button>
                </div>
            </div>

            <add-list ng-if=\"dom.lists == true\"></add-list>
            <add-task ng-if=\"dom.tasks == true\" list-id=\"{[{ listHandler.selectedListId }]}\" prepopulated=\"{[{ directiveData.prepopulated }]}\" task-item=\"{[{ directiveData.taskItem }]}\"></add-task>

            <div class=\"Listing\" ng-if=\"dom.lists == true\">
                <list-row ng-repeat=\"item in directiveData.listing\" list-item=\"item\"></list-row>
            </div>

            <div class=\"Tasks\" ng-if=\"dom.tasks == true\">
                <task-row ng-repeat=\"item in directiveData.listing\" task-item=\"item\" list-id=\"{[{ listHandler.selectedListId }]}\"></task-row>
            </div>
        </div>
    </div>
</script>";
    }

    public function getTemplateName()
    {
        return ":_restPartials:listHandler.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
