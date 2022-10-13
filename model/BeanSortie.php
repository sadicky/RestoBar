<?php
require_once("dbconnect.php");

class BeanSortie extends dbconnect
{

    private $idsort;
    private $amount;
    private $opId;
    private $isPaid;
    private $numSort;
    private $motif;
    private $typeSort;

    public function setIdsort($idsort)
    {
        $this->idsort = (int)$idsort;
    }
    public function setTypeSort($typeSort)
    {
        $this->typeSort= $typeSort;
    }
    public function setNumSort($numsort)
    {
        $this->numSort = $numsort;
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
        $this->isPaid = $isPaid;
    }

    public function setMotif($motif)
    {
        $this->motif = $motif;
    }

    public function getIdsort()
    {
        return $this->idsort;
    }

    public function getTypeSort()
    {
        return $this->typeSort;
    }

    public function getNumSort()
    {
        return $this->numSort;
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

    public function getMotif()
    {
        return $this->motif;
    }

    public function getTableName()
    {
        return "sortie";
    }

    public function __construct($idsort = null)
    {
         $this->initDB();
        if (!empty($idsort)) {
            $this->select($idsort);
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

    public function select($idsort)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM sortie WHERE op_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$idsort);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->idsort = $rowObject->idsort;
            @$this->amount = $rowObject->amount;
            @$this->opId = $rowObject->op_id;
            @$this->numSort = $rowObject->num_sort;
            @$this->isPaid = $rowObject->is_paid;
            @$this->motif = $rowObject->motif;
            @$this->typeSort = $rowObject->type_sort;
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
 $stmt = $db->prepare("SELECT * FROM sortie where op_id=:id");
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
 $stmt = $db->prepare("SELECT max(idsort) as last_num FROM sortie");
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }


    public function delete($idsort)
{
        $db = $this->dbase;
            try
            {
        $sql = "DELETE FROM sortie WHERE idsort=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$idsort);
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
            INSERT INTO sortie
            (amount,op_id,num_sort,motif,type_sort)
            VALUES(:amount,:opId,:numSort,:motif, :typeSort)";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("amount",$this->amount);
        $stmt->bindParam("opId",$this->opId);
        $stmt->bindParam("numSort",$this->numSort);
        $stmt->bindParam("motif",$this->motif);
        $stmt->bindParam("typeSort",$this->typeSort);
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
                sortie
            SET
				amount=:amount,
                motif=:motif,
                type_sort=:typeSort
            WHERE
                op_id=:opId";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("amount",$this->amount);
        $stmt->bindParam("motif",$this->motif);
        $stmt->bindParam("typeSort",$this->typeSort);
        $stmt->bindParam("opId",$opId);

        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function update_2($opId)
    {
        $db = $this->dbase;
            try
            {
            $sql ="
            UPDATE
                sortie
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
        if ($this->idsort != "") {
            return $this->update($this->idsort);
        } else {
            return false;
        }
    }

}
?>
