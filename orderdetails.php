<?php
require_once './managers/web_manager.php';
$manager = new web_manager();
$orderId = isset($_GET["orderid"]) ? $_GET["orderid"] : "";
$data = !empty($orderId) ? $manager->GetOrder($orderId) : die();
$counter = 0;
$orderItems = $manager->GetAllOrderItems($orderId);

function discountPrice($price) {
    if (intval($price) >= 300) {
        return sprintf('<br><b><u>%1$s</u></b>', $price * 0.94);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>פרוט הזמנה</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">


        <!-- Custom CSS -->
        <link href="css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style type="text/css" media="print">
            @page {
                size: auto;   /* auto is the initial value */
                margin: 0;  /* this affects the margin in the printer settings */
            }
        </style>
    </head>

    <body>

        <div id="wrapper">

            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">גרביים</a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">

                    <!-- /.dropdown -->

                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">

                            <li>
                                <a href="orders.php"><i class="fa fa-dashboard fa-fw"></i> Orders</a>
                            </li>

                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>


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

        <!-- jQuery Version 1.11.0 -->
        <script src="js/jquery-1.11.0.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>



        <!-- Custom Theme JavaScript -->
        <script src="js/sb-admin-2.js"></script>

        <!-- Page-Level Demo Scripts - Tables - Use for reference -->


    </body>

</html>
