import unittest
from kw_connect.configs import AEntries, FilterEntries, SorterEntries, Config
from kw_connect.entries import FilterEntry, SorterEntry, PagerEntry
from kw_filter.filter import IFilterEntry
from kw_input.entries import IEntry as Input
from kw_sorter.sorter import ISortEntry


class CommonTestClass(unittest.TestCase):
    """
    Used format is list of tuples where first item is string key and second is mixed value
    Total madness by typing, but something tells me it's correct pythonic way
    """

    def entry_filter_1(self) -> FilterEntry:
        return FilterEntry().set_entry('abc', 'def', IFilterEntry.RELATION_EQUAL)

    def entry_filter_2(self) -> FilterEntry:
        return FilterEntry().set_entry('ghi', 'jkl', IFilterEntry.RELATION_LESS)

    def entry_filter_3(self) -> FilterEntry:
        return FilterEntry().set_entry('mno', 'pqr', IFilterEntry.RELATION_MORE)

    def entry_filter_4(self) -> FilterEntry:
        return FilterEntry().set_entry('stu', 'vwx', IFilterEntry.RELATION_MORE_EQ)

    def entry_sorter_1(self) -> SorterEntry:
        return SorterEntry().set_entry('adg', 'jmp', ISortEntry.DIRECTION_ASC)

    def entry_sorter_2(self) -> SorterEntry:
        return SorterEntry().set_entry('svy', 'beh', ISortEntry.DIRECTION_ASC)

    def entry_sorter_3(self) -> SorterEntry:
        return SorterEntry().set_entry('knq', 'tw0', ISortEntry.DIRECTION_DESC)

    def entry_sorter_4(self) -> SorterEntry:
        return SorterEntry().set_entry('cfi', 'lor', ISortEntry.DIRECTION_DESC)

    def entry_pager_1(self) -> PagerEntry:
        return PagerEntry().set_entry(Input.SOURCE_GET, 'amp', 'hkn')

    def entry_pager_2(self) -> PagerEntry:
        return PagerEntry().set_entry(Input.SOURCE_POST, 'tmz', 'bku')

    def entries_filter_1(self) -> AEntries:
        return FilterEntries().add_entry(self.entry_filter_1()).add_entry(self.entry_filter_3()).set_source(Input.SOURCE_GET)

    def entries_filter_2(self) -> AEntries:
        return FilterEntries().add_entry(self.entry_filter_2()).add_entry(self.entry_filter_4()).set_source(Input.SOURCE_POST)

    def entries_sorter_1(self) -> AEntries:
        return SorterEntries().add_entry(self.entry_sorter_1()).add_entry(self.entry_sorter_2()).set_source(Input.SOURCE_GET)

    def entries_sorter_2(self) -> AEntries:
        return SorterEntries().add_entry(self.entry_sorter_3()).add_entry(self.entry_sorter_4()).set_source(Input.SOURCE_POST)

    def config_1(self) -> Config:
        return Config(self.entries_filter_1(), self.entries_sorter_1(), self.entry_pager_1())

    def config_2(self) -> Config:
        return Config(self.entries_filter_2(), self.entries_sorter_2(), self.entry_pager_2())

    def iterator_to_dict(self, iters):
        result = []
        for entry in iters:
            result.append((entry.get_key(), entry))
        return dict(result)