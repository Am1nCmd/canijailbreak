<?php
    include 'config.php';
    $query = mysqli_query($connection, "truncate jb"); # hapus terlebih dahulu table jb 
    echo shell_exec("./run.sh"); # insert file.csv ke database menggunakan file.sh
?>

<?php

	require_once 'vendor/mobiledetect/mobiledetectlib/Mobile_Detect.php';
	$detect = new Mobile_Detect;

	$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
	
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no"/>
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
	<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <title>Future Jailbreak Wizard | AmS1gn</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/helper.css" rel="stylesheet">
    <!-- link href="css/style.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->
    <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <script src="//code.jquery.com/jquery-1.7.1.min.js"></script>
</head>

<body class="fix-header fix-sidebar">
    <!-- Main wrapper  -->
    <div id="main-wrapper">

        <?php 
            if ($deviceType=='computer' || $detect->version('Android')) { ?>
            <div class="unix-login">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-body">
                                            <h4 class="card-title"></h4>
                                            <div class="card-content">
                                                <center><h1>Can I Jailbreak?</h1></center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card-body">
                        <h4 class="card-title"></h4>
                        <div class="card-content">
                            <div class="alert alert-warning" role="alert">
                                <h4 class="alert-heading">Sorry :(</h4>
                                <p>You are not on an iOS or iPadOS device. Are you using iPadOS? <a href="https://t.me/idiphone/3574" target="_blank">Check this out</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>

                <div class="unix-login">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-body">
                                            <h4 class="card-title"></h4>
                                            <div class="card-content">
                                                <center><h1>Can I Jailbreak?</h1></center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
                        <div class="unix-login">
                            <div class="container-fluid">
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                
                                                    <div class="card-body">
                                                        <h4 class="card-title"></h4>
                                                        <div class="card-content">
                                                            <div class="alert alert-success" role="alert">
                                                                <h4 class="alert-heading"> Good News! ^_^</h4>
                                                                <p>Yes, you can jailbreak your <?php echo $devicenya ?> on iOS <?php echo $iosversion ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                        </div>
                                        <div class="row">
										<?php 
											$tp = mysqli_query($connection, "select * from jb where device='$devicenya' and ios='$iosversion'");
											$hitung = mysqli_num_rows($tp);
										?>
                                            <div class="col-md-6">
                                                <h4>Available Jailbreaks (<?php echo $hitung;?>) : </h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <?php 
                                                while ($data=mysqli_fetch_array($tp)) {
                                            ?>
                                            <div class="col-md-6">
                                                <div class="card p-30">
                                                    <div class="media">
                                                        <table border="0" width="100%">
                                                            <tr align="center">
                                                                <td colspan="2">
                                                                        <h2 align="center"><?php echo $data['tool_jb'] ?></h2>
                                                                        <a href="<?php echo $data['link'] ?>" target="_blank"><p align="center" class="m-b-0">Visit Website</p></a>
                                                                </td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <hr>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <h2 align="center"><img src="images/iphones.svg" width="30" height="30"> <?php echo $data['supdev'] ?></i></h2>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <p align="center"><?php echo $data['note'] ?></p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="unix-login">
                            <div class="container-fluid">
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <div class="card-body">
                                            <h4 class="card-title"></h4>
                                            <div class="card-content">
                                                <div class="alert alert-danger" role="alert">
                                                    <h4 class="alert-heading">Sadly :'(</h4>
                                                    <p>NO Jailbreak for <?php echo $devicenya ?> on iOS <?php echo $iosversion ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                ?>

            <?php }
        ?>
    </div>
    <!-- End Wrapper -->
    <!-- All Jquery -->
    <script src="js/lib/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>

</body>
    <br>
    <center><a href="https://docs.google.com/spreadsheets/d/1QjWyoDfaiF-TWhzVdvEMRqA3OQXsz6e8of3SxZB1W_M/edit?usp=sharing">Complete Jailbreak Chart ></a></center>
    <br>
    <center><a href="https://appledb.dev/device-selection/">Devices Selection ></a></center>
    <br><a style="color:black;"><center>Looking for FutureRestore?</center>
        <center><a href="https://docs.google.com/spreadsheets/d/1Mb1UNm6g3yvdQD67M413GYSaJ4uoNhLgpkc7YKi3LBs/edit?fbclid=IwAR10JCtGhCg2RfIVUnIAjOAt4aMLoz80pWEL8Kqs2zaLX2bislT3KUU0Hw8#gid=0">SEP/BB Compability Chart ></a></center>

	<?php include 'footer.php';?>
</html>