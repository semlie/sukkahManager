<?php
require_once './managers/web_manager.php';

$manager = new web_manager();
$orderId = isset($_GET["orderid"]) ? $_GET["orderid"] : die();
$postAddress = htmlspecialchars($_SERVER["PHP_SELF"]) . "?XDEBUG_SESSION_START=netbeans-xdebug&orderid=" . $orderId;


if (!empty($_POST)) {

    $manager->AddOrderItem($_POST);
}



$data = !empty($orderId) ? $manager->GetOrder($orderId) : "";
var_dump($data);
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>עריכת הזמנות ופרטי המזמין</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <div id="wrapper">
            <!-- Navigation -->
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

        <!-- jQuery Version 1.11.0 -->
        <script src="js/jquery-1.11.0.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="js/sb-admin-2.js"></script>

    </body>

</html>
