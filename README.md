kw_connect
================

Contains connection between inputs and selectors for querying storages. Allow you
use either get and cli or server and env params as same source.

This is the mixed package - contains sever-side implementation in Python and PHP.

# PHP Installation

```
{
    "require": {
        "alex-kalanis/kw_connect": "1.0"
    }
}
```

(Refer to [Composer Documentation](https://github.com/composer/composer/blob/master/doc/00-intro.md#introduction) if you are not
familiar with composer)


# PHP Usage

1.) Use your autoloader (if not already done via Composer autoloader)

2.) Connect the "kalanis\kw_connect" into your app. When it came necessary
you can extends every library to comply your use-case; mainly for describe your
searched inputs.

# Python Installation

into your "setup.py":

```
    install_requires=[
        'kw_connect',
    ]
```

# Python Usage

1.) Connect the "kw_connect\connect" into your app. When it came necessary
you can extends every library to comply your use-case; mainly for describe your
searched inputs.
