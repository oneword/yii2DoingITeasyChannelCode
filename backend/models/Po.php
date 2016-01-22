<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "po".
 *
 * @property integer $id
 * @property string $po_no
 * @property string $description
 *
 * @property PoItem[] $poItems
 */
class Po extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'po';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['po_no', 'description'], 'required'],
            [['po_no', 'description'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'po_no' => 'Po No',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPoItems()
    {
        return $this->hasMany(PoItem::className(), ['po_id' => 'id']);
    }
}
