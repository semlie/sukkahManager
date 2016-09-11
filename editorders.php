<?php
require_once './managers/web_manager.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$manager = new web_manager();
$orderId = isset($_GET["orderid"]) ? $_GET["orderid"] : "";
$func = isset($_GET["func"]) ? $_GET["func"] : '';
$postOrderAddress = htmlspecialchars($_SERVER["PHP_SELF"]) . "func=order&orderid=" . $orderId;
$postCallerAddress = htmlspecialchars($_SERVER["PHP_SELF"]) . "?func=caller&orderid=" . $orderId;


if (!empty($_POST)) {
    if ($func == "order") {
        $manager->UpdateOrder($_POST);
    }
    if ($func == "caller") {
        $manager->UpdateCaller($_POST);
    }
}
$data = !empty($orderId) ? $manager->GetOrder($orderId) : "";
var_dump($data);
?>
<?php            require_once 'header.php';
?>
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">עריכת הזמנה</h1>
                    </div>
                    <!-- /.col-lg-12 -->


                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                עריכת הזמנה ופרטי מזמין
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form role="form" action="<?php echo $postCallerAddress; ?>" method="POST">
                                            <div class="form-group">
                                                <label>CallerId</label>
                                                <p class="form-control-static"><?php echo $data->CallerId; ?></p>
                                                <input type="hidden" class="form-control" name = "CallerId" value="<?php echo $data->CallerId; ?>" >
                                            </div>
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input class="form-control" name = "Name" value="<?php echo $data->Name; ?>" >
                                                <p class="help-block">שם.</p>
                                            </div>
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input class="form-control" name = "Address" value="<?php echo $data->Address; ?>" >
                                                <p class="help-block">שם.</p>
                                            </div>
                                            <div class="form-group">
                                                <label>City</label>
                                                <input class="form-control" name = "City" value="<?php echo $data->City; ?>" >
                                                <p class="help-block">שם.</p>
                                            </div>
                                            <div class="form-group">
                                                <label>TimeStamp</label>
                                                <input class="form-control" name = "TimeStamp" value="<?php echo $data->TimeStamp; ?>" >
                                                <p class="help-block">שם.</p>
                                            </div>
                                            <div class="form-group">
                                                <label>PhoneNumber</label>
                                                <input class="form-control" name = "PhoneNumber" value="<?php echo $data->PhoneNumber; ?>" >
                                                <p class="help-block">שם.</p>
                                            </div>
                                            <div class="form-group">
                                                <label>OtherPhone</label>
                                                <input class="form-control" name = "OtherPhone" value="<?php echo $data->OtherPhone; ?>" >
                                                <p class="help-block">שם.</p>
                                            </div>

                                            <div class="form-group">
                                                <label>הערות</label>
                                                <textarea name="Notes" class="form-control" rows="3" value="<?php echo $data->Notes; ?>" ></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-default">שמירה</button>

                                        </form>

                                    </div>
                                    <!-- /.col-lg-6 (nested) -->
                                    <div class="col-lg-6">
                                        <form role="form" action="<?php echo $postOrderAddress; ?>" method="POST">
                                            <div class="form-group">
                                                <label>OrderId</label>
                                                <p class="form-control-static"><?php echo $data->OrderId; ?></p>
                                                <input type="hidden" class="form-control" name = "OrderId" value="<?php echo $data->OrderId; ?>" >
                                            </div>

                                            <div class="form-group">
                                                <label>פרטים נוספים</label>
                                                <div class="checkbox">
                                                    <label>
                                                        <input name="Is_Paid_new" type="checkbox"  <?php
                                                        if ($data->Is_Paid == 1) {
                                                            echo "checked";
                                                        }
                                                        ?> value="1">האם שולם
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input name="Is_Delivered_new" <?php
                                                        if ($data->Is_Delivered == 1) {
                                                            echo "checked";
                                                        }
                                                        ?> type="checkbox" value="1">האם  נשלח
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>SUM</label>
                                                <input type="hidden" class="form-control" name = "TotalQuantity" value="<?php echo $data->TotalQuantity; ?>" >
                                                <input type="hidden" class="form-control" name = "TotalPrice" value="<?php echo $data->TotalPrice; ?>" >
                                                <input type="hidden" class="form-control" name = "TotalItems" value="<?php echo $data->TotalItems; ?>" >
                                                <input type="hidden" class="form-control" name = "CallerItemId" value="<?php echo $data->CallerItemId; ?>" >
                                                <input type="hidden" class="form-control" name = "TimeStamp" value="<?php echo $data->TimeStamp; ?>" >
                                                <input type="hidden" class="form-control" name = "Is_Paid" value="<?php echo $data->Is_Paid; ?>" >
                                                <input type="hidden" class="form-control" name = "Is_Delivered" value="<?php echo $data->Is_Delivered; ?>" >

                                                <p class="form-control-static">TotalQuantity <?php echo $data->TotalQuantity; ?></p>
                                                <p class="form-control-static">TotalPrice <?php echo $data->TotalPrice; ?></p>
                                                <p class="form-control-static">TotalItems <?php echo $data->TotalItems; ?></p>
                                            </div>
                                            <button type="submit" class="btn btn-default">שמירה</button>

                                        </form>

                                    </div>
                                    <!-- /.col-lg-6 (nested) -->
                                </div>
                                <h3>
                                    <a href="orderdetails.php?orderid=<?php echo $data->OrderId; ?>">חזרה להזמנה</a>
                                </h3>
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

<?php            require_once 'footer.php';