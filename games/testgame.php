<?php

$jsonstr='{"score":1000,"nickname":"arash","p1color":0,"p2color":1}';
if (isset($_POST['data'])) $jsonstr= $_POST['data'];
$json=json_decode($jsonstr);
$p1=0;$p2=0;
$p1=$json->{"p1color"};
$p2=$json->{"p2color"};


$sql = "update roomplayers SET variable='".$p1."' WHERE playerid=1";
mysql_query($sql);
//echo($sql);
//echo mysql_error();

$p1=getRow("select * from roomplayers WHERE playerid=1")[3];
$p1=getRow("select * from roomplayers WHERE playerid=2")[3];



//$p1=0;
$jsonstr='{"score":1000,"nickname":"arash","p1color":'.$p1.',"p2color":'.$p2.'}';
$json=json_decode($jsonstr);


$jsondec=json_encode($json);
echo $jsondec;
 ?>
