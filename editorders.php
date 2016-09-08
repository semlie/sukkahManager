<?php
require_once './managers/web_manager.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$manager = new web_manager();
$orderId = isset($_GET["orderid"]) ? $_GET["orderid"] : "";
$func = isset($_GET["func"]) ? $_GET["func"] : '';
$postOrderAddress = htmlspecialchars($_SERVER["PHP_SELF"]) . "?XDEBUG_SESSION_START=netbeans-xdebug&func=order&orderid=" . $orderId;
$postCallerAddress = htmlspecialchars($_SERVER["PHP_SELF"]) . "?XDEBUG_SESSION_START=netbeans-xdebug&func=caller&orderid=" . $orderId;


if (!empty($_POST)) {
    if ($func == "order") {
        $manager->UpdateOrder($_POST);
    }
    if ($func == "caller") {
        $manager->UpdateCaller($_POST);
    }
}
$data = !empty($orderId) ? $manager->GetOrder($orderId) : "";
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

        <!-- jQuery Version 1.11.0 -->
        <script src="js/jquery-1.11.0.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->

        <!-- Custom Theme JavaScript -->
        <script src="js/sb-admin-2.js"></script>

    </body>

</html>
