<?php
require_once("dbconnect.php");



class BeanLocationFact extends dbconnect
{

    private $locId;
    private $locNum;
    private $opId;
    private $locRed;
    private $locTva;

    public function setLocId($locId)
    {
        $this->locId = $locId;
    }
    public function setLocNum($locNum)
    {
        $this->locNum = $locNum;
    }

    public function setOpId($opId)
    {
        $this->opId = (int)$opId;
    }

    public function setLocRed($locRed)
    {
        $this->locRed = $locRed;
    }

    public function getLocId()
    {
        return $this->locId;
    }

    public function getLocNum()
    {
        return $this->locNum;
    }

    public function getOpId()
    {
        return $this->opId;
    }

    public function getLocRed()
    {
        return $this->locRed;
    }

    public function getLocTva()
    {
        return $this->locTva;
    }

    public function getTableName()
    {
        return "location_fact";
    }

    public function __construct($locId = null)
    {
         $this->initDB();
        if (!empty($locId)) {
            $this->select($locId);
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

    public function select($opId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM location_fact WHERE op_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$opId);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->locId = $rowObject->loc_id;
            @$this->locNum = $rowObject->loc_num;
            @$this->opId = $rowObject->op_id;
            @$this->fromD = $rowObject->from_d;
            @$this->toD = $rowObject->to_d;
            @$this->chambId = $rowObject->chamb_id;
            @$this->locEtat = $rowObject->loc_etat;
            @$this->locRed = $rowObject->loc_red;
            @$this->locTva = $rowObject->loc_tva;
            return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    
 public function select_all()
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM location_fact");
 //$stmt->bindParam("id",$opId);
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
 $stmt = $db->prepare("SELECT max(loc_id) as last_num FROM location_fact");
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }


    public function delete($opId)
{
        $db = $this->dbase;
            try
            {
        $sql = "DELETE FROM location_fact WHERE op_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$opId);
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
            INSERT INTO location_fact
            (op_id,loc_num)
            VALUES(:opId,:locNum)";

        $stmt = $db->prepare($sql);
        
        $stmt->bindParam("opId",$this->opId);
        $stmt->bindParam("locNum",$this->locNum);
        
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
        if ($this->idachats != "") {
            return $this->update($this->idachats);
        } else {
            return false;
        }
    }

public function dateDiff($start, $end) {

$start_ts = strtotime($start);

$end_ts = strtotime($end);

$diff = $end_ts - $start_ts;

return round($diff / 86400);

}

}
?>
