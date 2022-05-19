<?php

namespace kalanis\kw_connect\core\Interfaces;


/**
 * Interface IRow
 * @package kalanis\kw_connect\core\Interfaces
 * Access rows in table
 */
interface IRow
{
    /**
     * @param string|int $property
     * @return mixed
     */
    public function getValue($property);

    /**
     * @param string|int $name
     * @return bool
     */
    public function __isset($name);
}
