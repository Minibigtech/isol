<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Term & condition</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php include('head.php'); ?>
        
    </head>
    <body>
    
    <?php include('header.php'); ?>
    
    <section class="terms-sec">
      <div class="container">
        <div class="row">
          <div id="terms"></div>
          <h1 class="terms-heading">Terms and Conditions</h1>
          <p>Please read the Terms and Conditions carefully before using Interlogics.</p>
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
          <ul class="list-unstyled terms-list">
            <li><a href="#introduction">Introduction</a></li>
            <li><a href="#use">Conditions Of Use</a></li>
            <li><a href="#sale">Conditions Of Sale (Between Sellers And Customers)</a></li>
          </ul>

          <div class="col-md-12 no-padding">
            <div class="terms-content">
              <div id="introduction"></div>
              <h3>1.Introduction</h3>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem </p>
              <a href="#terms">Back to Top</a>
            </div>

            <div class="terms-content">
              <div id="use"></div>
              <h3>2.Conditions Of Use</h3>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem </p>
              <a href="#terms">Back to Top</a>
            </div>

            <div class="terms-content">
              <div id="sale"></div>
              <h3>3.Conditions Of Sale (Between Sellers And Customers)</h3>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem </p>
              <a href="#terms">Back to Top</a>
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