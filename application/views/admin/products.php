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
                        <h4 class="page-title">Products</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>admin/dashboard">Dashboard</a></li>
                            <!-- <li><a href="#">Services</a></li> -->
                            <li class="active">Products</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <?php if( $this->session->flashdata('prod') ):?>
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <?php echo $this->session->flashdata('prod');?>
                        </div>
                        <?php endif; ?>
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Products</h3>
                            <div class="table-responsive ">
                                <div class="form-group col-md-2">
                                    <select class="form-control filter-country selectable">
                                        <option value="">Select Country</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <select class="form-control filter-uploader selectable">
                                        <option value="">Select uploader</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <select class="form-control filter-price selectable">
                                        <option value="">Select price</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <select class="form-control filter-date selectable">
                                        <option value="">Select date</option>
                                    </select>
                                </div>
                                <table width="100%">
                                    <tr>
                                        <td colspan="5" align="right">
                                            <a href="<?php echo base_url();?>admin/add-product" title="Add New"><i class="fa fa-plus"></i></a></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            &nbsp;
                                        </td>
                                    </tr>
                                </table>
                                <table border="0" cellspacing="5" cellpadding="5">
                                <tbody><tr>
                                    <td>Minimum age:</td>
                                    <td><input type="text" id="min" name="min"></td>
                                </tr>
                                <tr>
                                    <td>Maximum age:</td>
                                    <td><input type="text" id="max" name="max"></td>
                                </tr>
                            </tbody></table>
                                <table id="myTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th id="filter-price">Price</th>
                                            <th>Stock</th>
                                            <th id="filter-country">Country</th>
                                            <th>Latest</th>
                                            <th>Featured</th>
                                            <th>Hot</th>
                                            <th>Status</th>
                                            <th id="filter-uploader">Created At</th>
                                            <th>Updated At</th>
                                            <th id="filter-date">Uploaded Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if( !empty($products) ):?>
                                        <?php $count = 1;?>
                                        <?php foreach( $products as $value ):?>
                                        <tr>
                                            <td><?php echo $count;?></td>
                                            <td><?php echo $value->product_photo!=''?'<img src="'.base_url('assets/images/products/').$value->product_photo.'" style="width:100px; hight:100px">':'<img src="'.base_url('assets/images/no-image.png').'" style="width:100px; hight:100px">';?></td>
                                            <td><?php echo $value->product_title;?></td>
                                            <td><?php echo $value->product_price;?></td>
                                            <td><?php echo $value->product_stock;?></td>
                                            <td><?php echo $value->country;?></td>
                                            <td><?php echo $value->product_latest==1?'Yes':'No';?></td>
                                            <td><?php echo $value->product_featured==1?'Yes':'No';?></td>
                                            <td><?php echo $value->product_hot==1?'Yes':'No';?></td>
                                            <td><?php echo $value->product_status==1?'Active':'Deactive';?></td>
                                            <td><?php echo 
                                            $this->db->query('select admin_firstname from administrator where admin_id = '.$value->created_by)->row()->admin_firstname;
                                            ?></td>
                                            <td><?php  echo 
                                            $this->db->query('select admin_firstname from administrator where admin_id = '.$value->updated_by)->row()->admin_firstname;
                                            ?></td>
                                            <td><?php echo $value->upload_date;?></td>
                                            <td>
                                                <a href="<?php echo base_url();?>admin/edit-product/<?php echo $value->product_id;?>"><i class="fa fa-pencil" title="Edit"></i></a>
                                                   
                                                  <?php if($this->session->userdata('logged_admin_id') == 1){?>
                                                    |
                                                <a href="javascript:;" id="<?php echo $value->product_id;?>" title="Delete"><i class="fa fa-trash" ></i></a>  
                                            <?php }?>
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
        $('#myTable').dataTable({
        initComplete: function () {
            this.api().columns('#filter-country').every( function () {
                var column = this;
                var select = $('.filter-country')
                    //.appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var search = [];

                          $.each($('.filter-country option:selected'), function(){
                              search.push($(this).val());
                          });
                          
                          search = search.join('|');
                        column
                            .search( search, true, false )
                            .draw();
                    } );
                column.data().unique().sort().each( function ( d, j ) {
                    if(d!="")
                    {
                      select.append( '<option value="'+d+'">'+d+'</option>' )
                    }
                });
            });
            this.api().columns('#filter-uploader').every( function () {
                var column = this;
                var select = $('.filter-uploader')
                    //.appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var search = [];

                          $.each($('.filter-uploader option:selected'), function(){
                              search.push($(this).val());
                          });
                          
                          search = search.join('|');
                        column
                            .search( search, true, false )
                            .draw();
                    } );
                column.data().unique().sort().each( function ( d, j ) {
                    if(d!="")
                    {
                      select.append( '<option value="'+d+'">'+d+'</option>' )
                    }
                });
            });
            this.api().columns('#filter-price').every( function () {
                var column = this;
                var select = $('.filter-price')
                    //.appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var search = [];

                          $.each($('.filter-price option:selected'), function(){
                              search.push($(this).val());
                          });
                          
                          search = search.join('|');
                        column
                            .search( search, true, false )
                            .draw();
                    } );
                column.data().unique().sort().each( function ( d, j ) {
                    if(d!="")
                    {
                      select.append( '<option value="'+d+'">'+d+'</option>' )
                    }
                });
            });
            this.api().columns('#filter-date').every( function () {
                var column = this;
                var select = $('.filter-date')
                    //.appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var search = [];

                          $.each($('.filter-date option:selected'), function(){
                              search.push($(this).val());
                          });
                          
                          search = search.join('|');
                        column
                            .search( search, true, false )
                            .draw();
                    } );
                column.data().unique().sort().each( function ( d, j ) {
                    if(d!="")
                    {
                      select.append( '<option value="'+d+'">'+d+'</option>' )
                    }
                });
            });
             $('#min, #max').keyup( function() {
                $('#myTable').DataTable().draw();
            } );
        }
    });

        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                var min = parseInt( $('#min').val(), 10 );
                var max = parseInt( $('#max').val(), 10 );
                var age = parseFloat( data[3] ) || 0; // use data for the age column
         
                if ( ( isNaN( min ) && isNaN( max ) ) ||
                     ( isNaN( min ) && age <= max ) ||
                     ( min <= age   && isNaN( max ) ) ||
                     ( min <= age   && age <= max ) )
                {
                    return true;
                }
                return false;
            }
        );

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


    $(document).on('click','[title="Delete"]',function(){
        if( confirm( 'Are You Sure Deleting product will delete product from the orders as well') ){
            if( $(this).attr('id') != '' && $(this).attr('id') != 0 ){
                $.ajax({
                    url: '<?php echo base_url();?>admin_products/delete_product',
                    type: 'POST',
                    data:{'data':$(this).attr('id')},
                    success:function(data){
                         
                          
                        window.location.reload();
                        alert(data);                      //alert(data);    
                    }

                });

            }
        }
    });

    </script>
    <!--Style Switcher -->
    <script src="<?php echo base_url();?>assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>
