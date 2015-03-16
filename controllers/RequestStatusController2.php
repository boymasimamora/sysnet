<?php

namespace app\controllers;

use Yii;
use app\models\RequestStatus;
use app\models\RequestStatusSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RequestStatusController implements the CRUD actions for RequestStatus model.
 */
class RequestStatusController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all RequestStatus models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequestStatusSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single RequestStatus model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->redirect(['view', 'id' => $model->id]);
        } else {
        return $this->render('view', ['model' => $model]);
}
    }

    /**
     * Creates a new RequestStatus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($req)
    {
        date_default_timezone_set(Yii::$app->modules['datecontrol']['displayTimezone']);
        $datetime_now = date('d/M/Y H:i:s', time());


        $connection = Yii::$app->db;

        $model = new RequestStatus;
        $model->follow_up_date = $datetime_now;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $command = $connection->createCommand('UPDATE sales_request SET request_status_id='.$model->id.' WHERE id='.$req);
            $command->execute();
            $this->notifEmailRequest($model);

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RequestStatus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RequestStatus model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RequestStatus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RequestStatus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RequestStatus::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function notifEmailRequest($modelval)
    {
        $connection = Yii::$app->db;
        $qry = $connection->createCommand('SELECT DISTINCT email 
                        FROM (
                                    SELECT u.email, a.item_name, a.user_id 
                                    FROM user AS u, auth_assignment AS a
                                    WHERE u.id = a.user_id AND a.item_name LIKE "%ale%"
                              ) 
                        AS email_tujuan')->queryAll();
        //$content = implode($recipients);
        $totalrecipients = count($qry);
        $recipients = '';
        for($i=0;$i<$totalrecipients;$i++)
        {
            $recipients = $qry[$i]['email'];
            Yii::$app->mailer->compose()
             ->setFrom('notification@syspex.co.id')
             ->setTo($recipients)
             ->setSubject('Email sent from Yii2-Swiftmailer, content : '.$modelval->id)
             ->setTextBody('isi email')
             //->setHtmlBody('<b>HTML content</b>')
             ->send();
        }

        //echo count($recipients);
        //echo $recipients[0]['email'];
        
    }
}
