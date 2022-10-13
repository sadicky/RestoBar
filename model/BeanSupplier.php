<?php
include_once("dbconnect.php");

class BeanSupplier extends dbconnect
{

    private $supplierId;
    private $supplierName;
    private $supCode;
    private $supNif;
    private $supContact;
    private $supNat;
    private $personneId;
    private $actif;


    public function setSupplierId($supplierId)
    {
        $this->supplierId = (int)$supplierId;
    }

    public function setSupplierName($supplierName)
    {
        $this->supplierName = (string)$supplierName;
    }

    public function setSupCode($supCode)
    {
        $this->supCode = $supCode;
    }

    public function setSupNif($supNif)
    {
        $this->supNif = $supNif;
    }

    public function setSupContact($supContact)
    {
        $this->supContact = $supContact;
    }

    public function setSupNat($supNat)
    {
        $this->supNat = $supNat;
    }

    public function setPersonneId($personneId)
    {
        $this->personneId = (int)$personneId;
    }

    public function setActif($actif)
    {
        $this->actif = $actif;
    }

    public function getSupplierId()
    {
        return $this->supplierId;
    }

    public function getSupplierName()
    {
        return $this->supplierName;
    }

    public function getSupCode()
    {
        return $this->supCode;
    }

    public function getSupNif()
    {
        return $this->supNif;
    }
    public function getSupContact()
    {
        return $this->supContact;
    }
    public function getSupNat()
    {
        return $this->supNat;
    }

    public function getPersonneId()
    {
        return $this->personneId;
    }
    public function getActif()
    {
        return $this->actif;
    }

    public function getTableName()
    {
        return "supplier";
    }


    public function __construct($supplierId = null)
    {
        $this->initDB();
        if (!empty($supplierId)) {
            $this->select($supplierId);
        }
    }

    /**
     * The implicit destructor
     */
    public function __destruct()
    {
        $this->close();
    }

    /**
     * Explicit destructor. It calls the implicit destructor automatically.
     */
    public function close()
    {
        //unset($this);
    }

    public function select($personneId)
    {
        $db=$this->dbase;

        try
        {
        $sql =  "SELECT * FROM supplier WHERE personne_id=:personne_id";
        $stmt=$db->prepare($sql);
        $stmt->bindParam("personne_id",$personneId);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->supplierId = $rowObject->supplier_id;
            @$this->supplierName = $rowObject->supplier_name;
            @$this->supCode = $rowObject->sup_code;
            @$this->supContact = $rowObject->sup_contact;
            @$this->supNif = $rowObject->sup_nif;
            @$this->supNat = $rowObject->sup_nat;
            @$this->personneId = $rowObject->personne_id;
            @$this->actif = $rowObject->actif;

        return $stmt->rowCount();

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

public function exist_code($supCode)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM supplier where sup_code=:supCode");
 $stmt->bindParam("supCode",$supCode);
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
