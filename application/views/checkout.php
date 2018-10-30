<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Checkout</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php include('head.php'); ?>
        
    </head>
    <body>


    
    
    <?php include('header.php'); ?>
    

    <section class="nav"><?php include('navigation.php'); ?></section>


    <section class="checkout-sec">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="review-item-box clearfix">
              <div class="review-title">
                <h3><span>Seller:</span> Seller Name</h3>
              </div>
              <?php foreach ($this->cart->contents() as $items){?>
	          <div class="col-md-12">
	            <div class="review-box">
	              <div class="col-md-2">
	                <img src="<?php echo base_url('assets/images/products/'.$items['product_photo'])?>" class="img-responsive" alt="" width="100"/>
	              </div>
	              <div class="col-md-7">
	                <div class="r-product-title">
	                    <a href="javascript:;" class="product-name"><?php echo $items['name'];?></a>
	                    <p>Quantity <?php echo $items['qty'];?></p>
	                </div>
	              </div>
	              <div class="col-md-3">
	                <p class="pull-right">$<?php echo $items['price'];?></p>
	              </div>
	            </div>
	          </div>
              <?php }?>
            </div>
            <h2>Ship to</h2>
            <?php 
            	if($this->session->userdata('logged_user_id') != ''){
            		$user_id = $this->session->userdata('logged_user_id'); 
            		$user_data = $this->db->query('select * from users where u_id = '.$user_id)->row();	
            		$first_name = $user_data->u_firstname;
            		$last_name = $user_data->u_lastname;
            		$email     = $user_data->u_email;
            		$billing_detail = $this->db->query('select * from billing_details where user_id = '.$user_id)->row();	
            		 $billing_address = (isset($billing_detail->billing_address) && !empty($billing_detail->billing_address))?$billing_detail->billing_address:'';
                $shipping_address = (isset($billing_detail->shipping_address) && !empty($billing_detail->shipping_address))?$billing_detail->shipping_address:'';
                $contact_number = (isset($billing_detail->contact_number) && !empty($billing_detail->contact_number))?$billing_detail->contact_number:'';;
            	}else{
            		$billing_address ='';
            		$shipping_address = '';
            		$contact_number = '';
            		$first_name = '';
            		$last_name = '';
            		$email     = '';
            	}
            ?>
            <div class="ship-box">
              <div class="container-fluid">                
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <form id="contact-form" class="form" action="<?php echo base_url('user/buy-product');?>" method="POST" role="form">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label class="form-label" for="name">Country or region</label>
                                  <select class="form-control" style="width: 48%;">
                                    <option class="form-control">Pakistan</option>
                                  </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-label" for="name">First Name</label>
                                  <input type="text" class="form-control" id="name" name="first_name" value="<?php echo $first_name;?>" placeholder="First Name" tabindex="1" required>
                              </div>
                            </div>     
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-label" for="name">Last Name</label>
                                  <input type="text" class="form-control" id="name" name="last_name" value="<?php echo $last_name;?>" placeholder="Last Name" tabindex="1" required>
                              </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-label" for="name">Billing Address</label>
                                  <input type="text" class="form-control" id="name" name="street_address" value="<?php echo $billing_address;?>" placeholder="Billing Address" tabindex="1" required>
                              </div>
                            </div>   
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label class="form-label" for="name">Street Address 2 (optional)</label>
                                  <input type="text" class="form-control" id="name" name="street_address2" placeholder="Street Address 2 (optional)" tabindex="1" >
                              </div>
                            </div>                  
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label class="form-label" for="name">City</label>
                                  <input type="text" class="form-control" id="name" name="city" placeholder="City" tabindex="1" required>
                              </div>
                            </div> 
                            <div class="col-md-5">
                              <div class="form-group">
                                  <label class="form-label" for="name">State</label>
                                  <select class="form-control" name="state">
                                    <option class="form-control">Sindh</option>
                                </select>
                              </div></div> 
                            <div class="col-md-3">
                                <div class="form-group">
                                  <label class="form-label" for="name">Zip Code</label>
                                  <input type="text" class="form-control" id="name" name="zip_code" placeholder="Zip Code" tabindex="1" required>
                              </div>
                            </div> 
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="email">Email</label>
                                  <input type="email" class="form-control" id="email" value="<?php echo $email;?>" name="email" placeholder="Email" tabindex="2" required>
                              </div> 
                            </div>    
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="email">Confirm Email</label>
                                  <input type="email" class="form-control" id="email" value="<?php echo $email;?>" name="confirm_email" placeholder="Confirm Email" tabindex="2" required>
                              </div> 
                            </div>                       
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label class="form-label" for="subject">Phone Number</label>
                                  <input type="text" class="form-control" id="subject" value="<?php echo $contact_number;?>" name="number" placeholder="Phone Number" tabindex="3">
                              </div>
                            </div> 
                            <div class="col-md-12">
                              
                            </div>  
                        
                    </div>
                </div>
              </div>
            </div>
            <h2>Pay with</h2>
            <div class="payment-method">
              <div class="radio radio-primary">
                  <input type="radio" name="radio1" id="radio1" value="option1">
                  <label for="radio1">
                      <img src="<?php echo base_url('assets/frontend/');?>img/paypal2.png" style="width: 80px;">
                  </label>
              </div>
              <div class="radio radio-primary" style="border-bottom: none;">
                  <input type="radio" name="radio1" id="radio2" value="option1">
                  <label for="radio2">
                      Cash on Delivery
                  </label>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="ship-total clearfix">
              <table>
              	<?php  foreach ($this->cart->contents() as $items) {?>
                <tr>
                  <td><?php echo $items['name'];?></td>
                  <td><?php echo 'Rs '.$items['price'];?></td>
                </tr>
                <!-- <tr>
                  <td>Shipping</td>
                  <td>$98.00</td>
                </tr> -->
            <?php }?>
              </table>
              <div class="col-md-12 no-padding"><hr></div>
              <div class="col-md-6 no-padding"><h3>Order Total</h3></div>
              <div class="col-md-6 no-padding"><h3 class="pull-right"><strong>Rs <?php 
              $sum = 0;
              foreach ($this->cart->contents() as $items) {
                  $sum += $items['price'];
              }
              echo $sum;
            ?></strong></h3></div>
              <?php if($this->session->userdata('logged_user_id') == ''){?>
              	<strong style="color: red">Please Login To Continue</strong>
              <?php }else{?>
              <div class="col-md-12 text-center"><input type="submit" class="btn btn-prim" value="Confirm and Pay"></div>
          	  <?php }?>
          	  </form>
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
      $(document).ready(function() {
      // Test for placeholder support
        $.support.placeholder = (function(){
            var i = document.createElement('input');
            return 'placeholder' in i;
        })();

        // Hide labels by default if placeholders are supported
        if($.support.placeholder) {
            $('.form-label').each(function(){
                $(this).addClass('js-hide-label');
            });  

            // Code for adding/removing classes here
            $('.form-group').find('input, textarea').on('keyup blur focus', function(e){
                
                // Cache our selectors
                var $this = $(this),
                    $parent = $this.parent().find("label");
              
                switch(e.type) {
                  case 'keyup': {
                     $parent.toggleClass('js-hide-label', $this.val() == '');
                  } break;
                  case 'blur': {
                    if( $this.val() == '' ) {
                        $parent.addClass('js-hide-label');
                    } else {
                        $parent.removeClass('js-hide-label').addClass('js-unhighlight-label');
                    }
                  } break;
                  case 'focus': {
                    if( $this.val() !== '' ) {
                        $parent.removeClass('js-unhighlight-label');
                    }
                  } break;
                  default: break;
                }
                // previous implementation with ifs
                /*if (e.type == 'keyup') {
                    if( $this.val() == '' ) {
                        $parent.addClass('js-hide-label'); 
                    } else {
                        $parent.removeClass('js-hide-label');   
                    }                     
                } 
                else if (e.type == 'blur') {
                    if( $this.val() == '' ) {
                        $parent.addClass('js-hide-label');
                    } 
                    else {
                        $parent.removeClass('js-hide-label').addClass('js-unhighlight-label');
                    }
                } 
                else if (e.type == 'focus') {
                    if( $this.val() !== '' ) {
                        $parent.removeClass('js-unhighlight-label');
                    }
                }*/
            });
        } 
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