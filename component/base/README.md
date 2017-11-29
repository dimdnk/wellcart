WellCart Platform Base Library
==============================

[![Latest Stable Version](https://poser.pugx.org/wellcart/component-base/v/stable.png)](https://packagist.org/packages/wellcart/component-base)
[![Build Status](https://travis-ci.org/wellcart/component-base.svg)](https://travis-ci.org/wellcart/component-base)
[![Dependency Status](https://www.versioneye.com/php/wellcart:component-base/dev-master/badge.png)](https://www.versioneye.com/php/wellcart:component-base/dev-master)

WellCart Base Module controls how application components interact, including request flow,
routing, caching, and exception handling. It provides services that reduce the effort 
of creating modules that contain business logic, contributing to the goal of both making WellCart code more modular
as well as decreasing dependencies.

* [License Agreement](LICENSE.md)
* [Installation Instructions](docs/Module_Installation_Instructions.md)
* [Changelog](CHANGELOG.md)

### System Requirements

Library requires PHP 7.1.3 or later; we recommend using the
latest PHP version whenever possible.

#### Required extensions:

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

##### WellCart tries to be strict standard compliant, including by not limited to:

1. Versioning - [Semantic Versioning Specification](http://semver.org)
2. PHP - [PSR compliant](https://github.com/php-fig/fig-standards), [Zend Framework Coding Standards](http://framework.zend.com/manual/current/en/ref/coding.standard.html)
3. HTML/CSS - [Google HTML/CSS Style Guide](https://google.github.io/styleguide/htmlcssguide.xml)
4. JavaScript - [Google JavaScript Style Guide](https://google.github.io/styleguide/javascriptguide.xml)
5. All code must be strictly compliant to its corresponding standards, no warning/notice messages allowed