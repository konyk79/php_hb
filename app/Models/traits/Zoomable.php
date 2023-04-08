<?php

namespace App;
use App;
use DateInterval;
use DateTime;
use \Firebase\JWT\JWT;
trait Zoomable
{
    public function zoom(){
        return $this->hasOne(Zoom::class);
    }
    public function generateJWT()
    {
        //Zoom API credentials from https://developer.zoom.us/me/
        $key = config('zoom.key');//'eJP7wm34RbaqtKKFzTM--A';
        $secret =config('zoom.secret'); //'kpukVjueCQakauTLq5UgOn0QRplJZJPrP1Oa';
//        dd($key);
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
        $ch = curl_init('https://api.zoom.us/v2/users/pearlpatrizia@gmail.com/meetings');
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
//        $meetingId=$this->zoom->meeting_id;
        //list users endpoint GET https://api.zoom.us/v2/users
        $ch = curl_init('https://api.zoom.us/v2/meetings/' . $meetingId . '/registrants');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // add token to the authorization header
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $this->generateJWT()
        ));
        $response = curl_exec($ch);
        $response = json_decode($response);
        if(!isset($response->total_records))
            return null;
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
        if(!isset($response->id))
            return null;
        return $response ;
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
public function getStartTimeForZoom(){
    $format = 'Y-m-d H:i:s';
    $startTime =DateTime::createFromFormat($format,($this->start_time));
    $format1 = 'Y-m-d\TH:i:s';
    return  $startTime=$startTime->format($format1);
}
    public function getTermForZoom(){
        $term = new DateInterval('PT'.$this->term);
        return $term->h*60+$term->i;
    }
    public function addMeeting($user_id)
    {
//        $user = App::user();
//        $meetingId=$this->zoom->meeting_id;
//        if (is_null($user_id))
//            $user_id=$this->zoom->user_id;

        $postData = array(
            "topic"=>$this->{'name:en'},
    "type"=> 2,
    "start_time"=> $this->getStartTimeForZoom(),// "2018-01-30T19:00:00Z",  2018-01-29 15:00:00
    "duration"=> $this->getTermForZoom(),
    "timezone"=> "UTC",
    'settings' => array(
        'host_video'=> false,
        'participant_video'=> false,
        'join_before_host' => false,
        'approval_type' => 0
    )
        );
// Setup cURL
        $ch = curl_init('https://api.zoom.us/v2/users/'.$user_id.'/meetings');
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
//            trigger_error(curl_error($ch));
            // die(curl_error($ch));
        }
        $response =json_decode($response);
//        dump($response);
        if(!isset($response->id))
            return null;
        return $response ;
    }

    public function addRegistrans($user, $meetingId)
    {
//        $user = App::user();
//        $meetingId=$this->zoom->meeting_id;
        $postData = array(
            "first_name" => $user->name,
            "last_name" => $user->last_name,
            "email" => $user->email
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
//        dump($ch);
// Send the request
        $response = curl_exec($ch);

// Check for errors
        if ($response === FALSE) {
           // trigger_error(curl_error($ch));
            // die(curl_error($ch));
        }
        $response = json_decode($response);
        if(!isset($response->id))
            return null;
        return $response ;
    }
}