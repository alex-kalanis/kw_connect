<?php

namespace kalanis\kw_connect\dibi\Filters;


/**
 * Class From
 * @package kalanis\kw_connect\dibi\Filters
 */
class From extends AType
{
    public function setFiltering(string $colName, $value)
    {
        if ('' !== $value) {
            $this->getSource()->where($colName . ' > ?', $value);
        }
        return $this;
    }
}
