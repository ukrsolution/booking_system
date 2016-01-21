<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "book_value".
 *
 * @property integer $book_id
 * @property integer $tour_field_id
 * @property string $value
 *
 * @property Book $book
 * @property TourField $tourField
 */
class BookValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_id', 'tour_field_id', 'value'], 'required'],
            [['book_id', 'tour_field_id'], 'integer'],
            [['value'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'book_id' => 'Book ID',
            'tour_field_id' => 'Tour Field ID',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourField()
    {
        return $this->hasOne(TourField::className(), ['id' => 'tour_field_id']);
    }
}
