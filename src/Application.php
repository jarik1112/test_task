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
        $this->handleSession();
        $router     = $this->ioc->build('router');
        $controller = $router->getController();
        if ($controller !== false) {
            /** @var \Framework\Interfaces\ResponseInterface $response */
            $this->ioc->register('currentController', $controller);
            $controller = $this->ioc->build('currentController');
            $action     = $router->getAction();
            $methods    = get_class_methods($controller);
            if (in_array($action, $methods)) {
                try{
                    $response = $controller->{$action}();
                }catch (\Exception $e){
                    $response = $this->getErrorResponse(500);
                }
            } else {
                $response = $this->getErrorResponse(404);
            }
        }else {
            $response = $this->getErrorResponse(404);
        }
        $response->send();
    }
    protected function handleSession()
    {
        session_start();
        if(!isset($_SESSION['logged_in'])){
            $_SESSION['logged_in'] = false;
        }
        $notLoggedPath = array(
            '/login',
            '/register',
            '/confirm',
            '/confirmation'
        );
        if($_SESSION['logged_in'] === false && !in_array($this->ioc->build('request')->getPath(),$notLoggedPath)){
            $this->ioc->build('response')->redirect('/login');
            exit();
        }
    }
    /**
     * @return \Framework\Interfaces\ResponseInterface
     */
    protected function getErrorResponse($code)
    {
        return $this->ioc->build('errorController')->index($code);
    }

    protected function redirect($to)
    {

    }
}