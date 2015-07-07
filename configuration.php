<?php
//Database settings

function initdb()
{
  $db_user="root";
  $db_host="localhost";
  $db_pass="";
  $db_name="game";
  mysql_connect($db_host,$db_user,$db_pass);
  mysql_select_db($db_name);
  mysql_query("SET NAMES UTF8");
}
function initcore()
{

  if (isset($_GET['gameid'])) //check if debug
  {
    $gameid=$_GET['gameid'];
  }else{
    $gameid='testgame';
  }
  $modules['gameid']=$gameid;// load game module

}


 ?>
