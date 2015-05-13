<?php

/* :_restPartials:addList.html.twig */
class __TwigTemplate_6e97b8804d8ed64f01686652b8c182a3f5c8ba2cffaf816427186edf5476111f extends Twig_Template
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
        echo "<script type=\"text/ng-template\" id=\"newListForm.html\">
    <div class=\"ListCreation\">
        <form name=\"newList\" action=\"\" method=\"POST\">
            <div class=\"FormRow\" ng-if=\"list.errors.error == true\">
                <div class=\"GlobalErrors\" ng-repeat=\"message in list.errors.messages\">
                    <label class=\"GlobalError\">{[{ message }]}</label>
                </div>
            </div>
            <div class=\"FormRow\">
                <input type=\"text\" class=\"FormRow--field  BasicField\" ng-model=\"list.name\" placeholder=\"List name\">
                <input type=\"submit\" class=\"BasicField BasicSubmitButton\" ng-click=\"list.submit(\$event)\" value=\"Create list\">
            </div>
        </form>
    </div>
</script>";
    }

    public function getTemplateName()
    {
        return ":_restPartials:addList.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
