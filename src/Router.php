<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date   2/17/15
 * @time   2:25 PM
 */

namespace Framework;


use Framework\Interfaces\RouterInterface;
use Framework\Interfaces\IocContainerInterface;

class Router implements RouterInterface
{
    /**
     * @var  IocContainerInterface
     */
    private $ioc;

    /**
     * Configuration params
     *
     * @var array
     */
    protected $routes = array();

    /**
     * @var Request
     */
    protected $request;

    public function __construct(IocContainerInterface $container)
    {
        $this->ioc     = $container;
        $this->routes  = $this->ioc->build('routeConfig');
        $this->request = $this->ioc->build('request');
    }

    public function getController()
    {
        $result = false;
        $params = $this->getParamsByPath();
        if ($params !== false && !empty($params['controller'])) {
            $result = $params['controller'];
        }
        return $result;
    }

    /**
     * Get action to call
     *
     * @return string
     */
    public function getAction()
    {
        $result = 'index';
        $params = $this->getParamsByPath();
        if ($params !== false && !empty($params['action'])) {
            $result = $params['action'];
        }
        return $result;
    }

    /**
     * @return bool
     */
    public function getParamsByPath()
    {
        $path   = $this->request->getPath();
        $result = false;
        if (isset($this->routes[$path])) {
            $result = $this->routes[$path];
        }
        return $result;
    }


}