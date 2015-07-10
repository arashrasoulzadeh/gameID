<?php

$data = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $command), true); //decode json

  switch ($data['command']) {
  case 'update': //default command for updating scene
      # code...
      $a = array(
              'a' => serialize($_POST),
             'b' => serialize($_POST),
             'c' => serialize($_POST),
         );
         $this->db->insert('arraytrunk', $a);

      echo '{"status":1,"p1color":1,"p2color":1}'; // return update as json based on your default script
      break;
  case 'setparm': //update server (if have permission)
      if ((isset($data['parm-name'])) &&  (isset($data['parm-value']))) {
          echo '{"status":1}';
      } else {
          echo '{"status":0}'; // this line returns as error
      }
    break;
  default:
    # code...
    break;
}
