<?php

//sleep(1);

$data = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $command), true); //decode json

  switch ($data['command']) {
  case 'update': //default command for updating scene
      # code...


      //echo '{"command":"gameupdate","status":1,"p1color":0,"p2color":1}'; // return update as json based on your default script
      $sql = "SELECT * FROM arraytrunk where game_id = '".$data['game_id']."' AND room_id='".$data['room_id']."'";
      $query = $this->db->query($sql);
      $gameupdate = array('command' => 'gameupdate' ,'status' => '1', 'p1color' => '1','p2color' => '0');

          if ($query->num_rows() == 0) {
              $d = array(
               'room_id' => $data['room_id'] ,
               'game_id' => $data['game_id'],
               'temp' => serialize($gameupdate),
            );

              $this->db->insert('arraytrunk', $d);

              $insert_id = $this->db->insert_id();
              $sql = "SELECT * FROM arraytrunk where id='".$insert_id."'";
              $query = $this->db->query($sql);
              $row = $query->row();
              $trunk = $row->temp;
              $gameupdate = unserialize($trunk);
              $this->api_model->exportJsonArray($gameupdate);
          } else {
              $row = $query->row();
              $trunk = $row->temp;
              $gameupdate = unserialize($trunk);
              $this->api_model->exportJsonArray($gameupdate);
          }
          $this->api_model->setping($data['room_id']);

      break;
        case 'createroom'://create new game room
        $roomid = '1';
        //create trunk
        //create room
        $d = array(
           'game_id' => $data['gameid'] ,
           'creator_id' => $data['player_id'],
           'maxplayers' => $data['max'] - 1,
           'trunkid' => 0,
        );
        $this->db->insert('rooms', $d);
        $room_id = $this->db->insert_id();

        $this->api_model->exportJsonArray(array(
           'command' => 'infoupdate',
           'parm' => 'room_id',
           'status' => '1',
           'playernum' => $data['max']-1,
           'value' => $room_id,
        ));

      break;
  case 'setparm': //update server (if have permission)
      if ((isset($data['parm-name'])) &&  (isset($data['parm-value']))) {
          $sql = "SELECT * FROM arraytrunk where game_id = '".$data['game_id']."' AND room_id='".$data['room_id']."'";
          $query = $this->db->query($sql);

          $gameupdate = array('command' => 'gameupdate' ,'status' => '1', 'p1color' => '1','p2color' => '0');
          $parm = $data['parm-name'];
          $gameupdate[$parm] = $data['parm-value'];
          if ($query->num_rows() >= 1) {
              $d = array(
                 'temp' => serialize($gameupdate),
              );
              $row = $query->row();
              $this->db->where('room_id', $data['room_id']);
              $this->db->update('arraytrunk', $d, 'id = '.$row->id);
              $this->api_model->exportJsonArray(array(
                 'status' => '1',
               ));
              $this->api_model->setping($data['room_id']);
          } else {
              $this->api_model->exportJsonArray(array(
                'status' => '0',
             ));
          }
      } else {
          echo '{"status":0}'; // this line returns as error
      }
    break;
    case 'request_free_room': // request a free room for client
    $sql = "SELECT * FROM rooms where maxplayers  > 0 and game_id ='".$data['gameid']."' and  unix_timestamp(lastping) > unix_timestamp() - 60";
    $query = $this->db->query($sql);
    if ($query->num_rows() >= 1) {
        $row = $query->row();
        $roomid = $row->id;

        $this->api_model->exportJsonArray(array(
       'command' => 'infoupdate',
       'parm' => 'room_id',
       'status' => '1',
       'playernum' => $row->maxplayers-1,
       'value' => $roomid,
    ));
        $d = array(
       'maxplayers' => $row->maxplayers - 1,
    );

        $this->db->update('rooms', $d, 'id = '.$roomid);
        $this->api_model->setping($roomid);

  //  echo '{"command":"infoupdate","parm":"room_id","status":1,"value":"'.$roomid.'"}';
    } else {
          $this->api_model->exportJsonArray(array(
         'command' => 'infoupdate',
         'parm' => 'room_id',
         'status' => '1',
         'value' => 'null',
      ));
    }
    break;
    case 'request_user_id':

      $sql = "SELECT * FROM players where device_id = '".$data['deviceid']."'";
      $query = $this->db->query($sql);

                if ($query->num_rows() == 0) {
                    $d = array(
               'device_id' => $data['deviceid'] ,
               'name' => 'player',
               'email' => 'a@a.com',
            );

                    $this->db->insert('players', $d);

                    $insert_id = $this->db->insert_id();
                    $this->api_model->exportJsonArray(array(
                       'command' => 'infoupdate',
                       'parm' => 'player_id',
                       'status' => '1',
                       'value' => $insert_id,
                    ));
                } else {
                    $row = $query->row();
                    $id = $row->id;
                    $this->api_model->exportJsonArray(array(
                       'command' => 'infoupdate',
                       'parm' => 'player_id',
                       'status' => '1',
                       'value' => $id,
                    ));
                }
      break;
  default:
    # code...
    break;
}
