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
    <?php   
      $user_id = $this->session->userdata('logged_user_id');
      $address = $this->db->query('select * from billing_details where user_id = '.$user_id)->row();
    ?>
    <section class="nav"><?php include('navigation.php'); ?></section>

    <section class="ad-search">
      <form action="<?php echo base_url('user/address-change')?>" method="post">
      <div class="container">
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
        <div class="row">
          <div class="col-md-3">  
          <div class="section-title">
              <h2>My Account</h2>
          </div>         
              <?php include('dashboard_left.php')?>
          </div>
          <div class="col-md-9 no-padding">
            <div class="section-title">
              <h2>Address book</h2>               
            </div>
            <div class="search-main-panel">
                <div class="col-md-6 no-padding">
                  <div class="user-box clearfix">
                    <h4>Billing Address</h4>
                    <hr>
                    <p><input type="text" name="billing_address" value="<?php echo (isset($address->billing_address) && !empty($address->billing_address))?$address->billing_address:'';?>" placeholder="Add Billing Address" style="border: none;" size="100"></p>
                    <br>
                    <!-- <a href="javascript:;" class="edit-user"><span><i class="fa fa-pencil-square-o"></i></span>Edit</a> -->
                  </div>
                </div>
                <input type="hidden" name="user_id" value="<?php echo $user_id?>">
                <div class="col-md-6 no-padding">
                  <div class="user-box clearfix">
                    <h4>Shipping Address</h4>
                    <hr>
                    <p><input type="text" name="shipping_address" value="<?php echo (isset($address->shipping_address) && !empty($address->shipping_address))?$address->shipping_address:'';?>"" placeholder="Shipping Address" style="border: none;" size="100"> </p>
                    <br>
                    <!-- <a href="javascript:;" class="edit-user"><span><i class="fa fa-pencil-square-o"></i></span>Edit</a> -->
                  </div>
                </div>
                <div class="col-md-12 no-padding">
                  <input  type="submit" class="btn btn-prim add-new-address pull-right" value="Save Address">
                </div>
            </div>
          </div>
        </div>
      </div>
    </form>
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
        $(document).ready(function() {
 
          $("#owl-demo").owlCarousel({
         
              navigation : false, // Show next and prev buttons
             autoPlay: 3000,
              slideSpeed : 300,
              paginationSpeed : 400,
         
              items : 1, 
              itemsDesktop : false,
              itemsDesktopSmall : false,
              itemsTablet: false,
              itemsMobile : false
         
          });
         
        });

        $(document).ready(function() {
 
          $("#owl-product").owlCarousel({
             navigation : false,
              autoPlay: 3000, //Set AutoPlay to 3 seconds
         
              items : 5,
              itemsDesktop : [1199,3],
              itemsDesktopSmall : [979,3]
         
          });
         
        });

        $(document).ready(function() {
 
          $("#owl-latest").owlCarousel({
             navigation : false,
              autoPlay: 3000, //Set AutoPlay to 3 seconds
         
              items : 5,
              itemsDesktop : [1199,3],
              itemsDesktopSmall : [979,3]
         
          });
         
        });


    </script>

    <script>
        $(function () {
         $('.toggle-menu').click(function(){
            $('.exo-menu').toggleClass('display');
            
         });
         
        });
    </script>


    </body>
</html>


<script>
    //Animation Script
    AOS.init({
        duration: 1200,
        disable: 'mobile'
    });
</script>