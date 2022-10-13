<?php
require_once("dbconnect.php");



class BeanVente extends dbconnect
{

    private $idvente;
    private $amount;
    private $opId;
    private $assId;
    private $isPaid;
    private $numVente;
    private $red;
    private $tva;
    private $place;

    public function setIdvente($idvente)
    {
        $this->idvente = (int)$idvente;
    }
    public function setNumVente($numvente)
    {
        $this->numVente = $numvente;
    }

    public function setAmount($amount)
    {
        $this->amount = (int)$amount;
    }

    public function setOpId($opId)
    {
        $this->opId = (int)$opId;
    }

    public function setAssId($assId)
    {
        $this->assId = (int)$assId;
    }

    public function setIsPaid($isPaid)
    {
        $this->isPaid = (string)$isPaid;
    }

    public function setRed($red)
    {
        $this->red = $red;
    }

    public function setTva($tva)
    {
        $this->tva = $tva;
    }

    public function setPlace($place)
    {
        $this->place = $place;
    }

    public function getIdvente()
    {
        return $this->idvente;
    }

    public function getNumVente()
    {
        return $this->numVente;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getOpId()
    {
        return $this->opId;
    }

    public function getAssId()
    {
        return $this->assId;
    }

    public function getIsPaid()
    {
        return $this->isPaid;
    }

    public function getRed()
    {
        return $this->red;
    }

    public function getTva()
    {
        return $this->tva;
    }

 public function getPlace()
    {
        return $this->place;
    }

    public function getTableName()
    {
        return "vente";
    }

    public function __construct($idvente = null)
    {
         $this->initDB();
        if (!empty($idvente)) {
            $this->select($idvente);
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

    public function select($idvente)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM vente WHERE op_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$idvente);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->idvente = $rowObject->idvente;
            @$this->amount = $rowObject->amount;
            @$this->opId = $rowObject->op_id;
            @$this->assId = $rowObject->ass_id;
            @$this->numVente = $rowObject->num_vente;
            @$this->tva = $rowObject->tva;
            @$this->red = $rowObject->red;
            @$this->isPaid = $rowObject->is_paid;
            @$this->place = $rowObject->place;
            return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_by_table_av($place)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM vente join operation on vente.op_id=operation.op_id  WHERE place=:id and is_send='0'";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$place);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->idvente = $rowObject->idvente;
            @$this->amount = $rowObject->amount;
            @$this->opId = $rowObject->op_id;
            @$this->assId = $rowObject->ass_id;
            @$this->numVente = $rowObject->num_vente;
            @$this->tva = $rowObject->tva;
            @$this->red = $rowObject->red;
            @$this->isPaid = $rowObject->is_paid;
            @$this->place = $rowObject->place;
            return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_by_table_ass($assId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM vente join operation on vente.op_id=operation.op_id  WHERE ass_id=:id and is_send='0'";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$assId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_by_table_ass2($assId,$personneId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM vente join operation on vente.op_id=operation.op_id  WHERE ass_id=:id and is_send='0' and personne_id=:personneId";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$assId);
        $stmt->bindParam("personneId",$personneId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_id($idvente)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM vente WHERE idvente=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$idvente);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->idvente = $rowObject->idvente;
            @$this->amount = $rowObject->amount;
            @$this->opId = $rowObject->op_id;
            @$this->assId = $rowObject->ass_id;
            @$this->numVente = $rowObject->num_vente;
            @$this->tva = $rowObject->tva;
            @$this->red = $rowObject->red;
            @$this->isPaid = $rowObject->is_paid;
            return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_tab($tab)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM vente join operation on vente.op_id=operation.op_id WHERE is_send='0' and place=:tab";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("tab",$tab);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->idvente = $rowObject->idvente;
            @$this->amount = $rowObject->amount;
            @$this->opId = $rowObject->op_id;
            @$this->assId = $rowObject->ass_id;
            @$this->numVente = $rowObject->num_vente;
            @$this->tva = $rowObject->tva;
            @$this->red = $rowObject->red;
            @$this->isPaid = $rowObject->is_paid;
            return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    // select all rows from tables;

 public function select_all($opId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM vente where op_id=:id");
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

 public function select_last_num($dateV,$role)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT count(op_id) as num FROM operation where create_date=:dateV and op_type=:role");
 $stmt->bindParam("dateV",$dateV);
 $stmt->bindParam("role",$role);
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }




    public function delete($idvente)
{
        $db = $this->dbase;
            try
            {
        $sql = "DELETE FROM vente WHERE idvente=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$idvente);
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
            INSERT INTO vente
            (amount,op_id,num_vente,is_paid,ass_id)
            VALUES(:amount,:opId,:numVente, :isPaid, :assId)";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("amount",$this->amount);
        $stmt->bindParam("opId",$this->opId);
        $stmt->bindParam("assId",$this->assId);
        $stmt->bindParam("numVente",$this->numVente);
        $stmt->bindParam("isPaid",$this->isPaid);
        $stmt->execute();
        return $db->lastInsertId();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function update($opId)
    {
        $db = $this->dbase;
            try
            {
            $sql ="
            UPDATE
                vente
            SET
				amount=:amount
            WHERE
                op_id=:opId";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("amount",$this->amount);
         $stmt->bindParam("opId",$opId);
        return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }
public function exist_table($table)
{

$db = $this->dbase;
            try
            {
$sql="SELECT * from vente join operation on vente.op_id=operation.op_id  where is_send='0' and place=:table";
$stmt = $db->prepare($sql);
$stmt->bindParam("table",$table);
$stmt->execute();
$res=$stmt->rowCount();
return $res;
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
}

public function exist_table_2($table)
{

$db = $this->dbase;
            try
            {
$sql="SELECT * from vente join operation on vente.op_id=operation.op_id  where is_send='0' and place=:table";
$stmt = $db->prepare($sql);
$stmt->bindParam("table",$table);
$stmt->execute();
$res=$stmt->rowCount();
if($res==1) return true; else return false;
//return $res;
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
}

public function nb_table($assId)
{

$db = $this->dbase;
            try
            {
$sql="SELECT * from vente join operation on vente.op_id=operation.op_id  where ass_id=:assId and is_send='0'";
$stmt = $db->prepare($sql);
$stmt->bindParam("assId",$assId);
$stmt->execute();
$res=$stmt->rowCount();
return $res;
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
        if ($this->idvente != "") {
            return $this->update($this->idvente);
        } else {
            return false;
        }
    }

    public function get_op_table($table)
{

$db = $this->dbase;
            try
            {
$sql="SELECT operation.op_id as crt_op_id from vente join operation on vente.op_id=operation.op_id  where is_send='0'
and place=:table";
$stmt = $db->prepare($sql);
$stmt->bindParam("table",$table);
$stmt->execute();
$stat=$stmt->fetch();
return $stat['crt_op_id'];
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
}

}
?>
