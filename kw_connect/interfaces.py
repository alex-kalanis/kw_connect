
from kw_input.input import IInputs
from kw_filter.filter import IFilter
from kw_sorter.sorter import ISorter
from kw_pager.pager import IPager


class IEntry:
    """
     * Config entry
    """

    def get_key(self) -> str:
        """
         * Basic entry key which will be looked up in incoming data
        """
        raise NotImplementedError('TBA')

    def get_limitation_key(self) -> str:
        """
         * Limitation of entry
         * Entry which will be searched for limitation of operation
        """
        raise NotImplementedError('TBA')

    def get_default_limitation(self):
        """
         * Default value of entry
         * for Filter it's Relation against value
         * possible values are constants from \Filter\IFilterEntry
         * for Sorter it's Direction
         * possible values are constants from \Sorter\ISortEntry
         * for Pager it's number
         * @return string|int
        """
        raise NotImplementedError('TBA')


class IEntries:
    """
     * Shared interface fo entries
    """

    def get_source(self) -> str:
        """
         * For which source will data be read
         * @see \kalanis\kw_input\Entries\IEntry constants
        """
        raise NotImplementedError('TBA')

    def get_entries(self):
        """
         * List config entries available for action
         * @return Traversable IEntry
        """
        raise NotImplementedError('TBA')


class IFilterEntries(IEntries):
    """
     * Config filter entry - it has multiple inputs
    """
    pass


class ISorterEntries(IEntries):
    """
     * Config sorter entry - it has multiple inputs
    """
    pass


class IPagerEntry(IEntry, IEntries):
    """
     * Config pager entry - it has multiple input
    """
    pass


class IConfig:
    """
     * Compact info about what is necessary to fill interfaces
    """

    def get_filter_entries(self) -> IFilterEntries:
        """
         * Return settings of entries available for filtering
        """
        raise NotImplementedError('TBA')

    def get_sorter_entries(self) -> ISorterEntries:
        """
         * Return settings of entries available for sorting
        """
        raise NotImplementedError('TBA')

    def get_pager_entries(self) -> IPagerEntry:
        """
         * Return settings of entries available for pager
        """
        raise NotImplementedError('TBA')


class IConnect:
    """
     * How to connect data from inputs to filter, sorter and pager
    """

    def set_config(self, config: IConfig):
        """
         * Set configuration which describe relations in inputs
        """
        raise NotImplementedError('TBA')

    def set_inputs(self, inputs: IInputs):
        """
         * Set inputs itself - what came to the system
        """
        raise NotImplementedError('TBA')

    def process(self):
        """
         * Process all data and fill filter, sorter and pager
        """
        raise NotImplementedError('TBA')

    def get_filter(self) -> IFilter:
        """
         * Return updated Filter
        """
        raise NotImplementedError('TBA')

    def get_sorter(self) -> ISorter:
        """
         * Return updated Sorter
        """
        raise NotImplementedError('TBA')

    def get_pager(self) -> IPager:
        """
         * Return updated Pager
        """
        raise NotImplementedError('TBA')
