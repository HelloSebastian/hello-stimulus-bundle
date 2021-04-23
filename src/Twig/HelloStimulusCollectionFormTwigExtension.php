<?php


namespace HelloSebastian\HelloStimulusBundle\Twig;


use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class HelloStimulusCollectionFormTwigExtension extends AbstractExtension
{
    private $helloStimulusTwigExtension;

    public function __construct()
    {
        $this->helloStimulusTwigExtension = new HelloStimulusTwigExtension();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'hello_stimulus_collection_form_twig_extension';
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new TwigFunction(
                'hello_stimulus_collection_form_controller',
                [$this, 'renderCollectionFormController'],
                ['is_safe' => ['html_attr'], 'needs_environment' => true]
            ),
            new TwigFunction(
                'hello_stimulus_collection_form_holder',
                [$this, 'renderCollectionFormHolder'],
                ['is_safe' => ['html_attr'], 'needs_environment' => true]
            ),

            new TwigFunction(
                'hello_stimulus_collection_form_item_controller',
                [$this, 'renderCollectionForm'],
                ['is_safe' => ['html_attr'], 'needs_environment' => true]
            )
        ];
    }

    public function renderCollectionFormController(Environment $twig, $prototype)
    {
        return $this->helloStimulusTwigExtension->renderController($twig, 'collection-form', array(
            'name' => 'prototype',
            'value' => $prototype
        ));
    }

    public function renderCollectionFormHolder(Environment $twig)
    {
        return $this->helloStimulusTwigExtension->renderTarget($twig, 'collection-form', 'holder');
    }


}
