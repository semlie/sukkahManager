<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

require_once './managers/web_manager.php';
$manager = new web_manager();
$data = '';
$getAddress = htmlspecialchars($_SERVER["PHP_SELF"]);
//            $data = $manager->GetAllOrders();
$region = isset($_GET["region"]) ? $_GET["region"] : "";
if ($region != '') {

    $data = $manager->GetAllOpenOrdersFilterd($region);
} else {
    $data = $manager->GetAllOpenOrders();
}

function discountPrice($price) {
    if (intval($price) >= 300) {
        return sprintf('<br><b><u>%1$s</u></b>', $price * 1);
    }
}
?>


<?php require_once 'header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">הזמנות</h1>
        </div>
        <div class="col-lg-6">
            <form role="form" action="<?php echo $getAddress; ?>" method="GET">
                <div class="form-group">
                    <label>איזור</label>
                    <input class="form-control" name = "region" value="" >
                </div>
                <button type="submit" class="btn btn-default">סנן</button>

            </form>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    כל ההזמנות 
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>OrderId</th>
                                    <th>Region</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>PhoneNumber</th>
                                    <th>OtherPhone</th>
                                    <th>Notes</th>
                                    <th>Is_Delivered</th>
                                    <th>Is_Paid</th>
                                    <th>TotalQuantity</th>
                                    <th>TotalPrice</th>
                                    <th>TotalItems</th>
                                    <th>edit</th>
                                    <th>delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $value) {
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><a href="orderdetails.php?orderid=<?php echo $value->OrderId; ?>"> <?php echo $value->OrderId; ?></a> </td>
                                        <td><?php echo $value->Region; ?></td>
                                        <td><?php echo $value->Name; ?></td>
                                        <td><?php echo $value->Address; ?></td>
                                        <td><?php echo $value->City; ?></td>
                                        <td><?php echo $value->PhoneNumber; ?></td>
                                        <td><?php echo $value->OtherPhone; ?></td>
                                        <td><?php echo $value->Notes; ?></td>
                                        <td><?php echo $value->Is_Delivered; ?></td>
                                        <td><?php echo $value->Is_Paid; ?></td>
                                        <td><?php echo $value->TotalQuantity; ?></td>
                                        <td><?php
                                            echo $value->TotalPrice;
                                            echo discountPrice($value->TotalPrice)
                                            ?></td>
                                        <td><?php echo $value->TotalItems; ?></td>
                                        <td><a href="editorders.php?orderid=<?php echo $value->OrderId; ?>"> Edit</a> </td>
                                        <td><a href="redirect.php?func=deleteorder&orderid=<?php echo $value->OrderId; ?>"> delete</a> </td>

                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->

                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <!-- /.row -->
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php
require_once 'footer.php';
