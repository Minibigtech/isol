<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Home - <?php echo site_title;?><</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php require_once('favicon.php');?>
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/animate.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/font-awesome.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/aos.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/owl.theme.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/owl.carousel.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/ml-stack-nav-theme.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/ml-stack-nav.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/main.css">
    </head>
    <body>

    <?php require_once('header.php');?>
    

    <!--SideBar And Slider Section-->
        <section class="sidebar-slider">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 no-padding">
                        <div class="sidebar">
                            <ul class="nav nav-pills nav-stacked">
                                <?php $this->db->select('*')->from('category_level1')->where('cl1_status',1);?>
                                <?php $sql = $this->db->get();?>
                                <?php if( $sql->num_rows()>0 ):?>
                                <?php foreach( $sql->result() as $level1 ):?>
                                <li>
                                    <a href="<?php echo base_url().'categories/'.$level1->cl1_slug;?>">
                                    <?php echo $level1->cl1_icon!=''?'<img src="'.base_url('assets/images/level1/'.$level1->cl1_icon).'" class="img-responsive" alt="">':'';?>
                                    <span><?php echo $level1->cl1_title;?></span> <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                    </a>
                                    <?php 
                                    $this->db->select('*')->from('category_level2')->where(array('cl1_id'=>$level1->cl1_id,'cl2_status'=>1));
                                    $ql2 = $this->db->get();
                                    if( $ql2->num_rows()>0 ):
                                    ?>
                                    <div class="wrap-popup">
                                        <div class="popup">
                                            <div class="row">
                                                <?php foreach( $ql2->result() as $level2 ):?>
                                                <div class="col-md-4 col-sm-6">
                                                    <ul class="nav">
                                                        <h3><a href="<?php echo base_url().'products/'.$level1->cl1_slug.'/'.$level2->cl2_slug;?>"><?php echo $level2->cl2_title;?></a></h3>
                                                        <?php 
                                                        $this->db->select('*')->from('category_level3')->where(array('cl2_id'=>$level2->cl2_id,'cl3_status'=>1));
                                                        $ql3 = $this->db->get();
                                                        if( $ql3->num_rows()>0 ):
                                                        foreach( $ql3->result() as $level3 ):
                                                        ?>
                                                        <li class=""><a href="<?php echo base_url().'products/'.$level1->cl1_slug.'/'.$level2->cl2_slug.'/'.$level3->cl3_slug;?>"><span><?php echo $level3->cl3_title;?></span></a></li>
                                                        <?php endforeach;?>
                                                        <?php endif;?>
                                                    </ul>
                                                </div>
                                                <?php endforeach;?>
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <?php endif;?>
                                
                                </li>
                                <?php endforeach;?>
                                <?php endif;?>

                                
                                
                                
                                
                                
                                
                                
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="slider">
                            <div class="owl-carousel">
                                <?php $this->db->select('*')->from('slider')->where('slide_status',1);?>
                                <?php $sql = $this->db->get();?>
                                <?php if( $sql->num_rows()>0 ): ?>
                                <?php foreach( $sql->result() as $slide ):?>
                                <div class="item">
                                    <a href="<?php echo http_url($slide->slide_link);?>">
                                    <?php echo $slide->slide_photo!=''?'<img src="'.base_url().'assets/images/slides/'.$slide->slide_photo.'" class="img-responsive" alt="">':'<img src="'.base_url().'assets/images/no-image.png" class="img-responsive" alt="">';?>
                                    </a>
                                </div>
                            <?php endforeach;?>
                            <?php else:?>
                                <div class="item">
                                    <img src="<?php echo base_url()?>assets/images/no-image.png" class="img-responsive" alt="" style="width:893px;height:410px;">
                                </div>
                            <?php endif;?>
                                
                            </div>
                        </div>


                        <!-- Super hot product -->
                        <div class="col-md-12 no-padding">
                            <?php 
                            $this->db->select('*')->from('products')->where(array('product_super_hot'=>1,'product_status'=>1));
                            $this->db->order_by('product_id','DESC');
                            $this->db->limit(4);
                            $sql = $this->db->get();
                            if( $sql->num_rows()>0 ):
                            foreach( $sql->result() as $products ):
                            ?>
                            
                            <div class="col-md-3">
                                <div class="zoom-out-effect left">
                                    <div class="img-box">
                                        <a href="">
                                        <?php echo $products->product_photo!=''?'<img src="'.base_url().'assets/images/products/'.$products->product_photo.'" class="img-responsive" alt="">':'<img src="'.base_url().'assets/images/no-image.png" class="img-responsive" alt="">';?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <?php endforeach;?>
                            <?php else: ?>
                            <h4>No super hot products available</h4>
                            <?php endif;?>
                        
                        </div>
                        <!-- /Super hot product -->
                    </div>
                    
                    <div class="col-md-3 no-padding">
                        <?php 
                        $this->db->select('*')->from('deals')->where('d_status',1)->order_by('d_id','DESC')->limit(4);
                        $sql = $this->db->get();
                        if( $sql->num_rows()>0 ):
                        foreach( $sql->result() as $records ):
                        ?>
                        <div class="baner clearfix">
                            <div class="baner-content">
                                <h3><?php echo $records->d_title;?></h3>
                                <a href="<?php echo http_url($records->d_link); ?>" target="_blank">Click Here <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                            </div>
                            <div class="zoom-out-effect left">
                                <div class="img-box">
                                    <?php echo $records->d_photo!=''?'<img src="'.base_url().'assets/images/deals/'.$records->d_photo.'">':'<img src="'.base_url().'assets/images/no-image.png'.'">'; ?>
                                </div>
                            </div>
                        </div>

                        <?php endforeach;?>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </section>
    <!--SideBar And Slider Section-->

    <?php 
    $this->db->select('*')->from('home_banners')->where(array('id'=>1,'status'=>1))->limit(1);
    $sql = $this->db->get();
    if( $sql->num_rows()>0 ):
    $firstbanner = $sql->row();
    if( $firstbanner->photo != '' ):
    ?>
    <!--Banners Long Section-->
        <section class="long-banner-sec">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 no-padding">
                        <div class="long-banner">
                            <a href="<?php echo http_url($firstbanner->link);?>" target="_blank">
                            <img src="<?php echo base_url();?>assets/images/banners/<?php echo $firstbanner->photo?>" class="img-responsive" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!--Banners Long Section-->
    <?php endif;?>
    <?php endif;?>

    <!--Product Section-->
        <section class="latest-product">
            <div class="container-fluid">
                <div class="row">
                    <div class="headings clearfix">
                        <div class="col-md-6">
                            <h2>Latest Products</h2>
                        </div>
                        <div class="col-md-6">
                            <a href="" class="pull-right">View More</a>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>
                </div>

                <?php 
                $this->db->select('*')->from('products')->where(array('product_latest'=>1,'product_status'=>1))->order_by('product_id','DESC')->limit(12);
                $sql = $this->db->get();
                if( $sql->num_rows()>0 ):
                ?>

                <div class="row">
                    <?php foreach( $sql->result() as $products ):?>
                    <div class="col-md-2 no-padding">
                        <div class="prd">
                            <a href="<?php echo base_url('preview/'.$products->product_slug.'/'.$products->product_reference);?>">
                            <?php echo $products->product_photo!=''?'<img src="'.base_url().'assets/images/products/'.$products->product_photo.'" class="img-responsive" alt="">':'<img src="'.base_url().'assets/images/no-image.png" class="img-responsive" alt="">';?>
                            </a>
                            <h4><?php echo $products->product_title;?></h4>
                            <p>Rs. <?php echo $products->product_price;?></p>
                            <!-- <strike>Rs. <?php echo $products->product_price;?></strike> -->
                        </div>
                    </div>
                    <?php endforeach;?>
                    
                </div>
                <?php endif;?>
            </div>
        </section>
    <!--Product Section-->

    <?php 
    $this->db->select('*')->from('home_banners')->where(array('id'=>2,'status'=>1))->limit(1);
    $sql = $this->db->get();
    if( $sql->num_rows()>0 ):
    $secondbanner = $sql->row();
    if( $secondbanner->photo != '' ):
    ?>
    <!--Banners Long Section-->
        <section class="long-banner-sec">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 no-padding">
                        <div class="long-banner">
                            <a href="<?php echo http_url($secondbanner->link);?>" target="_blank">
                            <img src="<?php echo base_url();?>assets/images/banners/<?php echo $secondbanner->photo?>" class="img-responsive" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!--Banners Long Section-->
    <?php endif;?>
    <?php endif;?>

    <!--Product Section-->
    <section class="latest-product">
        <div class="container-fluid">
            <div class="row">
                <div class="headings clearfix">
                    <div class="col-md-6">
                        <h2>Sale Products</h2>
                    </div>
                    <div class="col-md-6">
                        <a href="" class="pull-right">View More</a>
                    </div>
                    <div class="col-md-12">
                        <hr>
                    </div>
                </div>
            </div>

            <?php 
            $this->db->select('*')->from('products');
            //$this->db->where('`product_id` IN('.$clause.')',NULL,FALSE);
            $this->db->where('product_status',1);
            $this->db->where(array('product_discount!='=>'','product_discount>'=>0));
            $this->db->order_by('product_id','DESC');
            $this->db->limit(12);

            $sql = $this->db->get();
            if( $sql->num_rows()>0 ):
            ?>
            <div class="row">
                <?php foreach( $sql->result() as $products ):?>
                <div class="col-md-2 no-padding">
                    <div class="prd">
                        <a href="<?php echo base_url();?>">
                        <?php echo $products->product_photo!=''?'<img src="'.base_url().'assets/images/products/'.$products->product_photo.'" class="img-responsive" alt="">':'<img src="'.base_url().'assets/images/no-image.png" class="img-responsive" alt="">';?>
                        </a>
                        <h4><?php echo $products->product_title;?></h4>
                        <p>Rs. <?php echo $products->product_sale_price;?></p>
                        <strike>Rs. <?php echo $products->product_price;?></strike>
                    </div>
                </div>
                <?php endforeach;?>
                
            </div>
            <?php else:?>
                <h2>Products Not Found</h2>
            <?php endif;?>
        </div>
    </section>
    <!--Product Section-->


    <!--Product Section-->
    <section class="latest-product">
        <div class="container-fluid">
            <div class="row">
                <div class="headings clearfix">
                    <div class="col-md-6">
                        <h2>Featured Products</h2>
                    </div>
                    <div class="col-md-6">
                        <a href="" class="pull-right">View More</a>
                    </div>
                    <div class="col-md-12">
                        <hr>
                    </div>
                </div>
            </div>

            <?php 
            $this->db->select('*')->from('products');
            //$this->db->where('`product_id` IN('.$clause.')',NULL,FALSE);
            $this->db->where('product_status',1);
            $this->db->where('product_featured',1);
            $this->db->order_by('product_id','DESC');
            $this->db->limit(12);

            $sql = $this->db->get();
            if( $sql->num_rows()>0 ):
            ?>
            <div class="row">
                <?php foreach( $sql->result() as $products ):?>
                <div class="col-md-2 no-padding">
                    <div class="prd">
                        <a href="<?php echo base_url();?>">
                        <?php echo $products->product_photo!=''?'<img src="'.base_url().'assets/images/products/'.$products->product_photo.'" class="img-responsive" alt="">':'<img src="'.base_url().'assets/images/no-image.png" class="img-responsive" alt="">';?>
                        </a>
                        <h4><?php echo $products->product_title;?></h4>
                        <p>Rs. <?php echo $products->product_sale_price;?></p>
                    </div>
                </div>
                <?php endforeach;?>
                
            </div>
            <?php else:?>
                <h2>Products Not Found</h2>
            <?php endif;?>
        </div>
    </section>
    <!--Product Section-->


    <!--Product Section-->
    <section class="latest-product">
        <div class="container-fluid">
            <div class="row">
                <div class="headings clearfix">
                    <div class="col-md-6">
                        <h2>Hot Products</h2>
                    </div>
                    <div class="col-md-6">
                        <a href="" class="pull-right">View More</a>
                    </div>
                    <div class="col-md-12">
                        <hr>
                    </div>
                </div>
            </div>
            <?php 
            $this->db->select('*')->from('products');
            //$this->db->where('`product_id` IN('.$clause.')',NULL,FALSE);
            $this->db->where('product_status',1);
            $this->db->where(array('product_hot'=>1));
            $this->db->order_by('product_id','DESC');
            $this->db->limit(12);

            $sql = $this->db->get();
            if( $sql->num_rows()>0 ):
            ?>
            <div class="row">
                <?php foreach( $sql->result() as $products ):?>
                <div class="col-md-2 no-padding">
                    <div class="prd">
                        <a href="#">
                        <?php echo $products->product_photo!=''?'<img src="'.base_url().'assets/images/products/'.$products->product_photo.'" class="img-responsive" alt="">':'<img src="'.base_url().'assets/images/no-image.png" class="img-responsive" alt="">';?>
                        </a>
                        <h4><?php echo $products->product_title;?></h4>
                        <p>Rs. <?php echo $products->product_price;?></p>
                    </div>
                </div>
                <?php endforeach;?>
            <?php else:?>
                <h4>No hot products available</h4>
            <?php endif;?>

            
            </div>
        </div>
    </section>
    <!--Product Section-->

    <?php require_once('footer.php');?>

    

        <script src="<?php echo base_url()?>assets/front/js/jquery.1.11.1.js"></script>
        <script src="<?php echo base_url()?>assets/front/js/bootstrap.js"></script>
        <script src="<?php echo base_url()?>assets/front/js/owl.carousel.min.js"></script>
        <script src="<?php echo base_url()?>assets/front/js/plugins.js"></script>
        <script src="<?php echo base_url()?>assets/front/js/aos.js"></script>
        <script src="<?php echo base_url()?>assets/front/js/main.js"></script>
        <script src="<?php echo base_url()?>assets/jquery-ui.js"></script>
        <script src="<?php echo base_url()?>assets/front/js/ml-stack-nav.js"></script>
        <link href="<?php echo base_url()?>assets/jquery-ui.css" rel="stylesheet" type="text/css" media="all"/>
    </body>
