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

<body class="fix-sidebar">
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
                        <h4 class="page-title">Terms & Conditions</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>admin/dashboard">Dashboard</a></li>
                            
                            <li class="active">Terms & Conditions</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                
                <!--.row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">Add Terms  & Conditions</div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <form action="<?php echo base_url();?>admin/add-deal-list" method="post" enctype="multipart/form-data">
                                        <div class="form-body">
                                            
                                            <div class="row">

                                                <div class="col-md-12">

                                                    <?php if( $this->session->flashdata('error') ):?>
                                                    <div class="alert alert-success alert-dismissable">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                                        <?php echo $this->session->flashdata('error');?>
                                                    </div>
                                                    <?php endif; ?>

                                                    <div class="form-group">
                                                        <label class="control-label">Deal Title</label>
                                                        <input type="text" class="form-control" name="title" placeholder="Get best deals on footwear" value="" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Photo</label>
                                                        <input type="file" class="form-control" name="photo">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Deal Link</label>
                                                        <input type="text" class="form-control" name="link" placeholder="https://www.google.com/" value="">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <select class="form-control" name="status" required>
                                                            <option value="">--Select--</option>
                                                            <option value="1">Active</option>
                                                            <option value="0">Deactive</option>
                                                        </select>
                                                    </div>

                                                </div>

                                                

                                            </div>
                                            <!--/row-->
                                            
                                            
                                            
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                            <button type="button" class="btn btn-default">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--./row-->
                
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
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>assets/admin/js/custom.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/jasny-bootstrap.js"></script>
    <!--Style Switcher -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>
