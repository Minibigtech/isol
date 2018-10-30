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

    <section class="thank-section">
      <div class="container">
        <div class="row">
          <div class="how-to-heading">
              <h2>Thank You</h2>
            </div>
          <div class="col-md-12 col-sm-12 col-xs-12">            
            <div class="thank-desc">
              <p>Thank you your order has been placed, it will be deliver to you soon.</p>
            </div>
          </div>          
        </div>
      </div>
    </section>

      

    <footer><?php include('footer.php'); ?></footer>



    
    

    <script src="<?php echo base_url('assets/frontend/');?>js/jquery.1.11.1.js"></script>
    <script src="<?php echo base_url('assets/frontend/');?>js/bootstrap.js"></script>
    <script src="<?php echo base_url('assets/frontend/');?>js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url('assets/frontend/');?>js/plugins.js"></script>
    <script src="<?php echo base_url('assets/frontend/');?>js/aos.js"></script>
    <script src="<?php echo base_url('assets/frontend/');?>js/main.js"></script>
    <script src="<?php echo base_url('assets/frontend/');?>js/jquery.animateSlider.js"></script>
    <script src="<?php echo base_url('assets/frontend/');?>js/modernizr.js"></script>

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