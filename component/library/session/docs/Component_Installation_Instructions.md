### WellCart Session Component Installation Instructions

WellCart uses [Composer][1] to manage package dependencies, this is the a recommended way to install WellCart Session Component.

If you don't have Composer yet, download it following the instructions on http://getcomposer.org/
or just run the following command:

```bash
    curl -s https://getcomposer.org/installer | php
```

- Clone https://github.com/wellcart/component-session.git WellCart Session Component with:

```bash
    git clone https://github.com/wellcart/component-session.git
```
- Install WellCart Session Component dependencies with composer. If installation process seems too slow you can use "--prefer-dist" option.

```bash
    php composer.phar install
```

[1]:  http://getcomposer.org/