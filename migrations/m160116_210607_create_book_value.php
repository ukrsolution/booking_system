<?php

use yii\db\Schema;
use yii\db\Migration;

class m160116_210607_create_book_value extends Migration
{
    public function up()
    {
        $this->createTable('book_value', [
           'book_id' => $this->integer(11)->notNull(),
           'tour_field_id' => $this->integer(11)->notNull(),
           'value' => $this->string(50)->notNull()           
        ]);
        
        $this->addForeignKey('FK3', 'book_value', 'book_id',
                            'book', 'id', $delete = 'CASCADE', $update = 'CASCADE');
        $this->addForeignKey('FK4', 'book_value', 'tour_field_id',
                            'tour_field', 'id', $delete = 'CASCADE', $update = 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('book_value');
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
