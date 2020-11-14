

class ISortEntry:
    """
     * Basic necessity to sort anything
    """

    DIRECTION_ASC = 'ASC'
    DIRECTION_DESC = 'DESC'

    def set_key(self, key: str):
        """
         * Set by which key the entry will be sorted
        """
        raise NotImplementedError('TBA')

    def get_key(self) -> str:
        """
         * Sort by which key
        """
        raise NotImplementedError('TBA')

    def set_direction(self, direction: str):
        """
         * Set direction of sort
         * Preferably use constants above
        """
        raise NotImplementedError('TBA')

    def get_direction(self) -> str:
        """
         * Sorting direction
         * Preferably use constants above
        """
        raise NotImplementedError('TBA')


class ISorter:
    """
     * Basic interface
     * Make your app dependant on this interface
    """

    def get_entries(self):
        """
         * Get entries in sorting
        """
        raise NotImplementedError('TBA')

    def add(self, entry: ISortEntry):
        """
         * Add single entry from input which will be used for sorting
        """
        raise NotImplementedError('TBA')

    def remove(self, entry_key: str):
        """
         * Remove all entries containing that key
        """
        raise NotImplementedError('TBA')

    def clear(self):
        """
         * Clear sorting entries, be ready for another set
        """
        raise NotImplementedError('TBA')

    def get_default_item(self) -> ISortEntry:
        """
         * Return new entry usable for sorting
        """
        raise NotImplementedError('TBA')
