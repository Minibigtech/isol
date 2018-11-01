<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>How to order</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php include('head.php'); ?>
        
    </head>
    <body>
    
    <?php include('header.php'); ?>
    
    <?php include('navigation.php'); ?>
    
    <section class="how-to-section">
      <div class="container">
        <div class="row">
          <div class="how-to-heading">
              <h2>How to <span>Order</span></h2>
            </div>
			<br>	<br>
          <div class="col-md-6 col-sm-6 col-xs-12">            
            <div class="how-to-desc">
              <ol class="how-to-list">
                <li>Click on ‘buy now’, to add product to your cart</li>
                <li>Click on ‘Go to next step’ in the top right corner</li>
                <li>You will then need to fill in your contact details and preferred shipping address</li>
                <li>Choose your preferred payment option before clicking on the ‘Confirm order’ button</li>
              </ol>
            </div>
          </div>
          <div class="col-sm-push-1 col-sm-6 col-xs-12 text-center">
            <iframe class="myvid" width="100%" height="300" src="https://www.youtube.com/embed/xcUOTrlpSuI" frameborder="0" allowfullscreen=""></iframe>
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