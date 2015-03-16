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
            $model->notes = preg_replace('/\r\n|\r|\n/','<br/>',$model->notes ); 
            $model->save();
            $command = $connection->createCommand('UPDATE sales_request SET request_status_id='.$model->id.' WHERE id='.$req);
            $command->execute();
            $sql = $connection->createCommand("UPDATE sales_request SET follow_up_status = 1 WHERE id = ".$req.";")->query(); 
            //$this->notifEmailRequest($model);

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
        date_default_timezone_set(Yii::$app->modules['datecontrol']['displayTimezone']);
        $datetime_now = date('d/M/Y H:i:s', time());

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //$this->notifEmailRequest($model);
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
        /*$qry = $connection->createCommand('SELECT DISTINCT email 
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
        }*/

        $sales_admin = $connection->createCommand('SELECT DISTINCT email 
                        FROM (
                                    SELECT u.email, a.item_name, a.user_id 
                                    FROM user AS u, auth_assignment AS a
                                    WHERE u.id = a.user_id AND a.item_name LIKE "%ales adm%"
                              ) 
                        AS email_tujuan')->queryAll();
        $total_sales_admin = count($sales_admin);

        $data_request = $connection->createCommand('SELECT request_type.type, sales_request.submit_date, user.email, customer.name, customer.address, sales_request.customer_contact_person,sales_request.customer_contact_number
                                                    from sales_request
                                                      left join customer
                                                        on customer.id = sales_request.customer_id
                                                      left join user
                                                        on user.id = sales_request.submit_by_id
                                                      left join request_type
                                                        on request_type.id = sales_request.request_type_id
                                                    where sales_request.request_status_id = '.$modelval->id)->queryAll();

        $techadmin = $connection->createCommand('SELECT email FROM user WHERE id='.$modelval->followed_up_by_id)->queryAll();
        $techadmin = $techadmin[0]['email'];
        $requestor = $data_request[0]['email'];

        
            //FOR TECH ADMIN:
            Yii::$app->mailer->compose()
             ->setFrom('notification@syspex.co.id')
             ->setTo($techadmin)
             ->setSubject('FOLLOWING UP NOTIFICATION (Do Not Reply This Message')
             //->setTextBody('You have scheduled a request successfully. Thank you for your fast response.')
             ->setHtmlBody('
                <b>You have scheduled a request from '.$requestor.' successfully in syspex.co.id with the following details:</b>
                <br>
                <br>Request Type        : '.$data_request[0]['type'].'
                <br>Submit Date         : '.$data_request[0]['submit_date'].'
                <br>Customer            : '.$data_request[0]['name'].'
                <br>Customer Address    : '.$data_request[0]['address'].'
                <br>Contact Person      : '.$data_request[0]['customer_contact_person'].'
                <br>Contact Number      : '.$data_request[0]['customer_contact_number'].'
                <br>
                <br>For more information, please login to syspex.co.id, and follow up on this request. Thank you.
                ')
             ->send();

        //FOR REQUESTOR (SALES)
        Yii::$app->mailer->compose()
             ->setFrom('notification@syspex.co.id')
             ->setTo($requestor)
             ->setSubject('FOLLOWING UP NOTIFICATION (Do Not Reply This Message')
             //->setTextBody('Your request has been followed up by Technical Admin.')
             ->setHtmlBody('
                <b>Your request has been followed up by '.$techadmin.' successfully in syspex.co.id with the following details:</b>
                <br>
                <br>Follow Up Date on Request     : '.$modelval->follow_up_date.'
                <br>Schedule Date                 : '.date('d/M/Y', strtotime($modelval->scheduled_date)).'
                <br>Technician                    : '.$modelval->technician.'
                <br>Notes from Tech Admin         : '.$modelval->notes.'
                <br>
                <br>Thank you for your attention.
                ')
             ->send();

        //FOR TECHNICIAN MENTIONED
        $tech = explode(',', $modelval->technician);
        //$sumtech = count($tech);
        //log($sumtech);

        if($modelval->technician != null && $modelval->technician != '')
        {
            foreach ($tech as $t) {
                Yii::$app->mailer->compose()
                 ->setFrom('notification@syspex.co.id')
                 ->setTo($t)
                 ->setSubject('SCHEDULE NOTIFICATION (Do Not Reply This Message')
                 //->setTextBody('Your request has been followed up by Technical Admin.')
                 ->setHtmlBody('
                    <b>You have been scheduled for a request by '.$techadmin.' successfully in syspex.co.id with the following details:</b>
                    <br><br>
                    <b>REQUEST INFORMATION:</b>

                    <br>Request Type        : '.$data_request[0]['type'].'
                    <br>Submit Date         : '.$data_request[0]['submit_date'].'
                    <br>Customer            : '.$data_request[0]['name'].'
                    <br>Customer Address    : '.$data_request[0]['address'].'
                    <br>Contact Person      : '.$data_request[0]['customer_contact_person'].'
                    <br>Contact Number      : '.$data_request[0]['customer_contact_number'].'

                    <br><br>
                    <b>SCHEDULE INFORMATION:</b>

                    <br>Follow Up Date on Request     : '.$modelval->follow_up_date.'
                    <br>Schedule Date                 : '.date('d/M/Y', strtotime($modelval->scheduled_date)).'
                    <br>Technician                    : '.$modelval->technician.'
                    <br>Notes from Tech Admin         : '.$modelval->notes.'
                    <br>
                    <br>Thank you for your attention.
                    ')
                 ->send();
            }    
        }
        
        

        //echo count($recipients);
        //echo $recipients[0]['email'];
        
    }

    public function actionUpdatestatus()
    {
        $stat = $_REQUEST['status'];
        $id = $_REQUEST['id'];

        $connection = Yii::$app->db;
        $sql = '';
        if($stat == 0) { 
            $sql = $connection->createCommand("UPDATE request_status SET status = 1 WHERE id = ".$id.";")->queryAll(); 
        }
        else { 
            $sql = $connection->createCommand("UPDATE request_status SET status = 0 WHERE id = ".$id.";")->queryAll(); 
        }
        //$command = Yii::app()->db->createCommand($sql);
        //$result = $command->queryAll();

        $jso = '{"result":[';
        $jso .='{"stat":"' . $stat . '"},';
        $jso = substr($jso, 0, strlen($jso) - 1);
        $jso .=']}';

        return $jso;
    }
}
