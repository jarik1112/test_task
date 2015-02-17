<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date   2/17/15
 * @time   2:20 PM
 */

namespace Framework;

/**
 * Class Request
 *
 * @package Framework
 */
class Request
{
    public function getPath()
    {
        return !empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
    }

    /**
     * Get POST param
     *
     * @param string $name
     * @param mixed  $default default value is null
     * @return mixed
     */
    public function getPost($name, $default = null)
    {
        return isset($_POST[$name]) ? $_POST[$name] : $default;
    }

    /**
     * Get GET param
     *
     * @param  string    $name
     * @param null|mixed $default
     * @return mixed
     */
    public function getParam($name, $default = null)
    {
        return isset($_GET[$name]) ? $_GET[$name] : $default;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $_SERVER['HTTP_HOST'];
    }


}