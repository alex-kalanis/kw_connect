<?php

namespace kalanis\kw_connect;


use Filter\IFilter;
use kalanis\kw_connect\Configs\IConfig;
use kalanis\kw_input\IInputs;
use Pager\IPager;
use Sorter\ISorter;


/**
 * Interface IConnect
 * @package kalanis\kw_connect
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
