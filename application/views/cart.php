<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Cart</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php include('head.php'); ?>
        
    </head>
    <body>


    
    
    <?php include('header.php'); ?>
    

    <section class="nav"><?php include('navigation.php'); ?></section>


    
    <section class="cart-sec">
      <div class="container">
        <div class="row">
         <div class="section-title ad-title">
              <h2>Cart</h2>
          </div>
          <div class="col-md-12">
            <table class="table cart-table">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col">Item</th>
                  <th scope="col">Unit Price</th>
                  <th scope="col">Qty</th>
                  <th scope="col">Subtotal</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($this->cart->contents() as $items){?>
                <tr  id="cart_remove_item<?php echo $items['rowid'];?>">
                  <td><img src="<?php echo base_url('assets/images/products/'.$items['product_photo'])?>" class="img-responsive" alt="" width="100"/></td>                  
                  <td><input type="hidden" name="item_name[]" value="<?php echo $items['name'];?>"><?php echo $items['name'];?></td>
                  <th scope="col"><input type="hidden" name="product_actual_price[]" class="in-qty product_actual_price" id="product_actual_price<?php echo $items['id']?>" value="<?php echo $items['price'];?>" >Rs. <?php echo $items['price'];?></th>
                  <td><input type="text" name="qty[]" class="in-qty qty" id="qty<?php echo $items['id']?>" value="<?php echo $items['qty'];?>"></td>
                  <th scope="col"><input type="hidden" class="price" id="price<?php echo $items['id'] ?>" name="price[]"  value="<?php echo $items['price'];?>" />Rs. <span id="item_price<?php echo $items['id']?>"><?php echo $items['price'];?></span></th>
                  <input type="hidden" name="row_id[]" id="row_id<?php echo $items['id']?>" value="<?php echo $items['rowid']?>">
                  <td><!-- <button type="button" id="remove_me<?php echo $items['rowid'];?>"  class="btn btn-success delete-cart remove_me"  ><span><i class="fa fa-trash"></i></span></button> --></td>
                </tr>
               <?php }?>
              </tbody>
            </table>
            <h2 class="cart-total-price">Total Price: <span id="total_price">Rs <?php 
              $sum = 0;
              foreach ($this->cart->contents() as $items) {
                  $sum += $items['price'];
              }
              echo $sum;
            ?></span></h2>
            <div class="cart-btn-sec">
              <button class="btn btn-prim"><i class="fa fa-close"></i>Clear Cart</button><a href="<?php echo base_url('')?>" class="btn btn-prim"><i class="fa fa-refresh"></i>Add More To Cart</a><a href="<?php echo base_url('user/checkout_stage');?>" class="btn btn-prim pull-right"><i class="fa fa-arrow-right"></i>Checkout</a>
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

    <!-- Calculating price -->

    <script type="text/javascript">
      $(document).on('keyup','.qty',function(){
         product_id = $(this).attr('id');
         id         = product_id.substr(3);
         quantity   = $('#qty'+id).val();
         actual_price = $('#product_actual_qty'+id).val();
         row_id = $('#row_id'+id).val();
         $.ajax({
            url: '<?php echo base_url('user/update-cart'); ?>',
            type: 'POST',
            data: {
                'quantity': quantity,
                'price'   : actual_price,
                'row_id'  : row_id,
                'product_id' : id
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                total_product_price = 0;
                total_product_price = parseInt(data) * parseInt(quantity);
                 $('#item_price'+id).html(data);
                 $('#price'+id).val(data);
                 sum = 0; 
                 $('[name="price[]"]').each(function(){
                    amount = $(this).val();
                    if(amount != ''){
                        sum =  parseFloat(amount) * parseInt(sum);    
                    }
                });
                 $('#total_price').html(sum);
            }
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