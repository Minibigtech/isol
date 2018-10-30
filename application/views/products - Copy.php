<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $level1->cl1_title!=''?$level1->cl1_title:'';?><?php echo $level2->cl2_title!=''?' - '.$level2->cl2_title:'';?>
    <?php echo isset($level3->cl3_title)&&$level3->cl3_title!=''?' - '.$level3->cl3_title:'';?> - <?php echo site_title;?></title>
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
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/front/css/main.css">

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css"/>
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
                    
                    <?php echo (isset($level1->cl1_title)&&$level1->cl1_title!='')?'<a href="'.base_url().'categories/'.$level1->cl1_slug.'" class="btn btn-primary visible-lg-block visible-md-block">'.$level1->cl1_title.'</a>':''; ?>
                    
                    <?php echo (isset($level2->cl2_title)&&$level2->cl2_title!='')?'<a href="'.base_url().'products/'.$level1->cl1_slug.'/'.$level2->cl2_slug.'" class="btn btn-primary visible-lg-block visible-md-block">'.$level2->cl2_title.'</a>':''; ?>
                    
                    <?php echo (isset($level3->cl3_title)&&$level3->cl3_title!='')?'<a href="javascript:;" class="btn btn-primary visible-lg-block visible-md-block">'.$level3->cl3_title.'</a>':''; ?>
                    <!-- <a href="#" class="btn btn-primary visible-lg-block visible-md-block">Section</a>
                    <a href="#" class="btn btn-primary visible-lg-block visible-md-block">Category</a> -->
                </div>
            </div>
        </div>
    </div>
</section>
<!--Bread Crumb Section-->


<!--Side category Section-->
<section class="filter">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <!--<ul id="accordion" class="accordion">
                    <li>
                        <div class="link">SIZE<i class="fa fa-chevron-down"></i></div>
                        <ul class="submenu">
                            <li><a href="#"><input type="checkbox"/>XL</a></li>
                            <li><a href="#"><input type="checkbox"/>SM</a></li>
                            <li><a href="#"><input type="checkbox"/>MD</a></li>
                            <li><a href="#"><input type="checkbox"/>LG</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="link">COLOR<i class="fa fa-chevron-down"></i></div>
                        <ul class="submenu">
                            <li><a href="#"><input type="checkbox"/>BLACK</a></li>
                            <li><a href="#"><input type="checkbox"/>BLUE</a></li>
                            <li><a href="#"><input type="checkbox"/>PINK</a></li>
                            <li><a href="#"><input type="checkbox"/>RED</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="link">GENDER<i class="fa fa-chevron-down"></i></div>
                        <ul class="submenu">
                            <li><a href="#"><input type="checkbox"/>MALE</a></li>
                            <li><a href="#"><input type="checkbox"/>FEMALE</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="link">PRICE<i class="fa fa-chevron-down"></i></div>
                        <ul class="submenu">
                            <li><a href="#"><input type="checkbox"/>MALE</a></li>
                            <li><a href="#"><input type="checkbox"/>FEMALE</a></li>
                        </ul>
                    </li>
                </ul>-->

                <div id="page" class="clearfix">
                    <div id="refines">
                <h3>Price Range</h3>
                <div class="price-slider"></div>
                <h3 class="price-value"></h3>

                <?php 
                $this->db->select('*')->from('product_attributes')->where('pa_status',1); 
                $sql = $this->db->get();
                if( $sql->num_rows()>0 ):
                foreach( $sql->result() as $prop ):
                ?>

                <h2><?php echo $prop->pa_title;?></h2>
                <div class="section <?php echo $prop->pa_title;?>">
                    <!-- <button class="button reset secondary-button small">Reset</button> -->
                    <?php 
                    $this->db->select('*')->from('product_attribute_values')->where(array('pav_attribute_id'=>$prop->pa_id,'pav_status'=>1));
                    $sql = $this->db->get();
                    if( $sql->num_rows()>0 ):
                    foreach( $sql->result() as $values ):
                    ?>                  
                    <div class="option">
                        <input type="checkbox" class="check " name="<?php echo $prop->pa_slug;?>" id="filter-<?php echo $prop->pa_title;?>-<?php echo $values->pav_title;?>" title="<?php echo $values->pav_title;?>" value="<?php echo $values->pav_title;?>" 
                        <?php echo strpos($_SERVER['REQUEST_URI'],$values->pav_title)!==false?'checked':'';?> >
                        <label class="checkbox-label tall" for="filter-<?php echo $prop->pa_title;?>-<?php echo $values->pav_title;?>">
                            <span></span>
                            <?php echo $values->pav_title;?>
                        </label>
                    </div>
                    <?php endforeach;?>
                    <?php endif;?>
                    
                </div>
                <?php endforeach;?>
                <?php endif;?>

                
                


                </div>
                </div>


                <div class="ad-baner">
                    <img src="img/side-bar.png" class="img-responsive" alt="">
                </div>
            </div>
            <div class="col-md-9">
                <div class="col-md-12">
                    <div class="product-heading">
                        <h2>
                            <?php echo isset($level2->cl2_title)&&$level2->cl2_title!=''?$level2->cl2_title:'';?>
                            <?php echo isset($level3->cl3_title)&&$level3->cl3_title!=''?' '.$level3->cl3_title:'';?>
                        </h2>
                        <hr>
                        <hr>
                    </div>
                </div>

                <div class="col-md-12 no-padding">
                    
                    <?php if( !empty($products) ):?>
                    <?php foreach( $products as $product ):?>
                    <div class="col-md-4">
                        <div class="prd">
                            <a href="<?php echo base_url('preview/'.$product->product_slug.'/'.$product->product_reference);?>">
                            <?php echo $product->product_photo!=''?'<img src="'.base_url().'assets/images/products/'.$product->product_photo.'" class="img-responsive" alt="">':'<img src="'.base_url().'assets/images/no-image.png" class="img-responsive" alt="">';?>
                            </a>
                            <h4><?php echo $product->product_title;?></h4>
                            <p>Rs. <?php echo $product->product_price;?></p>
                        </div>
                    </div>
                    <?php endforeach;?>
                    <?php endif;?>

                    
                
                </div>
                
                <div class="col-md-12">
                    <ul class="pagination">
                        <li class="disabled"><a href="#">«</a></li>
                        <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">»</a></li>
                    </ul>
                </div>
            
            </div>
        </div>
    </div>
