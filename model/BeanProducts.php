<?php
include_once("dbconnect.php");

class BeanProducts extends dbconnect
{

    private $prodId;
    private $categoryId;
    private $prodName;
    private $prodEquiv;
    private $prodPrice;
    private $isStock;
    private $untMes;
    private $prodCode;
    private $nbEl;
    private $lastUpdate;
    private $isTva;

    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
    }
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }
    public function setProdId($prodId)
    {
        $this->prodId = (int)$prodId;
    }

    public function setCategoryId($categoryId)
    {
        $this->categoryId = (int)$categoryId;
    }

    public function setProdName($prodName)
    {
        $this->prodName = (string)$prodName;
    }

    public function setProdEquiv($prodEquiv)
    {
        $this->prodEquiv = $prodEquiv;
    }

    public function setProdPrice($prodPrice)
    {
        $this->prodPrice = $prodPrice;
    }

    public function setIsTva($isTva)
    {
        $this->isTva= $isTva;
    }

  public function setIsStock($isStock)
    {
        $this->isStock = $isStock;
    }

    public function setUntMes($untMes)
    {
        $this->untMes = $untMes;
    }


    public function setProdCode($prodCode)
    {
        $this->prodCode = (string)$prodCode;
    }

    public function setNbEl($nbEl)
    {
        $this->nbEl = $nbEl;
    }


    public function getProdId()
    {
        return $this->prodId;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function getProdName()
    {
        return $this->prodName;
    }

    public function getProdEquiv()
    {
        return $this->prodEquiv;
    }

    public function getProdPrice()
    {
        return $this->prodPrice;
    }

    public function getIsTva()
    {
        return $this->isTva;
    }

    public function getIsStock()
    {
        return $this->isStock;
    }

    public function getUntMes()
    {
        return $this->untMes;
    }


    public function getNbEl()
    {
        return $this->nbEl;
    }


    public function getProdCode()
    {
        return $this->prodCode;
    }

    public function getTableName()
    {
        return "products";
    }

    public function __construct($prodId = null)
    {
        $this->initDb();
        if (!empty($prodId)) {
            $this->select($prodId);
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


// select all rows from tables;

 public function select_all()
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM products");
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }
 
 public function select_all_2()
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM products WHERE is_stock='Oui' order by prod_name");
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_nb_stk()
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM products WHERE is_stock='Oui'");
 $stmt->execute();
 $stat = $stmt->rowCount();
 return $stat+1;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_date($last)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM products where date(last_update)=? order by last_update desc");
 $stmt->bindValue(1,$last);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_srch_prod($let)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT products.*,category.* FROM products join category on products.category_id=category.category_id  where  prod_name like '%".$let."%' and is_stock='Oui' order by prod_name");
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_srch_prod_2($let)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT products.*,category.* FROM products join category on products.category_id=category.category_id  where  prod_name like '%".$let."%' order by prod_name");
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_srch_cat($cat,$prod)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT products.*,category.* FROM products join category on products.category_id=category.category_id  where  category_parent='".$cat."' and (prod_name like '%".$prod."%' or  prod_code='".$prod."') order by prod_name");
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_isStock($isStock)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT category.*, products.* FROM category join products on category.category_id=products.category_id where is_stock=:isStock");
 $stmt->bindParam('isStock',$isStock);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_isSale($isSale)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT category.*, products.* FROM category join products on category.category_id=products.category_id where category.is_sale=:isSale");
 $stmt->bindParam('isSale',$isSale);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_menu($isStock,$isSale)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT category.*, products.* FROM category join products on category.category_id=products.category_id where is_stock=:isStock and is_sale=:isSale");
 $stmt->bindParam('isStock',$isStock);
 $stmt->bindParam('isSale',$isSale);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_promo($isStock)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT category.*, products.* FROM category join products on category.category_id=products.category_id where prod_price=:prodPrice");
 $stmt->bindParam('prodPrice',$prodPrice);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_prod_code($code)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT category.*, products.* FROM category join products on category.category_id=products.category_id where prod_code=:code");
 $stmt->bindParam('code',$code);
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_tarif($assId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT products.*,price.* FROM products join price on products.prod_id=price.prod_id  where price<>'0' and ass_id=:assId");
 $stmt->bindParam('assId',$assId);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
}

 public function select_all_crt_tar($prod,$pos)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT prod_name,products.prod_id,prod_equiv,quantity FROM products join stock on products.prod_id=stock.prod_id where prod_equiv<>'0' and quantity<>'0' and pos_id='".$pos."' and prod_name like '%".$prod."%' order by prod_name limit 0,15");
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }

 }

 
 public function select_all_cat($cat)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT category.*, products.* FROM category join products on category.category_id=products.category_id where category.category_id=:cat order by prod_name");
 $stmt->bindParam('cat',$cat);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_by_cat_name($cat)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT category.*, products.* FROM category join products on category.category_id=products.category_id where category_name=:cat");
 $stmt->bindParam('cat',$cat);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_by_unt($cat)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT category.*, products.* FROM category join products on category.category_id=products.category_id where unt_mes=:cat");
 $stmt->bindParam('cat',$cat);
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }
    public function select($prodId)
    {
        $db=$this->dbase;

        try
        {
        $sql =  "SELECT * FROM products WHERE prod_id=:id";
        $stmt=$db->prepare($sql);
        $stmt->bindParam("id",$prodId);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->prodId = $rowObject->prod_id;
            @$this->prodCode = $rowObject->prod_code;
            @$this->categoryId = $rowObject->category_id;
            @$this->prodName = $rowObject->prod_name;
            @$this->prodEquiv = $rowObject->prod_equiv;
            @$this->prodPrice = $rowObject->prod_price;
            @$this->isStock = $rowObject->is_stock;
            @$this->isTva = $rowObject->is_tva;
            @$this->nbEl = $rowObject->nb_el;
            @$this->untMes = $rowObject->unt_mes;


        return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function select_code($code)
    {
        $db=$this->dbase;

        try
        {
        $sql =  "SELECT * FROM products WHERE prod_code=:id";
        $stmt=$db->prepare($sql);
        $stmt->bindParam("id",$code);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->prodId = $rowObject->prod_id;
            @$this->categoryId = $rowObject->category_id;
            @$this->prodName = $rowObject->prod_name;
            @$this->prodEquiv = $rowObject->prod_equiv;
            @$this->prodPrice = $rowObject->prod_price;
            @$this->nbEl = $rowObject->nb_el;
            @$this->untMes = $rowObject->unt_mes;
            @$this->isStock = $rowObject->is_stock;
            @$this->isTva = $rowObject->is_tva;


        return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function delete($prodId)
    {
        $db = $this->dbase;
        try
        {
        $sql = "DELETE FROM products WHERE prod_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$prodId);
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
         $sql = "
            INSERT INTO products
            (category_id,prod_name,prod_equiv,prod_price,is_stock,prod_code,nb_el,unt_mes,is_tva)
            VALUES(:categoryId,:prodName,:prodEquiv,:prodPrice,:isStock,:prodCode,:nbEl,:untMes,:isTva)";

            $stmt = $db->prepare($sql);
            $stmt->bindParam("prodCode",$this->prodCode);
            $stmt->bindParam("categoryId",$this->categoryId);
            $stmt->bindParam("prodName",$this->prodName);
            $stmt->bindParam("prodEquiv",$this->prodEquiv);
            $stmt->bindParam("prodPrice",$this->prodPrice);
            $stmt->bindParam("isStock",$this->isStock);
            $stmt->bindParam("nbEl",$this->nbEl);
            $stmt->bindParam("untMes",$this->untMes);
            $stmt->bindParam("isTva",$this->isTva);


            return (bool)$stmt->execute();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

    public function update($prodId)
    {
        $db = $this->dbase;
            try
            {
         $sql = "
            UPDATE
                products
            SET
                prod_code=:prodCode,
                category_id=:categoryId,
                prod_name=:prodName,
                prod_equiv=:prodEquiv,
                prod_price=:prodPrice,
                is_stock=:isStock,
                is_tva=:isTva,
                nb_el=:nbEl,
                unt_mes=:untMes

            WHERE
                prod_id=:prodId";

            $stmt = $db->prepare($sql);

            $stmt->bindParam("prodCode",$this->prodCode);
            $stmt->bindParam("categoryId",$this->categoryId);
            $stmt->bindParam("prodName",$this->prodName);
            $stmt->bindParam("prodEquiv",$this->prodEquiv);
            $stmt->bindParam("prodPrice",$this->prodPrice);
            $stmt->bindParam("isTva",$this->isTva);
            $stmt->bindParam("isStock",$this->isStock);
            $stmt->bindParam("prodId",$prodId);
            $stmt->bindParam("nbEl",$this->nbEl);
            $stmt->bindParam("untMes",$this->untMes);

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
        if ($this->prodId != "") {
            return $this->update($this->prodId);
        } else {
            return false;
        }
    }

public function select_exist_code($prodCode)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM products where prod_code=:prodCode");
 $stmt->bindParam("prodCode",$prodCode);
 $stmt->execute();
 $stat = $stmt->rowCount();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_exist_name($prodName)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM products where prod_name=:prodName");
 $stmt->bindParam("prodName",$prodName);
 $stmt->execute();
 $stat = $stmt->rowCount();
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function test_mfp($prix_mfp, $pua, $pourc)
    {
    if($pourc=='90' and ($prix_mfp>=$pua*1.40))
    {
        return true;
    }
    elseif($pourc=='80' and ($prix_mfp>=$pua*1.20))
    {
        return true;
    }
    elseif($pourc=='70' and ($prix_mfp>=$pua*1.20))
    {
        return true;
    }
    else
    {
        return false;
    }
    }

    public function nb_format($val)
 {
    return number_format($val,1,'.',',');
 }

 public function exist_prod($prodId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM details_operation where prod_id=:prodId");
 $stmt->bindParam("prodId",$prodId);
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

 public function select_last_num()
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT count(prod_id)+1 as last_num FROM products");
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat['last_num'];
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_all_equiv()
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT DISTINCT prod_equiv FROM products WHERE prod_equiv<>0 order by prod_name");
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 
}
?>
