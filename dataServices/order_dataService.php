<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of order_dataService
 *
 * @author Admin
 */
require_once realpath(dirname(__FILE__)) . '/data_service.php';
require_once realpath(dirname(__FILE__)) . '/../models/order.php';
require_once realpath(dirname(__FILE__)) . '/../models/orders_extend_model.php';
require_once realpath(dirname(__FILE__)) . '/../models/sql_model.php';

class order_dataService extends DataService implements sqlModel {

    public function __construct() {
        parent::__construct(Config::getConttext(), "orders");
    }

    public function Add(order $order) {
        $result = parent::Add($order);
        $order->Id = $result;
    }

    public function GetInsertString($order) {
        $sql = "INSERT INTO `orders` (`Id`, `CallerItemId`, `TimeStamp`, `Is_Delivered`, `Is_Paid`, `TotalQuantity`, `TotalPrice`,`TotalItems`) VALUES "
                . "(NULL, '" . $order->CallerItemId . "', CURRENT_TIMESTAMP, '" . $order->Is_Delivered . "', '" . $order->Is_Paid . "', '" . $order->TotalQuantity . "', '" . $order->TotalPrice . "', '" . $order->TotalItems . "');";
        return $sql;
    }

    public function GetUpdateString($order) {
        $sql = "UPDATE `orders` SET "
                . "`CallerItemId`='" . $order->CallerItemId . "',"
                . "`Is_Delivered`='" . $order->Is_Delivered . "',"
                . "`Is_Paid`='" . $order->Is_Paid . "',"
                . "`TotalQuantity`='" . $order->TotalQuantity . "',"
                . "`TotalItems`='" . $order->TotalItems . "',"
                . "`TotalPrice`='" . $order->TotalPrice . "' "
                . "WHERE `orders`.`Id` = '" . $order->Id . "'";
        return $sql;
    }

    public function mapToExtendModel($row) {
        $model = new orders_extend_model;
        $model->OrderId = $row['OrderId'];
        $model->CallerId = $row['CallerId'];
        $model->CallerItemId = $row['CallerItemId'];
        $model->TimeStamp = $row['TimeStamp'];
        $model->Is_Delivered = $row['Is_Delivered'];
        $model->Is_Paid = $row['Is_Paid'];
        $model->TotalPrice = $row['TotalPrice'];
        $model->TotalQuantity = $row['TotalQuantity'];
        $model->TotalItems = $row['TotalItems'];
        $model->Name = $row['Name'];
        $model->Address = $row['Address'];
        $model->City = $row['City'];
        $model->PhoneNumber = $row['PhoneNumber'];
        $model->OtherPhone = $row['OtherPhone'];
        $model->Notes = $row['Notes'];
        $model->Region = $row['Region'];
        

        return $model;
    }

    public function mapToModel($row) {
        $model = new order;
        $model->Id = $row['Id'];
        $model->CallerItemId = $row['CallerItemId'];
        $model->TimeStamp = $row['TimeStamp'];
        $model->Is_Delivered = $row['Is_Delivered'];
        $model->Is_Paid = $row['Is_Paid'];
        $model->TotalPrice = $row['TotalPrice'];
        $model->TotalQuantity = $row['TotalQuantity'];
        $model->TotalItems = $row['TotalItems'];

        return $model;
    }

    private function OrderExtendModelSql($orderId = FALSE,$open = FALSE) {
        $ext = "";
        if ($orderId != 0) {
            $ext = "AND `orders`.`Id` = '" . $orderId . "'";
        }
        if ($open != 0) {
            $ext = $ext." AND (`orders`.`Is_Delivered` = '0' OR `orders`.`Is_Paid` = '0')";
        }        
        $sql = "SELECT `caller`.`Name`, `caller`.`Address`, `caller`.`City`, `caller`.`PhoneNumber`, 
                `caller`.`OtherPhone`, `caller`.`Notes`, `caller`.`Region`,`caller_item`.`CallerId`,
                `orders`.`Id` OrderId, `orders`.`CallerItemId`, `orders`.`TimeStamp`, `orders`.`Is_Delivered`, 
                `orders`.`Is_Paid`, `orders`.`TotalQuantity`,
                `orders`.`TotalPrice`, `orders`.`TotalItems`

                FROM `ivr_sukkah`.`orders`,`ivr_sukkah`.`caller_item`,`ivr_sukkah`.`caller`
                WHERE `orders`.`CallerItemId` = `caller_item`.`Id` and `caller`.`Id` = `caller_item`.`CallerId` " . $ext . ";";
        return$sql;
    }

    public function GetAllOrdersExtend() {

        $sql = $this->OrderExtendModelSql();
        $result = $this->selectQuery($sql);
        $modelResult = array();
        if ($result != FALSE) {
            while ($row = mysqli_fetch_assoc($result)) {
                // var_dump($row);
                $modelResult[] = $this->mapToExtendModel($row);
            }
        }
        return $modelResult;
    }
    public function GetAllOpenOrdersExtend() {

        $sql = $this->OrderExtendModelSql("0","1");
        $result = $this->selectQuery($sql);
        $modelResult = array();
        if ($result != FALSE) {
            while ($row = mysqli_fetch_assoc($result)) {
                // var_dump($row);
                $modelResult[] = $this->mapToExtendModel($row);
            }
        }
        return $modelResult;
    }
    public function GetOrderExtendById($orderId) {
        $sql = $this->OrderExtendModelSql($orderId);
        $result = $this->selectQuery($sql);
        $row = ($result != FALSE) ? mysqli_fetch_assoc($result) : '';
        $modelResult = ($row > 0) ? $this->mapToExtendModel($row) : '';
        return $modelResult;
    }
    
    public function DeleteOrder($orderId) {
         $sql = "delete from orders where Id ='".$orderId."'";
         $result = $this->DeleteQuery($sql);


    }

}
