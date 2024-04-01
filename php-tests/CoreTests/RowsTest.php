<?php

namespace CoreTests;


use CommonTestClass;
use kalanis\kw_connect\core\Rows;
use kalanis\kw_connect\core\ConnectException;
use kalanis\kw_connect\core\Interfaces;


class RowsTest extends CommonTestClass
{
    /**
     * @param array $data
     * @param string|int $unknown
     * @param string|int $exists
     * @param mixed $expect
     * @param int $count
     * @dataProvider rowProvider
     * @throws ConnectException
     */
    public function testSimpleArrayRow(array $data, $unknown, $exists, $expect, $count)
    {
        $data = new Rows\SimpleArrayRow($data);
        $this->assertInstanceOf(Interfaces\IRow::class, $data);

        $this->assertFalse($data->__isset($unknown));
        $this->assertFalse(isset($data->$unknown));

        $this->assertTrue($data->__isset($exists));
        $this->assertTrue(isset($data->$exists));

        $this->assertEquals($expect, $data->getValue($exists));
    }

    /**
     * @param array $data
     * @param string|int $unknown
     * @param string|int $exists
     * @param mixed $expect
     * @param int $count
     * @dataProvider rowProvider
     * @throws ConnectException
     */
    public function testArrayAccessRow(array $data, $unknown, $exists, $expect, $count)
    {
        $data = new Rows\ArrayAccessRow(new \ArrayObject($data));
        $this->assertInstanceOf(Interfaces\IRow::class, $data);

        $this->assertFalse($data->__isset($unknown));
        $this->assertFalse(isset($data->$unknown));

        $this->assertTrue($data->__isset($exists));
        $this->assertTrue(isset($data->$exists));

        $this->assertEquals($expect, $data->getValue($exists));
    }

    public function rowProvider(): array
    {
        return [
            [['abc' => 'def', 'ghi' => 'jkl', 'mno' => 'pqr'], 'fff', 'ghi', 'jkl', 3],
            [['abc', 'def', 'ghi', 'jkl', 'mno', 'pqr'], 40, 3, 'jkl', 6],
            [[123, 456, 789, 012, 345, 678], 'hehe', 4, 345, 6],
        ];
    }
}
