## WellCart Platform Package

[![Latest Stable Version](https://poser.pugx.org/wellcart/wellcart/v/stable.png)](https://packagist.org/packages/wellcart/wellcart) 
[![Build Status](https://travis-ci.org/wellcart/wellcart.svg)](https://travis-ci.org/wellcart/wellcart) 
[![Dependency Status](https://www.versioneye.com/php/wellcart:wellcart/dev-master/badge.png)](https://www.versioneye.com/php/wellcart:wellcart/dev-master)

WellCart is software that implements an php eCommerce / shopping cart system. It's main components are:

* A shop application used by customers to buy your products
* An Administration application to enable you to manage your store
* Many Customization and Extension features - allowing your to customize and extend the way WellCart works

### System Requirements

Platform requires PHP 7.1.0 or later; we recommend using the
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
* Memory_limit no less than 255Mb
* MySQL 5.6 or newer / PostgreSQL/EnterpriseDB 9.1 and above

WellCart tries to be strict standard compliant, including by not limited to:

1. Versioning - [Semantic Versioning Specification](http://semver.org)
2. PHP - [PSR compliant](https://github.com/php-fig/fig-standards), [Zend Framework Coding Standards](http://framework.zend.com/manual/current/en/ref/coding.standard.html)
3. HTML/CSS - [Google HTML/CSS Style Guide](https://google.github.io/styleguide/htmlcssguide.xml)
4. JavaScript - [Google JavaScript Style Guide](https://google.github.io/styleguide/javascriptguide.xml)
5. All code must be strictly compliant to its corresponding standards, no warning/notice messages allowed


Third-party frameworks utilized in this framework:

1. PHP 
    - [Zend Framework](https://github.com/zendframework/zendframework/)
    - [Doctrine ORM](http://www.doctrine-project.org/)
    - [DoctrineDataFixture](https://github.com/Hounddog/DoctrineDataFixtureModule)
    - [ZF-Commons](https://github.com/ZF-Commons/)
    - [AssetManager](https://github.com/RWOverdijk/AssetManager) 
    - [Phinx Migrations](https://phinx.org/) 
    - [AcMailer](https://github.com/acelaya/ZF2-AcMailer)
    - [ZfcDatagrid](https://github.com/ThaDafinser/ZfcDatagrid)
    - [ConLayout](https://github.com/hummer2k/ConLayout)
    - [TckImageResizer](https://github.com/tck/zf2-imageresizer)
    - [TwbBundle](https://github.com/neilime/zf2-twb-bundle)
    - [BitWeb\CronModule](https://github.com/BitWeb/zf2-cron-module)

2. JavaScript - [jQuery](https://github.com/jquery/jquery/)
3. CSS/JS - [Bootstrap 3](https://github.com/twbs/bootstrap/), [JQuery UI](http://jqueryui.com/)

### Installation instructions

WellCart uses [Composer][1] to manage package dependencies, this is the a recommended way to install WellCart.

If you don't have Composer yet, download it following the instructions on http://getcomposer.org/
or just run the following command:

```bash
    curl -s https://getcomposer.org/installer | php
```

- To create your new WellCart project:

```bash
$ composer create-project -sdev wellcart/platform-application path/to/install
```

- Create the database (default name is "wellcart").

- Initialize application with Installation Wizard by opening http://wellcarthost/ in the browser or from CLI:

```bash  
   php bin/wellcart setup --db-driver=<db-driver> --db-host=<db-host> --db-port=<db-port> --db-name=<db-name> --db-username=<db-username> --db-password=<db-password> --admin-email=<admin-email> --admin-password=<admin-password> --admin-first-name=<admin-first-name> --admin-last-name=<admin-last-name> --base-path=<base-path> --website-name=<website-name>
```

Once installed, you can test it out immediately using PHP's built-in web server:

```bash
$ php -S 0.0.0.0:8080 -t public/ public/index.php
```

This will start the cli-server on port 8080, and bind it to all network
interfaces.

**Note:** The built-in CLI server is *for development only*.


## Running Unit Tests

Once testing support is present, you can run the tests using:

```bash
$ ./bin/phpunit
```

If you need to make local modifications for the PHPUnit test setup, copy
`phpunit.xml.dist` to `phpunit.xml` and edit the new file; the latter has
precedence over the former when running tests, and is ignored by version
control. (If you want to make the modifications permanent, edit the
`phpunit.xml.dist` file.)

## Using Vagrant

This skeleton includes a `Vagrantfile` based on ubuntu 16.04 and provide PHP 7.0. Start it up using:

```bash
$ vagrant up
```

Once built, you can also run composer within the box. For example, the following
will install dependencies:

```bash
$ vagrant ssh -c 'composer install'
```

While this will update them:

```bash
$ vagrant ssh -c 'composer update'
```

While running, Vagrant maps your host port 8080 to port 80 on the virtual
machine; you can visit the site at http://localhost:8080/

## Using docker-compose

This skeleton provides a `docker-compose.yml` for use with
[docker-compose](https://docs.docker.com/compose/); it
uses the `Dockerfile` provided as its base. Build and start the image using:

```bash
$ docker-compose up -d
```

At this point, you can visit http://localhost:8080 to see the site running.

You can also run composer from the image. The container environment is named
"wellcart", so you will pass that value to `docker-compose run`:

```bash
$ docker-compose run wellcart composer install
```

## Web server setup

### Apache setup

To setup apache, setup a virtual host to point to the public/ directory of the
project and you should be ready to go! It should look something like below:

```apache
<VirtualHost *:80>
    ServerName wellcart.local
    DocumentRoot /path/to/wellcart/public
    <Directory /path/to/wellcart/public>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
        <IfModule mod_authz_core.c>
        Require all granted
        </IfModule>
    </Directory>
</VirtualHost>
```

### Nginx setup

To setup nginx, open your `/path/to/nginx/nginx.conf` and add an
[include directive](http://nginx.org/en/docs/ngx_core_module.html#include) below
into `http` block if it does not already exist:

```nginx
http {
    # ...
    include sites-enabled/*.conf;
}
```


Create a virtual host configuration file for your project under `/path/to/nginx/sites-enabled/wellcart.local.conf`
it should look something like below:

```nginx
server {
    listen       80;
    server_name  wellcart.local;
    root         /path/to/wellcart/public;

    location / {
        index index.php;
        try_files $uri $uri/ @php;
    }

    location @php {
        # Pass the PHP requests to FastCGI server (php-fpm) on 127.0.0.1:9000
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_param  SCRIPT_FILENAME /path/to/wellcart/public/index.php;
        include fastcgi_params;
    }
}
```

Restart the nginx, now you should be ready to go!

[1]:  http://getcomposer.org/
