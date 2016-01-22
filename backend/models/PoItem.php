<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "po_item".
 *
 * @property integer $id
 * @property string $po_item_no
 * @property double $quantity
 * @property integer $po_id
 *
 * @property Po $po
 */
class PoItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'po_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['po_item_no', 'quantity'], 'required'],
            [['quantity'], 'number'],
            [['po_id'], 'integer'],
            [['po_item_no'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'po_item_no' => 'Po Item No',
            'quantity' => 'Quantity',
            'po_id' => 'Po ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPo()
    {
        return $this->hasOne(Po::className(), ['id' => 'po_id']);
    }
}
