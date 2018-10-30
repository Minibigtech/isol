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


    <section class="contact-sec">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-xs-12">
            <div class="contact-form clearfix">              
              <form class="jform" action="/landing1/index.php" method="post">
                <div class="col-md-6 col-xs-12">
                  <div class="name">
                    <input type="text" name="cname" placeholder="Name" class="iecn alphanumeric contact-field" required="">
                  </div>
                </div>
                <div class="col-md-6 col-xs-12">
                  <div class="email">
                    <input type="email" name="cemail" placeholder="Email" class="email contact-field" required="">
                  </div>
                </div>
                <div class="col-md-6 col-xs-12">
                  <div class="phone">
                    <input type="text" name="cphone" minlength="7" placeholder="Phone" class="number contact-field" required="">
                  </div>
                </div>
                <div class="col-md-6 col-xs-12">
                  <div class="phone">
                    <input type="text" name="csubject" minlength="7" placeholder="Subject" class="iecn alphanumeric contact-field" required="">
                  </div>
                </div>
                <div class="col-md-12 col-xs-12">
                  <div class="mxg field">
                    <textarea name="cmsg" class="iemsg contact-field" rows="4" placeholder="Name on the Logo and Design Preferences" required=""></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <input type="submit" class="btn-orangedark" value="Submit">
                  <input type="hidden" id="lead_area2" name="lead_area" value="for $24.99">
                  <input type="hidden" id="lead_org_price" name="lead_org_price" value="">
                  <input type="hidden" name="send" value="1">
                </div>
              </form>            
            </div>
          </div>
          <div class="col-md-4 col-xs-12">
            <div class="col-xs-12 col-md-12">
              <div class="contact-box clearfix">
                <div class="col-md-4">
                  <span><i class="fa fa-phone"></i></span>
                </div>
                <div class="col-md-8">
                  <p>Call us <br><br> <span>111-632-632</span></p>
                </div>
              </div>
            </div>
            <div class="col-xs-12 col-md-12">
              <div class="contact-box clearfix">
                <div class="col-md-4">
                  <span><i class="fa fa-phone"></i></span>
                </div>
                <div class="col-md-8">
                  <p>Email <br><br> <span>talk@interlogics.com</span></p>
                </div>
              </div>
            </div>
            <div class="col-xs-12 col-md-12">
              <div class="contact-box clearfix">
                <div class="col-md-4">
                  <span><i class="fa fa-phone"></i></span>
                </div>
                <div class="col-md-8">
                  <p>Whatsapp <br><br> <span>111-632-632</span></p>
                </div>
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
      $(document).ready(function(){
          $(".nav-tabs a").click(function(){
              $(this).tab('show');
          });
      });
    </script>



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