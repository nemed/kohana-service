<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Kohana_BL Business Layer for Kohana
 * @version 0.1
 * @uri https://github.com/turkevich/kohana-service.git
 * @author  Cyril Turkevich <cyril.turkevich@gmai.com>
 */
class Kohana_BL
{
    /**
     * @var string $_services_dir path to services dir.
     */
    private $_services_dir = '';

    /**
     * @var array $_cloud cloud of services.
     */
    protected $_cloud = array();

    /**
     * @var array $_import files for import from $_services_dir
     */
    protected $_import = array();

    /**
     * @var null|Kohana_Service instance for this class.
     */
    private static $_instance = null;

    /**
     * @inheritdoc
     */
    protected function __construct()
    {
        $this->init();
    }

    /**
     * @inheritdoc
     */
    private function __clone()
    {
    }

    /**
     * @inheritdoc
     */
    public function __get($field)
    {
        if (isset($this->_cloud[$field])) {
            return $this->_cloud[$field];
        }
    }

    /**
     * @param null|string service alias
     *
     * @return Kohana_BL|Kohana_Service|null instance for this class or instance of service if exists.
     */
    public static function instance($service = null)
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        if (!is_null($service)) {
            return self::$_instance->{$service};
        }

        return self::$_instance;
    }

    /**
     * Event init.
     */
    public function init()
    {
        $config = Kohana::$config->load('service')->as_array();
        $this->_import = $config['import'];
        $this->_services_dir = $config['services_dir'];
        $this->import();
    }

    /**
     * Import services.
     */
    public function import()
    {
        require_once __DIR__ . DIRECTORY_SEPARATOR . 'Service.php';
        foreach ($this->_import as $alias => $file) {
            if (is_file($path_to_file = $this->_services_dir . DIRECTORY_SEPARATOR . $file['filename'])) {
                require_once $path_to_file;
                $this->_cloud[$alias] = new $file['class']($file['config']);
            }
        }
    }
}