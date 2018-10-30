<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo site_title;?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php require_once('favicon.php');?>
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/yourlogo.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/animate.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/aos.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/owl.theme.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/owl.carousel.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/ml-stack-nav-theme.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/ml-stack-nav.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/main.css">
</head>
<body>

<!--Header Section-->

   <?php require_once('header.php');?> 



<!--Header Section-->


<!--Bread Crumb Section-->
<!--Bread Crumb Section-->


<!--Add To Cart Section-->
<section class="cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 no-padding">

                  <?php if( $this->session->flashdata('checkout_error') ):?>
                    <div class="alert alert-danger alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <?php echo $this->session->flashdata('checkout_error');?>
                    </div>
                   <?php endif; ?>  



                <div class="cart-heading">
                    <h3>SHOPPING CART</h3>
                </div>
            </div>
        </div>

        

        <div class="row">
            <div class="line-one clearfix">
                <div class="col-md-2">

                </div>
                <div class="col-md-3">
                    <p>Product Name</p>
                </div>
                <div class="col-md-2">
                    <p>Unit Price</p>
                </div>
                <div class="col-md-2">
                    <p>Qty</p>
                </div>
                <div class="col-md-2">
                    <p>Subtotal</p>
                </div>
                <div class="col-md-1">
                    <p>Action</p>
                </div>
            </div>



             <?php 

             $total_price =0;  
             foreach($cart as $value):  
             $total_price += $value->product_quantity * $value->product_price;  ?>
             <div class="line-two clearfix">
                <div class="col-md-2 col-xs-12">
                    <img src="<?php echo base_url('assets/images/products/').$value->product_photo;?>" class="img-responsive" alt="">
                </div>
                <div class="col-md-3 col-xs-12">
                    <p><?php echo $value->product_title ?></p>
                </div>
                <div class="col-md-2 col-xs-12">
                    <p><span>Rs.<?php echo $value->product_price ?></span></p>
                </div>
                <div class="col-md-2 col-xs-12">
                    <input type="text" id = "quantity" name = "quantity" value="<?php echo $value->product_quantity ?>"  class="form-control">
                </div>
                <div class="col-md-2 col-xs-12">
                    <p><span>Rs.<?php echo $value->product_quantity *  $value->product_price ?></span></p>
                </div>
                <div class="col-md-1 col-xs-12">
                    <p>
                    <a name="delete" id="<?php echo $value->id;  ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    <a name="save" id="<?php echo $value->id;?>"><i class="fa fa-save" aria-hidden="true"></i></a></p>
                </div>


                 <!-- href="<?php // echo base_url() ?>user/delete-item/<?php //  echo $value->id;?>" -->


                <div class="col-md-12">
                    <hr>
                </div>
            </div>
               <?php endforeach; ?> 
              

            <div class="line-three clearfix">
                <div class="col-md-11 col-xs-6">
                    <p class="pull-right">Total Price :</p>
                </div>
                <div class="col-md-1 col-xs-6">
                    <p><span>Rs.<?php echo $total_price?></span></p>
                </div>
                <div class="col-md-12">
                    <hr>
                </div>
            </div>

            <div class="line-four clearfix">
                <div class="col-md-8 col-xs-6">
                    <button class="btn btn-default"><a href="<?php echo base_url() ?>checkout"><i class="fa fa-arrow-right" aria-hidden="true"></i> Check Out</a></button>
                </div>
                <div class="col-md-4 col-xs-6">
                    <div class="btn-last pull-right">
                        <button class="btn btn-default"><a name = "clear-cart"><i class="fa fa-times" aria-hidden="true"></i> Clear</a></button>
                       <!--  <button class="btn btn-default"><a href="#"><i class="fa fa-refresh" aria-hidden="true"></i> Update</a></button> -->
                    </div>
                </div>
            </div>
        </div>
    
    </div>

</section>
<!--Add To Cart Section-->


<!--Footer Sec-->
 <?php require_once('footer.php');?>

    

        <script src="<?php echo base_url()?>assets/front/js/jquery.1.11.1.js"></script>
        <script src="<?php echo base_url()?>assets/front/js/bootstrap.js"></script>
        <script src="<?php echo base_url()?>assets/front/js/owl.carousel.min.js"></script>
        <script src="<?php echo base_url()?>assets/front/js/plugins.js"></script>
        <script src="<?php echo base_url()?>assets/front/js/aos.js"></script>
        <script src="<?php echo base_url()?>assets/front/js/main.js"></script>
        <script src="<?php echo base_url()?>assets/jquery-ui.js"></script>
<script src="<?php echo base_url()?>assets/front/js/ml-stack-nav.js"></script>
        <link href="<?php echo base_url()?>assets/jquery-ui.css" rel="stylesheet" type="text/css" media="all"/>
    </body>
</html>

<?php require_once('js.php');?>
<script>
    //Animation Script
    AOS.init({
        duration: 1200,
        disable: window.innerWidth < 1280
    });



    $(document).ready(function(){

            
            $(document).on("click","a[name='delete']", function (e) {
              if( confirm( 'Are You Sure' ) ){  
                if( $(this).attr('id') != '' && $(this).attr('id') != 0 ){        

                   $.ajax({
                    url: '<?php echo base_url();?>user/delete-item',
                    type: 'POST',
                    data:{'data':$(this).attr('id')},
                    success:function(data){
                        //alert(data);    
                        window.location.reload();
                    }

                });
  
              }
            }   
                
        });



         $(document).on("click","a[name='save']",function(){

            var id = $(this).attr('id');   
            var quantity = $(this).parent().parent().prev().prev().children().val();
            //var quantity = $('#quantity').val();

            
            //var quantity = $(this).prev().val();

           


            if(confirm('Are You sure')){

              if($(this).attr('id') != '' && $(this).attr('id') != 0)
              {

                    $.ajax({

                        url  : '<?php echo base_url();?>user/save-item',
                        type : 'POST',
                        data : {'id':id,'quantity':quantity},
                        success:function(data){

                            window.location.reload();
                        }

                    });


              }  

            }
        });   



        $(document).on("click","a[name='clear-cart']",function(){
 
            if(confirm('Are You sure')){

                         $.ajax({

                        url  : '<?php echo base_url();?>user/clear-cart',
                        type : 'POST',
                        //data : {'id':id,'quantity':quantity},
                        success:function(data){
                            
                            window.location.reload();
                            alert(data);    
                        }

                    });


                

            }

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
 



});


</script>




<script>
    $(".js-ml-stack-nav").mlStackNav();
</script>