<?php
require_once("dbconnect.php");


class BeanOperation extends dbconnect
{

    private $opId;
    private $opType;
    private $partyType;
    private $createDate;
    private $state;
    private $partyCode;
    private $isPaid;
    private $isSend;
    private $personneId;
    private $jourId;
    private $posId;


    public function setOpId($opId)
    {
        $this->opId = (int)$opId;
    }

    public function setOpType($opType)
    {
        $this->opType = (string)$opType;
    }

    public function setPartyType($partyType)
    {
        $this->partyType = (string)$partyType;
    }

    public function setCreateDate($createDate)
    {
        $this->createDate = (string)$createDate;
    }

    public function setState($state)
    {
        $this->state = (string)$state;
    }

    public function setPartyCode($partyCode)
    {
        $this->partyCode = (string)$partyCode;
    }

    public function setIsPaid($isPaid)
    {
        $this->isPaid = $isPaid;
    }

    public function setIsSend($isSend)
    {
        $this->isSend = $isSend;
    }

    public function setPersonneId($personneId)
    {
        $this->personneId = (int)$personneId;
    }

    public function setPosId($posId)
    {
        $this->posId = (int)$posId;
    }
    public function setJourId($jourId)
    {
        $this->jourId = $jourId;
    }

    public function getOpId()
    {
        return $this->opId;
    }

    public function getOpType()
    {
        return $this->opType;
    }

    public function getPartyType()
    {
        return $this->opType;
    }

