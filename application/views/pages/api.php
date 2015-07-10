<?php

class Foo
{
    protected $mcrypt_cipher = MCRYPT_RIJNDAEL_256;
    protected $mcrypt_mode = MCRYPT_MODE_ECB;

    public function decrypt($key, $iv, $encrypted)
    {
        $iv_utf = mb_convert_encoding($iv, 'UTF-8');

        return mcrypt_decrypt($this->mcrypt_cipher, $key, base64_decode($encrypted), $this->mcrypt_mode, $iv_utf);
    }



}

if ((isset($_POST['request'])) &&  (isset($_POST['i']))) {
    // check if arguments supplied
    $r = $_POST['request'];
    $i = $_POST['i'];

    $encrypted = $r;

    $sql = "SELECT apikey FROM games WHERE id='".$i."'";//load keys from db
  $result = $this->db->query($sql);

    $row = $result->row();

    $key = $row->apikey;
    $iv = '1234567890123456';//apply IV


    $foo = new Foo();
    $cmd = $foo->decrypt($key, $iv, $encrypted); //decrypt command
  //this is for test porpuse
  $this->load->view('games/1.php', array('command' => $cmd,'driver'=>$foo));
}
