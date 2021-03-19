<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "receipt".
 *
 * @property int $id
 * @property int $norm_id
 * @property int $employee_id
 * @property string $date
 * @property float $amount
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property int $status
 *
 * @property Employee $employee
 * @property Norm $norm
 */
class Receipt extends \yii\db\ActiveRecord
{
    public static $statusList = ['0' => 'Draft', '1' => 'Active', '-1' => 'Arch', ];

    /**
     * Gets statusText.
     *
     * @return string
     */
    public function  getStatusText() 
    {
        return Receipt::$statusList[$this->status];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'receipt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['norm_id', 'employee_id', 'amount', 'description'], 'required'],
            [['norm_id', 'employee_id', 'status'], 'integer'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['amount'], 'number'],
            [['description'], 'string', 'max' => 255],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id']],
            [['norm_id'], 'exist', 'skipOnError' => true, 'targetClass' => Norm::className(), 'targetAttribute' => ['norm_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'norm_id' => 'Norm',
            'employee_id' => 'Employee',
            'date' => 'Date',
            'amount' => 'Amount',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Employee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }

    /**
     * Gets query for [[Norm]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNorm()
    {
        return $this->hasOne(Norm::className(), ['id' => 'norm_id']);
    }

    /**
     * Gets Name of [[Employee]].
     *
     * @return string
     */
    public function getEmployeeName()
    {
        return  $this->employee->last_name . ' ' . $this->employee->first_name ;
    }

    /**
     * Gets Name of [[Norm]].
     *
     * @return string
     */
    public function getNormName()
    {
        return  $this->norm->kindName . ': '. $this->norm->amount . ' (' . $this->norm->year . '/' . $this->norm->month . ')';
    }
}
