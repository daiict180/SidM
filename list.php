<?php


include("MailChimp.php");
$api = '834fa0f70901971dedfc9919ecedb094-us10';
$MailChimp = new \Drewm\MailChimp($api);
$result = $MailChimp->call('lists/subscribe', array(
                'id'                => 'f2131d3e92',
                'email'             => array('email'=>'daiict180@gmail.com'),
                //'merge_vars'        => array('FNAME'=>'Davy', 'LNAME'=>'Jones'),
                'double_optin'      => false,
                'update_existing'   => true,
                'replace_interests' => false,
                'send_welcome'      => false,
            ));
print_r($result);
?>