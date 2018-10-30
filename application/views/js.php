<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet" type="text/css" media="all"/> -->

<script type="text/javascript">

$(document).ready(function(){

    $("#search").autocomplete({

       

        source: "<?php echo base_url();?>search-product",

        //source: "{{ url('demos/autocompleteajax') }}",

            focus: function( event, ui ) {

            //$( "#search" ).val( ui.item.title ); // uncomment this line if you want to select value to search box  

            return false;

        },

        select: function( event, ui ) {

            window.location.href = ui.item.url;

        }

    }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {

        var inner_html = '<a href="' + item.url + '" ><div class="list_item_container"><div class="image"><img class="img-responsive" src="' + item.image + '" width="50" height="50" ></div><div class="label"><h4><b>' + item.title + '</b></h4>'+item.price+'</a>';

        return $( "<li></li>" )

                .data( "item.autocomplete", item )

                .append(inner_html)

                .appendTo( ul );

    };

});

</script> 
<script type="text/javascript">
    
 
        $("#cart").hover(function() {
          $(".shopping-cart").show( "fast");
        });

        $(".shopping-cart").mouseenter(function() {
          $(".shopping-cart").show();
        });

        $(".shopping-cart").mouseleave(function() {
          $(".shopping-cart").hide();
        });



        $("#wishlist").hover(function() {
          $(".wishlist-cart").show( "fast");
        });

        $(".wishlist-cart").mouseenter(function() {
          $(".wishlist-cart").show();
        });

        $(".wishlist-cart").mouseleave(function() {
          $(".wishlist-cart").hide();
        });
    </script>
    <script type="text/javascript">
        $(document).on('click','.add_cart',function (){
            product_id = $(this).attr('id');
            url = '<?php echo base_url('assets/images/products/');?>';
            
            $.ajax({
                url  : '<?php echo base_url();?>user/add-to-cart',
                type : 'POST',
                data : {'product_id':product_id},
                success:function(data){
                    data = $.parseJSON(data);
                    alert('Added to cart');
                    /*$('#cart_items').html('');*/
                    count = '<?php count($this->cart->contents());?>';
                       $html = `<li class="clearfix" id="`+data.row_id+`">
                            <img src="`+url+data.product_photo+`" alt="item1" class="img-responsive" alt="" width="100" />
                            <span class="item-name">`+data.name+`</span>
                            <span class="item-price">`+data.price+`</span>
                            <span class="item-quantity">Quantity: `+data.qty+`</span>
                            <span class="item-quantity"><a href="javascript:;" id="remove_me`+data.row_id+`"  class="btn btn-success delete-cart remove_me">x</a></span>
                          </li>`
                          $('#cart_items').prepend($html);
                        $('.inner_badge').html(data.count);
                    }
            });
        });
        $(document).on('click','.remove_me',function(){
            id = $(this).attr('id');
            row_id = id.substr(9);
            $.ajax({
                url  : '<?php echo base_url();?>user/delete-cart-product',
                type : 'POST',
                data : {'row_id':row_id},
                success:function(data){
                    alert('Product Deleted Successfully');
                    count = $('.inner_badge').html();
                    $('#'+row_id).remove();
                    $('.inner_badge').html(parseInt(count) - 1);
                    }
            });
        });
        $(document).on('click','.add_repair',function (){
            product_id = $(this).attr('id');
            product_id = product_id.substr(10);
            url = '<?php echo base_url('assets/images/products/');?>';
            $.ajax({
                url  : '<?php echo base_url();?>user/add-to-cart-repair',
                type : 'POST',
                data : {'product_id':product_id},
                success:function(data){
                    data = $.parseJSON(data);
                    alert('Added to cart');
                    /*$('#cart_items').html('');*/
                    count = '<?php count($this->cart->contents());?>';
                       $html = `<li class="clearfix" id="`+data.row_id+`">
                            <img src="`+url+data.product_photo+`" alt="item1" class="img-responsive" alt="" width="100" />
                            <span class="item-name">`+data.name+`</span>
                            <span class="item-price">`+data.price+`</span>
                            <span class="item-quantity">Quantity: `+data.qty+`</span>
                            <span class="item-quantity"><a href="javascript:;" id="remove_me`+data.row_id+`"  class="btn btn-success delete-cart remove_me">x</a></span>
                          </li>`
                          $('#cart_items').prepend($html);
                        $('.inner_badge').html(data.count);
                    }
            });
        });

       
    </script>