<?php
use yii\helpers\Html;
require_once(Yii::$app->basePath.'/vendor/google/apiclient/'.'autoload.php');
require_once (Yii::$app->basePath.'/vendor/google/apiclient/src/Google/'.'Client.php');
require_once (Yii::$app->basePath.'/vendor/google/apiclient/src/Google/Service/'.'Calendar.php');

define('STDIN',fopen("php://stdin","r"));

/* @var $this yii\web\View */
$this->title = 'Calendar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div>
    	<iframe src="https://www.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=6iuch9icnk7p30m6hqjct71otg%40group.calendar.google.com&amp;color=%232952A3&amp;ctz=Asia%2FJakarta" style=" border-width:0 " width="800" height="600" frameborder="0" scrolling="no"></iframe>
    </div>
        
    <div>
        <!-- AddThisEvent -->
        <script type="text/javascript" src="https://addthisevent.com/libs/1.5.8/ate.min.js"></script>

        <!-- AddThisEvent Settings -->
        <script type="text/javascript">
        addthisevent.settings({
            // license   : "aao8iuet5zp9iqw5sm9z",
            mouse     : false,
            css       : true,
            outlook   : {show:true, text:"Outlook Calendar"},
            google    : {show:true, text:"Google Calendar"},
            yahoo     : {show:true, text:"Yahoo Calendar"},
            hotmail   : {show:true, text:"Hotmail Calendar"},
            ical      : {show:true, text:"iCal Calendar"},
            facebook  : {show:true, text:"Facebook Event"},
            dropdown  : {order:"outlook,google,ical"},
            callback  : ""
        });
        </script>   

        <!-- Theme -->
        <style type="text/css">

        /* AddThisEvent (add to your existing CSS) */
        .addthisevent-drop                      {width:170px;display:inline-block;position:relative;z-index:999998;background:#2878eb;font-family:"Segoe UI",Frutiger,"Frutiger Linotype","Dejavu Sans","Helvetica Neue",Arial,sans-serif;color:#fff!important;text-decoration:none;font-size:15px;text-decoration:none;padding:12px 20px 12px 15px;}
        .addthisevent-drop:hover                {color:#fff;font-size:15px;text-decoration:none;background-color:#2c84f4;}
        .addthisevent-drop:active               {top:1px;}
        .addthisevent-drop .arrow               {width:15px;height:10px;position:absolute;top:50%;right:15px;margin-top:-5px;background:url("web/images/icon/icon-arrow.png") no-repeat;}
        .addthisevent-selected                  {background-color:#2c84f4;}
        .addthisevent_dropdown                  {width:215px;position:absolute;z-index:99999;padding:6px 0px 0px 0px;background:#fff;text-align:left;display:none;margin-top:2px;margin-left:-1px;border-top:1px solid #c8c8c8;border-right:1px solid #bebebe;border-bottom:1px solid #a8a8a8;border-left:1px solid #bebebe;-webkit-box-shadow:1px 3px 6px rgba(0,0,0,0.15);-moz-box-shadow:1px 3px 6px rgba(0,0,0,0.15);box-shadow:1px 3px 6px rgba(0,0,0,0.15);}
        .addthisevent_dropdown span             {display:block;line-height:110%;background:#fff;text-decoration:none;font-size:14px;color:#6d84b4;padding:8px 10px 9px 15px;}
        .addthisevent_dropdown span:hover       {background:#f4f4f4;color:#6d84b4;text-decoration:none;font-size:14px;}
        .addthisevent span                      {display:none!important;}
        .addthisevent-drop ._url,.addthisevent-drop ._start,.addthisevent-drop ._end,.addthisevent-drop ._summary,.addthisevent-drop ._description,.addthisevent-drop ._location,.addthisevent-drop ._organizer,.addthisevent-drop ._organizer_email,.addthisevent-drop ._facebook_event,.addthisevent-drop ._all_day_event {display:none!important;}
        .addthisevent_dropdown .copyx           {height:21px;display:block;position:relative;cursor:default;}
        .addthisevent_dropdown .brx             {width:180px;height:1px;overflow:hidden;background:#e0e0e0;position:absolute;z-index:100;left:10px;top:9px;}
        .addthisevent_dropdown .frs             {position:absolute;top:3px;cursor:pointer;right:10px;padding-left:10px;font-style:normal;font-weight:normal;text-align:right;z-index:101;line-height:110%;background:#fff;text-decoration:none;font-size:10px;color:#cacaca;}
        .addthisevent_dropdown .frs:hover       {color:#6d84b4;}
        .addthisevent                           {visibility:hidden;}

        </style>

        <a href="http://example.com/link-to-your-event" title="Add to Calendar" class="addthisevent">
            Add to Calendar
            <span class="_start">10-05-2015 11:38:46</span>
            <span class="_end">11-05-2015 11:38:46</span>
            <span class="_zonecode">75</span>
            <span class="_summary">Summary of the event</span>
            <span class="_description">Description of the event</span>
            <span class="_location">Location of the event</span>
            <span class="_organizer">Organizer</span>
            <span class="_organizer_email">Organizer e-mail</span>
            <span class="_facebook_event">http://www.facebook.com/events/160427380695693</span>
            <span class="_all_day_event">true</span>
            <span class="_date_format">DD/MM/YYYY</span>
        </a> 
        <?php 

            /*$client = new Google_Client();
            // OAuth2 client ID and secret can be found in the Google Developers Console.
            $client->setClientId('978464956837-35qob0vpgloah80gcpd2urrqapmah24k.apps.googleusercontent.com');
            $client->setClientSecret('6W1BX5NcG7CCNtAjx8fARPVl');
            $client->setRedirectUri('http://syspex.co.id/oauth2callback');
            $client->addScope('https://www.googleapis.com/auth/calendar');

            $service = new Google_Service_Calendar($client);

            $authUrl = $client->createAuthUrl();

            //Request authorization
            echo "Please visit:".$authUrl;
            echo "Please enter the auth code:";
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for access token
            //$accessToken = $client->authenticate($authCode);
            //$client->setAccessToken($accessToken);

            //if URL contains a log out query, clear the session
            if (isset($_REQUEST['logout'])) {
                unset($_SESSION['access_token']);
            }

            //if URL contains an authorization code
            if (isset($_GET['code'])) {
                    $client->authenticate($_GET['code']); //exchange code with Google Authorization
                    $_SESSION['access_token'] = $client->getAccessToken(); //get an access code back and store in session
                    $redirect = 'http://www.example.com/'; //redirect address
                    header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL)); //redirect user to clean URL
            }

            //if an access token exists in session storage
                if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
                $client->setAccessToken($_SESSION['access_token']); //set the client's access token
             }

             //if there is a valid access token, you can make the API calls
             if ($client->getAccessToken()) {
                    //insert API code here
             } else {
                    $authUrl = $client->createAuthUrl();
                    //show the client the authorization URL somehow
             }

            $event = new Google_Service_Calendar_Event();
            $event->setSummary('Appointment');
            $event->setLocation('Somewhere');
            $start = new Google_Service_Calendar_EventDateTime();
            $start->setDateTime('2011-06-03T10:00:00.000-07:00');
            $start->setTimeZone('America/Los_Angeles');
            $event->setStart($start);
            $end = new Google_Service_Calendar_EventDateTime();
            $end->setDateTime('2011-06-03T10:25:00.000-07:00');
            $end->setTimeZone('America/Los_Angeles');
            $event->setEnd($end);
            $event->setRecurrence(array('RRULE:FREQ=WEEKLY;UNTIL=20110701T170000Z'));
            $attendee1 = new Google_Service_Calendar_EventAttendee();
            $attendee1->setEmail('rg.timothy@gmail.com');
            // ...
            $attendees = array($attendee1);
            $event->attendees = $attendees;
            $recurringEvent = $service->events->insert('primary', $event);

            echo $recurringEvent->getId();



            $events = $service->events->instances("primary", "eventId");

            // Select the instance to cancel.
            $instance = $events->getItems()[0];
            $instance->setStatus('canceled');

            $updatedInstance = $service->events->update('primary', $instance->getId(), $instance);

            // Print the updated date.
            echo $updatedInstance->getUpdated();*/
            /*echo "BEGIN:VCALENDAR";
            echo "VERSION:2.0";
            echo "PRODID:-//YourSite//NONSGML YourSite//EN";
            echo "METHOD:PUBLISH"; // required by Outlook
            echo "BEGIN:VEVENT";
            echo "UID:".date('Ymd').'T'.date('His')."-".rand()."-yoursite.com"; // required by Outlook
            echo "DTSTAMP:".date('Ymd').'T'.date('His').""; // required by Outlook
            echo "DTSTART:20150224T093200"; //20120824T093200 (Datetime format required) 
            echo "SUMMARY:test";
            echo "DESCRIPTION: this is just a test";
            echo "END:VEVENT";
            echo "END:VCALENDAR";*/
        ?>
    </div>

    <div>
    	<?= \talma\widgets\FullCalendar::widget([
	    'googleCalendar' => true,  // If the plugin displays a Google Calendar. Default false
	    'loading' => 'Loading...', // Text for loading alert. Default 'Loading...'
	    'config' => [
	        // put your options and callbacks here
	        // see http://arshaw.com/fullcalendar/docs/
	        'lang' => 'en-au', // optional, if empty get app language
	        //...
	    ],
	]); ?>
    </div>
    

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>
    
    <div height="100px" style="background:#9d9d9d;" class="jumbotron">
        test
    </div>

</div>
