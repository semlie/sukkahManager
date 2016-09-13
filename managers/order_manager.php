<?php

require_once realpath(dirname(__FILE__)) . '/../models/order_item.php';
require_once realpath(dirname(__FILE__)) . '/../models/order.php';
require_once realpath(dirname(__FILE__)) . '/../models/product.php';
require_once realpath(dirname(__FILE__)) . '/../dataServices/orderItem_dataService.php';
require_once realpath(dirname(__FILE__)) . '/../dataServices/order_dataService.php';
require_once realpath(dirname(__FILE__)) . '/../dataServices/product_dataService.php';
require_once realpath(dirname(__FILE__)) . '/product_manager.php';

class order_manager {

    //put your code here
    private $orderDataService, $orderItemDataService, $productManager;

    function __construct() {
        $this->orderDataService = new order_dataService();
        $this->orderItemDataService = new orderItem_dataService();
        $this->productManager = new product_manager();
    }

    public function UpdateOrder(order $order) {
        $this->orderDataService->Update($order);
        $this->UpdateOrderSum($order->Id);
        return $order;
    }

    public function AddNewOrder(order $order) {
        $this->orderDataService->Add($order);
    }

    public function AddNewOrderItem(order_item $orderItem) {
        
        $this->orderItemDataService->Add($orderItem);
        $this->UpdateOrderSum($orderItem->OrderId);
    }

    public function UpdateOrderItem(order_item $orderItem) {
        $this->orderItemDataService->Update($orderItem);
        $this->UpdateOrderSum($orderItem->OrderId);
        return $orderItem;
    }

    public function GetAllClosedOrders() {
        return $this->orderDataService->GetAllOrdersExtend();
    }

    public function GetAllOrders() {
        return $this->orderDataService->GetAllOrdersExtend();
    }

    public function GetAllOpenOrders() {
        return $this->orderDataService->GetAllOpenOrdersExtend();
    }

    public function GetOrderItems($orderId) {
        return $this->orderItemDataService->GetAllItemsOfOrderToPrintModel($orderId);
    }

    public function GetOrderItem($orderItemId) {
        return $this->orderItemDataService->getById($orderItemId);
    }

    public function GetOrderById($orderId) {
        return $this->orderDataService->GetOrderExtendById($orderId);
    }

    public function getOrderItemTotalPrice($item) {

        $product = $this->productManager->getProbuctById($item->ProductId);

        $totalPrice = ($product->Price * $item->Quantity);
        $totalQuntity = $item->Quantity;

        return array('totalPrice' => $totalPrice, 'totalQuntity' => $totalQuntity);
    }

    public function UpdateOrderSum($orderId) {
        $order = $this->orderDataService->getById($orderId);
        $allItems = $this->getOrderItems($orderId); // $this->orderItemDataService->GetAllItemsOfOrder($orderId);
        $totalPrice = 0;
        $totalQuntity = 0;
        $totalItems = count($allItems);
        if ($totalItems > 0) {
            foreach ($allItems as $item) {

//                $product = $this->productManager->getProbuctById($item->ProductId);
//                $totalPrice = $totalPrice + ($product->Price * $item->Quantity);
//                $totalQuntity = $totalQuntity + $item->Quantity;
                $totalPrice = $totalPrice + $item->PriceOrderItem;
                $totalQuntity = $totalQuntity + $item->Quantity;
            }
        }
        $order->TotalItems = $totalItems;
        $order->TotalPrice = $totalPrice;
        $order->TotalQuantity = $totalQuntity;

        $this->orderDataService->Update($order);
        return $order;
    }

}
