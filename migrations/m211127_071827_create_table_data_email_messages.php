<?php

use yii\db\Migration;

class m211127_071827_create_table_data_email_messages extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%email_messages}}',
            [
                'id' => $this->primaryKey(),
                'fk_request' => $this->integer()->comment('Draft Number'),
                'subject' => $this->string(50)->notNull()->comment('Email Subject'),
                'body' => $this->text()->notNull()->comment('Email Body'),
                'from' => $this->string(50)->notNull()->comment('Sent From'),
                'to' => $this->string(50)->notNull()->comment('Sent to'),
                'date_sent' => $this->date()->notNull()->comment('Date Sent'),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'data_email_messages_FK',
            '{{%email_messages}}',
            ['fk_request'],
            '{{%projects}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%email_messages}}');
    }
}
