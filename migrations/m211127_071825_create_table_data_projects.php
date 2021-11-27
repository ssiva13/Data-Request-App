<?php

use yii\db\Migration;

class m211127_071825_create_table_data_projects extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%projects}}',
            [
                'id' => $this->primaryKey()->comment('ID'),
                'project_name' => $this->string(75)->notNull()->comment('Project Name'),
                'primary_contact' => $this->integer()->notNull()->comment('Primary Contact'),
                'project_aim' => $this->text()->notNull()->comment('Project Aim'),
                'data_type' => $this->string(150)->comment('Type of Data Options'),
                'proposal_type' => $this->string(30)->comment('Type of Proposal Options'),
                'irb_approved' => $this->string(5)->comment('Approved by IRB (yes or no)'),
                'irb_approvers' => $this->string(20)->comment('IRB Approvers Options'),
                'statistical_file' => $this->string(200)->comment('Statistical File Name'),
                'target_date' => $this->date()->comment('Target Completion Date'),
                'milestones' => $this->text()->comment('Project Milestones'),
                'fk_user' => $this->integer()->notNull()->comment('User ID'),
                'date_created' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('Date Created'),
                'date_modified' => $this->dateTime()->comment('Date Modified'),
            ],
            $tableOptions
        );

        $this->addForeignKey(
            'data_projects_FK',
            '{{%projects}}',
            ['fk_user'],
            '{{%users}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
        $this->addForeignKey(
            'data_projects_FK_1',
            '{{%projects}}',
            ['primary_contact'],
            '{{%users}}',
            ['id'],
            'NO ACTION',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropTable('{{%projects}}');
    }
}
