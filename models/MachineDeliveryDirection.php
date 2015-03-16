<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "machine_delivery_direction".
 *
 * @property integer $id
 * @property string $option
 *
 * @property NewMachineInstallationRequest[] $newMachineInstallationRequests
 */
class MachineDeliveryDirection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'machine_delivery_direction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['option'], 'required'],
            [['option'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'option' => Yii::t('app', 'Option'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewMachineInstallationRequests()
    {
        return $this->hasMany(NewMachineInstallationRequest::className(), ['direction_id' => 'id']);
    }
}
