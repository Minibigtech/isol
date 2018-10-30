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
          $profile = $this->db->query('select * from users where u_id='.$user_id)->row();
      ?>
    <section class="ad-search">
      <div class="container">
        <div class="row">
          <div class="col-md-3">  
          <div class="section-title">
              <h2>Edit Account</h2>
          </div>         
            <?php include('dashboard_left.php')?>
          </div>
          <div class="col-md-9 no-padding">
            <div class="section-title">
              <h2>Edit account</h2>
            </div>
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
            <form action="<?php echo base_url('user/update-user')?>" method="post">
            <div class="search-main-panel">
              <div class="personal-box clearfix">
                <div class="col-md-12">
                  <div class="row">
                    <div class="personal-info">
                      <div class="col-md-3">
                        <label>First Name<span>*</span></label>
                      </div>
                      <div class="col-md-9">
                        <input type="text" name="u_firstname" value="<?php echo $profile->u_firstname;?>" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="personal-info">
                      <div class="col-md-3">
                        <label>Last Name<span>*</span></label>
                      </div>
                      <div class="col-md-9">
                        <input type="text" name="u_lastname" value="<?php echo $profile->u_lastname;?>" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="personal-info">
                      <div class="col-md-3">
                        <label>Current E-mail<span>*</span></label>
                      </div>
                      <div class="col-md-9">
                        <p><?php echo $profile->u_email;?>
                          <input type="hidden" name="old_email" value="<?php echo $profile->u_email;?>">
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="personal-info">
                      <div class="col-md-3">
                        <label>New E-mail</label>
                      </div>
                      <div class="col-md-9">
                        <input type="text" name="u_email" class="form-control">
                        <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="personal-info">
                      <div class="col-md-3">
                        <label>Old Password<span>*</span></label>
                      </div>
                      <div class="col-md-9">
                        <input type="password" name="old_password" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="personal-info">
                      <div class="col-md-3">
                        <label>New Password<span>*</span></label>
                      </div>
                      <div class="col-md-9">
                        <input type="password" name="new_password" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="personal-info">
                      <div class="col-md-3">
                        <label>Confirm Password<span>*</span></label>
                      </div>
                      <div class="col-md-9">
                        <input type="password" name="confirm_password" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
              </form>
                <!-- <div class="col-md-12">
                  <div class="row">
                    <div class="personal-info">
                      <div class="col-md-3">
                        <label>Birthday</label>
                      </div>
                      <div class="col-md-3">
                        <input type="text" name="day">
                      </div>
                      <div class="col-md-3">
                        <input type="text" name="month">
                      </div>
                      <div class="col-md-3">
                        <input type="text" name="year">
                      </div>
                    </div>
                  </div>
                </div> -->
                <div class="col-md-12">
                  <div class="row">
                    <div class="personal-info">
                      <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn btn-prim">Save</button>
                      </div>
                    </div>
                  </div>
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