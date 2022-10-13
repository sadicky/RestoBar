<?php
include_once("dbconnect.php");

class BeanStore extends dbconnect
{

    private $storeId;
    private $storeName;
    private $tarId;
    private $posId;
    private $status;

    public function setStoreId($storeId)
    {
        $this->storeId = (int)$storeId;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setStoreName($storeName)
    {
        $this->storeName = (string)$storeName;
    }

    public function setTarId($tarId)
    {
        $this->tarId = (int)$tarId;
    }

    public function setPosId($posId)
    {
        $this->posId = (int)$posId;
    }

    public function getStoreId()
    {
        return $this->storeId;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function getStoreName()
    {
        return $this->storeName;
    }

    public function getPosId()
    {
        return $this->posId;
    }

    public function getTarId()
    {
        return $this->tarId;
    }

    public function getTableName()
    {
        return "store";
    }

    public function __construct($storeId = null)
    {
       $this->initDB();
        if (!empty($storeId)) {
            $this->select($storeId);
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
        $sql =  "SELECT * FROM store WHERE tar_id=:tar_id";
        $stmt=$db->prepare($sql);
        $stmt->bindParam("tar_id",$tarId);
        $stmt->execute();

           $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->storeId = $rowObject->store_id;
            @$this->storeName = $rowObject->store_name;
            @$this->tarId = $rowObject->tar_id;
            @$this->posId = $rowObject->pos_id;
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
        $sql =  "SELECT * FROM store WHERE status=:status";
        $stmt=$db->prepare($sql);
        $stmt->bindParam("status",$status);
        $stmt->execute();

           $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->storeId = $rowObject->store_id;
            @$this->storeName = $rowObject->store_name;
            @$this->tarId = $rowObject->tar_id;
            @$this->status = $rowObject->status;

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

    public function insert()
    {
         $db = $this->dbase;
            try
            {
        $sql ="INSERT INTO `store`(`store_name`, `tar_id`, `status`) VALUES (?,?,?)";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$this->storeName);
        $stmt->bindValue(2,$this->tarId);
        $stmt->bindValue(3,$this->status);

        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function update($storeId)
    {
        $db = $this->dbase;
            try
            {
        $sql ="UPDATE `store` SET `store_name`=?,`tar_id`=?,`status`=? WHERE store_id=?";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$this->storeName);
        $stmt->bindValue(2,$this->tarId);
        $stmt->bindValue(3,$this->status);
        $stmt->bindValue(4,$storeId);

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
