<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date   2/17/15
 * @time   1:13 PM
 */

namespace Framework\Interfaces;


interface IocContainerInterface
{
    /**
     * Register some data by name
     *
     * @param mixed      $name
     * @param null|mixed $data
     * @throws \Exception when $name already registered
     * @return mixed
     */
    public function register($name, $data);

    /**
     * Unregister registered component
     *
     * @param $name
     * @return bool
     */
    public function unregister($name);

    /**
     *
     * Create and return data by name
     *
     * @param $name
     * @return mixed
     */
    public function build($name);


    /**
     * Get instance of ioc container
     *
     * @return self
     */
    public static function getInstance();
}