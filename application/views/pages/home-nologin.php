<style>
#grad1 {
height: 200px;
width:50%;background-color:white;padding:20px
}
</style>

    <center>
<div id="grad1">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">ورود</h3>
            </div>
            <div class="panel-body">
               برای ورود لطفا اطلاعات خود را با دقت وارد کنید
            <br>
<br>




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
		              'class'       => 'form-control',
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
               'class'       => 'form-control',
			  );

			echo form_input($data);
			echo "</td></tr><tr><td><br> ";

		        $data = array(
               'value'       => 'ورود',
                 'class'      => 'btn btn-lg btn-success',
               'type'		  => 'submit'
			  );

			echo form_input($data);



		         ?>
		 	 		</td></tr>
        </table>
        <a href="<?php echo base_url(); ?>index.php/pages/view/register">درخواست حساب کاربری</a>

      </div>

		      
       </div>
       </div>
     </div>
