<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "apikey".
 *
 * @property int $id
 * @property string $key
 */
class Apikey extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apikey';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['key'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ApikeyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ApikeyQuery(get_called_class());
    }
}
