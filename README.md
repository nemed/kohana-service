# Business Layer for Kohana 3.3

## Installation

Edit your bootstrap file `APPPATH/bootstrap.php` and enable component module:

~~~
Kohana::modules(array(
  // Some modules
  'service' => MODPATH .'service',
  // Some other modules
  ));
~~~

Then copy `MODPATH/service/config/service.php` to `APPPATH/config/service.php`.
~~~
<?php defined('SYSPATH') or die('No direct script access.');
return array(
    'import' => array(
        'alias' => array(
            'class' => 'Service_Foo',//Work with namespaces. For example: app/classes/services/Foo
            'filename' => 'Foo.php',
            'config' => array(
                'param1' => 'bar',
                ...
            ),
        ),
    ),
    // If not exist, includes files from APPPATH/classes/Service
    'services_dir' => 'path/to/services'
);
~~~
Well done!

## Example class
APPPATH . 'classes/Service/Foo.php'
~~~
<?php defined('SYSPATH') or die('No direct script access.');
class Service_Foo extends Service {
  
  public function foo_param($id){
     //returns bar from config
     return $this->config_param($id)
  }
  ...
}
~~~

## Example call
~~~
BL::instance()->foo;
~~~
##### or
~~~
BL::instance('foo');
~~~

Enjoy, guys!