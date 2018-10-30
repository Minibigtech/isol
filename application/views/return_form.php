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
                $order_detail =  $this->db->query('select * from order_table where user_id ='.$user_id)->result();
              }else{
                $billing_address ='';
                $shipping_address = '';
                $contact_number = '';
                $first_name = '';
                $last_name = '';
                $email     = '';
                $order_detail = '';
              }
            ?>
    <section class="how-to-section">
      <div class="container">
        <div class="row">
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
          <div class="how-to-heading">
              <h2>how to exchange </h2>
            </div>         
            <div class="col-sm-6 col-sm-offset-3">
              <div class="form-container">
                <p>Interlogics.com deals in reliable way to keep the money of customers safe. Currently we are providing service of exchange.</p>
                <p>You can apply for exchange by filling given form</p>
                <form method="POST" action="<?php echo base_url('user/add-return-exchange');?>">
                  <div class="form-group">
                    <label for="usr">Name:</label>
                    <input type="text" class="form-control"  id="usr" placeholder="Enter Name" name="name" value="<?php echo $first_name;?>" required="">
                  </div>
                  <div class="form-group">
                    <label for="usr">Number:</label>
                    <input type="text" class="form-control" id="usr" placeholder="Enter Number" name="number" required="" value="<?php echo $contact_number;?>">
                  </div>

                  <div class="form-group">
                    <label for="usr">Email:</label>
                    <input type="email" class="form-control"  id="usr" value="<?php echo $email;?>" placeholder="Enter Email Address" name="email" required="">
                  </div>

                  <div class="form-group">
                    <label for="comment">Address:</label>
                    <textarea class="form-control" rows="5" id="comment" placeholder="Enter Address" value="<?php echo $shipping_address;?>" name="address" required=""></textarea>
                  </div>

                  <div class="form-group">
                    <label for="usr">Order Number:</label>
                        <select name="ordernumber" id="order_number" required="" class="form-control">
                          <option value="">Select Order Number</option>
                            <?php foreach($order_detail as $key =>$val){?>
                              <option value="<?php echo $val->order_id?>"><?php echo $val->order_ref;?></option>
                            <?php }?>
                        </select>
                  </div>

                  <div class="form-group">
                    <label for="usr">Product Code:</label>
                    <select name="productcode" id="productcode"  class="form-control" required="">
                          <option value="">Select Order Product</option>
                            
                        </select>
                  </div>

                  <div class="form-group">
                    <label for="usr">Order Date:</label>
                    <input type="date" class="form-control" id="usr" placeholder="Enter Order Date:" name="orderdate" required="">
                  </div>
                  <?php if(isset($user_id) && !empty($user_id)){?>
                  <input type="submit" class="btn btn-prim" value="Submit"> 
                <?php }else{?>
                    <strong style="color: red">Please login to use this feature ! </strong>
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