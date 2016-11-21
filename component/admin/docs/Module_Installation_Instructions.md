### WellCart Admin Installation Instructions

WellCart uses [Composer][1] to manage package dependencies, this is the a recommended way to install WellCart Admin.

If you don't have Composer yet, download it following the instructions on http://getcomposer.org/
or just run the following command:

```bash
    curl -s https://getcomposer.org/installer | php
```

- Clone https://github.com/wellcart/component-admin.git WellCart Admin with:

```bash
    git clone https://github.com/wellcart/component-admin.git
```
- Install WellCart Admin dependencies with composer. If installation process seems too slow you can use "--prefer-dist" option.

```bash
    php composer.phar install
```

- Initialize application with Installation Wizard from CLI:

```bash  
    php bin/wellcart setup --db-driver=<db-driver> --db-host=<db-host> --db-port=<db-port> --db-name=<db-name> --db-username=<db-username> --db-password=<db-password> --admin-email=<admin-email> --admin-password=<admin-password> --admin-first-name=<admin-first-name> --admin-last-name=<admin-last-name> --base-path=<base-path> --website-name=<website-name>
```

[1]:  http://getcomposer.org/