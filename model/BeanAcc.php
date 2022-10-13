<?php
include_once("dbconnect.php");

class BeanAcc extends dbconnect
{
    private $accId;
    private $accName;
    

    public function setAccId($accId)
    {
        $this->accId = (int)$accId;
    }
    public function setAccName($accName)
    {
        $this->accName = (string)$accName;
    }

    public function getAccId()
    {
        return $this->accId;
    }

    public function getAccName()
    {
        return $this->accName;
    }

    
    public function getTableName()
    {
        return "acc";
    }

    public function __construct($accId = null)
    {
        $this->initDB();
        if (!empty($accId)) {
            $this->select($accId);
        }
    }

    public function select_all()
    {
    $db = $this->dbase;
    try
    {
        $stmt = $db->prepare("SELECT * FROM acc");
        $stmt->execute();
        $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $stat;
    }
    catch(PDOException $ex)
    {
        return $ex;
    }
    }

 public function select_all_srch_acc($keyword)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM acc where acc_name like '%".$keyword."%' order by acc_name");
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_nb_acc($accName)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM acc where acc_name=?");
 $stmt->bindValue(1,$accName);
 $stmt->execute();
 $stat = $stmt->rowCount();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

    public function select($accId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM acc WHERE acc_id=?";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$accId);
        $stmt->execute();
            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->accId = $rowObject->acc_id;
            @$this->accName= $rowObject->acc_name;
            return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_status($status)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM acc WHERE status=?";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$status);
        $stmt->execute();
            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->accId = $rowObject->acc_id;
            @$this->accName= $rowObject->acc_name;
            return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function delete($accId)
    {
        $db = $this->dbase;
        try
        {
        $sql = "DELETE FROM acc WHERE acc_id=?";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$accId);
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
        $sql ="INSERT INTO acc
            (acc_name)
            VALUES(?)";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$this->accName);
        
        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function update($accId)
    {
        $db = $this->dbase;
            try
            {
        $sql ="UPDATE acc SET acc_name=? WHERE acc_id=?";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$this->accName);
        $stmt->bindValue(2,$accId);

        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function updateCurrent()
    {
        if ($this->accId != "") {
            return $this->update($this->accId);
        } else {
            return false;
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


}
?>
