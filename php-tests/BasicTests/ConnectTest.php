<?php

use kalanis\kw_connect\Connect;
use kalanis\kw_input\Entries\IEntry as InputEntry;
use kalanis\kw_input\IInputs;
use Filter\IFilter;
use Filter\IFilterEntry;
use Pager\IPager;
use Sorter\ISorter;
use Sorter\ISortEntry;


class ConnectTest extends CommonTestClass
{
    /**
     * @throws \kalanis\kw_connect\ConnectException
     */
    public function testBasic()
    {
        $connect = new Connect(new MockFilter(), new MockSorter(), new MockPager());
        $this->assertInstanceOf('\Filter\IFilter', $connect->getFilter());
        $this->assertInstanceOf('\Sorter\ISorter', $connect->getSorter());
        $this->assertInstanceOf('\Pager\IPager', $connect->getPager());

        $connect->setInputs((new MockInputs())->setSource());

        // one definition
        $connect->setConfig($this->config1());
        $connect->process();

        $filters = $this->iterator_to_dict($connect->getFilter()->getEntries());
        /** @var IFilterEntry[] $filters*/
        $this->assertEquals(2, count($filters));
        $this->assertEquals('poiu', $filters['abc']->getValue());
        $this->assertEquals('ztre', $filters['abc']->getRelation());
        $this->assertEquals('jhgf', $filters['mno']->getValue());
        $this->assertEquals(IFilterEntry::RELATION_MORE, $filters['mno']->getRelation());

        /** @var ISortEntry[] $sorters*/
        $sorters = $this->iterator_to_dict($connect->getSorter()->getEntries());
        $this->assertEquals(2, count($sorters));
        $this->assertEquals(ISortEntry::DIRECTION_ASC, $sorters['adg']->getDirection());
        $this->assertEquals('iuzt', $sorters['svy']->getDirection());

        $this->assertEquals(11, $connect->getPager()->getActualPage());
        $this->assertEquals(25, $connect->getPager()->getLimit());

        // another definition, no need to change source
        $connect->setConfig($this->config2());
        $connect->process();

        $filters = $this->iterator_to_dict($connect->getFilter()->getEntries());
        /** @var IFilterEntry[] $filters*/
        $this->assertEquals(2, count($filters));
        $this->assertEquals('tzui', $filters['ghi']->getValue());
        $this->assertEquals(IFilterEntry::RELATION_LESS, $filters['ghi']->getRelation());
        $this->assertEquals('dfgh', $filters['stu']->getValue());
        $this->assertEquals('jkly', $filters['stu']->getRelation());

        /** @var ISortEntry[] $sorters*/
        $sorters = $this->iterator_to_dict($connect->getSorter()->getEntries());
        $this->assertEquals(2, count($sorters));
        $this->assertEquals(ISortEntry::DIRECTION_ASC, $sorters['knq']->getDirection());
        $this->assertEquals(ISortEntry::DIRECTION_DESC, $sorters['cfi']->getDirection());

        $this->assertEquals(0, $connect->getPager()->getActualPage());
        $this->assertEquals(25, $connect->getPager()->getLimit());
    }

    /**
     * @expectedException \kalanis\kw_connect\ConnectException
     */
    public function testNoConfig()
    {
        $connect = new Connect(new MockFilter(), new MockSorter(), new MockPager());
        $connect->setInputs(new MockInputs());
        $connect->process();
    }

    /**
     * @expectedException \kalanis\kw_connect\ConnectException
     */
    public function testNoInputs()
    {
        $connect = new Connect(new MockFilter(), new MockSorter(), new MockPager());
        $connect->setConfig($this->config1());
        $connect->process();
    }
}


class MockFilter implements IFilter
{
    protected $mockFilters = [];
    protected $mockKey = '';
    protected $mockValue = '';
    protected $mockRelation = '';

    public function addFilter(IFilterEntry $filter): IFilter
    {
        $this->mockFilters[$filter->getKey()] = $filter;
        return $this;
    }

    public function remove(string $filterKey): IFilter
    {
        if (isset($this->mockFilters[$filterKey])) {
            unset($this->mockFilters[$filterKey]);
        }
        return $this;
    }

    public function clear(): IFilter
    {
        $this->mockFilters = [];
        return $this;
    }

    public function getDefaultItem(): IFilterEntry
    {
        return clone $this;
    }

    public function setKey(string $key): IFilterEntry
    {
        $this->mockKey = $key;
        return $this;
    }

    public function getKey(): string
    {
        return $this->mockKey;
    }

    public function setValue($value): IFilterEntry
    {
        $this->mockValue = $value;
        return $this;
    }

    public function getValue()
    {
        return $this->mockValue;
    }

    public function setRelation(string $relation): IFilterEntry
    {
        $this->mockRelation = $relation;
        return $this;
    }

    public function getRelation(): string
    {
        return $this->mockRelation;
    }

    public function getEntries(): Traversable
    {
        yield from $this->mockFilters;
    }
}


class MockSorter implements ISorter
{
    protected $mockSorters = [];

