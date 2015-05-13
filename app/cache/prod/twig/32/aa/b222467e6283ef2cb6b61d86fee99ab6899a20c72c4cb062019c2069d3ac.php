<?php

/* LocasticPublicBundle:Public:public.html.twig */
class __TwigTemplate_32aab222467e6283ef2cb6b61d86fee99ab6899a20c72c4cb062019c2069d3ac extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::unAuthLayout.html.twig", "LocasticPublicBundle:Public:public.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
            'header' => array($this, 'block_header'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::unAuthLayout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "Home";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "    ";
        $this->displayBlock('header', $context, $blocks);
        // line 7
        echo "
    <div class=\"Container\">
        <div class=\"Public  PublicUnauthorized\">
            <h1 class=\"Public__Title\">TASK MANAGER</h1>

            <div class=\"Public__Links\">
                <a href=\"";
        // line 13
        echo $this->env->getExtension('routing')->getPath("locastic_public_registration");
        echo "\" class=\"Links__Link\">Register</a>
                <a href=\"";
        // line 14
        echo $this->env->getExtension('routing')->getPath("login");
        echo "\" class=\"Links__Link\">Login</a>
            </div>
        </div>
    </div>
";
    }

    // line 6
    public function block_header($context, array $blocks = array())
    {
        echo " ";
        echo twig_include($this->env, $context, "::_partials/header.html.twig");
        echo " ";
    }

    public function getTemplateName()
    {
        return "LocasticPublicBundle:Public:public.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  63 => 6,  54 => 14,  50 => 13,  42 => 7,  39 => 6,  36 => 5,  30 => 3,  11 => 1,);
    }
}
