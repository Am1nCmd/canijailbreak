
<?php
    include 'config.php';
    //$query = mysqli_query($connection, "truncate jb"); # hapus terlebih dahulu table jb 
    //echo shell_exec("./run.sh"); # insert file.csv ke database menggunakan file.sh
?>

<?php

    require_once 'vendor-device/mobiledetect/mobiledetectlib/Mobile_Detect.php';
    $detect = new Mobile_Detect;

    $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
    
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <title>Future Jailbreak Wizard | AmS1gn</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script src="https://kit.fontawesome.com/fbe4824086.js" crossorigin="anonymous"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">
        <center>
            <h1>Can I Jailbreak?</h1>
        </center>
        <?php
            if ($deviceType=='computer' || $detect->version('Android')) { ?>
                <div class="col-lg-12">
                    <div class="panel-body">
                        <div class="alert alert-danger">
                            <center>
                                <h4>Sorry :(</h4>
                                <p>You are not on an iOS or iPadOS device. Are you using iPadOS? <a href="https://t.me/idiphone/3574" target="_blank">Check this out</a></p>
                            </center>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <?php 

                    if ($detect->isIphone()===true) {
                        $devicenya = 'iPhone';
                    } else if ($detect->isIpad()===true || $detect->isTablet()===true) {
                        $devicenya = 'iPad';
                    } else {
                        $devicenya = 'error';
                    }

                    $iosversion = $detect->version($devicenya);
                    #echo $devicenya .' '. $iosversion;

                ?>
                <?php 
                    include 'config.php';
                    $cek = mysqli_query($connection, "select * from jb where device='$devicenya' and ios='$iosversion'");
                ?>
                <?php 
                    if(mysqli_num_rows($cek)>=1) { ?>
                    <div class="col-lg-12">
                        <div class="panel-body">
                            <div class="alert alert-success">
                                <center>
                                    <h4 class="alert-heading"> Good News! ^_^</h4>
                                    <p>Yes, you can jailbreak your <?php echo $devicenya ?> on iOS <?php echo $iosversion ?>
                                </center>
                            </div>
                        </div>
                    </div>
                    <?php 
                        $tp = mysqli_query($connection, "select * from jb where device='$devicenya' and ios='$iosversion'");
                        $hitung = mysqli_num_rows($tp);
                    ?>
                    <div class="col-md-12">
                        <h4>Available Jailbreaks (<?php echo $hitung;?>) : </h4>
                    </div>
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr align="center" style="font-weight: bold;">
                                            <td>iOS</td>
                                            <td>Jailbreak</td>
                                            <td>Support Device</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            while ($data=mysqli_fetch_array($tp)) { 
                                        ?>
                                        <tr align="center">
                                            <td><?php echo $data['ios'] ?></td>
                                            <td>
                                                <a href="<?php echo $data['link'] ?>">
                                                    <?php echo $data['tool_jb'] ?> <i class="fa fa-external-link"></i>
                                                </a>
                                            </td>
                                            <td><?php echo $data['supdev'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <?php 
                        $hnote = mysqli_fetch_array(mysqli_query($connection, "select count(id) as total from jb where device='$devicenya' and ios='$iosversion' AND LENGTH(note) > 10 "));
                        if ($hnote['total']!=0) { ?>
                            <div class="col-lg-4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Notes
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                            $tp2 = mysqli_query($connection, "select * from jb where device='$devicenya' and ios='$iosversion' AND LENGTH(note) > 10");
                                            while ($data2=mysqli_fetch_array($tp2)) { 
                                        ?>
                                        <h4><?php echo $data2['tool_jb'] ?></h4>
                                        <ul>
                                            <li><?php echo $data2['note'] ?></li>
                                        </ul>
                                        <?php } ?>
                                    </div>
                                    <!-- /.panel-body -->
                                </div>
                                <!-- /.panel -->
                            </div>
                        <?php } else { ?>

                        <?php }
                    ?>
                <?php } else { ?>
                    <div class="col-lg-12">
                        <div class="panel-body">
                            <div class="alert alert-danger">
                                <center>
                                    <h4 class="alert-heading">Sadly :'(</h4>
                                    <p>NO Jailbreak for <?php echo $devicenya ?> on iOS <?php echo $iosversion ?></p>
                                </center>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
    </div>
    <?php include 'footer.php'; ?>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <!-- <script src="vendor/raphael/raphael.min.js"></script>
    <script src="vendor/morrisjs/morris.min.js"></script>
    <script src="data/morris-data.js"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
