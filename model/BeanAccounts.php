<?php
require_once("dbconnect.php");

// namespace beans;

class BeanAccounts extends dbconnect
{

    private $accId;
    private $status;
    private $balPaid;
    private $balCash;
    private $lastUpdate;
    private $personneId;



    public function setAccId($accId)
    {
        $this->accId = (int)$accId;
    }

    public function setStatus($status)
    {
        $this->status= (int)$status;
    }


    public function setBalPaid($balPaid)
    {
        $this->balPaid = (int)$balPaid;
    }

    public function setBalCash($balCash)
    {
        $this->balCash = (string)$balCash;
    }

    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = (string)$lastUpdate;
    }

    public function setPersonneId($personneId)
    {
        $this->personneId = (int)$personneId;
    }


    public function getAccId()
    {
        return $this->accId;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function getBalPaid()
    {
        return $this->balPaid;
    }

    public function getBalCash()
    {
        return $this->balCash;
    }

    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    public function getPersonneId()
    {
        return $this->personneId;
    }



    public function getDdl()
    {
        return base64_decode($this->ddl);
    }


    public function __construct($accId = null)
    {
        $this->initDB();
        if (!empty($accId)) {
            $this->select($accId);
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
    public function getTableName()
    {
        return "accounts";
    }

    public function select($personneId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM accounts WHERE personne_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$personneId);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->accId = $rowObject->acc_id;
            @$this->balPaid = $rowObject->bal_paid;
            @$this->balCash = $rowObject->bal_cash;
            @$this->lastUpdate = $rowObject->last_update;

            @$this->personneId = $rowObject->personne_id;
            @$this->status = $rowObject->status;


            return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }

    }

    public function select_acc_perso($personneId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM accounts WHERE personne_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$personneId);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->accId = $rowObject->acc_id;
            @$this->balPaid = $rowObject->bal_paid;
            @$this->balCash = $rowObject->bal_cash;
            @$this->lastUpdate = $rowObject->last_update;

            @$this->personneId = $rowObject->personne_id;
            @$this->status = $rowObject->status;


            return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }

    }




 public function select_all(){
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT personne.*, accounts.* FROM personne join accounts on personne.personne_id=accounts.personne_id");
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_role($role){
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT personne.*, accounts.* FROM personne join accounts on personne.personne_id=accounts.personne_id where role=:role order by nom_complet");
 $stmt->bindParam("role",$role);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_num_role($role){
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT personne.*, accounts.* FROM personne join accounts on personne.personne_id=accounts.personne_id where role=:role");
 $stmt->bindParam("role",$role);
 $stmt->execute();
 $stat = $stmt->rowCount();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }


 public function exist_acc_perso($personne_id){
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT count(*) as nb FROM accounts where personne_id=:personne_id");
  $stmt->bindParam("personne_id",$personne_id);
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat;
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
        $sql = "DELETE FROM accounts WHERE acc_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$accId);
        return (bool)$stmt->execute();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }

    }

    public function insert($personneId)
    {

        $db = $this->dbase;
            try
            {
         $sql = "INSERT INTO accounts
            (personne_id)
            VALUES(:personne_id)";
            $stmt = $db->prepare($sql);
            //$stmt->bindParam("bal_paid",$this->balPaid);
            //$stmt->bindParam("bal_cash",$this->balCash);
            //$stmt->bindParam("last_update",$this->lastUpdate);
            $stmt->bindParam("personne_id",$personneId);


            return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }


    public function update_paid($personneId)
    {


        $db = $this->dbase;
            try
            {
            $sql ="
            UPDATE
                accounts
            SET
				bal_paid=:bal_paid
            WHERE
                personne_id=:personneId";

            $stmt = $db->prepare($sql);
            $stmt->bindParam("bal_paid",$this->balPaid);
            $stmt->bindParam("personneId",$personneId);

            return (bool)$stmt->execute();


            }
        catch(PDOException $ex)
            {
                 return $ex;
            }

        }

        public function update_cash($personneId)
    {


        $db = $this->dbase;
            try
            {
            $sql ="
            UPDATE
                accounts
            SET
                bal_cash=:bal_cash
            WHERE
                personne_id=:personneId";

            $stmt = $db->prepare($sql);
            $stmt->bindParam("bal_cash",$this->balCash);
            $stmt->bindParam("personneId",$personneId);

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



    public function updateCurrent()
    {
        if ($this->accId != "") {
            return $this->update($this->accId);
        } else {
            return false;
        }
    }



}
?>
