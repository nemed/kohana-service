<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Class Kohana_Service
 * Base class for services.
 * @version 0.1
 * @author Cyril Turkevich
 */
abstract class Kohana_Service
{
    /**
     * @var array $_config service config.
     */
    protected $_config = array();

    /**
     * @param array $config service config.
     */
    final public function __construct(array $config)
    {
        $this->_config = $config;
        $this->init();
    }

    /**
     * Event init.
     */
    protected function init(){}

    /**
     * Returns config param formed in apppath/config/service.php.
     * @param string $id key of config.
     * @return mixed config param formed in apppath/config/service.php
     */
    protected function config_param($id)
    {
        return isset($this->_config[$id]) ? $this->_config[$id] : null;
    }
}