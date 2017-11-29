WellCart Platform Utility Library
=================================

[![Build Status](https://travis-ci.org/wellcart/component-utility.svg)](https://travis-ci.org/wellcart/component-utility)

This is the utility component for WellCart Platform.

### System Requirements

Platform requires PHP 7.1.3 or later; we recommend using the
latest PHP version whenever possible.

Required extensions:

* simplexml
* hash
* GD
* DOM
* iconv
* curl

WellCart tries to be strict standard compliant, including by not limited to:

1. Versioning - [Semantic Versioning Specification](http://semver.org)
2. PHP - [PSR compliant](https://github.com/php-fig/fig-standards), [Zend Framework Coding Standards](http://framework.zend.com/manual/current/en/ref/coding.standard.html)
3. HTML/CSS - [Google HTML/CSS Style Guide](https://google.github.io/styleguide/htmlcssguide.xml)
4. JavaScript - [Google JavaScript Style Guide](https://google.github.io/styleguide/javascriptguide.xml)
5. All code must be strictly compliant to its corresponding standards, no warning/notice messages allowed

### Installation instructions

WellCart uses [Composer][1] to manage package dependencies, this is the a recommended way to install WellCart Utility.

If you don't have Composer yet, download it following the instructions on http://getcomposer.org/
or just run the following command:

```bash
    curl -s https://getcomposer.org/installer | php
```

- Clone https://github.com/wellcart/component-utility.git WellCart Utility with:

```bash
    git clone https://github.com/wellcart/component-utility.git
```
- Install WellCart Utility dependencies with composer. If installation process seems too slow you can use "--prefer-dist" option.

```bash
    php composer.phar install
```

[1]:  http://getcomposer.org/