<?php
require_once './managers/web_manager.php';

$manager = new web_manager();
$productid = isset($_GET["productid"]) ? $_GET["productid"] : '';
$func = isset($_GET["func"]) ? $_GET["func"] : 'new';
$address = sprintf('?XDEBUG_SESSION_START=netbeans-xdebug%1$s', ($func == "edit") ? "&func=edit&productid=" . $productid : '');

$postAddress = htmlspecialchars($_SERVER["PHP_SELF"]) . $address;
if (!empty($_POST)) {
    if ($func == "new") {
        $manager->AddNewProduct($_POST);
    }
    if ($func == "edit") {
        $manager->UpdateProduct($_POST);
    }
}


$data = !empty($productid) ? $manager->GetProductById($productid) : new product();
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
                                    <label>שם</label>
                                    <input class="form-control" name = "Name" value="<?php echo $data->Name; ?>" >
                                    <p class="help-block">שם.</p>
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input class="form-control" name = "Price" value="<?php echo $data->Price; ?>" >
                                </div>
                                <div class="form-group">
                                    <label>RegularPrice</label>
                                    <input class="form-control" name = "RegularPrice" value="<?php echo $data->RegularPrice; ?>" >
                                </div>
                                <div class="form-group">
                                    <label>Size</label>
                                    <input class="form-control" name = "Size" value="<?php echo $data->Size; ?>" >
                                </div>
                                <div class="form-group">
                                    <label>CatalogNumber</label>
                                    <input class="form-control" name = "CatalogNumber" value="<?php echo $data->CatalogNumber; ?>" >
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <input class="form-control" name = "Category" value="<?php echo $data->Category; ?>" >
                                </div>

                                                <input type="hidden" class="form-control" name = "ProductId" value="<?php echo $data->Id; ?>" >

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
