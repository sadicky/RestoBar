<?php
require_once("dbconnect.php");

class BeanStock extends dbconnect
{

    private $stockId;
    private $prodId;
    private $quantity;
    private $updateDate;
    private $posId;
    
    public function setStockId($stockId)
    {
        $this->stockId = $stockId;
    }

    public function getStockId()
    {
        return $this->stockId;
    }

    public function setProdId($prodId)
    {
        $this->prodId = (int)$prodId;
    }

    public function setPosId($posId)
    {
        $this->posId = (int)$posId;
    }

    
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function setUpdateDate($updateDate)
    {
        $this->updateDate = (string)$updateDate;
    }

    
    public function getProdId()
    {
        return $this->prodId;
    }

    public function getPosId()
    {
        return $this->posId;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    public function getTableName()
    {
        return "stock";
    }

    public function __construct()
    {
        $this->initDB();

         if (!empty($stockId)) {
            $this->select($stockId);
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

    public function select($prodId,$posId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM stock WHERE prod_id=:id and pos_id=:posId";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$prodId);
        $stmt->bindParam("posId",$posId);
        
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->stockId = $rowObject->stock_id;
            @$this->prodId = $rowObject->prod_id;
            @$this->posId = $rowObject->pos_id;
            @$this->quantity = $rowObject->quantity;
            @$this->updateDate = $rowObject->update_date;

        return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_nb_under_min($posId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * from products join stock on products.prod_id=stock.prod_id WHERE quantity<=qt_min and quantity<=qt_min and pos_id=:posId";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("posId",$posId);
        $stmt->execute();

        return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_nb_zero($posId,$seuil)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * from products join stock on products.prod_id=stock.prod_id WHERE quantity<=:seuil*qt_min and pos_id=:posId";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("posId",$posId);
        $stmt->bindParam("seuil",$seuil);
        $stmt->execute();

        return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_under_min($posId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * from products join stock on products.prod_id=stock.prod_id WHERE quantity<=qt_min and quantity<=qt_min and pos_id=:posId";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("posId",$posId);
        //$stmt->bindParam("seuil",$seuil);
        $stmt->execute();
        $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $stat;
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_zero($posId,$seuil)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * from products join stock on products.prod_id=stock.prod_id WHERE quantity<=:seuil*qt_min and pos_id=:posId";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("posId",$posId);
        $stmt->bindParam("seuil",$seuil);
        $stmt->execute();
        $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $stat;
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }



    /**/
public function select_all($posId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT stock.*,products.* FROM stock join products on stock.prod_id=products.prod_id WHERE pos_id=:posId and quantity>0");
 $stmt->bindParam('posId',$posId);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_cat($posId,$catId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT stock.*,products.* FROM stock join products on stock.prod_id=products.prod_id
  WHERE pos_id=:posId and category_id=:catId and quantity>0");
 $stmt->bindParam('posId',$posId);
 $stmt->bindParam('catId',$catId);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_gen($posId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT stock.quantity as tot_qt,products.* FROM stock join products on stock.prod_id=products.prod_id WHERE pos_id=:posId group by prod_id");
 $stmt->bindParam('posId',$posId);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_cat_gen($posId,$catId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT stock.quantity as tot_qt,products.* FROM stock join products on stock.prod_id=products.prod_id
  WHERE pos_id=:posId and category_id=:catId group by prod_id");
 $stmt->bindParam('posId',$posId);
 $stmt->bindParam('catId',$catId);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 
public function stock_syn_qt($prodId,$posId,$idPer)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT quantity as tot_qt FROM operation join details_operation on operation.op_id=details_operation.op_id where operation.party_type='stock_in' and pos_id=:posId and details_operation.prod_id=:prodId and id_per=:idPer  group by prod_id");
 
 $stmt->bindParam("prodId",$prodId);
 $stmt->bindParam("posId",$posId);
 $stmt->bindParam("idPer",$idPer);

 $stmt->execute();
 $in=$stmt->fetch();

 $stmt = $db->prepare("SELECT sum(quantity) as tot_qt FROM operation join details_operation on operation.op_id=details_operation.op_id where operation.party_type='stock_out' and pos_id=:posId  and  details_operation.prod_id=:prodId and id_per=:idPer  group by prod_id");
 
 $stmt->bindParam("prodId",$prodId);
 $stmt->bindParam("posId",$posId);
 $stmt->bindParam("idPer",$idPer);
 $stmt->execute();
 $out=$stmt->fetch();

 
$qt=$in['tot_qt']+$out['tot_qt'];

return $qt;

 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function update_qt($stockId,$qt)
    {

        $db = $this->dbase;
            try
            {
            $sql ="
            UPDATE stock SET 
            quantity=:qt,
            update_date=now() 
            WHERE
            stock_id=:stockId";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("qt",$qt);
        $stmt->bindParam("stockId",$stockId);
        
        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

 

 public function delete($prod_id)
    {
        $db = $this->dbase;
            try
            {
        $sql = "DELETE FROM stock WHERE prod_id:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$prodId);
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
        INSERT INTO stock
        (prod_id,quantity,pos_id)
        VALUES(:prodId,:quantity,:posId)";

        $stmt = $db->prepare($sql);
        
        $stmt->bindParam("prodId",$this->prodId);
        $stmt->bindParam("quantity",$this->quantity);
        $stmt->bindParam("posId",$this->posId);

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

public function existstock($prodId,$posId)
{
$db = $this->dbase;
            try
            {
$sql="SELECT count(*) from stock where pos_id=:posId and prod_id=:prodId";
$stmt = $db->prepare($sql);
$stmt->bindParam("posId",$posId);
$stmt->bindParam("prodId",$prodId);

$stmt->execute();
return (bool)$stmt->fetchColumn();
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

public function select_nb()
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT count(*) as nb FROM stock WHERE quantity<>'0'");
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat['nb'];
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_stk_0()
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT count(*) as nb FROM stock WHERE quantity='0'");
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat['nb'];
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_pat()
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum(quantity*pa) as pat FROM stock");
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat['pat'];
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_pvt()
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum(quantity*pv) as pvt FROM stock");
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat['pvt'];
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

}
?>
