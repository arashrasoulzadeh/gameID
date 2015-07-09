<?php

	 
	?>
<html>
	<head>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/master/dist/cdnjs/3.3.1/css/bootstrap-rtl.min.css">
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		 <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Gameid.ir :: Developers Panel</title> 
	</head> 
<body    >
 
	<font face="tahoma">
	 <div class="container"    >
      <div class="header clearfix">
      <a href="<?php echo base_url(); ?>">  <h3 class="text-muted">
	        <img src="http://www.gameid.ir/wp-content/uploads/2015/06/logosite.png" width="32" height="32"><small>
	        بازی شناسه
	        </small>
      </a>
        </h3>
                <nav>
          <ul class="nav nav-pills pull-right">
	          
	          
	          
	          <?php
		          $c1="";
		          $c2="";
		          $c3="";
		          $c4="";
		          $s=uri_string();
		          if ( ($s=="pages/view/games") || ($s=="pages/view/newgame") ){
		          	$c2="active";
		          }else if ($s=="pages/view/docs"){
		          	$c3="active";
		          }else if ($s=="pages/view/credit"){
		          	$c4="active";
		          }else{
			        $c1="active";  
			      }
		          
		          $c="0";
		          
		         $t="تومان   اعتبار";
		        $id=get_cookie("id");
 		        $query = $this->db->query("SELECT SUM(value) as v FROM credit WHERE owner='".$id."'");
 		        $row = $query->row_array();
		        if ($row['v']==null){
		        	$c="";
		        	$t="افزایش اعتبار";
		        }else{
					$row = $query->row_array();
					$c=$row['v'];
			    }
		          ?>
	          
	          
	          
	          
	          
	          
            <li role="presentation" class="<?php echo $c1; ?>"><a href="<?php echo base_url(); ?>">داشبورد</a></li>
            <li role="presentation" class="<?php echo $c2; ?>"><a href="<?php echo base_url(); ?>index.php/pages/view/games">بازی ها</a></li>
            <li role="presentation" class="<?php echo $c3; ?>"><a href="<?php echo base_url(); ?>index.php/pages/view/docs">مستندات</a></li>
            <li role="presentation"  class="<?php echo $c4; ?>"><a href="<?php echo base_url(); ?>index.php/pages/view/credit"> <?php echo $c ?> <?php echo $t; ?> </a></li>
            
          </ul>
        </nav>
			<br><br><br>
      </div>
      <div class="container">
