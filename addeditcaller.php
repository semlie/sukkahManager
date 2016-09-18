<?php
require_once './managers/web_manager.php';

$manager = new web_manager();
$productid = isset($_GET["callerid"]) ? $_GET["callerid"] : '';
$func = isset($_GET["func"]) ? $_GET["func"] : 'new';
$address = sprintf('?XDEBUG_SESSION_START=netbeans-xdebug%1$s', ($func == "edit") ? "&func=edit&callerid=" . $productid : '');

$postAddress = htmlspecialchars($_SERVER["PHP_SELF"]) . $address;
if (!empty($_POST)) {
    if ($func == "new") {
        $manager->AddNewCaller($_POST);
    }
    if ($func == "edit") {
        $manager->UpdateCaller($_POST);
    }
}


$data = !empty($productid) ? $manager->GetCallerId($productid) : new caller();
var_dump($data);
?>
<?php require_once 'header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">עריכת הוספת לקוח</h1>
        </div>
        <!-- /.col-lg-12 -->


    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    עריכת הוספת לקוח 
                </div>
                <div class="panel-body">
                    <div class="row">

                        <!-- /.col-lg-6 (nested) -->
                        <div class="col-lg-6">
                            <form role="form" action="<?php echo $postAddress; ?>" method="POST">
                                <div class="form-group">
                                    <label>CallerId</label>
                                    <p class="form-control-static"><?php echo $data->Id; ?></p>
                                </div>


                                <div class="form-group">
                                    <label>איזור</label>
                                    <input class="form-control" name = "Region" value="<?php echo $data->Region; ?>" >
                                    <p class="help-block">שם.</p>
                                </div>
                                <div class="form-group">
                                <div class="form-group">
                                    <label>שם</label>
                                    <input class="form-control" name = "Name" value="<?php echo $data->Name; ?>" >
                                    <p class="help-block">שם.</p>
                                </div>
                                <div class="form-group">
                                    <label>כתובת</label>
                                    <input class="form-control" name = "Address" value="<?php echo $data->Address; ?>" >
                                </div>
                                <div class="form-group">
                                    <label>עיר</label>
                                    <input class="form-control" name = "City" value="<?php echo $data->City; ?>" >
                                </div>
                                <div class="form-group">
                                    <label>טלפון</label>
                                    <input class="form-control" name = "PhoneNumber" value="<?php echo $data->PhoneNumber; ?>" >
                                </div>
                                <div class="form-group">
                                    <label>OtherPhone</label>
                                    <input class="form-control" name = "OtherPhone" value="<?php echo $data->OtherPhone; ?>" >
                                </div>

                                <div class="form-group">
                                    <label>Notes</label>
                                    <input class="form-control" name = "Notes" value="<?php echo $data->Notes; ?>" >
                                    <p class="help-block">שם.</p>
                                </div>
                                                <input type="hidden" class="form-control" name = "CallerId" value="<?php echo $data->Id; ?>" >

                                <button type="submit" class="btn btn-default">שמירה</button>

                            </form>

                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <?php; ?>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php
require_once 'footer.php';
