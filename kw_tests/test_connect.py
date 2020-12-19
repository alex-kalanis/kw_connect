
from kw_connect.connect import Connect, ConnectException
from kw_tests.common_class import CommonTestClass
from kw_filter.interfaces import IFilter, IFilterEntry
from kw_sorter.interfaces import ISorter, ISortEntry
from kw_pager.interfaces import IPager
from kw_input.interfaces import IEntry as InputEntry
from kw_input.interfaces import IInputs


class ConnectTest(CommonTestClass):

    def test_basic(self):
        # import pprint

        connect = Connect(MockFilter(), MockSorter(), MockPager())
        assert isinstance(connect.get_filter(), IFilter)
        assert isinstance(connect.get_sorter(), ISorter)
        assert isinstance(connect.get_pager(), IPager)

        connect.set_inputs(MockInputs().set_source())

        # one definition
        connect.set_config(self.config_1())
        connect.process()

        filters = self.iterator_to_dict(connect.get_filter().get_entries())
        assert 2 == len(filters)
        assert 'poiu' == filters['abc'].get_value()
        assert 'ztre' == filters['abc'].get_relation()
        assert 'jhgf' == filters['mno'].get_value()
        assert IFilterEntry.RELATION_MORE == filters['mno'].get_relation()

        sorters = self.iterator_to_dict(connect.get_sorter().get_entries())
        assert 2 == len(sorters)
        assert ISortEntry.DIRECTION_ASC == sorters['adg'].get_direction()
        assert 'iuzt' == sorters['svy'].get_direction()

        assert 11 == connect.get_pager().get_actual_page()
        assert 25 == connect.get_pager().get_limit()

        # another definition, no need to change source
        connect.set_config(self.config_2())
        connect.process()

        filters = self.iterator_to_dict(connect.get_filter().get_entries())
        assert 2 == len(filters)
        assert 'tzui' == filters['ghi'].get_value()
        assert IFilterEntry.RELATION_LESS == filters['ghi'].get_relation()
        assert 'dfgh' == filters['stu'].get_value()
        assert 'jkly' == filters['stu'].get_relation()

        sorters = self.iterator_to_dict(connect.get_sorter().get_entries())
        assert 2 == len(sorters)
        assert ISortEntry.DIRECTION_ASC == sorters['knq'].get_direction()
        assert ISortEntry.DIRECTION_DESC == sorters['cfi'].get_direction()

        assert 0 == connect.get_pager().get_actual_page()
        assert 25 == connect.get_pager().get_limit()
        # pprint.pprint(['filter', str(sorters['cfi'])])

    def test_no_config(self):
        try:
            connect = Connect(MockFilter(), MockSorter(), MockPager())
            connect.set_inputs(MockInputs())
            connect.process()
            assert False
        except ConnectException:
            assert True

    def test_no_inputs(self):
        try:
            connect = Connect(MockFilter(), MockSorter(), MockPager())
            connect.set_config(self.config_1())
            connect.process()
            assert False
        except ConnectException:
            assert True


class MockFilter(IFilter):

    def __init__(self):
        self._mock_filters = []
        self._mock_key = ''
        self._mock_value = ''
        self._mock_relation = ''

    def __str__(self):
        return '<MockFilter: k:%s v:%s r:%s>' % (self._mock_key, self._mock_value, self._mock_relation)

    def add_filter(self, filter_entry: IFilterEntry):
        self._mock_filters.append(filter_entry)
        return self

    def remove(self, filter_key: str):
        result = []
        for entry in self._mock_filters:
            if entry.get_key() != filter_key:
                result.append(entry)
        self._mock_filters = result
        return self

    def clear(self):
        self._mock_filters = []
        return self

    def get_default_item(self) -> IFilterEntry:
        return MockFilter()

    def set_key(self, key: str):
        self._mock_key = key
        return self

    def get_key(self) -> str:
        return self._mock_key

    def set_value(self, value):
        self._mock_value = value
        return self

    def get_value(self):
        return self._mock_value

    def set_relation(self, relation: str):
        self._mock_relation = relation
        return self

    def get_relation(self) -> str:
        return self._mock_relation

    def get_entries(self):
        yield from self._mock_filters


class MockSorter(ISorter):

    def __init__(self):
        self._mock_sorters = []

    def add(self, entry: ISortEntry):
        self._mock_sorters.append(entry)
        return self

    def remove(self, entry_key: str):
        result = []
        for entry in self._mock_sorters:
            if entry.get_key() != entry_key:
                result.append(entry)
        self._mock_sorters = result
        return self

    def clear(self):
        self._mock_sorters = []
        return self

    def get_default_item(self) -> ISortEntry:
        return MockSortEntry()

    def get_entries(self):
        yield from self._mock_sorters


