<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * contects("ivr_orders", "ivrorder", "tMxqEveNDh9VSLfh", "localhost");
 */
    $sql1 = "UPDATE ivr_orders.caller SET Name='aaaa213aaa', Address='14117 70th Rd, Flushing, NY 11367', City='??? ???', PhoneNumber='0527146368', OtherPhone='0777848477', Notes='' WHERE Id='1';";

    $sql2 = 'Select *From `ivr_orders`.`caller` WHERE `caller`.`Id`="1";';
    q($sql2);
    q($sql1);
    q($sql2);
function q($sql) {
    $conn = mysqli_connect("localhost", "ivrorder", "tMxqEveNDh9VSLfh", "ivr_orders");


    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $result =mysqli_query($conn, $sql);
       $row = ($result != FALSE) && is_object ($result)? mysqli_fetch_assoc($result) : '';
        $modelResult = ($row > 0) ? $row : '';
    var_dump($modelResult);
}