    public function add(ISortEntry $filter): ISorter
    {
        $this->mockSorters[$filter->getKey()] = $filter;
        return $this;
    }

    public function remove(string $filterKey): ISorter
    {
        if (isset($this->mockSorters[$filterKey])) {
            unset($this->mockSorters[$filterKey]);
        }
        return $this;
    }

    public function clear(): ISorter
    {
        $this->mockSorters = [];
        return $this;
    }

    public function getDefaultItem(): ISortEntry
    {
        return new MockSortEntry();
    }

    public function getEntries(): Traversable
    {
        yield from $this->mockSorters;
    }
}


class MockSortEntry implements ISortEntry
{
    protected $mockKey = '';
    protected $mockDirection = '';

    public function setKey(string $key): ISortEntry
    {
        $this->mockKey = $key;
        return $this;
    }

    public function getKey(): string
    {
        return $this->mockKey;
    }

    public function setDirection(string $direction): ISortEntry
    {
        $this->mockDirection = $direction;
        return $this;
    }

    public function getDirection(): string
    {
        return $this->mockDirection;
    }
}


class MockPager implements IPager
{
    protected $mockMaxResults = 0;
    protected $mockActualPage = 0;
    protected $mockLimit = 0;

    public function setMaxResults(int $maxResults): IPager
    {
        $this->mockMaxResults = $maxResults;
        return $this;
    }

    public function getMaxResults(): int
    {
        return $this->mockMaxResults;
    }

    public function setActualPage(int $page): IPager
    {
        $this->mockActualPage = $page;
        return $this;
    }

    public function getActualPage(): int
    {
        return $this->mockActualPage;
    }

    public function setLimit(int $limit): IPager
    {
        $this->mockLimit = $limit;
        return $this;
    }

    public function getLimit(): int
    {
        return $this->mockLimit;
    }

    public function getOffset(): int
    {
        return 0;
    }

    public function getPagesCount(): int
    {
        return 0;
    }

    public function pageExists(int $i): bool
    {
        return false;
    }
}


class MockInputs implements IInputs
{
    protected $mockData = [];

    public function setSource($source = null): IInputs
    {
        // load mock data
        $this->mockData = [
            InputEntry::SOURCE_GET => [
                // filter
                'abc' => 'poiu', // -c1e1f1
                'def' => 'ztre', //lim -c1e1f1
                'ghi' => 'wqlk',
                'jkl' => IFilterEntry::RELATION_EQUAL, //lim
                'mno' => 'jhgf', // -c1e1f3
                /// pqr - lim -c1e1f3
                'stu' => 'dsam',
                // sorter
                'adg' => 'nbvc', // -c1e1s1
                // jmp - lim -c1e1s1
                'svy' => 'xypo', // -c1e1s2
                'beh' => 'iuzt', //lim -c1e1s2
                'knq' => 'rewq',
                'cfi' => 'lkjh',
                'lor' => ISortEntry::DIRECTION_DESC, //lim
                // pager
                'amp' => 11, // -c1p1
                'hkn' => 25, //lim -c1p1
                'tmz' => 3,
            ],
            InputEntry::SOURCE_POST => [
                // filter
                'abc' => 'qwer',
                'ghi' => 'tzui', // -c2e2f2
                /// jkl - lim -c2e2f2
                'mno' => 'opas',
                'pqr' => IFilterEntry::RELATION_EQUAL, //lim
                'stu' => 'dfgh', // -c2e2f4
                'vwx' => 'jkly', //lim -c2e2f4
                // sorter
                'adg' => 'xcvb',
                'jmp' => 'nmqw', //lim
                'svy' => 'ertz',
                'knq' => 'uiop', // -c2e2s3
                'tw0' => ISortEntry::DIRECTION_ASC, //lim -c2e2s3
                'cfi' => 'asdf', // -c2e2s4
                // lor - lim -c2e2s4
                // pager
                'amp' => 'ghjk',
                'tmz' => 'lyxc', // -c2p2
                // bku - lim -c2p2
            ],
        ];
        return $this;
    }

    public function loadEntries(): void
    {
        // cannot load mock data, it's void
    }

    public function getIn(string $entryKey = null, array $entrySources = []): Traversable
    {
        yield from $this->mockData[reset($entrySources)];
    }

    public function intoKeyObjectArray(Traversable $entries): array
    {
        $result = [];
        $mockEntry = new MockInputEntries();
        foreach ($entries as $key => $value) {
            $entry = clone $mockEntry;
            $entry->setData($key, $value);
            $result[$key] = $entry;
        }
        return $result;
    }
}


class MockInputEntries implements InputEntry
{
    protected $mockKey = '';
    protected $mockValue = '';

    public function setData(string $key, string $value): self
    {
        $this->mockKey = $key;
        $this->mockValue = $value;
        return $this;
    }

    public function getSource(): string
    {
        return '';
    }

    public function getKey(): string
    {
        return $this->mockKey;
    }

    public function getValue()
    {
        return $this->mockValue;
    }
}
