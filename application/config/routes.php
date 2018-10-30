 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['preview/(:any)/(:any)'] = 'products/view_product';
$route['categories/(:any)'] = 	'products/categories';
$route['products/(:any)/(:any)|products/(:any)/(:any)/(:any)'] = 'products';
$route['search-product'] = 'home/search_products';

//$route['(:any)|(:any)/[0-9]+'] = 'products/categories_products';




/** Administrator routes **/
$route['admin'] = 'welcome_admin';
$route['admin/login'] = 'admin_login';
$route['admin/dashboard'] = 'admin_dashboard';

$route['admin/users'] 	  			  = 'admin_users';
$route['admin/user-status'] 	      = 'admin_users/user_status';
$route['admin/user-delete'] 	  	  = 'admin_users/delete_user';



$route['admin/level1'] = 'admin_categories/level1';
$route['admin/edit-level1/[0-9]+'] = 'admin_categories/edit_level1';
$route['admin/update-level1'] = 'admin_categories/update_level1';
$route['admin/add-level1'] = 'admin_categories/add_level1';
$route['admin/add-level1-list'] = 'admin_categories/add_level1_list';

$route['admin/level2'] = 'admin_categories/level2';
$route['admin/edit-level2/[0-9]+'] = 'admin_categories/edit_level2';
$route['admin/update-level2'] = 'admin_categories/update_level2';
$route['admin/add-level2'] = 'admin_categories/add_level2';
$route['admin/add-level2-list'] = 'admin_categories/add_level2_list';


$route['admin/level3'] = 'admin_categories/level3';
$route['admin/edit-level3/[0-9]+'] = 'admin_categories/edit_level3';
$route['admin/update-level3'] = 'admin_categories/update_level3';
$route['admin/add-level3'] = 'admin_categories/add_level3';
$route['admin/add-level3-list'] = 'admin_categories/add_level3_list';


$route['admin/products'] = 'admin_products/products';
$route['admin/edit-product/[0-9]+'] = 'admin_products/edit_product';
$route['admin/update-product'] = 'admin_products/update_product';
$route['admin/add-product'] = 'admin_products/add_product';
$route['admin/add-product-list'] = 'admin_products/add_product_list';


$route['admin/product-attributes'] = 'admin_products/product_attributes';
$route['admin/edit-product-attribute/[0-9]+'] = 'admin_products/edit_product_attribute';
$route['admin/update-product-attribute'] = 'admin_products/update_product_attribute';
$route['admin/add-product-attribute'] = 'admin_products/add_product_attribute';
$route['admin/add-product-attribute-list'] = 'admin_products/add_product_attribute_list';

$route['admin/product-variations'] = 'admin_products/product_variations';
$route['admin/edit-product-variation/[0-9]+'] = 'admin_products/edit_product_variation';
$route['admin/update-product-variation'] = 'admin_products/update_product_variation';
$route['admin/add-product-variation'] = 'admin_products/add_product_variation';
$route['admin/add-product-variation-list'] = 'admin_products/add_product_variation_list';

$route['admin/home-slides'] = 'admin_banners/home_slides';
$route['admin/edit-home-slide/[0-9]+'] = 'admin_banners/edit_home_slide';
$route['admin/update-home-slide'] = 'admin_banners/update_home_slide';
$route['admin/add-home-slide'] = 'admin_banners/add_home_slide';
$route['admin/add-home-slide-list'] = 'admin_banners/add_home_slide_list';

$route['admin/home-banners'] = 'admin_banners/home_banners';
$route['admin/edit-home-banner/[0-9]+'] = 'admin_banners/edit_home_banner';
$route['admin/update-home-banner'] = 'admin_banners/update_home_banner';
$route['admin/add-home-banner'] = 'admin_banners/add_home_banner';
$route['admin/add-home-banner-list'] = 'admin_banners/add_home_banner_list';

