
$(document).ready(function(){
    // get the number of .child elements
    var totalitems = $("#parent .child").length;
    // get the height of .child
    var scrollval = $('.child').height();
    // work out the total height.
    var totalheight = (totalitems*scrollval)-($("#parent").height());

    $(document).on("click", "#down",function(){
        var currentscrollval = $('#parent').scrollTop();

        $('#parent').scrollTop(scrollval+currentscrollval);

        // hide/show buttons
        if(currentscrollval == totalheight) {
            $(this).hide();
        }
        else {
            $("#up").show();
        }
    });
    $(document).on("click", "#up",function(){
        var currentscrollval = parseInt($('#parent').scrollTop());

        $('#parent').scrollTop(currentscrollval-scrollval);

        // hide/show buttons
        if((scrollval+currentscrollval) == scrollval) {
            $(this).hide();
        }
        else {
            $("#down").show();
        }
    });
});

/******************************************/
/* Menu slide down */
/******************************************/

$(".client-slider").sensation({
    dots: false,
    infinite: true,
    slidesToShow: 5,
    arrows: false,
    autoplay: true,
    centerMode: true,

    responsive: [
        {
            breakpoint: 768,
            settings: {
                arrows: false,
                slidesToShow: 3
            }
        },
        {
            breakpoint: 480,
            settings: {
                arrows: false,
                centerMode: false,
                slidesToShow: 2
            }
        }
    ] });


$(".methodology-slider").sensation({
        // dots: false,
        // infinite: true,
        slidesToShow: 4,
        arrows: true
    }
);

$('#filter-industry').on('click', function(e){
    $('#filter-main').trigger('click');
    $('#filter-main').trigger('click');
});



$(document).ready(function(){

    $('ul.tabs li').click(function(){
        var tab_id = $(this).attr('data-tab');
        var content = {
            'tab1':{ 'color_bg':'#dcdcdc' , 'big_head':'Logo Design Packages','mid_head':'Special Packages for Incomparable <br> Brand Identity Solutions',
                'para':'We’ve crafted some of the best logo design packages <br> for emerging startups, pre-existing brands and  world-class corporations. <br> Pick a suitable design package <br> below or discuss a custom quote with us today.' },

            'tab2':{ 'color_bg':'#dcdcdc' , 'big_head':'Brand Design Packages','mid_head':'Special Packages for Incomparable <br> Brand Identity Solutions',
                'para':'We’ve crafted some of the best logo design packages <br> for emerging startups, pre-existing brands and  world-class corporations. <br> Pick a suitable design package <br> below or discuss a custom quote with us today.'},

            'tab3':{ 'color_bg':'#dcdcdc' , 'big_head':'Web Design Packages','mid_head':'Special Packages for Incomparable <br> Brand Identity Solutions',
                'para':'We’ve crafted some of the best logo design packages <br> for emerging startups, pre-existing brands and  world-class corporations. <br> Pick a suitable design package <br> below or discuss a custom quote with us today.'},

            'tab4':{ 'color_bg':'#dcdcdc' , 'big_head':'App Design Packages','mid_head':'Special Packages for Incomparable <br> Brand Identity Solutions',
                'para':'We’ve crafted some of the best logo design packages <br> for emerging startups, pre-existing brands and  world-class corporations. <br> Pick a suitable design package <br> below or discuss a custom quote with us today.'},

            'tab5':{ 'color_bg':'#dcdcdc' , 'big_head':'sensation Design Packages','mid_head':'Special Packages for Incomparable <br> Brand Identity Solutions',
                'para':'We’ve crafted some of the best logo design packages <br> for emerging startups, pre-existing brands and  world-class corporations. <br> Pick a suitable design package <br> below or discuss a custom quote with us today.'},

            'tab6':{ 'color_bg':'#dcdcdc' , 'big_head':'Content Design Packages','mid_head':'Special Packages for Incomparable <br> Brand Identity Solutions',
                'para':'We’ve crafted some of the best logo design packages <br> for emerging startups, pre-existing brands and  world-class corporations. <br> Pick a suitable design package <br> below or discuss a custom quote with us today.'},

            'tab7':{ 'color_bg':'#dcdcdc' , 'big_head':'eCommerce Design Packages','mid_head':'Special Packages for Incomparable <br> Brand Identity Solutions',
                'para':'We’ve crafted some of the best logo design packages <br> for emerging startups, pre-existing brands and  world-class corporations. <br> Pick a suitable design package <br> below or discuss a custom quote with us today.'},

            'tab8':{ 'color_bg':'#dcdcdc' , 'big_head':'Marketing Design Packages','mid_head':'Special Packages for Incomparable <br> Brand Identity Solutions',
                'para':'We’ve crafted some of the best logo design packages <br> for emerging startups, pre-existing brands and  world-class corporations. <br> Pick a suitable design package <br> below or discuss a custom quote with us today.'}
        };

        $("#"+tab_id).css('opacity' , '0');
        $($("#"+tab_id).find('.pricing-slider').find('.sensation-dots').find('button')[0]).trigger('click');

        setTimeout(function(){ $("#"+tab_id).animate({opacity: 1}, 500); }, 500);

        $('.hero-services').css( 'backgroundColor' , content[tab_id].color_bg );
        $('.hero-services').find('h4').html(content[tab_id].big_head);
        $('.hero-services').find('h3').html(content[tab_id].mid_head);
        $('.hero-services').find('p').html(content[tab_id].para);


        $('ul.tabs li').removeClass('current');
        $('.tab-content').removeClass('current');

        ;

        $(this).addClass('current');
        $("#"+tab_id).addClass('current');
    });

    $('.package-detail .single ul').slimScroll({
        height: '280px',
        railVisible: true,
        alwaysVisible: true,
        railColor: '#e8e8e8',
        color:'#e8e8e8',
        railOpacity: 0.3
    });

    $('.page-overlay-inner').slimScroll({
        height: '298px',
        innerWidth: '300px',
        railVisible: false,
        alwaysVisible: false,
        railColor: '#e8e8e8',
        color:'#e8e8e8',
        railOpacity: 0.3
    });

    $('.services .cs-options ul').slimScroll({
        height: '250px',
        width: '100%',
        railColor: '#e8e8e8',
        color:'#e8e8e8',
        railVisible: false,
        railOpacity: 0
    });


});

