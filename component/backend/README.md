WellCart Platform Admin Module
==============================

[![Latest Stable Version](https://poser.pugx.org/wellcart/component-backend/v/stable.png)](https://packagist.org/packages/wellcart/component-backend)
[![Build Status](https://travis-ci.org/wellcart/component-backend.svg)](https://travis-ci.org/wellcart/component-backend)
[![Dependency Status](https://www.versioneye.com/php/wellcart:component-backend/dev-master/badge.png)](https://www.versioneye.com/php/wellcart:component-backend/dev-master)

This is the admin module for WellCart Platform. Сontains common infrastructure and assets for other modules to be defined and used in their
administration user interface (UI). It does not contain anything specific to other modules. Among many things it
handles the logic of authenticating and authorizing users.

* [License Agreement](LICENSE.md)
* [Installation Instructions](docs/Module_Installation_Instructions.md)
* [Changelog](CHANGELOG.md)

### System Requirements

Module requires PHP 7.0.0 or later; we recommend using the
latest PHP version whenever possible.

Required extensions:

* simplexml
* hash
* GD
* DOM
* PDO
* iconv
* curl
* libxml
* ctype
* spl
* xsl
* Safe_mode off

##### WellCart tries to be strict standard compliant, including by not limited to:

1. Versioning - [Semantic Versioning Specification](http://semver.org)
2. PHP - [PSR compliant](https://github.com/php-fig/fig-standards), [Zend Framework Coding Standards](http://framework.zend.com/manual/current/en/ref/coding.standard.html)
3. HTML/CSS - [Google HTML/CSS Style Guide](https://google.github.io/styleguide/htmlcssguide.xml)
4. JavaScript - [Google JavaScript Style Guide](https://google.github.io/styleguide/javascriptguide.xml)
5. All code must be strictly compliant to its corresponding standards, no warning/notice messages allowed