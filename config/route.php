<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date   2/17/15
 * @time   1:41 PM
 */

/**
 *  Config for Routing class
 */

return array(
    /** path => array params */
    '/'             => array('controller' => 'Framework\Controllers\IndexController'),
    '/login'        => array('controller' => 'Framework\Controllers\LoginController'),
    '/register'     => array('controller' => 'Framework\Controllers\RegisterController'),
    '/confirmation' => array(
        'controller' => 'Framework\Controllers\RegisterController',
        'action'     => 'confirmationSent'
    ),
);