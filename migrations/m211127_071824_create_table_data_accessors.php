<?php

use yii\db\Migration;

class m211127_071824_create_table_data_accessors extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%accessors}}',
            [
                'id' => $this->primaryKey(),
                'fk_user' => $this->integer()->comment('User ID'),
                'name' => $this->string(60)->notNull()->comment('Name'),
                'email' => $this->string(50)->comment('Email Address'),
                'role' => $this->string(50)->notNull()->comment('User Role Options'),
                'affiliation' => $this->string(50)->comment('User Affiliation Options'),
                'date_created' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('Date Created'),
                'date_modified' => $this->dateTime()->comment('Date Modified'),
                'fk_request' => $this->integer()->notNull()->comment('Request ID'),
            ],
            $tableOptions
        );
    }

    public function down()
    {
        $this->dropTable('{{%accessors}}');
    }
}
