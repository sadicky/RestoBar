<?php
include_once("dbconnect.php");

class BeanPersonne extends dbconnect
{

    private $personneId;
    private $role;
    private $photo;
    private $nomComplet;
    private $contact;
    private $email;
    private $genre;
    private $lastUpdate;

    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
    }
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }


    public function setPersonneId($personneId)
    {
        $this->personneId = $personneId;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }


    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    public function setNomComplet($nom)
    {
        $this->nomComplet = $nom;
    }

    public function setContact($contact)
    {
        $this->contact = $contact;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setGenre($genre)
    {
        $this->genre = $genre;
    }

    public function getPersonneId()
    {
        return $this->personneId;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function getNomComplet()
    {
        return $this->nomComplet;
    }

    public function getContact()
    {
        return $this->contact;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getGenre()
    {
        return $this->genre;
    }

    public function getTableName()
    {
        return "personne";
    }

    public function __construct($personneId = null)
    {
        $this->initDB();
        if (!empty($personneId)) {
            $this->select($personneId);
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

        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM personne WHERE personne_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$personneId);
        $stmt->execute();

           $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->personneId = $rowObject->personne_id;
            @$this->role = $rowObject->role;
            @$this->photo = $rowObject->photo;
            @$this->nomComplet = $rowObject->nom_complet;
            @$this->contact = $rowObject->contact;
            @$this->email = $rowObject->email;
            @$this->genre = $rowObject->genre;

        return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }

    }

    public function select_nom($personneId)
    {

        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM personne WHERE nom_complet=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$personneId);
        $stmt->execute();

           $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->personneId = $rowObject->personne_id;
            @$this->role = $rowObject->role;
            @$this->photo = $rowObject->photo;
            @$this->nomComplet = $rowObject->nom_complet;
            @$this->contact = $rowObject->contact;
            @$this->email = $rowObject->email;
            @$this->genre = $rowObject->genre;

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
 $stmt = $db->prepare("SELECT * FROM personne order by nom_complet");
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_role($role)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM personne where role=:role order by nom_complet");
 $stmt->bindParam("role",$role);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_role_srch($role,$keyword)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM personne where nom_complet like '%".$keyword."%' and role=:role");
 $stmt->bindParam("role",$role);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_role_srch_hot($role,$keyword)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM personne join customer on personne.personne_id=customer.personne_id where (nom_complet like '%".$keyword."%' or customer_num like '%".$keyword."%') and role=:role");
 $stmt->bindParam("role",$role);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_role_date($role,$last)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM personne where date(last_update)=:lst and role=:role order by last_update desc");
 $stmt->bindParam("lst",$last);
 $stmt->bindParam("role",$role);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_role_code($role)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM personne where role=:role order by contact, nom_complet");
 //$stmt->bindParam("lst",$last);
 $stmt->bindParam("role",$role);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

    public function delete($personneId)
    {
        $db = $this->dbase;
        try
        {
        $sql = "DELETE FROM personne WHERE personne_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$personneId);
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
        $sql = "INSERT INTO personne
            (role,nom_complet,contact,email,genre)
            VALUES(:role,:nom,:contact,:email,:genre)";

        $stmt = $db->prepare($sql);
            $stmt->bindParam("role",$this->role);
            $stmt->bindParam("nom",$this->nomComplet);
            $stmt->bindParam("contact",$this->contact);
            $stmt->bindParam("email",$this->email);
            $stmt->bindParam("genre",$this->genre);

            $stmt->execute();

            return $db->lastInsertId();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }

    }

    public function insert_2()
    {
       $db = $this->dbase;
            try
            {
        $sql = "INSERT INTO personne
            (role,nom_complet)
            VALUES(:role,:nom)";

        $stmt = $db->prepare($sql);
            $stmt->bindParam("role",$this->role);
            $stmt->bindParam("nom",$this->nomComplet);
            $stmt->execute();

            return $db->lastInsertId();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }

    }


    public function update($personneId)
    {
        // $constants = get_defined_constants();
        $db = $this->dbase;
            try
            {
            $sql ="
            UPDATE
                personne
            SET
				role=:role,
				nom_complet=:nom,
				contact=:contact,
				email=:email,
				genre=:genre,
                last_update=now()
            WHERE
                personne_id=:personneId";

            $stmt = $db->prepare($sql);
            $stmt->bindParam("role",$this->role);
            $stmt->bindParam("nom",$this->nomComplet);
            $stmt->bindParam("contact",$this->contact);
            $stmt->bindParam("email",$this->email);
            $stmt->bindParam("genre",$this->genre);
            $stmt->bindParam("personneId",$personneId);

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
        //if ($this->personneId != "") {
            return $this->update($this->personneId);
        /*} else {
            return false;
        }*/

    }

public function exist_party($partyCode)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM operation where party_code=:partyCode");
 $stmt->bindParam("partyCode",$partyCode);
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

 public function exist_pos($partyCode)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM operation where pos_id=:partyCode");
 $stmt->bindParam("partyCode",$partyCode);
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

 public function exist_pers($personneId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM operation where personne_id=:personneId");
 $stmt->bindParam("personneId",$personneId);
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

public function nb_format($val)
 {
    return number_format($val,1,'.',',');
 }

 public function select_code($role)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT count(personne_id)+1 as last_code FROM personne WHERE role=:role");
 $stmt->bindParam("role",$role);
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat['last_code'];
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

}
?>
