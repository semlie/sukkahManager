<?php

require_once realpath(dirname(__FILE__)) . '/../managers/order_manager.php';
require_once realpath(dirname(__FILE__)) . '/../models/order_item.php';
require_once realpath(dirname(__FILE__)) . '/../models/order.php';


$manager = new order_manager();

$open =$manager->GetAllOpenOrders();
var_dump($open);
$order = $manager->GetOrderById(1);
var_dump($order);

$orderItems = $manager->GetOrderItems($order->OrderId);
var_dump($orderItems);

$orderItems[0]->Quantity = $orderItems[0]->Quantity+2;
var_dump($orderItems);
$manager->UpdateOrderItem($orderItems[0]);

$order1 = $manager->GetOrderById(1);
var_dump($order1);