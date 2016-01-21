<?php

use yii\db\Schema;
use yii\db\Migration;

class m160116_210557_create_book extends Migration
{
    public function up()
    {
        $this->createTable('book', [
           'id' => $this->primaryKey(),
           'tour_id' => $this->integer(11)->notNull(),
           'date' => $this->date()->notNull()           
        ]);
        
        $this->addForeignKey('FK2', 'book', 'tour_id',
                            'tour', 'id', $delete = 'CASCADE', $update = 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('book');
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
