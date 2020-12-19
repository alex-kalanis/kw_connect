
from .interfaces import IEntries, IFilterEntries, ISorterEntries, IPagerEntry, IConfig
from .entries import FilterEntry, SorterEntry
from kw_input.interfaces import IEntry as Input


class AEntries(IEntries):
    """
     * Simple entry of configuration
    """

    _available_sources = [
        Input.SOURCE_CLI,
        Input.SOURCE_GET,
        Input.SOURCE_POST,
        Input.SOURCE_SESSION,
    ]

    def __init__(self):
        self._source = ''
        self._entries = []

    def get_source(self) -> str:
        return self._source

    def set_source(self, source: str):
        self._source = self._limit_source(source)
        return self

    def _limit_source(self, source: str) -> str:
        return source if source in self._available_sources else self._source

    def get_entries(self):
        yield from self._entries

    def clear(self):
        self._entries = []
        return self


class FilterEntries(AEntries, IFilterEntries):
    """
     * Simple entry of filter config
    """

    def add_entry(self, entry: FilterEntry):
        self._entries.append(entry)
        return self


class SorterEntries(AEntries, ISorterEntries):
    """
     * Simple entry of sorter config
    """

    def add_entry(self, entry: SorterEntry):
        self._entries.append(entry)
        return self


class Config(IConfig):
    """
     * Whole configuration package
    """

    def __init__(self, filter_entries: IFilterEntries, sorter_entries: ISorterEntries, pager_entry: IPagerEntry):
        self._filter_entries = filter_entries
        self._sorter_entries = sorter_entries
        self._pager_entry = pager_entry

    def get_filter_entries(self) -> IFilterEntries:
        return self._filter_entries

    def get_sorter_entries(self) -> ISorterEntries:
        return self._sorter_entries

    def get_pager_entries(self) -> IPagerEntry:
        return self._pager_entry
