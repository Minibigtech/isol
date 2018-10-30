<?php
    $admin = $this->db->query('select * from administrator where admin_id = '.$this->session->userdata('logged_admin_id'))->row();

    
?>
    
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">

                <ul class="nav" id="side-menu">
                    <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                        <!-- input-group -->
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
            </span> </div>
                        <!-- /input-group -->
                    </li>
                    <?php if($admin->user_type != 'operator'){?>
                    <!-- <li class="nav-small-cap m-t-10">--- Main Menu</li> -->
                    <li> <a href="<?php echo base_url()?>admin/dashboard" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i> <span class="hide-menu"> Dashboard </span></a>
                    </li>
                    
                    <li> <a href="<?php echo base_url()?>admin/users" class="waves-effect"><i class="linea-icon linea-basic fa-fw text-danger" data-icon="7"></i> <span class="hide-menu">Users</span></a>
                    </li>

                    <li> <a href="<?php echo base_url()?>admin/home-slides" class="waves-effect"><i class="linea-icon linea-basic fa-fw text-danger" data-icon="7"></i> <span class="hide-menu">Home Slides</span></a>
                    </li>

                    <li> <a href="<?php echo base_url()?>admin/home-banners" class="waves-effect"><i class="linea-icon linea-basic fa-fw text-danger" data-icon="7"></i> <span class="hide-menu">Home Banners</span></a>
                    </li>


                    <li> <a href="<?php echo base_url()?>admin/deals" class="waves-effect"><i class="linea-icon linea-basic fa-fw text-danger" data-icon="7"></i> <span class="hide-menu">Right Sidebar Deals</span></a>
                    </li>

                     <li> <a href="<?php echo base_url()?>admin/view-orders" class="waves-effect"><i class="linea-icon linea-basic fa-fw text-danger" data-icon="7"></i> <span class="hide-menu">Orders</span></a>
                    </li>

                     <li> <a href="<?php echo base_url()?>admin/view-reviews" class="waves-effect"><i class="linea-icon linea-basic fa-fw text-danger" data-icon="7"></i> <span class="hide-menu">Reviews</span></a>
                    </li>
                    
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="linea-icon linea-basic fa-fw text-danger" data-icon="7"></i> <span class="hide-menu text-danger">Video Gallery<span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url();?>admin/add_video">Add Video</a> </li>
                            <li> <a href="<?php echo base_url();?>admin/list_video">List video</a> </li>
                        </ul>
                    </li>


                     <li> <a href="javascript:void(0);" class="waves-effect"><i class="linea-icon linea-basic fa-fw text-danger" data-icon="7"></i> <span class="hide-menu text-danger">Pages<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url()?>admin/edit/return-and-exchange">Return & Exchange Policy</a> </li>
                            <li> <a href="<?php echo base_url()?>admin/edit/terms-and-condition">Terms & Conditions</a> </li>
                             <li> <a href="<?php echo base_url()?>admin/edit/sell-with-us">Sell with Us</a> </li>
                        </ul>
                    </li>
                    
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="linea-icon linea-basic fa-fw text-danger" data-icon="7"></i> <span class="hide-menu text-danger">Product Categories<span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url();?>admin/level1">Category Level 1</a> </li>
                            <li> <a href="<?php echo base_url();?>admin/level2">Category Level 2</a> </li>
                            <li> <a href="<?php echo base_url();?>admin/level3">Category Level 3</a> </li>
                        </ul>
                    </li>

                     <li> <a href="javascript:void(0);" class="waves-effect"><i class="linea-icon linea-basic fa-fw text-danger" data-icon="7"></i> <span class="hide-menu text-danger">Shop's Products<span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url();?>admin/products">Products</a> </li>
                        </ul>
                    </li>
                    
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="linea-icon linea-basic fa-fw text-danger" data-icon="7"></i> <span class="hide-menu text-danger">Data Entry Operator<span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url();?>admin/add-operator">Add Operator</a></li>
                            <li> <a href="<?php echo base_url();?>admin/list-operator">List Operator</a></li>
                        </ul>
                    </li>

                    <li> <a href="<?php echo base_url('admin/view_quotes')?>" class="waves-effect"><i class="linea-icon linea-basic fa-fw text-danger" data-icon="7"></i> <span class="hide-menu text-danger">Quotations<span class="fa arrow"></span> </span></a>
                    </li>

                    <li> <a href="<?php echo base_url('admin/logs')?>" class="waves-effect"><i class="linea-icon linea-basic fa-fw text-danger" data-icon="7"></i> <span class="hide-menu text-danger">Logs<span class="fa arrow"></span> </span></a>
                    </li>

                    <li> <a href="<?php echo base_url('admin/view-return-exhcange')?>" class="waves-effect"><i class="linea-icon linea-basic fa-fw text-danger" data-icon="7"></i> <span class="hide-menu text-danger">Return Exchange<span class="fa arrow"></span> </span></a>
                    </li>

                    <li> <a href="<?php echo base_url('admin/view-stock_request')?>" class="waves-effect"><i class="linea-icon linea-basic fa-fw text-danger" data-icon="7"></i> <span class="hide-menu text-danger">Stock Request<span class="fa arrow"></span> </span></a>
                    </li>
                    
                    <li> <a href="<?php echo base_url('admin/view-return-form-request')?>" class="waves-effect"><i class="linea-icon linea-basic fa-fw text-danger" data-icon="7"></i> <span class="hide-menu text-danger">Return/Exchange Requests<span class="fa arrow"></span> </span></a>
                    </li>

                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="linea-icon linea-basic fa-fw text-danger" data-icon="7"></i> <span class="hide-menu text-danger">Reporting<span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url();?>admin/view-order-report">Order Reports</a></li>
                            <li> <a href="<?php echo base_url();?>admin/view-person-upload-report">Person Upload Reports</a></li>
                            <li> <a href="<?php echo base_url();?>admin/list-operator">Sale Reportds</a></li>
                        </ul>
                    </li>
                        
                     <?php }else{?>
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="linea-icon linea-basic fa-fw text-danger" data-icon="7"></i> <span class="hide-menu text-danger">Shop's Products<span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url();?>admin/products">Products</a> </li>
                           <!--  <li> <a href="<?php echo base_url();?>admin/product-attributes">Product Attributes</a></li>
                            <li> <a href="<?php echo base_url();?>admin/product-variations">Product Variations</a> </li> -->
                        </ul>
                    </li>
                    <?php }?>
                    <li><a href="<?php echo base_url();?>admin/logout" class="waves-effect"><i class="icon-logout fa-fw"></i> <span class="hide-menu">Log out</span></a></li>
                    
                </ul>
            </div>
        </div>
        <!-- Left navbar-header end