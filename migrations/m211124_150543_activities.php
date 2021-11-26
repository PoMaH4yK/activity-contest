<?php

use yii\db\Migration;

/**
 * Class m211124_150543_activities
 */
class m211124_150543_activities extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(\app\models\Activity::tableName(), [
            'id' => $this->primaryKey(),
            'url' => $this->string(),
            'date' => $this->date()
        ]);

        $this->createIndex('url', \app\models\Activity::tableName(), 'url');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(\app\models\Activity::tableName());
    }
}
