<?php
require_once './managers/web_manager.php';
$manager = new web_manager();
$productid = isset($_GET["orderid"]) ? $_GET["orderid"] : "";
$data = !empty($productid) ? $manager->GetOrder($productid) : die();
$counter = 0;
$orderItems = $manager->GetAllOrderItems($productid);

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
                        <h1 class="page-header">הזמנה מספר - 102<?php echo $data->OrderId; ?></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                פרטי המזמין
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body"><div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>OrderId</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>City</th>
                                                <th>PhoneNumber</th>
                                                <th>OtherPhone</th>
                                                <th>TotalQuantity</th>
                                                <th>TotalPrice</th>
                                                <th>TotalItems</th>
                                                <th>edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr class="odd gradeX">
                                                <td><?php echo $data->OrderId; ?></td>
                                                <td><?php echo $data->Name; ?></td>
                                                <td><?php echo $data->Address; ?></td>
                                                <td><?php echo $data->City; ?></td>
                                                <td><?php echo $data->PhoneNumber; ?></td>
                                                <td><?php echo $data->OtherPhone; ?></td>
                                                <td><?php echo $data->TotalQuantity; ?></td>
                                                <td><?php
                                                    echo $data->TotalPrice;
                                                    echo discountPrice($data->TotalPrice)
                                                    ?></td>
                                                <td><?php echo $data->TotalItems; ?></td>
                                                <td><a href="editorders.php?orderid=<?php echo $data->OrderId; ?>"> Edit</a> </td>

                                            </tr>



                                        </tbody>
                                    </table>
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <tbody>
                                            <tr class="odd gradeX">
                                                <td><?php echo $data->Notes; ?></td>

                                            </tr>

                                        </tbody>
                                    </table>

                                </div>
                                <!-- /.table-responsive -->

                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                פרטי הזמנה
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>ProductId</th>
                                                <th>ProductName</th>
                                                <th>Quantity</th>
                                                <th>PriceUnit</th>
                                                <th>Price</th>
                                                <th>edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($orderItems as $value) {
                                                $counter++;
                                                ?>
                                                <tr>
                                                    <td><?php echo $counter; ?></td>
                                                    <td><?php echo $value->ProductId; ?></td>
                                                    <td><?php echo $value->ProductName; ?></td>
                                                    <td><?php echo $value->Quantity; ?></td>
                                                    <td><?php echo $value->PriceUnit; ?></td>
                                                    <td><?php echo $value->PriceOrderItem; ?></td>
                                                    <td><a href="editorderitems.php?orderitemid=<?php echo $value->Id; ?>">Edit</a></td>

                                                </tr>
<?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <a href="addorderItems.php?orderid=<?php echo $data->OrderId; ?>" class="btn btn-info" role="button">Add New Item To Order</a>

                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-6 -->
                    <!-- /.col-lg-6 -->
                </div>
                <!-- /.row -->
                <!-- /.row -->
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

<?php            require_once 'footer.php';