<?php
include_once("dbconnect.php");

class BeanCustomer extends dbconnect
{

    private $customerId;
    private $customerName;
    private $customerCode;
    private $personneId;
    private $actif;
    private $customerAdr;
    private $customerNum;

    public function setCustomerId($customerId)
    {
        $this->customerId = (int)$customerId;
    }

    public function setActif($actif)
    {
        $this->actif = $actif;
    }

    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
    }

    public function setCustomerCode($customerCode)
    {
        $this->customerCode = $customerCode;
    }

    public function setCustomerNum($customerNum)
    {
        $this->customerNum = $customerNum;
    }

    public function setCustomerAdr($customerAdr)
    {
        $this->customerAdr = $customerDef;
    }

    public function setPersonneId($personneId)
    {
        $this->personneId = (int)$personneId;
    }

    public function getCustomerId()
    {
        return $this->customerId;
    }
    public function getActif()
    {
        return $this->actif;
    }
    public function getCustomerName()
    {
        return $this->customerName;
    }

    public function getCustomerCode()
    {
        return $this->customerCode;
    }

    public function getCustomerNum()
    {
        return $this->customerNum;
    }

    public function getCustomerAdr()
    {
        return $this->customerAdr;
    }

    public function getPersonneId()
    {
        return $this->personneId;
    }

    public function getTableName()
    {
        return "customer";
    }

    public function __construct($customerId = null)
    {
       $this->initDB();
        if (!empty($customerId)) {
            $this->select($customerId);
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

    public function select($personneId)
    {
        $db=$this->dbase;

        try
        {
        $sql =  "SELECT * FROM customer WHERE personne_id=:personne_id";
        $stmt=$db->prepare($sql);
        $stmt->bindParam("personne_id",$personneId);
        $stmt->execute();

           $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->customerId = $rowObject->customer_id;
            @$this->customerName = $rowObject->customer_name;
            @$this->customerCode = $rowObject->customer_code;
            @$this->customerNum = $rowObject->customer_num;
            @$this->customerAdr = $rowObject->customer_adr;
            @$this->personneId = $rowObject->personne_id;
            @$this->actif = $rowObject->actif;

       return $stmt->rowCount();

        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_code($customerCode)
    {
        $db=$this->dbase;

        try
        {
        $sql =  "SELECT * FROM customer WHERE customer_code=:customerCode";
        $stmt=$db->prepare($sql);
        $stmt->bindParam("customerCode",$customerCode);
        $stmt->execute();

           $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->customerId = $rowObject->customer_id;
            @$this->customerName = $rowObject->customer_name;
            @$this->customerCode = $rowObject->customer_code;
            @$this->customerNum = $rowObject->customer_num;
            @$this->customerAdr = $rowObject->customer_adr;
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

public function exist_code($customerCode)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM customer where customer_code=:customerCode");
 $stmt->bindParam("customerCode",$customerCode);
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
