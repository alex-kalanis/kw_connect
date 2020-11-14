<?php

namespace kalanis\kw_connect\Configs;


use Traversable;


/**
 * Interface IEntries
 * @package kalanis\kw_connect\Configs
 * Shared interface fo entries
 */
interface IEntries
{
    /**
     * For which source will data be read
     * @return string
     * @see \kalanis\kw_input\Entries\IEntry constants
     */
    public function getSource(): string;

    /**
     * List config entries available for action
     * @return Traversable IEntry
     */
    public function getEntries(): Traversable;
}
