<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contoh".
 *
 * @property integer $id
 * @property resource $picture
 */
class Contoh extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contoh';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['picture'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'picture' => Yii::t('app', 'Picture'),
        ];
    }
}
