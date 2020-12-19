<?php

namespace kalanis\kw_connect\Configs;


use kalanis\kw_connect\Entries\SorterEntry;
use kalanis\kw_connect\Interfaces\ISorterEntries;


/**
 * Class SorterEntries
 * @package kalanis\kw_connect\Configs
 * Simple entry of sorter config
 */
class SorterEntries extends AEntries implements ISorterEntries
{
    public function addEntry(SorterEntry $entry): self
    {
        $this->entries[] = $entry;
        return $this;
    }
}
