<?php

/**
 * Class Kohana_Component
 * @author Cyril Turkevich
 */
class Kohana_Component
{
    private $_components_dir = '';
    protected $_singletons = array();
    protected $_import = array();
    private static $_instance = null;

    /**
     * @author Cyril Turkevich
     */
    protected function __construct()
    {
        $this->init();
    }

    /**
     * @author Cyril Turkevich
     */
    private function __clone() { }

    /**
     * @inheritdoc
     * @author Cyril Turkevich
     */
    public function __get($field)
    {
        if (isset($this->_singletons[$field])) {
            return $this->_singletons[$field];
        }
    }

    /**
     * @return Kohana_Component|null
     */
    public static function get_instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * @author Cyril Turkevich
     */
    public function init()
    {
        $config = Kohana::$config->load('component')->as_array();
        $this->_import = $config['import'];
        $this->_components_dir = isset($config['components_dir']) ? $config['components_dir'] : APPPATH . 'classes' . DIRECTORY_SEPARATOR . 'Component' . DIRECTORY_SEPARATOR;
        $this->import();
    }

    /**
     * @author Cyril Turkevich
     */
    public function import()
    {
        foreach ($this->_import as $file) {
            if (is_file($path_to_file = $this->_components_dir . DIRECTORY_SEPARATOR . $file['filename'])) {
                require_once $path_to_file;

                if (!isset($this->_singletons[$file['alias']])) {
                    $this->_singletons[$file['alias']] = new $file['class']();
                }
            }
        }
    }


}