<?php

/* ::_partials/header.html.twig */
class __TwigTemplate_e2e56fa16a2b3de1754b08116eb0a84be65d1b05a20c707f7f96c72ae63b614c extends Twig_Template
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
        echo "<div class=\"Header\">
    <ul class=\"Navigation\">
        <li class=\"List\"><a href=\"";
        // line 3
        echo $this->env->getExtension('routing')->getPath("locastic_public_unauthorized");
        echo "\" class=\"Link\">HOME</a></li>
        <li class=\"List\"><a href=\"";
        // line 4
        echo $this->env->getExtension('routing')->getPath("locastic_public_registration");
        echo "\" class=\"Link\">REGISTER</a></li>
        <li class=\"List\"><a href=\"";
        // line 5
        echo $this->env->getExtension('routing')->getPath("login");
        echo "\" class=\"Link\">LOGIN</a></li>
    </ul>
</div>";
    }

    public function getTemplateName()
    {
        return "::_partials/header.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 5,  27 => 4,  23 => 3,  19 => 1,);
    }
}