</section>
<!--Side category Section-->

<?php require_once('footer.php');?>

<script src="<?php echo base_url()?>assets/front/js/jquery.1.11.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="<?php echo base_url()?>assets/front/js/bootstrap.js"></script>
<script src="<?php echo base_url()?>assets/front/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url()?>assets/front/js/plugins.js"></script>
<script src="<?php echo base_url()?>assets/front/js/aos.js"></script>
<script src="<?php echo base_url()?>assets/front/js/main.js"></script>
<script src="<?php echo base_url()?>assets/jquery-ui.js"></script>
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

    var url = window.location.href;
    //var url
    $('input[type="checkbox"]').click(function(){
    //if( $(this).prop('checked') )
        //$(this).prop('checked',$(this).prop('checked'));
        
        var name = $(this).prop('name');
        var b = '';
        //var url = window.location.href;
        if( url.indexOf(name) >= 0 ){
        
        }else{
            if( $('[type="checkbox"]:checked').length > 1 ){
                b = '&'+name+'='; 
            }else{
                b = '?'+name+'='; 
            }
        }
        
        
        var count = 1;
        $('[name="'+name+'"]:checked').each(function(){
            if( url.indexOf($(this).val()) < 0 ){
                //if( $(this).prop('checked') )
                b+=count==1?$(this).val():'--'+$(this).val();
            }
        count++;
        });

        url+=b;

        
        window.location.href = url;
        
    });

    
     

    $( ".price-slider" ).slider({
        range: true,
        min: 0,
        max: 20000,
        values: [ 3000, 15000 ],
        slide: function( event, ui ) {
            $( ".price-value" ).text( "£" + ui.values[0] + " - £" + ui.values[1] );
            
        },
        /*stop: function(event, ui) {
            var b = '';
            if( $('[type="checkbox"]:checked').length > 1 ){
                
                b = '&price='+ui.values[0]+'-'+ui.values[1]; 
            }else{
                b = '?price='+ui.values[0]+'-'+ui.values[1]; 
            }
            url+=b;
            window.location.href = url;
        }
        */
        //test(ui.values[ 0 ],ui.values[ 1 ]);


    });

    $( ".price-value" ).text( "£" + $( ".price-slider" ).slider( "values", 0 ) +
    " - £" + $(".price-slider" ).slider( "values", 1 ));

    
    

</script>
