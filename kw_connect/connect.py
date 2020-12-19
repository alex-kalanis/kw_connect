
from .interfaces import IConnect, IConfig, IEntry
from kw_input.interfaces import IInputs
from kw_filter.interfaces import IFilter
from kw_sorter.interfaces import ISorter
from kw_pager.interfaces import IPager


class ConnectException(Exception):

    def __init__(self, message):
        self._message = message

    def get_message(self):
        return self._message


class Connect(IConnect):
    """
     * Connections between inputs and params for queries
    """

    def __init__(self, filtering: IFilter, sorting: ISorter, pager: IPager):
        self._config = None
        self._inputs = None
        self._filter = filtering
        self._sorter = sorting
        self._pager = pager

    def set_config(self, configs: IConfig):
        self._config = configs
        return self

    def set_inputs(self, inputs: IInputs):
        self._inputs = inputs
        return self

    def process(self):
        if not self._config:
            raise ConnectException('No config transcription what to set to what.')

        if not self._inputs:
            raise ConnectException('No inputs for transcribe.')

        self._fill_filter()
        self._fill_sorter()
        self._fill_pager()
        return self

    def _fill_filter(self):
        self._filter.clear()
        conf = self._config.get_filter_entries()
        entries = self._inputs.into_key_object_array(self._inputs.get_in(None, conf.get_source()))
        available_keys = self._combine_target(conf.get_entries())
        for entry in entries.values():
            try:
                if available_keys[entry.get_key()]:
                    available = available_keys[entry.get_key()]
                    filtered = self._filter.get_default_item()
                    filtered.set_key(entry.get_key())
                    filtered.set_value(entries[entry.get_key()].get_value())
                    filtered.set_relation(available.get_default_limitation())
                    self._filter.add_filter(filtered)
                    if available.get_limitation_key() in entries.keys():
                        filtered.set_relation(entries[available.get_limitation_key()].get_value())
            except KeyError:
                pass

    def _fill_sorter(self):
        self._sorter.clear()
        conf = self._config.get_sorter_entries()
        entries = self._inputs.into_key_object_array(self._inputs.get_in(None, conf.get_source()))
        available_keys = self._combine_target(conf.get_entries())
        for entry in entries.values():
            try:
                if available_keys[entry.get_key()]:
                    available = available_keys[entry.get_key()]
                    sorter = self._sorter.get_default_item()
                    sorter.set_key(entry.get_key())
                    sorter.set_direction(available.get_default_limitation())
                    self._sorter.add(sorter)
                    if available.get_limitation_key() in entries.keys():
                        sorter.set_direction(entries[available.get_limitation_key()].get_value())
            except KeyError:
                pass

    def _fill_pager(self):
        conf = self._config.get_pager_entries()
        entries = self._inputs.into_key_object_array(self._inputs.get_in(None, conf.get_source()))
        if conf.get_key() in entries.keys():
            entry_value = entries[conf.get_key()].get_value()
            if isinstance(entry_value, (int, float)):
                self._pager.set_actual_page(int(entry_value))
                if conf.get_limitation_key() in entries.keys():
                    limit_value = entries[conf.get_limitation_key()].get_value()
                    if isinstance(limit_value, (int, float)):
                        self._pager.set_limit(int(limit_value))
            else:
                self._pager.set_actual_page(0)

    def _combine_target(self, entries):
        result = []
        for entry in entries:
            if isinstance(entry, IEntry):
                result.append((entry.get_key(), entry))
        return dict(result)

    def get_filter(self) -> IFilter:
        return self._filter

    def get_sorter(self) -> ISorter:
        return self._sorter

    def get_pager(self) -> IPager:
        return self._pager
