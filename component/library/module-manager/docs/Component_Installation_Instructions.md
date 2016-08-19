### WellCart Module Manager Component Installation Instructions

WellCart uses [Composer][1] to manage package dependencies, this is the a recommended way to install WellCart Module Manager Component.

If you don't have Composer yet, download it following the instructions on http://getcomposer.org/
or just run the following command:

```bash
    curl -s https://getcomposer.org/installer | php
```

- Clone https://github.com/wellcart/component-module-manager.git WellCart Module Manager Component with:

```bash
    git clone https://github.com/wellcart/component-module-manager.git
```
- Install WellCart Module Manager Component dependencies with composer. If installation process seems too slow you can use "--prefer-dist" option.

```bash
    php composer.phar install
```

[1]:  http://getcomposer.org/