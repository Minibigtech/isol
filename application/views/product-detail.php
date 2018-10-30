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


    
    <section class="product-section">
      <div class="container-fluid ">
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
        <div class="row">         
          <div class="col-md-4">           
            <?php echo $product->product_photo!=''?'<img class="product-v-img" width="100%" src="'.base_url().'assets/images/products/'.$product->product_photo.'">':'<img class="product-v-img" width="100%" src="'.base_url().'assets/images/no-image.png'.'">';?>
          </div>
          <div class="col-md-8 no-padding">
            <div class="project-detail-box">
              <h2><?php echo $product->product_title;?></h2>
              <div class="col-md-12"><hr></div>
              <div class="pricing-details">
                <div class="col-md-2 col-xs-6">
                  <p class="field-title">Condition:</p>
                </div>
                <div class="col-md-10">
                  <p><?php echo $product->product_condition;?></p>
                </div>
                <div class="col-md-12 no-padding">
                  <div class="pricing-sec clearfix">
                    <div class="col-md-2 col-xs-3">
                    <?php  if($product->get_quote != 'on'){?>
                      <p class="field-title">Price: <?php echo $product->product_price;?></p>
                    <?php }?>
                    </div>
                    <div class="col-md-10">
                      <div class="col-md-4">
                      <?php  
                        if($product->get_quote == 'on'){
                                $this->db->select('*');
                                $this->db->from('quotation');
                                $this->db->where('product_id',$product->product_id);
                                $this->db->where('category','Product Price');
                                $this->db->where('user_id',$this->session->userdata('logged_user_id'));
                                $result =  $this->db->get()->row();
                                if($result == ''){?>
                                    <button type="button" class="btn btn-prim" data-toggle="modal" data-target="#myModal2">Get a Quote</button>
                                <?php }else{ ?>
                                    <p style="color: green"><strong>Quotation  has been sent</strong></p>
                        <?php }}?>
                        <?php if($this->session->userdata('logged_user_id') != ''){?>
                                <a  class="btn btn-prim" href="<?php echo base_url('user/add-to-wislist/'.$product->product_id);?>" ><span><i class="fa fa-heart-o"></i></span></a>
                          <?php }?>
                      </div>
                      <div class="col-md-8"> 
                      <?php if($product->sold_out == 0 ){?>  
                        <a href="<?php echo base_url('user/buy-now/'.$product->product_id)?>" class="btn btn-prim">Buy Now</a>
                        <button type="submit" class="btn btn-prim add_cart" id="<?php echo $product->product_id; ?>" >Add to cart</button>
                      <?php }else{?>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal4" >Request for stock</button>
                      <?php }?>
                         <?php if($this->session->userdata('logged_user_id') != ''){
                            if($product->repair == 'on'){
                              $check_status = $this->db->query('select * from quotation where product_id ='.$product->product_id.' && user_id='.$this->session->userdata('logged_user_id').' && category ="Repairing Price" ')->row();
                              if($check_status == ''){
                                if($product->repair_price != ''){?>
                                    <button type="submit" class="btn btn-prim add_repair" id="add_repair<?php echo $product->product_id; ?>" >Repair</button>
                                <?php }else{?>
                                    <button type="button" class="btn btn-red" data-toggle="modal" data-target="#myModal3">Repair</button>
                                <?php }
                          ?>
                                 
                          <?php
                        }else{?>
                          <p style="color: green"><strong>Quotation for repair has been sent</strong></p>
                        <?php }
                            }
                            }?> 
                      </div>
                    </div>
                  </div>
                </div>
                <input type="hidden" id="country" value="<?php echo $product->country;?>">
                <input type="hidden" id="check_country" value="<?php echo $product->check_country;?>">
                <?php if($product->sold_out == 1 ){?> 
                <div class="col-md-2 col-xs-6 hide_country">
                  <p class="field-title">Out of stock:</p>
                </div>
                <div class="col-md-10 hide_country">
                  <p style="color: red"><strong>Yes</strong></p>
                </div>
              <?php }?>
              <?php if($product->sold_out == 0 ){?> 
                <div class="col-md-2 col-xs-6 hide_country">
                  <p class="field-title">Out of stock:</p>
                </div>
                <div class="col-md-10 col-xs-6 hide_country">
                  <p style="color: green"><strong>No</strong></p>
                </div>
              <?php }?>
                <?php if($product->cod == 'on' ){?> 
                <div class="col-md-2 col-xs-6 hide_country">
                  <p class="field-title">Cash on delivery:</p>
                </div>
                <div class="col-md-10 col-xs-6 hide_country">
                  <p style="color: green"><strong>Yes</strong></p>
                </div>
              <?php }?>
                <div class="col-md-2 col-xs-6">
                  <p class="field-title">Shipping:</p>
                </div>
                <div class="col-md-10">
                  <p><?php echo $product->shipping;?></p>
                </div>
                <div class="col-md-2 col-xs-6">
                  <p class="field-title">Delivery:</p>
                </div>
                <div class="col-md-10 col-xs-6">
                  <p><?php echo $product->delivery;?></p>
                </div>
                <div class="col-md-2 col-xs-6">
                  <p class="field-title">Payments:</p>
                </div>
                <div class="col-md-10">
                  <p><img src="<?php echo base_url('assets/frontend/')?>img/paypal.png"> | <img src="<?php echo base_url('assets/frontend/')?>img/CC_icons.png"></p>
                </div>
                <?php if($product->return == 'on'){?>
                <div class="col-md-2 col-xs-6">
                  <p class="field-title">Returns:</p>
                </div>
                <div class="col-md-10">
                  <p><?php echo $product->return_days;?></p>
                </div>
              <?php }?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="product-desc-section">
      <div class="container-fluid">
        <div class="row">
          <div class="product-detail-box clearfix">
            <div class="col-md-12">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#description">Description</a></li>
                <li><a href="#specifications">Specifications</a></li>
              </ul>
              <div class="tab-content">
                <div id="description" class="tab-pane fade in active">
                  <h3>Description</h3>
                  <p><?php echo $product->description;?></p>
                </div>
                <div id="specifications" class="tab-pane fade">
                  <h3>Specifications</h3>
                  <table class="table">       

                     <?php 
                     if(!empty($product->attribute)){
                        $attribute = explode(',', $product->attribute);
                        $value     = explode(',', $product->value);
                        $count   = count($product->attribute);
                      ?>
                    <tbody>
                        <?php for($i = 0 ; $i<=$count ; $i++){
                          if(isset($attribute[$i]) && !empty($attribute[$i])){
                          ?>
                      <tr>
                        <th scope="row"><?php echo $attribute[$i];?> </th>
                        <td> <?php echo $value[$i];?></td>
                      </tr>
                    <?php }}}?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <section class="product-section">
        <div class="container">
            <div class="row">
                <div class="product-container">
                    <div class="col-md-12 no-padding">
                        <div class="section-title">
                            <h2>Related PRODUCTS</h2>
                            <hr>
                        </div>
                    </div>
                    <div id="owl-related" class="owl-carousel owl-theme">     
                        <?php 
                            $product_id = [];
                            
                            $this->db->select('product_categories.pc_cl1_id');
                            $this->db->from('product_categories');
                            $this->db->join('products', 'products.product_id = product_categories.pc_product_id');
                            $this->db->where("product_categories.pc_product_id =",$product->product_id);
                            $sql = $this->db->get();
                            if(!empty($sql->row())){
                              $category_id = $sql->row()->pc_cl1_id;
                            }else{
                              $category_id= 0;
                            }

                            $product_ids = $this->db->query('select pc_product_id from product_categories where pc_cl1_id='.$category_id)->result();
                            foreach ($product_ids as $key => $value) {
                              $product_id[] = $value->pc_product_id;
                            }
                            foreach ($product_ids as $key => $value) {
                                 $this->db->select('*');
                                 $this->db->from('products');
                                 $this->db->where('product_id',$value->pc_product_id);
                                 $result= $this->db->get()->result();
                            }
                            if(!empty($result)){
                             if( count($result)>0 ):
                            
                              
                        ?>
                         <?php foreach( $result as $key => $products ):?>
                      <div class="item">
                        <a href="<?php echo base_url('preview/'.$products->product_slug.'/'.$products->product_reference);?>">
                           <?php echo $products->product_photo!=''?'<img src="'.base_url().'assets/images/products/'.$products->product_photo.'" class="img-responsive" alt="">':'<img src="'.base_url().'assets/images/no-image.png" class="img-responsive" alt="">';?>
                        </a>
                            <h3 class="product-title"><a href="javascript:;"><?php echo $products->product_title;?></a></h3>
                            <h4 class="product-price">
                               <?php  if($products->get_quote != 'on'){?>
                                Rs. <?php echo $products->product_price;?>
                              <?php }?>
                              </h4>
                            <a href="javascript:;" id="<?php echo $products->product_id; ?>" class="btn card-btn add_cart">ADD TO CART</a>                        
                      </div> 
                     <?php endforeach;?> 
                        <?php else:?>
                            <h2>Products Not Found</h2>
                        <?php endif;}?>  
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="comments-sec">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 no-padding">
              <div class="section-title">
                  <h2>COMMENTS & REVIEWS</h2>
                  <hr>
              </div>
          </div>
          <div class="col-lg-12 col-md-12">
            <?php foreach($comment as $key => $val){?>
            <div class="card-box">
                <div class="comment">
                    <img src="assets/images/users/avatar-1.jpg" alt="" class="comment-avatar">
                    <div class="comment-body">
                        <div class="comment-text">
                            <div class="comment-header">
                                <a href="#" title=""><?php echo  $this->db->query('select u_firstname from users where u_id='.$val->user_id)->row()->u_firstname;?></a><span>about 2 minuts ago</span>
                            </div>
                            <?php echo $val->comment;?>
                        </div>
                    </div>
                </div>
                <!-- <div class="m-t-30 text-center">
                    <a href="" class="btn btn-default waves-effect waves-light btn-sm">Load More...</a>
                </div> -->
            </div>
            <?php }?>
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

    <script src="<?php echo base_url('assets/frontend/')?>js/jquery.elevatezoom.js"></script>
    <script src="<?php echo base_url('assets/frontend/')?>js/ubislider.min612e.js"></script>

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
          $("#owl-related").owlCarousel({
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

        $.get("https://ipinfo.io", function(response) {
          country = $('#country').val();
          check_country = $('#check_country').val();
          if(check_country == 1){
            if(country != response.country){
                $('hide_country').hide();
            }
          }
      }, "jsonp");
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

<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h3>Order Details</h3>
                <?php 
                    $this->db->select('*');
                    $this->db->from('users');
                    $this->db->where('u_id',$this->session->userdata('logged_user_id'));
                    $result =  $this->db->get()->row();
                ?>
            </div>

            <div class="modal-body sscontent clearfix asti">

                 
              <form action="<?php echo base_url('user/add-quotation')?>" method="post" id="queryForm">
                <div class="quote-box">
                  <input type="text" name="name" value="<?php echo (isset($result->u_firstname) && !empty($result->u_firstname))?$result->u_firstname:'';?>"  class="form-control" placeholder="Name">
                  <input type="text" name="email" value="<?php echo (isset($result->u_email) && !empty($result->u_email))?$result->u_email:'';?>"  class="form-control" placeholder="Email">
                  <input type="text" name="phone" value=""  class="form-control" placeholder="Phone">
                  <input type="text" name="product_title" value="<?php echo $product->product_title;?>" readonly class="form-control" placeholder="Product Name">
                  <input type="hidden" name="product_id" value="<?php echo $product->product_id;?>">
                  <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('logged_user_id');?>">
                  <select class="form-control" name="category">
                     <option value="Product Price">Product Price</option>
                  </select>
                  <textarea class="form-control" name="message" placeholder="Your Message"></textarea>
                  <input type="hidden" name="sendquery" value="sendquery">
                  <input type="submit" class="btn btn-prim" value="Send"> 
                </div>
              </form>
            </div>  
        </div>
    </div>
</div>


<div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h3>Repair  Quotation</h3>

            </div>

            <div class="modal-body sscontent clearfix asti">

                 
              <form action="<?php echo base_url('user/add-quotation')?>" method="post" id="queryForm">
                <div class="quote-box">
                  <input type="text" name="product_title" value="<?php echo $product->product_title;?>" readonly class="form-control" placeholder="Product Name">
                  <input type="hidden" name="product_id" value="<?php echo $product->product_id;?>">
                  <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('logged_user_id');?>">
                  <select class="form-control" name="category">
                     <option value="Repairing Price">Repairing Price</option>
                  </select>
                  <input type="text" name="repair_price"  class="form-control" readonly="" placeholder="Repair Price" value="<?php echo $product->repair_price;?>" >
                  <textarea class="form-control" name="message" placeholder="Your Message"></textarea>
                  <input type="hidden" name="sendquery" value="sendquery">
                  <input type="submit" class="btn btn-prim" value="Send"> 
                </div>
              </form>


            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="myModal4" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h3>Request for stock</h3>

            </div>

            <div class="modal-body sscontent clearfix asti">
              <?php if($this->session->userdata('logged_user_id') != ''){?>
                <form action="<?php echo base_url('user/request-stock')?>" method="post" id="queryForm">
                  <div class="quote-box">
                    <input type="text" name="product_title" value="<?php echo $product->product_title;?>" readonly class="form-control" placeholder="Product Name">
                    <input type="hidden" name="product_id" value="<?php echo $product->product_id;?>">
                    <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('logged_user_id');?>">
                    <textarea class="form-control" name="message" placeholder="Your Message"></textarea>
                    <input type="hidden" name="sendquery" value="sendquery">
                    <input type="submit" class="btn btn-prim" value="Send"> 
                  </div>
                </form>
              <?php }else{?>
                <p style="color: white">Please login to continue . . . </p>
              <?php }?>

            </div>

        </div>
    </div>
</div>