kw_connect
================

![Build Status](https://github.com/alex-kalanis/kw_connect/actions/workflows/code_checks.yml/badge.svg)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/alex-kalanis/kw_connect/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/alex-kalanis/kw_connect/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/alex-kalanis/kw_connect/v/stable.svg?v=1)](https://packagist.org/packages/alex-kalanis/kw_connect)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.4-8892BF.svg)](https://php.net/)
[![Downloads](https://img.shields.io/packagist/dt/alex-kalanis/kw_connect.svg?v1)](https://packagist.org/packages/alex-kalanis/kw_connect)
[![License](https://poser.pugx.org/alex-kalanis/kw_connect/license.svg?v=1)](https://packagist.org/packages/alex-kalanis/kw_connect)
[![Code Coverage](https://scrutinizer-ci.com/g/alex-kalanis/kw_connect/badges/coverage.png?b=master&v=1)](https://scrutinizer-ci.com/g/alex-kalanis/kw_connect/?branch=master)

Contains connection between content lookups like tables and storage engines. Allow you
use any of them as the same source and one table engine over everything. The main database
engine layer is usually already decided by your framework or existing system. So then you
need only to connect this layer before using it with things built over this connector.

# PHP Installation

```bash
composer.phar require alex-kalanis/kw_connect
```

(Refer to [Composer Documentation](https://github.com/composer/composer/blob/master/doc/00-intro.md#introduction) if you are not
familiar with composer)


# PHP Usage

1.) Use your autoloader (if not already done via Composer autoloader)

2.) Connect the "kalanis\kw_connect\\*" into your app. Use the correct one depending
on your connection to datasource (like defined by your framework or environment).
When it come be necessary you can define your own. You can extends every library
to comply your use-case; mainly for describe your searched inputs.
