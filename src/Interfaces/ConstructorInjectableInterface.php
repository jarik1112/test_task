<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date 2/17/15
 * @time 2:05 PM
 */

namespace Framework\Interfaces;


interface ConstructorInjectableInterface
{
    public function __construct(IocContainerInterface $container);
}