WellCart Platform User Module
=============================

[![Latest Stable Version](https://poser.pugx.org/wellcart/component-user/v/stable.png)](https://packagist.org/packages/wellcart/component-user)
[![Build Status](https://travis-ci.org/wellcart/component-user.svg)](https://travis-ci.org/wellcart/component-user)
[![Dependency Status](https://www.versioneye.com/php/wellcart:component-user/dev-master/badge.png)](https://www.versioneye.com/php/wellcart:component-user/dev-master)

Provides user management functionality (authentication, authorization, etc).

Responsibilities
----------------

- user management
    - edit user information
    - reset password email by administrator
    - change password by administrator
- role management
- group management
- authentication
- authorization

* [License Agreement](LICENSE.md)
* [Installation Instructions](docs/Module_Installation_Instructions.md)
* [Changelog](CHANGELOG.md)

### System Requirements

Module requires PHP 7.1.3 or later; we recommend using the
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

##### WellCart tries to be strict standard compliant, including by not limited to:

1. Versioning - [Semantic Versioning Specification](http://semver.org)
2. PHP - [PSR compliant](https://github.com/php-fig/fig-standards), [Zend Framework Coding Standards](http://framework.zend.com/manual/current/en/ref/coding.standard.html)
3. HTML/CSS - [Google HTML/CSS Style Guide](https://google.github.io/styleguide/htmlcssguide.xml)
4. JavaScript - [Google JavaScript Style Guide](https://google.github.io/styleguide/javascriptguide.xml)
5. All code must be strictly compliant to its corresponding standards, no warning/notice messages allowed