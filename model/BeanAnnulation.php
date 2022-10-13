<?php
require_once("dbconnect.php");

class BeanAnnulation extends  dbconnect
{

    private $detailsId;
    private $opId;
    private $prodId;
    private $Quantity;
    private $amount;
    private $det;
    private $tab;
    private $dateOp;


    public function setDetailsId($detailsId)
    {
        $this->detailsId = (int)$detailsId;
    }


    public function setOpId($opId)
    {
        $this->opId = $opId;
    }

    public function setDateOp($dateOp)
    {
        $this->dateOp = $dateOp;
    }

    public function setTab($tab)
    {
        $this->tab = $tab;
    }


    public function setDet($det)
    {
        $this->det = $det;
    }

    public function setProdId($prodId)
    {
        $this->prodId = $prodId;
    }

    public function setQuantity($Quantity)
    {
        $this->Quantity = $Quantity;
    }



    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function getDetailsId()
    {
        return $this->detailsId;
    }

    public function getOpId()
    {
        return $this->opId;
    }

    public function getDateOp()
    {
        return $this->dateOp;
    }

    public function getTab()
    {
        return $this->tab;
    }

    public function getDet()
    {
        return $this->det;
    }


    public function getProdId()
    {
        return $this->prodId;
    }

    public function getQuantity()
    {
        return $this->Quantity;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getTableName()
    {
        return "annulation";
    }

    public function __construct($detailsId = null)
    {
        $this->initDB();
        if (!empty($detailsId)) {
            $this->select($detailsId);
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

    public function select($detailsId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM annulation WHERE details_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$detailsId);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->detailsId = $rowObject->details_id;
            @$this->opId = $rowObject->op_id;
            @$this->prodId = $rowObject->prod_id;
            @$this->Quantity = $rowObject->quantity;
            @$this->amount = $rowObject->amount;
            @$this->det = $rowObject->det;
            @$this->tab = $rowObject->tab;
            @$this->dateOp = $rowObject->date_op;

            return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

 public function select_all($fromd,$tod)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM annulation where date_op between :fromd and :tod");
 $stmt->bindParam("fromd",$fromd);
 $stmt->bindParam("tod",$tod);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

    public function delete($detailsId)
    {
        $db = $this->dbase;
            try
            {
        $sql = "DELETE FROM annulation WHERE details_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$detailsId);
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
            INSERT INTO annulation
            (op_id,prod_id,quantity,amount,det,tab)
            VALUES(:opId,:prodId,:Quantity,:amount,:det,:tab)";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("opId",$this->opId);
        $stmt->bindParam("prodId",$this->prodId);
        $stmt->bindParam("Quantity",$this->Quantity);
        $stmt->bindParam("amount",$this->amount);
        $stmt->bindParam("det",$this->det);
        $stmt->bindParam("tab",$this->tab);


        $stmt->execute();
        return $db->lastInsertId();

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

public function existop($opId)
{
$db = $this->dbase;
            try
            {
$sql="SELECT count(*) from annulation where op_id=:opId";
$stmt = $db->prepare($sql);
$stmt->bindParam("opId",$opId);
//$stmt->bindParam("prodId",$prodId);
//$stmt->bindParam("stk",$stk);
$stmt->execute();
return (bool)$stmt->fetchColumn();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
}

public function existop_2($opId,$prodId)
{
$db = $this->dbase;
            try
            {
$sql="SELECT count(*) from annulation where op_id=:opId and prod_id=:prodId";
$stmt = $db->prepare($sql);
$stmt->bindParam("opId",$opId);
$stmt->bindParam("prodId",$prodId);
//$stmt->bindParam("stk",$stk);
$stmt->execute();
return (bool)$stmt->fetchColumn();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
}

public function existop_2_($opId,$prodId,$cmd)
{
$db = $this->dbase;
            try
            {
$sql="SELECT count(*) from annulation where op_id=:opId and prod_id=:prodId and det=:cmd";
$stmt = $db->prepare($sql);
$stmt->bindParam("opId",$opId);
$stmt->bindParam("prodId",$prodId);
$stmt->bindParam("cmd",$cmd);
$stmt->execute();
return (bool)$stmt->fetchColumn();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
}

public function exist_vente_enc($opType,$state)
{
$db = $this->dbase;
            try
            {
$sql="SELECT count(*) from operation  where op_type=:opType and state=:state";
$stmt = $db->prepare($sql);
//$stmt->bindParam("opId",$opId);
$stmt->bindParam("opType",$opType);
$stmt->bindParam("state",$state);
$stmt->execute();
return (bool)$stmt->fetchColumn();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
}

public function exist_sort_ing($opType,$opId,$state)
{
$db = $this->dbase;
            try
            {
$sql="SELECT count(*) from operation join (annulation join products on annulation.prod_id=products.prod_id) on operation.op_id=annulation.op_id  where op_type=:opType and operation.op_id=:opId and is_ing=:state";
$stmt = $db->prepare($sql);
//$stmt->bindParam("opId",$opId);
$stmt->bindParam("opType",$opType);
$stmt->bindParam("opId",$opId);
$stmt->bindParam("state",$state);
$stmt->execute();
return (bool)$stmt->fetchColumn();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
}

public function update_sup2($tab,$dateOp,$prodId)
    {

        $db = $this->dbase;
            try
            {
            $sql ="
            UPDATE
                annulation
            SET
                tab=:tab,
                date_op=:dateOp
            WHERE
                tab=:tab2 and date_op=:dateOp2 and prod_id=:prodId";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("tab",$this->tab);
        $stmt->bindParam("dateOp",$this->dateOp);
        $stmt->bindParam("prodId",$prodId);
        $stmt->bindParam("tab2",$tab);
        $stmt->bindParam("dateOp2",$dateOp);

        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }



    public function updateCurrent()
    {
        if ($this->detailsId != "") {
            return $this->update($this->detailsId);
        } else {
            return false;
        }
    }

}
?>
