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
        return !empty($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
    }
}