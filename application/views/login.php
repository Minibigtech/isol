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


    <section class="login-sec">
      <div class="container">
        <div class="row">
          <div class="login-box clearfix">
            <div class="col-md-12 no-padding">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#login">Login</a></li>
                <li><a href="#register">Register</a></li>
              </ul>
              <div class="tab-content">
                <div id="login" class="tab-pane fade in active">
                  <form action="<?php echo base_url();?>user/login" method="post">
                    <div class="form-group">
                      <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email or username">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>                    
                    <button type="submit" class="btn btn-prim">Sign in</button>                    
                    <div class="col-md-4 no-padding">
                      <div class="checkbox">
                          <input id="checkbox1" type="checkbox">
                          <label for="checkbox1">Stay signed in</label>
                      </div>
                    </div>
                    <div class="col-md-8 no-padding">
                      <div class="login-links">
                        <a href="javascript:;" title="Text a temporary password">Text a temporary password</a><br>
                        <a href="javascript:;" title="Reset your password">Reset your password</a>
                      </div>
                    </div>
                    <div class="col-md-12 no-padding">
                      <p class="login-text">Using a public or shared device? Uncheck to protect your account. <a href="javascript:;">Learn more</a></p>
                    </div>
                  </form>                  
                </div>

                <div id="register" class="tab-pane fade">
                  <form  action="<?php echo base_url();?>user/create-account" method="post">
                    <div class="form-group col-md-6 two-padding">
                      <label for="exampleInputEmail1">First Name</label>
                      <input type="text" name="fname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                    </div>
                    <div class="form-group col-md-6 two-padding">
                      <label for="exampleInputEmail1">Last Name</label>
                      <input type="text" name="lname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                    </div>
                    <div class="form-group col-md-12 no-padding">
                      <label for="exampleInputEmail1">Email Address</label>
                      <input type="email"  name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                    </div>
                    <div class="form-group col-md-12 no-padding">
                      <label for="exampleInputEmail1">Password</label>
                      <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>     
                    <div class="form-group col-md-12 no-padding">
                      <label for="exampleInputEmail1">Confirm Password </label>
                      <input type="password" name="confirm_password"  class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>     
                    <div class="col-md-12 no-padding">
                      <p class="login-text">By <strong>Registering</strong>, you agree that you've read and accepted our <a href="javascript:;">User Agreement</a>, you're at least 18 years old, and you consent to our <a href="javascript:;">Privacy Notice</a> and receiving marketing communications from us.</p>
                    </div>           
                    <button type="submit" class="btn btn-prim">Register</button>  
                  </form>
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