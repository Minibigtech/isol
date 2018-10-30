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
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bower_components/dropify/dist/css/dropify.min.css">

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
    <?php $this->load->view('admin/navigation.php');?>
    <?php $this->load->view('admin/left-sidebar.php');?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Add Video</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>admin/dashboard">Dashboard</a></li>
                        <li><a href="<?php echo base_url();?>admin/listing">Add Video</a></li>
                        <li class="active">Video Create</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
     
            <!--.row-->
            <div class="row">
                    <div class="col-sm-12">
                        <a href="<?php echo base_url('admin/list_video');?>" class="btn btn-success pull-right" style="margin-top: 10px;margin-right: 10px">List Video</a>
                        <?php if( $this->session->flashdata('success') ):?>
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <?php echo $this->session->flashdata('success');?>
                        </div>
                        <?php endif; ?>
                        <?php if( $this->session->flashdata('danger') ):?>
                        <div class="alert alert-danger alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <?php echo $this->session->flashdata('danger');?>
                        </div>
                        <?php endif; ?>
                        <div class="white-box p-l-20 p-r-20">
                            <h3 class="box-title m-b-0">Create video</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-material form-horizontal" method="post" action="<?php echo base_url('admin/insert_video');?>" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="text" name="title" class="form-control" placeholder="Title" required=""><br>
                                                <label>Short Description</label>
                                                <textarea name="short_description" class="form-control"></textarea>
                                                <label class="radio-inline"><input type="radio" name="optradio" checked="" value="youtube">YouTube</label>
                                                <!-- <label class="radio-inline"><input type="radio" name="optradio" value="dailymotion">Dailymotion</label> -->
                                                <input type="text" name="link" required="" class="form-control" placeholder="link">
                                            </div>
                                        </div>
                                </div>
                                <input type="hidden" name="user_id" class="form-control" placeholder="Category Name" required="" value="<?php echo $this->session->userdata('backend_admin')['auth_id']?>">
                                    <div class="col-md-12 form-material form-horizontal">
                                        <input type="submit" class="btn btn-success pull-right" >
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!--./row-->
            <?php //$this->load->view('right-sidebar.php');?>
        </div>
        <!-- /.container-fluid -->
        <?php $this->load->view('admin/footer.php');?>
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
<script src="<?php echo base_url();?>assets/bower_components/dropify/dist/js/dropify.min.js"></script>

<!--Style Switcher -->
<script src="<?php echo base_url();?>assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>

<script type="text/javascript">
    $(document).on('change','#role_select',function (){
        role=$(this).val();
        if(role != ''){
            $('#save_button').show('slow');
            $('#permission_table').show('slow');
        }else{
            $('#save_button').hide('slow');
            $('#permission_table').hide('slow');
        }
    });
</script>

<!-- Ajax call for fetching user permissions -->
<script type="text/javascript">    
    $(document).on('change','#role_select',function() {
        role=$(this).val();
        if(role == ''){
            return false;
        }
    $.ajax({
            url: '<?php echo base_url('admin/get-permissions'); ?>',
            type: 'POST',
            data: {
                'role_id': role
            },
            dataType: 'json',
            success: function(data) {
                if(data==false){
                    for(var i=0;i<8;i++){
                        $('#allow_create'+i).prop('checked' , false);
                        $('#allow_view'+i).prop('checked' , false);
                        $('#allow_update'+i).prop('checked' , false);
                        $('#allow_delete'+i).prop('checked' , false);
                    }
                    return false;
                }
                for(var i=0 ; i<data.length ; i++){
                    if(data[i].allow_create == 1){
                    $('#allow_create'+i).prop('checked' , true);
                    }else{
                        $('#allow_create'+i).prop('checked' , false);
                    }
                    if(data[i].allow_view == 1){
                        $('#allow_view'+i).prop('checked' , true);
                    }else{
                        $('#allow_view'+i).prop('checked' , false);
                    }
                    if(data[i].allow_update == 1){
                        $('#allow_update'+i).prop('checked' , true);
                    }else{
                        $('#allow_update'+i).prop('checked' , false);
                    }
                    if(data[i].allow_delete == 1){
                        $('#allow_delete'+i).prop('checked' , true);
                    }else{
                        $('#allow_delete'+i).prop('checked' , false);
                    }
                }
            }
        });
    });
</script>
</body>
</html>
