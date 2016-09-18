<?php
require_once './managers/web_manager.php';
$manager = new web_manager();


function parsGet() {
    global $manager;
    $func = isset($_GET["func"]) ? $_GET["func"] : '';

    if ($func == "neworder") {
       $data= isset($_GET["callerid"])?$manager->CreateOrder($_GET["callerid"]):'';
       Redirect("orderdetails.php?orderid=".$data);
    }
     if ($func == "deleteorder") {
       $data= isset($_GET["orderid"])?$manager->DeleteOrder($_GET["orderid"]):'';
       Redirect("orders.php");
    }
}

function parsPost() {
        global $manager;

}

function buildAddress($param) {
    return $_SERVER["PHP_SELF"].$param;
}

function Redirect($url)
{
    header('Location: ' . $url);

    die();
}

parsGet();
parsPost();