
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="footer-heading">
                        <h3><b>CONTACT INFORMATION</b></h3>
                    </div>
                    <div class="footer-contacts">
                       <ul class="contact-details list-unstyled">
                            <li><i class="fa fa-map-marker"></i> <strong>ADDRESS:</strong> <span>123 Street Name, City, England</span></li>                
                            <li><i class="fa fa-phone"></i> <strong>PHONE:</strong> <span>(123) 456-7890</span></li>                
                            <li><i class="fa fa-envelope"></i> <strong>EMAIL:</strong> <span><a href="mailto:mail@example.com">mail@example.com</a></span></li>   
                            <li><i class="fa fa-clock-o"></i> <strong>WORKING DAYS/HOURS:</strong> <span>Mon - Sun / 9:00 AM - 8:00 PM</span></li>            
                        </ul>
                    </div>
                    <div class="social-icons">
                        <a href="javascript:;" target="_blank" title="Facebook" class="fa fa-facebook"></a>
                        <a href="javascript:;" target="_blank" title="Twitter" class="fa fa-twitter"></a>
                        <a href="javascript:;" target="_blank" title="Linkedin" class="fa fa-linkedin"></a>
                    </div>
                </div>
                <div class="col-md-9">
                     <div class="footer-heading">
                        <h3><b>BE THE FIRST TO KNOW</b></h3>
                    </div>
                    <p>Get all the latest information on Events, Sales and Offers. Sign up for newsletter today.</p>
                    <div class="col-md-12 no-padding">
                        <hr>
                    </div>
                    <div class="col-md-3 footer_box">
                        <div class="footer-heading">
                            <h3><span>QUICK</span> LINKS</h3>
							<hr>
                        </div>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo base_url('user/about-us');?>">About us</a></li>
                            <li><a href="<?php echo base_url('contact-us');?>">Contact us</a></li>
                            <li><a href="<?php echo base_url('user/terms-condition');?>">Terms & Conditions</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 footer_box">
                        <div class="footer-heading">
                            <h3><span>QUIC</span>K LINKS</h3>
							<hr>
                        </div>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo base_url('user/privacy');?>">Privacy Policy</a></li>
                            <li><a href="<?php echo base_url('user/return-exchange');?>">How To Return</a></li>
                            <li><a href="<?php echo base_url('user/how_to_order');?>">How To Order</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 footer_box">
                        <div class="footer-heading">
                            <h3><span>MAIN</span> FEATURES</h3>
							<hr>
                        </div>
                        <ul class="list-unstyled">
                            <li><a href="javascript:;">Super Fast Wordpress Theme</a></li>
                            <li><a href="javascript:;">1st Fully working Ajax Theme</a></li>
                            <li><a href="javascript:;">16 Unique Shop Layouts</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 footer_box">
                        <div class="footer-heading">
                            <h3><span>MAIN</span> FEATURES</h3>
							<hr>
                        </div>
                        <ul class="list-unstyled">
                            <li><a href="javascript:;">Powerful Admin Panel</a></li>
                            <li><a href="javascript:;">Mobile & Retina Optimized</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    <script src="<?php echo base_url('assets/frontend/');?>js/jquery.1.11.1.js"></script>
    <script src="<?php echo base_url('assets/frontend/');?>js/bootstrap.js"></script>
    <script src="<?php echo base_url('assets/frontend/');?>js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url('assets/frontend/');?>js/plugins.js"></script>
    <script src="<?php echo base_url('assets/frontend/');?>js/aos.js"></script>
    <script src="<?php echo base_url('assets/frontend/');?>js/main.js"></script>
    <script src="<?php echo base_url('assets/frontend/');?>js/jquery.animateSlider.js"></script>
    <script src="<?php echo base_url('assets/');?>jquery-ui.js"></script>
    <script src="<?php echo base_url('assets/frontend/');?>js/modernizr.js"></script>
	
	
	<script>
	
	$(document).ready(function(e){
    $('.search-panel .dropdown-menu').find('a').click(function(e) {
		e.preventDefault();
		var param = $(this).attr("href").replace("#","");
		var concept = $(this).text();
		$('.search-panel span#search_concept').text(concept);
		$('.input-group #search_param').val(param);
	});
});
	
	
	</script>
	
	
	
	
	
	
	
	
     <?php require_once('js.php');?>