<?php

use yii\db\Migration;

class m211127_071823_create_table_data_users extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%users}}',
            [
                'id' => $this->primaryKey()->comment('ID'),
                'first_name' => $this->string(20)->notNull()->comment('First Name'),
                'last_name' => $this->string(20)->notNull()->comment('Last Name'),
                'email' => $this->string(50)->notNull()->comment('User Email'),
                'phone' => $this->integer()->comment('Phone Number'),
                'date_created' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('Date Created'),
                'date_modified' => $this->dateTime()->comment('Date Modified'),
                'password' => $this->string()->notNull()->comment('Password'),
                'auth_key' => $this->string()->notNull()->comment('Auth Key'),
                'username' => $this->string(15)->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('data_users_UN', '{{%users}}', ['email'], true);
        $this->createIndex('data_users_UN1', '{{%users}}', ['username'], true);
    }

    public function down()
    {
        $this->dropTable('{{%users}}');
    }
}
