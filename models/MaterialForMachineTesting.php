<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "material_for_machine_testing".
 *
 * @property integer $id
 * @property string $option
 *
 * @property NewMachineInstallationRequest[] $newMachineInstallationRequests
 */
class MaterialForMachineTesting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'material_for_machine_testing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
        return $this->hasMany(NewMachineInstallationRequest::className(), ['material_for_machine_testing_id' => 'id']);
    }
}
