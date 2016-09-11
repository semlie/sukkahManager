<?php

require_once realpath(dirname(__FILE__)) . '/data_service.php';
require_once realpath(dirname(__FILE__)) . '/../models/caller.php';
require_once realpath(dirname(__FILE__)) . '/../models/sql_model.php';
require_once realpath(dirname(__FILE__)) . '/../config.php';

class caller_dataService extends DataService implements sqlModel {

    public function __construct() {
        parent::__construct(Config::getConttext(), "caller");
    }

    public function Add(caller $caller) {

        $result = parent::Add($caller);
        $caller->Id = $result;
    }

    public function mapToModel($row) {
        $result = new caller;
        $result->Id = $row['Id'];
        $result->Name = $row['Name'];
        $result->Address = $row['Address'];
        $result->City = $row['City'];
        $result->PhoneNumber = $row['PhoneNumber'];
        $result->OtherPhone = $row['OtherPhone'];
        $result->Notes = $row['Notes'];
        $result->TimeStamp = $row['TimeStamp'];

        return $result;
    }

    public function GetInsertString($caller) {
        $sql = "INSERT INTO `ivr_sukkah`.`caller` (`Id`,`Name`, `Address`, `City`, `PhoneNumber`, `OtherPhone`, `Notes`,`TimeStamp`) "
                . "VALUES ('','" . $caller->Name . "', '" . $caller->Address . "', '" . $caller->City . "', '" . $caller->PhoneNumber . "', '" . $caller->OtherPhone . "', '" . $caller->Notes . "',CURRENT_TIMESTAMP);";

        return $sql;
    }

    public function GetUpdateString($caller) {
//        $sql = 'UPDATE `ivr_sukkah`.`caller` SET '
//                . '`caller`.`Name`="' . $caller->Name . '", '
//                . '`caller`.`Address`="' . $caller->Address . '", '
//                . '`caller`.`City`="' . $caller->City . '", '
//                . '`caller`.`PhoneNumber`="' . $caller->PhoneNumber . '", '
//                . '`caller`.`OtherPhone`="' . $caller->OtherPhone . '", '
//                . '`caller`.`Notes`="' . $caller->Notes . '" '
//                . 'WHERE `caller`.`Id`="' . $caller->Id . '";';
//        return $sql;
            $sql = "UPDATE ivr_sukkah.caller SET Name='" . $caller->Name . "', Address='" . $caller->Address . "', City='" . $caller->City . "',PhoneNumber='" . $caller->PhoneNumber . "',
                    OtherPhone='" . $caller->OtherPhone . "', Notes='" . $caller->Notes . "' WHERE Id='" . $caller->Id . "';";
        return $sql;
    }

    public function GetCallerByPhoneNumber($phoneNumber) {

        $sql = " SELECT * FROM `ivr_sukkah`.`caller` WHERE `caller`.`PhoneNumber` = '" . $phoneNumber . "'";

        $result = $this->selectQuery($sql);
        $row = ($result != FALSE) ? mysqli_fetch_assoc($result) : '';
        $modelResult = ($row > 0) ? $this->mapToModel($row) : '';

        return $modelResult;
    }

    public function GetCallerNumberFromCallerId($callerId) {
        $sql = "select PhoneNumber 
                from `ivr_sukkah`.`caller`
                inner join `ivr_sukkah`.`caller_item` on `caller_item`.`CallerId` = `caller`.`Id`
                where `caller_item`.`Id` = '".$callerId."'";
        $result = $this->selectQuery($sql);
        $row = ($result != FALSE) ? mysqli_fetch_assoc($result) : '';
        $modelResult = ($row > 0) ? $row : '';
        return $modelResult;
    }

}