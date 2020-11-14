<?php

namespace kalanis\kw_connect\Configs;


use kalanis\kw_connect\Entries\IEntry;
use kalanis\kw_input\Entries\IEntry as Input;
use Traversable;


/**
 * Class AEntries
 * @package kalanis\kw_connect\Configs
 * Simple entry of configuration
 */
abstract class AEntries implements IEntries
{
    protected $source = '';
    /** @var IEntry[] */
    protected $entries = [];

    protected static $availableSources = [
        Input::SOURCE_CLI,
        Input::SOURCE_GET,
        Input::SOURCE_POST,
        Input::SOURCE_SESSION,
    ];

    public function getSource(): string
    {
        return $this->source;
    }

    public function setSource(string $source): self
    {
        $this->source = $this->limitSource($source);
        return $this;
    }

    protected function limitSource(string $source): string
    {
        return in_array($source, static::$availableSources) ? $source : $this->source;
    }

    public function getEntries(): Traversable
    {
        yield from $this->entries;
    }

    public function clear(): self
    {
        $this->entries = [];
        return $this;
    }
}