class MockSortEntry(ISortEntry):

    def __init__(self):
        self._mock_key = ''
        self._mock_direction = ''

    def __str__(self):
        return '<MockFilter: k:%s d:%s>' % (self._mock_key, self._mock_direction)

    def set_key(self, key: str):
        self._mock_key = key
        return self

    def get_key(self) -> str:
        return self._mock_key

    def set_direction(self, direction: str):
        self._mock_direction = direction
        return self

    def get_direction(self) -> str:
        return self._mock_direction


class MockPager(IPager):

    def __init__(self):
        self._mock_max_results = 0
        self._mock_actual_page = 0
        self._mock_limit = 0

    def set_max_results(self, max_results: int):
        self._mock_max_results = max_results
        return self

    def get_max_results(self) -> int:
        return self._mock_max_results

    def set_actual_page(self, page: int):
        self._mock_actual_page = page
        return self

    def get_actual_page(self) -> int:
        return self._mock_actual_page

    def set_limit(self, limit: int):
        self._mock_limit = limit
        return self

    def get_limit(self) -> int:
        return self._mock_limit

    def get_offset(self) -> int:
        return 0

    def get_pages_count(self) -> int:
        return 0

    def page_exists(self, i: int) -> bool:
        return False


class MockInputs(IInputs):

    def __init__(self):
        self._mock_data = []

    def set_source(self, source=None):
        # load mock data
        self._mock_data = [
            (InputEntry.SOURCE_GET, [
                # filter
                ('abc', 'poiu'),  # -c1e1f1
                ('def', 'ztre'),  # lim -c1e1f1
                ('ghi', 'wqlk'),
                ('jkl', IFilterEntry.RELATION_EQUAL),  # lim
                ('mno', 'jhgf'),  # -c1e1f3
                # pqr - lim -c1e1f3
                ('stu', 'dsam'),
                # sorter
                ('adg', 'nbvc'),  # -c1e1s1
                # jmp - lim -c1e1s1
                ('svy', 'xypo'),  # -c1e1s2
                ('beh', 'iuzt'),  # lim -c1e1s2
                ('knq', 'rewq'),
                ('cfi', 'lkjh'),
                ('lor', ISortEntry.DIRECTION_DESC),  # lim
                # pager
                ('amp', 11),  # -c1p1
                ('hkn', 25),  # lim -c1p1
                ('tmz', 3),
            ]),
            (InputEntry.SOURCE_POST, [
                # filter
                ('abc', 'qwer'),
                ('ghi', 'tzui'),  # -c2e2f2
                # jkl - lim -c2e2f2
                ('mno', 'opas'),
                ('pqr', IFilterEntry.RELATION_EQUAL),  # lim
                ('stu', 'dfgh'),  # -c2e2f4
                ('vwx', 'jkly'),  # lim -c2e2f4
                # sorter
                ('adg', 'xcvb'),
                ('jmp', 'nmqw'),  # lim
                ('svy', 'ertz'),
                ('knq', 'uiop'),  # -c2e2s3
                ('tw0', ISortEntry.DIRECTION_ASC),  # lim -c2e2s3
                ('cfi', 'asdf'),  # -c2e2s4
                # lor - lim -c2e2s4
                # pager
                ('amp', 'ghjk'),
                ('tmz', 'lyxc'),  # -c2p2
                # bku - lim -c2p2
            ]),
        ]
        return self

    def load_entries(self):
        # cannot load mock data, it's void
        pass

    def get_in(self, entry_key: str = None, entry_sources = None):
        for (source, mock_data) in self._mock_data:
            if (not entry_sources) or (source in entry_sources):
                for (key, values) in mock_data:
                    entry = MockInputEntries()
                    entry.set_data(key, values)
                    yield entry
        yield from []

    def into_key_object_array(self, entries):
        result = []
        for entry in entries:
            result.append((entry.get_key(), entry))
        return dict(result)


class MockInputEntries(InputEntry):

    def __init__(self):
        self._mock_key = ''
        self._mock_value = ''

    def set_data(self, key: str, value: str):
        self._mock_key = key
        self._mock_value = value
        return self

    def get_source(self) -> str:
        return ''

    def get_key(self) -> str:
        return self._mock_key

    def get_value(self):
        return self._mock_value
