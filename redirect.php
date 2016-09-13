<?php
require_once './managers/web_manager.php';
$manager = new web_manager();


function parsGet($param) {
    global $manager;
    $func = isset($_GET["func"]) ? $_GET["func"] : '';

    if ($func == "new") {
        $manager->AddNewProduct($_POST);
    }
}

function parsPost($param) {
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

