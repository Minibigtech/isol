// Custom Functions and plugin initiation
var blurred = false, allTotal;
$(document).ready(function(e) {

    // ================ Lazy Load ==============
    $("img.lazy").lazyload({
        effect : "fadeIn", skip_invisible : false
    });

    $('.copywrQuote').click(function(){
        goToByScroll('.calarea');
    });



    /*	$(function() {
            $("img.lazy").lazyload({
                event : "sporty"
            });
        });

        $(window).bind("load", function() {
        var timeout = setTimeout(function() { $("img.lazy").trigger("sporty") }, 5000);
        });*/


    $('#jqcheck').remove();

    $('iframe').attr('allowtransparency','true');
    $('iframe').attr('scrolling','no');

    $("#contentslider").layerSlider({
        width : '100%',
        height : '434px',
        responsive : true,
        responsiveUnder : 940,
        sublayerContainer : 940,
        autoStart : true,
        pauseOnHover : true,
        firstLayer : 1,
        animateFirstLayer : true,
        randomSlideshow : false,
        twoWaySlideshow : true,
        loops : 0,
        forceLoopNum : true,
        autoPlayVideos : true,
        autoPauseSlideshow : 'auto',
        keybNav : true,
        touchNav : true,
        skin : '',
        navStartStop : true,
        navButtons : true,
        hoverPrevNext : true,
        hoverBottomNav : false,
        showBarTimer : false,
        showCircleTimer : true,
        thumbnailNavigation : 'hover',
        tnWidth : 100,
        tnHeight : 60,
        tnContainerWidth : '60%',
        tnActiveOpacity : 35,
        tnInactiveOpacity : 100,
        imgPreload : true,
        yourLogo : false,
        yourLogoStyle : 'left: 10px; top: 10px;',
        yourLogoLink : false,
        yourLogoTarget : '_self',
        cbInit : function(element) { },
        cbStart : function(data) { },
        cbStop : function(data) { },
        cbPause : function(data) { },
        cbAnimStart : function(data) { },
        cbAnimStop : function(data) { },
        cbPrev : function(data) { },
        cbNext : function(data) { }
    });


    $('#slider1').cycle();
    $('#slider2').cycle();
    $('.app-portfolio-slide').cycle();
    //$('#slider3').cycle();
    $('#slider-left').cycle();
    $('#slilder-right').cycle();
    $('#awards-slider').cycle();


    $('.main-nav ul.basic-nav > li').hover(function(){
        $('.drop', this).stop(true).slideDown();
    }, function(){
        $('.drop', this).stop(true).filter(':not(:animated)').slideUp(200);
    });
    $('.main-nav-mob > ul > li').click(function(){
        $(this).children('ul').slideToggle('slow');
    });
    $('.toggle').click(function(){
        $(this).siblings('.main-nav-mob').slideToggle('slow');
        if($(this).children('i').hasClass('icon-chevron-down')) {
            $(this).children('i').removeClass('icon-chevron-down').addClass('icon-chevron-up');
        } else {
            $(this).children('i').removeClass('icon-chevron-up').addClass('icon-chevron-down');
        }
    });

    $('.package-boxes-tab a').click(function() {
        if($(this).hasClass('btn-black')) {
            $(this).removeClass('btn-black').addClass('btn-orange').siblings().removeClass('btn-orange').addClass('btn-black');
            if($('.package-box-container > div').hasClass('web')) {
                $('.package-box-container > div').removeClass('web');
                $('.package-tabing-area').hide();
                $('#logo-package').fadeIn('slow');
            } else {
                $('.package-box-container > div').addClass('web');
                $('.package-tabing-area').hide();
                $('#web-package').fadeIn('slow');
            }
        }
    });

    // $('.top-form-straller').click(function() {
    // 	formdrop();
    // });

    $(".packagebtn-bg").click(function() {
        var aTag = $('.christmis-main');
        $(this).toggleClass("up-arrow", 1000);
        //$(window).scrollTop($('.offer-form').offset().top, 2000);
        $('html,body').animate({
            scrollTop: aTag.offset().top
        },'slow');
        formdrop();
    });

    $('.top-form-straller').click(function() {
        formdrop();
    });
    $('.btn-big-start').on('click', function() {
        formdrop();
    });
    $('.overlay-dark').on('click',function() {
        formdrop();
    });
    $('.get-quoted-top').on('click', function() {
        $('html, body').animate({scrollTop: 60}, 700);
        formdrop();
    });

    $('.form-straller').click(function() {
        if($('.formwrapper').hasClass('close')) {
            $('.formwrapper').slideDown('slow','easeOutBounce',function() {}).removeClass('close');
        } else {
            $('.formwrapper').slideUp().addClass('close');
        }
        $('.form-straller span.arrow-down').toggle();
        $('.form-straller span.arrow-up').toggle();
    });



    $('#viewcontent').on('click',function() {
        $('#themore').slideToggle();
        if ($(this).text() == 'Read More +'){ $(this).text('Read Less -'); }
        else {$(this).text('Read More +') }
    });

    $('.webinfi-box').mouseenter(function() {
        $(this).find('.number').shuffleLetters({
            "step"		: 8
        });
    });

    $('.fl-banner').hover(
        function(){
            $(this).stop(1,1).animate({'margin-left': 0}, {duration:300, easing: 'easeInOutExpo'})
            $('.overlay-dark').stop(1,1).fadeIn(300)
        },
        function(){
            $(this).stop(1,1).animate({'margin-left': '-511px'}, {duration:300, easing: 'easeInOutExpo'})
            $('.overlay-dark').stop(1,1).fadeOut(300)
        }
    )

    $(".videopop").on("click", function(){
        $.fancybox({
            href: this.href,
            maxHeight:'450px',
            openEffect : 'elastic',
            closeEffect : 'elastic',
            type: $(this).data("type"
            )
        }); // fancybox
        return false
    });

    $(window).scroll(function(){
        if( $('footer') ){
            var scrollTop = $(window).scrollTop();
            var windowHeight = $(window).height();
            var footerTop = $('footer').offset().top;
            if ( scrollTop >= ( footerTop - windowHeight + 70 ) ){
                $('.backtotop').fadeIn(100, 'easeInOutElastic');
            } else {
                $('.backtotop').fadeOut(0, 'easeInOutElastic');
            }
            if ( scrollTop >= ( footerTop - windowHeight - 32 ) ){
                $('.sticky-chat').slideUp(300);
            } else {
                $('.sticky-chat').slideDown(300);
            }
        }

        $('body').addClass('lazy-sprite');
    });

    $('.backtotop').on('click', function() {
        $('html, body').animate({scrollTop: 0}, 700);
    });

    $("a[data-rel^='prettyPhoto']").prettyPhoto({
        hook: 'data-rel',
        animation_speed:'normal',
        allow_resize: false,
        deeplinking: false,
        overlay_gallery: false,
        social_tools: false
    });

    if($('body').hasClass('portfolio')) {
        $('.portfolio-page:not(:first)').hide();
        if($('.portfolio-page').length > 1) {
            $('.portfolio-page').each(function(index, element) {
                var paginationvalue = index+1;
                if( paginationvalue == 1) {
                    $('.portfolio-pagination').append('<a href="javascript:;" class="active">'+paginationvalue+'</a>');
                } else {
                    $('.portfolio-pagination').append('<a href="javascript:;">'+paginationvalue+'</a>');
                }
            });
        }
    }
    $('.portfolio-pagination a').on('click', function(e) {
        var indexvalue = $('.portfolio-pagination a').index($(this));
        $('.portfolio-page').hide();
        $('.portfolio-page:eq('+indexvalue+')').fadeIn('1000');
        $(this).addClass('active').siblings().removeClass('active');

        var pcElem = $('.portfolio-page').closest('.portfolio-complete');
        var pcElemTop = pcElem.offset().top;
        $('html, body').animate({scrollTop: pcElemTop}, 400);
    });

    /* Customer Reviews page tabing*/
    if($('body').hasClass('reviews')) {
        $('.cr-tables:not(:first)').hide();
    }


    /* Marked on click */
    $('.marksonmap').click(function() {
        $('.marksonmap').removeClass('active');
        $(this).addClass('active');
        $(this).children('.marki-info').fadeToggle(700);
        $(this).siblings().children('.marki-info').fadeOut();
    });

    if($('#imaculate-slide').length > 0) {
        $('#imaculate-slide').cycle();
    }

    $('.reviews-tabs a').on('click', function() {
        var indexvalue = $('.reviews-tabs a').index($(this));
        $('.cr-tables').hide();
        $('.cr-tables:eq('+indexvalue+')').fadeIn('2000');
        $('.reviews-tabs a').removeClass('active');
        $(this).addClass('active');
    });

    $('#poract').change(function() {
        window.location.href= $(this).val();
    });


    var lnk = getParameterByName("active");
    $(".reviews-tabs a[rel="+lnk+"]").trigger("click");

    $('.pkg-accordion').on('click', function() {
        if($(this).hasClass('closed')) {
            $(this).removeClass('closed').addClass('opened');
            $(this).siblings('.accordion-panel').slideDown('slow');
        } else {
            $(this).removeClass('opened').addClass('closed');
            $(this).siblings('.accordion-panel').slideUp('slow');
        }
    });

    setTimeout(function() {
        $('.reload').each(function(index, element) {
            $(this).attr('src', $(this).data('rel'));
        });
    }, 3000);

    function sendReq() {
        $.ajax({
            url: 'http://j.maxmind.com/app/geoip.js',
            type: 'GET',
            success: function(data) {
                var ctrycode1=geoip_country_code(),tgtctry=$('.jform select.countrylist option[data-abbr="'+ctrycode1+'"]');tgtctry.attr('selected','selected');$('.jform input[name="code"]').val('+'+tgtctry.attr('value'));$('.jform input[name="ctry"]').val($('.jform select.countrylist option:selected').html());
                $('.jform select.countrylist[name="ctry"]').each(
                    function(){
                        var cval=$(this).children('option:selected').attr('value');
                        $('form .pc span').attr('class','fg'+cval);
                    })

            },
            error: function(e) {
                console.log('Error:', e);
            },
            contentType: 'application/javascript; charset=ISO-8859-1',
            dataType: 'script'
        });
    }

    /*    $('input').on('focus',function () {
            if(window.blurred == false){
                window.blurred = true;
                sendReq();
            }
        });*/

    $(function(){
        var params = $.deparam.querystring();
        if(params.quote == 'true'){
            $('.top-form-straller').trigger('click');
        }
        if(typeof params.active != "undefined"){
            $('.jform select[name="srv"] option').each(
                function(){
                    var sVal=$(this).val();
                    if( params.active=='logo' && sVal=='Logo Design' ){
                        $(this).attr('selected', 'selected');
                    }
                    if( params.active=='web' && sVal=='Web Design' ){
                        $(this).attr('selected', 'selected');
                    }
                    if( params.active=='webd' && sVal=='Web Development' ){
                        $(this).attr('selected', 'selected');
                    }
                    if( params.active=='apps' && sVal=='Apps & Games' ){
                        $(this).attr('selected', 'selected');
                    }
                })
        }
        if(typeof params.srv != "undefined"){
            $('.jform select[name="srv"] option').each(
                function(){
                    var sVal=$(this).val();
                    if( params.srv == sVal ){
                        $(this).attr('selected', 'selected');
                    }
                })
        }
    });

    $( ".txt-service" ).change(function() {
        if( $( this ).val() == 'Logo Design' ){
            $( "input[name='tpth']" ).val('/logo-design/pricing/');
        }
        if( $( this ).val() == 'Web Design' ){
            $( "input[name='tpth']" ).val('/web-design/pricing/');
        }
    });

    $('.industry-cols h3 .toggle-ind').click(function(){
        if($(this).hasClass('closed')){
            $('.ind-wrap').slideDown()
            $(this).addClass('opened').removeClass('closed')
            //alert($(window).scrollTop()+$('.ind-wrap').outerHeight());
        }
        else{
            $('.ind-wrap').slideUp()
            $(this).addClass('closed').removeClass('opened')
        }
    })


    $('.copywr-toggle').click(function(){
        if($(this).hasClass('closed')){
            $('.copywr-toggle-wrap').slideDown()
            $(this).addClass('opened').removeClass('closed')
            //alert($(window).scrollTop()+$('.ind-wrap').outerHeight());
        }
        else{
            $('.copywr-toggle-wrap').slideUp()
            $(this).addClass('closed').removeClass('opened')
        }
    })


    $('.recent-portfolio .big-slider-container').hover(function(){$(this).find('.project-slider-nav').fadeIn()},function(){$(this).find('.project-slider-nav').hide()});

// Fixed Form
    $('.sidfrmdv .switch').on('click',function(){if($(this).parent().hasClass('active')){$(this).parent().animate({'right':'-550px'});$('.overlay-dark').fadeOut();$(this).parent().removeClass('active');}else{$(this).parent().stop(true,true).animate({'right':'0px'});$('.overlay-dark').stop(true,true).fadeIn();$(this).parent().addClass('active');}});

    $(window).scroll(function(){
        var bodypos = $(window).scrollTop();

// Fixed Form
        if(bodypos>=550){
            if($('.sidfrmdv').attr('data-rel')=='0'){$('.sidfrmdv').animate({'right':'-550px'},1000);$('.sidfrmdv').attr('data-rel','1');}
            $('.fl-banner').fadeIn();
        }
        if(bodypos<=540){
            if($('.sidfrmdv').attr('data-rel')=='1'){$('.sidfrmdv').animate({'right':'-600px'},1000);$('.sidfrmdv').attr('data-rel','0');}
            $('.fl-banner').fadeOut();
        }

    });// Windows Scroll

    $(".wdesign-overview, .ldesign-overview, .popvid").click(function () {
        $.fancybox({
            'padding': 0,
            'autoScale': false,
            'transitionIn': 'none',
            'transitionOut': 'none',
            'title': this.title,
            'width': 680,
            'height': 495,
            'href': this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
            'type': 'swf',
            'swf': {
                'wmode': 'transparent',
                'allowfullscreen': 'true'
            }
        });
        return false;
    });




    //Copy Writing Page Calculator
    $("#calForm").submit(function(){
        var valid = false;
        $('#calForm select').each(function(index, element) {
            if( $(this).val() == '' || $(this).val() == '0' ){
                $(this).addClass('error')
            }
            else{
                $(this).removeClass('error')
            }
        });



        if( $('.CalDeadline').val()!= '' && $('.calservices').val() != '' && $('.NumberPageSelect').val() != '0' ){
            $(".allTotal").text(window.allTotal)

            $(".cdeadCal").html($('.CalDeadline').val());

            $(".ServVal").html($('.calservices').val());

            $(".NpageVal").html($('.NumberPageSelect').find(':selected').data('values'));
            $(".calproceed").fadeTo(1000,1);
        }
        else{
            $('.calproceed').find('a').attr('href', 'javascript:;')
            $(".calproceed").fadeTo(1000,0.5);
            return false
        }



        //Order procede link. Only set link when service, no. of pages and deadline has been selected, else return false above
        var serviceSelected = $('.calservices').val();
        var pagesSelected = $('.NumberPageSelect').val();
        var pkgID;

        if( serviceSelected == 'Web Copywriting'){
            pkgID = '1686';
        }
        else if( serviceSelected == 'SEO Copywriting'){
            pkgID = '1687';
        }
        else if( serviceSelected == 'Creative Writing'){
            pkgID = '1688';
        }
        else if( serviceSelected == 'Press Release Writing'){
            pkgID = '1689';
        }
        else if( serviceSelected == 'Article Writing'){
            pkgID = '1690';
        }

        $('.calproceed').find('a').attr('href', '/webpages/client/ordermanagement/ordersequence/OrderFormRedirector.aspx?pkc='+pkgID+'&pkt=2&np='+pagesSelected )
        return false;
    });



    // Your Product Calculate value

//	$('.calservices').on("change",function(event){
//
//		if($(this).val() == 'Web Copywriting'){
//			$('.calproceed').find('a').attr('href', '/webpages/client/ordermanagement/ordersequence/OrderFormRedirector.aspx?pkc=1678&amp;pkt=2')
//		}
//		else if($(this).val() == 'SEO Copywriting'){
//			$('.calproceed').find('a').attr('href', '/webpages/client/ordermanagement/ordersequence/OrderFormRedirector.aspx?pkc=1679&amp;pkt=2')
//		}
//		else if($(this).val() == 'Creative Writing'){
//			$('.calproceed').find('a').attr('href', '/webpages/client/ordermanagement/ordersequence/OrderFormRedirector.aspx?pkc=1680&amp;pkt=2')
//		}
//	});

    $('.calservices').on("change",function(event){
        var service = $(this).val()
        if(service == 'Press Release Writing' || service == 'Article Writing'){
            $('.metric.quantity').addClass('NumberPageSelect')
            $('.metric.pages').removeClass('NumberPageSelect')
            $('.days.quantity').addClass('CalDeadline')
            $('.days.pages').removeClass('CalDeadline ')
            $('.pgorqtty').text('Quantity')
        }
        else {
            $('.metric.quantity').removeClass('NumberPageSelect')
            $('.metric.pages').addClass('NumberPageSelect')
            $('.days.quantity').removeClass('CalDeadline')
            $('.days.pages').addClass('CalDeadline ')
            $('.pgorqtty').text('Pages')
        }
    });


    //Number oF Page
    $(document).on("change", '.calservices, .NumberPageSelect', function(event){
        var SelectedService =$(".calservices").val();
        var NumberofPages = $(".NumberPageSelect").val();

        if( NumberofPages == 0) {
            window.allTotal = '--';
        }
        else if( SelectedService == "SEO Copywriting"){
            window.allTotal = "$"+NumberofPages*89+".00"
        }
        else if( SelectedService == "Web Copywriting"){
            window.allTotal = "$"+NumberofPages*69+".00"

        } else if( SelectedService == "Creative Writing"){
            window.allTotal = "$"+NumberofPages*69+".00"

        } else if( SelectedService == "Press Release Writing"){
            window.allTotal = "$"+NumberofPages*79+".00"

        } else if( SelectedService == "Article Writing"){
            window.allTotal = "$"+NumberofPages*199+".00"

        } else {
            window.allTotal = "$"+SelectedService*NumberofPages+".00"
        }

        if($(this).val() == '' || $(this).val() == '0'){
            $(this).addClass('error')
        }
        else{
            $(this).removeClass('error')
        }
        //show/hide days options

        if( $('.metric.pages').hasClass('NumberPageSelect') ) { //Set duration for pages

            if( NumberofPages >= 5 && NumberofPages <= 6 ){
                $('.CalDeadline option').each(function(index, element) {
                    $(element).show();
                    if( parseInt( $(element).val()) < 5 ) {
                        $(element).hide();
                    }
                });
            }
            else if( NumberofPages >= 7 && NumberofPages <= 8 ){
                $('.CalDeadline option').each(function(index, element) {
                    $(element).show();
                    if( parseInt( $(element).val()) < 7 ) {
                        $(element).hide();
                    }
                });
            }
            else if( NumberofPages >= 9 && NumberofPages <= 10 ){
                $('.CalDeadline option').each(function(index, element) {
                    $(element).show();
                    if( parseInt( $(element).val()) < 9 ) {
                        $(element).hide();
                    }
                });
            }
            else if( NumberofPages >= 11 && NumberofPages <= 12 ){
                $('.CalDeadline option').each(function(index, element) {
                    $(element).show();
                    if( parseInt( $(element).val()) < 10 ) {
                        $(element).hide();
                    }
                });
            }
            else if( NumberofPages >= 13 ){
                $('.CalDeadline option').each(function(index, element) {
                    $(element).show();
                    if( parseInt( $(element).val()) <= 10 ) {
                        $(element).hide();
                    }
                });
            }

            //$('option.hr48').hide(0);
            if( NumberofPages <= 4 ){
                $('.hr48').prop("disabled", false).css('display','block')
            }
            else{
                $('.hr48').prop("disabled", true).css('display','none')
            }

        } else {//Set duration for quantity
            if( $(this).hasClass('metric') ) {
                var range = $('option:selected', this).data('range')
                $('.CalDeadline option').each(function(index, element) {
                    $(element).prop("disabled", false).show();
                    if( parseInt( $(element).val()) < range ) {
                        $(element).prop("disabled", true).hide();
                    }
                });

                if( range <= 1 ){
                    $('.hr48').prop("disabled", false).css('display','block')
                }
                else{
                    $('.hr48').prop("disabled", true).css('display','none')
                }

            }
        }

    });


    //DeadLine
    $('.CalDeadline').on("change",function(event){

        if($(this).val() == ''){
            $(this).addClass('error')
        }
        else{
            $(this).removeClass('error')
        }
    });

    $('.secondIndex').on('change', function(){
        var vidpkgBtn = $(this).closest('.vidpkg').find('.vidpkglink')
        var vidpkgLink = vidpkgBtn.attr('href')
        vidpkgLink = vidpkgLink.replace('&secondIndex=1', '')
        vidpkgLink = vidpkgLink.replace('&secondIndex=2', '')
        if( $(this).val() == 60 ){
            vidpkgBtn.attr('href', vidpkgLink + '&secondIndex=1' )
        }
        else if( $(this).val() == 90 ){
            vidpkgBtn.attr('href', vidpkgLink + '&secondIndex=2' )
        }
    })

}); // document ready End

function formdrop() {
    if($('.signup').hasClass('close')) {
        $('.signup').slideDown('slow','easeOutBounce',function() {}).removeClass('close');
    } else {
        $('.signup').slideUp().addClass('close');
    }
    $('.main-form-straller-arrow.down').toggle();
    $('.main-form-straller-arrow.up').toggle();
    $('.overlay-dark').fadeToggle('slow');
    if( ($("#contentslider")[0]) && $('body').hasClass('homepage') ){
        var lsdata = $("#contentslider").layerSlider('data');
        if(lsdata['autoSlideshow']) {
            $("#contentslider").layerSlider('stop');
        } else {
            $("#contentslider").layerSlider('start');
        }
    }
}

function getParameterByName( name ){
    name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
    var regexS = "[\\?&]"+name+"=([^&#]*)";

    var regex = new RegExp( regexS );
    // alert (regex);
    var results = regex.exec(window.location);
    if( results == null )
        return "";
    else
        return decodeURIComponent(results[1].replace(/\+/g, " "));
}

//Google Fonts Script
WebFontConfig = {
    google: { families: [ 'Raleway:400,300,500,600,700:latin', 'Open+Sans:400,700:latin' ] }
};
(function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
        '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
})();