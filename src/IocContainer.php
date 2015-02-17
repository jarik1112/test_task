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

    private static $registered = array();

    public static function register($name, $data)
    {
        if(!isset(self::$registered[$name])){
            self::$registered[$name] = $data;
        }else{
            throw new \Exception('Ioc error. Param with name "'.$name.'" already registered');
        }
    }

    public static function build($name)
    {
        $result = null;
        if(!isset(self::$registered[$name])){
            throw new \Exception('Ioc error. Param with name "'.$name.'" is not registered');
        }else{
            /** If registered is name of class*/
            if(is_string(self::$registered[$name]) && class_exists(self::$registered[$name])){

                /** And it has ConstructorInjectableInterface  */
                if(is_subclass_of(self::$registered[$name],'Framework\Interfaces\ConstructorInjectableInterface')){
                    $result = new self::$registered[$name](self::getInstance());
                }else{
                    $result = new self::$registered[$name];
                }
            }
            elseif(is_object(self::$registered[$name]) || is_array(self::$registered[$name])){
                $result = self::$registered[$name];
            }
        }
        return $result;
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