var index=0;
var themeObj = {
    '.btn-green': ['gre-bg','pet-bg','pur-bg','ali-bg','sea-bg','san-bg','mad-bg' ],
    'header ul.secondary-nav a': ['gre-h','pet-h','pur-h','ali-h','sea-h','san-h','mad-h' ],
    '.client-wrpper a': ['gre','pet','pur','ali','sea','san','mad' ],
    '.testimonial-dec h4': ['gre','pet','pur','ali','sea','san','mad' ],
    'section.pricing h4': ['gre','pet','pur','ali','sea','san','mad'],
    'section.testimonials h4': ['gre','pet','pur','ali','sea','san','mad'],
    'section.hero-services h4': ['gre','pet','pur','ali','sea','san','mad'],
    'section.service-detail h4': ['gre','pet','pur','ali','sea','san','mad'],
    'section.qualities h4:first-child': ['gre','pet','pur','ali','sea','san','mad'],
    'section.get_quote h4': ['gre','pet','pur','ali','sea','san','mad'],
    '.sensation-dots li button': ['gre-dots','pet-dots','pur-dots','ali-dots','sea-dots','san-dots','mad-dots'],
    '.subscribe_fold h4': ['gre','pet','pur','ali','sea','san','mad'],
    'section.call-actions .fa': ['gre','pet','pur','ali','sea','san','mad'],
    'section.call-actions h3 span': ['gre','pet','pur','ali','sea','san','mad'],
    'div.single h6': ['gre','pet','pur','ali','sea','san','mad'],
    'div.single span.price': ['gre','pet','pur','ali','sea','san','mad'],
    'div.single p span': ['gre','pet','pur','ali','sea','san','mad'],
    '.draw': ['gre-d','pet-d','pur-d','ali-d','sea-d','san-d','mad-d' ],
    '.skill-bar': ['gre-bg','pet-bg','pur-bg','ali-bg','sea-bg','san-bg','mad-bg' ],
    '.overlay-green': ['gre-bg','pet-bg','pur-bg','ali-bg','sea-bg','san-bg','mad-bg' ],
    '.portfolio_fold h4':['gre','pet','pur','ali','sea','san','mad' ],
    'section.count h4':['gre','pet','pur','ali','sea','san','mad' ],
    'section.award h4':['gre','pet','pur','ali','sea','san','mad' ],
    'section.count span':['gre','pet','pur','ali','sea','san','mad' ],
    'div.subscribe button': ['gre-bg','pet-bg','pur-bg','ali-bg','sea-bg','san-bg','mad-bg' ],
    '.branding-package .overlay-green': ['gre-bg-o','pet-bg-o','pur-bg-o','ali-bg-o','sea-bg-o','san-bg-o','mad-bg-o' ],
    '.branding-package .orderNow': ['gre','pet','pur','ali','sea','san','mad' ],
    'footer number': ['gre','pet','pur','ali','sea','san','mad' ],
    '.call-action number': ['gre','pet','pur','ali','sea','san','mad' ],
    '.hero-subservices h4': ['gre','pet','pur','ali','sea','san','mad' ],
    '.awards h4:first-child': ['gre','pet','pur','ali','sea','san','mad' ],
    '.portfolio-jump a': ['gre','pet','pur','ali','sea','san','mad' ],
    '.about-content h4': ['gre','pet','pur','ali','sea','san','mad' ],
    '.clients-section h4': ['gre','pet','pur','ali','sea','san','mad' ],
    '.logo a': ['logo-gre','logo-pet','logo-pur','logo-ali','logo-sea','logo-san','logo-mad' ],
    '.sub-footer ul li a':  ['gre-h','pet-h','pur-h','ali-h','sea-h','san-h','mad-h' ],
    '.action-no': ['gre','pet','pur','ali','sea','san','mad' ],
    '.action-chat': ['gre','pet','pur','ali','sea','san','mad' ],
    '.header-nav': ['gre-bg','pet-bg','pur-bg','ali-bg','sea-bg','san-bg','mad-bg' ],
    '.btn-line-fill': ['gre-fill','pet-fill','pur-fill','ali-fill','sea-fill','san-fill','mad-fill' ],
    '.about_fold h4':  ['gre','pet','pur','ali','sea','san','mad' ],
    '.modal-body h4':  ['gre','pet','pur','ali','sea','san','mad' ],
    '.package-detail h4': ['gre','pet','pur','ali','sea','san','mad' ],
    'section.thankyou h4': ['gre','pet','pur','ali','sea','san','mad' ],
    '.single-address h4': ['gre','pet','pur','ali','sea','san','mad' ],
    '.sensation-slider a': ['gre','pet','pur','ali','sea','san','mad' ],
    'ul#navigation > li + a':  ['gre-h','pet-h','pur-h','ali-h','sea-h','san-h','mad-h' ],
    '.call-action span': ['gre','pet','pur','ali','sea','san','mad' ],
    '.nav-anim-dd': ['gre-bg-h','pet-bg-h','pur-bg-h','ali-bg-h','sea-bg-h','san-bg-h','mad-bg-h' ],
    '.nav-anim': ['gre-h','pet-h','pur-h','ali-h','sea-h','san-h','mad-h' ],

};

