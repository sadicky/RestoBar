<?php
include_once("dbconnect.php");

class BeanServeur extends dbconnect
{

    private $servId;
    private $servName;
    private $servCode;
    private $personneId;
    private $actif;

    public function setServId($servId)
    {
        $this->servId = (int)$servId;
    }

    public function setActif($actif)
    {
        $this->actif = $actif;
    }

    public function setServName($servName)
    {
        $this->servName = (string)$servName;
    }

    public function setServCode($servCode)
    {
        $this->servCode=$servCode;
    }

    public function setPersonneId($personneId)
    {
        $this->personneId = (int)$personneId;
    }

    public function getServId()
    {
        return $this->servId;
    }
    public function getActif()
    {
        return $this->actif;
    }
    public function getServName()
    {
        return $this->servName;
    }

    public function getServCode()
    {
        return $this->servCode;
    }

    public function getPersonneId()
    {
        return $this->personneId;
    }

    public function getTableName()
    {
        return "serveur";
    }

    public function __construct($servId = null)
    {
       $this->initDB();
        if (!empty($servId)) {
            $this->select($servId);
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

    public function select($personneId)
    {
        $db=$this->dbase;

        try
        {
        $sql =  "SELECT * FROM serveur WHERE personne_id=:personne_id";
        $stmt=$db->prepare($sql);
        $stmt->bindParam("personne_id",$personneId);
        $stmt->execute();

           $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->servId = $rowObject->serv_id;
            @$this->servName = $rowObject->serv_name;
            @$this->servCode = $rowObject->serv_code;
            @$this->personneId = $rowObject->personne_id;
            @$this->actif = $rowObject->actif;

       return $stmt->rowCount();

        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

public function select_all()
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM serveur order by serv_code");
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
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

}
?>
