<?php

namespace kalanis\kw_connect\Configs;


use kalanis\kw_connect\Entries\FilterEntry;
use kalanis\kw_connect\Interfaces\IFilterEntries;


/**
 * Class FilterEntries
 * @package kalanis\kw_connect\Configs
 * Simple entry of filter config
 */
class FilterEntries extends AEntries implements IFilterEntries
{
    public function addEntry(FilterEntry $entry): self
    {
        $this->entries[] = $entry;
        return $this;
    }
}
