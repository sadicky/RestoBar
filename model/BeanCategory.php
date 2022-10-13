<?php
include_once("dbconnect.php");

class BeanCategory extends dbconnect
{

    private $categoryId;
    private $categoryName;
    private $categoryParent;
    private $coeff;
    private $lastUpdate;
    private $isSale;

    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
    }
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    public function setIsSale($isSale)
    {
        $this->isSale = $isSale;
    }
    public function getIsSale()
    {
        return $this->isSale;
    }

    public function setCategoryId($categoryId)
    {
        $this->categoryId = (int)$categoryId;
    }
    public function setCoeff($coeff)
    {
        $this->coeff = (int)$coeff;
    }

    public function setCategoryName($categoryName)
    {
        $this->categoryName = (string)$categoryName;
    }

    public function setCategoryParent($categoryParent)
    {
        $this->categoryParent = (string)$categoryParent;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function getCategoryName()
    {
        return $this->categoryName;
    }

    public function getCoeff()
    {
        return $this->coeff;
    }

    public function getCategoryParent()
    {
        return $this->categoryParent;
    }

    public function getTableName()
    {
        return "category";
    }


    public function __construct($categoryId = null)
    {
        $this->initDb();
        if (!empty($categoryId)) {
            $this->select($categoryId);
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

    public function select($categoryId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM category WHERE category_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$categoryId);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->categoryId = $rowObject->category_id;
            @$this->categoryName = $rowObject->category_name;
            @$this->categoryParent = $rowObject->category_parent;
            @$this->coeff = $rowObject->coeff;
            @$this->isSale = $rowObject->is_sale;

        return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    // select all rows from tables;

 public function select_all()
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM category where category_parent=0 order by category_name");
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
 $stmt = $db->prepare("SELECT * FROM category where category_parent<>0 order by category_name");
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_4($isSale)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM category where category_parent<>0 and is_sale=? order by category_name");
 $stmt->bindValue(1,$isSale);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_3()
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM category where is_sale='Oui' and category_parent=0 order by category_name");
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_srch_cat($keyword)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM category where category_name like '%".$keyword."%' order by category_name");
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_parent($categoryParent)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM category where category_parent=? order by category_name");
 $stmt->bindValue(1,$categoryParent);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_date($last)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM category where date(last_update)=? order by last_update desc");
 $stmt->bindValue(1,$last);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

    public function delete($categoryId)
    {

        $db = $this->dbase;
        try
        {
        $sql = "DELETE FROM category WHERE category_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$categoryId);
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
            INSERT INTO category
            (category_name,category_parent,is_sale,coeff)
            VALUES(:categoryName,:categoryParent,:isSale,:coeff)";

            $stmt = $db->prepare($sql);
            $stmt->bindParam("categoryName",$this->categoryName);
            $stmt->bindParam("categoryParent",$this->categoryParent);
            $stmt->bindParam("isSale",$this->isSale);
            $stmt->bindParam("coeff",$this->coeff);

            $stmt->execute();
            return $db->lastInsertId();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }

    }
    
    public function update($categoryId)
    {
        $db = $this->dbase;
            try
            {
         $sql = "
            UPDATE
                category
            SET
				category_name=:categoryName,
				category_parent=:categoryParent,
                is_sale=:isSale,
                coeff=:coeff
            WHERE
                category_id=:categoryId";

            $stmt = $db->prepare($sql);
            $stmt->bindParam("categoryName",$this->categoryName);
            $stmt->bindParam("categoryParent",$this->categoryParent);
            $stmt->bindParam("isSale",$this->isSale);
            $stmt->bindParam("coeff",$this->coeff);
            $stmt->bindParam("categoryId",$categoryId);

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
        if ($this->categoryId != "") {
            return $this->update($this->categoryId);
        } else {
            return false;
        }
    }

public function exist_cat($catId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM products where category_id=:catId");
 $stmt->bindParam("catId",$catId);
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
