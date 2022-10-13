<?php
include_once("dbconnect.php");

class BeanUsers extends dbconnect
{
    private $userId;
    private $username;
    private $password;
    private $actif;
    private $cash;
    private $typeUser;
    private $personneId;
    private $levelUser;
    private $posId;

    public function setLevelUser($levelUser)
    {
        $this->levelUser = $levelUser;
    }

    public function setPosId($posId)
    {
        $this->posId = $posId;
    }

    public function setUserId($userId)
    {
        $this->userId = (int)$userId;
    }

    public function setUsername($username)
    {
        $this->username = (string)$username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setActif($actif)
    {
        $this->actif = $actif;
    }

    public function setCash($cash)
    {
        $this->cash = $cash;
    }

    public function setPersonneId($personneId)
    {
        $this->personneId = $personneId;
    }

    public function setTypeUser($typeUser)
    {
        $this->typeUser = $typeUser;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getActif()
    {
        return $this->actif;
    }

    public function getCash()
    {
        return $this->cash;
    }

    public function getPersonneId()
    {
        return $this->personneId;
    }
    public function getTypeUser()
    {
        return $this->typeUser;
    }

    public function getLevelUser()
    {
        return $this->levelUser;
    }

    public function getPosid()
    {
        return $this->posId;
    }

    public function getTableName()
    {
        return "users";
    }

    public function __construct($userId = null)
    {
        $this->initDB();
        if (!empty($userId)) {
            $this->select($userId);
        }
    }

    /**
     * The implicit destructor
     */
    public function __destruct()
    {
        $this->close();
    }

    /**
     * Explicit destructor. It calls the implicit destructor automatically.
     */
    public function close()
    {
        //unset($this);
    }


    public function select($personneId)
    {
        $db=$this->dbase;

        try
        {
        $sql =  "SELECT * FROM users WHERE user_id=:personne_id";
        $stmt=$db->prepare($sql);
        $stmt->bindParam("personne_id",$personneId);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->userId = $rowObject->user_id;
            @$this->username = $rowObject->username;
            @$this->password = $rowObject->password;
            @$this->actif = $rowObject->actif;
            @$this->cash = $rowObject->cash;
            @$this->typeUser = $rowObject->type_user;
            @$this->levelUser = $rowObject->level_user;
            @$this->posId = $rowObject->pos_id;
            @$this->personneId = $rowObject->personne_id;
            return $stmt->rowCount();

        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_cash($typeUser,$state)
    {
        $db=$this->dbase;

        try
        {
        $sql =  "SELECT * FROM users WHERE type_user=:typeUser and cash=:cash";
        $stmt=$db->prepare($sql);
        $stmt->bindParam("cash",$state);
        $stmt->bindParam("typeUser",$typeUser);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->userId = $rowObject->user_id;
            @$this->username = $rowObject->username;
            @$this->password = $rowObject->password;
            @$this->actif = $rowObject->actif;
            @$this->cash = $rowObject->cash;
            @$this->typeUser = $rowObject->type_user;
            @$this->posId = $rowObject->pos_id;
            @$this->personneId = $rowObject->personne_id;
            return $stmt->rowCount();

        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

public function select_2($personneId)
    {
        $db=$this->dbase;

        try
        {
        $sql =  "SELECT * FROM users WHERE personne_id=:personne_id";
        $stmt=$db->prepare($sql);
        $stmt->bindParam("personne_id",$personneId);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->userId = $rowObject->user_id;
            @$this->username = $rowObject->username;
            @$this->password = $rowObject->password;
            @$this->actif = $rowObject->actif;
            @$this->cash = $rowObject->cash;
            @$this->typeUser = $rowObject->type_user;
            @$this->levelUser = $rowObject->level_user;
            @$this->personneId = $rowObject->personne_id;
            @$this->posId = $rowObject->pos_id;
            return $stmt->rowCount();

        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function doLogin()
    {

            $db=$this->dbase;

                try
            {
            $sql = "SELECT * FROM users WHERE password=:password";
            $stmt=$db->prepare($sql);
            $stmt->bindParam("password",$this->password);
            $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            if($stmt->rowCount()==1)
            {
                    @$this->user_id = $rowObject->user_id;
                    @$this->actif = $rowObject->actif;
                    @$this->typeUser = $rowObject->type_user;
                    @$this->posId = $rowObject->pos_id;
                    @$this->levelUser=$rowObject->level_user;

                    $_SESSION['user_session']=$rowObject->user_id;
                    $_SESSION['level']=$rowObject->level_user;
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

    public function is_loggedin()
    {
        if(isset($_SESSION['user_session']))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function redirect($url)
    {
        header("Location: $url");
    }

    public function doLogout()
    {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
    }


    public function insert()
    {
        $db = $this->dbase;
            try
            {
         $sql = "
            INSERT INTO users
            (username,password,actif,personne_id,type_user,level_user,pos_id)
            VALUES(:username,:password,:actif,:personneId,:typeUser,:levelUser,:posId)";

            $stmt = $db->prepare($sql);
            $stmt->bindParam("username",$this->username);
            $stmt->bindParam("password",$this->password);
            $stmt->bindParam("actif",$this->actif);
            $stmt->bindParam("personneId",$this->personneId);
            $stmt->bindParam("typeUser",$this->typeUser);
            $stmt->bindParam("levelUser",$this->levelUser);
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

public function select_exist_pseudo($username)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM users where username=:username");
 $stmt->bindParam("username",$username);
 $stmt->execute();
 $stat = $stmt->rowCount();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_exist_mp($mp)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM users where password=:mp");
 $stmt->bindParam("mp",$mp);
 $stmt->execute();
 $stat = $stmt->rowCount();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }



}
?>