$(document).ready(function(){
    setInterval(function(){
        var keys = Object.keys( themeObj );
        for(var i=0; i<keys.length;i++){
            $(keys[i]).addClass(themeObj[keys[i]][index]);
            for(var j=0; j<themeObj[keys[i]].length; j++){
                if(j!=index)
                    $(keys[i]).removeClass(themeObj[keys[i]][j]);
            }
        }
        index++;
        if( index >= 10 ){ index=0; }
    }, 10000 ); /* Interval fn ends */
});


(function(){
    $(document).ready(function() {
        $('#recentOrders').DataTable();
    });



})();






/******************************************/
/* FAQ section script */
/******************************************/

(function(){
    $(".faq-sections *").hide();
    $('.clients-1').css('display', 'block');
    $('li[data-value=clients-1]').addClass('cs-selected');
    $('.faq-opt').on('click', function(e){
        var optionValue = $(this).data("value");
        if(optionValue){
            $(".faq-sections div").hide();
            $(".faq-sections " + "." + optionValue).show();
        } else{
            $(".box").hide();
        }
    });

    /******************************************/
    /* FAQ section script ends */
    /******************************************/

    /*------------------------------------------------------------------------------------------*/

    /******************************************/
    /* Membership section script */
    /******************************************/
//$('.membership-box span.more').on('click', function(){
//    var $self = $(this);
//    if($('.methodology-slider').css('height')=="420px"){
//         var height = true;
//         $('.membership-detail').each(function(){
//         if($(this).hasClass('in') && $(this).attr('id')!=$self.parent().next().attr('id') ){ height=false; }
//     });
//         if(height){ $('.methodology-slider').animate({'height':'230px'});  }
//    } else{
//        $('.methodology-slider').animate({'height':'420px'});
//    }
//});

    /******************************************/
    /* Membership section script */
    /******************************************/

    /*------------------------------------------------------------------------------------------*/

    /******************************************/
    /* Portfolio page script */
    /******************************************/

    $('.cbp-l-filters-dropdownHeader').on('mouseover', function(e){
        $('#cover').show();
    });

    $('.cbp-l-filters-dropdownList').on('mouseover', function(e){
        $('#cover').show();
    });


    $('.cbp-l-filters-dropdownList').on('mouseout', function(e){
        $('#cover').hide();
    });


    $('.cbp-l-filters-dropdownHeader').on('mouseout', function(e){
        $('#cover').hide();
    });

    /******************************************/
    /* Portfolio page script ends */
    /******************************************/


    /*------------------------------------------------------------------------------------------*/


    /******************************************/
    /* Login , Register & forgot page wow class removing script */
    /******************************************/

    var loc = window.location.href;

    if(loc.substring( ( loc.length-6 ) , loc.length)=="signup" || loc.substring( ( loc.length-6 ) , loc.length)=="forgot"){
        $('#header-sroll').removeClass('wow');
        $('header .logo a').css('background-position', 'top center');
    } else if(loc.substring( ( loc.length-5 ) , loc.length)=="login" || loc.substring( ( loc.length-5 ) , loc.length)=="reset"){
        $('#header-sroll').removeClass('wow');
        $('header .logo a').css('background-position', 'top center');
    }

    /******************************************/
    /* Login , Register & forgot page wow class removing script ends */
    /******************************************/



    $('.actions .cancel-btn').on('click', function(e){
        e.preventDefault();
        $('#veiw-toggle').trigger('click');
    });

    $('#veiw-toggle').on('click', function(e){
        e.preventDefault();
        var tabId = $(this).parent().find('ul.tabs-profile li.current').data('tab');

        if($("#"+tabId).find('.inner-view').is(":visible")){
            $("#"+tabId + " .inner-view").hide();
            $("#"+tabId + " .outer-view").show();
        } else{
            $("#"+tabId + " .inner-view").show();
            $("#"+tabId + " .outer-view").hide();
        }
    });

})();



