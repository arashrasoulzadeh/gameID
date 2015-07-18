شما میتوانید با افزایش اعتبار از خدمات ویژه سایت استفاده کنید.
<br><small>
برای افزایش اعتبار از منوی زیر مقدار مورد نظر را انتخاب و بر روی دکمه افزایش اعتبار کلیک کنید.
</small><br><br><br>
	        <?php 
		        $attributes = array('class' => 'form-inline');
		        echo form_open(base_url("index.php/pages/view/factor"),$attributes);
		         ?>
   <div class="form-group">
    <label class="sr-only" for="value">مقدار (in rials)</label>
    <div class="input-group">
      <div class="input-group-addon">مبلغ : </div>
      <?php
	          $data = array(
              'name'        => 'value',
              'id'          => 'value',
              'value'       => '',
              'class'        => 'form-control',
              'placeholder' => '۰',
               'type'       => 'number',
 			  );
			echo form_input($data);

	      ?>
       <div class="input-group-addon">ریال</div>
    </div>
  </div>
  <?php
	  		        $data = array(
               'value'       => 'افزایش اعتبار',
               'class'       => 'btn btn-primary',
              'type'		  => 'submit'
			  );

			echo form_input($data);
			echo form_close();
	      ?>
 <br><br>
 <h5>
 لیست تراکنش های شما : 
 </h5>
 
<?php
	$id=get_cookie("id");
		$query = $this->db->query("SELECT * from credit WHERE owner = '".$id."' ORDER BY ID DESC ");
				if ($query->num_rows()<1)
				{
					echo "شما هیچ بازی ای اضافه نکرده اید.";
				}else{
					?>
					<table class="table table-striped">
					 <thead>
	                <tr>
	                  <th>#</th>
	                  <th>مبلغ پرداختی</th>
	                  <th>تاریخ</th>
	                  <th>مالک</th>
	                </tr>
	              </thead>
	              <tbody>
					<?php
					foreach ($query->result() as $row)
					{
						if ($row->value<0){
							echo "<tr class='danger'>";
						}else{
							echo "<tr class='success'>";	
						}
						echo "<td> $row->id</a></td>";
						echo "<td> $row->value</a></td>";
						echo "<td> $row->time</a></td>";
						echo "<td> $row->owner</a></td>";
	
	 					echo "</tr>";
					}
					echo "</tbody></table>";
					}
					?>