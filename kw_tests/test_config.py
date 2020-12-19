
from kw_connect.interfaces import IEntries, IPagerEntry
from kw_connect.configs import FilterEntries, SorterEntries, Config
from kw_tests.common_class import CommonTestClass
from kw_filter.interfaces import IFilterEntry
from kw_sorter.interfaces import ISortEntry
from kw_input.interfaces import IEntry as Input


class ConfigTest(CommonTestClass):

    def test_filter_entry(self):
        # import pprint
        # pprint.pprint(entries)

        data = FilterEntries()
        assert isinstance(data, IEntries)

        assert not data.get_source()
        assert not list(data.get_entries())

        data.set_source('different')  # bad source
        assert not data.get_source()
        assert not list(data.get_entries())

        data.set_source(Input.SOURCE_ENV)  # another bad source
        assert not data.get_source()
        assert not list(data.get_entries())

        data.set_source(Input.SOURCE_CLI)
        assert Input.SOURCE_CLI == data.get_source()
        assert not list(data.get_entries())

    def test_filter_entries(self):

        data = FilterEntries()
        assert not data.get_source()
        assert not list(data.get_entries())

        data.set_source(Input.SOURCE_CLI)
        data.add_entry(self.entry_filter_1())
        data.add_entry(self.entry_filter_2())
        array = list(data.get_entries())
        assert array

        entry = array[0]
        assert 'abc' == entry.get_key()
        assert IFilterEntry.RELATION_EQUAL == entry.get_default_limitation()

        entry = array[1]
        assert 'ghi' == entry.get_key()
        assert IFilterEntry.RELATION_LESS == entry.get_default_limitation()

        data.clear()
        assert not list(data.get_entries())

    def test_sorter_entry(self):

        data = SorterEntries()
        assert isinstance(data, IEntries)

        assert not data.get_source()
        assert not list(data.get_entries())

        data.set_source('different')  # bad source
        assert not data.get_source()
        assert not list(data.get_entries())

        data.set_source(Input.SOURCE_SERVER)  # another bad source
        assert not data.get_source()
        assert not list(data.get_entries())

        data.set_source(Input.SOURCE_SESSION)
        assert Input.SOURCE_SESSION == data.get_source()
        assert not list(data.get_entries())

    def test_sorter_entries(self):

        data = SorterEntries()
        assert not data.get_source()
        assert not list(data.get_entries())

        data.set_source(Input.SOURCE_GET)
        data.add_entry(self.entry_sorter_1())
        data.add_entry(self.entry_sorter_3())
        array = list(data.get_entries())
        assert array

        entry = array[0]
        assert 'adg' == entry.get_key()
        assert ISortEntry.DIRECTION_ASC == entry.get_default_limitation()

        entry = array[1]
        assert 'knq' == entry.get_key()
        assert ISortEntry.DIRECTION_DESC == entry.get_default_limitation()

        data.clear()
        assert not list(data.get_entries())

    def test_config(self):

        data = Config(self.entries_filter_1(), self.entries_sorter_1(), self.entry_pager_1())
        assert isinstance(data.get_filter_entries(), IEntries)
        assert isinstance(data.get_sorter_entries(), IEntries)
        assert isinstance(data.get_pager_entries(), IEntries)
        assert isinstance(data.get_pager_entries(), IPagerEntry)
