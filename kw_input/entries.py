
class IEntry:
    """
     * Entry interface - this will be shared across the projects
    """

    SOURCE_CLI = 'cli'
    SOURCE_GET = 'get'
    SOURCE_POST = 'post'
    SOURCE_FILES = 'files'
    SOURCE_SESSION = 'session'
    SOURCE_SERVER = 'server'
    SOURCE_ENV = 'environment'
    SOURCE_EXTERNAL = 'external'

    def get_source(self) -> str:
        """
         * Return source of entry
        """
        raise NotImplementedError('TBA')

    def get_key(self) -> str:
        """
         * Return key of entry
        """
        raise NotImplementedError('TBA')

    def get_value(self):
        """
         * Return value of entry
         * It could be anything - string, boolean, array - depends on source
        """
        raise NotImplementedError('TBA')


class IFileEntry(IEntry):
    """
     * File entry interface - how to access uploaded files
     * @link https://www.php.net/manual/en/reserved.variables.files.php
    """

    def get_mime_type(self) -> str:
        """
         * Return what mime is that by browser
         * Beware, it is not reliable
        """
        raise NotImplementedError('TBA')

    def get_temp_name(self) -> str:
        """
         * Get name in temp
         * Use it for function like move_uploaded_file()
        """
        raise NotImplementedError('TBA')

    def get_error(self) -> int:
        """
         * Get error code from upload
         * @link https://www.php.net/manual/en/features.file-upload.errors.php
        """
        raise NotImplementedError('TBA')

    def get_size(self) -> int:
        """
         * Get uploaded file size
        """
        raise NotImplementedError('TBA')
