<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date   2/17/15
 * @time   2:42 PM
 */

namespace Framework;


use Framework\Interfaces\ResponseInterface;

class Response implements ResponseInterface
{
    protected $view;
    protected $data = array();

    public function __construct($view, $renderData = array())
    {
        $this->view = $view;
        $this->data = $renderData;
    }

    /**
     * Http code
     *
     * @var int
     */
    protected $code = 200;

    public function send()
    {
        extract($this->data);
        ob_start();
        if (file_exists($this->view)) {
            include $this->view;
        } else {
            echo $this->view;
        }
        $response = ob_get_contents();
        ob_end_clean();
        $this->_sendCode();
        echo $response;
    }

    /**
     * Set response http code
     *
     * @param integer $code
     * @return void
     */
    public function setHttpCode($code)
    {
        $this->code = $code;
    }

    /**
     * Return http code
     *
     * @return integer
     */
    public function getHttpCode()
    {
        return $this->code;
    }

    protected function _sendCode()
    {
        $codeText = array(
            404 => 'Not Found',
            200 => 'Ok',
            302 => 'Moved Temporarily '
        );
        header("HTTP/1.0 {$this->code} {$codeText[$this->code]}");
    }

}
