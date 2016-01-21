<?php

use yii\db\Schema;
use yii\db\Migration;

class m160116_210535_create_tour_field extends Migration
{
    public function up()
    {
        $this->createTable('tour_field', [
           'id' => $this->primaryKey(),
           'tour_id' => $this->integer(11)->notNull(),
           'name' => $this->string(50)->notNull(),
           'type' => $this->string(20)->notNull(),
           'position' => $this->integer(8)
        ]);
        
        $this->addForeignKey('FK1', 'tour_field', 'tour_id',
                            'tour', 'id', $delete = 'CASCADE', $update = 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('tour_field');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
