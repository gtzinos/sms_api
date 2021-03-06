<?php

    /*
        Send sms to your clients.
    */

    function sms_send($params, $token = false, $backup = false ) {

        static $content;

        if($backup == true){
            $url = 'https://api2.smsapi.com/sms.do';
        }else{
            $url = 'https://api.smsapi.com/sms.do';
        }

        $c = curl_init();
        curl_setopt( $c, CURLOPT_URL, $url );
        curl_setopt( $c, CURLOPT_POST, true );
        curl_setopt( $c, CURLOPT_POSTFIELDS, $params );
        curl_setopt( $c, CURLOPT_RETURNTRANSFER, true );

        if($token !== FALSE)
        {
            curl_setopt( $c, CURLOPT_HTTPHEADER, array(
                 "Authorization: Bearer $token"
            ));
        }

        $content = curl_exec( $c );
        $http_status = curl_getinfo($c, CURLINFO_HTTP_CODE);

        if($http_status != 200 && $backup == false){
            $backup = true;
            sms_send($params, $token, $backup);
        }

        curl_close( $c );
        return $content;
    }

?>