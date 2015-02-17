<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date 2/17/15
 * @time 3:35 PM
 */

namespace Framework\Controllers;


use Framework\BaseController;
use Framework\Response;

class LoginController extends BaseController
{
    public function index()
    {
        /** @var \Framework\Request $request */
        $request = $this->ioc->build('request');

        /** @var  \Framework\Response $response */
        $response = $this->ioc->build('response');
        $response->setView('login.php',array());
        return $response;
    }
}