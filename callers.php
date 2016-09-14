<?php
require_once './managers/web_manager.php';
$manager = new web_manager();
$data = $manager->GetAllCallers();
?>

<?php require_once 'header.php';
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">מתקשרים</h1>
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
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>PhoneNumber</th>
                                    <th>OtherPhone</th>
                                    <th>Notes</th>

                                    <th>edit</th>
                                    <th>New order</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $value) {
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><a href="callersdetails.php?callerid=<?php echo $value->Id; ?>">
    <?php echo $value->Id; ?></a> </td>
                                        <td><?php echo $value->Name; ?></td>
                                        <td><?php echo $value->Address; ?></td>
                                        <td><?php echo $value->City; ?></td>
                                        <td><?php echo $value->PhoneNumber; ?></td>
                                        <td><?php echo $value->OtherPhone; ?></td>
                                        <td><?php echo $value->Notes; ?></td>

                                        <td><a href="addeditcaller.php?func=edit&callerid=<?php echo $value->Id; ?>"> Edit</a> </td>
                                        <td><a href="redirect.php?func=neworder&callerid=<?php echo $value->Id; ?>"> NewOrder</a> </td>

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
        <div class="row">
            <div class="col-lg-12">
                <a href="addeditcaller.php" class="btn btn-default">הוספת מתקשר חדש</a>
            </div>  
        </div>  
        <!-- /.row -->
        <!-- /.row -->
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php require_once 'footer.php';
?>