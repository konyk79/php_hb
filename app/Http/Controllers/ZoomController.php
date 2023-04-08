<?php

namespace App\Http\Controllers;

use App\Item;
use App\Layout;
use App\Lesson;
use App\MainConfig;
use App\Menu;
use App\SocialLink;
use App\Subscribe;
use App\UserHasSubscribe;
use DateInterval;
use DateTime;
use \Firebase\JWT\JWT;
use Carbon\Carbon;
use Log;

class ZoomController extends Controller
{

//function to generate JWT
    public function generateJWT()
    {
        //Zoom API credentials from https://developer.zoom.us/me/
        $key = 'eJP7wm34RbaqtKKFzTM--A';
        $secret = 'kpukVjueCQakauTLq5UgOn0QRplJZJPrP1Oa';
        $token = array(
            "iss" => $key,
            // The benefit of JWT is expiry tokens, we'll set this one to expire in 1 minute
            "exp" => time() + 60 * 60
        );
        //    $jwt = JWT::encode($token, $key);
        //  $decoded = JWT::decode($jwt, $key, array('HS256'));

        return JWT::encode($token, $secret);
    }

    public function getUsers()
    {
        //list users endpoint GET https://api.zoom.us/v2/users
        $ch = curl_init('https://api.zoom.us/v2/users');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // add token to the authorization header
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $this->generateJWT()
        ));
        $response = curl_exec($ch);
        $response = json_decode($response);
        return $response;
    }

    public function getSubAcounts()
    {
        //list users endpoint GET https://api.zoom.us/v2/users
        $ch = curl_init('https://api.zoom.us/v2/users/barlogy@yahoo.com/meetings');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // add token to the authorization header
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $this->generateJWT()
        ));
        $response = curl_exec($ch);
        $response = json_decode($response);
        return $response;
    }


    public function getRegistrantsList($meetingId)
    {
        //list users endpoint GET https://api.zoom.us/v2/users
        $ch = curl_init('https://api.zoom.us/v2/meetings/' . $meetingId . '/registrants');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // add token to the authorization header
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $this->generateJWT()
        ));
        $response = curl_exec($ch);
        $response = json_decode($response);
        return $response;
    }


    public function getRooms()
    {
        //list users endpoint GET https://api.zoom.us/v2/users
        $postData = array(
            'jsonrpc' => '2.0',
            'method' => 'list',
        );

// Setup cURL
        $ch = curl_init('https://api.zoom.us/v2/rooms/zrlist');
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->generateJWT(),
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));
        dump($ch);
// Send the request
        $response = curl_exec($ch);
// Check for errors
        if ($response === FALSE) {
//            trigger_error(curl_error($ch));
            // die(curl_error($ch));
        }
        return json_decode($response);
    }

    public function endConference($roomId)
    {
        $postData = array(
            'jsonrpc' => '2.0',
            'method' => 'end',
        );
// Setup cURL
        $ch = curl_init('https://api.zoom.us/v2/rooms/' . $roomId . '/meetings');
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->generateJWT(),
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));
        dump($ch);
// Send the request
        $response = curl_exec($ch);
// Check for errors
        if ($response === FALSE) {
//            trigger_error(curl_error($ch));
            // die(curl_error($ch));
        }
        return json_decode($response);
    }

    public function addRegistrans($meetingId)
    {
        $postData = array(
            "first_name" => "Tigran",
            "last_name" => "Abovian",
            "email" => "barlogy@yahoo.com"
        );
// Setup cURL
        $ch = curl_init('https://api.zoom.us/v2/meetings/' . $meetingId . '/registrants');
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->generateJWT(),
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));
        dump($ch);
// Send the request
        $response = curl_exec($ch);

