<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date   2/17/15
 * @time   2:57 PM
 */

namespace Framework;


use Framework\Interfaces\ControllerInterface;
use Framework\Interfaces\IocContainerInterface;

class BaseController implements ControllerInterface
{
    protected $ioc;

    public function __construct(IocContainerInterface $container)
    {
        $this->ioc = $container;

    }

}