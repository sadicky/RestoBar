<?php
include_once("dbconnect.php");

class BeanAutreFrais extends dbconnect
{

    private $autId;
    private $autDet;
    private $opId;
    private $amount;

    public function setAutId($autId)
    {
        $this->autId = (int)$autId;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function setAutDet($autDet)
    {
        $this->autDet = (string)$autDet;
    }

    public function setOpId($opId)
    {
        $this->opId = (int)$opId;
    }

    public function getAutId()
    {
        return $this->autId;
    }
    public function getAmount()
    {
        return $this->amount;
    }
    public function getAutDet()
    {
        return $this->autDet;
    }

    public function getOpId()
    {
        return $this->opId;
    }

    public function getTableName()
    {
        return "autre_frais";
    }

    public function __construct($autId = null)
    {
       $this->initDB();
        if (!empty($autId)) {
            $this->select($autId);
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

    public function select($autId)
    {
        $db=$this->dbase;

        try
        {
        $sql =  "SELECT * FROM autre_frais WHERE aut_id=:aut_id";
        $stmt=$db->prepare($sql);
        $stmt->bindParam("aut_id",$autId);
        $stmt->execute();

           $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->autId = $rowObject->aut_id;
            @$this->autDet = $rowObject->aut_det;
            @$this->opId = $rowObject->op_id;
            @$this->amount = $rowObject->amount;

       return $stmt->rowCount();

        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

public function select_sum_op($opId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum(amount) as tot FROM autre_frais where op_id=:id group by op_id");
 $stmt->bindParam("id",$opId);
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat['tot'];
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
 $stmt = $db->prepare("SELECT * FROM autre_frais where op_id=?");
 $stmt->bindValue(1,$op_id);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

public function delete($autId)
    {
        $db = $this->dbase;
            try
            {
        $sql = "DELETE FROM autre_frais WHERE aut_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$autId);
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
            INSERT INTO `autre_frais`(`op_id`,`amount`, `aut_det`)
            VALUES(:opId,:amount,:autDet)";

        $stmt = $db->prepare($sql);

        $stmt->bindParam("opId",$this->opId);
        $stmt->bindParam("amount",$this->amount);
        $stmt->bindParam("autDet",$this->autDet);

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

}
?>
