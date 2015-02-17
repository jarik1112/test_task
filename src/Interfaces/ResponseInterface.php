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

    /**
     * Set data to view
     * @param array $data
     * @return mixed
     */
    public function setData(array $data);

    /**
     * @param string $view
     * @return mixed
     */
    public function setView($view);
}