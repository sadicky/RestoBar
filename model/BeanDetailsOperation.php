<?php
require_once("dbconnect.php");

class BeanDetailsOperation extends  dbconnect
{

    private $detailsId;
    private $opId;
    private $prodId;
    private $Quantity;
    private $amount;
    private $det;
    private $lot;
    private $dateExp;


    public function setDetailsId($detailsId)
    {
        $this->detailsId = (int)$detailsId;
    }


    public function setOpId($opId)
    {
        $this->opId = (int)$opId;
    }

    public function setDateExp($dateExp)
    {
        $this->dateExp = $dateExp;
    }

    public function setLot($lot)
    {
        $this->lot = $lot;
    }


    public function setDet($det)
    {
        $this->det = $det;
    }

    public function setProdId($prodId)
    {
        $this->prodId = (int)$prodId;
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

    public function getDateExp()
    {
        return $this->dateExp;
    }

    public function getLot()
    {
        return $this->lot;
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
        return "details_operation";
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
        $sql =  "SELECT * FROM details_operation WHERE details_id=:id";
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
            @$this->lot = $rowObject->lot;
            @$this->dateExp = $rowObject->date_exp;

            return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

public function select_sum_op($opId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum(amount*quantity) as tot FROM details_operation where op_id=:id");
 $stmt->bindParam("id",$opId);
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat['tot'];
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_sum_op_ass($opId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum((amount*(det/100))*quantity) as tot FROM details_operation where op_id=:id");
 $stmt->bindParam("id",$opId);
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat['tot'];
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

    public function select_op($opId,$prodId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM details_operation WHERE op_id=:opId and prod_id=:prodId";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("opId",$opId);
        $stmt->bindParam("prodId",$prodId);
        //$stmt->bindParam("stk",$stk);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->detailsId = $rowObject->details_id;
            @$this->opId = $rowObject->op_id;
            @$this->prodId = $rowObject->prod_id;
            @$this->Quantity = $rowObject->quantity;
            @$this->amount = $rowObject->amount;
            @$this->det = $rowObject->det;
            @$this->lot = $rowObject->lot;
            @$this->dateExp = $rowObject->date_exp;

            return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_op_($opId,$prodId,$det)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM details_operation WHERE op_id=:opId and prod_id=:prodId and det=:det";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("opId",$opId);
        $stmt->bindParam("prodId",$prodId);
        $stmt->bindParam("det",$det);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->detailsId = $rowObject->details_id;
            @$this->opId = $rowObject->op_id;
            @$this->prodId = $rowObject->prod_id;
            @$this->Quantity = $rowObject->quantity;
            @$this->amount = $rowObject->amount;
            @$this->det = $rowObject->det;

            return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_one_det_op($opId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM details_operation WHERE op_id=:opId";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("opId",$opId);
        $stmt->execute();
        return $stmt->fetch();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

public function select_all($opId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM details_operation where op_id=:id");
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

public function select_all_cmd($opId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT distinct det FROM details_operation where op_id=:id");
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

public function select_all_2($det)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM details_operation where det=:id");
 $stmt->bindParam("id",$det);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }
 public function select_all_3($opId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT amount, sum(quantity) as quantity,prod_id,lot FROM details_operation where op_id=:id");
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

 public function select_all_4($opId,$lot)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT amount, sum(quantity) as quantity,prod_id,det FROM details_operation where op_id=:id and lot=:lot group by prod_id");
 $stmt->bindParam("id",$opId);
 $stmt->bindParam("lot",$lot);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_5($opId,$det)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT amount, sum(quantity) as quantity,prod_id FROM details_operation where op_id=:id and det=:det group by prod_id");
 $stmt->bindParam("id",$opId);
 $stmt->bindParam("det",$det);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_last_id($opType,$prodId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT max(details_id) as last_id FROM operation join details_operation on operation.op_id=details_operation.op_id where operation.op_type=:opType and details_operation.prod_id=:prodId");
 $stmt->bindParam("prodId",$prodId);
 $stmt->bindParam("opType",$opType);
 $stmt->execute();
 return $stmt->fetch();

 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_avg($opType,$prodId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT avg(amount) as m_avg FROM operation join details_operation on operation.op_id=details_operation.op_id where  operation.op_type=:opType and details_operation.prod_id=:prodId");
 $stmt->bindParam("prodId",$prodId);
 $stmt->bindParam("opType",$opType);
 /*$stmt->bindParam("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);*/
 $stmt->execute();
 $res=$stmt->fetch();
 return $res['m_avg']; 
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_by_type($opType,$idPer,$posId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM operation join details_operation on operation.op_id=details_operation.op_id where operation.op_type=:opType and id_per=:idPer and pos_id=:posId");
 $stmt->bindParam("opType",$opType);
 $stmt->bindParam("idPer",$idPer);
 $stmt->bindParam("posId",$posId);
 $stmt->execute();
 return $stmt->fetchAll(PDO::FETCH_ASSOC);

 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

public function select_sum_qt_lot($opType,$lot,$prodId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum(quantity) as tot_qt FROM operation join details_operation on operation.op_id=details_operation.op_id where operation.op_type=:opType and details_operation.lot=:lot and  details_operation.prod_id=:prodId  group by prod_id");
 $stmt->bindParam("opType",$opType);
 $stmt->bindParam("lot",$lot);
 $stmt->bindParam("prodId",$prodId);
 $stmt->execute();
 return $stmt->fetch();

 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 

public function select_qt_lot($lot,$prodId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum(quantity) as tot_in FROM operation join details_operation on operation.op_id=details_operation.op_id where party_type='stock_in' and prod_id=:prodId and lot=:lot");
 $stmt->bindParam("prodId",$prodId);
 $stmt->bindParam("lot",$lot);
 $stmt->execute();
 $in=$stmt->fetch();

 $stmt = $db->prepare("SELECT sum(quantity) as tot_out FROM operation join details_operation on operation.op_id=details_operation.op_id where party_type='stock_out' and prod_id=:prodId and lot=:lot");
 $stmt->bindParam("prodId",$prodId);
 $stmt->bindParam("lot",$lot);
 $stmt->execute();
 $out=$stmt->fetch();

 $solde=$in['tot_in']-$out['tot_out'];

 return $solde;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }


public function select_sum_amount($opId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum(amount*quantity) as tot_achat FROM details_operation where op_id=:id");
 $stmt->bindParam("id",$opId);
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function nb_op($opId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM details_operation where op_id=:id");
 $stmt->bindParam("id",$opId);
 $stmt->execute();
 return $stmt->rowCount();
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
        $sql = "DELETE FROM details_operation WHERE details_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$detailsId);
        return (bool)$stmt->execute();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function delete_op($opId,$prodId)
    {
        $db = $this->dbase;
            try
            {
        $sql = "DELETE FROM details_operation WHERE op_id=:opId and prod_id=:prodId";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("opId",$opId);
        $stmt->bindParam("prodId",$prodId);
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
            INSERT INTO details_operation
            (op_id,prod_id,quantity,amount,det,lot,date_exp)
            VALUES(:opId,:prodId,:Quantity,:amount,:det,:lot,:dateExp)";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("opId",$this->opId);
        $stmt->bindParam("prodId",$this->prodId);
        $stmt->bindParam("Quantity",$this->Quantity);
        $stmt->bindParam("amount",$this->amount);
        $stmt->bindParam("det",$this->det);
        $stmt->bindParam("lot",$this->lot);
        $stmt->bindParam("dateExp",$this->dateExp);

        $stmt->execute();
        return $db->lastInsertId();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }


    public function update($detailsId)
    {

        $db = $this->dbase;
            try
            {
            $sql ="
            UPDATE
                details_operation
            SET
				prod_id=:prodId,
				quantity=:Quantity,
                amount=:amount
            WHERE
                details_id=:detailsId";

        $stmt = $db->prepare($sql);
        
        $stmt->bindParam("prodId",$this->prodId);
        $stmt->bindParam("Quantity",$this->Quantity);
        $stmt->bindParam("amount",$this->amount);
        //$stmt->bindParam("dateExp",$this->dateExp);
        $stmt->bindParam("detailsId",$detailsId);

        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function update_sup($detailsId)
    {

        $db = $this->dbase;
            try
            {
            $sql ="
            UPDATE
                details_operation
            SET
                lot=:lot,
                date_exp=:dateExp
            WHERE
                details_id=:detailsId";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("lot",$this->lot);
        $stmt->bindParam("dateExp",$this->dateExp);
        $stmt->bindParam("detailsId",$detailsId);

        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function update_op($detId)
    {
        $db = $this->dbase;
            try
            {
            $sql ="
            UPDATE
                details_operation
                SET
                amount=:amount

            WHERE
            details_id=:detId";


        $stmt = $db->prepare($sql);
        $stmt->bindParam("detId",$detId);
        //$stmt->bindParam("prodId",$prodId);
        //$stmt->bindParam("stk",$stk);
        //$stmt->bindParam("Quantity",$this->Quantity);
        $stmt->bindParam("amount",$this->amount);


        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function update_opa($prodId,$opId)
    {
        $db = $this->dbase;
            try
            {
            $sql ="
            UPDATE
                details_operation
                SET
                quantity=:Quantity,
                amount=:amount

            WHERE
            op_id=:opId and prod_id=:prodId";


        $stmt = $db->prepare($sql);
        $stmt->bindParam("opId",$opId);
        $stmt->bindParam("prodId",$prodId);
        //$stmt->bindParam("stk",$stk);
        $stmt->bindParam("Quantity",$this->Quantity);
        $stmt->bindParam("amount",$this->amount);


        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function update_opb($detId)
    {
        $db = $this->dbase;
            try
            {
            $sql ="
            UPDATE
                details_operation
                SET
                quantity=:Quantity

            WHERE
            details_id=:detId";


        $stmt = $db->prepare($sql);
        $stmt->bindParam("detId",$detId);
        //$stmt->bindParam("prodId",$prodId);
        //$stmt->bindParam("stk",$stk);
        $stmt->bindParam("Quantity",$this->Quantity);
        //$stmt->bindParam("amount",$this->amount);


        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }


    public function update_op_($prodId,$opId,$det)
    {
        $db = $this->dbase;
            try
            {
            $sql ="
            UPDATE
                details_operation
                SET
                quantity=:Quantity,
                amount=:amount

            WHERE
            op_id=:opId and prod_id=:prodId and det=:det";


        $stmt = $db->prepare($sql);
        $stmt->bindParam("opId",$opId);
        $stmt->bindParam("prodId",$prodId);
        $stmt->bindParam("det",$det);
        $stmt->bindParam("Quantity",$this->Quantity);
        $stmt->bindParam("amount",$this->amount);


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

public function existop($opId)
{
$db = $this->dbase;
            try
            {
$sql="SELECT count(*) from details_operation where op_id=:opId";
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
$sql="SELECT count(*) from details_operation where op_id=:opId and prod_id=:prodId";
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
$sql="SELECT count(*) from details_operation where op_id=:opId and prod_id=:prodId and det=:cmd";
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
$sql="SELECT count(*) from operation join (details_operation join products on details_operation.prod_id=products.prod_id) on operation.op_id=details_operation.op_id  where op_type=:opType and operation.op_id=:opId and is_ing=:state";
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

public function update_sup2($lot,$dateExp,$prodId)
    {

        $db = $this->dbase;
            try
            {
            $sql ="
            UPDATE
                details_operation
            SET
                lot=:lot,
                date_exp=:dateExp
            WHERE
                lot=:lot2 and date_exp=:dateExp2 and prod_id=:prodId";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("lot",$this->lot);
        $stmt->bindParam("dateExp",$this->dateExp);
        $stmt->bindParam("prodId",$prodId);
        $stmt->bindParam("lot2",$lot);
        $stmt->bindParam("dateExp2",$dateExp);

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
