<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property int $department_id
 * @property string $created_at
 * @property string $updated_at
 * @property int $status
 *
 * @property Department $department
 * @property Receipt[] $receipts
 */
class Employee extends \yii\db\ActiveRecord
{
    public static function getCurr(){

        $list = array();
    
        $rs = Employee::find()->orderBy("id")->all();
        foreach ($rs as $r){
            if(Yii::$app->user->identity->username === $r->email) {
                $list[$r->id] = $r->first_name . ' ' . $r->last_name;
            }
        }
        return $list;
    }

    public static function getAll(){

        $list = array();
    
        $rs = Employee::find()->orderBy("id")->all();
        foreach ($rs as $r){
            $list[$r->id] = $r->first_name . ' ' . $r->last_name;
        }
        return $list;
    }


    public static $statusList = ['0' => 'Draft', '1' => 'Active', '-1' => 'Arch', ];

    /**
     * Gets statusText.
     *
     * @return string
     */
    public function  getStatusText() 
    {
        return Department::$statusList[$this->status];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'first_name', 'last_name', 'department_id'], 'required'],
            [['department_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['email', 'last_name'], 'string', 'max' => 100],
            [['first_name'], 'string', 'max' => 45],
            [['email'], 'unique'],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'department_id' => 'Department',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }

    /**
     * Gets Name of [[Department]].
     *
     * @return string
     */
    public function getDepartmentName()
    {
        return  $this->department->name;
    }

    /**
     * Gets query for [[Receipts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceipts()
    {
        return $this->hasMany(Receipt::className(), ['employee_id' => 'id']);
    }
}
