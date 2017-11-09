### WellCart Internationalization Component Installation Instructions

WellCart uses [Composer][1] to manage package dependencies, this is the a recommended way to install WellCart I18n Component.

If you don't have Composer yet, download it following the instructions on http://getcomposer.org/
or just run the following command:

```bash
    curl -s https://getcomposer.org/installer | php
```

- Clone https://github.com/wellcart/component-i18n.git WellCart internationalization Component with:

```bash
    git clone https://github.com/wellcart/component-i18n.git
```
- Install WellCart I18n Component dependencies with composer. If installation process seems too slow you can use "--prefer-dist" option.

```bash
    php composer.phar install
```

[1]:  http://getcomposer.org/