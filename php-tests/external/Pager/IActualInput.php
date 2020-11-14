<?php

namespace Pager;


/**
 * Interface IActualPage
 * @package Pager
 * Info from inputs on which page we are
 */
interface IActualInput
{
    /**
     * Returns current page number
     * @return int
     */
    public function getActualPage(): int;
}