    public function getCreateDate()
    {
        return $this->createDate;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getPartyCode()
    {
        return $this->partyCode;
    }

    public function getIsPaid()
    {
        return $this->isPaid;
    }

    public function getIsSend()
    {
        return $this->isSend;
    }

    public function getPersonneId()
    {
        return $this->personneId;
    }

    public function getPosId()
    {
        return $this->posId;
    }

    public function getJourId()
    {
        return $this->jourId;
    }


    public function getTableName()
    {
        return "operation";
    }

    public function __construct($opId = null)
    {
        $this->initDB();
        if (!empty($opId)) {
            $this->select($opId);
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

    public function select($opId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM operation WHERE op_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$opId);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->opId = $rowObject->op_id;
            @$this->opType = $rowObject->op_type;
            @$this->partyType = $rowObject->party_type;
            @$this->createDate = $rowObject->create_date;
            @$this->state = $rowObject->state;
            @$this->partyCode = $rowObject->party_code;
            @$this->isPaid = $rowObject->is_paid;
            @$this->isSend = $rowObject->is_send;
            @$this->personneId = $rowObject->personne_id;
            @$this->posId = $rowObject->pos_id;
            @$this->jourId = $rowObject->jour_id;

        return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_op_type($opType,$pos,$state)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM operation WHERE op_type=:opType and pos_id=:posId and is_send=:isSend";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("opType",$opType);
        $stmt->bindParam("posId",$pos);
        $stmt->bindParam("isSend",$state);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->opId = $rowObject->op_id;
            @$this->opType = $rowObject->op_type;
            @$this->createDate = $rowObject->create_date;
            @$this->state = $rowObject->state;
            @$this->partyCode = $rowObject->party_code;
            @$this->isPaid = $rowObject->is_paid;
            @$this->personneId = $rowObject->personne_id;
            @$this->posId = $rowObject->pos_id;
            @$this->jourId = $rowObject->jour_id;

        return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_op_paid($opType,$pos,$isPaid)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT operation.*, sortie_matp.num_sort, type_sort FROM operation join sortie_matp on operation.op_id=sortie_matp.op_id  WHERE op_type=:opType and pos_id=:posId and operation.is_paid=:isPaid";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("opType",$opType);
        $stmt->bindParam("posId",$pos);
        $stmt->bindParam("isPaid",$isPaid);
        $stmt->execute();
        $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $stat;
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_num($opType)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT max(op_id) as last_id FROM operation where op_type=:opType";
        $stmt = $db->prepare($sql);
        $stmt->bindParam('opType',$opType);
        $stmt->execute();
        $res=$stmt->fetch();
        return $res;
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_last($typ,$perso_id)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT max(op_id) as last_id_perso FROM operation where op_type=:typ and personne_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$perso_id);
        $stmt->bindParam("typ",$typ);
        $stmt->execute();
        $res=$stmt->fetch();
        return $res;
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_last2($party_code,$perso_id)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM operation where party_code=:id and personne_id=:id2";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$party_code);
        $stmt->bindParam("id2",$perso_id);
        $stmt->execute();

        return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_production($party_code,$typ,$posId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM operation where party_code=:id and op_type=:typ and pos_id=:posId";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$party_code);
        $stmt->bindParam("typ",$typ);
        $stmt->bindParam('posId',$posId);

        $stmt->execute();

        return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_production_data($party_code,$typ,$posId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM operation where party_code=:id and op_type=:typ and pos_id=:posId";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$party_code);
        $stmt->bindParam("typ",$typ);
        $stmt->bindParam('posId',$posId);

        $stmt->execute();

        $res=$stmt->fetch();
        return $res;
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }


    // select all rows from tables;

 public function select_all($supId,$posId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM operation where party_code=:id and pos_id=:posId");
 $stmt->bindParam("id",$supId);
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

 public function select_all_sup_by_pay($supId,$state,$posId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM operation where party_code=:id and is_paid=:state and pos_id=:posId");
 $stmt->bindParam("id",$supId);
 $stmt->bindParam("state",$state);
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

 public function select_all_sup_by_pay_no_pos($opType,$state)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM operation where op_type=:opType and is_paid=:state");
 $stmt->bindParam("opType",$opType);
 $stmt->bindParam("state",$state);
 //$stmt->bindParam('posId',$posId);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_by_pay($opType,$state,$posId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM operation where op_type=:op_type and is_paid=:state and pos_id=:posId");
 $stmt->bindParam("op_type",$opType);
 $stmt->bindParam("state",$state);
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

 public function select_all_by_pay_party($opType,$partyCode,$state,$posId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM operation where op_type=:op_type and  party_code=:party_code  and is_paid=:state and pos_id=:posId");
 $stmt->bindParam("op_type",$opType);
 $stmt->bindParam("party_code",$partyCode);
 $stmt->bindParam("state",$state);
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

 public function select_all_party($opType,$partyCode,$posId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM operation where op_type=:op_type and  party_code=:party_code  and pos_id=:posId");
 $stmt->bindParam("op_type",$opType);
 $stmt->bindParam("party_code",$partyCode);
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

 public function select_all_by_period($opType,$from_d,$to_d,$posId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM operation where op_type=:op_type and pos_id=:posId and (create_date
    between :from_d and :to_d)");
 $stmt->bindParam("op_type",$opType);
 $stmt->bindParam("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);
 $stmt->bindParam("posId",$posId);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

public function select_all_by_period_jr($opType,$from_d,$to_d,$personneId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM operation where op_type=:op_type and personne_id=:personneId and (date(create_date)
    between :from_d and :to_d)");
 $stmt->bindParam("op_type",$opType);
 $stmt->bindParam("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);
 $stmt->bindParam("personneId",$personneId);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_by_period_jr_2($opType,$from_d,$to_d)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM operation where op_type=:op_type  and (date(create_date)
    between :from_d and :to_d)");
 $stmt->bindParam("op_type",$opType);
 $stmt->bindParam("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);
 //$stmt->bindParam("personneId",$personneId);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_top_ten($opType,$mois,$posId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum(quantity) as tot, prod_id FROM operation join details_operation on operation.op_id=details_operation.op_id where op_type=:op_type and pos_id=:posId and month(create_date)=:mois group by prod_id order by tot desc limit 0,9");
 $stmt->bindParam("op_type",$opType);
 $stmt->bindParam("mois",$mois);
 //$stmt->bindParam("to_d",$to_d);
 $stmt->bindParam("posId",$posId);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_by_period_rap($opType,$from_d,$to_d,$posId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT operation.*, details_operation.* FROM operation join details_operation on operation.op_id=details_operation.op_id where op_type=:op_type and pos_id=:posId and (create_date between :from_d and :to_d)");
 $stmt->bindParam("op_type",$opType);
 $stmt->bindParam("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);
 $stmt->bindParam("posId",$posId);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_by_period_rap_bis($opType,$from_d,$to_d)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT operation.*, details_operation.* FROM operation join details_operation on operation.op_id=details_operation.op_id where op_type=:op_type  and (create_date between :from_d and :to_d)");
 $stmt->bindParam("op_type",$opType);
 $stmt->bindParam("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_by_period_rap_vente($opType,$from_d,$to_d)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT details_operation.prod_id,personne_id FROM operation join details_operation on operation.op_id=details_operation.op_id where op_type=:op_type and (create_date between :from_d and :to_d) group by details_operation.prod_id");
 $stmt->bindParam("op_type",$opType);
 $stmt->bindParam("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);
 //$stmt->bindParam("stk",$stk);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }



 public function select_all_by_period_rap_vente_by_pos($opType,$from_d,$to_d,$pos)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT details_operation.prod_id,personne_id FROM operation join details_operation on operation.op_id=details_operation.op_id where op_type=:op_type and pos_id=:pos and (create_date between :from_d and :to_d) group by details_operation.prod_id");
 $stmt->bindParam("op_type",$opType);
 $stmt->bindParam("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);
 $stmt->bindParam("pos",$pos);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_by_period_rap_vente_($opType,$from_d,$to_d,$prod)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT details_operation.*,personne_id FROM operation join details_operation on operation.op_id=details_operation.op_id where op_type=:op_type and (create_date between :from_d and :to_d) and prod_id=:prod");
 $stmt->bindParam("op_type",$opType);
 $stmt->bindParam("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);
 $stmt->bindParam("prod",$prod);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_by_period_rap_vente_perso($opType,$from_d,$to_d,$prod)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT details_operation.*,personne_id FROM operation join details_operation on operation.op_id=details_operation.op_id where op_type=:op_type and (create_date between :from_d and :to_d) and prod_id=:prod");
 $stmt->bindParam("op_type",$opType);
 $stmt->bindParam("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);
 $stmt->bindParam("prod",$prod);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_by_period_rap_vente_pos($opType,$from_d,$to_d,$prod,$pos)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT details_operation.*,personne_id FROM operation join details_operation on operation.op_id=details_operation.op_id where op_type=:op_type and pos_id=:pos and (create_date between :from_d and :to_d) and prod_id=:prod");
 $stmt->bindParam("op_type",$opType);
 $stmt->bindParam("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);
 $stmt->bindParam("prod",$prod);
 $stmt->bindParam("pos",$pos);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_glob_vente($opType,$from_d,$to_d)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT operation.*, details_operation.*,sum(quantity) as qt_tot FROM operation join details_operation on operation.op_id=details_operation.op_id where op_type=:op_type and (create_date between :from_d and :to_d) group by details_operation.prod_id,operation.create_date");
 $stmt->bindValue("op_type",$opType);
 $stmt->bindValue("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_glob_ingred($opType,$from_d,$to_d)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT operation.*, details_operation.*,composition.*, sum(quantity*qt) as qt_tot FROM operation join (details_operation join (products join composition on products.prod_id=composition.prod_id) on details_operation.prod_id=products.prod_id) on operation.op_id=details_operation.op_id where op_type=:op_type and (create_date between :from_d and :to_d) group by composition.ingred,operation.create_date");
 $stmt->bindValue("op_type",$opType);
 $stmt->bindValue("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_by_period_conso($partyType,$from_d,$to_d,$posId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT products.*, operation.*, details_operation.*, sum(quantity) as totqtsort FROM operation join (details_operation join products on details_operation.prod_id=products.prod_id) on operation.op_id=details_operation.op_id where party_type=:party_type and pos_id=:posId and (create_date between :from_d and :to_d) order by prod_name");
 $stmt->bindParam("party_type",$partyType);
 $stmt->bindParam("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);
 $stmt->bindParam("posId",$posId);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_stock_mouv($prod,$partyType,$from_d,$to_d,$posId)
 {
  $db = $this->dbase;
 try
 {
$stmt = $db->prepare("SELECT sum(quantity) as totqt FROM operation join details_operation on operation.op_id=details_operation.op_id where party_type=:party_type and (create_date<=:to_d) and prod_id=:prod and pos_id=:posId group by prod_id ");
 $stmt->bindParam("party_type",$partyType);
 //$stmt->bindParam("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);
 $stmt->bindParam("prod",$prod);
 $stmt->bindParam("posId",$posId);
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_stock_mouv_in($prod,$partyType,$from_d,$to_d,$posId)
 {
    $db = $this->dbase;
 try
 {
$stmt = $db->prepare("SELECT sum(quantity) as totqt FROM operation join details_operation on operation.op_id=details_operation.op_id where party_type=:party_type and (create_date between :from_d and :to_d) and prod_id=:prod and party_code=:posId group by prod_id ");
 $stmt->bindParam("party_type",$partyType);
 $stmt->bindParam("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);
 $stmt->bindParam("prod",$prod);
 $stmt->bindParam("posId",$posId);
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }


 public function select_all_by_period_conso_qt($prod,$opType,$from_d,$to_d,$posId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum(quantity) as totqt FROM operation join details_operation on operation.op_id=details_operation.op_id where op_type=:op_type and (create_date between :from_d and :to_d) and prod_id=:prod and pos_id=:posId group by prod_id ");
 $stmt->bindParam("op_type",$opType);
 $stmt->bindParam("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);
 $stmt->bindParam("prod",$prod);
 $stmt->bindParam("posId",$posId);
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_by_period_sortie($prod,$opType,$type_sort,$from_d,$to_d,$posId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT sum(quantity) as totqt FROM sortie_matp join (operation join details_operation on operation.op_id=details_operation.op_id) on sortie_matp.op_id=operation.op_id where op_type=:op_type and type_sort=:type_sort and (create_date between :from_d and :to_d) and prod_id=:prod and pos_id=:posId group by prod_id ");
 $stmt->bindParam("op_type",$opType);
 $stmt->bindParam("type_sort",$type_sort);
 $stmt->bindParam("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);
 $stmt->bindParam("prod",$prod);
 $stmt->bindParam("posId",$posId);
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }


 public function select_all_by_date_rap($prod,$from_d,$pos)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT operation.*, prod_id, quantity as totqt FROM operation join details_operation on operation.op_id=details_operation.op_id where prod_id=:prod and date(create_date)=:from_d and (pos_id=:pos or party_code=:pos)");
 $stmt->bindParam("prod",$prod);
 $stmt->bindParam("from_d",$from_d);
 $stmt->bindParam("pos",$pos);

 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_by_date_rap_bis($prod,$from_d)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT operation.*, prod_id, quantity as totqt,det FROM operation join details_operation on operation.op_id=details_operation.op_id where prod_id=:prod and create_date=:from_d");
 $stmt->bindParam("prod",$prod);
 $stmt->bindParam("from_d",$from_d);
 //$stmt->bindParam("pos",$pos);

 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_by_date_rap_an($opType,$prod,$from_d,$pos)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT operation.*, prod_id, sum(quantity) as totqt FROM operation join details_operation on operation.op_id=details_operation.op_id where op_type=:op_type and prod_id=:prod and create_date<:from_d  and pos_id=:pos GROUP BY prod_id");
 $stmt->bindParam("prod",$prod);
 $stmt->bindParam("op_type",$opType);
 $stmt->bindParam("from_d",$from_d);
 //$stmt->bindParam("det",$det);
 $stmt->bindParam("pos",$pos);

 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_by_date_rap_an_recep($opType,$prod,$from_d,$pos)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT operation.*, prod_id, sum(quantity) as totqt FROM operation join details_operation on operation.op_id=details_operation.op_id where op_type=:op_type and prod_id=:prod and create_date<:from_d  and party_code=:pos GROUP BY prod_id");
 $stmt->bindParam("prod",$prod);
 $stmt->bindParam("op_type",$opType);
 $stmt->bindParam("from_d",$from_d);
 //$stmt->bindParam("det",$det);
 $stmt->bindParam("pos",$pos);

 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_by_date_rap_an_bis($opType,$prod,$from_d)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT operation.*, prod_id, sum(quantity) as totqt FROM operation join details_operation on operation.op_id=details_operation.op_id where op_type=:op_type and prod_id=:prod and create_date<:from_d GROUP BY prod_id");
 $stmt->bindParam("prod",$prod);
 $stmt->bindParam("op_type",$opType);
 $stmt->bindParam("from_d",$from_d);
 //$stmt->bindParam("det",$det);


 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_by_date_rap_2($from_d,$posId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT operation.*, prod_id, sum(quantity) as totqt FROM operation join details_operation on operation.op_id=details_operation.op_id where create_date=:from_d and pos_id=:posId GROUP BY prod_id");
 $stmt->bindParam("from_d",$from_d);
$stmt->bindParam("posId",$posId);

 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }


 public function select_all_by_period_sup($opType,$from_d,$to_d,$sup,$posId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM operation where op_type=:op_type and party_code=:sup and pos_id=:posId and (create_date
    between :from_d and :to_d)");
 $stmt->bindParam("op_type",$opType);
 $stmt->bindParam("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);
 $stmt->bindParam("sup",$sup);
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

 public function select_all_by_period_sup_2($opType,$from_d,$to_d,$sup,$posId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM operation where op_type=:op_type and personne_id=:sup and pos_id=:posId and (create_date
    between :from_d and :to_d)");
 $stmt->bindParam("op_type",$opType);
 $stmt->bindParam("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);
 $stmt->bindParam("sup",$sup);
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

 public function select_all_by_period_sup_rap($opType,$from_d,$to_d,$sup,$posId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT operation.*, details_operation.* FROM operation join details_operation on operation.op_id=details_operation.op_id where op_type=:op_type and personne_id=:sup and pos_id=:posId and (create_date
    between :from_d and :to_d)");
 $stmt->bindParam("op_type",$opType);
 $stmt->bindParam("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);
 $stmt->bindParam("posId",$posId);
 $stmt->bindParam("sup",$sup);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_by_period_sup_rap_bis($opType,$from_d,$to_d,$sup)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT operation.*, details_operation.* FROM operation join details_operation on operation.op_id=details_operation.op_id where op_type=:op_type and personne_id=:sup and (create_date
    between :from_d and :to_d)");
 $stmt->bindParam("op_type",$opType);
 $stmt->bindParam("from_d",$from_d);
 $stmt->bindParam("to_d",$to_d);
 $stmt->bindParam("sup",$sup);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_by_cust_pay($cust,$opType,$state,$posId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM operation where party_code=:cust and op_type=:op_type and is_paid=:state and pos_id=:posId");
 $stmt->bindParam("cust",$cust);
 $stmt->bindParam("op_type",$opType);
 $stmt->bindParam("state",$state);
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

 public function select_all_by_state($opType,$state,$posId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM operation where op_type=:op_type and state=:state and pos_id=:posId");
 $stmt->bindParam("op_type",$opType);
 $stmt->bindParam("state",$state);
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

 public function select_all_by_state_2($opType,$posId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM operation where op_type=:op_type  and pos_id=:posId");
 $stmt->bindParam("op_type",$opType);
 //$stmt->bindParam("state",$state);
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

    public function delete($opId)
    {
        $db = $this->dbase;
            try
            {
        $sql = "DELETE FROM operation WHERE op_id=:";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$opId);
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
            INSERT INTO operation
            (op_type,jour_id,state,party_code,is_paid,personne_id,party_type,pos_id)
            VALUES(:opType,:jourId,:state,:partyCode,:isPaid,:personneId,:partyType,:posId)";

        $stmt = $db->prepare($sql);
        $stmt->bindParam("opType",$this->opType);
        $stmt->bindParam("partyType",$this->partyType);
        $stmt->bindParam("jourId",$this->jourId);
        $stmt->bindParam("state",$this->state);
        $stmt->bindParam("partyCode",$this->partyCode);
        $stmt->bindParam("isPaid",$this->isPaid);
        $stmt->bindParam("personneId",$this->personneId);
        $stmt->bindParam("posId",$this->posId);

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
                operation
            SET
				op_type=:opType,
                jour_id=:jourId,
				state=:state,
				party_code=:partyCode,
				is_paid=:isPaid,
				personne_id=:personneId,
                pos_id=:posId
            WHERE
                op_id=:opId";

            $stmt = $db->prepare($sql);
        $stmt->bindParam("opType",$this->opType);
        $stmt->bindParam("jourId",$this->jourId);
        $stmt->bindParam("state",$this->state);
        $stmt->bindParam("partyCode",$this->partyCode);
        $stmt->bindParam("isPaid",$this->isPaid);
        $stmt->bindParam("personneId",$this->personneId);
        $stmt->bindParam("posId",$this->posId);
        $stmt->bindParam("opId",$opId);

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
        if ($this->opId != "") {
            return $this->update($this->opId);
        } else {
            return false;
        }
    }

public function exist_open_op($jour)
{
 $state='1';
 $opType='Vente';
$db = $this->dbase;
            try
            {
$sql="SELECT count(*) from operation  where state=:state and op_type=:opType and jour_id=:jourId";
$stmt = $db->prepare($sql);
$stmt->bindParam("state",$state);
$stmt->bindParam("opType",$opType);
$stmt->bindParam("jourId",$jour);
$stmt->execute();
return (bool)$stmt->fetchColumn();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
}

}
?>
