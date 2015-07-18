<?php

 		if ( ( null!=$this->input->post("gamename")) || ( null!=$this->input->post("platform"))  )
		{
			$n=$this->input->post("gamename");
			$p=$this->input->post("platform");
		    $i=get_cookie("id");
		    $k=md5($n.$p.$i);
			if ( ($n!=null ) && ($n!=null ) )
			{
				$sql = "INSERT INTO games VALUES(null,'".$this->db->escape_str($n)."','".$this->db->escape_str($p)."','".$this->db->escape_str($k)."','".$this->db->escape_str($i)."','0')";
				$this->db->query($sql);
				echo "عملیات ثبت بازی انجام شد. لطفا منتظر تایید مدیر بمانید.";
			}else{
				showform("لطفا اطلاعات را کامل وارد کنید.");
			}
		}else{
			showform("");
		}

		function showform($message)
		{

	  $gamename = array(
              'name'        => 'gamename',
              'id'          => 'gamename',
              'value'       => '',
              'maxlength'   => '100',
              'class' =>'form-control',
              'size'        => '50',
			  );









		$attributes = array('class' => 'form-inline');
		echo validation_errors();
		echo form_open('',$attributes);

	$options = array(
	        '1'         => 'اندروید',
	        '2'           => 'پی سی',
	        '3'         => 'وب'
	        	);


	?>

	<?php if ($message!=null) { ?>
	<div class="form-group has-error">

	<small  class="control-label" for="gamename">
<?php echo $message; ?>
	</div>	</small><br><br>
	 <?php } ?>


<table class="" >
	<tr class="form-group">
		<td><label for="gamename">نام بازی : </label></td>
		<td><?php  echo form_input($gamename); ?></td>
		<td><?php ?></td>
	<tr>
		<tr class="form-group">
		<td><label for="gamename">پلت فرم : </label></td>
		<td><?php  echo form_dropdown('platform', $options, 'large','class="form-control" width=120 ');
?></td>
		<td><?php ?><small> نگران نباشید بعدا میتونین پلتفرم های دیگری را هم اضافه کنید.</td>
	<tr>


</table>
	<br><br>
	<?php

		        $data = array(
               'value'       => 'ثبت بازی و شروع ',
              'maxlength'   => '100',
              'size'        => '50',
              'class'      => 'btn btn-lg btn-success',
              'style'       => 'width:50%',
              'type'		  => 'submit'
			  );

			echo form_input($data);

		echo form_close();

		}
?>
