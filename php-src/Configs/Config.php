<?php

namespace kalanis\kw_connect\Configs;


use kalanis\kw_connect\Entries\IPagerEntry;


/**
 * Class Config
 * @package kalanis\kw_connect\Configs
 * Whole configuration package
 */
class Config implements IConfig
{
    /** @var IFilterEntries */
    protected $filterEntries = null;
    /** @var ISorterEntries */
    protected $sorterEntries = null;
    /** @var IPagerEntry */
    protected $pagerEntry = null;

    public function __construct(IFilterEntries $filterEntries, ISorterEntries $sorterEntries, IPagerEntry $pagerEntry)
    {
        $this->filterEntries = $filterEntries;
        $this->sorterEntries = $sorterEntries;
        $this->pagerEntry = $pagerEntry;
    }

    public function getFilterEntries(): IFilterEntries
    {
        return $this->filterEntries;
    }

    public function getSorterEntries(): ISorterEntries
    {
        return $this->sorterEntries;
    }

    public function getPagerEntries(): IPagerEntry
    {
        return $this->pagerEntry;
    }
}
