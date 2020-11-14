
class IInputs:
    """
     * Basic interface which tells us what actions are by default available by inputs
    """

    def set_source(self, source=None):
        """
         * Setting the variable sources - from cli (argv), _GET, _POST, _SERVER, ...
        """
        raise NotImplementedError('TBA')

    def load_entries(self):
        """
         * Load entries from source into the local entries which will be accessible
         * These two calls came usually in pair
         *
         * input.set_source(sys.argv).load_entries()
        """
        raise NotImplementedError('TBA')

    def get_in(self, entry_key: str = None, entry_sources = None):
        """
         * Get iterator of local entries, filter them on way
         * @param string|null $entry_key
         * @param string[] $entry_sources array of constants from Entries.IEntry.SOURCE_*
         * @return iterator
         * @see Entries.IEntry.SOURCE_CLI
         * @see Entries.IEntry.SOURCE_GET
         * @see Entries.IEntry.SOURCE_POST
         * @see Entries.IEntry.SOURCE_FILES
         * @see Entries.IEntry.SOURCE_SESSION
         * @see Entries.IEntry.SOURCE_SERVER
         * @see Entries.IEntry.SOURCE_ENV
        """
        raise NotImplementedError('TBA')

    def into_key_object_array(self, entries):
        """
         * Reformat iterator from get_in() into array with key as array key and value with the whole entry
         * @param iterator entries
         * @return Entries.IEntry[]
         * Also usually came in pair with previous call - but with a different syntax
         * Beware - due any dict limitations there is a limitation that only the last entry prevails
         *
         * entries = input.into_key_object_array(input.get_in('example', [Entries.IEntry.SOURCE_GET]));
        """
        raise NotImplementedError('TBA')
