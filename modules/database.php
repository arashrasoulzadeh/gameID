<?php
function getRow($sql)
{
  $result = mysql_query($sql);
  $row = mysql_fetch_row($result);
  return $row;
} ?>
