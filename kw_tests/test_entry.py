
from kw_connect.interfaces import IEntry, IEntries
from kw_connect.entries import FilterEntry, SorterEntry, PagerEntry
from kw_filter.filter import IFilterEntry
from kw_sorter.sorter import ISortEntry
from kw_input.entries import IEntry as Input
from kw_tests.common_class import CommonTestClass


class EntryTest(CommonTestClass):

    def test_filter_entry(self):

        data = FilterEntry()
        assert isinstance(data, IEntry)

        assert not data.get_key()
        assert not data.get_limitation_key()
        assert not data.get_default_limitation()

        data.set_entry('different', 'another', 'wuz')
        assert 'different' == data.get_key()
        assert 'another' == data.get_limitation_key()
        assert not data.get_default_limitation()

        data.set_entry('ugg', 'huu', IFilterEntry.RELATION_MORE)
        assert 'ugg' == data.get_key()
        assert 'huu' == data.get_limitation_key()
        assert IFilterEntry.RELATION_MORE == data.get_default_limitation()


    def test_sorter_entry(self):

        data = SorterEntry()
        assert isinstance(data, IEntry)

        assert not data.get_key()
        assert not data.get_limitation_key()
        assert not data.get_default_limitation()

        data.set_entry('different', 'another', 'wuz')
        assert 'different' == data.get_key()
        assert 'another' == data.get_limitation_key()
        assert not data.get_default_limitation()

        data.set_entry('ugg', 'huu', ISortEntry.DIRECTION_DESC)
        assert 'ugg' == data.get_key()
        assert 'huu' == data.get_limitation_key()
        assert ISortEntry.DIRECTION_DESC == data.get_default_limitation()


    def test_pager_entry(self):

        data = PagerEntry()
        assert isinstance(data, IEntry)
        assert isinstance(data, IEntries)

        assert not data.get_source()
        assert not data.get_key()
        assert not data.get_limitation_key()
        assert not data.get_default_limitation()
        assert not list(data.get_entries())

        data.set_entry('different', 'another', 'wuz')
        assert not data.get_source()
        assert 'another' == data.get_key()
        assert 'wuz' == data.get_limitation_key()
        assert not data.get_default_limitation()
        assert not list(data.get_entries())

        data.set_entry(Input.SOURCE_GET, 'ugg', 'huu')
        assert Input.SOURCE_GET == data.get_source()
        assert 'ugg' == data.get_key()
        assert 'huu' == data.get_limitation_key()
        assert not data.get_default_limitation()
        assert not list(data.get_entries())
