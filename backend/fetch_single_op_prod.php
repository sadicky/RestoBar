<?php

require_once '../load_model.php';
$prod = new BeanProducts();
$det=new BeanDetailsOperation();

$prod->select($_POST["prod_id"]);

$output = array();
if(isset($_POST["prod_id"]))
{

  $last=$det->select_last_id_by_prod('Approvisionnement',$_POST["prod_id"]);


  $det_id=$last['last_id'];
  $det->select($det_id);

  if(empty($det->getAmount()))
  {
   $output["benef"]=0;
   $output["prod_prix"] =0;
  }
  else
  {
  $output["benef"] =round((($prod->getProdPrice()-$det->getAmount())/$det->getAmount())*100);
  $output["prod_prix"] =$det->getAmount();
  }

  $output["prod_prix_v"] =$prod->getProdPrice();
  $output["prod_code"] = $prod->getProdCode();
  $output["qt_min"] = $prod->getQtMin();
  $output["is_sale"] = '';
  $output["is_stock"] = '';
 
  
}

$output['id'] = $_POST["prod_id"];

echo json_encode($output);


?>
