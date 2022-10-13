<?php
require_once("dbconnect.php");


class BeanPrice extends dbconnect
{

    private $priceId;
    private $price;
    private $pricePub;
    private $untMes;
    private $unt;
    private $tarId;
    private $prodId;
    private $percent;

    public function setPriceId($priceId)
    {
        $this->priceId = (int)$priceId;
    }

    public function setUnt($unt)
    {
        $this->unt = $unt;
    }

    public function setPrice($price)
    {
        $this->price =$price;
    }

    public function setUntMes($untMes)
    {
        $this->untMes = $untMes;
    }

    public function setPricePub($pricePub)
    {
        $this->pricePub =$pricePub;
    }

    public function setTarId($tarId)
    {
        $this->tarId = $tarId;
    }

    public function setProdId($prodId)
    {
        $this->prodId = (int)$prodId;
    }

    public function setPercent($percent)
    {
        $this->percent = (string)$percent;
    }

    public function getPriceId()
    {
        return $this->priceId;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getPricePub()
    {
        return $this->pricePub;
    }

    public function getTarId()
    {
        return $this->tarId;
    }

    public function getProdId()
    {
        return $this->prodId;
    }

    public function getUnt()
    {
        return $this->unt;
    }

    public function getUntMes()
    {
        return $this->untMes;
    }

    public function getPercent()
    {
        return $this->percent;
    }

    public function getTableName()
    {
        return "price";
    }


    public function __construct($priceId = null)
    {
         $this->initDB();
        if (!empty($priceId)) {
            $this->select($priceId);
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


    public function select($priceId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM price WHERE price_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$priceId);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->priceId = $rowObject->price_id;
            @$this->unt = $rowObject->unt;
            @$this->price = $rowObject->price;
            @$this->untMes = $rowObject->unt_mes;
            @$this->pricePub = $rowObject->price_pub;
            @$this->tarId = $rowObject->tar_id;
            @$this->prodId = $rowObject->prod_id;
            @$this->percent = $rowObject->percent;

            return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_2($prodId,$tarId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM price WHERE prod_id=:id and tar_id=:tarId";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$prodId);
        $stmt->bindParam("tarId",$tarId);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->priceId = $rowObject->price_id;
            @$this->unt = $rowObject->unt;
            @$this->price = $rowObject->price;
            @$this->untMes = $rowObject->unt_mes;
            @$this->pricePub = $rowObject->price_pub;
            @$this->tarId = $rowObject->tar_id;
            @$this->prodId = $rowObject->prod_id;
            @$this->percent = $rowObject->percent;

            return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

public function exist_prod($prodId,$tarId)
    {
        $db = $this->dbase;
try
{
        $sql =  "SELECT * FROM price WHERE prod_id=:id and tar_id=:tarId";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$prodId);
        $stmt->bindParam("tarId",$tarId);
        $stmt->execute();
 $stat = $stmt->rowCount();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

    // select all rows from tables;

 public function select_all($tarId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM price where tar_id=:id");
 $stmt->bindParam("id",$tarId);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_art($prodId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM price where prod_id=:prodId");
 //$stmt->bindParam("id",$tarId);
 $stmt->bindParam("prodId",$prodId);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

public function delete($priceId)
{
        $db = $this->dbase;
            try
            {
        $sql = "DELETE FROM price WHERE price_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$priceId);
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
            INSERT INTO price
            (price,tar_id,prod_id,unt,unt_mes)
            VALUES(:price,:tarId,:prodId,:unt,:untMes)";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("price",$this->price);
        $stmt->bindParam("tarId",$this->tarId);
        $stmt->bindParam("prodId",$this->prodId);
        $stmt->bindParam("unt",$this->unt);
        $stmt->bindParam("untMes",$this->untMes);

        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function update($priceId)
    {
        $db = $this->dbase;
            try
            {
            $sql ="
            UPDATE
                price
            SET
                price=:price,
                unt=:unt,
                unt_mes=:untMes,
                tar_id=:tarId
            WHERE
                price_id=:priceId";

            $stmt = $db->prepare($sql);
        $stmt->bindParam("price",$this->price);
        $stmt->bindParam("tarId",$this->tarId);
        $stmt->bindParam("priceId",$priceId);
        $stmt->bindParam("unt",$this->unt);
        $stmt->bindParam("untMes",$this->untMes);

        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function update_price($prodId,$tarId,$price)
    {
        $db = $this->dbase;
            try
            {
            $sql ="
            UPDATE
                price
            SET
                price=:price
            WHERE
                prod_id=:prodId and tar_id=:tarId";

            $stmt = $db->prepare($sql);
        $stmt->bindParam("price",$price);
        $stmt->bindParam("tarId",$tarId);
        $stmt->bindParam("prodId",$prodId);

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

public function existprice($prodId,$tarId)
{
$db = $this->dbase;
            try
            {
$sql="SELECT count(*) from price where prod_id=:id and tar_id=:tarId";
$stmt = $db->prepare($sql);
$stmt->bindParam("id",$prodId);
$stmt->bindParam("tarId",$tarId);
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
        if ($this->priceId != "") {
            return $this->update($this->priceId);
        } else {
            return false;
        }
    }

}
?>
