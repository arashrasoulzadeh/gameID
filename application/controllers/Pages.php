<?php
class Pages extends CI_Controller {
        public function view($page = 'home')
        {
	        $this->load->database();
	        if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
	        {
	                // Whoops, we don't have a page for that!
	               die( "<center><font face=tahoma><div dir=rtl>صفحه مورد نظر پیدا نشد.");
	        }
			if ($page=="api")
			{
				$data['title'] = ucfirst($page); // Capitalize the first letter
				$this->load->view('pages/'.$page, $data);
				return ;
			}
	        $data['title'] = ucfirst($page); // Capitalize the first letter
	
	        $this->load->view('templates/header', $data);
	        if ( ( null!= get_cookie("username")) &&( null!= get_cookie("password")) &&( null!= get_cookie("name")) &&( null!= get_cookie("id"))    )
	        {
		        $u=get_cookie("username");
		        $p=get_cookie("password");
		        $query = $this->db->query("SELECT * FROM user WHERE email = '".$u."'  AND sha1(password)='".$p."'");
		        
		        if ($query->num_rows()<1)
		        	delete_cookie("username");
		        
		        
		        
		        
		        $this->load->view('pages/'.$page, $data);

	        }else{
		        $this->load->view('pages/home-nologin', $data);
	        }
	        $this->load->view('templates/footer', $data);

        }
}