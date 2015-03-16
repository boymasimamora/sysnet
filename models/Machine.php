<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "machine".
 *
 * @property integer $id
 * @property string $brand
 * @property string $model
 */
class Machine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'machine';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand', 'model'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'brand' => Yii::t('app', 'Brand'),
            'model' => Yii::t('app', 'Model'),
        ];
    }
}
