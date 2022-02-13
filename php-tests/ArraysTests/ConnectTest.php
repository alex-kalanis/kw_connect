<?php

namespace ArraysTests;


use CommonTestClass;
use kalanis\kw_connect\arrays;
use kalanis\kw_connect\core\ConnectException;
use kalanis\kw_connect\core\Interfaces\IOrder;


class ConnectTest extends CommonTestClass
{
    /**
     * @throws ConnectException
     */
    public function testConnector1()
    {
        $lib = new arrays\Connector($this->sourceRows()); // no PK
        $lib->setFiltering(arrays\Filters\Factory::ACTION_EXACT, 'pqr', true);
        $lib->setSorting('jkl', IOrder::ORDER_DESC);
        $lib->setPagination(2, 2);
        $lib->fetchData();
        $this->assertEquals(4, $lib->getTotalCount());
    }

    /**
     * @throws ConnectException
     */
    public function testConnector2()
    {
        $lib = new arrays\Connector($this->sourceRows(), 'abc'); // with PK
        $lib->setFiltering(arrays\Filters\Factory::ACTION_EXACT, 'pqr', false);
        $lib->setSorting('jkl', IOrder::ORDER_ASC);
        $this->assertEquals(5, $lib->getTotalCount());
    }

    /**
     * @throws ConnectException
     */
    public function testConnector3()
    {
        $lib = new arrays\Connector([]); // empty source
        $this->assertEquals(0, $lib->getTotalCount());
    }
}
