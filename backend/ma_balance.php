<?php
@session_start();
require_once '../load_model.php';
$trans = new BeanTransactions();
$paie=new BeanPaiement();
//$m_paie=$paie->select_sum_op_bq($_SESSION['jour']);
      if(isset($_SESSION['jour']))
      {
            
            $balance=$trans->select_bal_jour_admin($_SESSION['jour']);
            $balance_bq=$trans->select_bal_jour_admin_bq($_SESSION['jour']);
            
            echo number_format($balance+$balance_bq,0,'.',',').' BIF (Cash :'.number_format($balance,0,'.',',').'BIF /Banque : '.number_format($balance_bq,0,'.',',').' BIF)';
      }
      else
      {
           echo '-';
      }
?>
