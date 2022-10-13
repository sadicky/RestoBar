<?php
include_once("dbconnect.php");

class BeanPlace extends dbconnect
{

    private $placeId;
    private $placeNum;
    private $placeLib;
    private $placeCode;
    private $placeParent;
    private $placePrice;
    private $status;

    public function setPlaceId($placeId)
    {
        $this->placeId = (int)$placeId;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }
    public function setPlaceNum($placeNum)
    {
        $this->placeNum = $placeNum;
    }

    public function setPlaceLib($placeLib)
    {
        $this->placeLib = $placeLib;
    }

    public function setPlacePrice($placePrice)
    {
        $this->placePrice = $placePrice;
    }

    public function setPlaceCode($placeCode)
    {
        $this->placeCode = $placeCode;
    }

    public function setPlaceParent($placeParent)
    {
        $this->placeParent = $placeParent;
    }


    public function getPlaceId()
    {
        return $this->placeId;
    }

    public function getPlaceNum()
    {
        return $this->placeNum;
    }

     public function getPlaceLib()
    {
        return $this->placeLib;
    }

    public function getPlaceCode()
    {
        return $this->placeCode;
    }

    public function getPlacePrice()
    {
        return $this->placePrice;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getPlaceParent()
    {
        return $this->placeParent;
    }

    public function getTableName()
    {
        return "place";
    }


    public function __construct($placeId = null)
    {
        $this->initDb();
        if (!empty($placeId)) {
            $this->select($placeId);
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

    public function select($placeId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM `place` WHERE place_num=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$placeId);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->placeId = $rowObject->place_id;
            @$this->placeNum = $rowObject->place_num;
            @$this->placeLib = $rowObject->place_lib;
            @$this->placeCode = $rowObject->place_code;
            @$this->placeParent = $rowObject->place_parent;
            @$this->placePrice = $rowObject->place_price;
            @$this->status = $rowObject->status;

        return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_2($placeId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM `place` WHERE place_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$placeId);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->placeId = $rowObject->place_id;
            @$this->placeNum = $rowObject->place_num;
            @$this->placeLib = $rowObject->place_lib;
            @$this->placeCode = $rowObject->place_code;
            @$this->placeParent = $rowObject->place_parent;
            @$this->placePrice = $rowObject->place_price;
            @$this->status = $rowObject->status;

        return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    // select all rows from places;

 public function select_all()
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM `place` where place_parent=0 order by place_lib");
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_parent($placeParent)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM place where place_parent=? order by place_id");
 $stmt->bindValue(1,$placeParent);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function nb($placeParent)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM place where place_parent=?");
 $stmt->bindValue(1,$placeParent);
 $stmt->execute();
 $stat = $stmt->rowCount()+1;
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_srch_tab($keyword)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM place where place_num like '".$keyword."%' order by place_num");
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_2()
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM `place` where place_parent<>0 order by place_num");
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_place()
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM `place` where place_parent='0' order by place_num");
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_tab($place)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM `place` where place_parent=? order by place_num");
 $stmt->bindValue(1,$place);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

    public function delete($placeId)
    {

        $db = $this->dbase;
        try
        {
        $sql = "DELETE FROM `place` WHERE place_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$placeId);
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
            INSERT INTO `place`
            (place_num,place_parent,place_lib,place_code)
            VALUES(:placeNum,:placeParent,:placeLib,:placeCode)";

            $stmt = $db->prepare($sql);
            $stmt->bindParam("placeNum",$this->placeNum);
            $stmt->bindParam("placeParent",$this->placeParent);
            $stmt->bindParam("placeLib",$this->placeLib);
            $stmt->bindParam("placeCode",$this->placeCode);
            return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }

    }


    public function update($placeId)
    {
        $db = $this->dbase;
            try
            {
         $sql = "
            UPDATE
                `place`
            SET
				place_num=:placeNum,
                place_parent=:placeParent,
                place_lib=:placeLib,
                place_code=:placeCode
            WHERE
                place_id=:placeId";

            $stmt = $db->prepare($sql);
            $stmt->bindParam("placeNum",$this->placeNum);
            $stmt->bindParam("placeParent",$this->placeParent);
            $stmt->bindParam("placeLib",$this->placeLib);
            $stmt->bindParam("placeCode",$this->placeCode);
            $stmt->bindParam("placeId",$placeId);

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
        if ($this->placeId != "") {
            return $this->update($this->placeId);
        } else {
            return false;
        }
    }

public function exist_pl($placeId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM vente where place=:placeId");
 $stmt->bindParam("placeId",$placeId);
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
