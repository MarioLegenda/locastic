<?php

/* ::unAuthLayout.html.twig */
class __TwigTemplate_fc2e319a68ff01f30381fc71481fc607f91ed395ee2a2c62baa82834d8d90fa9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'content' => array($this, 'block_content'),
            'header' => array($this, 'block_header'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
    <meta charset=\"UTF-8\" />
    <title>Locastic | ";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald:700' rel='stylesheet' type='text/css'>

    ";
        // line 10
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 13
        echo "</head>
<body>
    <div class=\"Global\">
        ";
        // line 16
        $this->displayBlock('content', $context, $blocks);
        // line 19
        echo "    </div>

    ";
        // line 21
        $this->displayBlock('javascripts', $context, $blocks);
        // line 25
        echo "</body>
</html>";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
    }

    // line 10
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 11
        echo "        <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/style.css"), "html", null, true);
        echo "\">
    ";
    }

    // line 16
    public function block_content($context, array $blocks = array())
    {
        // line 17
        echo "            ";
        $this->displayBlock('header', $context, $blocks);
        // line 18
        echo "        ";
    }

    // line 17
    public function block_header($context, array $blocks = array())
    {
    }

    // line 21
    public function block_javascripts($context, array $blocks = array())
    {
        // line 22
        echo "        <script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bower_components/jquery/jquery.min.js"), "html", null, true);
        echo "\"></script>
        <script src=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bower_components/angular/angular.min.js"), "html", null, true);
        echo "\"></script>
    ";
    }

    public function getTemplateName()
    {
        return "::unAuthLayout.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  96 => 23,  91 => 22,  88 => 21,  83 => 17,  79 => 18,  76 => 17,  73 => 16,  66 => 11,  63 => 10,  58 => 5,  53 => 25,  51 => 21,  47 => 19,  45 => 16,  40 => 13,  38 => 10,  30 => 5,  24 => 1,);
    }
}
