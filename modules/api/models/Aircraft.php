<?php

namespace app\modules\api\models;

use Yii;

/**
 * This is the model class for table "aircraft".
 *
 * @property int $id This field will store the AC id
 * @property int $type_id Emergency, VIP, Passenger, or Cargo
 * @property int $size_id Small or Large
 * @property int $state
 * @property string $date
 *
 * @property Size $size
 * @property Type $type
 */
class Aircraft extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'aircraft';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id', 'size_id'], 'required'],
            [['type_id', 'size_id', 'state'], 'integer'],
            [['date'], 'safe'],
            [['size_id'], 'exist', 'skipOnError' => true, 'targetClass' => Size::className(), 'targetAttribute' => ['size_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['type_id', 'size_id'];

        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_id' => 'Type ID',
            'size_id' => 'Size ID',
            'state' => 'State',
            'date' => 'Date',
        ];
    }

    /**
     * Gets query for [[Size]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSize()
    {
        return $this->hasOne(Size::className(), ['id' => 'size_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }
}
