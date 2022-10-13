<?php
include_once("dbconnect.php");

class BeanTypeDep extends dbconnect
{
    private $idTyp;
    private $libTyp;

    public function setIdTyp($idTyp)
    {
        $this->idTyp = (int)$idTyp;
    }
    public function setLibTyp($libTyp)
    {
        $this->libTyp = (string)$libTyp;
    }

    public function getIdTyp()
    {
        return $this->idTyp;
    }

    public function getLibTyp()
    {
        return $this->libTyp;
    }

    public function getTableName()
    {
        return "type_dep";
    }

    public function __construct($idTyp = null)
    {
        $this->initDB();
        if (!empty($idTyp)) {
            $this->select($idTyp);
        }
    }

    public function select_all()
    {
    $db = $this->dbase;
    try
    {
        $stmt = $db->prepare("SELECT * FROM type_dep order by lib_typ");
        $stmt->execute();
        $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $stat;
    }
    catch(PDOException $ex)
    {
        return $ex;
    }
    }

    public function select($idTyp)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM type_dep WHERE id_typ=?";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$idTyp);
        $stmt->execute();
            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->idTyp = $rowObject->id_typ;
            @$this->libTyp= $rowObject->lib_typ;
            return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function delete($idTyp)
    {
        $db = $this->dbase;
        try
        {
        $sql = "DELETE FROM type_dep WHERE id_typ=?";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$idTyp);
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
        $sql ="INSERT INTO type_dep
            (lib_typ)
            VALUES(?)";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$this->libTyp);

        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function update($idTyp)
    {
        $db = $this->dbase;
            try
            {
        $sql ="UPDATE type_dep SET lib_typ=? WHERE id_typ=?";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$this->libTyp);
        $stmt->bindValue(2,$idTyp);

        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function updateCurrent()
    {
        if ($this->idTyp != "") {
            return $this->update($this->idTyp);
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

public function exist_typ($typ)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM depense where typ=:typ");
 $stmt->bindParam("typ",$typ);
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
