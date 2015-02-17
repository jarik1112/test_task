<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date 2/17/15
 * @time 2:56 PM
 */

namespace Framework\Controllers;


use Framework\BaseController;
use Framework\Response;

/**
 * Class ErrorController
 *
 * @package Framework\Controllers
 */
class ErrorController extends BaseController
{
    /**
     * Index action
     * @return Response
     */
    public function index($code)
    {
        /** @var \Framework\Response $response */
        $response = $this->ioc->build('response');
        $response->setView('error.php');
        $response->setHttpCode(404);
        return $response;
    }
}