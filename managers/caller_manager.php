<?php

require_once realpath(dirname(__FILE__)) . '/../dataServices/caller_dataService.php';
require_once realpath(dirname(__FILE__)) . '/../dataServices/calleritem_dataService.php';
require_once realpath(dirname(__FILE__)) . '/../models/product.php';
require_once realpath(dirname(__FILE__)) . '/../models/caller.php';
require_once realpath(dirname(__FILE__)) . '/../models/caller_item.php';

class caller_manager {

    //put your code here
    public $callerDataService, $callerItemDataService;

    function __construct() {
        $this->callerDataService = new caller_dataService();
        $this->callerItemDataService = new calleritem_dataService();
    }

    public function GetPhoneNumbar($callerId) {
        return $this->callerDataService->GetCallerNumberFromCallerId($callerId);
    }

    public function GetAllCallers() {
        return $this->callerDataService->GetAll();
    }

    public function GetNewCallerItem($caller) {
        return $this->AddNewCallerItem($caller->Id);
    }

    public function AddNewCallerItem($callerId) {
        $callerItem = new caller_item();
        $callerItem->Uid = uniqid();
        $callerItem->CallerId = $callerId;
        $this->callerItemDataService->Add($callerItem);
        return $callerItem;
    }

    public function GetCallerById($callerId) {
        return $this->callerDataService->getById($callerId);
    }

    public function GetCallerByCallerItem($callerItemId) {
        $callerId = $this->_getCallerByCallerItem($callerItemId);
        return $this->callerDataService->getById($callerId);
    }

    private function _getCallerByCallerItem($callerItemId) {
        $temp = $this->callerDataServiceDataService->getById($callerItemId);
        $result = !empty($temp) ? $temp->CallerId : "";
        return $result;
    }

    public function UpdateCaller(caller $caller) {
        $this->callerDataService->Update($caller);
        return $caller;
    }

    public function AddNewCaller(caller $caller) {
        $this->callerDataService->Add($caller);
        $this->GetNewCallerItem($caller);
        return $caller;
    }

}
