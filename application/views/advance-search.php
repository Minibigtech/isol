<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php include('head.php'); ?>
        <link rel="stylesheet" href="<?php echo base_url('assets/frontend/')?>css/sidebar.css">
        <link href="css/bootstrap-dropdownhover.min.css" rel="stylesheet">

        <style type="text/css">
          input::-webkit-outer-spin-button,
          input::-webkit-inner-spin-button {
              /* display: none; <- Crashes Chrome on hover */
              -webkit-appearance: none;
              margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
          }
          
          
          
          
          .glyphicon { margin-right:5px; }
.thumbnail
{
    margin-bottom: 20px;
    padding: 0px;
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
    border-radius: 0px;
}

.item.list-group-item
{
    float: none;
    width: 100%;
    background-color: #fff;
    margin-bottom: 10px;
}
.item.list-group-item:nth-of-type(odd):hover,.item.list-group-item:hover
{
    background: #428bca;
}

.item.list-group-item .list-group-image
{
    margin-right: 10px;
}
.item.list-group-item .thumbnail
{
    margin-bottom: 0px;
}
.item.list-group-item .caption
{
    padding: 9px 9px 0px 9px;
}
.item.list-group-item:nth-of-type(odd)
{
    background: #eeeeee;
}

.item.list-group-item:before, .item.list-group-item:after
{
    display: table;
    content: " ";
}

