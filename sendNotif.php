<?php
/* Project name : SendNotif
 * Description : Send push notifications using Google's FCM
 * Author : Pavitra Behre
*/

class sendNotif {
    var $api_key;
    var $registrationIds;
    var $notification;
    var $fields;
    var $headers;
    var $url = 'https://fcm.googleapis.com/fcm/send';
    var $result;

    //Setter functions below
    function set_api_key($api) {
        if($api == '' || $api == NULL) {
            return false;
            die('API KEY NOT SET');
        } else {
        $this->api_key = $api;
        return true;
        }
    }

    function set_rid($rids) {
     if(sizeof($rids) == '0' || $rids == NULL){
         return false;
         die('ATLEAST ONE REGISTRATION ID REQUIRED');
     } else {
         $this->registrationIds = $rids;
         return true;
     }
    }

    function set_msg($title, $msg, $subtitle = null, $ticketText = null, $vibrate = '1', $sound = '1') {
        if($title == '' || $title == NULL || $msg == '' || $msg == NULL) {
            return false;
            die('Title and Message cannot be empty');
        } else {
            $this->notification = array(
                'message' => $msg,
                'title' => $title,
                'subtitle' => $subtitle,
                'tickerText' => $ticketText,
                'vibrate' => $vibrate,
                'msgcnt' => 1,
                'sound' => 1
            );
        }
    }

    function set_msg_arr($msg_arr) {
        if(sizeof($msg_arr) == '0' || $msg_arr == NULL) {
            return false;
            die('Message Array cannot be empty');
        } else {
            $this->notification = $msg_arr;
        }
    }

    //send() function - Pushes the notification to FCM cloud
    function send() {
        $this->fields = array(
            'registration_ids' => $this->registrationIds,
            'data' => $this->notification
        );
        $this->headers = array(
            'Authorization: key=' . $api_key,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $this->url);
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $this->headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $this->fields ) );
        $this->result = curl_exec($ch);
        curl_close($ch);
        return $this->result;
    }

}
?>