<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date 2/17/15
 * @time 12:49 PM
 */

define('ROOT_DIR',realpath(__DIR__));
define('VIEW_DIR',ROOT_DIR.'/view');

require_once __DIR__.'/src/autoload.php';
require_once __DIR__.'/vendor/autoload.php';

$container = \Framework\IocContainer::getInstance();

$container->register('routeConfig',include ROOT_DIR.'/config/route.php');
$container->register('router','Framework\Router');
$container->register('app','Framework\Application');
$container->register('request','Framework\Request');
$container->register('response','Framework\Response');
$container->register('errorController','Framework\Controllers\ErrorController');
$container->register('viewConfig',array(
    'layout'=>'/layout.php',
    'viewDir'=>VIEW_DIR
));
$container->register('dbConfig',include ROOT_DIR.'/config/db.php' );
$container->register('userStorage','Framework\DbUserStorage');
//$container->register('userStorage','Framework\XmlUserStorage');
$container->register('emailConfig',include ROOT_DIR.'/config/email.php' );
$container->register('mailer','Framework\MailComponent');
$container->build('app')->run();
