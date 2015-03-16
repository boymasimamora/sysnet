<?php

namespace app\controllers;

use Yii;
use app\models\SalesRequest;
use app\models\SalesRequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\data\ActiveDataProvider;
/**
 * SalesRequestController implements the CRUD actions for SalesRequest model.
 */
class SalesRequestController extends Controller
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
     * Lists all SalesRequest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SalesRequestSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);

        /*$searchModel = new SalesRequestSearch;
        $query = SalesRequest::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $searchModel->request_status_id = null;
        $query->andFilterWhere(['request_status_id' => null]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);*/
    }

    /**
     * Displays a single SalesRequest model.
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
     * Creates a new SalesRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        date_default_timezone_set(Yii::$app->modules['datecontrol']['displayTimezone']);
        $datetime_now = date('d/M/Y H:i:s', time());

        $model = new SalesRequest;
        $model->submit_date = $datetime_now;

        /*// $model->customer_product_details = preg_replace('/\r\n|\r|\n/','<br/>',$model->customer_product_details ); 
        // $model->customer_product_details = str_replace(array('\r', '\n'), '', $model->customer_product_details);
        $model->customer_product_details = nl2br($model->customer_product_details);

        // $model->material_specification_details = preg_replace('/\r\n|\r|\n/','<br/>',$model->material_specification_details ); 
        // $model->material_specification_details = str_replace(array('\r', '\n'), '', $model->material_specification_details);
        $model->material_specification_details = nl2br($model->material_specification_details);

        // $model->special_requirement = preg_replace('/\r\n|\r|\n/','<br/>',$model->special_requirement ); 
        // $model->special_requirement = str_replace(array('\r', '\n'), '', $model->special_requirement);
        $model->special_requirement = nl2br($model->special_requirement);

        // $model->FOC_item = preg_replace('/\r\n|\r|\n/','<br/>',$model->FOC_item ); 
        // $model->FOC_item = str_replace(array('\r', '\n'), '', $model->FOC_item);
        $model->FOC_item = nl2br($model->FOC_item);

        // $model->problem_report_by_customer = preg_replace('/\r\n|\r|\n/','<br/>',$model->problem_report_by_customer ); 
        // $model->problem_report_by_customer = str_replace(array('\r', '\n'), '', $model->problem_report_by_customer);
        $model->problem_report_by_customer = nl2br($model->problem_report_by_customer);

        // $model->purpose = preg_replace('/\r\n|\r|\n/','<br/>',$model->purpose ); 
        // $model->purpose = str_replace(array('\r', '\n'), '', $model->purpose);
        $model->purpose = nl2br($model->purpose).'duh';

        // $model->additional_comments = preg_replace('/\r\n|\r|\n/','<br/>',$model->additional_comments ); 
        // $model->additional_comments = str_replace(array('\r', '\n'), '', $model->additional_comments);
        $model->additional_comments = nl2br($model->additional_comments);*/


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->notifEmailRequest($model);

            $model->customer_product_details = preg_replace('/\r\n|\r|\n/','<br/>',$model->customer_product_details ); 
            $model->customer_product_details = htmlspecialchars($model->customer_product_details, ENT_QUOTES);
            
            $model->material_specification_details = preg_replace('/\r\n|\r|\n/','<br/>',$model->material_specification_details ); 
            $model->material_specification_details = htmlspecialchars($model->material_specification_details, ENT_QUOTES);
            
            $model->special_requirement = preg_replace('/\r\n|\r|\n/','<br/>',$model->special_requirement ); 
            $model->special_requirement = htmlspecialchars($model->special_requirement, ENT_QUOTES);
            
            $model->FOC_item = preg_replace('/\r\n|\r|\n/','<br/>',$model->FOC_item ); 
            $model->FOC_item = htmlspecialchars($model->FOC_item, ENT_QUOTES);
            
            $model->problem_report_by_customer = preg_replace('/\r\n|\r|\n/','<br/>',$model->problem_report_by_customer ); 
            $model->problem_report_by_customer = htmlspecialchars($model->problem_report_by_customer, ENT_QUOTES);
            
            $model->purpose = preg_replace('/\r\n|\r|\n/','<br/>',$model->purpose ); 
            $model->purpose = htmlspecialchars($model->purpose, ENT_QUOTES);
            
            $model->additional_comments = preg_replace('/\r\n|\r|\n/','<br/>',$model->additional_comments ); 
            $model->additional_comments = htmlspecialchars($model->additional_comments, ENT_QUOTES);
            
            $model->save();
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SalesRequest model.
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
     * Deletes an existing SalesRequest model.
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
     * Finds the SalesRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SalesRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SalesRequest::findOne($id)) !== null) {
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
                                    WHERE u.id = a.user_id AND a.item_name LIKE "%echnical adm%"
                              ) 
                        AS email_tujuan')->queryAll();
        //$content = implode($recipients);
        $totalrecipients = count($qry);
        $recipients = '';
        $sender = $connection->createCommand('SELECT email FROM user WHERE id='.$modelval->submit_by_id)->queryAll();
        $sender = $sender[0]['email'];

        $emailcontent = '';
        if($modelval->request_type->type != null) { $emailcontent .= '<tr><td width="30%">Request Type</td><td>'.$modelval->request_type->type.'</td></tr>'; }
        if($modelval->profile->name != null) { $emailcontent .= '<tr><td width="30%">Requestor</td><td>'.$modelval->profile->name.'</td></tr>'; }
        if($modelval->customer->name != null) { $emailcontent .= '<tr><td width="30%">Customer Name</td><td>'.$modelval->customer->name.'</td></tr>'; }
        if($modelval->customer->address != null) { $emailcontent .= '<tr><td width="30%">Customer Address</td><td>'.$modelval->customer->address.'</td></tr>'; }
        if($modelval->customer_contact_person != null) { $emailcontent .= '<tr><td width="30%">Contact Person</td><td>'.$modelval->customer_contact_person.'</td></tr>'; }
        if($modelval->customer_contact_number != null) { $emailcontent .= '<tr><td width="30%">Contact Number</td><td>'.$modelval->customer_contact_number.'</td></tr>'; }
        if($modelval->machine_arrival_date_estimation != null) { $emailcontent .= '<tr><td width="30%">Machine Arrival Date Estimation</td><td>'.date('d/M/Y', strtotime($modelval->machine_arrival_date_estimation)).'</td></tr>'; }
        if($modelval->delivery_date_request != null) { $emailcontent .= '<tr><td width="30%">Delivery Date Request</td><td>'.date('d/M/Y', strtotime($modelval->delivery_date_request)).'</td></tr>'; }
        if($modelval->installation_date_request != null) { $emailcontent .= '<tr><td width="30%">Installation Date Request</td><td>'.date('d/M/Y', strtotime($modelval->installation_date_request)).'</td></tr>'; }
        if($modelval->machine_delivery_direction_id != null) { $emailcontent .= '<tr><td width="30%">Machine Delivery Direction</td><td>'.$modelval->machineDeliveryDirection->option.'</td></tr>'; }
        if($modelval->main_power_supply != null) { $emailcontent .= '<tr><td width="30%">Main Power Supply</td><td>'.$modelval->main_power_supply.'</td></tr>'; }
        if($modelval->customer_product_details != null) { $emailcontent .= '<tr><td width="30%">Customer Product Details</td><td>'.$modelval->customer_product_details.'</td></tr>'; }
        if($modelval->material_for_machine_testing_id != null) { $emailcontent .= '<tr><td width="30%">Material for Machine Testing</td><td>'.$modelval->materialForMachineTesting->option.'</td></tr>'; }
        if($modelval->material_specification_details != null) { $emailcontent .= '<tr><td width="30%">Material Specification Details</td><td>'.$modelval->material_specification_details.'</td></tr>'; }
        if($modelval->machine_accessories != null) { $emailcontent .= '<tr><td width="30%">Machine Accessories</td><td>'.$modelval->machine_accessories.'</td></tr>'; }
        if($modelval->special_requirement != null) { $emailcontent .= '<tr><td width="30%">Special Requirement</td><td>'.$modelval->special_requirement.'</td></tr>'; }
        if($modelval->FOC_item != null) { $emailcontent .= '<tr><td width="30%">FOC Item</td><td>'.$modelval->FOC_item.'</td></tr>'; }
        if($modelval->warranty_term_from_supplier != null) { $emailcontent .= '<tr><td width="30%">Warranty Term from Supplier</td><td>'.$modelval->warranty_term_from_supplier.'</td></tr>'; }
        if($modelval->warranty_term_to_customer != null) { $emailcontent .= '<tr><td width="30%">Warranty Term to Customer</td><td>'.$modelval->warranty_term_to_customer.'</td></tr>'; }
        if($modelval->free_service != null) { $emailcontent .= '<tr><td width="30%">Free Service</td><td>'.$modelval->free_service.'</td></tr>'; }
        if($modelval->total_free_service_per_year != null) { $emailcontent .= '<tr><td width="30%">Total Free Service / Year</td><td>'.$modelval->total_free_service_per_year.'</td></tr>'; }
        if($modelval->period_of_rental != null) { $emailcontent .= '<tr><td width="30%">Period of Rental</td><td>'.$modelval->period_of_rental.'</td></tr>'; }
        if($modelval->period_of_demo != null) { $emailcontent .= '<tr><td width="30%">Period of Demo</td><td>'.$modelval->period_of_demo.'</td></tr>'; }
        if($modelval->problem_report_by_customer != null) { $emailcontent .= '<tr><td width="30%">Problem Report by Customer</td><td>'.$modelval->problem_report_by_customer.'</td></tr>'; }
        if($modelval->purpose != null) { $emailcontent .= '<tr><td width="30%">Purpose</td><td>'.$modelval->purpose.'</td></tr>'; }
        if($modelval->additional_comments != null) { $emailcontent .= '<tr><td width="30%">Additional Comments</td><td>'.$modelval->additional_comments.'</td></tr>'; }
        //if($modelval->request_status_id != null) { $emailcontent .= '<tr><td>Request Status</td><td>'.$modelval->request_status_id.'</td></tr>'; }

        for($i=0;$i<$totalrecipients;$i++)
        {
            $recipients = $qry[$i]['email'];
            Yii::$app->mailer->compose()
             ->setFrom('notification@syspex.co.id')
             ->setTo($recipients)
             // ->setSubject('Email sent from Yii2-Swiftmailer, content : '.$modelval->purpose)
             ->setSubject('REQUEST NOTIFICATION FROM '.$sender.' (Do Not Reply This Message)')
             //->setTextBody('You have received a request from '.$sender.' in syspex.co.id. Please login to follow up the request.')
             ->setHtmlBody('
                <b>You have received a request from '.$sender.' in syspex.co.id with the following details:</b>
                <br>
                <table border="1">
                '.$emailcontent.'
                </table>
                <br>
                <br>For more information, please login to syspex.co.id, and follow up on this request. Thank you.
                ')
             ->send();
        }

        
        //$recipients = $qry[$i]['email'];
        Yii::$app->mailer->compose()
            ->setFrom('notification@syspex.co.id')
            ->setTo($sender)
            // ->setSubject('Email sent from Yii2-Swiftmailer, content : '.$modelval->purpose)
            ->setSubject('REQUEST NOTIFICATION (Do Not Reply This Message)')
            //->setTextBody('You have sent a request successfully. You will be informed when your request followed up.')
            ->setHtmlBody('
                <b>You have sent a request successfully with the following information:</b>
                <br>
                <table border="1">
                '.$emailcontent.'
                </table>
                <br>
                <br>You will receive an email notification when your request followed up. Thank you.
                ')
            ->send();

        //echo count($recipients);
        //echo $recipients[0]['email'];
        
    }

    public function actionModal($id)
    {
        $this->view($id);
    }

    public function actionCustomerlist($search = null, $id = null) {
        $out = ['more' => false];
        if (!is_null($search)) {
            $connection = Yii::$app->db;
            /*$query = new Query;
            $query->select('id, purpose AS text')
                ->from('sales_request')
                ->where('purpose LIKE "%' . $search .'%"')
                ->limit(20);*/
            $command = $connection->createCommand('SELECT id, CONCAT_WS(" - ",name, address) AS text FROM customer WHERE name LIKE "%'.$search.'%" OR address LIKE "%'.$search.'%" LIMIT 20');
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Customer::find($id)->name];
        }
        else {
            $out['results'] = ['id' => 0, 'text' => 'No matching records found'];
        }
        //echo json::encode($out);
        echo json_encode($out);
    }

    public function actionAddcustomer()
    {
        $name = $_REQUEST['cust'];
        $address = $_REQUEST['address'];

        $connection = Yii::$app->db;
        $sql_insert = '';
        //$sql_insert = $connection->createCommand('INSERT into customer (name, address) VALUES ("'.$name.'", "'.$address.'")')->queryAll();
        $connection->createCommand()->insert('customer', [
            'name' => $name,
            'address' => $address,
        ])->execute();
        $get_id = $connection->createCommand('SELECT id FROM customer WHERE name="'.$name.'" AND address="'.$address.'"')->queryAll();
        // if($stat == 0) { $sql = $connection->createCommand("UPDATE request_status SET status = 1 WHERE id = ".$id.";")->queryAll(); }
        // else { $sql = $connection->createCommand("UPDATE request_status SET status = 0 WHERE id = ".$id.";")->queryAll(); }
        //$command = Yii::app()->db->createCommand($sql);
        //$result = $command->queryAll();

        //$out['result'] = ['id' => $get_id[0]["id"]];
        //echo json_encode($out);
        
        $jso = '{"result":[';
        $jso .='{"id":"'.$get_id[0]["id"].'"},';
        $jso = substr($jso, 0, strlen($jso) - 1);
        $jso .=']}';

        return $jso;
    }

    public function actionUpdatestatus()
    {
        $connection = Yii::$app->db;
        $id = $_REQUEST['id'];
        $stat = $connection->createCommand('SELECT status FROM request_status WHERE id='.$id.';')->queryAll();
        $stat = $stat[0]['status'];
        
        $sql = '';
        $sql2 = '';
        if($stat == 0) { 
            $sql = $connection->createCommand("UPDATE request_status SET status = 1 WHERE id = ".$id.";")->query(); 
            $sql = $connection->createCommand("UPDATE sales_request SET done = 1 WHERE request_status_id = ".$id.";")->query(); 
            $stat = 1;
        }
        else { 
            $sql = $connection->createCommand("UPDATE request_status SET status = 0 WHERE id = ".$id.";")->query(); 
            $sql = $connection->createCommand("UPDATE sales_request SET done = 0 WHERE request_status_id = ".$id.";")->query(); 
            $stat = 0;
        }
        //$command = Yii::app()->db->createCommand($sql);
        //$result = $command->queryAll();


        $jso = '{"result":[';
        $jso .='{"stat":"' . $stat . '"},';
        $jso = substr($jso, 0, strlen($jso) - 1);
        $jso .=']}';

        return $jso;
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
}
