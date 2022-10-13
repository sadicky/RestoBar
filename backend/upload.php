<?php
@session_start();
require_once '../load_model.php';

$pers = new BeanPersonne();

//upload.php
if($_FILES["file"]["name"] != '')
{
 $test = explode('.', $_FILES["file"]["name"]);
 $ext = end($test);
 $name = rand(10, 999999999) . '.' . $ext;
 $location = '../upload/' . $name;
 move_uploaded_file($_FILES["file"]["tmp_name"], $location);

 $pers->update_one($_POST['id_ut'],'personne_id','photo',$name);
 /*$statement = $connection->prepare(
   "UPDATE tb_utilisateur SET  `photo_ut`=? WHERE id_ut = ?
   "
  );
  $result = $statement->execute(
   array(
    $location,$_POST["id_ut"]
   ));*/

 echo '<img src="upload/'.$name.'" height="150" width="150" class="img-thumbnail" alt="'.$location.'" />';
}

?>