/***********************Video Start***********************************/	
$route['admin/add_video'] = 'admin_actions/add_video';
$route['admin/insert_video'] = 'admin_actions/insert_video';
$route['admin/list_video'] = 'admin_actions/list_video';
$route['admin/edit_video/:num'] = 'admin_actions/edit_video';
$route['admin/update_video'] = 'admin_actions/update_video';
$route['admin/active_video/:num'] = 'admin_actions/active_video';
$route['admin/deactive_video/:num'] = 'admin_actions/deactive_video';
$route['admin/deletemultiple_videos'] = 'admin_actions/deletemultiple_videos';
$route['admin/delete_video/:num'] = 'admin_actions/delete_video';
/***********************Video END***********************************/	



/*Logs*/
$route['admin/logs'] = 'admin_actions/view_logs';


$route['admin/deals'] = 'admin_banners/deals';
$route['admin/edit-deal/[0-9]+'] = 'admin_banners/edit_deal';
$route['admin/update-deal'] = 'admin_banners/update_deal';
$route['admin/add-deal'] = 'admin_banners/add_deal';
$route['admin/add-deal-list'] = 'admin_banners/add_deal_list';

/*Operator Section*/
$route['admin/add-operator'] = 'admin_banners/add_operator';
$route['admin/insert-operator'] = 'admin_banners/insert_operator';
$route['admin/list-operator'] = 'admin_banners/list_operator';


/*****Quotation******/
$route['admin/view_quotes'] = 'admin_actions/view_quotes';


/*Wishlist*/
$route['admin/my-wishlist'] = 'checkout/my_wishlist';

/* All Admin Ajax Requests */

$route['admin/get-level2'] 				= 'admin_categories/get_category_level2';	
$route['admin/delete-gallery-item'] 	= 'admin_products/delete_gallery_photo';
$route['admin/delete-category-media'] 	= 'admin_categories/delete_category_images';



/* /All Admin Ajax Requests */

