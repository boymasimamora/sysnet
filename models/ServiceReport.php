<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service_report".
 *
 * @property integer $id
 * @property string $submit_date
 * @property string $reported_by
 * @property string $report_detail
 */
class ServiceReport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_report';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['submit_date', 'reported_by'], 'required'],
            [['submit_date'], 'safe'],
            [['report_detail'], 'string'],
            [['reported_by'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'submit_date' => Yii::t('app', 'Submit Date'),
            'reported_by' => Yii::t('app', 'Reported By'),
            'report_detail' => Yii::t('app', 'Report Detail'),
        ];
    }
}
