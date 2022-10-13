<?php
include_once("dbconnect.php");

class BeanChambre extends dbconnect
{

    private $chambId;
    private $categoryId;
    private $chambNum;
    private $chambPrice;
    private $chambCara;
    private $chambEtat;    

    
    public function setChambId($chambId)
    {
        $this->chambId = (int)$chambId;
    }

    public function setCategoryId($categoryId)
    {
        $this->categoryId = (int)$categoryId;
    }

    public function setChambNum($chambNum)
    {
        $this->chambNum = (string)$chambNum;
    }

    public function setChambPrice($chambPrice)
    {
        $this->chambPrice = (string)$chambPrice;
    }

    public function setChambCara($chambCara)
    {
        $this->chambCara =$chambCara;
    }

    public function setChambEtat($chambEtat)
    {
        $this->chambEtat = $chambEtat;
    }

    

    public function getChambId()
    {
        return $this->chambId;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function getChambNum()
    {
        return $this->chambNum;
    }

    public function getChambPrice()
    {
        return $this->chambPrice;
    }

    public function getChambEtat()
    {
        return $this->chambEtat;
    }

    public function getChambCara()
    {
        return $this->chambCara;
    }
    public function getTableName()
    {
        return "chambre";
    }

    public function __construct($chambId = null)
    {
        $this->initDb();
        if (!empty($chambId)) {
            $this->select($chambId);
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


// select all rows from tables;

 public function select_all()
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM chambre order by chamb_num");
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

public function select_all_etat($etat)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM chambre where etat=?");
 $stmt->bindValue(1,$etat);
 $stmt->execute();
 $stat = $stmt->rowCount();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 } 
 
 public function select_all_by_cat($cat)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT category.*, chambre.* FROM category join chambre on category.category_id=chambre.category_id where category.parent_id=:cat");
 $stmt->bindParam('cat',$cat);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }
    public function select($chambId)
    {
        $db=$this->dbase;

        try
        {
        $sql =  "SELECT * FROM chambre WHERE chamb_id=:id";
        $stmt=$db->prepare($sql);
        $stmt->bindParam("id",$chambId);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->chambId = $rowObject->chamb_id;
            @$this->categoryId = $rowObject->category_id;
            @$this->chambNum = $rowObject->chamb_num;
            @$this->chambPrice = $rowObject->chamb_price;
            @$this->chambCara = $rowObject->chamb_cara;
            @$this->chambEtat = $rowObject->chamb_etat;
           


        return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_num($num)
    {
        $db=$this->dbase;

        try
        {
        $sql =  "SELECT * FROM chambre WHERE chamb_num=:id";
        $stmt=$db->prepare($sql);
        $stmt->bindParam("id",$num);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
           @$this->chambId = $rowObject->chamb_id;
            @$this->categoryId = $rowObject->category_id;
            @$this->chambNum = $rowObject->chamb_num;
            @$this->chambPrice = $rowObject->chamb_price;
            @$this->chambCara = $rowObject->chamb_cara;


        return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function delete($chambId)
    {
        $db = $this->dbase;
        try
        {
        $sql = "DELETE FROM chambre WHERE chamb_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$chambId);
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
            INSERT INTO chambre
            (category_id,chamb_num,chamb_price,chamb_cara)
            VALUES(:categoryId,:chambNum,:chambPrice,:chambCara)";

            $stmt = $db->prepare($sql);
            
            $stmt->bindParam("categoryId",$this->categoryId);
            $stmt->bindParam("chambNum",$this->chambNum);
            $stmt->bindParam("chambPrice",$this->chambPrice);
            $stmt->bindParam("chambCara",$this->chambCara);

            return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function update($chambId)
    {
        $db = $this->dbase;
            try
            {
         $sql = "
            UPDATE
                chambre
            SET
                category_id=:categoryId,
                chamb_num=:chambNum,
                chamb_price=:chambPrice,
                chamb_cara=:chambCara
                
            WHERE
                chamb_id=:chambId";

            $stmt = $db->prepare($sql);

            
            $stmt->bindParam("categoryId",$this->categoryId);
            $stmt->bindParam("chambNum",$this->chambNum);
            $stmt->bindParam("chambPrice",$this->chambPrice);
            $stmt->bindParam("chambCara",$this->chambCara);
            $stmt->bindParam("chambId",$chambId);
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
        if ($this->chambId != "") {
            return $this->update($this->chambId);
        } else {
            return false;
        }
    }

public function select_exist_code($num)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM chambre where chamb_num=:um");
 $stmt->bindParam("num",$num);
 $stmt->execute();
 $stat = $stmt->rowCount();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 
    public function nb_format($val)
 {
    return number_format($val,1,'.',',');
 }

 public function exist_chamb($chambId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM location where chamb_id=:chambId");
 $stmt->bindParam("chambId",$chambId);
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
