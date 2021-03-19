<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "norm".
 *
 * @property int $id
 * @property int $kind_id
 * @property int $department_id
 * @property int $year
 * @property int $month
 * @property float $amount
 * @property string $created_at
 * @property string $updated_at
 * @property int $status
 *
 * @property Department $department
 * @property KindsOfPurchase $kind
 * @property Receipt[] $receipts
 */
class Norm extends \yii\db\ActiveRecord
{
    
    public static function getCurr(){

        $list = array();
        $empl = Employee::find()->where(['email' => Yii::$app->user->identity->username])->one();
    
        $rs = Norm::find()->where(['department_id' => $empl->department_id])->orderBy("id")->all();
        foreach ($rs as $r){
            $list[$r->id] = $r->kindName . ': '. $r->amount . ' (' . $r->year . '/' . $r->month . ')';
        }
        return $list;
    }

    public static function getAll(){

        $list = array();
    
        $rs = Norm::find()->orderBy("id")->all();
        foreach ($rs as $r){
    
            $list[$r->id] = $r->kindName . ': '. $r->amount . ' (' . $r->year . '/' . $r->month . ')';
    
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
        return Norm::$statusList[$this->status];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'norm';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kind_id', 'department_id', 'year', 'month', 'amount'], 'required'],
            [['kind_id', 'department_id', 'year', 'month', 'status'], 'integer'],
            [['amount'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['year', 'month', 'kind_id', 'department_id'], 'unique', 'targetAttribute' => ['year', 'month', 'kind_id', 'department_id']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
            [['kind_id'], 'exist', 'skipOnError' => true, 'targetClass' => KindsOfPurchase::className(), 'targetAttribute' => ['kind_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kind_id' => 'Kind',
            'department_id' => 'Department',
            'year' => 'Year',
            'month' => 'Month',
            'amount' => 'Amount',
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
     * Gets query for [[Kind]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKind()
    {
        return $this->hasOne(KindsOfPurchase::className(), ['id' => 'kind_id']);
    }

    /**
     * Gets query for [[Receipts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReceipts()
    {
        return $this->hasMany(Receipt::className(), ['norm_id' => 'id']);
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
     * Gets Name of [[Kind]].
     *
     * @return string
     */
    public function getKindName()
    {
        return  $this->kind->name;
    }
}
