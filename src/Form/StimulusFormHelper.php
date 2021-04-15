<?php


namespace HelloSebastian\HelloStimulusBundle\Form;


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
        $this->controllerName = $controllerName;
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
            "data-action" => "$e->$this->controllerName#$method",
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
}