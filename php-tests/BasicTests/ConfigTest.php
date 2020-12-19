<?php


use Filter\Interfaces\IFilterEntry;
use kalanis\kw_connect\Configs;
use kalanis\kw_connect\Interfaces\IEntry;
use kalanis\kw_input\Interfaces\IEntry as Input;
use Sorter\Interfaces\ISortEntry;


class ConfigTest extends CommonTestClass
{
    public function testFilterEntry()
    {
        $data = new Configs\FilterEntries();
        $this->assertInstanceOf('\kalanis\kw_connect\Interfaces\IEntries', $data);

        $this->assertEmpty($data->getSource());
        $this->assertEmpty(iterator_to_array($data->getEntries()));

        $data->setSource('different'); // bad source
        $this->assertEmpty($data->getSource());
        $this->assertEmpty(iterator_to_array($data->getEntries()));

        $data->setSource(Input::SOURCE_ENV); // another bad source
        $this->assertEmpty($data->getSource());
        $this->assertEmpty(iterator_to_array($data->getEntries()));

        $data->setSource(Input::SOURCE_CLI);
        $this->assertEquals(Input::SOURCE_CLI, $data->getSource());
        $this->assertEmpty(iterator_to_array($data->getEntries()));
    }

    public function testFilterEntries()
    {
        $data = new Configs\FilterEntries();
        $this->assertEmpty($data->getSource());
        $this->assertEmpty(iterator_to_array($data->getEntries()));

        $data->setSource(Input::SOURCE_CLI);
        $data->addEntry($this->entryFilter1());
        $data->addEntry($this->entryFilter2());
        $array = iterator_to_array($data->getEntries());
        /** @var IEntry[] $array */
        $this->assertNotEmpty($array);

        $entry = reset($array);
        $this->assertEquals('abc', $entry->getKey());
        $this->assertEquals(IFilterEntry::RELATION_EQUAL, $entry->getDefaultLimitation());

        $entry = next($array);
        $this->assertEquals('ghi', $entry->getKey());
        $this->assertEquals(IFilterEntry::RELATION_LESS, $entry->getDefaultLimitation());

        $data->clear();
        $this->assertEmpty(iterator_to_array($data->getEntries()));
    }

    public function testSorterEntry()
    {
        $data = new Configs\SorterEntries();
        $this->assertInstanceOf('\kalanis\kw_connect\Interfaces\IEntries', $data);

        $this->assertEmpty($data->getSource());
        $this->assertEmpty(iterator_to_array($data->getEntries()));

        $data->setSource('different'); // bad source
        $this->assertEmpty($data->getSource());
        $this->assertEmpty(iterator_to_array($data->getEntries()));

        $data->setSource(Input::SOURCE_SERVER); // another bad source
        $this->assertEmpty($data->getSource());
        $this->assertEmpty(iterator_to_array($data->getEntries()));

        $data->setSource(Input::SOURCE_SESSION);
        $this->assertEquals(Input::SOURCE_SESSION, $data->getSource());
        $this->assertEmpty(iterator_to_array($data->getEntries()));
    }

    public function testSorterEntries()
    {
        $data = new Configs\SorterEntries();
        $this->assertEmpty($data->getSource());
        $this->assertEmpty(iterator_to_array($data->getEntries()));

        $data->setSource(Input::SOURCE_GET);
        $data->addEntry($this->entrySorter1());
        $data->addEntry($this->entrySorter3());
        $array = iterator_to_array($data->getEntries());
        /** @var IEntry[] $array */
        $this->assertNotEmpty($array);

        $entry = reset($array);
        $this->assertEquals('adg', $entry->getKey());
        $this->assertEquals(ISortEntry::DIRECTION_ASC, $entry->getDefaultLimitation());

        $entry = next($array);
        $this->assertEquals('knq', $entry->getKey());
        $this->assertEquals(ISortEntry::DIRECTION_DESC, $entry->getDefaultLimitation());

        $data->clear();
        $this->assertEmpty(iterator_to_array($data->getEntries()));
    }

    public function testConfig()
    {
        $data = new Configs\Config($this->entriesFilter1(), $this->entriesSorter1(), $this->entryPager1());
        $this->assertInstanceOf('\kalanis\kw_connect\Interfaces\IEntries', $data->getFilterEntries());
        $this->assertInstanceOf('\kalanis\kw_connect\Interfaces\IEntries', $data->getSorterEntries());
        $this->assertInstanceOf('\kalanis\kw_connect\Interfaces\IEntries', $data->getPagerEntries());
        $this->assertInstanceOf('\kalanis\kw_connect\Interfaces\IPagerEntry', $data->getPagerEntries());
    }
}
