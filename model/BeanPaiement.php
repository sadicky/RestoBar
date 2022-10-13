<?php
require_once("dbconnect.php");

class BeanPaiement extends dbconnect
{

    private $paieId;
    private $opId;
    private $transactionId;
    private $amount;
    private $modePaie;
    private $autref;
    private $canceled;

    public function setPaieId($paieId)
    {
        $this->paieId = (int)$paieId;
    }

    public function setOpId($opId)
    {
        $this->opId = (int)$opId;
    }

    public function setTransactionId($transactionId)
    {
        $this->transactionId = (int)$transactionId;
    }

    public function setModePaie($modePaie)
    {
        $this->modePaie = $modePaie;
    }

    public function setAutref($autref)
    {
        $this->autref = $autref;
    }

    public function setAmount($amount)
    {
        $this->amount = (int)$amount;
    }

    public function setCanceled($canceled)
    {
        $this->canceled = $canceled;
    }

    public function getPaieId()
    {
        return $this->paieId;
    }

    public function getOpId()
    {
        return $this->opId;
    }

    public function getTransactionId()
    {
        return $this->transactionId;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getModePaie()
    {
        return $this->modePaie;
    }

    public function getAutref()
    {
        return $this->autref;
    }

    public function getCanceled()
    {
        return $this->canceled;
    }



    public function getTableName()
    {
        return "paiement";
    }

    public function __construct($paieId = null)
    {
        $this->initDB();
        if (!empty($paieId)) {
            $this->select($paieId);
        }
    }

    public function __destruct()
    {
        $this->close();
    }

    public function close()
    {
        //unset($this);
    }

    public function select($paieId)
    {

        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM paiement WHERE paie_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$paieId);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->paieId = $rowObject->paie_id;
            @$this->opId = $rowObject->op_id;
            @$this->transactionId = $rowObject->transaction_id;
            @$this->amount = $rowObject->amount;
            @$this->modePaie = $rowObject->mode_paie;
            @$this->autref = $rowObject->autref;
            @$this->canceled = $rowObject->canceled;

        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    // select all rows from tables;

 public function select_sum_op($opId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum(amount) as paie FROM paiement where op_id=:id and canceled='1' group by op_id");
 $stmt->bindParam("id",$opId);
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

public function select_sum_op_cash($jour)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum(amount) as paie FROM paiement join operation on paiement.op_id=operation.op_id where jour_id=:id and canceled='1' and mode_paie='Cash' group by jour_id");
 $stmt->bindParam("id",$jour);
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat['paie'];
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_sum_op_bq($jour)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum(amount) as paie FROM paiement join operation on paiement.op_id=operation.op_id where jour_id=:id and canceled='1' and mode_paie='Banque' group by jour_id");
 $stmt->bindParam("id",$jour);
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat['paie'];
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_sum_op_date($opId,$date_p)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum(paiement.amount) as paie FROM transactions join paiement on transactions.transaction_id=paiement.transaction_id where paiement.op_id=:id and paiement.canceled='1' and create_date<:date_p group by paiement.op_id");
 $stmt->bindParam("id",$opId);
 $stmt->bindParam("date_p",$date_p);
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_by_trans($transactionId)
 {
    $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM paiement WHERE transaction_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$transactionId);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->paieId = $rowObject->paie_id;
            @$this->opId = $rowObject->op_id;
            @$this->transactionId = $rowObject->transaction_id;
            @$this->amount = $rowObject->amount;
            @$this->modePaie = $rowObject->mode_paie;
            @$this->autref = $rowObject->autref;
            @$this->canceled = $rowObject->canceled;

        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
 }

 public function select_by_op($transactionId)
 {
    $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM paiement WHERE op_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$transactionId);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->paieId = $rowObject->paie_id;
            @$this->opId = $rowObject->op_id;
            @$this->transactionId = $rowObject->transaction_id;
            @$this->amount = $rowObject->amount;
            @$this->modePaie = $rowObject->mode_paie;
            @$this->autref = $rowObject->autref;

        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
 }

public function select_all_op($op_id)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT paiement.*, date(create_date) as datep FROM transactions join paiement on transactions.transaction_id=paiement.transaction_id where paiement.op_id=:op_id and paiement.canceled='1'");
 $stmt->bindParam('op_id',$op_id);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }


    public function delete($transId)
    {
        $db = $this->dbase;
            try
            {
        $sql = "DELETE FROM paiement WHERE trans_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$transId);
        return (bool)$stmt->execute();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }


    public function insert()
    {
        $db = $this->dbase;
            try
            {
        $sql ="
            INSERT INTO `paiement`(`op_id`, `transaction_id`, `amount`, `mode_paie`, `autref`)
            VALUES(:opId,:transactionId,:amount,:mode_paie,:autref)";

        $stmt = $db->prepare($sql);

        $stmt->bindParam("opId",$this->opId);
        $stmt->bindParam("transactionId",$this->transactionId);
        $stmt->bindParam("amount",$this->amount);
        $stmt->bindParam("mode_paie",$this->modePaie);
        $stmt->bindParam("autref",$this->autref);

        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function update($transId)
    {
        $db = $this->dbase;
            try
            {
            $sql ="
            UPDATE
                paiement
            SET
				amount=:amount
            WHERE
                transaction_id=:transId";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("amount",$this->amount);
        $stmt->bindParam("transId",$transId);
        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function update_one($Id,$val_id,$val_n,$val_f)
       {
        $db = $this->dbase;
            try
            {
            $sql ="
            UPDATE
                ".$this->getTableName()."
            SET
                ".$val_n." =:val_f
            WHERE
               ".$val_id."=:id";

            $stmt = $db->prepare($sql);
            $stmt->bindParam("val_f",$val_f);
            $stmt->bindParam("id",$Id);

            return (bool)$stmt->execute();


            }
        catch(PDOException $ex)
            {
                 return $ex;
            }

        }

    public function updateCurrent()
    {
        if ($this->paieId != "") {
            return $this->update($this->paieId);
        } else {
            return false;
        }
    }

}
?>