$(document).ready(function(){

    $('ul.tabs-profile li').click(function(){
        var tab_id = $(this).attr('data-tab');

        $('ul.tabs-profile li').removeClass('current');
        $('.tab-content').removeClass('current');

        $(this).addClass('current');
        $("#"+tab_id).addClass('current');
    })

})

/*osama*/
$('#datetimepicker_start_time').datetimepicker({
    startDate:'+1971/05/01'//or 1986/12/08
});


$('#brand-date').datetimepicker({
    startDate:'+1971/05/01'//or 1986/12/08
});

$('#social-date').datetimepicker({
    startDate:'+1971/05/01'//or 1986/12/08
});

$('#video-date').datetimepicker({
    startDate:'+1971/05/01'//or 1986/12/08
});

$('#content-date').datetimepicker({
    startDate:'+1971/05/01'//or 1986/12/08
});


$('#ecomm-date').datetimepicker({
    startDate:'+1971/05/01'//or 1986/12/08
});







/******************************************/
/* Active class script */
/******************************************/

(function(){

    function addActiveClass(){
        var loc = window.location.href;
        var patt = new RegExp("(:\/\/.*\/)+(.*)");
        link = patt.exec(loc);
        link[2] = (link[2] == null || link[2] == "" ) ? link[2] = "home" : link[2];

        var $elm = $( "a[data-active='" + $("a[data-active='"+ link[2] +"']").data('active') + "']"  );

        if( $elm.data('child') == 1 ){
            console.log( 'a child' );
            $("ul#navigation").find("a[data-active='" + $elm.data('parent') + "']").addClass('active');
        } else{
            console.log( 'not a child' );
            $("ul#navigation").find("a[data-active='" + link[2] + "']").addClass('active');
        }


    }

    addActiveClass();

})();


