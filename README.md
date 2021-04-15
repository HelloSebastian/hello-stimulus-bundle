# HelloStimulusBundle

**This Bundle provides Twig and Symfony form helper functions for [Stimulus.js](https://stimulus.hotwire.dev/).** 

## Overview

1. [Features](#features)
2. [Installation](#installation)
3. [Twig helper functions](#twig-helper-functions)
4. [Form helper functions](#form-helper-functions)

## Features

* Twig helper functions
* Symfony Forms helper functions

## Installation

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the following command to download this bundle:

``` bash
$ composer require hello-sebastian/hello-stimulus-bundle
```

### Step 2: Enable the Bundle (without flex)

Then, enable the bundle by adding it to the list of registered bundles in the `config/bundles.php` file of your project:

``` php
// config/bundles.php

return [
    // ...
    HelloSebastian\HelloStimulusBundle\HelloStimulusBundle::class => ['all' => true],
];
```



## Twig helper functions

### hello_stimulus_controller

Render value controller attribute. Optional with values.

#### Parameters

**controllerName**: name of the controller

**values**: array of stimulus values (optional)

#### Examples

```twig
<div {{ hello_stimulus_controller('hello') }}></div>

<div {{ hello_stimulus_controller('hello', [
	{name: 'myValue', value: 'Hey!'},
	{name: 'myNumber', value: 1234}
]) }}></div>
```

is rendered to

```html
<div data-controller="hello"></div>

<div data-controller="hello" data-hello-my-value-value="Hey!" data-hello-my-number-value="1234"></<div>
```

### hello_stimulus_target

Render value target attribute.

#### Parameters

**controllerName**: name of controller for this target

**target**: name of the target attribute

#### Examples

```twig
<h1 {{ hello_stimulus_target('hello', 'greeting') }}></h1>
```

is rendered to

```html
<div data-hello-target="greeting"></div>
```

### hello_stimulus_action

Render action data attribute.

#### Parameters

**controllerName**: name of controller for this action

**event**: DOM event to listen for

**method**: name of the JavaScript method inside the controller class

#### Examples

```twig
<button 
	type="button" 
	{{ hello_stimulus_action('hello', 'click', 'handleBtnClick') }}
>Hey!</button>
```

is rendered to

```html
<button type="button" data-action="click->hello#handleBtnClick">
  Hey!
</button>
```

### hello_stimulus_value

Render value data attribute.

#### Parameters

**controllerName**: name of controller for this value

**name**: name of this value

**value**: value of this value

#### Examples

```twig
<div {{ hello_stimulus_value('hello', 'username', 'hello_sebastian') }}></div>
```

is rendered to

```html
<div data-hello-username-value="hello_sebastian"></div>
```



## Form helper functions

In Symfony Forms it is helpful to pass attributes of stimulus directly to the types. For this purpose, this bundle provides a helper class with two methods (target and value).

### Example

```php
//src/Form

namespace App\Form;

use App\Entity\User;
use HelloSebastian\HelloStimulusBundle\Form\StimulusFormHelper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    private $userFormController;

    public function __construct()
    {
        $this->userFormController = new StimulusFormHelper('user-form');
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, array(
                'label' => 'First name',
              	'attr' => $this->userFormController->target('firstNameInput')
            ))
            ->add('lastName', TextareaType::class, array(
                'label' => 'Last name',
              	'label_attr' => $this->userFormController->target('lastNameLabel')
              	'attr' => $this->userFormController->target('lastNameInput')
            ))
            ->add('email', TextareaType::class, array(
                'label' => 'Email'
            ))
          	->add('isActive', CheckboxType::class, array(
                'label' => 'is Active',
                'required' => false,
                'attr' => array_merge(
                    $this->userFormController->action("handleIsActive", "change"),
                    $this->userFormController->target("isActiveCheckbox"),
                  	array('class' => 'my-checkbox-class')
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
```

`action` and `traget` return an array. If you want to use both inside the same `attr`, you can use `array_merge()`.