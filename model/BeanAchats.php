<?php
require_once("dbconnect.php");



class BeanAchats extends dbconnect
{

    private $idachats;
    private $amount;
    private $opId;
    private $isPaid;
    private $numAchat;

    public function setIdachats($idachats)
    {
        $this->idachats = (int)$idachats;
    }
    public function setNumAchat($numachat)
    {
        $this->numAchat = $numachat;
    }

    public function setAmount($amount)
    {
        $this->amount = (int)$amount;
    }

    public function setOpId($opId)
    {
        $this->opId = (int)$opId;
    }

    public function setIsPaid($isPaid)
    {
        $this->isPaid = (string)$isPaid;
    }

    public function getIdachats()
    {
        return $this->idachats;
    }

    public function getNumAchat()
    {
        return $this->numAchat;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getOpId()
    {
        return $this->opId;
    }

    public function getIsPaid()
    {
        return $this->isPaid;
    }

    public function getTableName()
    {
        return "achats";
    }

    public function __construct($idachats = null)
    {
         $this->initDB();
        if (!empty($idachats)) {
            $this->select($idachats);
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

    public function select($idachats)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM achats WHERE op_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$idachats);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->idachats = $rowObject->idachats;
            @$this->amount = $rowObject->amount;
            @$this->opId = $rowObject->op_id;
            @$this->numAchat = $rowObject->num_achat;
            @$this->isPaid = $rowObject->is_paid;
            return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    // select all rows from tables;

 public function select_all($opId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM achats where op_id=:id");
 $stmt->bindParam("id",$opId);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_last_num()
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT max(idachats) as last_num FROM achats");
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }


    public function delete($idachats)
{
        $db = $this->dbase;
            try
            {
        $sql = "DELETE FROM achats WHERE idachats=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$idachats);
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
            INSERT INTO achats
            (amount,op_id,num_achat,is_paid)
            VALUES(:amount,:opId,:numAchat, :isPaid)";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("amount",$this->amount);
        $stmt->bindParam("opId",$this->opId);
        $stmt->bindParam("numAchat",$this->numAchat);
        $stmt->bindParam("isPaid",$this->isPaid);
        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function update($opId)
    {
        $db = $this->dbase;
            try
            {
            $sql ="
            UPDATE
                achats
            SET
				amount=:amount
            WHERE
                op_id=:opId";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("amount",$this->amount);
         $stmt->bindParam("opId",$opId);
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
        if ($this->idachats != "") {
            return $this->update($this->idachats);
        } else {
            return false;
        }
    }

}
?>
