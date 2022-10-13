<?php
require_once("dbconnect.php");

class BeanEntreProdf extends dbconnect
{

    private $ident;
    private $amount;
    private $opId;
    private $isPaid;
    private $numEnt;

    public function setIdent($ident)
    {
        $this->ident = (int)$ident;
    }
    public function setNumEnt($nument)
    {
        $this->numEnt = $nument;
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

    public function getIdent()
    {
        return $this->ident;
    }

    public function getNumEnt()
    {
        return $this->numEnt;
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
        return "entre_prodf";
    }

    public function __construct($ident = null)
    {
         $this->initDB();
        if (!empty($ident)) {
            $this->select($ident);
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

    public function select($ident)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM entre_prodf WHERE op_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$ident);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->ident = $rowObject->ident;
            @$this->amount = $rowObject->amount;
            @$this->opId = $rowObject->op_id;
            @$this->numEnt = $rowObject->num_ent;
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
 $stmt = $db->prepare("SELECT * FROM entre_prodf where op_id=:id");
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
 $stmt = $db->prepare("SELECT max(ident) as last_num FROM entre_prodf");
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }


    public function delete($ident)
{
        $db = $this->dbase;
            try
            {
        $sql = "DELETE FROM entre_prodf WHERE ident=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$ident);
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
            INSERT INTO entre_prodf
            (amount,op_id,num_ent,is_paid)
            VALUES(:amount,:opId,:numEnt, :isPaid)";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("amount",$this->amount);
        $stmt->bindParam("opId",$this->opId);
        $stmt->bindParam("numEnt",$this->numEnt);
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
                entre_prodf
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
        if ($this->ident != "") {
            return $this->update($this->ident);
        } else {
            return false;
        }
    }

}
?>
