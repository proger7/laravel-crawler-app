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

/* server/privileges/column_privileges.twig */
class __TwigTemplate_21af72c8f4895324f9e1f8e85b615f0c4f6cff3c8f36f5ec708662e5e6fd34dc extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<div class=\"item\" id=\"div_item_";
        echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
        echo "\">
    <label for=\"select_";
        // line 2
        echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
        echo "_priv\">
        <code><dfn title=\"";
        // line 3
        echo twig_escape_filter($this->env, ($context["name_for_dfn"] ?? null), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, ($context["priv_for_header"] ?? null), "html", null, true);
        echo "</dfn></code>
    </label>

    <select id=\"select_";
        // line 6
        echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
        echo "_priv\" name=\"";
        echo twig_escape_filter($this->env, ($context["name_for_select"] ?? null), "html", null, true);
        echo "[]\" multiple=\"multiple\" size=\"8\">
        ";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["columns"] ?? null));
        foreach ($context['_seq'] as $context["curr_col"] => $context["curr_col_privs"]) {
            // line 8
            echo "            <option value=\"";
            echo twig_escape_filter($this->env, $context["curr_col"], "html", null, true);
            echo "\"
            ";
            // line 9
            if ((((($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = ($context["row"] ?? null)) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4[($context["name_for_select"] ?? null)] ?? null) : null) == "Y") || (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = $context["curr_col_privs"]) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144[($context["name_for_current"] ?? null)] ?? null) : null))) {
                // line 10
                echo "                selected=\"selected\"
            ";
            }
            // line 11
            echo ">
                ";
            // line 12
            echo twig_escape_filter($this->env, $context["curr_col"], "html", null, true);
            echo "
            </option>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['curr_col'], $context['curr_col_privs'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
        echo "    </select>

    <em>";
        // line 17
        echo _gettext("Or");
        echo "</em>
    <label for=\"checkbox_";
        // line 18
        echo twig_escape_filter($this->env, ($context["name_for_select"] ?? null), "html", null, true);
        echo "_none\">
        <input type=\"checkbox\" name=\"";
        // line 19
        echo twig_escape_filter($this->env, ($context["name_for_select"] ?? null), "html", null, true);
        echo "_none\"
            id=\"checkbox_";
        // line 20
        echo twig_escape_filter($this->env, ($context["name_for_select"] ?? null), "html", null, true);
        echo "_none\"
            title=\"";
        // line 21
        echo _pgettext(        "None privileges", "None");
        echo "\">
            ";
        // line 22
        echo _pgettext(        "None privileges", "None");
        // line 23
        echo "    </label>
</div>
";
    }

    public function getTemplateName()
    {
        return "server/privileges/column_privileges.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  113 => 23,  111 => 22,  107 => 21,  103 => 20,  99 => 19,  95 => 18,  91 => 17,  87 => 15,  78 => 12,  75 => 11,  71 => 10,  69 => 9,  64 => 8,  60 => 7,  54 => 6,  46 => 3,  42 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "server/privileges/column_privileges.twig", "/var/www/html/laravelapp/public/pma/templates/server/privileges/column_privileges.twig");
    }
}
