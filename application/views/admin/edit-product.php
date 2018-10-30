<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="">

    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url();?>assets/plugins/images/favicon.png">

    <title><?php echo site_title;?></title>

    <!-- Bootstrap Core CSS -->

    <link href="<?php echo base_url();?>assets/admin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo base_url();?>assets/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">

    <!-- Menu CSS -->

    <link href="<?php echo base_url();?>assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">

    <!-- animation CSS -->

    <link href="<?php echo base_url();?>assets/admin/css/animate.css" rel="stylesheet">

    <!-- Custom CSS -->

    <link href="<?php echo base_url();?>assets/admin/css/style.css" rel="stylesheet">

    <!-- color CSS -->

    <link href="<?php echo base_url();?>assets/admin/css/colors/default.css" id="theme" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

<![endif]-->

    <script>

    (function(i, s, o, g, r, a, m) {

        i['GoogleAnalyticsObject'] = r;

        i[r] = i[r] || function() {

            (i[r].q = i[r].q || []).push(arguments)

        }, i[r].l = 1 * new Date();

        a = s.createElement(o),

            m = s.getElementsByTagName(o)[0];

        a.async = 1;

        a.src = g;

        m.parentNode.insertBefore(a, m)

    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');



    ga('create', 'UA-19175540-9', 'auto');

    ga('send', 'pageview');

    </script>

    <style>

        .img:hover {

            opacity: 0.3 !important;

            /*filter: alpha(opacity=50) !important;*/

        }

    </style>



</head>



<body class="fix-sidebar">

    <!-- Preloader -->

    <div class="preloader">

        <div class="cssload-speeding-wheel"></div>

    </div>

    <div id="wrapper">

        <?php require_once('navigation.php');?>

        <?php require_once('left-sidebar.php');?>

        <!-- Page Content -->

        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row bg-title">

                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

                        <h4 class="page-title">Products</h4>

                    </div>

                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                        <ol class="breadcrumb">

                            <li><a href="<?php echo base_url();?>admin/dashboard">Dashboard</a></li>

                            <li><a href="<?php echo base_url();?>admin/products">Products</a></li>

                            <li class="active">Edit Product</li>

                        </ol>

                    </div>

                    <!-- /.col-lg-12 -->

                </div>

                

                <!--.row-->

                <div class="row">

                    <div class="col-md-12">

                        <div class="panel panel-info">

                            <div class="panel-heading">Edit Product</div>

                            <div class="panel-wrapper collapse in" aria-expanded="true">

                                <div class="panel-body">

                                    <form action="<?php echo base_url();?>admin/update-product" method="post" enctype="multipart/form-data">

                                        <div class="form-body">

                                            

                                            <div class="row">



                                                <div class="col-md-8">



                                                    <?php if( $this->session->flashdata('error') ):?>

                                                    <div class="alert alert-success alert-dismissable">

                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>

                                                        <?php echo $this->session->flashdata('error');?>

                                                    </div>

                                                    <?php endif; ?>



                                                    



                                                    <div class="form-group">

                                                        <label class="control-label">Product Name</label>

                                                        <input type="text" class="form-control" name="title" placeholder="Clothes" value="<?php echo $product->product_title;?>" required>

                                                    </div>



                                                    <div class="form-group">

                                                        <label class="control-label">Product Short Description</label>

                                                        <textarea class="form-control" name="shortdesc" rows="4"><?php echo $product->product_short_description;?></textarea>

                                                    </div>



                                                    <div class="form-group">

                                                        <label class="control-label">Product Full Description</label>

                                                        <textarea class="form-control" name="fulldesc" rows="10"><?php echo $product->product_description;?></textarea>

                                                    </div>



                                                    



                                                    <div class="form-group">

                                                        <label class="control-label">Product Featured Photo</label>

                                                        <input type="file" class="form-control" name="photo">

                                                        <?php echo $product->product_photo!=''?'<br><img src="'.base_url('assets/images/products/').$product->product_photo.'" style="width:100px; hight:100px">':'<br><img src="'.base_url('assets/images/no-image.png').'" style="width:100px; hight:100px">';?>



                                                    </div>





                                                    <!-- <div class="form-group">

                                                        <label class="control-label">Product Weight</label>

                                                        <input type="text" class="form-control" name="weight" placeholder="250g" value="" required>

                                                    </div> -->

                                                    

                                                    <!-- <div class="form-group">

                                                        <label class="control-label">Product Gallery Photos</label>

                                                        <input type="file" class="form-control" name="gallery[]" multiple>

                                                        <?php 

                                                        $this->db->select('*')->from('product_photos')->where('product_id',$product->product_id);

                                                        $sql = $this->db->get();

                                                        if( $sql->num_rows()>0 ):

                                                            echo '<br>';

                                                            $spaces = str_repeat('&nbsp;',5);

                                                            foreach( $sql->result() as $val ):

                                                                echo $val->photo!=''?'<a title="Delete Photo" href="javascript:;" class="img" id="gal'.$val->photo_id.'"><img src="'.base_url('assets/images/products/').$val->photo.'" style="width:100px; hight:100px"></a>'.$spaces:'';



                                                                

                                                            endforeach;

                                                        endif;

                                                        ?>

                                                    </div> -->



                                                    



                                                    <div class="form-group">

                                                        <label class="control-label">Product Price</label>

                                                        <input type="text" class="form-control" name="price" placeholder="250" value="<?php echo $product->product_price;?>" required>

                                                    </div>



                                                    <!-- <div class="form-group">

                                                        <label class="control-label">Product Sale Price</label>

                                                        <input type="text" class="form-control" name="saleprice" placeholder="250" value="<?php echo $product->product_sale_price;?>" required>

                                                    </div>



                                                    <div class="form-group">

                                                        <label class="control-label">Product Discount</label>

                                                        <input type="text" class="form-control" name="discount" placeholder="10" value="<?php echo $product->product_discount;?>">

                                                    </div> -->



                                                    <div class="form-group">

                                                        <label class="control-label">Product Stock</label>

                                                        <input type="text" class="form-control" name="stock" placeholder="250" value="<?php echo $product->product_stock;?>" required>

                                                    </div>


                                                  
                                                    <!-- New Fileds added after inte -->
                                                    <div class="form-group">
                                                        <label class="control-label">Shipping</label>
                                                        <input type="text" class="form-control" name="shipping" value="<?php echo $product->shipping;?>" placeholder="shipping" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Delivery</label>
                                                        <input type="text" class="form-control" name="delivery" value="<?php echo $product->delivery;?>" placeholder="shipping" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Return Days</label>
                                                        <input type="number" class="form-control" name="return_days" value="<?php echo $product->return_days;?>" placeholder="Return Days" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Return</label>
                                                        <input type="checkbox"  name="return" <?php echo ($product->return == 'on')?'checked':'';?> placeholder="Return Days" required>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="control-label">Description</label>
                                                        <textarea class="form-control" name="description"><?php echo $product->description;?></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Country</label>
                                                        <select class="form-control" name="country" required>
                                                            <option value="">--Select--</option>
                                                            <?php foreach($country as $key => $val){?>
                                                                <option value="<?php echo $val->country_code?>" <?php echo ($val->country_code == $product->country)?'selected':'';?>><?php echo $val->country?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Check COD Country</label>
                                                        <select class="form-control" name="check_country" required>
                                                            <option value="1" <?php echo ($product->check_country == 1)?'selected':''?>>Yes</option>
                                                            <option value="0" <?php echo ($product->check_country == 0)?'selected':''?>>N0</option>
                                                        </select>
                                                    </div>

                                                     <div class="form-group">
                                                        <label>Condition</label>
                                                        <select class="form-control" name="product_condition" required>
                                                            <option value="">--Select--</option>
                                                            <option value="old" <?php echo ($product->product_condition == 'old')?'selected':''; ?>>Old</option>
                                                            <option value="new" <?php echo ($product->product_condition == 'new')?'selected':''; ?>>New</option>
                                                        </select>
                                                    </div>
                                                    <!--  -->
                                                    <div class="form-group">

                                                        <label>Display Stock To Client</label>

                                                        <select class="form-control" name="stockdisplay" required>

                                                            <option value="">--Select--</option>

                                                            <option value="0" <?php echo $product->product_stock_show==0?'selected':''?> >No</option>

                                                            <option value="1" <?php echo $product->product_stock_show==1?'selected':''?> >Yes</option>

                                                        </select>

                                                    </div>



                                                    <div class="form-group">

                                                        <label>Latest Product</label>

                                                        <select class="form-control" name="latest">

                                                            <option value="">--Select--</option>

                                                            <option value="0" <?php echo $product->product_latest==0?'selected':''?> >No</option>

                                                            <option value="1" <?php echo $product->product_latest==1?'selected':''?> >Yes</option>

                                                        </select>

                                                    </div>



                                                    <div class="form-group">

                                                        <label>Featured Product</label>

                                                        <select class="form-control" name="featured">

                                                            <option value="">--Select--</option>

                                                            <option value="0" <?php echo $product->product_featured==0?'selected':''?> >No</option>

                                                            <option value="1" <?php echo $product->product_featured==1?'selected':''?> >Yes</option>

                                                        </select>

                                                    </div>



                                                    <div class="form-group">

                                                        <label>Hot Product</label>

                                                        <select class="form-control" name="hot">

                                                            <option value="">--Select--</option>

                                                            <option value="0" <?php echo $product->product_hot==0?'selected':''?>>No</option>

                                                            <option value="1" <?php echo $product->product_hot==1?'selected':''?>>Yes</option>

                                                        </select>

                                                    </div>



                                                    <div class="form-group">

                                                        <label>Super Hot Product</label>

                                                        <select class="form-control" name="superhot">

                                                            <option value="">--Select--</option>

                                                            <option value="0" <?php echo $product->product_super_hot==0?'selected':''?>>No</option>

                                                            <option value="1" <?php echo $product->product_super_hot==1?'selected':''?>>Yes</option>

                                                        </select>

                                                    </div>


                                                    <div class="form-group">
                                                        <label>Available</label>
                                                        <select class="form-control" name="available">
                                                            <option value="">--Select--</option>
                                                            <option value="0" <?php echo $product->available==0?'selected':''?>>No</option>
                                                            <option value="1" <?php echo $product->available==1?'selected':''?>>Yes</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Sold Out</label>
                                                        <select class="form-control" name="sold_out">
                                                            <option value="">--Select--</option>
                                                            <option value="0" <?php echo $product->sold_out==0?'selected':''?>>No</option>
                                                            <option value="1" <?php echo $product->sold_out==1?'selected':''?>>Yes</option>
                                                        </select>
                                                    </div>


                                                    <div class="form-group">

                                                        <label>Status</label>

                                                        <select class="form-control" name="status" required>

                                                            <option value="">--Select--</option>

                                                            <option value="1" <?php echo $product->product_status==1?'selected':''?> >Active</option>

                                                            <option value="0" <?php echo $product->product_status==0?'selected':''?> >Deactive</option>

                                                        </select>

                                                    </div>
                                                    
                                                     <div class="form-group">
                                                        <input type="checkbox" name="get_quote" <?php echo ($product->get_quote == 'on')?'checked':'';?>>
                                                        <label>Get a quote</label>
                                                        <input type="checkbox" name="repair" <?php echo ($product->repair == 'on')?'checked':'';?>>
                                                        <label>Repair</label>
                                                        <input type="checkbox" name="cod" <?php echo ($product->cod == 'on')?'checked':'';?>>
                                                        <label>COD</label>
                                                        <input type="number" name="repair_price" class="form-control" value="<?php echo $product->repair_price;?>" placeholder="Repair Price">
                                                    </div>

                                                    <?php 
                                                        $attribute = explode(',', $product->attribute);
                                                        $value     = explode(',', $product->value);
                                                        $count   = count($attribute);

                                                    ?>
                                                     <div class="row col-md-12" id="add_disease">
                                                        <div class="form-group col-md-4">
                                                            <label>Label</label>
                                                            <input type="text" name="attribute[]"  class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-5">
                                                            <label>Value</label>
                                                            <input type="text" name="value[]"  class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-3" style="margin-top:25px">
                                                            <button type="button" class="btn btn-primary" id="add_more"> + </button>
                                                        </div>
                                                    </div>
                                                    <?php for($i = 0 ; $i<=$count ; $i++){
                                                        if(isset($attribute[$i]) && !empty($attribute[$i])){

                                                        ?>
                                                        <div class="row col-md-12" id="add_disease">
                                                        <div class="form-group col-md-4">
                                                            <label>Label</label>
                                                            <input type="text" name="attribute[]" value="<?php echo $attribute[$i];?>" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-5">
                                                            <label>Value</label>
                                                            <input type="text" name="value[]" value="<?php echo  $value[$i];?>" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-3" style="margin-top:25px">
                                                            <button type="button" class="btn btn-primary" id="add_more"> + </button>
                                                        </div>
                                                    </div>
                                                
                                                    <?php }}?>

                                                <?php 

                                                $l1 = []; $l2 = []; $l3 = [];

                                                $this->db->select('*')->from('product_categories')->where('pc_product_id',$product->product_id);

                                                $sql = $this->db->get();

                                                if( $sql->num_rows()>0 ):

                                                    foreach( $sql->result() as $val ):

                                                        $l1[] = $val->pc_cl1_id;

                                                        $l2[] = $val->pc_cl2_id;

                                                        $l3[] = $val->pc_cl3_id;

                                                    endforeach;

                                                endif;

                                                

                                                ?>



                                                <div class="col-md-4">

                                                    <div class="form-group">

                                                        <h3>Categories</h3>

                                                        

                                                            <?php $this->db->select('*')->from('category_level1')->where(array('cl1_status',1));

                                                            ?>

                                                            <?php $sql = $this->db->get();?>

                                                            <?php if( $sql->num_rows()>0 ):?>

                                                            

                                                            <?php foreach( $sql->result() as $val):?>

                                                            

                                                                <div class="checkbox checkbox-success">

                                                                    <input id="checkbox<?php echo $val->cl1_title;?>" type="checkbox" name="level1[]" value="<?php echo $val->cl1_id;?>" <?php echo in_array($val->cl1_id,$l1)?'checked':'';?> >

                                                                    <label for="checkbox<?php echo $val->cl1_title;?>"><?php echo $val->cl1_title;?></label>

                                                                </div>

                                                                

                                                                        <?php $this->db->select('*')->from('category_level2')->where(array('cl1_id'=>$val->cl1_id,'cl2_status'=>1));?>

                                                                        <?php $level2 = $this->db->get();?>

                                                                        <?php if( $level2->num_rows()>0 ):?>

                                                                        <?php foreach( $level2->result() as $val2 ):?>

                                                                            <div class="checkbox checkbox-success">

                                                                                <?php echo str_repeat("&nbsp;",5);?>

                                                                                <input id="checkbox<?php echo $val->cl1_title.$val2->cl2_title;?>" type="checkbox" name="level2[]" value="<?php echo $val->cl1_id;?>,<?php echo $val2->cl2_id;?>" <?php echo in_array($val2->cl2_id,$l2)?'checked':'';?> >

                                                                                <label for="checkbox<?php echo $val->cl1_title.$val2->cl2_title;?>"><?php echo $val2->cl2_title;?></label>

                                                                            </div>



                                                                                <?php $this->db->select('*')->from('category_level3')->where(array('cl1_id'=>$val->cl1_id,'cl2_id'=>$val2->cl2_id,'cl3_status'=>1));?>

                                                                                <?php $level3 = $this->db->get();?>

                                                                                <?php if( $level3->num_rows()>0 ):?>

                                                                                <?php foreach( $level3->result() as $val3 ):?>

                                                                                    <div class="checkbox checkbox-success">

                                                                                        <?php echo str_repeat("&nbsp;",10);?>

                                                                                        <input id="checkbox<?php echo $val->cl1_title.$val2->cl2_title.$val3->cl3_title;?>" type="checkbox" name="level3[]" value="<?php echo $val->cl1_id;?>,<?php echo $val2->cl2_id;?>,<?php echo $val3->cl3_id;?>" <?php echo in_array($val3->cl3_id,$l3)?'checked':'';?> >

                                                                                        <label for="checkbox<?php echo $val->cl1_title.$val2->cl2_title.$val3->cl3_title;?>"><?php echo $val3->cl3_title;?></label>

                                                                                    </div>



                                                                                            



                                                                                <?php endforeach;?>

                                                                                <?php endif;?>





                                                                        <?php endforeach;?>

                                                                        <?php endif;?>        

                                                            <?php endforeach;?>

                                                            <?php endif;?>

                                                    

                                                    </div>

                                                    <hr>

                                                    <?php 

                                                    $v = [];

                                                    $this->db->select('*')->from('product_variations')->where('pv_product_id',$product->product_id);

                                                    $sql = $this->db->get();

                                                    if( $sql->num_rows()>0 ):

                                                        foreach( $sql->result() as $val ):

                                                            $v[] = $val->pv_attribute_id.','.$val->pv_value_id;

                                                        endforeach;

                                                    endif;

                                                    ?>

                                                    <!-- <div class="form-group">

                                                        <h3>Product Attributes</h3>

                                                        

                                                            <?php $this->db->select('*')->from('product_attributes')->where(array('pa_status',1));?>

                                                            <?php $sql = $this->db->get();?>

                                                            <?php if( $sql->num_rows()>0 ):?>

                                                            

                                                            <?php foreach( $sql->result() as $val):?>

                                                            

                                                                <div class="checkbox checkbox-success">

                                                                    <input id="checkbox<?php echo $val->pa_title;?>" type="checkbox" value="">

                                                                    <label for="checkbox<?php echo $val->pa_title;?>"><?php echo $val->pa_title;?></label>

                                                                </div>

                                                                

                                                                        <?php $this->db->select('*')->from('product_attribute_values')->where(array('pav_attribute_id'=>$val->pa_id,'pav_status'=>1));?>

                                                                        <?php $sql = $this->db->get();?>

                                                                        <?php if( $sql->num_rows()>0 ):?>

                                                                        <?php foreach( $sql->result() as $val1 ):?>

                                                                            <div class="checkbox checkbox-success">

                                                                                <?php echo str_repeat("&nbsp;",5);?>

                                                                                <input id="checkbox<?php echo $val->pa_title.$val1->pav_title;?>" type="checkbox" name="attributes[]" value="<?php echo $val->pa_id.','.$val1->pav_id;?>" <?php echo in_array($val->pa_id.','.$val1->pav_id,$v)?'checked':'';?> >

                                                                                <label for="checkbox<?php echo $val->pa_title.$val1->pav_title;?>"><?php echo $val1->pav_title;?></label>

                                                                            </div>



                                                                        <?php endforeach;?>

                                                                        <?php endif;?>        

                                                            

                                                            

                                                            <?php endforeach;?>

                                                            <?php endif;?>

                                                    

                                                    </div> -->

                                                </div>

                                                



                                            </div>

                                            <!--/row-->

                                            

                                            

                                            

                                        </div>

                                        <div class="form-actions">

                                            <input type="hidden" class="form-control" name="id" value="<?php echo $product->product_id;?>">

                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>

                                            <button type="button" class="btn btn-default">Cancel</button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!--./row-->

                

                <?php //require_once('right-sidebar.php');?>

            </div>

            <!-- /.container-fluid -->

            <?php require_once('footer.php');?>

        </div>

        <!-- /#page-wrapper -->

    </div>

    <!-- /#wrapper -->

    <!-- jQuery -->

    <script src="<?php echo base_url();?>assets/plugins/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->

    <script src="<?php echo base_url();?>assets/admin/bootstrap/dist/js/tether.min.js"></script>

    <script src="<?php echo base_url();?>assets/admin/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="<?php echo base_url();?>assets/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>

    <!-- Menu Plugin JavaScript -->

    <script src="<?php echo base_url();?>assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

    <!--slimscroll JavaScript -->

    <script src="<?php echo base_url();?>assets/admin/js/jquery.slimscroll.js"></script>

    <!--Wave Effects -->

    <script src="<?php echo base_url();?>assets/admin/js/waves.js"></script>

    <!-- Custom Theme JavaScript -->

    <script src="<?php echo base_url();?>assets/admin/js/custom.min.js"></script>

    <script src="<?php echo base_url();?>assets/admin/js/jasny-bootstrap.js"></script>

    <!--Style Switcher -->

    <script src="<?php echo base_url();?>assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>



    <script>

        $(document).on('click','[title="Delete Photo"]',function(){

            var data = $(this).prop('id').replace('gal','');

            if( data != '' && data != 0 ){

                if( confirm('Are You Sure') ){

                    $.ajax({

                        url: '<?php echo base_url()?>admin/delete-gallery-item',

                        type: 'post',

                        data: {'data':data},

                        success:function(res){

                            window.location.reload();

                            //alert(res);

                        }



                    });



                }

            }

        });

        count = 0;
        /*Add Disease*/
        $(document).on('click' , '#add_more' , function (){
            html = `
                        <div class="form-group col-md-4 remove_`+count+`">
                            <label>Label</label>
                            <input type="text" name="attribute[]" class="form-control">
                        </div>
                        <div class="form-group col-md-4 remove_`+count+`">
                            <label>Value</label>
                            <input type="text" name="value[]" class="form-control">
                        </div>
                    
                    <div class="col-md-2" id="remove_btn`+count+`" style="margin-top:25px">
                        <button class="btn btn-primary remove_disease" type="button" id="`+count+`">-</button>
                    </div>`;
            $('#add_disease').append(html);   
            count++;
        });

        /*Remove Disease*/
        $(document).on('click' , '.remove_disease' , function (){
            remove = $(this).attr('id');
            $('.remove_'+remove).remove();
            $('#remove_btn'+remove).remove();
            $('#'+remove).remove();
           
        });   

    </script>



</body>



</html>

