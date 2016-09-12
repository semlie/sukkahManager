<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

require_once './managers/web_manager.php';
            $manager = new web_manager();
//            $data = $manager->GetAllOrders();
            $data = $manager->GetAllProducts();

            
            ?>


<?php            require_once 'header.php';
?>
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">מוצרים</h1>
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
                                                <th>Category</th>
                                                <th>Name</th>
                                                <th>Size</th>
                                                <th>Price</th>
                                                <th>RegularPrice</th>
                                                <th>edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data as $value) {
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td><a href="addeditproducts.php?productid=<?php echo $value->Id; ?>"> <?php echo $value->Id; ?></a> </td>
                                                    <td><?php echo $value->CatalogNumber; ?></td>
                                                    <td><?php echo $value->Category; ?></td>
                                                    <td><?php echo $value->Name; ?></td>
                                                    <td><?php echo $value->Size; ?></td>
                                                    <td><?php echo $value->Price; ?></td>
                                                    <td><?php echo $value->RegularPrice; ?></td>
                                                    
                                                    <td><a href="addeditproducts.php?productid=<?php echo $value->Id; ?>"> Edit</a> </td>

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

<?php            require_once 'footer.php';