
from .interfaces import IEntry, IPagerEntry
from kw_filter.interfaces import IFilterEntry
from kw_input.interfaces import IEntry as Input
from kw_sorter.interfaces import ISortEntry


class AEntry(IEntry):
    """
     * Simple entry of config
    """

    def __init__(self):
        self._key = ''
        self._default_limit = ''
        self._limitation_key = ''

    def get_key(self) -> str:
        return self._key

    def get_limitation_key(self) -> str:
        return self._limitation_key

    def get_default_limitation(self):
        return self._default_limit


class FilterEntry(AEntry):
    """
     * Simple entry of filter config - just what entry is important for filtering
    """

    _default_limits = [
        IFilterEntry.RELATION_EQUAL,
        IFilterEntry.RELATION_NOT_EQUAL,
        IFilterEntry.RELATION_LESS,
        IFilterEntry.RELATION_LESS_EQ,
        IFilterEntry.RELATION_MORE,
        IFilterEntry.RELATION_MORE_EQ,
        IFilterEntry.RELATION_EMPTY,
        IFilterEntry.RELATION_NOT_EMPTY,
        IFilterEntry.RELATION_IN,
        IFilterEntry.RELATION_NOT_IN,
    ]

    def set_entry(self, key: str, limitation_key: str, default_limit: str):
        self._key = key
        self._limitation_key = limitation_key
        self._default_limit = self._check_default_limits(default_limit)
        return self

    def _check_default_limits(self, source: str) -> str:
        return source if source in self._default_limits else self._default_limit


class SorterEntry(AEntry):
    """
     * Simple entry of sorter config - just what entry is important for sorting
    """

    _default_limits = [
        ISortEntry.DIRECTION_DESC,
        ISortEntry.DIRECTION_ASC,
    ]

    def set_entry(self, key: str, limitation_key: str, default_limit: str):
        self._key = key
        self._limitation_key = limitation_key
        self._default_limit = self._check_default_limits(default_limit)
        return self

    def _check_default_limits(self, source: str) -> str:
        return source if source in self._default_limits else self._default_limit


class PagerEntry(AEntry, IPagerEntry):
    """
     * Simple entry of pager config - just what entry is important for pager
    """

    _available_sources = [
        Input.SOURCE_CLI,
        Input.SOURCE_GET,
        Input.SOURCE_POST,
        Input.SOURCE_SESSION,
    ]

    def __init__(self):
        super().__init__()
        self._source = ''

    def set_entry(self, source: str, key: str, limitation_key: str):
        self._source = self._available_source(source)
        self._key = key
        self._limitation_key = limitation_key
        return self

    def _available_source(self, source: str) -> str:
        return source if source in self._available_sources else self._default_limit

    def get_source(self) -> str:
        return self._source

    def get_default_limitation(self):
        return None

    def get_entries(self):
        yield from []
