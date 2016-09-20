<?php

require_once realpath(dirname(__FILE__)) . '/../dataServices/product_dataService.php';
require_once realpath(dirname(__FILE__)) . '/../models/product.php';

class product_manager {

    private $productDataService;

    function __construct() {
        $this->productDataService = new product_dataService();
    }

    public function getProbuctById($productId) {
        $result = $this->productDataService->getById($productId);
        if (!empty($result)) {
            return $result;
        }
        return '';
    }

    public function GetProductByCatalogNumber($catalogNumber) {
        $result = $this->productDataService->GetProductByCatalogNumber($catalogNumber);
        Return $result;
    }

    public function AddProduct(product $product) {
        $this->productDataService->Add($product);
        return $product;
    }

    public function UpdateProduct(product $product) {
        $this->productDataService->Add($product);
        return $product;
    }

    public function GetProdectSoldReport() {
        $sales = $this->productDataService->GetSalesProdactReport();
        return $sales;
    }
    public function GetProdectSoldReportFiltered($regionId) {
        $sales = $this->productDataService->GetSalesProdactReport($regionId);
        return $sales;
    }

    public function GetAllProdects() {
       return $this->productDataService->GetAll();

    }

//put your code here
}
