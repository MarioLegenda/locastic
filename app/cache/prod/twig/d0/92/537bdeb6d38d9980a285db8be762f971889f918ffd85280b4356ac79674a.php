<?php

/* LocasticPublicBundle:Login:login.html.twig */
class __TwigTemplate_d092537bdeb6d38d9980a285db8be762f971889f918ffd85280b4356ac79674a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::unAuthLayout.html.twig", "LocasticPublicBundle:Login:login.html.twig", 1);
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
        echo "Login";
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
        if (((isset($context["verificationNotice"]) ? $context["verificationNotice"] : null) != null)) {
            // line 11
            echo "                <div class=\"FormRow\">
                    <div class=\"GlobalErrors\">
                        <label class=\"GlobalError\">";
            // line 13
            echo twig_escape_filter($this->env, (isset($context["verificationNotice"]) ? $context["verificationNotice"] : null), "html", null, true);
            echo "</label>
                    </div>
                </div>
            ";
        }
        // line 17
        echo "            <form action=\"";
        echo $this->env->getExtension('routing')->getPath("login_check");
        echo "\" method=\"POST\">
                ";
        // line 18
        if ((isset($context["error"]) ? $context["error"] : null)) {
            // line 19
            echo "                    <div class=\"FormRow\">
                        <div class=\"GlobalErrors\">
                            <label class=\"GlobalError\">Incorrect username/password or not verified. If you are already registered, check your email and verify your registration</label>
                        </div>
                    </div>
                ";
        }
        // line 25
        echo "
                <div class=\"FormRow\">
                    <label for=\"username\" class=\"FormRow--label  BasicLabel  LoginLabel\">Korisničko ime:</label>
                    <input type=\"text\" id=\"username\" name=\"_username\" value=\"";
        // line 28
        echo twig_escape_filter($this->env, (isset($context["last_username"]) ? $context["last_username"] : null), "html", null, true);
        echo "\" class=\"FormRow--field  BasicField  LoginField\" />
                </div>

                <div class=\"FormRow\">
                    <label for=\"password\" class=\"FormRow--label  BasicLabel  LoginLabel\">Lozinka:</label>
                    <input type=\"password\" id=\"password\" name=\"_password\" class=\"FormRow--field  BasicField  LoginField\"  />
                </div>

                <div class=\"FormRow\">
                    <input type=\"submit\" name=\"LoginSubmit\" class=\"FormRow--SubmitButton  BasicSubmitButton  LoginButton\" value=\"Suit up\">
                </div>
            </form>
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
        return "LocasticPublicBundle:Login:login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  99 => 6,  80 => 28,  75 => 25,  67 => 19,  65 => 18,  60 => 17,  53 => 13,  49 => 11,  47 => 10,  42 => 7,  39 => 6,  36 => 5,  30 => 3,  11 => 1,);
    }
}
