<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date 2/17/15
 * @time 1:13 PM
 */

namespace Framework\Interfaces;


interface IocContainerInterface
{
    /**
     * Register some data by name
     * @param mixed $name
     * @param null|mixed $data
     * @throws \Exception when $name already registered
     * @return mixed
     */
    public static function register($name, $data);

    /**
     *
     * Create and return data by name
     * @param $name
     * @return mixed
     */
    public static function build($name);


    /**
     * Get instance of ioc container
     * @return self
     */
    public static function getInstance();
}