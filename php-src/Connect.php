<?php

namespace kalanis\kw_connect;


use Filter\IFilter;
use kalanis\kw_connect\Configs\IConfig;
use kalanis\kw_connect\Entries\IEntry;
use kalanis\kw_input\IInputs;
use Pager\IPager;
use Sorter\ISorter;
use Traversable;


/**
 * Class Connect
 * @package kalanis\kw_connect
 * Connections between inputs and params for queries
 */
class Connect implements IConnect
{
    /** @var IConfig|null */
    protected $config = null;
    /** @var IFilter|null */
    protected $filter = null;
    /** @var ISorter|null */
    protected $sorter = null;
    /** @var IPager|null */
    protected $pager = null;
    /** @var IInputs|null */
    protected $inputs = null;

    public function __construct(IFilter $filter, ISorter $sorter, IPager $pager)
    {
        $this->filter = $filter;
        $this->sorter = $sorter;
        $this->pager = $pager;
    }

    public function setConfig(IConfig $config): IConnect
    {
        $this->config = $config;
        return $this;
    }

    public function setInputs(IInputs $inputs): IConnect
    {
        $this->inputs = $inputs;
        return $this;
    }

    /**
     * @return $this
     * @throws ConnectException
     */
    public function process(): IConnect
    {
        if (empty($this->config)) {
            throw new ConnectException('No config transcription what to set to what.');
        }
        if (empty($this->inputs)) {
            throw new ConnectException('No inputs for transcribe.');
        }
        $this->fillFilter();
        $this->fillSorter();
        $this->fillPager();
        return $this;
    }

    protected function fillFilter(): void
    {
        $this->filter->clear();
        $config = $this->config->getFilterEntries();
        $entries = $this->inputs->intoKeyObjectArray( $this->inputs->getIn( null, [$config->getSource()] ));
        $availableKeys = $this->combineTarget($config->getEntries());
        foreach ($entries as $key => $entry) {
            if (isset($availableKeys[$key])) {
                $available = $availableKeys[$key];
                $filter = $this->filter->getDefaultItem();
                $filter->setKey($key)->setValue($entry->getValue());
                if (isset($entries[$available->getLimitationKey()])) {
                    $filter->setRelation($entries[$available->getLimitationKey()]->getValue());
                } else {
                    $filter->setRelation($available->getDefaultLimitation());
                }
                $this->filter->addFilter($filter);
            }
        }
    }

    protected function fillSorter(): void
    {
        $this->sorter->clear();
        $config = $this->config->getSorterEntries();
        $entries = $this->inputs->intoKeyObjectArray( $this->inputs->getIn( null, [$config->getSource()] ));
        $availableKeys = $this->combineTarget($config->getEntries());
        foreach ($entries as $key => $entry) {
            if (isset($availableKeys[$entry->getKey()])) {
                $available = $availableKeys[$entry->getKey()];
                $sorter = $this->sorter->getDefaultItem();
                $sorter->setKey($entry->getKey());
                if (isset($entries[$available->getLimitationKey()])) {
                    $sorter->setDirection($entries[$available->getLimitationKey()]->getValue());
                } else {
                    $sorter->setDirection($available->getDefaultLimitation());
                }
                $this->sorter->add($sorter);
            }
        }
    }

    protected function fillPager(): void
    {
        $config = $this->config->getPagerEntries();
        $entries = $this->inputs->intoKeyObjectArray( $this->inputs->getIn( null, [$config->getSource()] ));
        if (isset($entries[$config->getKey()])) {
            $this->pager->setActualPage(intval($entries[$config->getKey()]->getValue()));
            if (isset($entries[$config->getLimitationKey()])) {
                $this->pager->setLimit(intval($entries[$config->getLimitationKey()]->getValue()));
            }
        }
    }

    /**
     * @param Traversable $entries
     * @return IEntry[]
     */
    protected function combineTarget(Traversable $entries): array
    {
        $result = [];
        foreach ($entries as $entry) {
            if ($entry instanceof IEntry) {
                $result[$entry->getKey()] = $entry;
            }
        }
        return $result;
    }

    public function getFilter(): IFilter
    {
        return $this->filter;
    }

    public function getSorter(): ISorter
    {
        return $this->sorter;
    }

    public function getPager(): IPager
    {
        return $this->pager;
    }
}