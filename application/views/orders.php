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
    <?php   
      $user_id = $this->session->userdata('logged_user_id');
      $address = $this->db->query('select * from billing_details where user_id = '.$user_id)->row();
    ?>

    
    <section class="ad-search">
      <div class="container">
        <div class="row">
          <div class="col-md-3">  
          <div class="section-title">
              <h2>My Account</h2>
          </div>         
            <?php include('dashboard_left.php')?>
          </div>
          <div class="col-md-9 no-padding">
            <div class="section-title">
              <h2>Account Settings Panel</h2>
            </div>
            <?php   
                $user_id = $this->session->userdata('logged_user_id');
                $profile = $this->db->query('select * from users where u_id='.$user_id)->row();
            ?>
            <div class="search-main-panel">
                <h5>Hello <?php echo $profile->u_firstname;?></h5>
                <p>From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select link below to view or edit information.</p>
                <div class="col-md-6 no-padding">
                  <div class="user-box clearfix">
                    <h4>Contact details</h4>
                    <hr>
                    <p><?php echo $profile->u_firstname;?></p>
                    <p><?php echo $profile->u_email;?> - <a href="javascript:;">Change E-mail</a></p>
                    <a href="javascript:;">Change password</a>
                    <br>
                    <a href="<?php echo base_url('user/edit-profile');?>" class="edit-user"><span><i class="fa fa-pencil-square-o"></i></span>Edit</a>
                  </div>
                </div>
                <div class="col-md-6 no-padding">
                  <div class="user-box clearfix">
                    <h4>Newsletter</h4>
                    <hr>
                    <p>You are currently not subscribed to any of our newsletters.</p>
                    <br>
                    <a href="javascript:;" class="edit-user"><span><i class="fa fa-pencil-square-o"></i></span>Edit</a>
                  </div>
                </div>
                <div class="col-md-6 no-padding">
                  <div class="user-box clearfix">
                    <h4>Default delivery address</h4>
                    <hr>
                    <p><?php echo (isset($address->billing_address) && !empty($address->billing_address))?$address->billing_address:'Please update your address';?></p>
                    <br>
                    <a href="<?php echo base_url('user/address-book');?>" class="edit-user"><span><i class="fa fa-pencil-square-o"></i></span>Edit</a>
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