<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request_type".
 *
 * @property integer $id
 * @property string $type
 *
 * @property SalesRequest[] $salesRequests
 */
class RequestType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesRequests()
    {
        return $this->hasMany(SalesRequest::className(), ['request_type_id' => 'id']);
    }
}
