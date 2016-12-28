#!/usr/bin/env bash

#set -e
set -x

CURRENT_BRANCH=`git name-rev --name-only HEAD`
sleep 3

function split()
{
    git subtree push --prefix=$1 $2 $CURRENT_BRANCH
    sleep 2
}

function remote()
{
    git remote add $1 $2
}

remote component-utility git@github.com:wellcart/component-utility.git
remote component-mapping-drivers git@github.com:wellcart/component-mapping-drivers.git

remote component-console git@github.com:wellcart/component-console.git
remote component-db git@github.com:wellcart/component-db.git
remote component-filter git@github.com:wellcart/component-filter.git
remote component-form git@github.com:wellcart/component-form.git
remote component-hydrator git@github.com:wellcart/component-hydrator.git
remote component-input-filter git@github.com:wellcart/component-input-filter.git
remote component-log git@github.com:wellcart/component-log.git
remote component-module-manager git@github.com:wellcart/component-module-manager.git
remote component-mvc git@github.com:wellcart/component-mvc.git
remote component-navigation git@github.com:wellcart/component-navigation.git
remote component-orm git@github.com:wellcart/component-orm.git
remote component-router git@github.com:wellcart/component-router.git
remote component-service-manager git@github.com:wellcart/component-service-manager.git
remote component-session git@github.com:wellcart/component-session.git
remote component-stdlib git@github.com:wellcart/component-stdlib.git
remote component-test git@github.com:wellcart/component-test.git
remote component-ui git@github.com:wellcart/component-ui.git
remote component-validator git@github.com:wellcart/component-validator.git
remote component-view git@github.com:wellcart/component-view.git

remote component-metapackage git@github.com:wellcart/component-library.git

remote component-base git@github.com:wellcart/component-base.git
remote component-schema-migration git@github.com:wellcart/component-schema-migration.git
remote component-command-bus git@github.com:wellcart/component-command-bus.git
remote component-setup git@github.com:wellcart/component-setup.git
remote component-user git@github.com:wellcart/component-user.git
remote component-backend git@github.com:wellcart/component-backend.git
remote component-rest-api git@github.com:wellcart/component-rest-api.git
remote theme-frontend-ui git@github.com:wellcart/theme-frontend-ui.git
remote theme-setup-ui git@github.com:wellcart/theme-setup-ui.git
remote theme-backend-ui git@github.com:wellcart/theme-backend-ui.git

remote module-directory git@github.com:wellcart/module-directory.git
remote module-cms git@github.com:wellcart/module-cms.git
remote module-catalog git@github.com:wellcart/module-catalog.git

split 'component/utility' component-utility
split 'component/mapping-drivers' component-mapping-drivers

split 'component/library/console' component-console
split 'component/library/db' component-db
split 'component/library/filter' component-filter
split 'component/library/form' component-form
split 'component/library/hydrator' component-hydrator
split 'component/library/input-filter' component-input-filter
split 'component/library/log' component-log
split 'component/library/module-manager' component-module-manager
split 'component/library/mvc' component-mvc
split 'component/library/navigation' component-navigation
split 'component/library/orm' component-orm
split 'component/library/router' component-router
split 'component/library/service-manager' component-service-manager
split 'component/library/session' component-session
split 'component/library/stdlib' component-stdlib
split 'component/library/test' component-test
split 'component/library/ui' component-ui
split 'component/library/validator' component-validator
split 'component/library/view' component-view
split 'component/metapackage' component-metapackage

split 'component/base' component-base
split 'component/schema-migration' component-schema-migration
split 'component/command-bus' component-command-bus
split 'component/setup' component-setup
split 'component/user' component-user
split 'component/backend' component-backend
split 'component/rest-api' component-rest-api
split 'theme/frontend-ui' theme-frontend-ui
split 'theme/setup-ui' theme-setup-ui
split 'theme/backend-ui' theme-backend-ui
split 'module/directory' module-directory
split 'module/cms' module-cms
split 'module/catalog' module-catalog