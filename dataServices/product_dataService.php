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
        $sql = "INSERT INTO `ivr_sukkah`.`products`(`Id`,`CatalogNumber`,`FirstCategory`,`SecondaryCategory`,`Material`,`Thickness`,`Color`,`Size`,`Price`,`Manufacturer`,`Brand`,`Strength`,`Example`,`Name`,`Description`)VALUES('',"
                . "'" . $product->CatalogNumber . "','" . $product->FirstCategory . "','" . $product->SecondaryCategory . "','" . $product->Material . "','" . $product->Thickness . "','" . $product->Color . "','" . $product->Size . "','" . $product->Price . "','" . $product->Manufacturer . "','" . $product->Brand . "','" . $product->Strength . "','" . $product->Example . "','" . $product->Name . "','" . $product->Description . "');";
        return $sql;
    }

    public function GetUpdateString($product) {
        $sql = "UPDATE `ivr_sukkah`.`products` SET `CatalogNumber`='" . $product->CatalogNumber . "',`Category`='" . $product->Category . "',`Size`='" . $product->Size . "',`Price`='" . $product->Price . "',`RegularPrice`='" . $product->RegularPrice . "',`Name`='" . $product->Name . "' WHERE `Id` = '" . $product->Id . "'";
        return $sql;
    }

    public function GetSalesProdactReport() {
        $sql = "SELECT `orderitems`.`ProductId`, 
                `orderitems`.`Quantity`, 
               `products`.`Id`,`products`.`CatalogNumber`, `products`.`Name`, `products`.`Price`, 
               sum(`orderitems`.`Quantity`) as totel,
               sum(`orderitems`.`Quantity`)*`products`.`Price` as TotelSum

               FROM `ivr_sukkah`.`orderitems`,`ivr_sukkah`.`products`
               where `orderitems`.`ProductId` = `products`.`Id`

               group by `orderitems`.`ProductId`;";
        return $sql;
    }

}
