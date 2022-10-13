<?php
include_once("dbconnect.php");

class BeanAutreInfo extends dbconnect
{
    private $idInfo;
    private $affilie;
    private $benef;
    private $nomBenef;
    private $anneBenef;
    private $service;
    private $numBon;
    private $mat;
    private $idvente;

    public function setIdInfo($idInfo)
    {
        $this->idInfo = (int)$idInfo;
    }

    public function setAffilie($affilie)
    {
        $this->affilie = (string)$affilie;
    }

    public function setBenef($benef)
    {
        $this->benef = (string)$benef;
    }

    public function setNomBenef($nomBenef)
    {
        $this->nomBenef = $nomBenef;
    }

    public function setAnneBenef($anneBenef)
    {
        $this->anneBenef = $anneBenef;
    }

    public function setService($service)
    {
        $this->service = (string)$service;
    }

    public function setNumBon($numBon)
    {
        $this->numBon = (string)$numBon;
    }

    public function setMat($mat)
    {
        $this->mat = (string)$mat;
    }

    public function setIdvente($idvente)
    {
        $this->idvente = (int)$idvente;
    }

    public function getIdInfo()
    {
        return $this->idInfo;
    }

    public function getAffilie()
    {
        return $this->affilie;
    }

    public function getBenef()
    {
        return $this->benef;
    }

    public function getNomBenef()
    {
        return $this->nomBenef;
    }

    public function getAnneBenef()
    {
        return $this->anneBenef;
    }

    public function getService()
    {
        return $this->service;
    }

    public function getNumBon()
    {
        return $this->numBon;
    }

    public function getMat()
    {
        return $this->mat;
    }

    public function getIdvente()
    {
        return $this->idvente;
    }


    public function getTableName()
    {
        return "autre_info";
    }


    public function __construct($idInfo = null)
    {
        $this->initDB();
        if (!empty($idInfo)) {
            $this->select($idInfo);
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


    public function select($idvente)
    {
         $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM autre_info WHERE idvente=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$idvente);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->idInfo = $rowObject->id_info;
            @$this->affilie = $rowObject->affilie;
            @$this->benef = $rowObject->benef;
            @$this->service = $rowObject->service;
            @$this->numBon = $rowObject->num_bon;
            @$this->mat = $rowObject->mat;
            @$this->idvente = $rowObject->idvente;
            return $stmt->rowCount();
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
            INSERT INTO autre_info
            (affilie,benef,nom_benef,anne_benef,service,num_bon,mat,idvente)
            VALUES(:affilie,:benef,:nomBenef,:anneBenef,:service,:numBon,:mat,:idvente)";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("affilie",$this->affilie);
        $stmt->bindParam("benef",$this->benef);
        $stmt->bindParam("nomBenef",$this->nomBenef);
        $stmt->bindParam("anneBenef",$this->anneBenef);
        $stmt->bindParam("service",$this->service);
        $stmt->bindParam("numBon",$this->numBon);
        $stmt->bindParam("mat",$this->mat);
        $stmt->bindParam("idvente",$this->idvente);
        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function update($idvente)
    {
        $db = $this->dbase;
            try
            {
        $sql ="
            UPDATE
                autre_info
            SET
				affilie=:affilie,
				benef=:benef,
                anne_benef=:anneBenef,
                nom_benef=:nomBenef,
				service=:service,
				num_bon=:numBon,
				mat=:mat
            WHERE
                idvente=:idvente";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("affilie",$this->affilie);
        $stmt->bindParam("benef",$this->benef);
        $stmt->bindParam("nomBenef",$this->nomBenef);
        $stmt->bindParam("anneBenef",$this->anneBenef);
        $stmt->bindParam("service",$this->service);
        $stmt->bindParam("numBon",$this->numBon);
        $stmt->bindParam("mat",$this->mat);
        $stmt->bindParam("idvente",$idvente);
        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }

    }


    public function updateCurrent()
    {
        if ($this->idInfo != "") {
            return $this->update($this->idInfo);
        } else {
            return false;
        }
    }

    // select all rows from tables;

 public function select_num_row($idvente)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM autre_info where idvente=:id");
 $stmt->bindParam("id",$idvente);
 $stmt->execute();
 $stat = $stmt->rowCount();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

}
?>
