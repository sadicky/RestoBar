<?php

session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$det_an = new BeanDetailsOperation();
$stock = new BeanStock();
$prod = new BeanProducts();
$acc=new BeanAccounts();
$entre=new BeanEntreProdf();

$prod->select($_POST['prod_id']);
$entre->select($_SESSION['op_entre_pf_id']);

$m_entre=0;

$qt_entre_pf=$_POST['prod_qt'];

if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {

  $det->setProdId($_POST['prod_id']);
  $det->setOpId($_SESSION['op_entre_pf_id']);
  $det->setQuantity($_POST['prod_qt']);
  $det->setAmount($_POST['prod_prix']);
  $det->setDet(false);

  if($det->insert())
  {
     echo ' Enregistrement reussi';

  $m_entre=$_POST['prod_prix']*$_POST['prod_qt'];
  $m_entre += $entre->getAmount();
  $entre->setAmount($m_entre);
  $entre->update($_SESSION['op_entre_pf_id']);

    if(!$stock->existstock($_SESSION['pos'],$_POST['prod_id']))
     {
        $stock->setProdId($_POST['prod_id']);
        $stock->setOpId($_SESSION['op_entre_pf_id']);
        $stock->setQuantity($qt_entre_pf);
        $stock->setUpdateDate(date('Y-m-d h:i'));
        $stock->setPosId($_SESSION['pos']);
        $stock->setDet(true);
        $stock->insert();

     }
     else
     {
       $stock->select($_POST['prod_id'],$_SESSION['pos']);
       $qt=$stock->getQuantity() + $qt_entre_pf;


        $stock->setOpId($_SESSION['op_entre_pf_id']);
        $stock->setQuantity($qt);
        $stock->setUpdateDate(date('Y-m-d h:i'));

        $stock->update($_POST['prod_id'],$_SESSION['pos']);

     }

  }
  else
  {
   echo 'Echec Enregistrement';
  }
  }


 if($_POST["operation"] == "Edit")
 {

  $det->setProdId($_POST['prod_id']);
  $det->setOpId($_SESSION['op_entre_pf_id']);
  $det->setQuantity($_POST['prod_qt']);
  $det->setDetailsId($_POST['entre_pf_id']);
  $det->setAmount($_POST['prod_prix']);
  $det->setDet(false);


      $stock->select($_POST['prod_id'],$_SESSION['pos']);
      $det_an->select($_POST["det_id"]);

      $qty_r=$_POST['prod_qt'] - $det_an->getQuantity();
      $qt=$stock->getQuantity() + $qty_r;


  if($qty_r=='0' and $det_an->getAmount()!=$_POST['prod_prix'])
  {
     $m_entre=(($_POST['prod_qt']*$_POST['prod_prix']) -($det_an->getAmount()*$det_an->getQuantity())) ;
  }
  else
  {
  $m_entre=$_POST['prod_prix']*$qty_r;
  }


  if($qt<0)
  {
    echo 'Quantité insuffisante en stock !';
  }
  elseif($det->update($_POST["entre_pf_id"]))
  {
  $m_entre += $entre->getAmount();
  $entre->setAmount($m_entre);
  $entre->update($_SESSION['op_entre_pf_id']);


      $stock->setOpId($_SESSION['op_entre_pf_id']);
      $stock->setQuantity($qt);
      //$stock->setPosId($_SESSION['pos']);
      $stock->setUpdateDate(date('Y-m-d h:i'));

      $stock->update($_POST['prod_id'],$_SESSION['pos']);

     echo ' Modification reussie ';

  }
  else
  {
   echo 'Echec Modification';
  }
 }
}
else
{
echo "operation existe pas";
}

?>
