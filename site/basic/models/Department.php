<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property int $id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property int $status
 *
 * @property Employee[] $employees
 * @property Norm[] $norms
 */
class Department extends \yii\db\ActiveRecord
{
    public static function getAll(){

        $list = array();
    
        $rs = Department::find()->orderBy("id")->all();
        foreach ($rs as $r){
    
            $list[$r->id] = $r->name;
    
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
        return 'department';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 45],
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Employees]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['department_id' => 'id']);
    }

    /**
     * Gets query for [[Norms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNorms()
    {
        return $this->hasMany(Norm::className(), ['department_id' => 'id']);
    }
}
