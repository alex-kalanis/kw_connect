<?php

namespace Pager;


/**
 * Interface ISettings
 * @package Pager
 * Default settings for paging through records
 */
interface ISettings
{
    /**
     * Returns maximum available results for paging on following objects
     * @return int
     */
    public function getMaxResults(): int;

    /**
     * Returns limit of items on one page
     * @return int
     */
    public function getLimit(): int;
}
