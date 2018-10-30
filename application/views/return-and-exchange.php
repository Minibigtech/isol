<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> <?php echo $page->p_title;?>  </title>
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
    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/ml-stack-nav-theme.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/ml-stack-nav.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/main.css">
</head>
<body>

 <?php require_once('header.php');?>

<section class="terms-condition">
    <div class="container">
        <div class="row">
                
            <div class="col-md-12">
                
                <div class="terms-div">
                
                    <?php echo $page->p_content;?>
                    
                </div>
            </div>
        </div>
    </div>
</section>


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





</script>

<script>
    $(".js-ml-stack-nav").mlStackNav();
</script>