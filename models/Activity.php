<?php
namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Activity
 * @package app\models
 *
 * @property int $id
 * @property string $url
 * @property string $date
 */
class Activity extends ActiveRecord
{
    public static function tableName()
    {
        return 'activities';
    }

    public function rules()
    {
        return [
            [['url', 'date'], 'required'],
            ['date', 'date', 'format' => 'php:Y-m-d'],
        ];
    }
}
