<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date 2/17/15
 * @time 1:12 PM
 */

namespace Framework;
use Framework\Interfaces\IocContainerInterface;

/**
 * Class IocContainer
 *
 * @package Framework
 */
class IocContainer implements IocContainerInterface
{
    /**
     *
     * @var null|self
     */
    private static $instance = null;

    private $registered = array();

    public function register($name, $data)
    {
        if(!isset($this->registered[$name])){
            $this->registered[$name] = $data;
        }else{
            throw new \Exception('Ioc error. Param with name "'.$name.'" already registered');
        }
    }

    public function build($name)
    {
        $result = null;
        if(!isset($this->registered[$name])){
            throw new \Exception('Ioc error. Param with name "'.$name.'" is not registered');
        }else{
            /** If registered is name of class*/
            if(is_string($this->registered[$name]) && class_exists($this->registered[$name])){
                /** And it has ConstructorInjectableInterface  */
                if(is_subclass_of($this->registered[$name],'Framework\Interfaces\ConstructorInjectableInterface')){
                    $result = new $this->registered[$name](self::getInstance());
                }else{
                    $result = new $this->registered[$name];
                }
                $this->registered[$name] = $result;
            }
            elseif(is_object($this->registered[$name]) || is_array($this->registered[$name])){
                $result = $this->registered[$name];
            }
        }
        return $result;
    }

    public function unregister($name)
    {
        if(isset($this->registered[$name])){
            unset($this->registered[$name]);
            return true;
        }
        return false;
    }

    private function __construct() { }

    /**
     * Get instance of ioc container
     *
     * @return self
     */
    public static function getInstance()
    {
        if(is_null(self::$instance)){
            self::$instance = new self;
        }

        return self::$instance;
    }
}