<?php

use Filter\Interfaces\IFilterEntry;
use kalanis\kw_connect\Entries;
use kalanis\kw_input\Interfaces\IEntry;
use Sorter\Interfaces\ISortEntry;


class EntryTest extends CommonTestClass
{
    public function testFilterEntry()
    {
        $data = new Entries\FilterEntry();
        $this->assertInstanceOf('\kalanis\kw_connect\Interfaces\IEntry', $data);

        $this->assertEmpty($data->getKey());
        $this->assertEmpty($data->getLimitationKey());
        $this->assertEmpty($data->getDefaultLimitation());

        $data->setEntry('different', 'another', 'wuz');
        $this->assertEquals('different', $data->getKey());
        $this->assertEquals('another', $data->getLimitationKey());
        $this->assertEmpty($data->getDefaultLimitation());

        $data->setEntry('ugg', 'huu', IFilterEntry::RELATION_MORE);
        $this->assertEquals('ugg', $data->getKey());
        $this->assertEquals('huu', $data->getLimitationKey());
        $this->assertEquals(IFilterEntry::RELATION_MORE, $data->getDefaultLimitation());
    }

    public function testSorterEntry()
    {
        $data = new Entries\SorterEntry();
        $this->assertInstanceOf('\kalanis\kw_connect\Interfaces\IEntry', $data);

        $this->assertEmpty($data->getKey());
        $this->assertEmpty($data->getLimitationKey());
        $this->assertEmpty($data->getDefaultLimitation());

        $data->setEntry('different', 'another', 'wuz');
        $this->assertEquals('different', $data->getKey());
        $this->assertEquals('another', $data->getLimitationKey());
        $this->assertEmpty($data->getDefaultLimitation());

        $data->setEntry('ugg', 'huu', ISortEntry::DIRECTION_DESC);
        $this->assertEquals('ugg', $data->getKey());
        $this->assertEquals('huu', $data->getLimitationKey());
        $this->assertEquals(ISortEntry::DIRECTION_DESC, $data->getDefaultLimitation());
    }

    public function testPagerEntry()
    {
        $data = new Entries\PagerEntry();
        $this->assertInstanceOf('\kalanis\kw_connect\Interfaces\IEntry', $data);
        $this->assertInstanceOf('\kalanis\kw_connect\Interfaces\IEntries', $data);

        $this->assertEmpty($data->getSource());
        $this->assertEmpty($data->getKey());
        $this->assertEmpty($data->getLimitationKey());
        $this->assertEmpty($data->getDefaultLimitation());
        $this->assertEmpty(iterator_to_array($data->getEntries()));

        $data->setEntry('different', 'foz', 'wuz');
        $this->assertEmpty($data->getSource());
        $this->assertEquals('foz', $data->getKey());
        $this->assertEquals('wuz', $data->getLimitationKey());
        $this->assertEmpty($data->getDefaultLimitation());
        $this->assertEmpty(iterator_to_array($data->getEntries()));

        $data->setEntry(IEntry::SOURCE_GET, 'ugg', 'huu');
        $this->assertEquals(IEntry::SOURCE_GET, $data->getSource());
        $this->assertEquals('ugg', $data->getKey());
        $this->assertEquals('huu', $data->getLimitationKey());
        $this->assertEmpty($data->getDefaultLimitation());
        $this->assertEmpty(iterator_to_array($data->getEntries()));
    }
}
