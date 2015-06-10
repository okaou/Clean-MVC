<?php

/**
* 
*/
namespace app\models;
use DB\Model;
require_once '../lib/Model.php';

class UserTable extends Model
{
	public function show() {
		$db = $this->connect();
		$lol = $db->prepare('SELECT * FROM user');
		$lol->execute();
		$lol1 = $lol->fetchAll();
		var_dump($lol1);
	}
}
?>