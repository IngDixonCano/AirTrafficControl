<?php

namespace app\modules\api\models;

use Yii;

/**
 * This is the model class for table "size".
 *
 * @property int $id
 * @property string $name
 *
 * @property Aircraft[] $aircrafts
 */
class Size extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'size';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Aircrafts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAircrafts()
    {
        return $this->hasMany(Aircraft::className(), ['size_id' => 'id']);
    }
}
