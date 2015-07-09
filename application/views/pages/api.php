<?php
class Foo {
  protected $mcrypt_cipher = MCRYPT_RIJNDAEL_128;
  protected $mcrypt_mode = MCRYPT_MODE_CBC;

  public function decrypt($key, $iv, $encrypted)
  {
    $iv_utf = mb_convert_encoding($iv, 'UTF-8');
    return mcrypt_decrypt($this->mcrypt_cipher, $key, base64_decode($encrypted), $this->mcrypt_mode, $iv_utf);
  }
}

if ( (isset($_GET['request'])) &&  (isset($_GET['i'])) )
{
	$r=$_GET['request'];
	$i=$_GET['i'];

	$encrypted = base64_decode( $r);

	$sql = "SELECT apikey FROM games WHERE id='".$i."'";
  $result = $this->db->query($sql);

	if (!$result) {
	    echo 'ERROR 500';
	    exit;
	}

	$row = $this->db->mysqli_fetch_row($result);

	$key = $row[0];
	$iv = "1234567890123456";

	$foo = new Foo;
	echo $foo->decrypt($key, $iv, $encrypted);
}
?>
