<?php

namespace kalanis\kw_connect\Entries;


use kalanis\kw_connect\Interfaces\IEntry;


/**
 * Class AEntry
 * @package kalanis\kw_connect\Entries
 * Simple entry of config
 */
abstract class AEntry implements IEntry
{
    protected $key = '';
    protected $defaultLimit = '';
    protected $limitationKey = '';

    public function getKey(): string
    {
        return $this->key;
    }

    public function getLimitationKey(): string
    {
        return $this->limitationKey;
    }

    public function getDefaultLimitation()
    {
        return $this->defaultLimit;
    }
}
