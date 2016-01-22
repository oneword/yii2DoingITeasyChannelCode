<?php

namespace backend\modules\settings\models;

use Yii;

/**
 * This is the model class for table "companies".
 *
 * @property integer $company_id
 * @property string $company_start_date
 * @property string $company_name
 * @property string $company_email
 * @property string $company_address
 * @property string $company_created_date
 * @property string $company_status
 *
 * @property Branches[] $branches
 * @property Departments[] $departments
 */
class Companies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'companies';
    }

    /**
     * @inheritdoc
     */
    public function rules(){
        return [
            [['company_start_date', 'company_name', 'company_email', 'company_address', 'company_created_date', 'company_status'], 'required'],
            [['company_start_date', 'company_created_date'], 'safe'],
            ['company_start_date','checkDate'],
            [['company_status'], 'string'],
            [['company_name', 'company_email', 'company_address'], 'string', 'max' => 100]
        ];
    }
    
    
    
    
    public function checkDate($attribute,$params){
        $today=date('Y-m-d');
        $selectedDate=date($this->company_start_date);
        
        if ($selectedDate > $today){
            $this->addError($attribute,'Company Start Date must be smaller');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'company_id' => 'Company ID',
            'company_start_date' => 'Company Start Date',
            'company_name' => 'Company Name',
            'company_email' => 'Company Email',
            'company_address' => 'Company Address',
            'company_created_date' => 'Company Created Date',
            'company_status' => 'Company Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranches()
    {
        return $this->hasMany(Branches::className(), ['companies_company_id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Departments::className(), ['companies_company_id' => 'company_id']);
    }
}
