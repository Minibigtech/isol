<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php include('head.php'); ?>
        
    </head>
    <body>


    
    
    <?php include('header.php'); ?>
    

    <section class="nav"><?php include('navigation.php'); ?></section>


    
    <section class="ad-search">
      <div class="container">
        <div class="row">
         <?php if( $this->session->flashdata('error') ):?>
          <div class="alert alert-danger alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
              <?php echo $this->session->flashdata('error');?>
          </div>
        <?php endif; ?>
        <?php if( $this->session->flashdata('success') ):?>
          <div class="alert alert-success alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
              <?php echo $this->session->flashdata('success');?>
          </div>
        <?php endif; ?>
          <div class="col-md-3">  
          <div class="section-title">
              <h2>My Account</h2>
          </div>         
              <?php include('dashboard_left.php')?>
          </div>
          <div class="col-md-9 col-sm-9 col-xs-12 no-padding">
            <div class="section-title">
              <h2>My Wishlist</h2>               
            </div>
            <div class="search-main-panel">
              <div class="orders-table table-responsive">
                <table class="table table-hover" id="dev-table">

                                <thead>

                                <tr>

                                    <th>Serial No:</th>

                                    <th>Image</th>

                                    <th>Title</th>

                                    <th>Action</th>

                                </tr>

                                </thead>

                                <tbody>

                                <?php $count = 1; ?>

                               
                                <?php foreach($wishlist as $key => $val){?>
                                <tr>
                                    <td><?php echo $count++; ?></td>
                                    <td><img src="<?php echo base_url('assets/images/products/'.$val->product_photo);?>" width="100"></td>
                                    <td><?php echo $val->title; ?></td>
                                    <td><a href="<?php echo base_url('user/remove_from_wishlist_profile/'.$val->product_id)?>" class="btn btn-success">Remove</a></td>
                                </tr>
                                <?php }?>
                                </tbody>

                            </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>



    <footer><?php include('footer.php'); ?></footer>



    
    

    <script src="<?php echo base_url('assets/frontend/')?>js/jquery.1.11.1.js"></script>
    <script src="<?php echo base_url('assets/frontend/')?>js/bootstrap.js"></script>
    <script src="<?php echo base_url('assets/frontend/')?>js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url('assets/frontend/')?>js/plugins.js"></script>
    <script src="<?php echo base_url('assets/frontend/')?>js/aos.js"></script>
    <script src="<?php echo base_url('assets/frontend/')?>js/main.js"></script>
    <script src="<?php echo base_url('assets/frontend/')?>js/jquery.animateSlider.js"></script>
    <script src="<?php echo base_url('assets/frontend/')?>js/modernizr.js"></script>

  <script>

    //Animation Script

    AOS.init({

        duration: 1200,

        disable: window.innerWidth < 1280

    });





    $('.owl-carouseled').owlCarousel({

        autoPlay : true,

        stopOnHover : true,

        navigation : true,

        slideSpeed : 2000,

        items: 1,

        paginationSpeed : 1000,

        pagination: false,

        goToFirstSpeed : 2000,

        loop:true,

        autoHeight : false,

        navigationText: [

            "<i class=\"fa fa-chevron-left\" aria-hidden=\"true\"></i>",

            "<i class=\"fa fa-chevron-right\" aria-hidden=\"true\"></i>"

        ]



    });



    (function(){

        'use strict';

        var $ = jQuery;

        $.fn.extend({

            filterTable: function(){

                return this.each(function(){

                    $(this).on('keyup', function(e){

                        $('.filterTable_no_results').remove();

                        var $this = $(this),

                            search = $this.val().toLowerCase(),

                            target = $this.attr('data-filters'),

                            $target = $(target),

                            $rows = $target.find('tbody tr');



                        if(search == '') {

                            $rows.show();

                        } else {

                            $rows.each(function(){

                                var $this = $(this);

                                $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();

                            })

                            if($target.find('tbody tr:visible').size() === 0) {

                                var col_count = $target.find('tr').first().find('td').size();

                                var no_results = $('<tr class="filterTable_no_results"><td colspan="'+col_count+'">No results found</td></tr>')

                                $target.find('tbody').append(no_results);

                            }

                        }

                    });

                });

            }

        });

        $('[data-action="filter"]').filterTable();

    })(jQuery);



    $(function(){

        // attach table filter plugin to inputs

        $('[data-action="filter"]').filterTable();



        $('.container').on('click', '.panel-heading span.filter', function(e){

            var $this = $(this),

                $panel = $this.parents('.panel');



            $panel.find('.panel-body').slideToggle();

            if($this.css('display') != 'none') {

                $panel.find('.panel-body input').focus();

            }

        });

        $('[data-toggle="tooltip"]').tooltip();

    })







    function billing_detail(order_id)

    {



             $.ajax({



                        url  : '<?php echo base_url();?>user/user-view-billing-details',

                        type : 'POST',

                        data : {'order_id':order_id},

                        success:function(data){

                            

                            $('.sscontent').html(data);

                            //window.location.reload();

                            //alert(data);    

                        }



                   });



    }





    function order_detail(order_id)

    {



             $.ajax({



                        url  : '<?php echo base_url();?>user/user-view-order-details',

                        type : 'POST',

                        data : {'order_id':order_id},

                        success:function(data){

                            

                            $('.sscontent').html(data);

                            //window.location.reload();

                            //alert(data);    

                        }



                   });



    }













</script>



    <script>

        $(".js-ml-stack-nav").mlStackNav();

    </script>



<div class="modal fade" id="myModal" role="dialog">

    <div class="modal-dialog" style="width: 100%">

        <!-- Modal content-->

        <div class="modal-content" >

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h3>Billing Details</h3>

            </div>

            <!--

            <div class="modal-body ">

                 <div class="row"> -->

                    

            <div class="modal-body sscontent clearfix">

                  <!-- <p>Are You Sure</p> -->

            </div>







    

    </div>

</div>

            <!-- </div> -->

</div>


<div class="modal fade" id="myModal2" role="dialog">



    <div class="modal-dialog">

        <!-- Modal content-->

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h3>Order Details</h3>

            </div>

            <div class="modal-body sscontent clearfix asti">

                 



            </div>

        </div>
    </div>
</div>