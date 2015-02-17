<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date 2/17/15
 * @time 2:43 PM
 */

namespace Framework\Interfaces;


interface RouterInterface extends ConstructorInjectableInterface
{
    /**
     * Get controller name
     * on error return false
     * @return string|bool
     */
    public function getController();

    /**
     * Get action to call
     * @return string
     */
    public function getAction();
}