<?php

/* LocasticAuthorizedBundle:Dashboard:dashboard.html.twig */
class __TwigTemplate_ae3c9531cfbdd27bd1800b25dda7b620f162ef15acb2b0853860a9c5332c125f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::layout.html.twig", "LocasticAuthorizedBundle:Dashboard:dashboard.html.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "    <div class=\"Container\">
        <div class=\"Listing\">
            <managment>
            </managment>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "LocasticAuthorizedBundle:Dashboard:dashboard.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 4,  28 => 3,  11 => 1,);
    }
}
