"""
Main classes and interfaces for using this kind of pager
"""


class IPager:
    """
     * Interface IPager
    """

    def set_max_results(self, max_results: int):
        """
         * Set maximum available results for paging
        """
        raise NotImplementedError('TBI')

    def get_max_results(self) -> int:
        """
         * Returns maximum available results for paging
        """
        raise NotImplementedError('TBI')

    def set_actual_page(self, page: int):
        """
         * Set current page number
        """
        raise NotImplementedError('TBI')

    def get_actual_page(self) -> int:
        """
         * Returns current page number
        """
        raise NotImplementedError('TBI')

    def set_limit(self, limit: int):
        """
         * Set limit of items on one page
        """
        raise NotImplementedError('TBI')

    def get_limit(self) -> int:
        """
         * Returns limit of items on one page
        """
        raise NotImplementedError('TBI')

    def get_offset(self) -> int:
        """
         * Returns calculated offset
        """
        raise NotImplementedError('TBI')

    def get_pages_count(self) -> int:
        """
         * Returns number of available pages
        """
        raise NotImplementedError('TBI')

    def page_exists(self, page: int) -> bool:
        """
         * Have we that page?
        """
        raise NotImplementedError('TBI')