.item.list-group-item img
{
    float: left;
}
.item.list-group-item:after
{
    clear: both;
}
.list-group-item-text
{
    margin: 0 0 11px;
}

          
          
          
          
          
          
          
          
          
        </style>
    </head>
    <body>
    <?php include('header.php'); ?>
    <section class="nav"><?php include('navigation.php'); ?></section>
    <section class="catagories-sec">
      <div class="container-fluid">
        <div class="row">
          <div class="wrapper">
            <!-- Sidebar Holder -->
              <?php 

                if($this->session->userdata('searchFilter') != ''){
                      $search_filter=$this->session->userdata('searchFilter');
                      
                      if(isset($search_filter['level1']) && !empty($search_filter['level1'])){
                          $level1_filter = $search_filter['level1'];
                      }else{
                          $level1_filter = '' ;
                      }
                      if(isset($search_filter['level2']) && !empty($search_filter['level2'])){
                          $level2_filter = $search_filter['level2'];
                          $level2_filter = explode(',', $level2_filter[0]);
                      }else{
                          $level2_filter = '' ;
                      }

                      if(isset($search_filter['level3']) && !empty($search_filter['level3'])){
                          $level3_filter = $search_filter['level3'];
                          $level3_filter = explode(',', $level3_filter[0]);

                      }else{
                          $level3_filter = '' ;
                      }

                      if(isset($search_filter['cod']) && !empty($search_filter['cod'])){
                          $cod_filter = $search_filter['cod'];
                      }else{
                          $cod_filter = '' ;
                      }



                      if(isset($search_filter['old']) && !empty($search_filter['old'])){
                          $old_filter = $search_filter['old'];
                      }else{
                          $old_filter = '' ;
                      }

                      if(isset($search_filter['sold_out']) && !empty($search_filter['sold_out'])){
                          $sold_out_filter = $search_filter['sold_out'];
                      }else{
                          $sold_out_filter = '' ;
                      }

                      if(isset($search_filter['avalaible']) && !empty($search_filter['avalaible'])){
                          $avalaible_filter = $search_filter['avalaible'];
                      }else{
                          $avalaible_filter = '' ;
                      }

                      if(isset($search_filter['new']) && !empty($search_filter['new'])){
                          $new_filter = $search_filter['new'];
                      }else{
                          $new_filter = '' ;
                      }

                      if(isset($search_filter['start_price']) && !empty($search_filter['start_price'])){
                          $start_price_filter = $search_filter['start_price'];
                      }else{
                          $start_price_filter = '' ;
                      }

                      if(isset($search_filter['end_price']) && !empty($search_filter['end_price'])){
                          $end_price_filter = $search_filter['end_price'];
                      }else{
                          $end_price_filter = '' ;
                      }

                      if(isset($search_filter['repair']) && !empty($search_filter['repair'])){
                          $repair_filter = $search_filter['repair'];
                      }else{
                          $repair_filter = '' ;
                      }
                    }else{

                      $cod_filter = '' ;
                      $old_filter = '' ;
                      $level1_filter = '' ;
                      $sold_out_filter = '' ;
                      $new_filter = '' ;
                      $repair_filter = '' ;
                      $end_price_filter = '' ;
                      $start_price_filter = '' ;
                      $avalaible_filter = '' ;
                    }

              ?>
            <nav id="sidebar">
              <form action="<?php echo base_url('user/search-filter')?>" method="post" id="filter-search">
                <ul class="list-unstyled components">
                    <p>Categories</p>
                   
                    <?php $this->db->select('*')->from('category_level1')->where(array('cl1_status',1));?>
                    <?php $sql = $this->db->get();?>
                    <?php if( $sql->num_rows()>0 ):?>
                    <?php foreach( $sql->result() as $val):?>
                       <?php 
                      if(isset($level1_filter) && is_array($level1_filter)){
                          if(in_array($val->cl1_id, $level1_filter)){
                          $checked='checked';
                          }else{
                              $checked='';
                          }
                      }else{
                          $checked = '';
                      }
                    ?>
                    <li class="active">
                        <input id="checkbox<?php echo $val->cl1_title;?>" type="checkbox" name="level1[]" value="<?php echo $val->cl1_id;?>" <?php echo $checked ;?>>
                        <label for="checkbox<?php echo $val->cl1_title;?>"><?php echo $val->cl1_title;?></label>
                          <?php $this->db->select('*')->from('category_level2')->where(array('cl1_id'=>$val->cl1_id,'cl2_status'=>1));?>
                          <?php $level2 = $this->db->get();?>
                          <?php if( $level2->num_rows()>0 ):?>
                          <?php foreach( $level2->result() as $val2 ):
                            if(isset($level2_filter) && is_array($level2_filter)){
                                if(in_array($val2->cl2_id, $level2_filter)){
                                $checked='checked';

                                }else{
                                    $checked='';
                                }
                            }else{
                                $checked = '';
                            }
                          ?>
                        <ul class="list-unstyled">
                           <li>
                            <?php echo str_repeat("&nbsp;",5);?>
                            <input id="checkbox<?php echo $val->cl1_title.$val2->cl2_title;?>" type="checkbox" name="level2[]" value="<?php echo $val2->cl2_id;?>" <?php echo $checked ;?>>
                            <label for="checkbox<?php echo $val->cl1_title.$val2->cl2_title;?>"><?php echo $val2->cl2_title;?></label>
                            </li>
                             <?php $this->db->select('*')->from('category_level3')->where(array('cl1_id'=>$val->cl1_id,'cl2_id'=>$val2->cl2_id,'cl3_status'=>1));?>
                              <?php $level3 = $this->db->get();?>
                              <?php if( $level3->num_rows()>0 ):?>
                              <?php foreach( $level3->result() as $val3 ):
                                  if(isset($level3_filter) && is_array($level3_filter)){
                                        if(in_array($val3->cl3_id, $level3_filter)){
                                        $checked='checked';

                                        }else{
                                            $checked='';
                                        }
                                    }else{
                                        $checked = '';
                                    }

                                ?>
                            <ul class="list-unstyled">
                                <li>
                                    <?php echo str_repeat("&nbsp;",10);?>
                                    <input id="checkbox<?php echo $val->cl1_title.$val2->cl2_title.$val3->cl3_title;?>" type="checkbox" name="level3[]" value="<?php echo $val3->cl3_id;?>" <?php echo $checked ;?>>
                                    <label for="checkbox<?php echo $val->cl1_title.$val2->cl2_title.$val3->cl3_title;?>"><?php echo $val3->cl3_title;?></label>
                                </li>
                           </ul>
                             <?php endforeach;?>
                              <?php endif;?>
                        </ul>
                          <?php endforeach;?>
                          <?php endif;?>
                    </li>
                    <?php endforeach;?>
                    <?php endif;?>
                  
                </ul>


