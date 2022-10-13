<?php
include_once("dbconnect.php");
class BeanPeriode extends dbconnect
{

    private $idPer;
    private $codePer;
    private $debut;
    private $fin;
    private $etat;
    private $crt;

    public function setIdPer($idPer)
    {
        $this->idPer = (int)$idPer;
    }

    public function setCodePer($codePer)
    {
        $this->codePer = (string)$codePer;
    }
    public function setDebut($debut)
    {
        $this->debut = (string)$debut;
    }
    public function setFin($fin)
    {
        $this->fin = (string)$fin;
    }
    public function setEtat($etat)
    {
        $this->etat = (string)$etat;
    }
    public function setCrt($crt)
    {
        $this->crt = (string)$crt;
    }
    public function getIdPer()
    {
        return $this->idPer;
    }

    public function getCodePer()
    {
        return $this->codePer;
    }
    public function getDebut()
    {
        return $this->debut;
    }
    public function getFin()
    {
        return $this->fin;
    }
    public function getEtat()
    {
        return $this->etat;
    }

    public function getCrt()
    {
        return $this->crt;
    }
    public function getTableName()
    {
        return "periode";
    }
    public function __construct($idPer=NULL,$codePer=NULL)
    {
       $this->initDB();
        if (!empty($idPer)) {
            $this->select($idPer);
        }
    }

    public function select_all()
    {
    $db = $this->dbase;
    try
    {
        $stmt = $db->prepare("SELECT * FROM periode");
        $stmt->execute();
        $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $stat;
    }
    catch(PDOException $ex)
    {
        return $ex;
    }
    }

    public function select($idPer)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM periode WHERE id_per=?";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$idPer);
        $stmt->execute();
            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->idPer = $rowObject->id_per;
            @$this->codePer = $rowObject->code_per;
            @$this->debut = $rowObject->debut;
            @$this->fin = $rowObject->fin;
            @$this->etat = $rowObject->etat;
            @$this->crt = $rowObject->crt;
        return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_crt($crt)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM periode WHERE crt=?";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$crt);
        $stmt->execute();
            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->idPer = $rowObject->id_per;
            @$this->codePer = $rowObject->code_per;
            @$this->debut = $rowObject->debut;
            @$this->fin = $rowObject->fin;
            @$this->etat = $rowObject->etat;
            @$this->crt = $rowObject->crt;
        return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function delete($idPer)
    {
        $db = $this->dbase;
        try
        {
        $sql = "DELETE FROM periode WHERE id_per=?";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$idPer);
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
        $sql ="INSERT INTO periode (code_per,debut,crt) VALUES(?,?,?)";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$this->codePer);
        $stmt->bindValue(2,$this->debut);
        //$stmt->bindValue(3,$this->fin);
        $stmt->bindValue(3,$this->crt);

        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function update($idPer)
    {
        $db = $this->dbase;
            try
            {
        $sql ="UPDATE periode SET code_per=?,debut=?,crt=? WHERE id_per=?";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$this->codePer);
        $stmt->bindValue(2,$this->debut);
        //$stmt->bindValue(3,$this->fin);
        $stmt->bindValue(3,$this->crt);
        $stmt->bindValue(4,$idPer);

        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function updateCurrent()
    {
        if (!empty($this->idPer)) {
           return $this->update($this->idPer);
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
                crt =:val_f";

            $stmt = $db->prepare($sql);
            $stmt->bindParam("val_f",$val_f);
            return (bool)$stmt->execute();
            }
        catch(PDOException $ex)
            {
                 return $ex;
            }

        }

 public function exist_per($idPer)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM operation where id_per=:idPer");
 $stmt->bindParam("idPer",$idPer);
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
