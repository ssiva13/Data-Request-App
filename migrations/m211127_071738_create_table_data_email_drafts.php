<?php

use yii\db\Migration;

class m211127_071738_create_table_data_email_drafts extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%email_drafts}}',
            [
                'id' => $this->primaryKey(),
                'type' => $this->string(25)->notNull()->comment('Draft Type'),
                'subject' => $this->string(50)->notNull()->comment('Email Subject'),
                'body' => $this->text()->notNull()->comment('Email Body'),
                'status' => $this->integer()->notNull()->defaultValue('1')->comment('Request Status'),
            ],
            $tableOptions
        );
    }

    public function down()
    {
        $this->dropTable('{{%email_drafts}}');
    }
}
