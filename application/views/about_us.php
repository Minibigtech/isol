<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>About us</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php include('head.php'); ?>
        
    </head>
    <body>
    
    <?php include('header.php'); ?>
    <?php include('navigation.php'); ?>
	<div class="how-to-heading">
              <h2>About <span>Us</span> </h2>
			  <hr>
            </div>
	
	
    <section class="about-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="about-heading" style="text-align: left;">
              
            </div>
            <div class="about-desc">
             Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst in deze bedrijfstak sinds de 16e eeuw, toen een onbekende drukker een zethaak met letters nam en ze door elkaar husselde om een font-catalogus te maken. Het heeft niet alleen vijf eeuwen overleefd maar is ook, vrijwel onveranderd, overgenomen in elektronische letterzetting. Het is in de jaren '60 populair geworden met de introductie van Letraset vellen met Lorem Ipsum passages en meer recentelijk door desktop publishing software zoals Aldus PageMaker die versies van Lorem Ipsum bevatten
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="about-img">
              <img src="<?php echo base_url('assets/frontend/');?>img/about.png" class="img-responsive">
            </div>
          </div>
        </div>
      </div>
    </section>

    

    <section class="promise-sec">
      <div class="container">
        <div class="row">
          
          <div class="about-heading">
            <h2><span>Our </span>Promise</h2>
			<hr>
          </div>
          <div class="promise-boxes clearfix">

            <div class="col-sm-4 promise-box">
              <img src="<?php echo base_url('assets/frontend/');?>img/about1.png" class="promise-img">
              <h3 style="color:#ffffff;">100% Genuine Products</h3>
              <p class="promise-text">No fakes and no duplicates. We have made it to our mission to offer only 100% genuine products in the original packaging on Daraz. We work hard to provide you with the largest selection of authentic and brand new products at the highest quality.</p>
            </div>

            <div class="col-sm-4 promise-box">
              <img src="<?php echo base_url('assets/frontend/');?>img/about2.png" class="promise-img">
              <h3 style="color:#ffffff;">Safe &amp; Secure Payments</h3>
              <p class="promise-text">Whether you pay cash on delivery or conveniently with one of our pre-payment methods, credit / debit card / Easypay or  JazzCash, your privacy is important to us and we keep your data secure. For further information please visit our <a href="https://www.daraz.pk/privacy/"> Privacy Agreement Page</a>.</p>
            </div>

            <div class="col-sm-4 promise-box">
              <img src="<?php echo base_url('assets/frontend/');?>img/about3.png" class="promise-img">
              <h3 style="color:#ffffff;">Free &amp; Easy Returns</h3>
              <p class="promise-text">Returns and replacements are easy and free of charge. For further information on the detailed terms, as well as on how to return your product please visit our <a href=" https://www.daraz.pk/how-to-return/">Returns &amp; Refunds Page</a>.
              </p>
            </div>

          </div>
        </div>
      </div>
    </section>


    <section class="journey-sec">
      <div class="">
        <div class="">           
          <div class="about-heading">
            <h2 style="    color: #005dbc;
    border-bottom: 1px solid #005dbc24;">Our <span>Journey</span></h2>
          </div>
         
            <div class="journey-img clearfix">
              <img src="<?php echo base_url('assets/frontend/');?>img/journey.jpg" alt="" class="img-responsive">
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
    <?php $this->load->view('js');?>
    <script>
       /*Get product by order*/
        $(document).on('change','#order_number',function(){
            order_id = $(this).val();
            $('#productcode').find('option').remove();
            $.ajax({
                url  : '<?php echo base_url();?>user/get-by-reference',
                type : 'POST',
                data : {'order_id':order_id},
                success:function(data){
                    data = $.parseJSON(data);
                    $.each( data, function( key, value ) {
                      html = `<option value="`+value.product_id+`">`+value.product_title+`</option>`;
                      $('#productcode').append(html);
                    });
                }
            });
        }); 
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