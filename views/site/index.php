<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;

use evgeniyrru\yii2slick\Slick;
use yii\web\JsExpression;
/* @var $this yii\web\View */
$this->title = 'Syspex Internal System';
?>

<!-- Start WOWSlider.com HEAD section --> <!-- add to the <head> of your page -->
<link rel="stylesheet" type="text/css" href="engine/style.css" />
<script type="text/javascript" src="engine/jquery.js"></script>
<!-- End WOWSlider.com HEAD section -->


<!-- Start WOWSlider.com BODY section --> <!-- add to the <body> of your page -->
    <div id="wowslider-container1">
        <div class="ws_images">
            <ul>
                <li><img src="images/dummy/simatic.jpg" alt="Lorem Ipsum Dolor Sit Amet" title="SIMATIC HMI" id="wows1_0"/><p>SIMATIC HMI is optimized to meet your specific human machine interface needs using open and standardized interfaces in hardware and software, which allow efficient integration into your automation systems.</p></li>
                <li><img src="images/dummy/touch.jpg" alt="DSC07775" title="SIMATIC CONTROLLERS" id="wows1_1"/><p>SIMATIC controllers provide automation solutions on all performance levels – with consistent functionality for applications with requirements range from simple to complex.</p></li>
            </ul>
        </div>
        <div class="ws_bullets" style="display: none;">
            <div>
                <a href="#" title="Lorem Ipsum Dolor Sit Amet"><span><img src="images/dummy/tooltips/dsc07774.jpg" alt="Lorem Ipsum Dolor Sit Amet"/>1</span></a>
                <a href="#" title="DSC07775"><span><img src="images/dummy/tooltips/dsc07775.jpg" alt="DSC07775"/>2</span></a>
            </div>
        </div>
        <div class="ws_shadow"></div>
    </div>  
    <script type="text/javascript" src="engine/wowslider.js"></script>
    <script type="text/javascript" src="engine/script.js"></script>
    <!-- End WOWSlider.com BODY section -->

<div class="site-index">

    <div class="jumbotron">
        <h1>syspex.co.id</h1>

        <p class="lead">Welcome to our website!</p>
        <?php 
            //echo var_dump(Yii::$app->user->identity->email);
            // date_default_timezone_set(Yii::$app->modules['datecontrol']['displayTimezone']);
            // echo date_default_timezone_get(); 
        ?>

        <p><a class="btn btn-lg btn-success" href="http://www.syspex.com">Go to syspex.com</a></p>
    </div>

    <div class="body-content">
    <?php
        //echo \Yii::$app->request->BaseUrl;
    ?>
    


    <div style="display:none;">
        <?php 

            /*Slick::widget([

            // HTML tag for container. Div is default.
            'itemContainer' => 'div',

            // HTML attributes for widget container
            'containerOptions' => ['class' => 'container'],

            // Items for carousel. Empty array not allowed, exception will be throw, if empty 
            'items' => [
                //Html::img(\Yii::$app->request->BaseUrl.'/images/1.jpg'),
                //Html::img('/cat_gallery/cat_002.png'),
                '<img src="'.\Yii::$app->request->BaseUrl.'/images/1.jpg'.'" width="100%">',
                '<img src="'.\Yii::$app->request->BaseUrl.'/images/2.JPG'.'" width="100%">',
                '<img src="'.\Yii::$app->request->BaseUrl.'/images/3.jpg'.'" width="100%">',
                '<img src="'.\Yii::$app->request->BaseUrl.'/images/4.jpg'.'" width="100%">',
                '<img src="'.\Yii::$app->request->BaseUrl.'/images/5.jpg'.'" width="100%">',
            ],

            // HTML attribute for every carousel item
            'itemOptions' => ['class' => 'cat-image'],

            // settings for js plugin
            // @see http://kenwheeler.github.io/slick/#settings
            'clientOptions' => [
                'autoplay' => true,
                'dots'     => true,
                // note, that for params passing function you should use JsExpression object
                'onAfterChange' => new JsExpression('function() {console.log("The cat has shown")}'),
            ],

        ]);*/ ?>
    </div>
    
    
<?php    

/*$client = new Google_Client();
$client->setApplicationName("Client_Library_Examples");
$client->setDeveloperKey("AIzaSyALKWPsNRgJI99y5e-NnxST-_35n8XHCnI");  
$client->setClientId('1029079261292-42di8un0h1alsgi1qnkmbrvu7fuv317a.apps.googleusercontent.com');
$client->setClientSecret('deSkfhASs-5_yqOAx0-GiywZ');
$client->setRedirectUri('https://www.example.com/oauth2callback');
$client->setAccessType('offline');   // Gets us our refreshtoken

$client->setScopes(array('https://www.googleapis.com/auth/calendar.readonly'));


//For loging out.
if (isset($_GET['logout'])) {
    unset($_SESSION['token']);
}


// Step 2: The user accepted your access now you need to exchange it.
if (isset($_GET['code'])) {
    
    $client->authenticate($_GET['code']);  
    $_SESSION['token'] = $client->getAccessToken();
    $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}

// Step 1:  The user has not authenticated we give them a link to login    
if (!isset($_SESSION['token'])) {

    $authUrl = $client->createAuthUrl();

    print '<a class="login" href="'.$authUrl.'">Connect Me!</a>';
}    
// Step 3: We have access we can now create our service
if (isset($_SESSION['token'])) {
    $client->setAccessToken($_SESSION['token']);
    print '<a class="logout" href="&quot;.$_SERVER[">LogOut</a>';  
    
    $service = new Google_Service_Calendar($client);    
    
    $calendarList  = $service->calendarList->listCalendarList();;
    print_r($calendarList);
    while(true) {
        foreach ($calendarList->getItems() as $calendarListEntry) {
            echo $calendarListEntry->getSummary()."
\n";
        }
        $pageToken = $calendarList->getNextPageToken();
        if ($pageToken) {
            $optParams = array('pageToken' => $pageToken);
            $calendarList = $service->calendarList->listCalendarList($optParams);
        } else {
            break;
        }
    }
}*/
?>
        <div class="row" style="display:none;">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.syspex.com">Syspex &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.syspex.com">Syspex &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.syspex.com">Syspex &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
