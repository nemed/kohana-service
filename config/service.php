<?php defined('SYSPATH') or die('No direct script access.');
return array(
    'import' => array(
        'alias' => array(
            'class' => 'Service_Foo',
            'filename' => 'Foo.php',
            'config' => array(
                'param1' => 'bar'
            ),
        ),
    ),
    // If not exist, includes files from APPPATH/classes/Service
    'services_dir' => APPPATH . 'classes' . DIRECTORY_SEPARATOR . 'Service' . DIRECTORY_SEPARATOR
);