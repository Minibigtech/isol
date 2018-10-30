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

                        <h4 class="page-title">Users</h4>

                    </div>

                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                        <ol class="breadcrumb">

                            <li><a href="<?php echo base_url();?>admin/dashboard">Dashboard</a></li>

                            <!-- <li><a href="#">Services</a></li> -->

                            <li class="active">Users</li>

                        </ol>

                    </div>

                    <!-- /.col-lg-12 -->

                </div>

                <!-- /row -->

                <div class="row">

                    <div class="col-sm-12">

                        <?php if( $this->session->flashdata('banner') ):?>

                        <div class="alert alert-success alert-dismissable">

                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>

                            <?php echo $this->session->flashdata('banner');?>

                        </div>

                        <?php endif; ?>

                        <div class="white-box">

                            <h3 class="box-title m-b-0">Users</h3>

                            <div class="table-responsive">

                                <table width="100%">

                                    <tr>

                                        <td colspan="5" align="right">

                                            <!-- <a href="<?php //echo base_url();?>admin/add-home-slide" title="Add New"><i class="fa fa-plus"></i></a> --></a>

                                        </td>

                                    </tr>

                                    <tr>

                                        <td colspan="5">

                                            &nbsp;

                                        </td>

                                    </tr>

                                </table>

                                <table id="myTable" class="table table-striped">

                                    <thead>

                                        <tr>

                                            <th>S.No</th>

                                            <th>First name</th>

                                            <th>Last name</th>

                                            <th>Email</th>

                                            <th>Register Date</th>

                                            <th>Status</th>

                                            <th>Action</th>

                                       <!-- <th>Action</th> -->

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php if( !empty($users) ):?>

                                        <?php $count = 1;?>

                                        <?php foreach( $users as $value ):?>

                                        <tr>

                                            <td><?php  echo $count;?></td>

                                            <td><?php  echo $value->u_firstname;?></td>

                                            <td><?php  echo $value->u_lastname;?></td>

                                            <td><?php  echo $value->u_email;?></td>

                                            <td><?php  echo $value->u_register_date;?></td>

                                    <td>

                                        <select name ="user_status" id = "<?php echo $value->u_id ?>"> 

                                        

                                            <option  value = "1" <?php echo ($value->u_status==1) ?'selected':'' ?>><?php echo "Active"  ?></option>

                                            <option value =  "0" <?php echo ($value->u_status==0) ?'selected':'' ?>><?php echo "Pending"  ?></option>

                                        </select>



                                    </td>



                                            <td>

                                                <a href="javascript:;" onclick ="delete_user(<?php echo $value->u_id ?>)"><i class="fa fa-trash" title="Delete"></i></a><!--  | 

                                                <a href="javascript:;" id="<?php echo $value->cl1_id;?>" title="Delete"><i class="fa fa-trash" ></i></a>--> 

                                            </td>

                                            

                                        </tr>

                                        <?php $count++;?>

                                        <?php endforeach;?>

                                        <?php endif;?>

                                        

                                        

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

    <!--Style Switcher -->

    <script src="<?php echo base_url();?>assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>





    <script type="text/javascript">

        

    $(document).ready(function(){



            //alert("working");



       

            

        $('select[name=user_status]').on('change', function() {

            

                var object    = $('select[name=user_status]'); 

                var status_id = object.val();

                var user_id  = object.attr('id');



                

                $.ajax({



                    url:'<?php echo base_url() ?>admin/user-status',

                    type:'POST',

                    data:{'user_id':user_id,'status_id':status_id},

                    success:function(data){



                       alert(data);

                       window.location.reload();

                       //alert('order status is successfuly updated'); 





                    }



                });   



        });





});





       function  delete_user(user_id)

       {

            if( confirm( 'Are You sure deleting user,will delete all the related records of user' ) ){

            $.ajax({





                    url:'<?php echo base_url() ?>admin/user-delete',

                    type:'POST',

                    data:{'user_id':user_id},

                    success:function(data){



                    alert(data);

                    window.location.reload();        





                    }



            });



        }



       }

</script>











</body>



</html>

