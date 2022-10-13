<?php
require_once("dbconnect.php");



class BeanLocation extends dbconnect
{

    private $locId;
    private $opId;
    private $chambId;
    private $fromD;
    private $toD;
    private $locEtat;
    private $locPrice;
    private $locType;
    private $locRed;
    

    public function setLocId($locId)
    {
        $this->locId = $locId;
    }

    public function setLocPrice($locPrice)
    {
        $this->locPrice = $locPrice;
    }

    public function setLocRed($locRed)
    {
        $this->locRed = $locRed;
    }
    
    public function setFromD($fromD)
    {
        $this->fromD = $fromD;
    }

    public function setOpId($opId)
    {
        $this->opId = (int)$opId;
    }

    public function setChambId($chambId)
    {
        $this->chambId = $chambId;
    }

    public function setToD($toD)
    {
        $this->toD = $toD;
    }

    public function getLocId()
    {
        return $this->locId;
    }

    public function getLocEtat()
    {
        return $this->locEtat;
    }

    public function getLocPrice()
    {
        return $this->locPrice;
    }

    public function getLocType()
    {
        return $this->locType;
    }

    public function getLocRed()
    {
        return $this->locRed;
    }

    public function getFromD()
    {
        return $this->fromD;
    }

    public function getOpId()
    {
        return $this->opId;
    }

    public function getChambId()
    {
        return $this->chambId;
    }

    public function getToD()
    {
        return $this->toD;
    }

    public function getTableName()
    {
        return "location";
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

    public function select($locId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM location WHERE loc_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$locId);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->locId = $rowObject->loc_id;
            @$this->opId = $rowObject->op_id;
            @$this->fromD = $rowObject->from_d;
            @$this->toD = $rowObject->to_d;
            @$this->chambId = $rowObject->chamb_id;
            @$this->locEtat = $rowObject->loc_etat;
            @$this->locPrice = $rowObject->loc_price;
            @$this->locType = $rowObject->loc_type;
            @$this->locRed = $rowObject->loc_red;
            return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_chamb($chambId,$locEtat)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT location.* FROM location WHERE chamb_id=:id and loc_etat=:etat and loc_type='Location'";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$chambId);
        $stmt->bindParam("etat",$locEtat);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->locId = $rowObject->loc_id;
            @$this->opId = $rowObject->op_id;
            @$this->fromD = $rowObject->from_d;
            @$this->toD = $rowObject->to_d;
            @$this->chambId = $rowObject->chamb_id;
            @$this->locEtat = $rowObject->loc_etat;
            @$this->locPrice = $rowObject->loc_price;
            @$this->locType = $rowObject->loc_type;
            @$this->locRed = $rowObject->loc_red;
          
            return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_chamb_2($opId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT location.* FROM location WHERE op_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$opId);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->locId = $rowObject->loc_id;
            @$this->opId = $rowObject->op_id;
            @$this->fromD = $rowObject->from_d;
            @$this->toD = $rowObject->to_d;
            @$this->chambId = $rowObject->chamb_id;
            @$this->locEtat = $rowObject->loc_etat;
            @$this->locPrice = $rowObject->loc_price;
            @$this->locType = $rowObject->loc_type;
            @$this->locRed = $rowObject->loc_red;
          
            return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_op_cli($personneId,$locEtat)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT location.* FROM 
    operation join location on operation.op_id=location.op_id WHERE party_code=:id and loc_etat=:etat";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$personneId);
        $stmt->bindParam("etat",$locEtat);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->opId = $rowObject->op_id;
            return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_op_cli_2($personneId,$locEtat)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT location.* FROM 
    operation join location on operation.op_id=location.op_id WHERE party_code=:id and loc_etat=:etat";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$personneId);
        $stmt->bindParam("etat",$locEtat);
        $stmt->execute();
        return $stmt->fetch();
           
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
 $stmt = $db->prepare("SELECT * FROM location where op_id=:id");
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

 public function select_all_current($locEtat)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT Distinct operation.*,location.* FROM 
    operation join location on operation.op_id=location.op_id 
    where loc_etat=:locEtat");
 $stmt->bindParam("locEtat",$locEtat);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_current_chamb($chambId,$locEtat)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * from location where loc_etat=:locEtat and chamb_id=:chambId");
 $stmt->bindParam("locEtat",$locEtat);
 $stmt->bindParam("chambId",$chambId);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 
    public function delete($locId)
{
        $db = $this->dbase;
            try
            {
        $sql = "DELETE FROM location WHERE loc_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$locId);
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
            INSERT INTO location
            (op_id,chamb_id,loc_price,from_d,to_d)
            VALUES(:opId,:chambId,:locPrice,:fromD,:toD)";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("chambId",$this->chambId);
        $stmt->bindParam("opId",$this->opId);
        $stmt->bindParam("locPrice",$this->locPrice);
        $stmt->bindParam("fromD",$this->fromD);
        $stmt->bindParam("toD",$this->toD);
        $stmt->execute();
        return $db->lastInsertId();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function update($opId)
    {
        $db = $this->dbase;
            try
            {
            $sql ="
            UPDATE
                location
            SET
				from_d=:fromD,
                to_d=:toD
            WHERE
                op_id=:opId";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("fromD",$this->fromD);
        $stmt->bindParam("toD",$this->toD);
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

public function exist_loc($chambId,$dateLoc)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM location  where chamb_id=:chambId and (from_d<=:dateLoc and to_d>=:dateLoc) and loc_etat='1'");
 $stmt->bindParam("chambId",$chambId);
 $stmt->bindParam("dateLoc",$dateLoc);
 //$stmt->bindParam("to_d",$to_d);
 $stmt->execute();
 $stat = $stmt->rowCount();

 if($stat>=1)
 return true;
 else
 return false;

 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function exist_chamb_2($table)
{

$db = $this->dbase;
            try
            {
$sql="SELECT * from location join operation on location.op_id=operation.op_id  where loc_etat='1' and chamb_id=:table";
$stmt = $db->prepare($sql);
$stmt->bindParam("table",$table);
$stmt->execute();
$res=$stmt->rowCount();
if($res==1) return true; else return false;
//return $res;
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
}

 public function select_all_by_period_loc($from_d,$to_d)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM location  where  (date(from_d)
    between :from_d and :to_d) or (date(to_d)
    between :from_d and :to_d) order by from_d");
 $stmt->bindParam("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 

}
?>