(function(){
    var $form = $('.step-form');
    var $sections = $form.find('section');
    $sections.hide();
    $($sections[0]).show();
    var data = [];

    $('.btn-step-next').on('click', function(e){
        $form = $(this).closest('.step-form');
        e.preventDefault();
        var inputs = $($sections[0]).find('input'),
            $tokenMeta = $("meta[name=csrf_token]");
        var goFurther = true;
        $.each( inputs, function( key, value ) {
            if( $(value).val() == "" || $(value).val()==null ){  goFurther=false;}
            data[ $(value).attr('name')] =  $(value).val();
        });

        if(!goFurther){
            $form.find('.btn-step-form').trigger('click');
            data = [];
            return false;
        }

        var keys = Object.keys(data);

        var token = $(this).closest('.step-form').find("input[name=_token]").val();
        $.ajax({
            url: 'https://www.designproficient.com/quote/short',
            type: 'POST',
            data:  { 'name' :  data['name'], 'email' :  data['email'], 'number' :  data['number'] , '_token': token , 'additional' : data[3]  , 'additional': data[keys[3]], 'page': $('input[name=page]').val() },
            success: function(response) {
                if (typeof response.errors === 'undefined' || response.errors.length < 1) {
                    console.log( response );
                } else {

                }
            },
            error: function(errors) { console.log('POST request Failed with errors: ' + errors.responseText); console.log( data ); console.log( data );  console.log( errors ); },
            complete: function() { console.log('POST request completed'); }
        });




        var $curr = $($(this).parent().parent());
        $curr.fadeOut(300);
        var nextId = $curr.data('view');
        nextId++;
        $('#heading').text('Order Information');
        $('.step-form section[data-view=' + nextId + "]" ).fadeIn(1000);
    });

    $('.btn-step-prev').on('click', function(e){
        e.preventDefault();
        var $curr = $($(this).parent().parent());
        $curr.fadeOut(200);
        var nextId = $curr.data('view');
        nextId--;
        $('.step-form section[data-view=' + nextId + "]" ).fadeIn(1100);
    });

})();


(function(){
    $('.cbp-filter-item').on('click', function(e){
        console.log( $(this).parent().prev() );
        if($(this).parent().hasClass('only-xs-drop')){
            $(this).parent().parent().removeClass('cbp-l-filters-dropdownWrap-open')
        }
    });
})();

/***********************************************************************************/
/*************  Package page patchup  ****************************/
/***********************************************************************************/

$(document).ready(function(){

    $('ul.tabs li').click(function(){
        var tab_id = $(this).attr('data-tab');
        $("#"+tab_id).css('opacity' , '0');
        $($("#"+tab_id).find('button.sensation-prev')[0]).trigger('click');
        setTimeout(function(){ $("#"+tab_id).animate({opacity: 1}, 500); }, 500);
        $('ul.tabs li').removeClass('current');
        $('.tab-content').removeClass('current');
        $(this).addClass('current');
        $("#"+tab_id).addClass('current');
    });

});

/***********************************************************************************/
/*************  Package page patchup ends  ****************************/
/***********************************************************************************/



/******************************************/
/* Active class script ends */
/******************************************/






/***********************************************************************************/
/*************  Package page patchup  ****************************/
/***********************************************************************************/

$(document).ready(function(){

    $('ul.tabs li').click(function(){
        var tab_id = $(this).attr('data-tab');
        $("#"+tab_id).css('opacity' , '0');
        $($("#"+tab_id).find('button.sensation-prev')[0]).trigger('click');
        setTimeout(function(){ $("#"+tab_id).animate({opacity: 1}, 500); }, 500);
        $('ul.tabs li').removeClass('current');
        $('.tab-content').removeClass('current');
        $(this).addClass('current');
        $("#"+tab_id).addClass('current');
    });

});

