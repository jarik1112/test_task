<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date   2/17/15
 * @time   2:41 PM
 */

namespace Framework\Interfaces;


interface ResponseInterface
{
    /**
     * @param string $view
     * @param array  $renderData
     */
    public function __construct($view, $renderData = array());

    /**
     * Send response to browser
     *
     * @return void
     */
    public function send();

    /**
     * Set response http code
     *
     * @param integer $code
     * @return void
     */
    public function setHttpCode($code);

    /**
     * Return http code
     *
     * @return integer
     */
    public function getHttpCode();

}