<div class="container">
  <div class="row">
       <div class="col-lg-12">
     <div class="button-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span>  Formal Shoes</button>
<ul class="dropdown-menu">
  <li><a href="#" class="small" data-value="option1" tabIndex="-1"><input type="checkbox"/>&nbsp;Formal Shoes</a></li>
  <li><a href="#" class="small" data-value="option2" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 2</a></li>
  <li><a href="#" class="small" data-value="option3" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 3</a></li>
  <li><a href="#" class="small" data-value="option4" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 4</a></li>
  <li><a href="#" class="small" data-value="option5" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 5</a></li>
  <li><a href="#" class="small" data-value="option6" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 6</a></li>
   <li><a href="#" class="small" data-value="option4" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 4</a></li>
  <li><a href="#" class="small" data-value="option5" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 5</a></li>
  <li><a href="#" class="small" data-value="option6" tabIndex="-1"><input type="checkbox"/>&nbsp;Option 6</a></li>
</ul>
  </div>
</div>
  </div>
</div>








                <ul class="list-unstyled components guaranteed">
                    <p>Cash On Delivery</p>                    
                    <li>
                        <input type="checkbox" name="cod" <?php echo ($cod_filter == 'on')?'checked':'';?>><a href="#">COD</a>                        
                    </li>
                   <!--  <li>
                        <input type="checkbox" name="shipping"><a href="#">Shipping</a>                        
                    </li> -->
                </ul>

                <ul class="list-unstyled components guaranteed">
                    <p>Condition</p>                    
                    <li>
                        <input type="checkbox" name="old" <?php echo ($old_filter == 'on')?'checked':'';?>><a href="#">Old</a>   
                    </li>
                    <li>
                        <input type="checkbox" name="new" <?php echo ($new_filter == 'on')?'checked':'';?>><a href="#">New</a>  
                    </li>
                </ul>

                <ul class="list-unstyled components guaranteed">
                    <p>Sold out</p>                    
                    <li>
                        <input type="checkbox" name="sold_out" <?php echo ($sold_out_filter == 'on')?'checked':'';?>><a href="#">Sold out</a>   
                    </li>
                </ul>

                <ul class="list-unstyled components guaranteed">
                    <p>Avalaible</p>                    
                    <li>
                        <input type="checkbox" name="avalaible" <?php echo ($avalaible_filter == 'on')?'checked':'';?>><a href="#">Available</a>   
                    </li>
                </ul>

                <ul class="list-unstyled components guaranteed">
                    <p>Price</p>                    
                    <li>
                        $<input type="number" name="start_price" id="start_price" value="<?php echo $start_price_filter;?>" style="width: 30%;">to $<input type="number" name="end_price" id="end_price" value="<?php echo $end_price_filter;?>" style="width: 30%;">                      
                    </li>
                </ul>

                <ul class="list-unstyled components guaranteed">
                    <p>Repair</p>                    
                    <li>
                        <input type="checkbox" name="repair" <?php echo ($repair_filter == 'on')?'checked':'';?>><a href="#">Repair</a>                        
                    </li>
                </ul>
            </nav>
            
            
            
            
            
            
            
            
            
            
            
            </form>
            <!-- Page Content Holder -->
            <div id="content">

                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                                <i class="glyphicon glyphicon-align-left"></i>
                                <span></span>
                            </button>
                        </div>                        
                    </div>
                </nav>
                <div class="col-md-12">
                  <div class="row">
                      
                   <!-- <div class="sort-header clearfix">
                      <div class="col-md-6 col-xs-12">
                        <div class="listings mob-hide">
                          <ul>
                            <li><a href="javascript:;">All Listings</a></li>
                            <li><a href="javascript:;">Auction</a></li>
                            <li><a href="javascript:;">Buy It Now</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <div class="dropdown sorting-drop">
                          <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" data-hover="dropdown">
                           Sort <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>                          
                            <li><a href="#">Something else here</a></li>
                            <li><a href="#">Separated link</a></li>
                          </ul>
                        </div>
                        <div class="dropdown sorting-drop">
                          <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" data-hover="dropdown">
                           View <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>                          
                            <li><a href="#">Something else here</a></li>
                            <li><a href="#">Separated link</a></li>
                          </ul>
                        </div>
                        <div class="dropdown sorting-drop">
                          <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" data-hover="dropdown">
                           Group Similar Listings</button>                        
                        </div>
                      </div>
                    </div>-->



                    
                    
                    

                    


                       <div class="container"> 
                        <h2>Find Items</h2>
                        <form action="/action_page.php">
                          <div class="form-group col-md-6" style="padding: 0;">
                            <label for="email">Enter Keywords or </label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                          </div>
                          <div class="form-group col-md-6 pull-right" style="    padding-right: 0;">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
                          </div>
                         <div class="form-group col-md-12 " style="padding: 0;">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
                          </div>
                          <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                       </div> 

                    
                    

                    <div class="col-md-12">
                      <hr>
                    </div>
                    
                  </div>
                </div>    
                
                
                
                
                
                
                
                
                
                

                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer><?php include('footer.php'); ?></footer>
    
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    
      <script>
    
    $(document).ready(function() {
    $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
    $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});
});
    
    
    
    var options = [];

