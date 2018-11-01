<section class="header mob-hide">
        <div class="container">
            <div class="row">
                <div class="col-md-2 row">
                    <div class="logo">
                        <a href="<?php echo base_url('');?>"><img src="<?php echo base_url('assets/frontend/')?>img/logo.png"></a>
                    </div>
                </div>
                <div class="col-md-10 row pull-right">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="top-nav">
                                <span class="welcome-msg">WELCOME TO I.SOL!</span>  
                                <span class="gap">|</span>    
                                <ul class="list-unstyled">
                                    <li><a href="<?php echo base_url('user/dashboard');?>">My Account</a></li>
                                    <li><a href="javascript:;">About Us</a></li>
                                    <li><a href="javascript:;">Blog</a></li>

                                    <?php if($this->session->userdata('logged_user_id')): ?>
                                         
                                    <li> <a href="<?php echo base_url()?>user/dashboard"><i class="fa fa-user" aria-hidden="true"></i><span></span></a></li>
                                    <?php else: ?>
                                    
                                    <li><a href="<?php echo base_url(); ?>user/sign-in"><i class="fa fa-user" aria-hidden="true"></i><span>Login</span></a></li>

                                   <?php endif; ?> 
                                </ul>  
                            </div>
                         </div>
                    </div>
                    <div class="col-md-6 search_box">
                        <div class="row">
                            <!--<form method="post" action="<?php echo base_url('user/search')?>">
                                <div class="search-bar">
                                      <input type="text" name="query" value="<?php echo (isset($search_data ) && $search_data  != '' )?$search_data:''?>" autocomplete="off" id="search" placeholder="Search for Products" class="search-input">
                                    <div class="group-btn">
                                       <!--  <?php $this->db->select('*')->from('category_level1')->where(array('cl1_status',1));?>
                                        <?php $sql = $this->db->get();?>
                                        <select name="level1">
                                            <option value="0">All Categories</option>
                                            <?php foreach($sql->result() as $val){?>
                                                <option value="<?php echo $val->cl1_id;?>?>"><?php echo $val->cl1_title;?></option>
                                            <?php }?>
                                        </select> 
                                        <button type="submit" class="btn btn-default srch-btn"><span><i class="fa fa-search"></i></span></button>
                                    </div>
                                </div>
                            </form>-->
							<div class="input-group">
                <div class="input-group-btn search-panel">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    	<span id="search_concept">Filter by</span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#contains">Contains</a></li>
                      <li><a href="#its_equal">It's equal</a></li>
                      <li><a href="#greather_than">Greather than </a></li>
                      <li><a href="#less_than">Less than  </a></li>
                    
                      <li><a href="#all">Anything</a></li>
                    </ul>
                </div>
                <input type="hidden" name="search_param" value="all" id="search_param">         
                <input type="text" class="form-control" name="x" placeholder="Search term...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
							
							
                        </div>
                    </div>  
					
                    <div class="col-md-4 row">
                        <div class="row">
                            <div class="contact-detail">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <span class="phone-icon"><i class="fa fa-phone"></i></span>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="top-contact">
                                                <a href="tel:123 456 7890"><h2><span>CALL US NOW</span><br> +123 456 7890</h2></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <a href="advance-search.php" class="btn btn-success advance">Advance</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-1 row pull-right">
                        <div class="row">
                            <div class="wishlist-icons">
                                <ul class="list-unstyled">
                                    <li><small class="inner_badge"><?php echo count($this->cart->contents());?></small><a  id="cart" href="javascript:;"><span><i class="fa fa-shopping-cart"></i></span></a></li>
                                    <div class="col-md-12">
                                        <div class="shopping-cart">
                                        <div class="shopping-cart-header">
                                          <i class="fa fa-shopping-cart cart-icon"></i><span class="badge inner_badge"><?php echo count($this->cart->contents());?></span>
                                          <!-- <div class="shopping-cart-total">
                                            <span class="lighter-text">Total:</span>
                                            <span class="main-color-text">$2,229.97</span>
                                          </div> -->
                                        </div> <!--end shopping-cart-header -->
                                        <ul class="shopping-cart-items list-unstyled" id="cart_items">
                                        <?php foreach ($this->cart->contents() as $items){?>
                                          <li class="clearfix" id="<?php echo $items['rowid']?>">
                                            <img src="<?php echo base_url('assets/images/products/'.$items['product_photo'])?>" class="img-responsive" alt="" width="100"/>
                                            <span class="item-name"><?php echo $items['name'];?></span>
                                            <span class="item-price"><?php echo $items['price'];?></span>
                                            <span class="item-quantity">Quantity: <?php echo $items['qty'];?></span>
                                             <span class="item-quantity"><a href="javascript:;" id="remove_me<?php echo $items['rowid'];?>"  class="btn btn-success delete-cart remove_me">x</a></span>
                                          </li>
                                        <?php }?>
                                        </ul>

                                        <a href="<?php echo base_url('user/checkout');?>" class="button">Checkout</a>
                                      </div>
                                    </div>
                                    <?php if($this->session->userdata('logged_user_id') != ''){?>
                                    <li><a id="wishlist" href="javascript:;" class="mywishlist"><span><i class="fa fa-heart-o"></i></span></a></li>
                                    <?php  $wishlist = $this->db->query('select * from wishlist where user_id = '.$this->session->userdata('logged_user_id'))->result();?>
                                    <div class="col-md-12">
                                        <div class="wishlist-cart">
                                            <div class="shopping-cart-header">
                                              <i class="fa fa-shopping-cart cart-icon"></i><span class="badge"><?php echo count($wishlist);?></span>
                                             <!--  <div class="shopping-cart-total">
                                                <span class="lighter-text">Total:</span>
                                                <span class="main-color-text">$2,229.97</span>
                                              </div> -->
                                            </div> <!--end shopping-cart-header -->

                                            <ul class="shopping-cart-items list-unstyled">

                                            <?php
                                             
                                             foreach ($wishlist as $key => $items){?>
                                          <li class="clearfix" >
                                            <img src="<?php echo base_url('assets/images/products/'.$items->product_photo)?>" class="img-responsive" alt="" width="100"/>
                                            <span class="item-name"><?php echo $items->title;?></span>
                                            <span class="item-quantity"><a href="<?php echo base_url('user/remove_from_wishlist/'.$items->product_id);?>" class="btn btn-success delete-cart">x</a></span>
                                          </li>
                                        <?php }?>
                                            </ul>
                                            <a href="#" class="button">Checkout</a>
                                        <?php }?>

                                          </div>
                                    </div>
                                </ul>
                                <div class="wishlist-popup" style="display: none;">
                                    <ul class="list-unstyled">
                                        <li>
                                            <div class="wish-content">
                                                <div class="wish-img"><img src="img/mother.jpg"></div>
                                                <div class="wish-details">
                                                    <h4 class="wish-title"><a href="javascript:;">1k Gold Plated Adrains Bangles</a></h4>
                                                    <p class="wish-price">Rs: 1999/-</p>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-3">
                                                <div class="wish-img"><img src="img/mother.jpg"></div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="wish-details">
                                                    <h4 class="wish-title">1k Gold Plated Adrains Bangles</h4>
                                                    <p class="wish-price">Rs: 1999/-</p>
                                                </div>
                                            </div> -->
                                        </li>
                                        <li>
                                            <div class="wish-content">
                                                <div class="wish-img"><img src="img/mother.jpg"></div>
                                                <div class="wish-details">
                                                    <h4 class="wish-title"><a href="javascript:;">1k Gold Plated Adrains Bangles</a></h4>
                                                    <p class="wish-price">Rs: 1999/-</p>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-3">
                                                <div class="wish-img"><img src="img/mother.jpg"></div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="wish-details">
                                                    <h4 class="wish-title">1k Gold Plated Adrains Bangles</h4>
                                                    <p class="wish-price">Rs: 1999/-</p>
                                                </div>
                                            </div> -->
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="header mobileonly">
        <div class="container">
            <div class="row">
                <div class="col-xs-4">
                    <div class="logo">
                        <a href="<?php echo base_url('');?>"><img src="<?php echo base_url('assets/frontend/')?>img/logo.png"></a>
                    </div>
                </div>
                <div class="col-xs-8">
                    <div class="row">
                        <div class="contact-detail">
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-xs-2">
                                        <span class="phone-icon"><i class="fa fa-phone"></i></span>
                                    </div>
                                    <div class="col-xs-10">
                                        <div class="top-contact">
                                            <h2><span>CALL US NOW</span><br> +123 456 7890</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-xs-4">
                                <button class="btn btn-success advance">Advance</button>
                            </div> -->
                        </div>
                    </div>
                </div>
               <!--  <div class="col-xs-8">
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="top-nav">
                                <span class="welcome-msg">WELCOME TO I.SOL!</span>  
                            </div>
                         </div>
                    </div>                    
                </div> -->
                <div class="col-xs-12">
                    <div class="row">
                        <form method="post" action="<?php echo base_url('user/search')?>">
                                <div class="search-bar">
                                      <input type="text" name="query" value="<?php echo (isset($search_data ) && $search_data  != '' )?$search_data:''?>" autocomplete="off" id="search" placeholder="Search for Products" class="search-input">
                                    <div class="group-btn">
                                       <!--  <?php $this->db->select('*')->from('category_level1')->where(array('cl1_status',1));?>
                                        <?php $sql = $this->db->get();?>
                                        <select name="level1">
                                            <option value="0">All Categories</option>
                                            <?php foreach($sql->result() as $val){?>
                                                <option value="<?php echo $val->cl1_id;?>?>"><?php echo $val->cl1_title;?></option>
                                            <?php }?>
                                        </select> -->
                                        <button type="submit" class="btn btn-default srch-btn"><span><i class="fa fa-search"></i></span></button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    