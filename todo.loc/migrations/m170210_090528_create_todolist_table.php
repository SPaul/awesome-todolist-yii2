<?php

use yii\db\Migration;

/**
 * Handles the creation of table `todolist`.
 */
class m170210_090528_create_todolist_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('todolist', [
            'id' => $this->primaryKey(5)->unsigned(),
            'title' => $this->string(100)->notNull(),
            'description' => $this->text()->notNull(),
            'status' => $this->boolean()->defaultValue(false)->notNull(),
            'deadline' => $this->date()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('todolist');
    }
}
