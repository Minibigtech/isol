<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Cart extends CI_Controller {



	

	public function __construct(){

		parent::__construct();

		

		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

		$this->output->set_header('Pragma: no-cache');

		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

		$this->load->model('user_model');	
		/*$this->load->helper('cookie');*/
		/*$this->load->library('cart');*/

		
		$this->db->select('*')->from('administrator');
		$this->db->where('admin_id',$this->session->userdata('logged_admin_id'));
		$sql = $this->db->get();
		$this->admininfo = $sql->row();


		/*

		if( $this->session->userdata('logged_user_id') != '' && $this->session->userdata('logged_user_id') != 0 ):

			echo '<script>window.location.href = "'.base_url().'profile"</script>';

		endif;

		*/

			

	}



	public function generate_ip(){





		if(!empty($_SERVER['HTTP_CLIENT_IP'])){

        			//ip from share internet

        		$ip = $_SERVER['HTTP_CLIENT_IP'];

    			}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){

        		//ip pass from proxy

        		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

    			}else{

        		$ip = $_SERVER['REMOTE_ADDR'];

    			}

    			return $ip;



	}

	public function index()

	{

		

		 

		 //$this->db->select('*');

		 //$this->db->from('cart');



		$this->db->select('cart.*,products.product_photo')->from('cart');

		$this->db->join('products', 'products.product_id = cart.product_id', 'inner');	



		if($this->session->userdata('logged_user_id')):



			$user_id =  $this->session->userdata('logged_user_id') ;

			$this->db->where('cart.user_id',$user_id);

		else:



			$ip = $this->generate_ip();



    		$this->db->where('cart.user_ip',$ip);

			endif;	

		

			$cart 		   = $this->db->get();

			$data['cart']  = $cart->result();	

			$this->load->view('addcart',$data);





	}





	public function add()

	{



			$action    	   = $this->input->post('action');

			$product_id    = $this->input->post('product_id');

			$product_title = $this->input->post('product_title');

			$product_price = $this->input->post('product_price');

			$quantity 	   = $this->input->post('quant');

			$quantity      = implode(",",$quantity);

			//$data =array();



			$ip = $this->generate_ip();			



    		if($action == ''):

   

			if($this->session->userdata('logged_user_id')):



				$user_id = $this->session->userdata('logged_user_id');

				$data =  array(





					'user_id'	          => $user_id,

					'user_ip'             => $ip,

					'product_id'          => $product_id,

					'product_quantity'    => $quantity,

					'product_title'       => $product_title,

					'product_price'       => $product_price,



				);



			else:



				$data =  array(





					'user_ip'             => $ip,

					'product_id'          => $product_id,

					'product_quantity'    => $quantity,

					'product_title'       => $product_title,

					'product_price'       => $product_price,



				);

			endif;	

			

	

			

			$flag = $this->db->insert('cart',$data);



		else:

				

			if($this->session->userdata('logged_user_id')):



				$user_id = $this->session->userdata('logged_user_id');

				$data =  array(





					'user_id'	          => $user_id,

					'user_ip'             => $ip,

					'product_id'          => $product_id,

					'product_quantity'    => $quantity,

					'product_title'       => $product_title,

					'product_price'       => $product_price,



				);



			else:



				$data =  array(





					'user_ip'             => $ip,

					'product_id'          => $product_id,

					'product_quantity'    => $quantity,

					'product_title'       => $product_title,

					'product_price'       => $product_price,



				);

			endif;	







					$this->db->where('product_id',$action);

			$flag = $this->db->update('cart',$data);

		endif;	



			if($flag):

			

			redirect(base_url().'cart');

		

			endif;

	}





	public function delete_item(){





		//$id = $this->uri->segment(3);

		

		$id =  $_POST['data'];





		$this->db->where('id',$id);

		$delete_item = $this->db->delete('cart');

		if($delete_item):



			redirect(base_url().'cart');	



		endif;







	}





	public function save_item(){





		//$id = $this->uri->segment(3);

		

		$id 	  =  $_POST['id'];

		$quantity =  $_POST['quantity'];



		$data = array('product_quantity'=>$quantity);

		$this->db->where('id',$id);

		$save_item  = $this->db->update('cart',$data);	

		if($save_item):



		echo "success";		



		//redirect('/Cart');	



		endif; 	



	}



	public function clear_cart(){









		

		if($this->session->userdata('logged_user_id')):



			$user_id = $this->session->userdata('logged_user_id');

			



			$this->db->where('user_id',$user_id);

			$this->db->select('*')->from('cart');

			$sql   = $this->db->get();

			if($sql->num_rows()>0):

		  			  		  $this->db->where('user_id',$user_id);		

			$cart_deleted	= $this->db->delete('cart');

							  

				

				if($cart_deleted):

						

						echo "Your Card is Cleared Successfuly";



				endif;	

			else:

				

						echo "Your Card is Already Empty";





			endif;	



		



		else:



			$ip = $this->generate_ip();



    		$this->db->where('user_ip',$ip);

			$this->db->select('cart.id')->from('cart');

			$sql   = $this->db->get();

			if($sql->num_rows()>0):



			

				 				 $this->db->where('user_ip',$ip);

				$cart_deleted =	 $this->db->delete('cart');



				if($cart_deleted):



						echo "Your Card is Cleared Successfuly";

				endif;				  



			else:

				

						echo "Your Card is Already Empty"; 	



			endif;	

	

		endif;	





	}

	public function review(){





		

		$product_id 	= 		$this->input->post('product_id');

		$user_id 		= 		$this->input->post('user_id');

		$rate 			=   	$this->input->post('rate');

		$review 		=  		$this->input->post('review');





		$insert_data 	=  array(



							'user_id' 		=>   $user_id,

							'product_id' 	=>   $product_id,

							'ratting' 		=>   $rate,

							'review'		=>   $review,

							'status'		=>	 1						

							);





		$update_data 	=  array(



							'ratting' 			=>   $rate,

							'review'			=>   $review,

							'status'			=>	 1						

							);









		$this->db->where('user_id' , $user_id);

		$this->db->where('product_id' ,$product_id);	

		$this->db->select('*')->from('reviews');

		$sql = $this->db->get();



		if($sql->num_rows()>0):

	

				$this->db->where(array('user_id' => $user_id , 'product_id' => $product_id));

				$this->db->update('reviews',$update_data);

				echo " Your Review is updated Successfuly";



		else:



				$this->db->insert('reviews',$insert_data);				

				echo "Your Review is added Successfuly";

		

		endif;





	} 





	public function admin_view_reviews(){


		if( $this->admininfo->user_type == 'operator' ):
			redirect(base_url('404'));	
			exit();
		endif;


		$this->db->select('reviews.*,users.u_firstname,products.product_title,products.product_photo')->from('reviews');

		$this->db->join('users','reviews.user_id = users.u_id ');

		$this->db->join('products','products.product_id = reviews.product_id ');	

		$this->db->order_by("reviews.review_id", "desc");





		$sql	= $this->db->get();

		$data['reviews'] =$sql->result();



	

		$this->load->view('admin/admin-view-reviews',$data);	



	}





	public function admin_review_status(){

			if( $this->admininfo->user_type == 'operator' ):
				redirect(base_url('404'));	
				exit();
			endif;

			$review_id = $this->input->post('review_id');

			$status    = $this->input->post('status_id');



			$data = array(



					'status'  => $status

				);	

			$this->db->where('review_id',$review_id);

			$updated_status = $this->db->update('reviews',$data);

			if($updated_status)

			{



				echo 'Status is changed Successfuly';	

				//redirect(base_url().'admin/view-reviews');	

			}





	}





	public function admin_review_delete(){
		
		if( $this->admininfo->user_type == 'operator' ):
			redirect(base_url('404'));	
			exit();
		endif;

		$review_id = $this->input->post('review_id');
		$this->db->where('review_id',$review_id);
		$review_delete = $this->db->delete('reviews');
		if($review_delete)
		{
			echo "Record is deleted Successfuly";
		}
	}

	/*Add product to cart*/
	public function add_to_cart(){
		$product_id = $_POST['product_id'];
		$product = $this->db->query('select * from products where product_id = '.$product_id)->row();
		$data = array(
	        'id'      => $product->product_id,
	        'qty'     => 1,
	        'price'   => $product->product_price,
	        'product_photo' => $product->product_photo,
	        'name'    => $product->product_title
		);
		$row_id = $this->cart->insert($data);
		$count  = count($this->cart->contents());
		$data['row_id'] = $row_id;
		$data['count']  = $count;
		echo json_encode($data);
	}

	/*Add product to cart*/
	public function add_to_cart_repair(){
		$product_id = $_POST['product_id'];
		$product = $this->db->query('select * from products where product_id = '.$product_id)->row();
		$product_repair = $this->db->query('select repair_price from products where product_id = '.$product_id)->row()->repair_price;
		$data = array(
	        'id'      => $product->product_id,
	        'qty'     => 1,
	        'price'   => $product_repair,
	        'product_photo' => $product->product_photo,
	        'name'    => $product->product_title
		);
		$row_id = $this->cart->insert($data);
		$count  = count($this->cart->contents());
		$data['row_id'] = $row_id;
		$data['count']  = $count;
		echo json_encode($data);
	}

	/*Delete from cart*/
	public function delete_cart_product(){
		$row_id = $_POST['row_id'];
		$data = array(
	        'rowid'  => $row_id,
	        'qty'    => 0,
		);
		$this->cart->update($data);
		echo json_encode(true);
	}

	/*Buy now cart*/
	public function buy_now_cart(){
		$array = [] ;
		$product_id = $this->uri->segment(3);
		foreach ($this->cart->contents() as $items) {
			$array[] =  $items['id'];

		}
		if(!in_array($product_id, $array)){
			$product = $this->db->query('select * from products where product_id = '.$product_id)->row();
			$product_repair = $this->db->query('select repair_price from products where product_id = '.$product_id)->row()->repair_price;
			$data = array(
		        'id'      => $product->product_id,
		        'qty'     => 1,
		        'price'   => $product->product_price,
		        'product_photo' => $product->product_photo,
		        'name'    => $product->product_title
			);
			$row_id = $this->cart->insert($data);
			$this->load->view('cart');
		}else{
			$this->load->view('cart');
		}
	}

	/*Cart checkout*/
	public function checkout(){
		$this->load->view('cart');
	}

	/*Checkout Stage*/
	public function checkout_stage(){
		$this->load->view('checkout');
	}

	/*Update cart*/
	public function update_cart(){
		$product = $this->db->query('select * from products where product_id = '.$_POST['product_id'])->row();
		$price = $_POST['quantity'] * $product->product_price;
		$data = array(
	        'rowid'  => $_POST['row_id'],
	        'qty'    => $_POST['quantity'],
	        'price'   => $price,
		);
		$this->cart->update($data);
		echo json_encode($price);
	}

	/*thankyou after paypal*/
	public function thankyou(){
		foreach ($this->cart->contents() as $items){
			$data = array(
	        'rowid'  => $_POST['row_id'],
	        'qty'    => 0
		);
		}
		$this->load->view('thank_you');
	}
}

