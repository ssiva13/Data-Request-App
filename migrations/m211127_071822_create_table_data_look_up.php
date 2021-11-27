<?php

use yii\db\Migration;

class m211127_071822_create_table_data_look_up extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%look_up}}',
            [
                'id' => $this->primaryKey(),
                'type' => $this->string(25)->notNull()->comment('Question Look Up Type'),
                'value' => $this->string(25)->notNull()->comment('Look Up Value'),
                'name' => $this->string(150)->notNull()->comment('Question Value Name/Label'),
                'status' => $this->integer()->notNull()->defaultValue('1')->comment('Status'),
            ],
            $tableOptions
        );
    }

    public function down()
    {
        $this->dropTable('{{%look_up}}');
    }
}
