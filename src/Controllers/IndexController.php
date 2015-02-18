<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date 2/17/15
 * @time 8:49 PM
 */

namespace Framework\Controllers;


use Framework\BaseController;

class IndexController extends BaseController
{
    public function index()
    {
        $response = $this->ioc->build('response');
        $response->setView('index.php',array());
        return $response;
    }
}