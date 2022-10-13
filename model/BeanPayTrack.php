<?php
require_once("dbconnect.php");



class BeanPayTrack extends dbconnect
{

    private $payId;
    private $datePay;
    private $opId;
    private $isPaid;
    private $modePaie;

    public function setPayId($payId)
    {
        $this->payId = (int)$payId;
    }

    public function setDatePay($datePay)
    {
        $this->datePay = $datePay;
    }

    public function setOpId($opId)
    {
        $this->opId = $opId;
    }

    public function setIsPaid($isPaid)
    {
        $this->isPaid = (string)$isPaid;
    }

    public function setModePaie($modePaie)
    {
        $this->modePaie = $modePaie;
    }

    public function getPayId()
    {
        return $this->payId;
    }

    public function getDatePay()
    {
        return $this->datePay;
    }

    public function getOpId()
    {
        return $this->opId;
    }

    public function getIsPaid()
    {
        return $this->isPaid;
    }

    public function getModePaie()
    {
        return $this->modePaie;
    }

    public function getTableName()
    {
        return "pay_track";
    }

    public function __construct($payId = null)
    {
         $this->initDB();
        if (!empty($payId)) {
            $this->select($payId);
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

    public function getWeekdayDifference(\DateTime $startDate, \DateTime $endDate)
    {
    $isWeekday = function (\DateTime $date) {
        return $date->format('N') < 6;
    };

    $days = $isWeekday($endDate) ? 1 : 0;

    while($startDate->diff($endDate)->days > 0) {
        $days += 1;/*$isWeekday($startDate) ? 1 : 0;*/
        $startDate = $startDate->add(new \DateInterval("P1D"));
    }

    return $days;
    }

    public function select($opId,$isPaid)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM pay_track WHERE op_id=:id and is_paid=:isPaid";
        $stmt = $db->prepare($sql);

        $stmt->bindParam("id",$opId);
        $stmt->bindParam("isPaid",$isPaid);

        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->payId = $rowObject->pay_id;
            @$this->datePay = $rowObject->date_pay;
            @$this->opId = $rowObject->op_id;
            @$this->isPaid = $rowObject->is_paid;
            @$this->modePaie = $rowObject->mode_paie;

            return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

public function select_nb_under_min()
    {
        $db = $this->dbase;
        try
        {
        $sql = "SELECT * from pay_track where (to_days(date_pay) - to_days(now()))<='5' and is_paid='0'";
        $stmt = $db->prepare($sql);
        //$stmt->bindParam("posId",$posId);
        $stmt->execute();

        return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

public function select_under_min()
    {
        $db = $this->dbase;
        try
        {
        $sql = "SELECT * from pay_track where (to_days(date_pay) - to_days(now()))<='5' and is_paid='0'";
        $stmt = $db->prepare($sql);
        //$stmt->bindParam("posId",$posId);
        $stmt->execute();

        return $stmt->fetchAll();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }
    // select all rows from tables;

 public function select_all($opId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM pay_track where op_id=:id");
 $stmt->bindParam("id",$opId);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_last_num()
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT max(payId) as last_num FROM pay_track");
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }


    public function delete($payId)
{
        $db = $this->dbase;
            try
            {
        $sql = "DELETE FROM pay_track WHERE payId=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$payId);
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
        $sql ="
            INSERT INTO pay_track
            (date_pay,op_id,mode_paie)
            VALUES(:datePay,:opId,:modePaie)";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("datePay",$this->datePay);
        $stmt->bindParam("opId",$this->opId);
        $stmt->bindParam("modePaie",$this->modePaie);
        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function update($opId,$isPaid)
    {
        $db = $this->dbase;
            try
            {
            $sql ="
            UPDATE
                pay_track
            SET
				date_pay=:datePay,
                mode_paie=:modePaie
            WHERE
                op_id=:opId and is_paid=:isPaid";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("isPaid",$isPaid);
        $stmt->bindParam("datePay",$this->datePay);
        $stmt->bindParam("modePaie",$this->modePaie);
         $stmt->bindParam("opId",$opId);
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
        if ($this->payId != "") {
            return $this->update($this->payId);
        } else {
            return false;
        }
    }

}
?>
