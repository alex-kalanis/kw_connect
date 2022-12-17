<?php

namespace CoreTests;


use CommonTestClass;
use kalanis\kw_connect\arrays\Filters;
use kalanis\kw_connect\core\AFilterFactory;
use kalanis\kw_connect\core\ConnectException;
use kalanis\kw_connect\core\Interfaces;


class FilterTest extends CommonTestClass
{
    public function testInstance()
    {
        $data = Factory::getInstance();
        $this->assertEquals(Factory::getInstance(), $data);
    }

    /**
     * @throws ConnectException
     */
    public function testFilter()
    {
        $data = Factory::getInstance();
        $this->assertInstanceOf(Interfaces\IFilterType::class, $data->getFilter(Factory::ACTION_EXACT));
    }

    /**
     * @throws ConnectException
     */
    public function testFilterUnknown()
    {
        $data = Factory::getInstance();
        $this->expectException(ConnectException::class);
        $data->getFilter(Factory::ACTION_CONTAINS);
    }

    /**
     * @throws ConnectException
     */
    public function testFilterFail()
    {
        $data = Factory::getInstance();
        $this->expectException(ConnectException::class);
        $data->getFilter('failing');
    }
}


class Factory extends AFilterFactory
{
    protected static $map = [
        self::ACTION_EXACT => Filters\Exact::class,
        self::ACTION_MULTIPLE => Filters\Multiple::class,
        'failing' => FailingFilter::class,
    ];
}


class FailingFilter
{
    // not instance of IFilterType
}
