<?php
include_once("dbconnect.php");

class BeanCoupon extends dbconnect
{

    private $couponId;
    private $opId;
    private $status;
    private $isPaid;

    public function setCouponId($couponId)
    {
        $this->couponId = (int)$couponId;
    }
    public function setStatus($status)
    {
        $this->status = (int)$status;
    }
    public function setOpId($opId)
    {
        $this->opId = (string)$opId;
    }


    public function getCouponId()
    {
        return $this->couponId;
    }

    public function getIsPaid()
    {
        return $this->isPaid;
    }

    public function getOpId()
    {
        return $this->opId;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getCouponName()
    {
        return "`coupon`";
    }


    public function __construct($couponId = null)
    {
        $this->initDb();
        if (!empty($couponId)) {
            $this->select($couponId);
        }
    }

public function nb_op($cmd)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM details_operation where det=:id");
 $stmt->bindParam("id",$cmd);
 $stmt->execute();
 return $stmt->rowCount();
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }


    public function select($couponId)
    {
        $db = $this->dbase;
        try
        {
        $sql =  "SELECT * FROM `coupon` WHERE coupon_id=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id",$couponId);
        $stmt->execute();

            $rowObject = $stmt->fetch(PDO::FETCH_OBJ);
            @$this->couponId = $rowObject->coupon_id;
            @$this->opId = $rowObject->op_id;
            @$this->isPaid = $rowObject->is_paid;
            @$this->status = $rowObject->status;

        return $stmt->rowCount();
        }
        catch(PDOException $ex)
            {
                 return $ex;
            }
    }

public function select_exist_op($opId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM coupon where op_id=:opId");
 $stmt->bindParam("opId",$opId);
 $stmt->execute();
 $stat = $stmt->rowCount();
 if($stat>=1)
 return true;
else
    return false;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }



    // select all rows from coupons;

 public function select_all()
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT * FROM `coupon` order by op_id");
 $stmt->execute();
 $stat = $stmt->fetchAll(PDO::FETCH_ASSOC);
 return $stat;
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

 public function select_last_cmd($opId)
 {
 $db = $this->dbase;
 try
 {
 $stmt = $db->prepare("SELECT max(coupon_id) as last_cmd FROM `coupon` where op_id=:opId");
 $stmt->bindParam("opId",$opId);
 $stmt->execute();
 $stat = $stmt->fetch();
 return $stat['last_cmd'];
 }
 catch(PDOException $ex)
 {
 return $ex;
 }
 }

    public function delete($couponId)
    {

        $db = $this->dbase;
        try
        {
        $sql = "DELETE FROM `coupon` WHERE coupon_id=:id";
        $$stmt = $db->prepare($sql);
        $stmt->bindParam("id",$couponId);
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
            INSERT INTO `coupon` (op_id)
            VALUES(:opId)";

            $stmt = $db->prepare($sql);
            $stmt->bindParam("opId",$this->opId);

            $stmt->execute();
            return $db->lastInsertId();

            }
        catch(PDOException $ex)
            {
                 return $ex;
            }

    }


    public function update($couponId)
    {
        $db = $this->dbase;
            try
            {
         $sql = "
            UPDATE
                `coupon`
            SET
				op_id=:opId
            WHERE
                coupon_id=:couponId";

            $stmt = $db->prepare($sql);
            $stmt->bindParam("opId",$this->opId);
            $stmt->bindParam("couponId",$couponId);

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
                ".$this->getCouponName()."
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
        if ($this->couponId != "") {
            return $this->update($this->couponId);
        } else {
            return false;
        }
    }

}
?>
