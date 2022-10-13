<?php
include_once("dbconnect.php");

class BeanJournal extends dbconnect
{

    private $jourId;
    private $personneId;
    private $openBal;
    private $closingBal;
    private $startDate;
    private $endDate;
    private $jourState;

    public function setJourId($jourId)
    {
        $this->jourId = $jourId;
    }

    public function setPersonneId($personneId)
    {
        $this->personneId = $personneId;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = (string)$startDate;
    }

    public function setEndDate($endDate)
    {
        $this->endDate = (string)$endDate;
    }

    public function setJourState($jourState)
    {
        $this->jourState = (string)$jourState;
    }

    public function setOpenBal($openBal)
    {
        $this->openBal = $openBal;
    }

    public function setClosingBal($closingBal)
    {
        $this->closingBal = $closingBal;
    }


    public function getJourId()
    {
        return $this->jourId;
    }

    public function getPersonneId()
    {
        return $this->personneId;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function getJourState()
    {
        return $this->jourState;
    }

    public function getOpenBal()
    {
        return $this->openBal;
    }

    public function getClosingBal()
    {
        return $this->closingBal;
    }

    public function getTableName()
    {
        return "journal";
    }

    public function __construct($jourId = null)
    {
        $this->initDb();
        if (!empty($jourId)) {
            $this->select($jourId);
        }
    }


    public function select($jourId)
    {
        $db = $this->dbase;
        try
        {
            $sql =  "SELECT * FROM journal WHERE jour_id=:id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("id",$jourId);
            $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->jourId = $rowObject->jour_id;
            @$this->personneId = $rowObject->personne_id;
            @$this->startDate = $rowObject->start_date;
            @$this->endDate = $rowObject->end_date;
            @$this->jourState = $rowObject->jour_state;
            @$this->openBal = $rowObject->open_bal;
            @$this->closingBal = $rowObject->closing_bal;


            return $stmt->rowCount();
        }
        catch(PDOException $ex)
        {
            return $ex;
        }
    }

    public function select_all_by_date($date_from,$date_to)
    {
        $db = $this->dbase;
        try
        {
            $stmt = $db->prepare("SELECT * FROM journal WHERE jour_state='0' and (date(start_date) between ? and ?)");
            $stmt->bindValue(1,$date_from);
            $stmt->bindValue(2,$date_to);
            $stmt->execute();
            $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $stat;
        }
        catch(PDOException $ex)
        {
            return $ex;
        }
    }

public function select_all_last_15()
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT *, date(start_date) as jr_date FROM journal  order by start_date desc limit 0,15");
 //$stmt->bindValue(1,$personneId);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }


    public function select_by_state($personneId)
    {
        $db = $this->dbase;
        try
        {
            $stmt = $db->prepare("SELECT * FROM journal WHERE personne_id=? and jour_state='1'");
            $stmt->bindValue(1,$personneId);
            $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->jourId = $rowObject->jour_id;
            @$this->personneId = $rowObject->personne_id;
            @$this->startDate = $rowObject->start_date;
            @$this->endDate = $rowObject->end_date;
            @$this->jourState = $rowObject->jour_state;
            @$this->openBal = $rowObject->open_bal;
            @$this->closingBal = $rowObject->closing_bal;

            return $stmt->rowCount();
        }
        catch(PDOException $ex)
        {
            return $ex;
        }
    }

public function select_open()
    {
        $db = $this->dbase;
        try
        {
            $stmt = $db->prepare("SELECT * FROM journal WHERE jour_state='1'");
            //$stmt->bindValue(1,$personneId);
            $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->jourId = $rowObject->jour_id;
            @$this->personneId = $rowObject->personne_id;
            @$this->startDate = $rowObject->start_date;
            @$this->endDate = $rowObject->end_date;
            @$this->jourState = $rowObject->jour_state;
            @$this->openBal = $rowObject->open_bal;
            @$this->closingBal = $rowObject->closing_bal;

            return $stmt->rowCount();
        }
        catch(PDOException $ex)
        {
            return $ex;
        }
    }



    public function delete($jourId)
    {
        $db = $this->dbase;
        try
        {
            $sql = "DELETE FROM journal WHERE jour_id=:id";
            $$stmt = $db->prepare($sql);
            $stmt->bindParam("id",$jourId);
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
            INSERT INTO journal
            (personne_id,open_bal,start_date)
            VALUES(?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(1,$this->personneId);
            $stmt->bindValue(2,$this->openBal);
            $stmt->bindValue(3,$this->startDate);
            
            $stmt->execute();
            return $db->lastInsertId();
        }
        catch(PDOException $ex)
        {
            return $ex;
        }
    }

    public function update($personneId)
    {
        $db = $this->dbase;
        try
        {
            $sql = "
            UPDATE journal SET closing_bal=?,end_date=now(),jour_state='0' WHERE personne_id=? and jour_state='1'";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(1,$this->closingBal);
            $stmt->bindValue(2,$personneId);

            return (bool)$stmt->execute();
        }
        catch(PDOException $ex)
        {
            return $ex;
        }
    }


    public function select_last_jour($personneId)
    {
        $db = $this->dbase;
        try
        {
            $sql =  "SELECT max(jour_id) as last_id FROM journal where personne_id=:personneId";
            $stmt = $db->prepare($sql);
            $stmt->bindParam('personneId',$personneId);
            $stmt->execute();
            $res=$stmt->fetch();
            return $res;
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

    public function update_state($jourState1,$jourState2,$personneId)
    {
        $db = $this->dbase;
        try
        {
            $sql = "
            UPDATE journal SET jour_state=? WHERE jour_state=? and personne_id=?";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(1,$jourState1);
            $stmt->bindValue(2,$jourState2);
            $stmt->bindValue(3,$personneId);

            return (bool)$stmt->execute();
        }
        catch(PDOException $ex)
        {
            return $ex;
        }
    }

    public function exist_jour($personneId)
    {
        $db = $this->dbase;
        try
        {
            $stmt = $db->prepare("SELECT * FROM journal where personne_id=:personneId and jour_state='1'");
            $stmt->bindParam("personneId",$personneId);
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
