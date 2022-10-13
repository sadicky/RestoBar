<?php
require_once("dbconnect.php");

class BeanProdSize extends dbconnect
{
    
    
    
    private $prodSizeId;
    private $prodSizeName;

    public function setProdSizeId($prodSizeId)
    {
        $this->prodSizeId = (int)$prodSizeId;
    }

    public function setProdSizeName($prodSizeName)
    {
        $this->prodSizeName = (string)$prodSizeName;
    }

    public function getProdSizeId()
    {
        return $this->prodSizeId;
    }

    public function getProdSizeName()
    {
        return $this->prodSizeName;
    }

    public function getTableName()
    {
        return "prod_size";
    }

    
    public function __construct($prodSizeId = null)
    {
        $this->initDB();
        if (!empty($prodSizeId)) {
            $this->select($prodSizeId);
        }
    }

   
    public function __destruct()
    {
        $this->close();
    }

    public function close()
    {
        unset($this);
    }

    public function select($prodSizeId)
    {
         $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM prod_size WHERE prod_size_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$prodSizeId);
        $stmt->execute();

        
            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->prodSizeId = $rowObject->prod_size_id;
            @$this->prodSizeName = $rowObject->prod_size_name;
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
 $stmt = $db->prepare("SELECT * FROM prod_size");
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

    public function delete($prodSizeId)
    {
        $db = $this->dbase;
        try
        {
        $sql = "DELETE FROM prod_size WHERE prod_size_id=:id";
         $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$prodSizeId);
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
            INSERT INTO prod_size
            (prod_size_name)
            VALUES(:prodSizeName)";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("prodSizeName",$this->prodSizeName);

        return (bool)$stmt->execute();
            
            }
        catch(PDOException $ex)
            {
                 return $ex; 
            }
    }

    
    public function update($prodSizeId)
    {
        $db = $this->dbase;
        try
        {
        
            $sql ="
            UPDATE
                prod_size
            SET 
				prod_size_name=:prodSizeName
            WHERE
                prod_size_id=:prodSizeId";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("prodSizeName",$this->prodSizeName);
        $stmt->bindParam("prodSizeId",$prodSizeId);

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
                ".$this->getTableName."
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
        if ($this->prodSizeId != "") {
            return $this->update($this->prodSizeId);
        } else {
            return false;
        }
    }

}
?>