/***********************************************************************************/
/*************  Package page patchup ends  ****************************/
/***********************************************************************************/








var cartCalculator = {
    items: [],
    fields: [],
    addons: [],
    total: 0,
    itemsContainer: document.getElementById('custom-item-list'),
    fieldsContainer: document.getElementById('custom-fields'),
    init: function(){
        var self = cartCalculator;
        self.bindEvents();
    },
    bindEvents: function(){
        var self = cartCalculator;
        $('.data-item-custom').on('click', self.calculateItems);
        $('.addon-close').on('click', self.hideAddonsByButton);
        $('.data-item-custom-addon').on('click', self.handleAddons );
        $('.data-item-custom-quantity').on('propertychange input', self.updateQuantity);
        $('[data-toggle="tooltip"]').tooltip();
        $(window).on('scroll', self.moveCart);
    },
    moveCart: function(e){
        if( $('.box-follow-scroll').length > 0 ){


            var parentHeight = $('.table-cell-no-float')[0].clientHeight - $('.box-follow-scroll')[0].clientHeight,
                offsetTop = $(this).scrollTop();


            if( ( parseInt ( $('.box-follow-scroll')[0].offsetTop ) < parseInt($(this).scrollTop()) ) && parseInt(offsetTop) < parseInt(parentHeight ) ) {
                $('.box-follow-scroll').stop(false, false).animate( { 'top': $(this).scrollTop() });
            } else{
                if(  offsetTop > 130 && parseInt(offsetTop) < parseInt(parentHeight ) ) {
                    $('.box-follow-scroll').stop(false, false).animate( { 'top': $(this).scrollTop() });
                } else if( offsetTop < 130 ){
                    $('.box-follow-scroll').stop(false, false).animate( { 'top': 130});
                }

            }
        }

    },
    addAddon: function(item){
        var self = cartCalculator;
        addon = {
            value: $(item).data('text'),
            price: $(item).data('value'),
            parent: $(item).data('parent-id'),
            id: $(item).data('addon-id')
        };
        self.addons.push( addon );

    },
    updateQuantity: function(){
        var self = cartCalculator,
            current = $(this);
        self.items.forEach(function(item, index){
            if( item.id == current.data('parent-id') ){
                if( current.val()!="" && current.val()!=null ){
                    self.items[index].quantity = parseInt(current.val());
                } else{
                    self.items[index].quantity = 1;
                }

            }
        });

        self.clearContainers();
        self.updateTotalView();
        self.updateView();

    },
    handleAddons: function(){
        var self = cartCalculator;
        if($(this).is(':checked')){
            self.addAddon(this);
        } else{
            self.removeAddon($(this).data('addon-id'), $(this).data('parent-id'));
        }
        self.clearContainers();
        self.updateTotalView();
        self.updateView();
    },
    removeAddon(id, parentId){
        var self = cartCalculator;
        var temp = [];
        self.addons.forEach(function(item, index){
            if( item.id == id && item.parent == parentId ){

            } else{ temp.push ( item ); }
        });
        self.addons = temp;
    },
    showAddons: function(current){
        $(current).parent().next().fadeIn();
    },
    hideAddonsByButton: function(){ $(this).parent().fadeOut(); },
    hideAddons: function(current){
        $(current).parent().next().fadeOut();
    },
    uncheckAddonsOnItemHide: function(addonsAry){
        var self = cartCalculator;
        $(addonsAry).each( function(item, index){
            self.removeAddon( item.id, item.parent );
            $(this).trigger('click');
        });
        self.clearContainers();
        self.updateView();
        self.updateTotalView();
    },
    calculateItems: function(){
        var self = cartCalculator;
        if($(this).is(':checked')){
            self.addItem(this);
            self.showAddons(this);
        } else{
            self.removeItem($(this).data('item-id'));
            self.hideAddons(this);
            self.uncheckAddonsOnItemHide( $(this).parent().next().find('input[type=checkbox]:checked') );
        }
        self.clearContainers();
        self.updateView();
        self.updateTotalView();
    },
    addItem: function(item){
        var self = cartCalculator;
        obj = {
            value: $(item).val(),
            price: $(item).data('value'),
            id: $(item).data('item-id'),
            quantity: 1
        };

        self.items.push(obj);

    },
    removeItem: function(id){
        var self = cartCalculator;
        self.items = self.items.filter(item => item.id !== id)
    },
    clearContainers: function(){
        var self = cartCalculator;
        self.itemsContainer.innerHTML = '';
        self.itemsContainer.innerText = '';
        self.fieldsContainer.innerHTML = '';
        self.fieldsContainer.innerText = '';
    },
    updateView: function(){
        var self = cartCalculator;
        self.items.forEach(function(item, index){

            var detail = document.createElement("p"),
                price = document.createElement("p"),
                wrap = document.createElement("div"),
                inp = document.createElement("input"),
                asideEl = document.createElement("aside");        // Create element

            var detailt = document.createTextNode( item.value ),
                pricet = document.createTextNode( "$" + item.price + " x" +  item.quantity),
                addonText = '';       // Create a text node

            detail.setAttribute('class' , 'item-detail-cart');

            price.setAttribute('id' , 'cost_calc_breakdown_price ');
            price.setAttribute('class' , 'item-price-cart');


            /* setting input */
            inp.setAttribute('type' , 'hidden');
            inp.setAttribute('value' , item.id );
            inp.setAttribute('name' , 'items[]');

            detail.appendChild(detailt);
            price.appendChild(pricet);                                // Append the text

            wrap.appendChild(detail);
            wrap.appendChild(price);
            self.getAddonsOfCurrentItem( item.id ).forEach(function(item, index){
                addonText += " + " + item.value;
            });

            if( addonText != '' ){
                var asidet = document.createTextNode( addonText + " included" );
                asideEl.appendChild( asidet );
                wrap.appendChild( asideEl );
            }


            document.getElementById('custom-item-list').appendChild(wrap);
            document.getElementById('custom-fields').appendChild(inp);
        });
        self.updateTotalView();
    },
    getAddonsOfCurrentItem: function(id){
        var self = cartCalculator;
        return self.addons.filter(addon => addon.parent == id);
    },
    updateTotalView: function(){
        var self = cartCalculator;
        self.total = 0;
        self.items.forEach(function(item, index){
            if(item.quantity!=0)
                self.total += item.price * item.quantity;
            else
                self.total += item.price * 1;
        });
        self.addons.forEach(function(item, index){
            var parent = self.items.filter(single => single.id == item.parent);
            self.total += item.price;
        });
        document.getElementById('custom-totalCost').innerText= "$" + self.total;
    }
};

