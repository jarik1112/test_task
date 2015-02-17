<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date 2/17/15
 * @time 1:23 PM
 */

namespace Framework\Interfaces;

/**
 * Interface ApplicationInterface
 *
 * FrontController pattern
 * @package Framework\Interfaces
 */

interface ApplicationInterface
{

    /**
     * Init and run application
     * @return void
     */
    public function run();
}