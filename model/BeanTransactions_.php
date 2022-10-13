<?php
include_once("dbconnect.php");



class BeanTransactions extends dbconnect
{

    private $transactionId;
    private $jourId;
    private $transactionType;
    private $createDate;
    private $amount;
    private $opId;
    private $partyCode;
    private $status;
    private $preBal;
    private $balAfter;
    private $descript;
    private $canceled;


    public function setTransactionId($transactionId)
    {
        $this->transactionId = (int)$transactionId;
    }


    public function setJourId($jourId)
    {
        $this->jourId = $jourId;
    }

     public function setOpId($opId)
    {
        $this->opId = (int)$opId;
    }

    public function setPersonneId($personneId)
    {
        $this->personneId = (int)$personneId;
    }


    public function setTransactionType($transactionType)
    {
        $this->transactionType = (string)$transactionType;
    }

    public function setCreateDate($createDate)
    {
        $this->createDate = (string)$createDate;
    }


    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function setPartyCode($partyCode)
    {
        $this->partyCode = (string)$partyCode;
    }


    public function setStatus($status)
    {
        $this->status = (string)$status;
    }

    public function setPreBal($preBal)
    {
        $this->preBal = (int)$preBal;
    }

    public function setBalAfter($balAfter)
    {
        $this->balAfter = (int)$balAfter;
    }

    public function setDescript($descript)
    {
        $this->descript = $descript;
    }

    public function setCanceled($canceled)
    {
        $this->canceled = $canceled;
    }

    public function getTransactionId()
    {
        return $this->transactionId;
    }

    public function getJourId()
    {
        return $this->jourId;
    }

    public function getOpId()
    {
        return $this->opId;
    }

    public function getPersonneId()
    {
        return $this->personneId;
    }

    public function getTransactionType()
    {
        return $this->transactionType;
    }


    public function getCreateDate()
    {
        return $this->createDate;
    }


    public function getAmount()
    {
        return $this->amount;
    }

    public function getPartyCode()
    {
        return $this->partyCode;
    }


    public function getStatus()
    {
        return $this->status;
    }


    public function getPreBal()
    {
        return $this->preBal;
    }

    public function getBalAfter()
    {
        return $this->balAfter;
    }

    public function getDescript()
    {
        return $this->descript;
    }

    public function getCanceled()
    {
        return $this->canceled;
    }

    public function getTableName()
    {
        return "transactions";
    }


    public function __construct($transactionId = null)
    {
        $this->initDB();
        if (!empty($transactionId)) {
            $this->select($transactionId);
        }
    }

    /**
     * The implicit destructor
     */
    public function __destruct()
    {
        $this->close();
    }

    /**
     * Explicit destructor. It calls the implicit destructor automatically.
     */
    public function close()
    {
        unset($this);
    }


    public function select($transactionId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM transactions WHERE transaction_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$transactionId);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);

            @$this->transactionId = $rowObject->transaction_id;
            @$this->jourId = $rowObject->jour_id;
            @$this->transactionType = $rowObject->transaction_type;
            @$this->createDate = $rowObject->create_date;
            @$this->opId = $rowObject->op_id;
            @$this->personneId = $rowObject->personne_id;
            @$this->descript = $rowObject->descript;
            @$this->canceled = $rowObject->canceled;
            @$this->amount = $rowObject->amount;
            @$this->partyCode = $rowObject->party_code;
            @$this->status = $rowObject->status;
            @$this->preBal = $rowObject->pre_bal;
            @$this->balAfter = $rowObject->bal_after;

        return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_last_jour($jourId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT max(transaction_id) as max_id FROM transactions WHERE jour_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$jourId);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->transactionId = $rowObject->max_id;
        return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    // select all rows from tables;

    public function select_all()
    {
        $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM transactions");
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
}

public function select_all_jour($jour_id)
{
        $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM transactions join journal on transactions.jour_id=journal.jour_id where journal.jour_id=:jour_id order by transaction_id");
 $stmt->bindParam("jour_id",$jour_id);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
}

public function select_all_jour_admin($jour_id)
{
        $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM transactions join journal on transactions.jour_id=journal.jour_id where (parent_id=:jour_id or journal.jour_id=:jour_id) and party_code<>'Enfant'  order by transaction_id");
 $stmt->bindParam("jour_id",$jour_id);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
}

public function select_bal_jour($jour_id)
{
        $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum(amount) as in_amount FROM transactions where jour_id=:jour_id AND status='IN' AND canceled='1'");
 $stmt->bindParam("jour_id",$jour_id);
 $stmt->execute();
 $in = $stmt->fetch();

 $stmt = $db->prepare("SELECT sum(amount) as out_amount FROM transactions where jour_id=:jour_id AND status='OUT'  AND canceled='1'");
 $stmt->bindParam("jour_id",$jour_id);
 $stmt->execute();
 $out = $stmt->fetch();

 $balance=$in['in_amount']-$out['out_amount'];
  return $balance;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
}


public function select_bal_jour_admin($jour_id)
{
        $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum(amount) as in_amount FROM transactions join journal on transactions.jour_id=journal.jour_id where (parent_id=:jour_id or journal.jour_id=:jour_id) AND status='IN' AND canceled='1' and party_code<>'Enfant'");
 $stmt->bindParam("jour_id",$jour_id);
 $stmt->execute();
 $in = $stmt->fetch();

 $stmt = $db->prepare("SELECT sum(amount) as out_amount FROM transactions join journal on transactions.jour_id=journal.jour_id where (parent_id=:jour_id or journal.jour_id=:jour_id) AND status='OUT'  AND canceled='1' and party_code<>'Enfant'");
 $stmt->bindParam("jour_id",$jour_id);
 $stmt->execute();
 $out = $stmt->fetch();

 $balance=$in['in_amount']-$out['out_amount'];
  return $balance;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
}

