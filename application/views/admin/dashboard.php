<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>assets/plugins/images/favicon.png">
    <title><?php echo site_title;?></title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/admin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="<?php echo base_url();?>assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="<?php echo base_url();?>assets/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="<?php echo base_url();?>assets/plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?php echo base_url();?>assets/admin/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/admin/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?php echo base_url();?>assets/admin/css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <script>
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-19175540-9', 'auto');
    ga('send', 'pageview');
    </script>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
        <?php require_once('navigation.php');?>
        <?php require_once('left-sidebar.php');?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <!-- <li><a href="#">Dashboard</a></li> -->
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <div class="row row-in">
                                
                                <div class="col-lg-6 col-sm-6 row-in-br">
                                    <div class="col-in row">
                                        <div class="col-md-6 col-sm-6 col-xs-6"> <i class="fa fa-product-hunt" aria-hidden="true"></i> <!-- <i data-icon="E" class="linea-icon linea-basic"></i> -->
                                            <h5 class="text-muted vb">Products</h5>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <h3 class="counter text-right m-t-15 text-danger">
                                                <?php //$this->db->select('COUNT(u_id) AS total')->from('users');?>
                                                <?php //$sql = $this->db->get();?>
                                                <?php //echo $sql->num_rows()>0?$sql->row()->total:0;?>
                                            </h3>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php //echo $sql->num_rows()>0?$sql->row()->total:0;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php //echo $sql->num_rows()>0?$sql->row()->total:0;?>%"> <span class="sr-only"><?php //echo $sql->num_rows()>0?$sql->row()->total:0;?>% Complete (success)</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 row-in-br  b-r-none">
                                    <div class="col-in row">
                                        <div class="col-md-6 col-sm-6 col-xs-6"> <i class="fa fa-shopping-cart" aria-hidden="true"></i><!-- <i class="linea-icon linea-basic" data-icon="&#xe01b;"></i> -->
                                            <h5 class="text-muted vb">Orders</h5>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <h3 class="counter text-right m-t-15 text-megna">
                                                <?php //$this->db->select('COUNT(ul_id) AS total')->from('user_listing');?>
                                                <?php //$sql = $this->db->get();?>
                                                <?php //echo $sql->num_rows()>0?$sql->row()->total:0;?>
                                            </h3>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-megna" role="progressbar" aria-valuenow="<?php //echo $sql->num_rows()>0?$sql->row()->total:0;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php //echo $sql->num_rows()>0?$sql->row()->total:0;?>%"> <span class="sr-only"><?php //echo $sql->num_rows()>0?$sql->row()->total:0;?>% Complete (success)</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                

                                

                                

                                


                            </div>
                        </div>
                    </div>
                </div>
                <!--row -->
                
                
                
                
                <?php //require_once('right-sidebar.php');?>
           
            </div>
            <!-- /.container-fluid -->
            
            <?php require_once('footer.php');?>

            
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/admin/bootstrap/dist/js/tether.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="<?php echo base_url();?>assets/admin/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url();?>assets/admin/js/waves.js"></script>
    <!--Counter js -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/counterup/jquery.counterup.min.js"></script>
    <!--Morris JavaScript -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/raphael/raphael-min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/morrisjs/morris.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>assets/admin/js/custom.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/dashboard1.js"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/bower_components/toast-master/js/jquery.toast.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $.toast({
            heading: 'Welcome to <?php echo site_title;?> Administrator Office',
            text: '<?php echo date("Y-m-d h:i:sa");?>',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'info',
            hideAfter: 3500,

            stack: 6
        })
    });
    </script>
    <!--Style Switcher -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>
