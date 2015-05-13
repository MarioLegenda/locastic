<?php

/* ::email.html.twig */
class __TwigTemplate_92109b3824243e48ac4fc9379bdeff86a82f8a1cec842e95c0736996a53e62f7 extends Twig_Template
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
        echo "<div class=\"EmailVerification\">
    <p>Click on this link to verify this email</p>

    <p>";
        // line 4
        echo twig_escape_filter($this->env, (isset($context["link"]) ? $context["link"] : null), "html", null, true);
        echo "</p>
</div>";
    }

    public function getTemplateName()
    {
        return "::email.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  24 => 4,  19 => 1,);
    }
}
