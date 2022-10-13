<?php
include_once("dbconnect.php");

class BeanBanque extends dbconnect
{
    private $idBq;
    private $libBq;
    private $status;

    public function setIdBq($idBq)
    {
        $this->idBq = (int)$idBq;
    }
    public function setLibBq($libBq)
    {
        $this->libBq = (string)$libBq;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getIdBq()
    {
        return $this->idBq;
    }

    public function getLibBq()
    {
        return $this->libBq;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getTableName()
    {
        return "banque";
    }

    public function __construct($idBq = null)
    {
        $this->initDB();
        if (!empty($idBq)) {
            $this->select($idBq);
        }
    }

    public function select_all()
    {
    $db = $this->dbase;
    try
    {
        $stmt = $db->prepare("SELECT * FROM banque");
        $stmt->execute();
        $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $stat;
    }
    catch(PDOException $ex)
    {
        return $ex;
    }
    }

    public function select($idBq)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM banque WHERE id_bq=?";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$idBq);
        $stmt->execute();
            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->idBq = $rowObject->id_bq;
            @$this->libBq= $rowObject->lib_bq;
            @$this->status= $rowObject->status;
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
        $sql =  "SELECT * FROM banque WHERE status=?";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$status);
        $stmt->execute();
            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->idBq = $rowObject->id_bq;
            @$this->libBq= $rowObject->lib_bq;
            @$this->status= $rowObject->status;
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
        $sql ="INSERT INTO banque
            (lib_bq,status)
            VALUES(?,?)";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$this->libBq);
        $stmt->bindValue(2,$this->status);

        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function update($idBq)
    {
        $db = $this->dbase;
            try
            {
        $sql ="UPDATE banque SET lib_bq=?, status=? WHERE id_bq=?";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$this->libBq);
        $stmt->bindValue(2,$this->status);
        $stmt->bindValue(3,$idBq);

        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function updateCurrent()
    {
        if ($this->idBq != "") {
            return $this->update($this->idBq);
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

public function exist_bq($bq)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM transactions id_bq=:bq");
 $stmt->bindParam("bq",$bq);
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
