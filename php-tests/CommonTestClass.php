<?php

use kalanis\kw_connect\Configs\AEntries;
use kalanis\kw_connect\Configs\Config;
use kalanis\kw_connect\Configs\FilterEntries;
use kalanis\kw_connect\Configs\SorterEntries;
use kalanis\kw_connect\Entries\FilterEntry;
use kalanis\kw_connect\Entries\SorterEntry;
use kalanis\kw_connect\Entries\PagerEntry;
use kalanis\kw_filter\Interfaces\IFilterEntry;
use kalanis\kw_input\Interfaces\IEntry as Input;
use PHPUnit\Framework\TestCase;
use kalanis\kw_sorter\Interfaces\ISortEntry;


/**
 * Class CommonTestClass
 * The structure for mocking and configuration seems so complicated, but it's necessary to let it be totally idiot-proof
 */
class CommonTestClass extends TestCase
{
    protected function entryFilter1(): FilterEntry
    {
        return (new FilterEntry())->setEntry('abc', 'def', IFilterEntry::RELATION_EQUAL);
    }

    protected function entryFilter2(): FilterEntry
    {
        return (new FilterEntry())->setEntry('ghi', 'jkl', IFilterEntry::RELATION_LESS);
    }

    protected function entryFilter3(): FilterEntry
    {
        return (new FilterEntry())->setEntry('mno', 'pqr', IFilterEntry::RELATION_MORE);
    }

    protected function entryFilter4(): FilterEntry
    {
        return (new FilterEntry())->setEntry('stu', 'vwx', IFilterEntry::RELATION_MORE_EQ);
    }

    protected function entrySorter1(): SorterEntry
    {
        return (new SorterEntry())->setEntry('adg', 'jmp', ISortEntry::DIRECTION_ASC);
    }

    protected function entrySorter2(): SorterEntry
    {
        return (new SorterEntry())->setEntry('svy', 'beh', ISortEntry::DIRECTION_ASC);
    }

    protected function entrySorter3(): SorterEntry
    {
        return (new SorterEntry())->setEntry('knq', 'tw0', ISortEntry::DIRECTION_DESC);
    }

    protected function entrySorter4(): SorterEntry
    {
        return (new SorterEntry())->setEntry('cfi', 'lor', ISortEntry::DIRECTION_DESC);
    }

    protected function entryPager1(): PagerEntry
    {
        return (new PagerEntry())->setEntry(Input::SOURCE_GET,'amp', 'hkn');
    }

    protected function entryPager2(): PagerEntry
    {
        return (new PagerEntry())->setEntry(Input::SOURCE_POST, 'tmz', 'bku');
    }

    protected function entriesFilter1(): AEntries
    {
        return (new FilterEntries())->addEntry($this->entryFilter1())->addEntry($this->entryFilter3())->setSource(Input::SOURCE_GET);
    }

    protected function entriesFilter2(): AEntries
    {
        return (new FilterEntries())->addEntry($this->entryFilter2())->addEntry($this->entryFilter4())->setSource(Input::SOURCE_POST);
    }

    protected function entriesSorter1(): AEntries
    {
        return (new SorterEntries())->addEntry($this->entrySorter1())->addEntry($this->entrySorter2())->setSource(Input::SOURCE_GET);
    }

    protected function entriesSorter2(): AEntries
    {
        return (new SorterEntries())->addEntry($this->entrySorter3())->addEntry($this->entrySorter4())->setSource(Input::SOURCE_POST);
    }

    protected function config1(): Config
    {
        return new Config($this->entriesFilter1(), $this->entriesSorter1(), $this->entryPager1());
    }

    protected function config2(): Config
    {
        return new Config($this->entriesFilter2(), $this->entriesSorter2(), $this->entryPager2());
    }

    protected function iterator_to_dict(Traversable $iter): array
    {
        $result = [];
        foreach ($iter as $item) {
            $result[$item->getKey()] = $item;
        }
        return $result;
    }
}
