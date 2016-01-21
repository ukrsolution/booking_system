<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tour".
 *
 * @property integer $id
 * @property string $title
 *
 * @property Book[] $books
 * @property TourField[] $tourFields
 */
class Tour extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tour';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 50]
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['tour_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourFields()
    {
        return $this->hasMany(TourField::className(), ['tour_id' => 'id']);
    }
    
    public function createDefaultFields($tourID) {
        $defaultFields = [
            ['name' => 'Adults',    'type' => 'number',     'position' => '10'],
            ['name' => 'Children',  'type' => 'number',     'position' => '20'],
            ['name' => 'Babies',    'type' => 'number',     'position' => '30'],
        ];
        
        $ok = true;
        foreach ($defaultFields as $field) {
            $tourField = new \app\models\TourField();
            $tourField->attributes = [
                                      'tour_id'     => $tourID,
                                      'name'        => $field['name'],
                                      'type'        => $field['type'],
                                      'position'    => $field['position']
                                     ];
            $ok = $ok && $tourField->save();
        }
        
        return $ok;
    }
        
    static function validateReservationData($BookValues, $ValuesType) {
        $ok = true;
        foreach ($BookValues as $key => $value) {
            if ($ValuesType[$key] == 'number'){
                $validator = new \yii\validators\NumberValidator();
                $ok = $ok && $validator->validate($value);
            } elseif ($ValuesType[$key] == 'text') {
                $validator = new \yii\validators\StringValidator();
                $ok = $ok && $validator->validate($value);
            } else {
                $ok = false;
            }
        }
        return $ok;
    }
}
