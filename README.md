# sendNotif 

A php wrapper to send push notifications using Google's FCM

## Usage
    include('sendNotif.php');
    $push = new sendNotif();
    $push->set_api_key('API_KEY');
    $push->set_rid($rids); //Where $rid is an array of registration ids, atleast one is required
    $push->set_msg($title, $msg, $subtitle = null, $ticketText = null, $vibrate = true, $sound = 1);
    //You can also use a message array, check the code or FCM documention for the array format
    $push->set_msg_arr($array);

    $response = $push->send();
    
