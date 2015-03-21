# Business Layer Kohana 3.3

## Installation

Edit your bootstrap file `APPPATH/bootstrap.php` and enable component module:

~~~
Kohana::modules(array(
  // Some modules
  'component' => MODPATH.'component',
  // Some other modules
  ));
~~~

Then copy `MODPATH/sender/config/component.php` to `APPPATH/config/component.php`.
Well done!

## Example of usage

## Example class
APPPATH . 'classes/Component/Test.php'
~~~
<?php defined('SYSPATH') or die('No direct script access.');
class Component_Test {
  ...
}
~~~

## Example call
~~~
Component::get_instance()->test;
~~~

Enjoy, guys!
