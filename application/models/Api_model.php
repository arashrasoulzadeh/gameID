<?php
class api_model extends CI_Model {
  public function __construct()
  {
          // Call the CI_Model constructor
          parent::__construct();
  }
  public function exportJsonArray($array)
  {
    echo json_encode($array);
  }

  public function setping($roomid)
  {
    $d = array(
    );
     $this->db->set('lastping','now()',false);
    $this->db->update('rooms', $d,"id = ".$roomid);

  }

}
?>
