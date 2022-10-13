<?php
include_once("dbconnect.php");

class BeanPos extends dbconnect
{

    private $posId;
    private $posName;
    private $posCode;
    private $status;

    public function setPosId($posId)
    {
        $this->posId = (int)$posId;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setPosName($posName)
    {
        $this->posName = (string)$posName;
    }

    public function setPosCode($posCode)
    {
        $this->posCode = $posCode;
    }

    public function getPosId()
    {
        return $this->posId;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function getPosName()
    {
        return $this->posName;
    }

    public function getPosCode()
    {
        return $this->posCode;
    }

    public function getTableName()
    {
        return "pos";
    }

    public function __construct($posId = null)
    {
       $this->initDB();
        if (!empty($posId)) {
            $this->select($posId);
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

    public function select($posId)
    {
        $db=$this->dbase;

        try
        {
        $sql =  "SELECT * FROM pos WHERE pos_id=:pos_id";
        $stmt=$db->prepare($sql);
        $stmt->bindParam("pos_id",$posId);
        $stmt->execute();

           $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->posId = $rowObject->pos_id;
            @$this->posName = $rowObject->pos_name;
            @$this->posCode = $rowObject->pos_code;
            @$this->status = $rowObject->status;

       return $stmt->rowCount();

        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_status($status)
    {
        $db=$this->dbase;

        try
        {
        $sql =  "SELECT * FROM pos WHERE status=:status";
        $stmt=$db->prepare($sql);
        $stmt->bindParam("status",$status);
        $stmt->execute();

           $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->posId = $rowObject->pos_id;
            @$this->posName = $rowObject->pos_name;
            @$this->posCode = $rowObject->pos_code;
            @$this->status = $rowObject->status;
            @$this->tarId = $rowObject->tar_id;

       return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function delete($idBq)
    {
        $db = $this->dbase;
        try
        {
        $sql = "DELETE FROM banque WHERE id_bq=?";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$idBq);
        return (bool)$stmt->execute();
        }
        catch(PDOException $ex)
        {
                 return $ex;
        }
    }

    public function select_all()
    {
    $db = $this->dbase;
    try
    {
        $stmt = $db->prepare("SELECT * FROM pos");
        $stmt->execute();
        $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $stat;
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
        $sql ="INSERT INTO `pos`(`pos_name`, `pos_code`, `status`) VALUES (?,?,?)";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$this->posName);
        $stmt->bindValue(2,$this->posCode);
        $stmt->bindValue(3,$this->status);

        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function update($posId)
    {
        $db = $this->dbase;
            try
            {
        $sql ="UPDATE `pos` SET `pos_name`=?,`pos_code`=?,`status`=? WHERE pos_id=?";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$this->posName);
        $stmt->bindValue(2,$this->posCode);
        $stmt->bindValue(3,$this->status);
        $stmt->bindValue(4,$posId);

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

    public function update_2($val_f)
       {


        $db = $this->dbase;
            try
            {
            $sql ="
            UPDATE
                ".$this->getTableName()."
            SET
                status =:val_f";

            $stmt = $db->prepare($sql);
            $stmt->bindParam("val_f",$val_f);
            return (bool)$stmt->execute();
            }
        catch(PDOException $ex)
            {
                 return $ex;
            }

        }

public function exist_pos($posId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM operation where pos_id=:posId");
 $stmt->bindParam("posId",$posId);
 $stmt->execute();
 if($stmt->rowCount()>=1)
 {
    return true;
 }
 else
 {
    return false;
 }
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

}
?>
