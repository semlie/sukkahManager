<?php

require_once realpath(dirname(__FILE__)) . '/caller_manager.php';
require_once realpath(dirname(__FILE__)) . '/order_manager.php';
require_once realpath(dirname(__FILE__)) . '/product_manager.php';
require_once realpath(dirname(__FILE__)) . '/../models/order_item.php';
require_once realpath(dirname(__FILE__)) . '/../models/order.php';
require_once realpath(dirname(__FILE__)) . '/../models/caller.php';
require_once realpath(dirname(__FILE__)) . '/../models/order_item_print.php';
require_once realpath(dirname(__FILE__)) . '/../models/orders_extend_model.php';

class web_manager {

    private $orderManager, $callerManager,$productManager;

    function __construct() {
        $this->orderManager = new order_manager();
        $this->callerManager = new caller_manager();
        $this->productManager = new product_manager();
    }

    //put your code here
    public function GetAllOrders() {
        return $this->orderManager->GetAllOpenOrders();
    }

    public function GetOrder($orderId) {
        return $this->orderManager->GetOrderById($orderId);
    }

    public function GetAllOrderItems($orderId) {
        return $this->orderManager->GetOrderItems($orderId);
    }

    public function GetOrderItem($orderItemId) {
        return $this->orderManager->GetOrderItem($orderItemId);
    }

    public function GetAllCallers() {
        return $this->callerManager->GetAllCallers();
    }

    public function GetCallerId($callerId) {
        return $this->callerManager->GetCallerById($callerId);
    }

    public function UpdateCaller($caller) {
        if (is_array($caller)) {
            $callerModel = $this->mapCaller($caller);
            
            $this->callerManager->UpdateCaller($callerModel);
        }
    }

    private function mapCaller($row) {
        $result = new caller;
        $result->Id = $this->clean($row['CallerId']);
        $result->Name = $this->clean($row['Name']);
        $result->Address = $this->clean($row['Address']);
        $result->City = $this->clean($row['City']);
        $result->PhoneNumber = $this->clean($row['PhoneNumber']);
        $result->OtherPhone = $this->clean($row['OtherPhone']);
        $result->Notes = $this->clean($row['Notes']);
        $result->TimeStamp = $this->clean($row['TimeStamp']);

        return $result;
    }

    public function AddOrderItem($orderItem) {
        $productCatlogNumber = $orderItem['ProductId'];
        $product = $this->productManager->GetProductByCatalogNumber($productCatlogNumber);
        $orderItem['ProductId'] = $product->Id;        
        $orderItemModel = $this->mapOrderItem($orderItem);
        $this->orderManager->AddNewOrderItem($orderItemModel);
        
    }

    public function UpdateOrderItem($orderItem) {
        if (is_array($orderItem)) {
            $orderItemModel = $this->mapOrderItem($orderItem);
            $this->orderManager->UpdateOrderItem($orderItemModel);
        }
    }

    private function mapOrderItem($row) {
        $result = new order_item;
        $result->CollerId = $row['CollerId'];
        $result->Id = isset($row['OrderItemId']) ? $row['OrderItemId'] :'';
        $result->OrderId = $row['OrderId'];
        $result->ProductId = $row['ProductId'];
        $result->Quantity = $row['Quantity'];
        $result->TimeStamp = isset($row['TimeStamp']) ? $row['TimeStamp'] :'';
        return $result;
    }

    public function UpdateOrder($order) {
        if (is_array($order)) {
            $orderModel = $this->mapOrder($order);
            $this->orderManager->UpdateOrder($orderModel);
        }
    }

    private function mapOrder($row) {
        $row['Is_Paid'] = isset($row['Is_Paid_new']) ? $row['Is_Paid_new'] : $row['Is_Paid'];
        $row['Is_Delivered'] = isset($row['Is_Delivered_new']) ? $row['Is_Delivered_new'] : $row['Is_Delivered'];
        $model = new order;
        $model->Id = $row['OrderId'];
        $model->CallerItemId = $row['CallerItemId'];
        $model->TimeStamp = $row['TimeStamp'];
        $model->Is_Delivered = $row['Is_Delivered'];
        $model->Is_Paid = $row['Is_Paid'];
        $model->TotalPrice = $row['TotalPrice'];
        $model->TotalQuantity = $row['TotalQuantity'];
        $model->TotalItems = $row['TotalItems'];

        return $model;
    }

    private function clean($param) {
        return mysql_real_escape_string($param);
    }

}
