<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
$func = isset($_GET["func"]) ? $_GET["func"] : '';
require_once './managers/web_manager.php';
$manager = new web_manager();
$getAddress = htmlspecialchars($_SERVER["PHP_SELF"]) . "?func=filter";
//            $data = $manager->GetAllOrders();
$data ='';
if ($func == 'filter') {
    $region = isset($_GET["region"]) ? $_GET["region"] : '3';
    $data = $manager->GroupingFilteredProduct($region);
} else {

    $data = $manager->GroupingProduct();
}
$totalPrice = GetTotlPrice($data);
$totalQuntity =  GetTotlaQuntity($data);
function _getTotalQuntity($carry,$item) {
    return $carry+$item->Quntity;
}
function _getTotalPrice($carry,$item) {
    return $carry+$item->TotelPrice;
}
function GetTotlaQuntity($data) {
    return array_reduce($data, '_getTotalQuntity');
}
function GetTotlPrice($data) {
    return array_reduce($data, '_getTotalPrice');
}
?>


<?php require_once 'header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">הזמנות</h1>
        </div>
        <div class="col-lg-6">
            <form role="form" action="<?php echo $getAddress; ?>" method="GET">
                <div class="form-group">
                    <label>איזור</label>
                 <input class="form-control" name = "region" value="" >
                 <input type="hidden" class="form-control" name = "func" value="filter" >
                </div>
                <button type="submit" class="btn btn-default">שמירה</button>

            </form>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    סיכום מוצרים מוזמנים
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>ProductId</th>
                                    <th>CatalogNumber</th>
                                    <th>Name</th>
                                    <th>Totel Quantity</th>
                                    <th>Total Price</th>
                                    <th>Category</th>
                                    <th>edit</th>
                                </tr>
                            </thead>
                            <tbody>
<?php foreach ($data as $value) {
    ?>
                                    <tr class="odd gradeX">
                                        <td><a href="addeditproducts.php?productid=<?php echo $value->Id; ?>"> <?php echo $value->Id; ?></a> </td>
                                        <td><?php echo $value->CatalogNumber; ?></td>
                                        <td><?php echo $value->Name; ?></td>
                                        <td><?php echo $value->Quntity; ?></td>
                                        <td><?php echo $value->TotelPrice; ?></td>
                                        <td><?php echo $value->Category; ?></td>

                                        <td><a href="addeditproducts.php?productid=<?php echo $value->Id; ?>"> Edit</a> </td>

                                    </tr>
<?php } ?>

                            </tbody>
                        </table>
                        
                    </div>
                    <div class="col-lg-6">
                        Total price: <?php echo $totalPrice; ?><br>
                        Total Quantity: <?php echo $totalQuntity; ?><br>
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
