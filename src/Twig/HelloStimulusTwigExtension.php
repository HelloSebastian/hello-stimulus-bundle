<?php


namespace HelloSebastian\HelloStimulusBundle\Twig;


use HelloSebastian\HelloStimulusBundle\Util\ControllerNameTrait;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class HelloStimulusTwigExtension extends AbstractExtension
{
    use ControllerNameTrait;

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'hello_stimulus_twig_extension';
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new TwigFunction(
                'hello_stimulus_controller',
                [$this, 'renderController'],
                ['is_safe' => ['html_attr'], 'needs_environment' => true]
            ),
            new TwigFunction(
                'hello_stimulus_target',
                [$this, 'renderTarget'],
                ['is_safe' => ['html_attr'], 'needs_environment' => true]
            ),
            new TwigFunction(
                'hello_stimulus_action',
                [$this, 'renderAction'],
                ['is_safe' => ['html_attr'], 'needs_environment' => true]
            ),
            new TwigFunction(
                'hello_stimulus_value',
                [$this, 'renderValue'],
                ['is_safe' => ['html_attr'], 'needs_environment' => true]
            ),
        ];
    }

    public function renderController(Environment $twig, $controllerName, $values = array())
    {
        $dataset = 'data-controller="' . $this->transformControllerName($controllerName) . '"';

        foreach ($values as $value) {
            $dataset .= ' ' . $this->renderValue($twig, $controllerName, $value['name'], $value['value']);
        }

        return $dataset;
    }

    public function renderTarget(Environment $twig, $controllerName, $target)
    {
        return 'data-' . $this->transformControllerName($controllerName) . '-target="' . $target . '"';
    }

    public function renderAction(Environment $twig, $controllerName, $event, $method)
    {
        return 'data-action="' . $event . '->' . $this->transformControllerName($controllerName) . '#' . $method . '"';
    }

    public function renderValue(Environment $twig, $controllerName, $name, $value)
    {
        $kebabCaseName = strtolower(preg_replace('%([A-Z])([a-z])%', '-\1\2', $name));
        return 'data-' . $this->transformControllerName($controllerName) . '-' . $kebabCaseName . '-value="' . $value . '"';
    }


}
