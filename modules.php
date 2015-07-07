<?php
$game=array(
    "gameid" => "testgame",
    "version" => "1",
);
$modules=array("database");


function startEngines()
{
  initdb();
	initcore();
	listModules();
	loadModules();
	loadGame();
}
function loadModules()
{
  global $modules;
  foreach ($modules as $path) {
    include("modules/$path");
  }
}

function loadGame()
{
  global $game;
  foreach ($game as $k => $v) {
    if ($k=="gameid"){
        include("games/".$v.".php");
      }
  }
}
function listModules()
{
  global $modules;
  $dir = "modules";
  $dh  = opendir($dir);
  $scanned_directory = array_diff(scandir($dir), array('..', '.'));
  $modules=$scanned_directory;

}


 ?>
