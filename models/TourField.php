<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tour_field".
 *
 * @property integer $id
 * @property integer $tour_id
 * @property string $name
 * @property string $type
 * @property integer $position
 *
 * @property BookValue[] $bookValues
 * @property Tour $tour
 */
class TourField extends \yii\db\ActiveRecord
{
    public $fieldsType = [
        'number' => 'number',
        'text' => 'text',
    ];
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tour_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tour_id', 'name', 'type'], 'required'],
            [['tour_id', 'position'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['type'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tour_id' => 'Tour ID',
            'name' => 'Name',
            'type' => 'Type',
            'position' => 'Position',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookValues()
    {
        return $this->hasMany(BookValue::className(), ['tour_field_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tour::className(), ['id' => 'tour_id']);
    }    
}
