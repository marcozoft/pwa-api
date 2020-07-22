<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* index.html.twig */
class __TwigTemplate_0a9e1490a57e8f36b7da198f3573d252d541d7085942812222c4938e1e767131 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'contenido' => [$this, 'block_contenido'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 2
        return "layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("layout.html.twig", "index.html.twig", 2);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo " Turnos ";
    }

    // line 4
    public function block_contenido($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 5
        echo "    <h2>Bienvenido ";
        echo twig_escape_filter($this->env, ($context["nombre"] ?? null), "html", null, true);
        echo "</h2>
    <p>Hola soy Frame y te saludo desde una plantilla Twig</p>
    <p><a href=\"index.php?p=inicio\">Volver a inicio</a></p>
";
    }

    public function getTemplateName()
    {
        return "index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 5,  54 => 4,  47 => 3,  36 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("{# /views/saludo.html.twig #}
{% extends \"layout.html.twig\" %}
{% block title %} Turnos {% endblock %}
{% block contenido %}
    <h2>Bienvenido {{nombre}}</h2>
    <p>Hola soy Frame y te saludo desde una plantilla Twig</p>
    <p><a href=\"index.php?p=inicio\">Volver a inicio</a></p>
{% endblock %}", "index.html.twig", "/var/www/html/turnos/protected/views/index.html.twig");
    }
}
