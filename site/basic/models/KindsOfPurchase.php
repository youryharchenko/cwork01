<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kinds_of_purchase".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property int $status
 *
 * @property Norm[] $norms
 */
class KindsOfPurchase extends \yii\db\ActiveRecord
{
    public static function getAll(){

        $list = array();
    
        $rs = KindsOfPurchase::find()->orderBy("id")->all();
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
        return 'kinds_of_purchase';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 255],
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
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Norms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNorms()
    {
        return $this->hasMany(Norm::className(), ['kind_id' => 'id']);
    }
}
