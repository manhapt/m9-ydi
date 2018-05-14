<?php

namespace AppBundle\Entity;

abstract class AbstractDecorator
{
    public function __call($method, $args)
    {
        if (!method_exists($this, $method)) {
            return call_user_func_array(array($this->getBaseObject(), $method), $args);
        }
    }

    abstract protected function getBaseObject();
}