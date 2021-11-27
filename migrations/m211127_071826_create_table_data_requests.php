<?php

use yii\db\Migration;

class m211127_071826_create_table_data_requests extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%requests}}',
            [
                'id' => $this->primaryKey()->comment('ID'),
                'fk_project' => $this->integer()->notNull()->comment('Project Name'),
                'primary_contact' => $this->integer()->notNull()->comment('Primary Contact Name'),
                'data_variables' => $this->text()->comment('Data Variables'),
                'data_crfs' => $this->text()->comment('Data CRFs Used'),
                'data_sites' => $this->string(200)->comment('Data Sites'),
                'variable_justification' => $this->text()->comment('Data Variables Justifications'),
                'date_from' => $this->date()->comment('Date From'),
                'date_to' => $this->date()->comment('Date To'),
                'date_received' => $this->date()->comment('Date Recieved'),
                'date_created' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('Date Created'),
                'date_modified' => $this->dateTime()->comment('Date Modified'),
                'fk_user' => $this->integer()->notNull()->comment('User ID'),
                'status' => $this->integer()->notNull()->defaultValue('1'),
                'review_notes' => $this->text()->comment('Review Notes'),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'data_requests_FK',
            '{{%requests}}',
            ['fk_project'],
            '{{%projects}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'data_requests_FK_1',
            '{{%requests}}',
            ['primary_contact'],
            '{{%users}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'data_requests_FK_2',
            '{{%requests}}',
            ['fk_user'],
            '{{%users}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%requests}}');
    }
}
