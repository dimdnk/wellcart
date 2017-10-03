# StrokerForm


ZF2 module for extending forms with live clientside validation without need to write js validation code. 
You only need to define your validation rules server side with ZF2 and this module automaticaly adds the same rules with [jQueryValidate](http://docs.jquery.com/Plugins/Validation). 


## Usage

First we need to make sure jquery is loaded by our application and the headScript() and inlineScript() view helpers are called. If you already have this in place you can skip this step.

```html
<head>
  <?php echo $this->headLink() ?>
	<?php echo $this->headScript()->prependFile('//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js') ?>
</head>
<body>
<div class="container">
	<?php echo $this->content; ?>
</div>
<?php echo $this->inlineScript() ?>
</body>
```

For the ajax validation to work inputfilters needs to be hooked to the form.
We need to create a serviceFactory and register it with a unique alias to the formManager (this is an pluginManager).
If the inputFilters are already set to the form (i.e. in your form constructor) it's enough to register the form as an invokable

```php
<?php
namespace MyProject\Service;

use Zend\ServiceManager\ServiceLocatorInterface;

class MyFormFactory implements \Zend\ServiceManager\FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new MyForm();
        $model = new MyModel();
        $form->setInputFilter($model->getInputFilter());
        return $form;
    }
}
```

Now let's add our new factory to the formManager.

```php
<?php
return array(
    'stroker_form' => array(
        'forms' => array(
            'factories' => array(
                'my_form_alias' => 'MyProject\Service\MyFormFactory'
            )
        )
    )
);
```

Last thing we need to do is invoking the StrokerFormPrepare view helper where you are rendering your form.
This view helper add all the needed javascripts to the headScript view helper

```php
<?php
$this->strokerFormPrepare('my_form_alias');

// Do your normal form rendering here
```

## Renderers

A renderer should implement the RendererInterface and is responsible for modifying the form rendering (setting inline javascript, modifying the form element attributes, view helpers etc.). 
Currently only the jqueryValidate renderer is available. Support for other validation libraries can be implemented as a seperate renderer. 
#### Styling

If you are using twitter bootstrap and the recommended form structure the styling works out of the box. 
When you are using the ZF2 view helpers for your form you could style the input fields `error` and `valid` classes which are added on the fly by the jquery plugin.

## Excluding elements from clientside validation

You can set the option `strokerform-exclude` on a form element

```php
$name = new Element('name');
$name->setLabel('Your name');
$name->setOption('strokerform-exclude', true);
```
