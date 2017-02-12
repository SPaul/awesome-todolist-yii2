<?php

use yii\db\Migration;

class m170212_133454_creare_comments_table extends Migration
{
    public function up()
    {
        $this->createTable('comments', [
            'id' => $this->primaryKey(5)->unsigned(),
            'name' => $this->string(100)->notNull(),
            'content' => $this->text()->notNull(),
            'postdate' => $this->timestamp()->notNull(),
            'task_id' => $this->integer(5)->notNull()->unsigned(),
        ]);

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk_task_id',
            'comments',
            'task_id',
            'todolist',
            'id'
        );
    }

    public function down()
    {
        echo "m170212_133454_creare_comments_table cannot be reverted.\n";

        return false;
    }
}
