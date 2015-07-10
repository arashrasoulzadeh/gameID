<script>
	$(document).ready(function(){

			$( "#removesure" ).fadeOut(0);
			$( "#removenotsure" ).fadeOut(0);



			$( "#remove" ).click(function() {
			  $( "#remove" ).fadeOut( "fast", function() {
				  $( "#removesure" ).fadeIn( "fast", function() {
				 $( "#removenotsure" ).fadeIn( "fast", function() {

				    // Animation complete
				  });

				    // Animation complete
				  });
			    // Animation complete
			  });
			});



				$( "#removenotsure" ).click(function() {
			  $( "#removenotsure" ).fadeOut( "fast", function() {
					 $( "#removesure" ).fadeOut( "fast", function() {
							$( "#remove" ).fadeIn( "fast", function() {

						    // Animation complete
						  });

					    // Animation complete
					  });

			    // Animation complete
			  });
			});

			$( "#removesure" ).click(function() {

			});



	});
</script>
<?php
	if (null!=$this->input->get("p"))
	{
		$id=get_cookie("id");
		$p=$this->input->get("p");
		$query = $this->db->query("SELECT * from games WHERE id='".$p."' AND owner = '".$id."' ");
        $row = $query->row_array();
		$apitext = "test";
		echo "<h3>".$row['name']."</h3> ";
		echo "کلید دسترسی : <br><input class='form-control' readonly=readonly value='".$row['apikey']."'>";
		echo "شما توسط این کلید میتوانید به سرور بازی شناسه وصل شوید.";
		if (isset($showapi))
		{
		echo "<br><br>فایل api شما:<br>";
 		echo "<textarea style='width:100%;height:40%;direction:ltr'>";
		echo $apitext;
		echo "</textarea>";
		echo "<a href='?down=api'>دانلود</a><br><br>";
		}
		echo "<Br><Br><button type='button' id='remove' class='btn btn-danger'>حذف</button> ";
		echo "<button type='button' id='removesure'   class='btn btn-danger'>بله !‌ اطمینان دارم.</button> ";
		echo "<button type='button' id='removenotsure'   class='btn btn-info'>انصراف</button> ";

	}else{
		echo "<a href='".base_url("index.php/pages/view/newgame")."' class='btn btn-lg btn-success'>بازی جدید</a><br><br>";
		$id=get_cookie("id");
		$query = $this->db->query("SELECT * from games WHERE owner = '".$id."' ");
				if ($query->num_rows()<1)
				{
					echo "شما هیچ بازی ای اضافه نکرده اید.";
				}else{
					?>
					<table class="table table-striped">
					 <thead>
	                <tr>
	                  <th>#</th>
	                  <th>نام</th>
	                  <th>پلت فرم</th>
	                  <th>مالک</th>
	                </tr>
	              </thead>
	              <tbody>
					<?php
					foreach ($query->result() as $row)
					{
						if ($row->verified=='1')
						{
							echo "<tr>";
							echo "<td><a href='?p=$row->id'>$row->id</a></td>";
							echo "<td><a href='?p=$row->id'>$row->name</a></td>";
							echo "<td> $row->platform</a></td>";
							echo "<td> $row->owner</a></td>";
						}else{
							echo "<tr>";
							echo "<td>$row->id</td>";
							echo "<td>$row->name - منتظر تایید</td>";
							echo "<td> $row->platform</a></td>";
							echo "<td> $row->owner</a></td>";
						}
	 					echo "</tr>";
					}
					echo "</tbody></table>";
				}
	}

	?>
