<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\Admin\Setup\Schema;

use WellCart\Setup\SchemaMigration\AbstractMigration;

/**
 * @codeCoverageIgnore
 */
class Install extends AbstractMigration
{

    public function up()
    {
        $this->table(
            'admin_users',
            [
                'comment' => 'Administrators',
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
                ['name' => 'unique_admin_user_email', 'unique' => true]
            )
            ->addIndex(
                ['email_confirmation_token'],
                ['name'   => 'unique_admin_email_confirmation_token',
                 'unique' => true]
            )
            ->addIndex(
                ['password_reset_token'],
                ['name'   => 'unique_admin_password_reset_token',
                 'unique' => true]
            )
            ->addForeignKey(
                'language_id',
                'base_locale_languages',
                'language_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();


        $this->table('acl_admin_user_to_role')
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
                'admin_users',
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

        $this->table(
            'admin_notifications',
            [
                'comment'     => 'Admin Notifications',
                'id'          => 'notification_id',
                'primary_key' => ['notification_id']]
        )
            ->addColumn(
                'icon',
                'string',
                ['null' => true, 'limit' => 50, 'comment' => 'Message Icon']
            )
            ->addColumn(
                'title',
                'string',
                ['null' => false, 'limit' => 255, 'comment' => 'Title']
            )
            ->addColumn(
                'body',
                'text',
                ['null' => true, 'comment' => 'Message Body']
            )
            ->addColumn(
                'is_read',
                'boolean',
                ['null'    => false, 'default' => false, 'signed' => false,
                 'comment' => 'Is message read']
            )
            ->addColumn(
                'is_deleted',
                'boolean',
                ['null'    => false, 'default' => false, 'signed' => false,
                 'comment' => 'Is message deleted']
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
            ->addColumn(
                'deleted_at',
                'datetime',
                ['null' => true, 'default' => null, 'comment' => 'Deleted At']
            )
            ->create();
    }

    public function down()
    {
        $this->table('admin_notifications')->drop();

        $table = $this->table('acl_admin_user_to_role');
        $table->dropForeignKey('role_id');
        $table->dropForeignKey('user_id');
        $table->removeIndex(['role_id']);
        $table->removeIndex(['user_id']);
        $table->drop();

        $table = $this->table('admin_users');
        $table->dropForeignKey('language_id');
        $table->drop();
    }
}