$( '.dropdown-menu a' ).on( 'click', function( event ) {

   var $target = $( event.currentTarget ),
       val = $target.attr( 'data-value' ),
       $inp = $target.find( 'input' ),
       idx;

   if ( ( idx = options.indexOf( val ) ) > -1 ) {
      options.splice( idx, 1 );
      setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
   } else {
      options.push( val );
      setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
   }

   $( event.target ).blur();
      
   console.log( options );
   return false;
});
    
    
    
    
      </script>
    
    
    

    <script src="<?php echo base_url('assets/frontend/')?>js/jquery.1.11.1.js"></script>
    <script src="<?php echo base_url('assets/frontend/')?>js/bootstrap.js"></script>
    <script src="<?php echo base_url('assets/frontend/')?>js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url('assets/frontend/')?>js/plugins.js"></script>
    <script src="<?php echo base_url('assets/frontend/')?>js/aos.js"></script>
    <script src="<?php echo base_url('assets/frontend/')?>js/main.js"></script>
    <script src="<?php echo base_url('assets/frontend/')?>js/jquery.animateSlider.js"></script>
    <script src="<?php echo base_url('assets/frontend/')?>js/modernizr.js"></script>
    <!-- Bootstrap Dropdown Hover JS -->
    <script src="<?php echo base_url('assets/frontend/')?>js/bootstrap-dropdownhover.min.js"></script>
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
        $(function () {
         $('.toggle-menu').click(function(){
            $('.exo-menu').toggleClass('display');
            
         });
         
        });
    </script>

    <script>
      var acc = document.getElementsByClassName("accordion");
      var i;

      for (i = 0; i < acc.length; i++) {
          acc[i].addEventListener("click", function() {
              this.classList.toggle("active");
              var panel = this.nextElementSibling;
              if (panel.style.display === "block") {
                  panel.style.display = "none";
              } else {
                  panel.style.display = "block";
              }
          });
      }
    </script>

    <script type="text/javascript">
         $(document).ready(function () {
             $('#sidebarCollapse').on('click', function () {
                 $('#sidebar').toggleClass('active');
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
  $(document).ready(
      function()
      {
        $("input:checkbox").click(
            function()
            {
                if( $(this).is(":checked") )
                {
                    $("#filter-search").submit();
                }else{
                    $("#filter-search").submit();
                }
            }
        )
      }
  );

  $(document).ready(
      function()
      {
        $("#start_price").focusout(
            function()
            {
              $("#filter-search").submit();
            }
        )
      }
  );
  $(document).ready(
      function()
      {
        $("#end_price").focusout(
            function()
            {
              $("#filter-search").submit();
            }
        )
      }
  );
</script>