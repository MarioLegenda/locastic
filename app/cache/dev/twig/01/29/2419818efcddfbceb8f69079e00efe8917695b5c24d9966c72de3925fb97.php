<?php

/* LocasticPublicBundle:Registration:registration.html.twig */
class __TwigTemplate_01292419818efcddfbceb8f69079e00efe8917695b5c24d9966c72de3925fb97 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::unAuthLayout.html.twig", "LocasticPublicBundle:Registration:registration.html.twig", 1);
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
        echo "Register";
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
        <div class=\"FormPosition  LoginForm\">
            ";
        // line 10
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_start', array("attr" => array("novalidate" => "novalidate")));
        echo "

            ";
        // line 12
        if (array_key_exists("user_exists", $context)) {
            // line 13
            echo "                <div class=\"FormRow\">
                    <div class=\"GlobalErrors\">
                        <label class=\"GlobalError\">User with username ";
            // line 15
            echo twig_escape_filter($this->env, (isset($context["user_exists"]) ? $context["user_exists"] : $this->getContext($context, "user_exists")), "html", null, true);
            echo " already exists</label>
                    </div>
                </div>
            ";
        }
        // line 19
        echo "
            <div class=\"FormRow\">
                ";
        // line 21
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "name", array()), 'label', array("label_attr" => array("class" => "FormRow--label  BasicLabel")));
        echo "
                ";
        // line 22
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "name", array()), 'widget', array("attr" => array("class" => "FormRow--field  BasicField")));
        echo "
            </div>
            ";
        // line 24
        if (twig_length_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "name", array()), "vars", array()), "errors", array()))) {
            // line 25
            echo "                <div class=\"FormRow\">
                    <div class=\"GlobalErrors\">
                        <label class=\"GlobalError\">";
            // line 27
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "name", array()), 'errors');
            echo "</label>
                    </div>
                </div>
            ";
        }
        // line 31
        echo "
            <div class=\"FormRow\">
                ";
        // line 33
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "lastname", array()), 'label', array("label_attr" => array("class" => "FormRow--label  BasicLabel")));
        echo "
                ";
        // line 34
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "lastname", array()), 'widget', array("attr" => array("class" => "FormRow--field  BasicField")));
        echo "
            </div>
            ";
        // line 36
        if (twig_length_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "lastname", array()), "vars", array()), "errors", array()))) {
            // line 37
            echo "                <div class=\"FormRow\">
                    <div class=\"GlobalErrors\">
                        <label class=\"GlobalError\">";
            // line 39
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "lastname", array()), 'errors');
            echo "</label>
                    </div>
                </div>
            ";
        }
        // line 43
        echo "

            <div class=\"FormRow\">
                ";
        // line 46
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "username", array()), 'label', array("label_attr" => array("class" => "FormRow--label  BasicLabel")));
        echo "
                ";
        // line 47
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "username", array()), 'widget', array("attr" => array("class" => "FormRow--field  BasicField")));
        echo "
            </div>
            ";
        // line 49
        if (twig_length_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "username", array()), "vars", array()), "errors", array()))) {
            // line 50
            echo "                <div class=\"FormRow\">
                    <div class=\"GlobalErrors\">
                        <label class=\"GlobalError\">";
            // line 52
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "username", array()), 'errors');
            echo "</label>
                    </div>
                </div>
            ";
        }
        // line 56
        echo "

            <div class=\"FormRow\">
                ";
        // line 59
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "password", array()), 'label', array("label_attr" => array("class" => "FormRow--label  BasicLabel")));
        echo "
                ";
        // line 60
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "password", array()), 'widget', array("attr" => array("class" => "FormRow--field  BasicField")));
        echo "
            </div>
            ";
        // line 62
        if (twig_length_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "password", array()), "vars", array()), "errors", array()))) {
            // line 63
            echo "                <div class=\"FormRow\">
                    <div class=\"GlobalErrors\">
                        <label class=\"GlobalError\">";
            // line 65
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "password", array()), 'errors');
            echo "</label>
                    </div>
                </div>
            ";
        }
        // line 69
        echo "

            <div class=\"FormRow\">
                ";
        // line 72
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "passRepeat", array()), 'label', array("label_attr" => array("class" => "FormRow--label  BasicLabel"), "label" => "Repeat password"));
        echo "
                ";
        // line 73
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "passRepeat", array()), 'widget', array("attr" => array("class" => "FormRow--field  BasicField")));
        echo "
            </div>
            ";
        // line 75
        if (twig_length_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "passRepeat", array()), "vars", array()), "errors", array()))) {
            // line 76
            echo "                <div class=\"FormRow\">
                    <div class=\"GlobalErrors\">
                        <label class=\"GlobalError\">";
            // line 78
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "passRepeat", array()), 'errors');
            echo "</label>
                    </div>
                </div>
            ";
        }
        // line 82
        echo "

            <div class=\"FormRow\">
                ";
        // line 85
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "save", array()), 'widget', array("attr" => array("class" => "FormRow--SubmitButton  BasicSubmitButton  LoginButton")));
        echo "
            </div>

            ";
        // line 88
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_end');
        echo "
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
        return "LocasticPublicBundle:Registration:registration.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  217 => 6,  209 => 88,  203 => 85,  198 => 82,  191 => 78,  187 => 76,  185 => 75,  180 => 73,  176 => 72,  171 => 69,  164 => 65,  160 => 63,  158 => 62,  153 => 60,  149 => 59,  144 => 56,  137 => 52,  133 => 50,  131 => 49,  126 => 47,  122 => 46,  117 => 43,  110 => 39,  106 => 37,  104 => 36,  99 => 34,  95 => 33,  91 => 31,  84 => 27,  80 => 25,  78 => 24,  73 => 22,  69 => 21,  65 => 19,  58 => 15,  54 => 13,  52 => 12,  47 => 10,  42 => 7,  39 => 6,  36 => 5,  30 => 3,  11 => 1,);
    }
}
