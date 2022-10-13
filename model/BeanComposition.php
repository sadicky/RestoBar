<?php
include_once("dbconnect.php");

class BeanComposition extends dbconnect
{
    private $compoId;
    private $ingred;
    private $qt;
    private $prodId;

    public function setCompoId($compoId)
    {
        $this->compoId = $compoId;
    }

    public function setIngred($ingred)
    {
        $this->ingred = $ingred;
    }

    public function setQt($qt)
    {
        $this->qt = $qt;
    }

    public function setProdId($prodId)
    {
        $this->prodId = $prodId;
    }

    public function getCompoId()
    {
        return $this->compoId;
    }

    public function getIngred()
    {
        return $this->ingred;
    }

    public function getQt()
    {
        return $this->qt;
    }

    public function getProdId()
    {
        return $this->prodId;
    }


    public function getTableName()
    {
        return "composition";
    }


    public function __construct($compoId = null)
    {
        $this->initDB();
        if (!empty($compoId)) {
            $this->select($compoId);
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


public function select_all($prodId){
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * from composition where prod_id=:prodId");
 $stmt->bindvalue('prodId',$prodId);
 $stmt->execute();
 $stat = $stmt->fetchAll();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }
    public function select($prodId)
    {
         $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM composition WHERE prod_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$prodId);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->compoId = $rowObject->compo_id;
            @$this->ingred = $rowObject->ingred;
            @$this->qt = $rowObject->qt;
            @$this->prodId = $rowObject->prod_id;
            return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function delete($compoId)
    {

        $db = $this->dbase;
        try
        {
        $sql = "DELETE FROM composition WHERE id_compo=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$compoId);
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
            INSERT INTO composition
            (ingred,qt,prod_id)
            VALUES(:ingred,:qt,:prodId)";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("ingred",$this->ingred);
        $stmt->bindParam("qt",$this->qt);
        $stmt->bindParam("prodId",$this->prodId);
        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function update($prodId)
    {
        $db = $this->dbase;
            try
            {
        $sql ="
            UPDATE
                composition
            SET
				ingred=:ingred,
				qt=:qt
            WHERE
                prod_id=:prodId";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("ingred",$this->ingred);
        $stmt->bindParam("qt",$this->qt);
        $stmt->bindParam("prodId",$prodId);
        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }

    }


    public function updateCurrent()
    {
        if ($this->prodId != "") {
            return $this->update($this->prodId);
        } else {
            return false;
        }
    }

    // select all rows from tables;

 public function select_num_row($prodId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM composition where prod_id=:id");
 $stmt->bindParam("id",$prodId);
 $stmt->execute();
 $stat = $stmt->rowCount();
 return $stat;
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


public function exist_compo($prodId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM composition where prod_id=:prodId");
 $stmt->bindParam("prodId",$prodId);
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
