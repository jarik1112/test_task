<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date 2/17/15
 * @time 12:49 PM
 */


require_once __DIR__.'/src/autoload.php';

$container = \Framework\IocContainer::getInstance();

$container->register('routeConfig',include __DIR__.'/config/route.php');
$container->register('router','Framework\Router');
$container->register('app','Framework\Application');
$container->register('request','Framework\Request');
$container->register('response','Framework\Response');
$container->register('errorController','Framework\Controllers\ErrorController');
$container->build('app')->run();