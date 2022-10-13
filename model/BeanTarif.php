<?php
include_once("dbconnect.php");

class BeanTarif extends dbconnect
{

    private $tarId;
    private $tarCode;
    private $tarName;
    private $status;
    private $isStock;

    public function setTarId($tarId)
    {
        $this->tarId = (int)$tarId;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setIsStock($isStock)
    {
        $this->isStock = $isStock;
    }

    public function setTarName($tarName)
    {
        $this->tarName = (string)$tarName;
    }

    public function setTarCode($tarCode)
    {
        $this->tarCode = (string)$tarCode;
    }

    public function getTarId()
    {
        return $this->tarId;
    }
    public function getStatus()
    {
        return $this->status;
    }

    public function getIsStock()
    {
        return $this->isStock;
    }

    public function getTarName()
    {
        return $this->tarName;
    }

    public function getTarCode()
    {
        return $this->tarCode;
    }

    public function getTableName()
    {
        return "tarif";
    }

    public function __construct($tarId = null)
    {
        $this->initDB();
        if (!empty($tarId)) {
            $this->select($tarId);
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

    public function select($tarId)
    {
        $db=$this->dbase;

        try
        {
            $sql =  "SELECT * FROM tarif WHERE tar_id=:tarId";
            $stmt=$db->prepare($sql);
            $stmt->bindParam("tarId",$tarId);
            $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->tarId = $rowObject->tar_id;
            @$this->tarName = $rowObject->tar_name;
            @$this->tarCode = $rowObject->tar_code;
            @$this->status = $rowObject->status;
            @$this->isStock = $rowObject->is_stock;

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
            $sql =  "SELECT * FROM tarif WHERE status=:status";
            $stmt=$db->prepare($sql);
            $stmt->bindParam("status",$status);
            $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->tarId = $rowObject->tar_id;
            @$this->tarName = $rowObject->tar_name;
            @$this->tarCode = $rowObject->tar_code;
            @$this->status = $rowObject->status;
            @$this->isStock = $rowObject->isStock;

            return $stmt->rowCount();

        }
        catch(PDOException $ex)
        {
            return $ex;
        }
    }

    public function select_code($code)
    {
        $db=$this->dbase;

        try
        {
            $sql =  "SELECT * FROM tarif WHERE tar_code=:code";
            $stmt=$db->prepare($sql);
            $stmt->bindParam("code",$code);
            $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->tarId = $rowObject->tar_id;
            @$this->tarName = $rowObject->tar_name;
            @$this->tarCode = $rowObject->tar_code;
            @$this->status = $rowObject->status;
            @$this->isStock = $rowObject->isStock;

            return $stmt->rowCount();

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
            $stmt = $db->prepare("SELECT * FROM tarif order by tar_name");
            $stmt->execute();
            $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $stat;
        }
        catch(PDOException $ex)
        {
            return $ex;
        }
    }

    public function delete($tableId)
    {

        $db = $this->dbase;
        try
        {
        $sql = "DELETE FROM `tabl` WHERE table_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$tableId);
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
         $sql = "
            INSERT INTO tarif(tar_name,tar_code,status,is_stock) VALUES(:tarName,:tarCode,:status,:isStock)";

            $stmt = $db->prepare($sql);
            $stmt->bindParam("tarName",$this->tarName);
            $stmt->bindParam("tarCode",$this->tarCode);
            $stmt->bindParam("status",$this->status);
            $stmt->bindParam("isStock",$this->isStock);
            return (bool)$stmt->execute();
            }
        catch(PDOException $ex)
            {
                 return $ex;
            }

    }

    public function update($tarId)
    {
        $db = $this->dbase;
            try
            {
         $sql = "
            UPDATE
                tarif
            SET
                tar_name=:tarName,
                tar_code=:tarCode,
                status=:status,
                is_stock=:isStock
            WHERE
                tar_id=:tarId";

            $stmt = $db->prepare($sql);
            $stmt->bindParam("tarName",$this->tarName);
            $stmt->bindParam("tarCode",$this->tarCode);
            $stmt->bindParam("status",$this->status);
            $stmt->bindParam("isStock",$this->isStock);
            $stmt->bindParam("tarId",$tarId);

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

public function exist_tar($tarId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM price where tar_id=:tarId");
 $stmt->bindParam("tarId",$tarId);
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

 public function exist_tar_prod($tarId,$prodId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM price where tar_id=:tarId and prod_id=:prodId and tar_id=:tarId");
 $stmt->bindParam("tarId",$tarId);
 $stmt->bindParam("prodId",$prodId);
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
