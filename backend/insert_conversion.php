<?php

session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$det_an = new BeanDetailsOperation();
$stock = new BeanStock();
$prod = new BeanProducts();
$acc=new BeanAccounts();
$entre=new BeanEntreProdf();
$check = new BeanCheckExp();

$prod->select($_POST['prod_id']);
$entre->select($_SESSION['op_conv_id']);
$dateExp=$_POST['year'].'/'.$_POST['month'].'/01';

$m_entre=0;

$qt_conv=$_POST['prod_qt'];
$lot=$_POST['lot'];
if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {

  $det->setProdId($_POST['prod_id']);
  $det->setOpId($_SESSION['op_conv_id']);
  $det->setQuantity($_POST['prod_qt']);
  $det->setAmount($_POST['prod_prix']);
  $det->setDet(true);
  $det->setLot($_POST['lot']);
  $det->setDateExp($dateExp);

  if(empty($_POST['prod_id']))
  {
    echo 'Selectionnez le produit';

  }
  else
  {
     $last_det=$det->insert();
     $det->update_sup($last_det);
     if($check->exist_lot($lot,$_POST['prod_id']))
     {
      $qt_stk=$stock->stock_lot($lot,$_POST['prod_id'],$_SESSION['pos'],$_SESSION['periode']);
      $check->setQt($qt_stk);
      $check->update_qt($lot,$_POST['prod_id']);
     }
     else
     {
      $check->setProdId($_POST['prod_id']);
      $check->setLot($lot);
      $check->setDateExp($dateExp);
      $check->setIdPer($_SESSION['periode']);
      $check->insert();

      $check->setQt($_POST['prod_qt']);
      $check->update_qt($lot,$_POST['prod_id']);
     }
     echo ' Enregistrement reussi';


  $m_entre=$_POST['prod_prix']*$_POST['prod_qt'];
  $m_entre += $entre->getAmount();
  $entre->setAmount($m_entre);
  $entre->update($_SESSION['op_conv_id']);

    if(!$stock->existstock($_SESSION['pos'],$_POST['prod_id']))
     {
        $stock->setProdId($_POST['prod_id']);
        $stock->setOpId($_SESSION['op_conv_id']);
        $stock->setQuantity($qt_conv);
        $stock->setUpdateDate(date('Y-m-d h:i'));
        $stock->setPosId($_SESSION['pos']);
        $stock->setDet(true);
        $stock->insert();

     }
     else
     {
       $stock->select($_POST['prod_id'],$_SESSION['pos']);
       $qt=$stock->getQuantity() + $qt_conv;


        $stock->setOpId($_SESSION['op_conv_id']);
        $stock->setQuantity($qt);
        $stock->setUpdateDate(date('Y-m-d h:i'));

        $stock->update($_POST['prod_id'],$_SESSION['pos']);

     }

  }

  }


 if($_POST["operation"] == "Edit")
 {

  $det->setProdId($_POST['prod_id']);
  $det->setOpId($_SESSION['op_conv_id']);
  $det->setQuantity($_POST['prod_qt']);
  $det->setDetailsId($_POST['conv_id']);
  $det->setAmount($_POST['prod_prix']);
  $det->setDet(false);
  $det->setLot($_POST['lot']);
  $det->setDateExp($dateExp);


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
  elseif($det->update($_POST["conv_id"]))
  {
  $m_entre += $entre->getAmount();
  $entre->setAmount($m_entre);
  $entre->update($_SESSION['op_conv_id']);
  $det->update_sup($_POST["conv_id"]);

      $stock->setOpId($_SESSION['op_conv_id']);
      $stock->setQuantity($qt);
      //$stock->setPosId($_SESSION['pos']);
      $stock->setUpdateDate(date('Y-m-d h:i'));

      $stock->update($_POST['prod_id'],$_SESSION['pos']);

      //lot and date exp updated
      $check->setLot($lot);
      $check->setDateExp($dateExp);
      $check->update_sup2($det_an->getLot(),$det_an->getdateExp(),$_POST['prod_id']);

      $det->setLot($lot);
      $det->setDateExp($dateExp);
      $det->update_sup2($det_an->getLot(),$det_an->getdateExp(),$_POST['prod_id']);

      //stocl lot
      $qt_stk=$stock->stock_lot($lot,$_POST['prod_id'],$_SESSION['pos'],$_SESSION['periode']);
      $check->setQt($qt_stk);
      $check->update_qt($lot,$_POST['prod_id']);

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
