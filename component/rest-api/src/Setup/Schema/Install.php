<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

declare(strict_types = 1);

namespace WellCart\RestApi\Setup\Schema;

use WellCart\Setup\SchemaMigration\AbstractMigration;

/**
 * @codeCoverageIgnore
 */
class Install extends AbstractMigration
{

    public function up()
    {
        $this->table(
            'oauth2_clients',
            [
                'comment' => 'OAuth2 Clients',
                'id'      => 'id', 'primary_key' => ['id']]
        )
            ->addColumn(
                'user_id',
                'integer',
                ['null' => true, 'default' => null]
            )
            ->addColumn(
                'client_id',
                'string',
                ['null' => true, 'limit' => 255]
            )
            ->addColumn(
                'secret',
                'string',
                ['null' => true, 'limit' => 255]
            )
            ->addColumn(
                'redirect_uri',
                'text',
                ['null' => true, 'default' => null]
            )
            ->addColumn(
                'grant_type',
                'text',
                ['null' => true, 'default' => null]
            )
            ->addForeignKey(
                'user_id',
                'users',
                'user_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addIndex(
                ['client_id'],
                ['name' => 'unique_oauth2_clients_client_id', 'unique' => true]
            )
            ->create();

        $this->table(
            'oauth2_access_tokens',
            [
                'comment' => 'OAuth2 Access Tokens',
                'id'      => 'id', 'primary_key' => ['id']]
        )
            ->addColumn(
                'client_id',
                'integer',
                ['null' => true, 'default' => null]
            )
            ->addColumn(
                'user_id',
                'integer',
                ['null' => true, 'default' => null]
            )
            ->addColumn(
                'access_token',
                'text',
                ['null' => true, 'default' => null]
            )
            ->addColumn(
                'expires',
                'datetime',
                ['null' => true, 'default' => null]
            )
            ->addForeignKey(
                'client_id',
                'oauth2_clients',
                'id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'user_id',
                'users',
                'user_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();

        $this->table(
            'oauth2_authorization_codes',
            [
                'comment' => 'OAuth2 Authorization Codes',
                'id'      => 'id', 'primary_key' => ['id']]
        )
            ->addColumn(
                'client_id',
                'integer',
                ['null' => true, 'default' => null]
            )
            ->addColumn(
                'user_id',
                'integer',
                ['null' => true, 'default' => null]
            )
            ->addColumn(
                'authorization_code',
                'text',
                ['null' => true, 'default' => null]
            )
            ->addColumn(
                'redirect_uri',
                'text',
                ['null' => true, 'default' => null]
            )
            ->addColumn(
                'expires',
                'datetime',
                ['null' => true, 'default' => null]
            )
            ->addColumn(
                'id_token',
                'text',
                ['null' => true, 'default' => null]
            )
            ->addForeignKey(
                'client_id',
                'oauth2_clients',
                'id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'user_id',
                'users',
                'user_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();


        $this->table(
            'oauth2_jti',
            [
                'comment' => 'OAuth2 JTI',
                'id'      => 'id', 'primary_key' => ['id']]
        )
            ->addColumn(
                'client_id',
                'integer',
                ['null' => true, 'default' => null]
            )
            ->addColumn(
                'subject',
                'string',
                ['null' => true, 'limit' => 255]
            )
            ->addColumn(
                'audience',
                'string',
                ['null' => true, 'limit' => 255]
            )
            ->addColumn(
                'expires',
                'datetime',
                ['null' => true, 'default' => null]
            )
            ->addColumn(
                'jti',
                'text',
                ['null' => true, 'default' => null]
            )
            ->addForeignKey(
                'client_id',
                'oauth2_clients',
                'id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();

        $this->table(
            'oauth2_jwt',
            [
                'comment' => 'OAuth2 JWT',
                'id'      => 'id', 'primary_key' => ['id']]
        )
            ->addColumn(
                'client_id',
                'integer',
                ['null' => true, 'default' => null]
            )
            ->addColumn(
                'subject',
                'string',
                ['null' => true, 'limit' => 255]
            )
            ->addColumn(
                'public_key',
                'text',
                ['null' => true, 'default' => null]
            )
            ->addForeignKey(
                'client_id',
                'oauth2_clients',
                'id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();

        $this->table(
            'oauth2_public_keys',
            [
                'comment' => 'OAuth2 Public Keys',
                'id'      => 'id', 'primary_key' => ['id']]
        )
            ->addColumn(
                'client_id',
                'integer',
                ['null' => true, 'default' => null]
            )
            ->addColumn(
                'public_key',
                'text',
                ['null' => true, 'default' => null]
            )
            ->addColumn(
                'private_key',
                'text',
                ['null' => true, 'default' => null]
            )
            ->addColumn(
                'encryption_algorithm',
                'string',
                ['null' => true, 'limit' => 255]
            )
            ->addIndex(
                ['client_id'],
                ['name'   => 'unique_oauth2_public_keys_client_id',
                 'unique' => true]
            )
            ->addForeignKey(
                'client_id',
                'oauth2_clients',
                'id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();

        $this->table(
            'oauth2_refresh_tokens',
            [
                'comment' => 'Refresh Tokens',
                'id'      => 'id', 'primary_key' => ['id']]
        )
            ->addColumn(
                'client_id',
                'integer',
                ['null' => true, 'default' => null]
            )
            ->addColumn(
                'user_id',
                'integer',
                ['null' => true, 'default' => null]
            )
            ->addColumn(
                'refresh_token',
                'string',
                ['null' => true, 'limit' => 255]
            )
            ->addColumn(
                'expires',
                'datetime',
                ['null' => true, 'default' => null]
            )
            ->addColumn(
                'grantType',
                'text',
                ['null' => true, 'default' => null]
            )
            ->addForeignKey(
                'user_id',
                'users',
                'user_id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();

        $this->table(
            'oauth2_scopes',
            [
                'comment' => 'OAuth2 Scopes',
                'id'      => 'id', 'primary_key' => ['id']]
        )
            ->addColumn(
                'scope',
                'string',
                ['null' => true, 'default' => null, 'limit' => 255]
            )
            ->addColumn(
                'is_default',
                'boolean',
                ['null' => true, 'default' => null]
            )
            ->addIndex(
                ['scope'],
                ['name' => 'unique_oauth2_scopes_scope', 'unique' => true]
            )
            ->create();

        $this->table(
            'oauth2_client_to_scope',
            [
                'comment'     => 'Client to Scope mapping',
                'id'          => false,
                'primary_key' => ['scope_id', 'client_id']
            ]
        )
            ->addColumn(
                'scope_id',
                'integer',
                ['null' => false, 'comment' => 'Scope ID']
            )
            ->addColumn(
                'client_id',
                'integer',
                ['null' => false, 'comment' => 'Client ID']
            )
            ->addForeignKey(
                'scope_id',
                'oauth2_scopes',
                'id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'client_id',
                'oauth2_clients',
                'id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();


        $this->table(
            'oauth2_authorization_code_to_scope',
            [
                'comment'     => 'Authorization Code to Scope mapping',
                'id'          => false,
                'primary_key' => ['scope_id', 'auth_code_id']
            ]
        )
            ->addColumn(
                'scope_id',
                'integer',
                ['null' => false, 'comment' => 'Scope ID']
            )
            ->addColumn(
                'auth_code_id',
                'integer',
                ['null' => false, 'comment' => 'Auth Code ID']
            )
            ->addForeignKey(
                'scope_id',
                'oauth2_scopes',
                'id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'auth_code_id',
                'oauth2_authorization_codes',
                'id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();


        $this->table(
            'oauth2_refresh_token_to_scope',
            [
                'comment'     => 'Refresh Token to Scope mapping',
                'id'          => false,
                'primary_key' => ['scope_id', 'refresh_token_id']
            ]
        )
            ->addColumn(
                'scope_id',
                'integer',
                ['null' => false, 'comment' => 'Scope ID']
            )
            ->addColumn(
                'refresh_token_id',
                'integer',
                ['null' => false, 'comment' => 'Refresh Token ID']
            )
            ->addForeignKey(
                'scope_id',
                'oauth2_scopes',
                'id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'refresh_token_id',
                'oauth2_refresh_tokens',
                'id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();

        $this->table(
            'oauth2_access_token_to_scope',
            [
                'comment'     => 'Refresh Token to Scope mapping',
                'id'          => false,
                'primary_key' => ['scope_id', 'refresh_token_id']
            ]
        )
            ->addColumn(
                'scope_id',
                'integer',
                ['null' => false, 'comment' => 'Scope ID']
            )
            ->addColumn(
                'refresh_token_id',
                'integer',
                ['null' => false, 'comment' => 'Refresh Token ID']
            )
            ->addForeignKey(
                'scope_id',
                'oauth2_scopes',
                'id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'refresh_token_id',
                'oauth2_refresh_tokens',
                'id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->create();

        $this->table('users')
            ->addColumn(
                'oauth_client_id',
                'integer',
                ['null'    => true, 'default' => null,
                 'comment' => 'OAuth2 Client ID']
            )
            ->addColumn(
                'oauth_access_token_id',
                'integer',
                ['null'    => true, 'default' => null,
                 'comment' => 'OAuth2 Access Token ID']
            )
            ->addColumn(
                'oauth_authorization_code_id',
                'integer',
                ['null'    => true, 'default' => null,
                 'comment' => 'OAuth2 Authorization Code ID']
            )
            ->addColumn(
                'oauth_refresh_token_id',
                'integer',
                ['null'    => true, 'default' => null,
                 'comment' => 'OAuth2 Refresh Token ID']
            )
            ->addForeignKey(
                'oauth_client_id',
                'oauth2_clients',
                'id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'oauth_access_token_id',
                'oauth2_access_tokens',
                'id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'oauth_authorization_code_id',
                'oauth2_authorization_codes',
                'id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->addForeignKey(
                'oauth_refresh_token_id',
                'oauth2_refresh_tokens',
                'id',
                ['delete' => 'CASCADE', 'update' => 'CASCADE']
            )
            ->save();
    }

    public function down()
    {
        $table = $this->table('users');
        $table->dropForeignKey('oauth_client_id');
        $table->dropForeignKey('oauth_access_token_id');
        $table->dropForeignKey('oauth_authorization_code_id');
        $table->dropForeignKey('oauth_refresh_token_id');
        $table->removeColumn('oauth_client_id');
        $table->removeColumn('oauth_access_token_id');
        $table->removeColumn('oauth_authorization_code_id');
        $table->removeColumn('oauth_refresh_token_id');
        $table->save();

        $this->table('oauth2_access_token_to_scope')
            ->dropForeignKey('scope_id')
            ->dropForeignKey('refresh_token_id')
            ->drop();

        $this->table('oauth2_refresh_token_to_scope')
            ->dropForeignKey('scope_id')
            ->dropForeignKey('refresh_token_id')
            ->drop();

        $this->table('oauth2_authorization_code_to_scope')
            ->dropForeignKey('scope_id')
            ->dropForeignKey('auth_code_id')
            ->drop();

        $this->table('oauth2_client_to_scope')
            ->dropForeignKey('scope_id')
            ->dropForeignKey('client_id')
            ->drop();

        $this->table('oauth2_scopes')
            ->drop();

        $this->table('oauth2_refresh_tokens')
            ->dropForeignKey('user_id')
            ->drop();

        $this->table('oauth2_public_keys')
            ->dropForeignKey('client_id')
            ->drop();

        $this->table('oauth2_jwt')
            ->dropForeignKey('client_id')
            ->drop();

        $this->table('oauth2_jti')
            ->dropForeignKey('client_id')
            ->drop();

        $this->table('oauth2_authorization_codes')
            ->dropForeignKey('client_id')
            ->dropForeignKey('user_id')
            ->drop();

        $this->table('oauth2_access_tokens')
            ->dropForeignKey('client_id')
            ->dropForeignKey('user_id')
            ->drop();

        $this->table('oauth2_clients')
            ->dropForeignKey('user_id')
            ->drop();
    }
}
