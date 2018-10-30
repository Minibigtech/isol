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
    <link href="<?php echo base_url();?>assets/plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

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
    
    <div id="wrapper">
        <?php $this->load->view('admin/navigation.php');?>
        <?php $this->load->view('admin/left-sidebar.php');?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">video</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>admin/dashboard">Dashboard</a></li>
                            <!-- <li><a href="#">Services</a></li> -->
                            <li class="active">video</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->


                <div class="row">
                    <div class="col-sm-12">
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
                        <div class="white-box">
                            <h3 class="box-title m-b-0">video</h3>
                            <!-- <p class="text-muted m-b-30">Registered Users</p> -->
                            <div class="table-responsive">
                                <table width="100%">
                                    <!-- <tr>
                                        <td colspan="5" align="right">
                                            <a href="<?php //echo base_url();?>admin/add-user" title="Add New"><i class="fa fa-plus"></i></a></a>
                                        </td>
                                    </tr> -->
                                    <tr>
                                        <td colspan="5">
                                            &nbsp;
                                        </td>
                                    </tr>
                                </table>
                                 <form action="<?php echo base_url('admin/deletemultiple_videos');?>" method="post">
                                <a href="<?php echo base_url('admin/add_video');?>" class="btn btn-success pull-right" style="margin-bottom: 20px;">Add Video</a>
                                <div class="col-md-6">
                                    <select class="form-control" name="bulk_action"  onchange="this.form.submit()">
                                    <option value="">Select Bulk Action</option>
                                    <option value="delete">Delete</option>
                                    <option value="active">Activate</option>
                                    <option value="deactive">Deactivate</option>
                                </select>
                            </div>
                                <table id="myTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th><input type="checkbox" name="check" ></th>
                                            <th>Title</th>
                                            <th>Video</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($video as $key => $val){?>
                                        <tr>
                                            <td><?php echo $key+1;?></td>
                                            <td><input type="checkbox" name="video[]" value="<?php echo $val->id;?>"></td>
                                            <td><?php echo $val->title;?></td>
                                            <td> <?php 
                                                    $youtube= substr($val->link,32);
                                                ?><div class="item-video" data-merge="3"><iframe width="200" height="100" src="https://www.youtube.com/embed/<?php echo $youtube;?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></td>
                                            <td><?php 
                                                if($val->status == 1 ){?>
                                                    <a class="btn btn-success" href="<?php echo base_url('admin/deactive_video');?>/<?php echo $val->id;?>">Activate</a>
                                                <?php }else{?>
                                                    <a class="btn btn-danger" href="<?php echo base_url('admin/active_video');?>/<?php echo $val->id;?>">Deactivate</a>
                                                <?php }?></td>
                                            <td>
                                                <a href="<?php echo base_url('admin/edit_video');?>/<?php echo $val->id;?>" class="btn btn-success">
                                                    Edit
                                                </a>
                                                <a href="<?php echo base_url('admin/delete_video');?>/<?php echo $val->id;?>" onclick="return confirm('Are you sure you want to delete this picture?');" class="btn btn-danger">
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </form>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <?php //require_once('right-sidebar.php');?>
            </div>
            <!-- /.container-fluid -->
            <?php $this->load->view('admin/footer');?>
        </div>
        <!-- /#page-wrapper -->
    </div>

    <div class="modal fade" id="successModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                  <p>Record Successfull Updated</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmModal" role="dialog">
        <div class="modal-dialog">
        
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Confirm</h4>
                </div>
                <div class="modal-body">
                  <p>Are You Sure</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success delete">Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                </div>
              </div>
          
        </div>
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
    <script src="<?php echo base_url();?>assets/plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <script>
    var st = $('[name="status"]').val();
    $(document).on('change','[name="status"]', function(){
        //var variables = $(this).val().split(',')[1];
        if( $(this).val() != '' ){
            if( confirm( 'Are You Sure' ) ){ 
                
                $.ajax({
                    url: '<?php echo base_url();?>admin/change-user-status',
                    type: 'POST',
                    data:{'data':$(this).val()},
                    success:function(data){
                        $('#successModal').modal('show');
                        setTimeout(function(){ $('#successModal').modal('hide'); }, 1000);
                    }

                });
            }else{ $(this).val(st); }
        }
    });

    function delete_user(id){
        if( confirm('Are You Sure') ){
            $.ajax({
                url: '<?php echo base_url("admin/delete-user");?>',
                type: 'post',
                data:{'data':id},
                success:function(data){
                    window.location.reload();
                    //console.log(data);
                    //alert(data);
                }
            });

        }

    }

    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;

                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<tr class="group"><td colspan="5">' + group + '</td></tr>'
                            );

                            last = group;
                        }
                    });
                }
            });

            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    </script>
     <script type="text/javascript">
        $(document).on('click','[name="check"]',function (){
            checkbox = $('[name="check"]').is(":checked");
            if(checkbox == true){
                $('input:checkbox').prop("checked", true);
            }else{
                $('input:checkbox').prop("checked", false);
            }
        });
    </script>
    <!--Style Switcher -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>
