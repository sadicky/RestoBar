<?php

session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$op = new BeanOperation();
$det_an = new BeanDetailsOperation();
$stock = new BeanStock();
$prod = new BeanProducts();
$prod2 = new BeanProducts();
$perso=new BeanPersonne();
$pr=new BeanPrice();
$acc=new BeanAccounts();
$vente=new BeanVente();

$msg="xxxxx";

$vente->select($_SESSION['op_vente_id']);

$m_vente=0;

$prod->select($_POST['prod_id']);
$op->select($_POST['op_vente_id']);
$perso->select($vente->getAssId());
$price=0;
if($prod->getProdEquiv()!='0')
                            {

$prod2->select($prod->getProdEquiv());
$pr->select_2($prod2->getProdId(),$vente->getAssId());
$price=$_POST['prod_prix']-($pr->getPrice()*($_POST['percent']/100));
}
                            else
                            {
                             $price=$_POST['prod_prix']-($_POST['prod_prix']*($_POST['percent']/100));
                            }

if(isset($_POST["operation"]))
{
  $prod->select($_POST['prod_id']);
  $stock->select_by_lot($_POST['num_lot'],$_SESSION['pos']);
 if($_POST["operation"] == "Add")
 {

  $det->setProdId($_POST['prod_id']);
  $det->setOpId($_SESSION['op_vente_id']);
  $det->setQuantity($_POST['prod_qt']);
  $det->setAmount($price);
  $det->setDateExp($_POST['date_exp']);
  $det->setNumLot($_POST['num_lot']);
  $det->setPercent($_POST['percent']);

  if($stock->getQuantity()<$_POST['prod_qt'])
 {
  $msg='Quantité insuffisante en stock ';
 }
  elseif($det->insert())
  {
     $msg=' Enregistrement reussi';

     $m_vente=$price*$_POST['prod_qt'];

  $m_vente += $vente->getAmount();
  $vente->setAmount($m_vente);
  $vente->update($_SESSION['op_vente_id']);

      $stock->select_by_lot($_POST['num_lot'],$_SESSION['pos']);
      $qt=$stock->getQuantity() - $_POST['prod_qt'];

      $stock->setOpId($_SESSION['op_vente_id']);
      $stock->setQuantity($qt);
      $stock->setUpdateDate(date('Y-m-d h:i'));

      $stock->update($_POST['num_lot'],$_SESSION['pos']);


  }
  else
  {
   $msg='Echec Enregistrement';
  }
  }
  elseif($_POST["operation"] == "Edit")
 {

  $det->setProdId($_POST['prod_id']);
  $det->setOpId($_SESSION['op_vente_id']);
  $det->setQuantity($_POST['prod_qt']);
  $det->setDetailsId($_POST['vente_id']);
  $det->setAmount($_POST['prod_prix']);
  $det->setDateExp($_POST['date_exp']);
  $det->setNumLot($_POST['num_lot']);
  $det->setPercent($_POST['percent']);

      $stock->select_by_lot($_POST['num_lot'],$_SESSION['pos']);
      $det_an->select($_POST["vente_id"]);

      $qty_r=$_POST['prod_qt'] - $det_an->getQuantity();


  if($_POST['prod_qt']>$det_an->getQuantity())
  {
  $qt=$stock->getQuantity() - $qty_r;
  }
  else
  {
   $qt=$stock->getQuantity() + (-$qty_r);
  }

  if($qt<0)
  {
    $msg= 'Quantité insuffisante en stock';

  }
  elseif($det->update($_POST["vente_id"]))
  {

  $m_vente=$_POST['prod_prix']*$qty_r;
  $m_vente += $vente->getAmount();
  $vente->setAmount($m_vente);
  $vente->update($_SESSION['op_vente_id']);


      $stock->setOpId($_SESSION['op_vente_id']);
      $stock->setQuantity($qt);
      $stock->setUpdateDate(date('Y-m-d h:i'));

       $stock->update($_POST['num_lot'],$_SESSION['pos']);

    $msg= ' Modification reussie ';

  }
  else
  {
   $msg= 'Echec Modification';
  }

}
else
{
 $msg +=" operation existe pas ";
}
}

echo $msg;
?>
