<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of orderInfo_dataService
 *
 * @author Admin
 */
require_once realpath(dirname(__FILE__)) . '/data_service.php';
require_once realpath(dirname(__FILE__)) . '/../models/product.php';
require_once realpath(dirname(__FILE__)) . '/../models/sql_model.php';
require_once realpath(dirname(__FILE__)) . '/../config.php';

class product_dataService extends DataService implements sqlModel {

    public function __construct() {
        parent::__construct(Config::getConttext(), "products");
    }

    public function Add(product $product) {

        $result = parent::Add($product);
        $product->Id = $result;
    }

    public function mapToModel($row) {
        $result = new product;
        $result->Id = $row['Id'];
        $result->Name = $row['Name'];
        $result->CatalogNumber = $row['CatalogNumber'];
        $result->Category = $row['Category'];
        $result->Size = $row['Size'];
        $result->Price = $row['Price'];
        $result->RegularPrice = $row['RegularPrice'];
        $result->TimeStamp = $row['TimeStamp'];

        return $result;
    }

    function GetProductByCatalogNumber($catalogNumber) {
        $sql = " SELECT * FROM `ivr_sukkah`.`products` WHERE `products`.`CatalogNumber` = '" . $catalogNumber . "'";

        $result = $this->selectQuery($sql);
        $row = ($result != FALSE) ? mysqli_fetch_assoc($result) : '';
        $modelResult = ($row > 0) ? $this->mapToModel($row) : '';
        return $modelResult;
    }

    public function GetInsertString($product) {
        $sql = "INSERT INTO `ivr_sukkah`.`products`(`Id`,`CatalogNumber`,`Category`,`Size`,`Price`,`RegularPrice`,`Name`)VALUES('',"
        . "'".$product->CatalogNumber."','".$product->Category."','".$product->Size."','".$product->Price."','".$product->RegularPrice."','".$product->Name."');";
        return $sql;
    }

    public function GetUpdateString($product) {
        $sql = "UPDATE `ivr_sukkah`.`products` SET `CatalogNumber`='" . $product->CatalogNumber . "',`Category`='" . $product->Category . "',`Size`='" . $product->Size . "',`Price`='" . $product->Price . "',`RegularPrice`='" . $product->RegularPrice . "',`Name`='" . $product->Name . "' WHERE `Id` = '" . $product->Id . "'";
        return $sql;
    }

    public function GetSalesProdactReport($region = FALSE) {
//        $sqlTmp = 'SELECT `orderitems`.`ProductId`, 
//                `orderitems`.`Quantity`, 
//               `products`.`Id`,`products`.`CatalogNumber`, `products`.`Name`, `products`.`Price`, 
//               sum(`orderitems`.`Quantity`) as TotelQuntity,
//               sum(`orderitems`.`Quantity`)*`products`.`Price` as TotelPrice
//
//               FROM `ivr_sukkah`.`orderitems`,`ivr_sukkah`.`products`,`ivr_sukkah`.`caller`
//               where `orderitems`.`ProductId` = `products`.`Id`
//                AND `orderitems`.`CollerId` =  `caller`.`Id`
//               %1$s
//               group by `orderitems`.`ProductId`;';
//      
        $sqlTmp='select ProductId,
Name,
CatalogNumber,
Category,
sum(Quantity) as TotelQuntity,
sum(Quantity)* Price as TotelPrice
 from (SELECT orderitems.ProductId , 
 orderitems.Quantity, orderitems.CollerId,products.CatalogNumber, products.Name, products.Price,products.Category,
caller_item.Id callerItemId, caller.Id
FROM ivr_sukkah.orderitems 
left join ivr_sukkah.products on (orderitems.ProductId = products.Id) 
left join caller_item on(orderitems.CollerId = caller_item.Id)
left join caller on(caller_item.CallerId = caller.Id)
%1$s)as t
group by ProductId';
        $sql = sprintf($sqlTmp,$region!=FALSE? "where `caller`.`Region` = '$region'":'');
        
        $result = $this->selectQuery($sql);
        $modelResult = array();
         if ($result != FALSE) {
            while ($row = mysqli_fetch_assoc($result)) {
                // var_dump($row);
                $modelResult[] = $this->mapProductReport($row);
            }
        }
        return $modelResult;

  
    }
    private function mapProductReport($row) {
        $result = new productReport();
        $result->CatalogNumber = $row['CatalogNumber'];
        $result->Id = isset($row['ProductId']) ? $row['ProductId'] : '';
        $result->Name = $row['Name'];
        $result->TotelPrice = $row['TotelPrice'];
        $result->Quntity = $row['TotelQuntity'];
        $result->Category = isset($row['Category']) ? $row['Category'] : '';
        $result->TimeStamp = isset($row['TimeStamp']) ? $row['TimeStamp'] : '';

        return $result;
    }
}
