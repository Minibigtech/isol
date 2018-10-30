<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');





/*Function for getting user email*/

if ( ! function_exists('add_log'))
{	

    function add_log($user_id,$type,$action){

    	$CI =& get_instance();
		$data = array(
            'user_id' => $user_id,
            'type'    => $type,
            'action'  => $action,
            'created_at' => date('d-m-Y')
        );

		$CI->db->insert('log_activities',$data);
	}
}

if ( ! function_exists('send_email'))

{	

    function send_email($from,$to,$subject,$msg){
    	$CI =& get_instance();
        
		/*$config = Array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'ssl://mail.mrcpotencia.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'test@mrcpotencia.com',
		    'smtp_pass' => 'PakistanZindabad',
		    'mailtype'  => 'html', 
            'newline'   => "\r\n",
		    'charset'   => 'iso-8859-1'
		);
        $CI->email->initialize($config);
        $CI->email->from($from);
        $CI->email->to($to);
        $CI->email->subject($subject);
        $CI->email->message($msg);  
        if (!$CI->email->send())
		{
		    var_dump($CI->email->print_debugger());
		    return false;
		}else{
			return true;
		}*/
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <'.$from.'>' . "\r\n";
        
        
        if(mail($to,$subject,$msg,$headers)):
        return true;
        else:
        endif;
	}


}