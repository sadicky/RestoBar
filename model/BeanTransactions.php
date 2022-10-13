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
    private $idPer;
    private $modePaie;
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
        $this->createDate = $createDate;
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

    public function setIdPer($idPer)
    {
        $this->idPer = (int)$idPer;
    }

    public function setIdBq($idBq)
    {
        $this->idBq = $idBq;
    }

    public function setDescript($descript)
    {
        $this->descript = $descript;
    }

    public function setModePaie($modePaie)
    {
        $this->modePaie = $modePaie;
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

    public function getModePaie()
    {
        return $this->modePaie;
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


    public function getIdPer()
    {
        return $this->idPer;
    }

    public function getDescript()
    {
        return $this->descript;
    }

    public function getCanceled()
    {
        return $this->canceled;
    }

    public function getIdBq()
    {
        return $this->idBq;
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
        //unset($this);
    }


    public function select($transactionId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT *,date(create_date) as cr_date FROM transactions WHERE transaction_id=:id";
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
            @$this->idPer = $rowObject->id_per;
            @$this->modePaie = $rowObject->mode_paie;
            @$this->idBq = $rowObject->id_bq;

        return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_op($transactionId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM transactions WHERE op_id=:id";
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
            @$this->idPer = $rowObject->id_per;
            @$this->modePaie = $rowObject->mode_paie;
            

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

public function select_all_nb_op($opId)
    {
        $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM transactions where op_id=?");
 $stmt->bindValue(1,$opId);
 $stmt->execute();
 $stat = $stmt->rowCount();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
}

public function select_all_op($opId)
    {
        $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM transactions where op_id=?");
 $stmt->bindValue(1,$opId);
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
 $stmt = $db->prepare("SELECT * FROM transactions join journal on transactions.jour_id=journal.jour_id where journal.jour_id=:jour_id order by create_date");
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
 $stmt = $db->prepare("SELECT * FROM transactions join journal on transactions.jour_id=journal.jour_id where journal.jour_id=:jour_id  order by transaction_id");
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

public function select_all_jour_admin_typ($jour_id,$idBq)
{
        $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM transactions join journal on transactions.jour_id=journal.jour_id where (parent_id=:jour_id or journal.jour_id=:jour_id) and party_code<>'Enfant' and id_bq=:idBq  order by transaction_id");
 $stmt->bindParam("jour_id",$jour_id);
 $stmt->bindParam("idBq",$idBq);
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
 $stmt = $db->prepare("SELECT sum(amount) as in_amount FROM transactions where jour_id=:jour_id AND status='IN'");
 $stmt->bindParam("jour_id",$jour_id);
 $stmt->execute();
 $in = $stmt->fetch();

 $stmt = $db->prepare("SELECT sum(amount) as out_amount FROM transactions where jour_id=:jour_id AND status='OUT'");
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

public function select_sum_out($jour_id)
{
        $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum(amount) as out_amount FROM transactions where jour_id=:jour_id 
    AND transaction_type='Retrait' or transaction_type='Fourniture'");
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

public function select_sum_in($jour_id)
{
        $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum(amount) as out_amount FROM transactions where jour_id=:jour_id AND transaction_type='Versement'  ");
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
    between :from_d and :to_d)  ");
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

public function select_sum_out_period_2($from_d,$to_d,$party)
{
        $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum(amount) as out_amount FROM transactions where transaction_type='Retrait' and (date(create_date)
    between :from_d and :to_d) AND party_code=:party");
 $stmt->bindParam("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);
 $stmt->bindParam("party",$party);
 $stmt->execute();
 $out = $stmt->fetch();

  return $out['out_amount'];
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
}

public function select_sum_in_period($from_d,$to_d)
{
        $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum(amount) as out_amount FROM transactions where transaction_type='Versement' and (date(create_date)
    between :from_d and :to_d)  ");
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

public function select_sum_emprunt_period($from_d,$to_d)
{
        $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum(amount) as out_amount FROM transactions where transaction_type='Emprunt' and (date(create_date)
    between :from_d and :to_d)  ");
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

public function select_sum_out_period_dep($from_d,$to_d,$descript)
{
        $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum(amount) as out_amount FROM transactions where transaction_type='Retrait' and (date(create_date)
    between :from_d and :to_d)  AND descript=:descript ");
 $stmt->bindParam("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);
 $stmt->bindParam("descript",$descript);
 $stmt->execute();
 $out = $stmt->fetch();

  return $out['out_amount'];
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

public function select_all_type_period_bq($type,$from_d,$to_d,$idBq)
{
        $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM transactions where transaction_type=:type and id_bq=:idBq and (create_date
    between :from_d and :to_d)");
$stmt->bindParam("type",$type);
$stmt->bindParam("from_d",$from_d);
$stmt->bindParam("to_d",$to_d);
$stmt->bindParam("idBq",$idBq);
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
 $stmt = $db->prepare("SELECT * FROM transactions where transaction_type=:type  and (date(create_date)
    between :from_d and :to_d)");
$stmt->bindParam("type",$type);
$stmt->bindParam("from_d",$from_d);
$stmt->bindParam("to_d",$to_d);
$stmt->execute();
$stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
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
 $stmt = $db->prepare("SELECT sum(amount) as tot FROM transactions where transaction_type=:transType  AND (date(create_date) BETWEEN :from_d AND :to_d)");
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

public function select_op_an_date_type($dateTrans,$id_bq)
    {
    $db = $this->dbase;
    try
    {
        $stmt = $db->prepare("SELECT sum(amount) as mont FROM transactions where date(create_date)<?  and id_bq=? and status='IN'  and transaction_type<>'Ouverture'");
        $stmt->bindValue(1,$dateTrans);
        $stmt->bindValue(2,$id_bq);
        $stmt->execute();
        $in = $stmt->fetch();

        $stmt = $db->prepare("SELECT sum(amount) as mont FROM transactions where date(create_date)<? and id_bq=? and status='OUT'  and transaction_type<>'Ouverture'");
        $stmt->bindValue(1,$dateTrans);
        $stmt->bindValue(2,$id_bq);
        $stmt->execute();

        $out = $stmt->fetch();

        $solde=$in['mont']-$out['mont'];
        return $solde;
    }
    catch(PDOException $ex)
    {
        return $ex;
    }
    }

    public function select_op_by_date_type($dateTrans,$id_bq)
    {
    $db = $this->dbase;
    try
    {
        $stmt = $db->prepare("SELECT amount as mont, transactions.* FROM transactions where date(create_date)=? and id_bq=?  and transaction_type<>'Ouverture' order by transaction_id ");
        $stmt->bindValue(1,$dateTrans);
        $stmt->bindValue(2,$id_bq);
        $stmt->execute();
        $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $stat;
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
            INSERT INTO `transactions`(`jour_id`, `op_id`, `transaction_type`, `descript`,`amount`, `party_code`,`id_bq`, `id_per`, `personne_id`,`status`,`create_date`,`mode_paie`)
            VALUES(:jourId,:opId,:transactionType,:descript,:amount,:partyCode,:idBq,:idPer,:personneId,:status,:createDate,:modePaie)";

       $stmt = $db->prepare($sql);

            $stmt->bindParam("jourId",$this->jourId);
            $stmt->bindParam("transactionType",$this->transactionType);
            $stmt->bindParam("opId",$this->opId);
            $stmt->bindParam("amount",$this->amount);
            $stmt->bindParam("personneId",$this->personneId);
            $stmt->bindParam("descript",$this->descript);
            $stmt->bindParam("partyCode",$this->partyCode);
            $stmt->bindParam("idPer",$this->idPer);
            $stmt->bindParam("idBq",$this->idBq);
            $stmt->bindParam("createDate",$this->createDate);
            $stmt->bindParam("modePaie",$this->modePaie);
            $stmt->bindParam("status",$this->status);
            $stmt->execute();
            return $db->lastInsertId();
            }
        catch(PDOException $ex)
            {
                 return $ex;
            }


    }

    public function insert_2()
    {
        $db = $this->dbase;
            try
            {
        $sql ="
            INSERT INTO `transactions`(`jour_id`, `op_id`, `transaction_type`, `descript`,`amount`, `party_code`,`id_per`, `bal_after`, `personne_id`,`status`,`create_date`,`mode_paie`)
            VALUES(:jourId,:opId,:transactionType,:descript,:amount,:partyCode,:idPer,:balAfter,:personneId,:status,:createDate,:modePaie)";

       $stmt = $db->prepare($sql);

            $stmt->bindParam("jourId",$this->jourId);
            $stmt->bindParam("transactionType",$this->transactionType);
            $stmt->bindParam("opId",$this->opId);
            $stmt->bindParam("amount",$this->amount);
            $stmt->bindParam("personneId",$this->personneId);
            $stmt->bindParam("descript",$this->descript);
            $stmt->bindParam("partyCode",$this->partyCode);
            $stmt->bindParam("idPer",$this->idPer);
            $stmt->bindParam("balAfter",$this->balAfter);
            $stmt->bindParam("status",$this->status);
             $stmt->bindParam("createDate",$this->createDate);
             $stmt->bindParam("modePaie",$this->modePaie);

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
				amount=:amount,
				descript=:descript,
				party_code=:partyCode,
                id_bq=:idBq,
                mode_paie=:modePaie,
                create_date=:createDate
            WHERE
                transaction_id=:transactionId";

            $stmt = $db->prepare($sql);

            $stmt->bindParam("idBq",$this->idBq);
            $stmt->bindParam("amount",$this->amount);
            $stmt->bindParam("descript",$this->descript);
            $stmt->bindParam("partyCode",$this->partyCode);
            $stmt->bindParam("createDate",$this->createDate);
            $stmt->bindParam("modePaie",$this->modePaie);
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

public function select_sum_op_bq($jour)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum(amount) as paie FROM transactions join operation on transactions.op_id=operation.op_id where transactions.jour_id=:id and operation.jour_id=:id2 and canceled='1' and id_bq<>'1' and transaction_type='Vente' group by transactions.jour_id");
 $stmt->bindParam("id",$jour);
 $stmt->bindParam("id2",$jour);
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat['paie'];
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
 $stmt = $db->prepare("SELECT sum(amount) as paie FROM transactions join operation on transactions.op_id=operation.op_id where transactions.jour_id=:id and operation.jour_id=:id2 and transaction_type='Vente' group by transactions.jour_id");
 $stmt->bindParam("id",$jour);
 $stmt->bindParam("id2",$jour);
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat['paie'];
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_sum_op_ant($jour)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum(amount) as paie FROM transactions join operation on transactions.op_id=operation.op_id where transactions.jour_id=:id and operation.jour_id<>:id2 and transaction_type='Vente' group by transactions.jour_id");
 $stmt->bindParam("id",$jour);
 $stmt->bindParam("id2",$jour);
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat['paie'];
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

public function nb_format($val)
 {
    return number_format($val,1,'.',',');
 }

 public function select_balance($bank)
    {
    $db = $this->dbase;
    try
    {
        $stmt = $db->prepare("SELECT sum(amount) as mont FROM transactions where  id_bq=? and status='IN' and canceled='0' ");
        $stmt->bindValue(1,$bank);
        $stmt->execute();
        $in = $stmt->fetch();

        $stmt = $db->prepare("SELECT sum(amount) as mont FROM transactions where id_bq=? and status='OUT' and canceled='0'");
        $stmt->bindValue(1,$bank);
        $stmt->execute();

        $out = $stmt->fetch();

        $solde=$in['mont']-$out['mont'];
        return $solde;
    }
    catch(PDOException $ex)
    {
        return $ex;
    }
    }

public function date_format($val)
 {
    return date('d-m-Y',strtotime($val));
 }
}
?>
