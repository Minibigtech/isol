<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php include('head.php'); ?>
        <link href="<?php echo base_url('assets/');?>jquery-ui.css" rel="stylesheet" type="text/css" media="all"/>

    </head>
    <body>


    
    
    <?php include('header.php'); ?>
    

    <section class="nav"><?php include('navigation.php'); ?></section>


    <section class="top-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 no-padding">
                    <div class="product-categories">
                        <div class="pcat-title">
                            <h4>TOP CATEGORIES</h4>
                        </div>
                        <div class="pcat-list">
                        <?php $this->db->select('*')->from('category_level1')->where(array('cl1_status',1));?>
                        <?php $sql = $this->db->get();?>
                            <ul class="list-unstyled">
                              <?php foreach( $sql->result() as $val){?>
                              <li><a href="<?php echo base_url('user/search_by_category/'.$val->cl1_id)?>"><?php echo $val->cl1_title;?></a></li>
                              <?php }?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 banner-slider">
                    <div id="owl-demo" class="owl-carousel owl-theme"> 
                    <?php $this->db->select('*')->from('slider')->where('slide_status',1);?>
                        <?php $sql = $this->db->get();?>  
                            <?php if( $sql->num_rows()>0 ): ?>
                                <?php foreach( $sql->result() as $slide ):?>
                                  <div class="item">
                                     <?php if( $slide->slide_link != '' ):?>
                                    <a href="<?php echo http_url($slide->slide_link);?>">
                                    <?php endif;?>
                                    <?php echo $slide->slide_photo!=''?'<img src="'.base_url().'assets/images/slides/'.$slide->slide_photo.'" class="img-responsive" alt="">':'<img src="'.base_url().'assets/images/no-image.png" class="img-responsive" alt="">';?>
                                    <?php if( $slide->slide_link != '' ):?>
                                    </a>
                                    <?php endif;?>
                                </div>
                                 <?php endforeach;?>
                            <?php else:?>
                                <div class="item">
                                    <img src="<?php echo base_url()?>assets/images/no-image.png" class="img-responsive" alt="" style="width:893px;height:410px;">
                                </div>
                            <?php endif;?>
                    </div>
                </div>
                <div class="col-md-2 no-padding">
                    <div class="side-content">
                        <h3>Business Information</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="features-sec">
        <div class="container">
            <div class="row">
                <?php $this->db->select('*')->from('deals')->where('d_status',1);?>
                <?php $sql = $this->db->get();?>
                <?php if( $sql->num_rows()>0 ):?>
                <?php foreach( $sql->result() as $val ):?>
                <div class="col-md-3 col-xs-6">
                    <div class="feature-box">
                        <div class="feature-box-icon"></div>
                        <div class="feature-box-info">
                            <div class="porto-u-heading" style="text-align:left">
                                <img src="<?php echo base_url();?>assets/images/deals/<?php echo $val->d_photo;?>" width="50">
                                <div class="porto-u-main-heading">
                                    <h3 style="font-weight: bold;color:#465157;font-size: 14px;line-height: 20px;"><?php echo $val->d_title;?></h3>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
                <?php endif;?>
            </div>
        </div>
    </section>

    <section class="product-section">
        <div class="container">
            <div class="row">
                <div class="product-container">
                    <div class="col-md-12 no-padding">
                        <div class="section-title">
                            <h2>FEATURED PRODUCTS</h2>
                            <hr>
                        </div>
                    </div>
                    <div id="owl-product" class="owl-carousel owl-theme">     
                        <?php 
                            $this->db->select('*')->from('products');
                            $this->db->where('product_status',1);
                            $this->db->where('product_featured',1);
                            $this->db->order_by('product_id','DESC');
                            $this->db->limit(12);
                            $sql = $this->db->get();     
                             if( $sql->num_rows()>0 ):
                        ?>
                         <?php foreach( $sql->result() as $products ):?>
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
                        <?php endif;?>  
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
                            <h2>LATEST PRODUCTS</h2>
                            <hr>
                        </div>
                    </div>
                    <div id="owl-latest" class="owl-carousel owl-theme">     
                        <?php 
                           $this->db->select('*')->from('products')->where(array('product_latest'=>1,'product_status'=>1))->order_by('product_id','DESC')->limit(12);
                            $sql = $this->db->get();     
                             if( $sql->num_rows()>0 ):
                        ?>
                         <?php foreach( $sql->result() as $products ):?>
                      <div class="item">
                        <a href="<?php echo base_url('preview/'.$products->product_slug.'/'.$products->product_reference);?>">
                           <?php echo $products->product_photo!=''?'<img src="'.base_url().'assets/images/products/'.$products->product_photo.'" class="img-responsive" alt="">':'<img src="'.base_url().'assets/images/no-image.png" class="img-responsive" alt="">';?>
                        </a>
                            <h3 class="product-title"><a href="javascript:;"><?php echo $products->product_title;?></a></h3>
                            <h4 class="product-price">
                             <?php  if($products->get_quote != 'on'){?>
                                Rs. <?php echo $products->product_price;?>
                              <?php }?></h4>
                            <a href="javascript:;" id="<?php echo $products->product_id; ?>" class="btn card-btn add_cart">ADD TO CART</a>                       
                      </div> 
                     <?php endforeach;?> 
                        <?php else:?>
                            <h2>Products Not Found</h2>
                        <?php endif;?>  
                    </div>
                </div>
            </div>
        </div>
    </section>


    <footer><?php include('footer.php'); ?></footer>

   
   
    <script>
      // $(document).ready(function(){
      //   $('.mywishlist').hover(function(){
      //     $('.wishlist-popup').css('display','block');
      //     $('.wishlist-overlay').css('display','block');
      //   });
      // });

      // $(document).on('click',".wishlist-overlay",function(){
      //         $(".wishlist-popup").hide();
      //         $('.wishlist-overlay').hide();
      // });


      // $('.wishlist-popup').css('display','none');
      // $('.wishlist-overlay').css('display','none');

      // $('.wishlist-overlay').hover(function(){        
      //     $(".wishlist-popup").hide();
      //     $('.wishlist-overlay').hide();
      // });


      // $('body').append('<div class="wishlist-overlay" style="display: none;"> </div>');


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
             navigation : true,
              autoPlay: 3000, //Set AutoPlay to 3 seconds
         
              items : 5,
              itemsDesktop : [1199,3],
              itemsDesktopSmall : [979,3],
              navigationText: ["<span><i class='fa fa-caret-left'></i></span>","<span><i class='fa fa-caret-right'></i></span>"]
         
          });
         
        });

        $(document).ready(function() {
 
          $("#owl-latest").owlCarousel({
             navigation : true,
              autoPlay: 3000, //Set AutoPlay to 3 seconds
         
              items : 5,
              itemsDesktop : [1199,3],
              itemsDesktopSmall : [979,3],
              navigationText: ["<span><i class='fa fa-caret-left'></i></span>","<span><i class='fa fa-caret-right'></i></span>"]
         
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
