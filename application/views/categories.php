<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $level1->cl1_title;?> - <?php echo site_title;?></title>
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




<!--Bread Crumb Section-->
    <section class="breadcrumbs">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 no-padding">
                    <div class="btn-group btn-breadcrumb breadcrumb-primary">
                        <a href="<?php echo base_url();?>" class="btn btn-primary"><i class="glyphicon glyphicon-home"></i></a>
                        <a href="javascript:;" class="btn btn-primary visible-lg-block visible-md-block"><?php echo $level1->cl1_title;?></a>
                        <!-- <a href="#" class="btn btn-primary visible-lg-block visible-md-block">Breadcrumbs text</a>
                        <a href="#" class="btn btn-primary visible-lg-block visible-md-block">Section</a>
                        <a href="#" class="btn btn-primary visible-lg-block visible-md-block">Category</a>
                        <a href="#" class="btn btn-primary visible-lg-block visible-md-block">Category</a> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
<!--Bread Crumb Section-->


<!--Side category Section-->
    <section class="category">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <ul id="accordion" class="accordion">
                        <?php 
                        if( !empty($level2) ):
                        foreach($level2 as $val):
                        ?>
                        <li>
                        <div class="link"><i class="fa fa-arrow-right" aria-hidden="true"></i><?php echo $val->cl2_title;?><i class="fa fa-chevron-down"></i>
                            </div>
                            <?php 
                            $this->db->select('*')->from('category_level3')->where(array('cl2_id'=>$val->cl2_id,'cl3_status'=>1));
                            $sql = $this->db->get();
                            if( $sql->num_rows()>0 ):
                            ?>
                            <ul class="submenu">
                                <?php foreach( $sql->result() as $val1 ):?>
                                <li><a href="<?php echo base_url().'products/'.$level1->cl1_slug.'/'.$val->cl2_slug.'/'.$val1->cl3_slug;?>"><?php echo $val1->cl3_title;?></a></li>
                                <?php endforeach;?>
                            </ul>
                            <?php else:?>
                            <ul class="submenu">
                                <li><a href="javascript:;">No category available</a></li>
                            </ul>
                            <?php endif;?>
                        </li>
                        <?php endforeach;?>
                        <?php endif;?>
                        
                    </ul>

                    <!-- <div class="ad-baner">
                        <img src="<?php echo base_url()?>assets/front/img/side-bar.png" class="img-responsive" alt="">
                    </div> -->
                </div>
                <div class="col-md-9">
                    <div class="col-md-12">
                        <div class="product-heading">
                            <h2>Top Categories</h2>
                            <hr>
                            <hr>
                        </div>
                    </div>

                    <div class="col-md-12 no-padding">
                        
                        <?php if(!empty($level2)):?>
                        <?php foreach( $level2 as $records ):?>
                        <div class="col-md-4">
                            <div class="prd">
                                <a href="<?php echo base_url().'products/'.$level1->cl1_slug.'/'.$records->cl2_slug;?>">
                                <?php echo $records->cl2_photo!=''?'<img src="'.base_url().'assets/images/level2/'.$records->cl2_photo.'" class="img-responsive" alt="">':'<img src="'.base_url().'assets/images/no-image.png" class="img-responsive" alt="">';?>
                                </a>
                                <h4><?php echo $records->cl2_title;?></h4>
                                
                            </div>
                        </div>
                        <?php endforeach;?>
                        <?php endif;?>
                        
                    
                    </div>

                    

                    

                    <!-- <div class="col-md-12">
                        <ul class="pagination">
                            <li class="disabled"><a href="#">«</a></li>
                            <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">»</a></li>
                        </ul>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
<!--Side category Section-->

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


    //category Sidebar Script
    $(function() {
        var Accordion = function(el, multiple) {
            this.el = el || {};
            this.multiple = multiple || false;

            // Variables privadas
            var links = this.el.find('.link');
            // Evento
            links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
        }

        Accordion.prototype.dropdown = function(e) {
            var $el = e.data.el;
            $this = $(this),
                $next = $this.next();

            $next.slideToggle();
            $this.parent().toggleClass('open');

            if (!e.data.multiple) {
                $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
            };
        }

        var accordion = new Accordion($('#accordion'), false);
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