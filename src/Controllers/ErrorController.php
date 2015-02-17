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
    public function actionIndex()
    {
        $response = new Response('Error');
        $response->setHttpCode(404);
        return $response;
    }
}