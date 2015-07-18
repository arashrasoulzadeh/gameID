


<?php
$id=get_cookie("id");

$sql = "SELECT * FROM games WHERE owner='".$id."'";//load keys from db
$result = $this->db->query($sql);


$gamestotal=$result->num_rows();
 ?>
      <div class="row marketing">
        <div class="col-lg-6">
          <h4>بازی ها</h4>
            <p>شما <?php echo $gamestotal; ?> بازی ثبت شده دارید.</p>


          <h4>کاربران</h4>
          <p>شما مجموعا ۱۲۴۱۲ کاربر ثبت شده دارید.</p>

          <h4>درخواست ها</h4>
          <p>آخرین درخواست از بازی نام بازی در تاریخ تاریخ بوده است.</p>
        </div>

        <div class="col-lg-6">
          <h4>اطلاعات شما</h4>
          <p>نام نام خانوادگی</p>
          <p><a href='<?php echo base_url("index.php/pages/view/logout") ?>'>خروج از اکانت</a></p>

         </div>
      </div>
