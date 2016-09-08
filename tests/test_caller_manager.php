<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once realpath(dirname(__FILE__)) . '/../dataServices/caller_dataService.php';
require_once realpath(dirname(__FILE__)) . '/../dataServices/calleritem_dataService.php';
require_once realpath(dirname(__FILE__)) . '/../managers/order_manager.php';
require_once realpath(dirname(__FILE__)) . '/../managers/caller_manager.php';
require_once realpath(dirname(__FILE__)) . '/../models/order_item.php';
require_once realpath(dirname(__FILE__)) . '/../models/order.php';
require_once realpath(dirname(__FILE__)) . '/../models/caller.php';


$manager = new caller_manager();
$call = new caller();

$open =  $manager->GetCallerById(1);
var_dump($open);
$open->Name = $open->Name."ss"; 

$manager->UpdateCaller($open);
$open =  $manager->GetCallerById(1);
var_dump($open);
