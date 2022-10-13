<?php require_once("dbconnect.php"); 
class crud extends dbconnect { 

public function __construct() { $this->initDB();
 }
 /*Table Person*/
 public function getListPerson(){
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("select * from person");
 $stmt->execute();
 $stat[0] = true;
 $stat[1] = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 $stat[0] = false;
 $stat[1] = $ex;
 return $stat;
 }
 }
 
 public function getPerson($id_person){
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("select * from person where id_person = :id ");
 $stmt->bindParam("id",$id_person);
 $stmt->execute();
 $stat[0] = true;
 $stat[1] = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 $stat[0] = false;
 $stat[1] = $ex;
 return $stat;
 }
 }
 
 public function updatePerson($id_person,$name_person,$gender,$country)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("UPDATE person SET name_person = :name ,gender = :gender,country = :country WHERE id_person = :id");
 $stmt->bindParam("id",$id_person);
 $stmt->bindParam("name",$name_person);
 $stmt->bindParam("gender",$gender); 
 $stmt->bindParam("country",$country);
 $stmt->execute();
 $stat[0] = true;
 $stat[1] = "Update Successfully";
 return $stat;
 }
 catch(PDOException $ex)
 {
 $stat[0] = false;
 $stat[1] = $ex;
 return $stat;
 }
 }
 
 public function savePerson($name_person,$gender,$country){
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("INSERT INTO person(name_person,gender,country) VALUES(:name,:gender,:country)");
 $stmt->bindParam("name",$name_person);
 $stmt->bindParam("gender",$gender);
 $stmt->bindParam("country",$country);
 $stmt->execute();
 $stat[0] = true;
 $stat[1] = "Save Successfully";
 return $stat;
 }
 catch(PDOException $ex)
 {
 $stat[0] = false;
 $stat[1] = $ex;
 return $stat;
 }
 }
 
 public function deletePerson($id_person)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("DELETE from person WHERE id_person = :id");
 $stmt->bindParam("id",$id_person);
 
 $stmt->execute();
 $stat[0] = true;
 $stat[1] = "Delete Successfully";
 return $stat;
 }
 catch(PDOException $ex)
 {
 $stat[0] = false;
 $stat[1] = $ex;
 return $stat;
 }
 }
 
 public function GetPersonByName($term)
 {
 $trm = "%".$term."%";
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("select * from person where name_person like :term order by name_person asc");
 $stmt->bindParam("term",$trm);
 $stmt->execute();
 $stat[0] = true;
 $stat[1] = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 $stat[0] = false;
 $stat[1] = $ex;
 return $stat;
 }
 }
 public function emptyTablePerson()
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("truncate table person");
 $stmt->execute();
 $stat[0] = true;
 $stat[1] = "Delete Successfully";
 return $stat;
 }
 catch(PDOException $ex)
 {
 $stat[0] = false;
 $stat[1] = $ex;
 return $stat;
 }
 }
 
 /*******************************************************************************
 END OF TABEL Person
 *******************************************************************************/
}
?>