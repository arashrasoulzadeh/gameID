      <div class="jumbotron">
        <h2>سرویس بازی شناسه</h2>
        <p class="lead"><small>توسط این سرویس به راحتی میتوانید برای بازی خود سیستم امتیاز درست کنید و کد آماده را دریافت و وارد پروژه کنید. نگران نباشید. این سرویس امن است.</p></small>
        <p>
	        
	        
	        
	        
	        
	<?php
		
		if ( ( null!=$this->input->post("username")) && ( null!=$this->input->post("password")) )
		{
			$u=$this->input->post("username");
			$p=$this->input->post("password");
			
			$query = $this->db->query("SELECT * FROM user WHERE email = '".$u."' ");
	
			foreach ($query->result() as $row)
			{
			        if ( md5($p) == $row->password)
			        {
				        //login correct,set cockie
				        $cookie = array(
						    'name'   => 'username',
						    'value'  => $u,
						    'expire' => '86500'
						);
				        $cookie1 = array(
						    'name'   => 'password',
						    'value'  => sha1(md5($p)),
						    'expire' => '86500'
						);
				        $cookie2 = array(
						    'name'   => 'name',
						    'value'  => $row->name,
						    'expire' => '86500'
						);
				        $cookie3 = array(
						    'name'   => 'id',
						    'value'  => $row->id,
						    'expire' => '86500'
						);
						$this->input->set_cookie($cookie);
						$this->input->set_cookie($cookie1);
						$this->input->set_cookie($cookie2);
						$this->input->set_cookie($cookie3);

						header("location: ".base_url());
			        }else{
				        //login invalid, show message
				        ?>
				        <div class="alert alert-danger" role="alert">
						<strong>نام کاربری</strong> و یا <strong>کلمه عبور </strong> اشتباه است.
						</div>
				        <?php
			        }
			}
		}
 
	?>
	        
	        
	        
	        <?php echo form_open(''); ?>
	        
	        
 	        <table> 
	 	 		<tr>       
		 	 		<td>
	        <?php 
		        echo form_label(' رایانامه شما : ', 'username');
				echo "</td><td> ";
				       $data = array(
		              'name'        => 'username',
		              'id'          => 'username',
		              'value'       => '',
		              'maxlength'   => '100',
		              'size'        => '50',
		              'type'       => 'email',
		              'style'       => 'width:50%',
					  );
				echo form_input($data);
				echo "</td></tr><tr><td> ";

		        echo form_label(' کلمه عبور : ', 'password');
				echo("</td><td>");
		        $data = array(
              'name'        => 'password',
              'id'          => 'password',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '50',
               'type'       => 'password',
              'style'       => 'width:50%',
			  );

			echo form_input($data);
			echo "</td></tr><tr><td> ";

		        $data = array(
               'value'       => 'ورود',
                 'class'      => 'btn btn-lg btn-success',
               'type'		  => 'submit'
			  );

			echo form_input($data);

		        
		        
		         ?>
		 	 		</td></tr>
 	        </table>
		         <br><br>
       </div>