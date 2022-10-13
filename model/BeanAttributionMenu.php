<?php
require_once("dbconnect.php");

class BeanAttributionMenu extends dbconnect
{

    private $attribId;
    private $personneId;
    private $menuId;
    private $permission;


    public function setAttribId($attribId)
    {
        $this->attribId = (int)$attribId;
    }

    public function setPersonneId($personneId)
    {
        $this->personneId = (int)$personneId;
    }

    public function setMenuId($menuId)
    {
        $this->menuId = (int)$menuId;
    }

    public function setPermission($permission)
    {
        $this->permission = (string)$permission;
    }

    public function getAttribId()
    {
        return $this->attribId;
    }

    public function getPersonneId()
    {
        return $this->personneId;
    }

    public function getMenuId()
    {
        return $this->menuId;
    }

    public function getPermission()
    {
        return $this->permission;
    }

    public function getTableName()
    {
        return "attribution_menu";
    }


    public function __construct($attribId = null)
    {
        $this->initDB();
        if (!empty($attribId)) {
            $this->select($attribId);
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


    public function select($attribId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM attribution_menu WHERE attrib_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$menuId);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);

            @$this->attribId = $rowObject->attrib_id;
            @$this->personneId = $rowObject->personne_id;
            @$this->menuId = $rowObject->menu_id;
            @$this->permission = $rowObject->permission;
            return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }


public function select_all($perso){
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT menu.*, attribution_menu.* from menu join attribution_menu on menu.menu_id=attribution_menu.menu_id where attribution_menu.personne_id=:perso order by menu.menu_order");
 $stmt->bindParam("perso",$perso);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_2($perso,$menu){
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT menu.*, attribution_menu.* from menu join attribution_menu on menu.menu_id=attribution_menu.menu_id where attribution_menu.personne_id=:perso and menu.menu_parent=:menu order by menu.menu_order");
 $stmt->bindParam("perso",$perso);
 $stmt->bindParam("menu",$menu);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_3($perso,$menu){
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT menu.*, attribution_menu.* from menu join attribution_menu on menu.menu_id=attribution_menu.menu_id where attribution_menu.personne_id=:perso and menu.menu_parent=:menu order by menu.menu_order");
 $stmt->bindParam("perso",$perso);
 $stmt->bindParam("menu",$menu);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_attrib_perso($perso,$menu_id){
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("select * from attribution_menu where personne_id=:perso and menu_id=:menu_id");
 $stmt->bindParam("perso",$perso);
 $stmt->bindParam("menu_id",$menu_id);
 $stmt->execute();
 $stat = $stmt->rowCount();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }


    public function delete($attribId)
    {
        $db = $this->dbase;
        try
        {
        $sql = "DELETE FROM attribution_menu WHERE attrib_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$attribId);
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
        $sql ="INSERT INTO attribution_menu
            (personne_id,menu_id,permission)
            VALUES(
			:personneId,
			:menuId,
			:permission)";

            $stmt = $db->prepare($sql);
            $stmt->bindParam("personneId",$this->personneId);
            $stmt->bindParam("menuId",$this->menuId);
            $stmt->bindParam("permission",$this->permission);

            return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }

    }

    public function update($attribId)
    {
        $db = $this->dbase;
            try
            {
            $sql = "
            UPDATE
                attribution_menu
            SET
				personne_id=:personneId,
				menu_id=:menuId,
				permission=:permission
            WHERE
                attrib_id=:attribId";

            $stmt = $db->prepare($sql);
            $stmt->bindParam("personneId",$this->personneId);
            $stmt->bindParam("menuId",$this->menuId);
            $stmt->bindParam("permission",$this->permission);

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
        if ($this->attribId != "") {
            return $this->update($this->attribId);
        } else {
            return false;
        }
    }

}
?>
