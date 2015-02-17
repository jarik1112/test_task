<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date   2/17/15
 * @time   2:42 PM
 */

namespace Framework;


use Framework\Interfaces\ConstructorInjectableInterface;
use Framework\Interfaces\IocContainerInterface;
use Framework\Interfaces\ResponseInterface;

class Response implements ResponseInterface, ConstructorInjectableInterface
{
    /**
     * Path to view file
     *
     * @var string
     */
    protected $view;

    /**
     * Data to view
     *
     * @var array
     */
    protected $data = array();

    /**
     * Path to view folder
     *
     * @var string
     */
    protected $viewFolder;

    /**
     * Path to layout file
     *
     * @var string
     */
    protected $layout;
    /**
     * @var IocContainerInterface
     */
    protected $ioc;

    public function __construct(IocContainerInterface $container)
    {
        $this->ioc = $container;
        $config = $this->ioc->build('viewConfig');
        $this->viewFolder = $config['viewDir'];
        $this->layout = $config['layout'];
    }


    /**
     * Http code
     *
     * @var int
     */
    protected $code = 200;

    public function send()
    {
        $this->data['content'] = $this->renderView($this->resolveViewPath($this->view), $this->data);
        $view = $this->renderView($this->resolveViewPath($this->layout),$this->data);
        $this->sendCode();
        echo $view;
    }

    protected function renderView($view, $data)
    {
        extract($data);
        ob_start();
        include $view;
        $content  =  ob_get_contents();
        ob_end_clean();
        return $content;
    }

    protected function resolveViewPath($path)
    {
        $result = $this->viewFolder.'/'.$path;
        if(!file_exists($result)){
            throw new \Exception('View "'.$result.'" not found');
        }
        return $result;
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

    /**
     * Send response code to client
     */
    protected function sendCode()
    {
        $codeText = array(
            404 => 'Not Found',
            200 => 'Ok',
            302 => 'Moved Temporarily '
        );
        header("HTTP/1.0 {$this->code} {$codeText[$this->code]}");
    }

    /**
     * Set data to view
     *
     * @param array $data
     * @return mixed
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * Set view
     *
     * @param string $view
     * @return mixed
     */
    public function setView($view)
    {
        $this->view = $view;
    }

    public function redirect($path)
    {
        $this->code = 302;
        $this->sendCode();
        header('Location: '.$path);
    }
}