public function select_all_type($type)
{
        $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM transactions where transaction_type=:type
    order by create_date desc limit 0,100");
  $stmt->bindParam("type",$type);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
}

public function select_all_type_period_by_ag($type,$from_d,$to_d,$personneId)
{
        $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM transactions where transaction_type=:type and personne_id=:personneId and (create_date
    between :from_d and :to_d)");
$stmt->bindParam("type",$type);
$stmt->bindParam("from_d",$from_d);
$stmt->bindParam("to_d",$to_d);
$stmt->bindParam("personneId",$personneId);
$stmt->execute();
$stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
}

public function select_all_type_period($type,$from_d,$to_d)
{
        $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM transactions where transaction_type=:type  and (create_date
    between :from_d and :to_d)");
$stmt->bindParam("type",$type);
$stmt->bindParam("from_d",$from_d);
$stmt->bindParam("to_d",$to_d);
//$stmt->bindParam("jourId",$jourId);
$stmt->execute();
$stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
}

public function select_sum_out($jour_id)
{
        $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum(amount) as out_amount FROM transactions where jour_id=:jour_id AND transaction_type='Retrait'  AND canceled='1'");
 $stmt->bindParam("jour_id",$jour_id);
 $stmt->execute();
 $out = $stmt->fetch();

  return $out['out_amount'];
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
}

public function select_sum_out_period($from_d,$to_d)
{
        $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum(amount) as out_amount FROM transactions where transaction_type='Retrait' and (date(create_date)
    between :from_d and :to_d)  AND canceled='1'");
 $stmt->bindParam("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);
 $stmt->execute();
 $out = $stmt->fetch();

  return $out['out_amount'];
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
}

public function transaction_amount($transType,$from_d,$to_d)
{
    $db = $this->dbase;
    try
 {
 $stmt = $db->prepare("SELECT sum(amount) as tot FROM transactions where transaction_type=:transType AND canceled='1' AND (date(create_date) BETWEEN :from_d AND :to_d)");
 $stmt->bindParam("transType",$transType);
 $stmt->bindParam("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);
 $stmt->execute();
 $trans=$stmt->fetch();
  return $trans['tot'];
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
}


    public function delete($transactionId)
    {
        $db = $this->dbase;
        try
        {
        $sql = "DELETE FROM transactions WHERE transaction_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$transactionId);
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
            INSERT INTO `transactions`(`jour_id`, `op_id`, `transaction_type`, `descript`,`amount`, `party_code`,`pre_bal`, `bal_after`, `personne_id`,`status`)
            VALUES(:jourId,:opId,:transactionType,:descript,:amount,:partyCode,:preBal,:balAfter,:personneId,:status)";

       $stmt = $db->prepare($sql);

            $stmt->bindParam("jourId",$this->jourId);
            $stmt->bindParam("transactionType",$this->transactionType);
            $stmt->bindParam("opId",$this->opId);
            $stmt->bindParam("amount",$this->amount);
            $stmt->bindParam("personneId",$this->personneId);
            $stmt->bindParam("descript",$this->descript);
            $stmt->bindParam("partyCode",$this->partyCode);
            $stmt->bindParam("preBal",$this->preBal);
            $stmt->bindParam("balAfter",$this->balAfter);
            $stmt->bindParam("status",$this->status);
            $stmt->execute();
            return $db->lastInsertId();
            }
        catch(PDOException $ex)
            {
                 return $ex;
            }


    }


    public function update($transactionId)
    {
        $db = $this->dbase;
            try
            {
            $sql ="UPDATE
                transactions
            SET
				jour_id=:jourId,
				transaction_type=:transactionType,
				op_id=:opId,
				amount=:amount,
				personne_id=:personneId,
				descript=:descript,
				party_code=:partyCode,
				pre_bal=:preBal,
				bal_after=:balAfter
            WHERE
                transaction_id=:transactionId";

            $stmt = $db->prepare($sql);

            $stmt->bindParam("jourId",$this->jourId);
            $stmt->bindParam("transactionType",$this->transactionType);
            $stmt->bindParam("opId",$this->opId);
            $stmt->bindParam("amount",$this->amount);
            $stmt->bindParam("personneId",$this->personneId);
            $stmt->bindParam("descript",$this->descript);
            $stmt->bindParam("partyCode",$this->partyCode);
            $stmt->bindParam("preBal",$this->preBal);
            $stmt->bindParam("balAfter",$this->balAfter);
            $stmt->bindParam("transactionId",$transactionId);

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
        if ($this->transactionId != "") {
            return $this->update($this->transactionId);
        } else {
            return false;
        }
    }

    function upload_image()
{
 if(isset($_FILES["trans_image"]))
 {
  $extension = explode('.', $_FILES['trans_image']['name']);
  $new_name = rand() . '.' . $extension[1];
  $destination = './../upload/' . $new_name;
  move_uploaded_file($_FILES['trans_image']['tmp_name'], $destination);
  return $new_name;
 }
}

}
?>
