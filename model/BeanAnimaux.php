<?php
require_once("dbconnect.php");


class BeanAnimaux extends dbconnect
{
    
   
    private $animalId;
    private $animalName;
    private $byQty;

   
    public function setAnimalId($animalId)
    {
        $this->animalId = (int)$animalId;
    }

    public function setAnimalName($animalName)
    {
        $this->animalName = (string)$animalName;
    }
    public function setByQty($byQty)
    {
        $this->byQty= (int)$byQty;
    }

    public function getAnimalId()
    {
        return $this->animalId;
    }

    
    public function getAnimalName()
    {
        return $this->animalName;
    }

public function getByQty()
    {
        return $this->byQty;
    }


    public function __construct($animalId = null)
    {
       $this->initDB();
        if (!empty($animalId)) {
            $this->select($animalId);
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

   
    public function select($animalId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM animaux WHERE animal_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$animalId);
        $stmt->execute();

        
            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->animalId = $rowObject->animal_id;
            @$this->animalName = $rowObject->animal_name;
            @$this->byQty = $rowObject->by_qty;
           
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
 $stmt = $db->prepare("SELECT * FROM animaux");
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }


public function delete($animalId)
    {
        $db = $this->dbase;
        try
        {
        $sql = "DELETE FROM animaux WHERE animal_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$animalId);
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
        $sql ="INSERT INTO animaux
            (animal_name)
            VALUES(:animal_name)";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("animal_name",$this->animalName);

        return (bool)$stmt->execute();
            
            }
        catch(PDOException $ex)
            {
                 return $ex; 
            }
    }

    
    public function update($animalId)
    {
        
        $db = $this->dbase;
        try
        {
            $sql = "UPDATE
                animaux
            SET 
				animal_name=:animal_name
            WHERE
                animal_id=:animal_id";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("animal_name",$this->animalName);
        $stmt->bindParam("animal_id",$animalId);

        return (bool)$stmt->execute();
            
            }
        catch(PDOException $ex)
            {
                 return $ex; 
            }

    }


    public function update_one($animalId,$val_n,$val_f)
       {

       
        $db = $this->dbase;
            try
            {
            $sql ="
            UPDATE
                animaux
            SET 
                ".$val_n." =:val_f
            WHERE
                animal_id=:animal_id";

            $stmt = $db->prepare($sql);
            $stmt->bindParam("val_f",$val_f);
            $stmt->bindParam("animal_id",$animalId);
            
            return (bool)$stmt->execute();
            

            }
        catch(PDOException $ex)
            {
                 return $ex; 
            }

        }
    
    public function updateCurrent()
    {
        if ($this->animalId != "") {
            return $this->update($this->animalId);
        } else {
            return false;
        }
    }

}
?>
