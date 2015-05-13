<?php

/* ::layout.html.twig */
class __TwigTemplate_5da571506e5161f48cec8ae416735c94cf44d5a2516abdac8529cc354defa2f3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'content' => array($this, 'block_content'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html ng-app=\"locastic.app\">
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

        ";
        // line 8
        echo twig_include($this->env, $context, "_restPartials/managment.html.twig");
        echo "
        ";
        // line 9
        echo twig_include($this->env, $context, "_restPartials/listHandler.html.twig");
        echo "
        ";
        // line 10
        echo twig_include($this->env, $context, "_restPartials/addList.html.twig");
        echo "
        ";
        // line 11
        echo twig_include($this->env, $context, "_restPartials/listRow.html.twig");
        echo "
        ";
        // line 12
        echo twig_include($this->env, $context, "_restPartials/addTask.html.twig");
        echo "
        ";
        // line 13
        echo twig_include($this->env, $context, "_restPartials/taskRow.html.twig");
        echo "

        ";
        // line 15
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 18
        echo "    </head>
    <body>
        <div class=\"Global\">
            ";
        // line 21
        $this->displayBlock('content', $context, $blocks);
        // line 22
        echo "        </div>

        ";
        // line 24
        $this->displayBlock('javascripts', $context, $blocks);
        // line 33
        echo "    </body>
</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "Locastic";
    }

    // line 15
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 16
        echo "            <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/style.css"), "html", null, true);
        echo "\">
        ";
    }

    // line 21
    public function block_content($context, array $blocks = array())
    {
    }

    // line 24
    public function block_javascripts($context, array $blocks = array())
    {
        // line 25
        echo "            <script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bower_components/jquery/jquery.min.js"), "html", null, true);
        echo "\"></script>
            <script src=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bower_components/angular/angular.min.js"), "html", null, true);
        echo "\"></script>
            <script src=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/lists-directives.js"), "html", null, true);
        echo "\"></script>
            <script src=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/tasks-directives.js"), "html", null, true);
        echo "\"></script>
            <script src=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/helpers.js"), "html", null, true);
        echo "\"></script>
            <script src=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/rest.js"), "html", null, true);
        echo "\"></script>
            <script src=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/app.js"), "html", null, true);
        echo "\"></script>
        ";
    }

    public function getTemplateName()
    {
        return "::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  130 => 31,  126 => 30,  122 => 29,  118 => 28,  114 => 27,  110 => 26,  105 => 25,  102 => 24,  97 => 21,  90 => 16,  87 => 15,  81 => 5,  75 => 33,  73 => 24,  69 => 22,  67 => 21,  62 => 18,  60 => 15,  55 => 13,  51 => 12,  47 => 11,  43 => 10,  39 => 9,  35 => 8,  29 => 5,  23 => 1,);
    }
}
