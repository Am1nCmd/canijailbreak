
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
                    <?php 
                        while ($data=mysqli_fetch_array($tp)) { 
                    ?>
                    <div class="col-lg-4">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <b>
                                    <i class="fa fa-apple"></i>
                                    <?php echo $data['tool_jb'] ?>
                                </b>
                            </div>
                            <div class="panel-body">
                                <?php
                                    if ($data['supdev']==='') { ?>
                                        <!-- <p>kosong</p> -->
                                    <?php } else { ?>
                                        <p><img src="images/laptop-mobile.svg" width="30" height="30"> <?php echo $data['supdev'] ?></i></p>
                                    <?php }
                                ?>
                                <?php
                                    if ($data['note']==='') { ?>
                                        <!-- <p>kosong</p> -->
                                    <?php } else { ?>
                                        <p><?php echo $data['note'] ?></p>
                                    <?php }
                                ?>
                            </div>
                            <a href="<?php echo $data['link'] ?>" target="_blank">
                                <div class="panel-footer">
                                    <span class="pull-left">Visit Website</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php } ?>
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
    <script src="vendor/raphael/raphael.min.js"></script>
    <script src="vendor/morrisjs/morris.min.js"></script>
    <script src="data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
