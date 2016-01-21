<?php

use yii\db\Schema;
use yii\db\Migration;

class m160116_210512_create_tour extends Migration
{
    public function up()
    {
        $this->createTable('tour', [
           'id' => $this->primaryKey(),
           'title' => $this->string(50)->notNull()
        ]);
    }

    public function down()
    {
        $this->dropTable('tour');
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
