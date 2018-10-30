
jQuery('.sidebar-slider .sidebar ul.nav.nav-pills.nav-stacked li').hover(function() {
    jQuery(this).addClass("active");
    jQuery(this).find('.popup').stop(true, true).fadeIn('slow');
}, function() {
    jQuery(this).removeClass("active");
    jQuery(this).find('.popup').stop(true, true).fadeOut('slow');
});




