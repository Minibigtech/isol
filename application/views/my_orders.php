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
         
          <div class="col-md-3">  
          <div class="section-title">
              <h2>My Account</h2>
          </div>         
              <?php include('dashboard_left.php')?>
          </div>
          <div class="col-md-9 col-sm-9 col-xs-12 no-padding">
            <div class="section-title">
              <h2>My orders</h2>               
            </div>
            <div class="search-main-panel">
              <div class="orders-table table-responsive">
                <table class="table table-hover" id="dev-table">
                    <thead>
                    <tr>
                        <th>Serial No:</th>
                        <th>Order No:</th>
                        <th>Billing Details</th>
                        <th>Order Date</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $count = 1; ?>
                    <?php foreach($orders as $order): ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><a href="javascript:;" onclick="order_detail(<?php echo $order->order_id ?>)" data-toggle="modal" data-target="#myModal2"><?php echo $order->order_ref;?></a></td>
                        <td>
                        <a href="javascript:;" onclick="billing_detail(<?php echo $order->order_id ?>)" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Billing Details</a>
                        </td>
                        <td><?php echo $order->order_date ?></td>
                        <td>
                            <?php echo ($order->order_status==0)?'Pending':'' ?>     
                            <?php echo ($order->order_status==1)?'Confirmed':''?>    
                            <?php echo ($order->order_status==2)?'Rejected':''?>    
                        </td>
                    </tr>
                    <?php endforeach; ?>
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






$(document).on('click','.product',function (){
    id = $(this).attr('id');
    status = $('.status'+id).val();
    $('#comment_product').html('');
    if(status == 0){
        html = `<strong><p style="color:green">Comment will be available after the delivery</p></strong>`;
    }else{
        html  = `
            <input type="hidden" name="product_id" value="`+id+`"  class="form-control"/>
            <input type="text" name="comment" class="form-control" placeholder="Comment" required/>
            <br>
            <input type="submit" class="btn btn-success pull-right"/>
        `;  
    }
    $('#comment_product').append(html);
});






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

<div class="modal fade" id="myModal5" role="dialog">

    <div class="modal-dialog" style="width: 50%">

        <!-- Modal content-->

        <div class="modal-content" >

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h3>Comment</h3>
                 <form method="post" id="comment_product"  action="<?php echo base_url('admin/comment_product');?>">
                        
                 </form>
            </div>

            <!--

            <div class="modal-body ">

                <div class="row"> -->
            <div class="modal-body  clearfix">
                <!-- <p>Are You Sure</p> -->
            </div>
    </div>

</div>

            <!-- </div> -->

</div>