// Check for errors
        if ($response === FALSE) {
//            trigger_error(curl_error($ch));
            // die(curl_error($ch));
        }
        return json_decode($response);
    }
    public function addMeeting($user_id = null)
    {
//        $user = App::user();
//        $meetingId=$this->zoom->meeting_id;
//        if (is_null($user_id))
//            $user_id=$this->zoom->user_id;

        $postData = array(
            "topic"=>'test',
            "type"=> 2,
            "start_time"=> '2018-01-31T19:00:00',// "2018-01-30T19:00:00Z",  2018-01-29 15:00:00
            "duration"=> '60',
            "timezone"=> "UTC",
    'settings' => array(
                'host_video'=> false,
                'participant_video'=> false,
                'join_before_host' => false,
                'approval_type' => 0
    )
        );
// Setup cURL
        $ch = curl_init('https://api.zoom.us/v2/users/barlogy@yahoo.com/meetings');
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->generateJWT(),
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));
        dump(json_encode($postData));
// Send the request
        $response = curl_exec($ch);

// Check for errors
        if ($response === FALSE) {
          //  trigger_error(curl_error($ch));
            // die(curl_error($ch));
            dump('error');
        }
//        dd(json_decode($response));
        $response =json_decode($response);
//        dump($response);
        if(!isset($response->id))
            return null;
        return $response ;
    }
    public function getMeeting($meetingId)
    {
        //list users endpoint GET https://api.zoom.us/v2/users
        $ch = curl_init('https://api.zoom.us/v2/meetings/'.$meetingId);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // add token to the authorization header
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $this->generateJWT()
        ));
        $response = curl_exec($ch);
        $response = json_decode($response);

        return $response;
    }
    public function getMeetings()
    {
        //list users endpoint GET https://api.zoom.us/v2/users
        $ch = curl_init('https://api.zoom.us/v2/users/pearlpatrizia@gmail.com/meetings');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // add token to the authorization header
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $this->generateJWT()
        ));
        $response = curl_exec($ch);
        $response = json_decode($response);

        return $response ;
    }

    public function test()
    {
        Subscribe::dailySchedule();
        $timestamp = '2018-01-28 12:04 PM';
//        $date = Carbon::createFromFormat('Y-m-d H:i A', $timestamp, 'America/New_York');
//        $date->setTimezone('UTC');
        $dt =  DateTime::createFromFormat('Y-m-d H:i A', $timestamp);
        dump($dt);
        dump($a=$dt->format('d'));
        dump(($dtc= clone $dt)->modify('last day of next month'));
        dump($b=$dtc->format('d'));

        $dt1= DateTime::createFromFormat('Y-m-d H:i A', $timestamp);


        dump($dt1->add(new DateInterval('P1M')));
        $c=$dt1->format('d');
        dump ($a>$c);
        dump($a);
        dump($c);
        dd($dt->modify('1 month'));

        //DateTime::createFromFormat('Y-m-d H:i:s',$date->format('Y-m-d H:i:s'));
//        dd($dt->format('Y-m-d H:i:s'));
//        dump( $date);
//        dump($dt);
        //Log::info(['User Subscribe change status by daily schedule. User Subscription #' => 'wer']);
//        dump(UserHasSubscribe::find(13)->paidNotificationAction(new DateTime() ,null));

//        dump(Subscribe::first()->groups);
//        dump(Subscribe::first()->promosName());
      //  dump(new DateInterval('P2W'));
//        dump(MainConfig::first()->getLessonBeforeStartTimeout());
//        dump(Lesson::find(5)->getFirstJoinTime());
//        dump(UserHasSubscribe::find(1)->getLastActiveHistory()->lesson_histories->count());
//        dump($this->getUsers());
//        dump($this->getSubAcounts());
//        dump($this->getMeetings());
//        dump($this->getRooms());
//        dump($this->endConference('e6fba6b2-81ca-444a-8bec-1a2c74815912'));
//        dump($this->getRegistrantsList('256326420'));
//        dump($this->addRegistrans('256326420'));
//        dump($this->getMeeting('477259435'));
//        if($meeting=$this->addMeeting()){
//            $id =$meeting->id;
//            dump($this->getMeeting($id));
//            dump($this->addRegistrans($id));
//        }
//

    }
}
