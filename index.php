    
<?php
    include_once('./functions/sms_api.php');
    include_once('./functions/parse_data.php');

    /*
        Prepare object

        Generate a token from (https://ssl.smsapi.com/webapp#/oauth/manage)

        Or

        Set username & password (Also uncomment them)
    */

    $token = "";

    $params = array(
        // 'username' => '',
        // 'password' => md5(''),
        'from' => 'Company_name',
        'to' => '',
        'eco' => 0,
        'message' => "Hello [%1%] [%2%]. This is a test message.",
        'param1' => '',
        'param2' => ''
        //'date' => 'unix_timestamp',
        //'fast' => '1', //cost x 2
    );

    $file_name = "contacts.csv";

    if(getContactsFromCSV($file_name, $params))
    {
       sms_send($params, $token);
    }

?>