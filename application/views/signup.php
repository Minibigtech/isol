<!doctype html>

<html class="no-js" lang="">

<head>

    <meta charset="utf-8">

    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title></title>

    <meta name="description" content="">

    <meta name="viewport" content="width=device-width, initial-scale=1">



    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/yourlogo.png">

    <!-- Place favicon.ico in the root directory -->



    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/bootstrap.css">

    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/animate.css">

    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/font-awesome.css">

    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/aos.css">

    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/css/owl.theme.css">

    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/owl.carousel.css">

    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/ml-stack-nav-theme.css">

    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/ml-stack-nav.css">

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

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



    





        <div class="col-md-2 no-padding"></div>

        <div class="col-md-6 no-padding">

            

       <?php if( $this->session->flashdata('errors') ):?>

        <div class="alert alert-danger alert-dismissable">

            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>

            <?php echo $this->session->flashdata('errors');?>

        </div>

      <?php endif; ?>

      <form class="form-horizontal form-material" id="loginform" action="<?php echo base_url();?>user/create-account" method="post">

        <h3 class="box-title m-b-20">Sign UP</h3>

        <div class="form-group ">

          <div class="col-xs-12">

            <input class="form-control" name="fname" type="text"  placeholder="First Name" required>

          </div>

        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" name="lname" type="text"  placeholder="Last Name" required>
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" name="email" type="email"  placeholder="Email" required>
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" name="password" type="password"  placeholder="Password" required>
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" name="confirm_password" type="password"  placeholder="Confirm Password" required>
          </div>
        </div>    

        <div class="form-group text-center m-t-20">

          <div class="col-xs-12">

            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Sign Up</button>

            <a href="<?php echo base_url() ?>"><button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="button">Sign Up With Facebook</button></a>

          </div>

        </div>

        <div class="form-group m-b-0">

          <div class="col-sm-12 text-center">

            <p>Already have an account? <a href="<?php echo base_url() ?>user/sign-in" class="text-primary m-l-5"><b>Sign In</b></a></p>

          </div>

        </div> 

      </form>

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



</script>









<script>

    $(".js-ml-stack-nav").mlStackNav();

</script>