$route['admin/logout'] = 'admin_login/logout';



	/* 	ROUTES FOR USER	*/

	//$route['user/delete-item/(:any)']='cart/delete_item';
	  
	 	
	 $route['user/sign-in']        = 'home/signin';	
	 $route['user/sign-up']        = 'home/signup';	
	 $route['user/login']          = 'home/login';	
	 $route['user/create-account'] = 'home/create_account';	
	 $route['user/log-out']        = 'home/logout';	
	 $route['my_account'] 		   = 'my_account';	
	 $route['user/profile-edit']   = 'home/profile_edit';	
	
	 



	/* End Routes for User */


	/*  Routes for Cart */


	$route['user/delete-item']    = 'cart/delete_item';
	$route['user/save-item']      = 'cart/save_item';
	$route['user/clear-cart']     = 'cart/clear_cart';
	$route['user/order-submit']   = 'checkout/order_submit';
	//$route['user/user-view-orders']    = 'checkout/user_view_orders';	

	$route['user/dashboard']      = 'checkout/user_view_orders';	
	$route['user/my-orders']      = 'checkout/my_orders';

	/****************************Profile************************/
	$route['user/edit-profile']      = 'checkout/edit_profile';	
	$route['user/update-user']      = 'checkout/update_profile';
	$route['user/address-book']      = 'checkout/address_book';	
	$route['user/address-change']      = 'checkout/address_change';	
	/****************************Profile************************/
	
	/*Return Exchange*/
	$route['user/return-exchange'] = 'home/return_exchange';
	$route['user/add-return-exchange'] = 'home/add_return_exchange';
	$route['admin/view-return-exhcange'] = 'home/view_return_exchange';



	/*End Profile*/
	$route['user/user-view-billing-details'] = 'checkout/user_view_billing_details';
	$route['user/user-view-order-details'] = 'checkout/user_view_order_details';

	/*View stock request*/
	$route['admin/view-stock_request'] = 'admin_actions/view_stock_request';
	$route['admin/comment_product'] = 'admin_actions/comment_product';

	/*View return/exchange request*/
	$route['admin/view-return-form-request'] = 'admin_actions/view_return_form_request';

	/**********Reporting************/
	$route['admin/view-order-report'] = 'admin_actions/view_order_report';
	$route['admin/generate-order-report'] = 'admin_actions/generate_order_report';
	$route['admin/view-person-upload-report'] = 'admin_actions/view_person_upload_report';
	$route['admin/generate-order-report-person'] = 'admin_actions/generate_order_report_person';


	


	$route['admin/view-orders']                        = 'checkout/admin_view_orders';		
	$route['admin/admin-view-billing-details/(:any)']  = 'checkout/admin_view_billing_details';
	$route['admin/admin-view-order-details/(:any)']    = 'checkout/admin_view_order_details';


	$route['admin/view-reviews']                       = 'cart/admin_view_reviews';	
	$route['admin/review-status']                      = 'cart/admin_review_status';	
	$route['admin/review-delete']                      = 'cart/admin_review_delete';


	$route['User_Authentication']                       = 'user_authentication';	

	
	
	/**************************************SEARCH*************************/
	$route['user/search']                           = 'home/search';
	$route['user/search/:num']                      = 'home/search';
	$route['user/search-filter']                    = 'home/search_filter';
	$route['user/search_by_category/:num']          = 'home/search_by_category';
	/*$route['user/search-page/:num']               = 'home/search_page';*/
    $route['user/about-us']                         = 'home/about_us';
    $route['user/terms-condition']                  = 'home/terms_condition';
    $route['user/privacy']                          = 'home/privacy';
    $route['user/how_to_return']                    = 'home/how_to_return';
    $route['user/how_to_order']                    = 'home/how_to_order';
	
		

	
	$route['user/forget-password']                    = 'home/forget_password';	


	// $route['admin/add-terms-conditions']			  = 'home/add_terms_conditions';
	// $route['admin/admin-view-terms-conditions']		  = 'home/admin_view_terms_conditions';



	$route['admin/edit/(:any)']                       = 'home/pages';		
	
	$route['admin/update-page/(:any)']                = 'home/update_page';
		


	$route['terms-and-condition'] 					  = 'home/terms_condition';
    $route['return-and-exchange'] 			  		  = 'home/return_and_exchange';
    $route['sell-with-us'] 			  		  		  = 'home/sell_with_us';
	$route['contact-us'] 			  				  = 'home/contact_us';






	// $route['get-featured-place'] 				      = 'home/get_featured_place';
	// $route['get-banner-place'] 						  = 'home/get_banner_place';

	//$route['contact'] = 'home/contact';







	//$route['admin/order-status']= 'checkout/order_status';





	$route['user/get-by-reference'] = 'home/get_by_reference';
	/* End  Routes for Cart */

	/*************CART*********/
	$route['user/add-to-cart'] = 'cart/add_to_cart';	
	$route['user/delete-cart-product'] = 'cart/delete_cart_product';	
	$route['user/add-to-cart-repair'] = 'cart/add_to_cart_repair';	
	/**/

	/*********Add to wishlist**********/
	$route['user/add-to-wislist/:num'] = 'home/add_to_wishlist';
	$route['user/remove_from_wishlist/:num'] = 'home/remove_from_wishlist';
	$route['user/remove_from_wishlist_profile/:num'] = 'home/remove_from_wishlist_profile';
	/***/         

	/*******************Quotation Work****************/
	$route['user/add-quotation'] = 'home/add_quotation';
	$route['user/my-quotation'] = 'home/my_quotation';

	/*******************Buy Product****************/
	$route['user/buy-now/:num'] = 'cart/buy_now_cart';
	$route['user/buy-product'] = 'home/buy_product';
	$route['user/checkout'] = 'cart/checkout';
	$route['user/checkout_stage'] = 'cart/checkout_stage';
	$route['user/update-cart'] = 'cart/update_cart';
	$route['user/payment-success'] = 'cart/thankyou';

	/*****************Rquest For Stock************/
	$route['user/request-stock'] = 'home/request_stock';

	$route['404_override'] = '';
	$route['translate_uri_dashes'] = TRUE;
