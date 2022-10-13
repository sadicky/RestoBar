<?php
require_once("dbconnect.php");


// namespace beans;

class BeanMenu extends dbconnect
{

    private $menuId;
    private $modId;
    private $menuText;
    private $menuIdText;
    private $menuDataId;
    private $menuParent;
    private $menuOrder;
    private $menuIcon;

    public function setMenuId($menuId)
    {
        $this->menuId = (int)$menuId;
    }
    public function setModId($modId)
    {
        $this->modId = (int)$modId;
    }


    public function setMenuText($menuText)
    {
        $this->menuText = (string)$menuText;
    }

    public function setMenuIdText($menuIdText)
    {
        $this->menuIdText = (string)$menuIdText;
    }

    public function setMenuDataId($menuDataId)
    {
        $this->menuDataId = (string)$menuDataId;
    }

    public function setMenuParent($menuParent)
    {
        $this->menuParent = (int)$menuParent;
    }

    public function setMenuGroup($menuGroup)
    {
        $this->menuGroup = (int)$menuGroup;
    }

    public function setMenuOrder($menuOrder)
    {
        $this->menuOrder = (int)$menuOrder;
    }

    public function setMenuIcon($menuIcon)
    {
        $this->menuIcon = $menuIcon;
    }

    public function getMenuId()
    {
        return $this->menuId;
    }

    public function getModId()
    {
        return $this->modId;
    }

    public function getMenuText()
    {
        return $this->menuText;
    }

    public function getMenuIdText()
    {
        return $this->menuIdText;
    }

    public function getMenuDataId()
    {
        return $this->menuDataId;
    }

    public function getMenuParent()
    {
        return $this->menuParent;
    }

    public function getMenuGroup()
    {
        return $this->menuGroup;
    }

    public function getMenuOrder()
    {
        return $this->menuOrder;
    }

    public function getMenuIcon()
    {
        return $this->menuIcon;
    }

    public function getTableName()
    {
        return "menu";
    }


    public function __construct($menuId = null)
    {
        $this->initDB();
        if (!empty($menuId)) {
            $this->select($menuId);
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


    public function select($menuId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM menu WHERE menu_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$menuId);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->menuId = $rowObject->menu_id;
            @$this->modId = $rowObject->mod_id;
            @$this->menuText = $rowObject->menu_text;
            @$this->menuIdText = $rowObject->menu_id_text;
            @$this->menuDataId = $rowObject->menu_data_id;
            @$this->menuParent = $rowObject->menu_parent;
            @$this->menuGroup = $rowObject->menu_group;
            @$this->menuOrder = $rowObject->menu_order;
            @$this->menuIcon = $rowObject->menu_icon;
            return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

public function select_all(){
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * from menu order by menu_order");
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_2($modId){
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * from menu where menu_parent=?");
 $stmt->bindValue(1,$modId);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_menu_type($typ){
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * from menu where menu_parent=:typ order by menu_order");
 $stmt->bindParam("typ",$typ);
 //$stmt->bindParam("mod",$mod);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_menu_group($typ){
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * from menu where menu_group=:typ order by menu_order");
 $stmt->bindParam("typ",$typ);
 //$stmt->bindParam("mod",$mod);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

public function select_all_menu_type_2($typ,$mod){
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * from menu where menu_parent=:typ and mod_id=:mod order by menu_order");
 $stmt->bindParam("typ",$typ);
 $stmt->bindParam("mod",$mod);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

    public function delete($menuId)
    {
        $db = $this->dbase;
        try
        {
        $sql = "DELETE FROM menu WHERE menu_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$menuId);
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
        $sql ="INSERT INTO menu
            (menu_text,menu_id_text,menu_data_id,menu_parent,menu_order,menu_group)
            VALUES(:menuText,:menuIdText,:menuDataId,:menuParent,:menuOrder,
            :menuGroup)";

            $stmt = $db->prepare($sql);
            $stmt->bindParam("menuText",$this->menuText);
            $stmt->bindParam("menuIdText",$this->menuIdText);
            $stmt->bindParam("menuDataId",$this->menuDataId);
            $stmt->bindParam("menuParent",$this->menuParent);
            $stmt->bindParam("menuGroup",$this->menuGroup);
            $stmt->bindParam("menuOrder",$this->menuOrder);
            //$stmt->bindParam("modId",$this->modId);

            return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }

    }


    public function update($menuId)
    {

            $db = $this->dbase;
            try
            {
                $sql = "
            UPDATE
                menu
            SET
				menu_text=:menuText,
				menu_id_text=:menuIdText,
				menu_data_id=:menuDataId,
				menu_parent=:menuParent,
                menu_group=:menuGroup,
                menu_order=:menuOrder
            WHERE
                menu_id=:menuId";

            $stmt = $db->prepare($sql);
            $stmt->bindParam("menuText",$this->menuText);
            $stmt->bindParam("menuIdText",$this->menuIdText);
            $stmt->bindParam("menuDataId",$this->menuDataId);
            $stmt->bindParam("menuParent",$this->menuParent);
            $stmt->bindParam("menuGroup",$this->menuGroup);
            //$stmt->bindParam("modId",$this->modId);
            $stmt->bindParam("menuOrder",$this->menuOrder);
            $stmt->bindParam("menuId",$menuId);


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
        if ($this->menuId != "") {
            return $this->update($this->menuId);
        } else {
            return false;
        }
    }

}
?>
