<?php


namespace HelloSebastian\HelloStimulusBundle\Form;

use Symfony\Component\Form\FormView;

/**
 * Class StimulusFormHelper.
 */
class StimulusFormHelper
{
    /**
     * @var string
     */
    private $controllerName;

    /**
     * @var string
     */
    private $defaultEvent;

    /**
     * StimulusHelper constructor.
     *
     * @param string $controllerName
     * @param string $defaultEvent
     */
    public function __construct($controllerName, $defaultEvent = "click")
    {
        $tempName = str_replace("_", "-", $controllerName);
        $this->controllerName = str_replace("/", "--", $tempName);

        $this->defaultEvent = $defaultEvent;
    }

    /**
     * Return data attr array element for form for actions.
     *
     * @param string $method
     * @param null $event
     * @return array
     */
    public function action($method, $event = null)
    {
        $e = is_null($event) ? $this->defaultEvent : $event;

        return array(
            "data-action" => "$e->$this->controllerName#$method"
        );
    }

    /**
     * Return data attr array element for form for targets.
     *
     * @param string $target
     * @return array
     */
    public function target($target)
    {
        return array(
            "data-$this->controllerName-target" => $target
        );
    }

    /**
     * Set controller name to attr in form view.
     *
     * @param FormView $view
     */
    public function setControllerNameToFormView(FormView $view)
    {
        $attr = $view->vars['attr'];

        $controller = isset($attr['data-controller']) ? $attr['data-controller'] . " " : "";
        $controller .= $this->getControllerName();
        $attr['data-controller'] = $controller;

        $view->vars['attr'] = $attr;
    }

    /**
     * Return controller name.
     *
     * @return string
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }
}