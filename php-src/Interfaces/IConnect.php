<?php

namespace kalanis\kw_connect\Interfaces;


use kalanis\kw_filter\Interfaces\IFilter;
use kalanis\kw_input\Interfaces\IInputs;
use kalanis\kw_pager\Interfaces\IPager;
use kalanis\kw_sorter\Interfaces\ISorter;


/**
 * Interface IConnect
 * @package kalanis\kw_connect\Interfaces
 * How to connect data from inputs to filter, sorter and pager
 */
interface IConnect
{
    /**
     * Set configuration which describe relations in inputs
     * @param IConfig $config
     * @return $this
     */
    public function setConfig(IConfig $config): self;

    /**
     * Set inputs itself - what came to the system
     * @param IInputs $inputs
     * @return $this
     */
    public function setInputs(IInputs $inputs): self;

    /**
     * Process all data and fill filter, sorter and pager
     * @return $this
     */
    public function process(): self;

    /**
     * Return updated Filter
     * @return IFilter
     */
    public function getFilter(): IFilter;

    /**
     * Return updated Sorter
     * @return ISorter
     */
    public function getSorter(): ISorter;

    /**
     * Return updated Pager
     * @return IPager
     */
    public function getPager(): IPager;
}
