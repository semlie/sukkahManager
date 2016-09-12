<?php
require_once './managers/web_manager.php';

$manager = new web_manager();
$productid = isset($_GET["orderid"]) ? $_GET["orderid"] : die();
$postAddress = htmlspecialchars($_SERVER["PHP_SELF"]) . "?XDEBUG_SESSION_START=netbeans-xdebug&orderid=" . $productid;


if (!empty($_POST)) {

    $manager->AddOrderItem($_POST);
}



$data = !empty($productid) ? $manager->GetOrder($productid) : "";
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

                                    <!-- /.col-lg-6 (nested) -->
                                    <div class="col-lg-6">
                                        <form role="form" action="<?php echo $postAddress; ?>" method="POST">
                                            <div class="form-group">
                                                <label>OrderId</label>
                                                <p class="form-control-static"><?php echo $data->OrderId; ?></p>
                                            </div>


                                            <div class="form-group">
                                                <label>ProductId</label>
                                                <input class="form-control" name = "ProductId" value="" >
                                                <p class="help-block">שם.</p>
                                            </div>
                                            <div class="form-group">
                                                <label>Quantity</label>
                                                <input class="form-control" name = "Quantity" value="" >
                                                <p class="help-block">שם.</p>
                                            </div>
                                            <div class="form-group">
                                                <label>שינוי כמות</label>
                                                <input type="hidden" class="form-control" name = "OrderId" value="<?php echo $data->OrderId; ?>" >
                                                <input type="hidden" class="form-control" name = "CollerId" value="<?php echo $data->CallerId; ?>" >
                          



                                            </div>
                                            <button type="submit" class="btn btn-default">שמירה</button>

                                        </form>
                                        <h3>
                                            <a href="orderdetails.php?orderid=<?php echo $data->OrderId; ?>">חזרה להזמנה</a>
                                        </h3>
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
<?php            require_once 'footer.php';