cartCalculator.init();



/******************************************/
/* Portfolio section script */
/******************************************/

$('.filter-wrapper .cbp-filter-item').addClass('disable_element');
$('.filter-wrapper .all-btn').removeClass('disable_element');


$('.filter-enable').on('click', function(){
    $('.filter-wrapper .cbp-filter-item').removeClass('disable_element');
    $('.filter-wrapper .all-btn').removeClass('disable_element');
});


$('.filter-disable').on('click', function(){
    $('.filter-wrapper .cbp-filter-item').addClass('disable_element');
    $('.filter-wrapper .all-btn').removeClass('disable_element');
});




/******************************************/
/* Membership section script */
/******************************************/
$('.membership-box span.more').on('click', function(){
    var $self = $(this);
    if($('.methodology-slider').css('height')=="0"){
        var height = true;
        $('.membership-detail').each(function(){
            if($(this).hasClass('in') && $(this).attr('id')!=$self.parent().next().attr('id') ){ height=false; }
            if(!$(this).hasClass('in')) { $('.membership-detail').hide(); }

        });
        if(height){ $('.methodology-slider').animate({'height':'230px'});  }
    } else{
        $('.methodology-slider').animate({'height':'0'});
    }
});




$(document).ready(function(){
    $(".extra-more").click(function(){
        $(".about-client-section").hide(1000);
    });
});

/******************************************/
/* Membership section script */
/******************************************/

function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);


/******************************************/
/* Footer section script */
/******************************************/
