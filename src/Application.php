<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date   2/17/15
 * @time   1:23 PM
 */

namespace Framework;

use Framework\Interfaces\ApplicationInterface;
use Framework\Interfaces\ConstructorInjectableInterface;
use Framework\Interfaces\IocContainerInterface;

class Application implements ApplicationInterface, ConstructorInjectableInterface
{
    /**
     * @var IocContainerInterface
     */
    private $ioc;

    public function __construct(IocContainerInterface $container)
    {
        $this->ioc = $container;
    }

    /**
     * Init and run application
     *
     * @return void
     */
    public function run()
    {
        $router     = $this->ioc->build('router');
        $controller = $router->getController();

        if ($controller !== false) {
            /** @var \Framework\Interfaces\ResponseInterface $response */
            $this->ioc->register('currentController', $controller);
            $controller = $this->ioc->build('currentController');
            $action     = $router->getAction();
            $methods    = get_class_methods($controller);
            if (in_array($action, $methods)) {
                $response = $controller->{$action}();
            } else {
                $response = $this->getErrorResponse();
            }
        }elseif($router->isRedirect()){

        } else {
            $response = $this->getErrorResponse();
        }
        $response->send();
    }

    /**
     * @return \Framework\Interfaces\ResponseInterface
     */
    protected function getErrorResponse()
    {
        return $this->ioc->build('errorController')->actionIndex();
    }

    protected function redirect($to)
    {

    }
}