</html>
<?php require_once('js.php');?>

<script>
    //Animation Script
    AOS.init({
        duration: 1200,
        disable: window.innerWidth < 1280
    });

    $('.owl-carousel').owlCarousel({
        autoPlay : true,
        stopOnHover : true,
        navigation : true,
        slideSpeed : 2000,
        items: 1,
        paginationSpeed : 1000,
        pagination: false,
        goToFirstSpeed : 2000,
        loop:true,
        autoHeight : false,
        navigationText: [
            "<i class=\"fa fa-chevron-left\" aria-hidden=\"true\"></i>",
            "<i class=\"fa fa-chevron-right\" aria-hidden=\"true\"></i>"
        ]

    });

    $('.owl-carouseled').owlCarousel({
        autoPlay : true,
        stopOnHover : true,
        navigation : true,
        slideSpeed : 2000,
        items: 1,
        paginationSpeed : 1000,
        pagination: false,
        goToFirstSpeed : 2000,
        loop:true,
        autoHeight : false,
        navigationText: [
            "<i class=\"fa fa-chevron-left\" aria-hidden=\"true\"></i>",
            "<i class=\"fa fa-chevron-right\" aria-hidden=\"true\"></i>"
        ]

    });
</script>

<script>
    $(".js-ml-stack-nav").mlStackNav();
</script>