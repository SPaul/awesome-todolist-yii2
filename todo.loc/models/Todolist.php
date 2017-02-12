<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "todolist".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property integer $status
 * @property string $deadline
 */
class Todolist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'todolist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['id', 'title', 'description', 'status', 'deadline'], 'required'],
            [['title', 'description', 'deadline'], 'required'],
            // [['id', 'status'], 'integer'],
            [['description'], 'string'],
            [['deadline'], 'safe'],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'status' => 'Status',
            'deadline' => 'Deadline',
        ];
    }

    /**
     * getting related data from comments table
     */
    public function getComments(){
        return $this->hasMany(Comments::className(), ['task_id' => 'id']);
    }
}
