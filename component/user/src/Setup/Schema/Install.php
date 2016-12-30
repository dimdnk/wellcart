<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\User\Setup\Schema;

use WellCart\Setup\SchemaMigration\AbstractMigration;

/**
 * @codeCoverageIgnore
 */
class Install extends AbstractMigration
{

    public function up()
    {
        $this->table(
            'users',
            [
                'comment' => 'Users',
                'id'      => 'user_id', 'primary_key' => ['user_id']]
        )
            ->addColumn(
                'email',
                'string',
                ['null' => false, 'limit' => 255, 'comment' => 'Email']
            )
            ->addColumn(
                'password',
                'string',
                ['null' => false, 'limit' => 255, 'comment' => 'Password']
            )
            ->addColumn(
                'first_name',
                'string',
                ['null' => false, 'limit' => 255, 'comment' => 'First Name']
            )
            ->addColumn(
                'last_name',
                'string',
                ['null' => false, 'limit' => 255, 'comment' => 'Last Name']
            )
            ->addColumn(
                'email_confirmation_token',
                'string',
                ['null'    => true, 'limit' => 255,
                 'comment' => 'Account Activation Code']
            )
            ->addColumn(
                'password_reset_token',
                'string',
                ['null'    => true, 'limit' => 255,
                 'comment' => 'Password Reset Code']
            )
            ->addColumn(
                'failed_login_count',
                'integer',
                ['null'    => false, 'default' => 0, 'signed' => false,
                 'comment' => 'Failed Login Count']
            )
            ->addColumn(
                'state',
                'integer',
                ['null'    => false, 'signed' => false, 'default' => 0,
                 'comment' => 'User State']
            )
            ->addColumn(
                'language_id',
                'integer',
                ['null' => true, 'default' => null, 'comment' => 'Language ID']
            )
            ->addColumn(
                'time_zone',
                'string',
                ['null'    => true, 'default' => null, 'limit' => 255,
                 'comment' => 'Time Zone']
            )
            ->addColumn(
                'created_at',
                'datetime',
                ['null' => true, 'default' => null, 'comment' => 'Created At']
            )
            ->addColumn(
                'updated_at',
                'datetime',
                ['null' => true, 'default' => null, 'comment' => 'Updated At']
            )
            ->addIndex(
                ['email'],
                ['name' => 'unique_user_email', 'unique' => true]
            )
            ->addIndex(
                ['email_confirmation_token'],
                ['name'   => 'unique_user_email_confirmation_token',
                 'unique' => true]
            )
            ->addIndex(
                ['password_reset_token'],
                ['name' => 'unique_user_password_reset_token', 'unique' => true]
            )
            ->addForeignKey(
                'language_id',
                'base_locale_languages',
                'language_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();


        $this->table(
            'acl_roles',
            [
                'comment' => 'Roles',
                'id'      => 'role_id', 'primary_key' => ['role_id']]
        )
            ->addColumn(
                'name',
                'string',
                ['null' => true, 'limit' => 255, 'comment' => 'Name']
            )
            ->addColumn(
                'description',
                'string',
                ['null' => true, 'limit' => 255, 'comment' => 'Description']
            )
            ->addColumn(
                'parent_id',
                'integer',
                ['null' => true, 'default' => null, 'comment' => 'Parent ID']
            )
            ->addColumn(
                'is_default',
                'boolean',
                ['null' => false, 'default' => false, 'comment' => 'Is Default']
            )
            ->addColumn(
                'is_system',
                'boolean',
                ['null' => false, 'default' => false, 'comment' => 'Is System']
            )
            ->addColumn(
                'created_at',
                'datetime',
                ['null' => true, 'default' => null, 'comment' => 'Crated At']
            )
            ->addColumn(
                'updated_at',
                'datetime',
                ['null' => true, 'default' => null, 'comment' => 'Updated At']
            )
            ->addIndex(
                ['name'],
                ['name' => 'unique_acl_role_name', 'unique' => true]
            )
            ->addForeignKey(
                'parent_id',
                'acl_roles',
                'role_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();


        $this->table(
            'acl_permissions',
            [
                'comment'     => 'ACL Permissions',
                'id'          => 'permission_id',
                'primary_key' => ['permission_id']]
        )
            ->addColumn(
                'name',
                'string',
                ['null' => false, 'limit' => 255, 'comment' => 'Name']
            )
            ->addColumn(
                'description',
                'string',
                ['null' => true, 'limit' => 255, 'comment' => 'Description']
            )
            ->addColumn(
                'is_system',
                'boolean',
                ['null' => false, 'default' => true, 'comment' => 'Is System']
            )
            ->addColumn(
                'created_at',
                'datetime',
                ['null' => false, 'comment' => 'Created At']
            )
            ->addColumn(
                'updated_at',
                'datetime',
                ['null' => true, 'default' => null, 'comment' => 'Updated At']
            )
            ->addIndex(
                ['name'],
                ['name' => 'unique_acl_permission_name', 'unique' => true]
            )
            ->create();


        $this->table(
            'acl_roles_permissions',
            [
                'comment' => 'ACL Rules',
                'id'      => 'rule_id', 'primary_key' => ['rule_id']]
        )
            ->addColumn(
                'role_id',
                'integer',
                ['null' => true, 'default' => null, 'comment' => 'Role ID']
            )
            ->addColumn(
                'permission_id',
                'integer',
                ['null'    => true, 'default' => null,
                 'comment' => 'Permission ID']
            )
            ->addForeignKey(
                'permission_id',
                'acl_permissions',
                'permission_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'role_id',
                'acl_roles',
                'role_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();


        $this->table('acl_user_to_role')
            ->addColumn(
                'user_id',
                'integer',
                ['null' => true, 'default' => null, 'comment' => 'User ID']
            )
            ->addColumn(
                'role_id',
                'integer',
                ['null' => true, 'default' => null, 'comment' => 'Role ID']
            )
            ->addForeignKey(
                'user_id',
                'users',
                'user_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'role_id',
                'acl_roles',
                'role_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();
    }

    public function down()
    {
        $table = $this->table('acl_user_to_role');
        $table->dropForeignKey('role_id');
        $table->dropForeignKey('user_id');
        $table->removeIndex(['role_id']);
        $table->removeIndex(['user_id']);
        $table->drop();

        $table = $this->table('acl_roles_permissions');
        $table->dropForeignKey('role_id');
        $table->dropForeignKey('permission_id');
        $table->removeIndex(['role_id']);
        $table->removeIndex(['permission_id']);
        $table->drop();

        $this->table('acl_permissions')->drop();
        $this->table('acl_roles')->drop();

        $table = $this->table('users');
        $table->dropForeignKey('language_id');
        $table->drop();
    }
}
