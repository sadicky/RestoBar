<?php
class dbconnect {
public $dbase;
public function initDB() {
	$this->dbase = new PDO("mysql:host=localhost;dbname=db_my_hotel;charset=latin1","root","",array(PDO::ATTR_PERSISTENT => true));
 $this->dbase->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 }
}
?>
