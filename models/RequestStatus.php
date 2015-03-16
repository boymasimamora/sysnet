<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request_status".
 *
 * @property integer $id
 * @property string $follow_up_date
 * @property integer $followed_up_by_id
 * @property string $technician
 * @property string $scheduled_date
 * @property string $notes
 * @property string $status
 *
 * @property User $followedUpBy
 * @property SalesRequest[] $salesRequests
 */
class RequestStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['follow_up_date', 'followed_up_by_id'], 'required'],
            [['followed_up_by_id', 'status'], 'integer'],
            [['technician', 'notes'], 'string'],
            [['scheduled_date'], 'safe'],
            [['follow_up_date'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'follow_up_date' => Yii::t('app', 'Follow Up Date'),
            'followed_up_by_id' => Yii::t('app', 'Followed Up By'),
            'technician' => Yii::t('app', 'Technician'),
            'scheduled_date' => Yii::t('app', 'Scheduled Date'),
            'notes' => Yii::t('app', 'Notes'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFollowedUpBy()
    {
        $modeluser = new \dektrium\user\models\User;
        return $this->hasOne($modeluser, ['id' => 'followed_up_by_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesRequests()
    {
        return $this->hasMany(SalesRequest::className(), ['request_status_id' => 'id']);
    }

    public function getSales_requests()
    {
        return $this->hasMany(SalesRequest::className(), ['request_status_id' => 'id']);
    }
}
