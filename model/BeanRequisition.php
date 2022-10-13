<?php
include_once("bean.config.php");

/**
 * Class BeanRequisition
 * Bean class for object oriented management of the MySQL table requisition
 *
 * Comment of the managed table requisition: Not specified.
 *
 * Responsibility:
 *
 *  - provides instance constructors for both managing of a fetched table or for a new row
 *  - provides destructor to automatically close database connection
 *  - defines a set of attributes corresponding to the table fields
 *  - provides setter and getter methods for each attribute
 *  - provides OO methods for simplify DML select, insert, update and delete operations.
 *  - provides a facility for quickly updating a previously fetched row
 *  - provides useful methods to obtain table DDL and the last executed SQL statement
 *  - provides error handling of SQL statement
 *  - uses Camel/Pascal case naming convention for Attributes/Class used for mapping of Fields/Table
 *  - provides useful PHPDOC information about the table, fields, class, attributes and methods.
 *
 * @extends MySqlRecord
 * @filesource BeanRequisition.php
 * @category MySql Database Bean Class
 * @package beans
 * @author Rosario Carvello <rosario.carvello@gmail.com>
 * @version GIT:v1.0.0
 * @note  This is an auto generated PHP class builded with MVCMySqlReflection, a small code generation engine extracted from the author's personal MVC Framework.
 * @copyright (c) 2016 Rosario Carvello <rosario.carvello@gmail.com> - All rights reserved. See License.txt file
 * @license BSD
 * @license https://opensource.org/licenses/BSD-3-Clause This software is distributed under BSD Public License.
*/

// namespace beans;

class BeanRequisition extends MySqlRecord
{
    /**
     * A control attribute for the update operation.
     * @note An instance fetched from db is allowed to run the update operation.
     *       A new instance (not fetched from db) is allowed only to run the insert operation but,
     *       after running insertion, the instance is automatically allowed to run update operation.
     * @var bool
     */
    private $allowUpdate = false;

    /**
     * Class attribute for mapping the primary key req_id of table requisition
     *
     * Comment for field req_id: Not specified<br>
     * @var int $reqId
     */
    private $reqId;

    /**
     * A class attribute for evaluating if the table has an autoincrement primary key
     * @var bool $isPkAutoIncrement
     */
    private $isPkAutoIncrement = true;

    /**
     * Class attribute for mapping table field req_name
     *
     * Comment for field req_name: Not specified.<br>
     * Field information:
     *  - Data type: varchar(100)
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $reqName
     */
    private $reqName;

    /**
     * Class attribute for mapping table field req_type
     *
     * Comment for field req_type: Not specified.<br>
     * Field information:
     *  - Data type: varchar(45)
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $reqType
     */
    private $reqType;

    /**
     * Class attribute for mapping table field details
     *
     * Comment for field details: Not specified.<br>
     * Field information:
     *  - Data type: varchar(300)
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $details
     */
    private $details;

    /**
     * Class attribute for mapping table field req_date
     *
     * Comment for field req_date: Not specified.<br>
     * Field information:
     *  - Data type: datetime
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $reqDate
     */
    private $reqDate;

    /**
     * Class attribute for mapping table field amount
     *
     * Comment for field amount: Not specified.<br>
     * Field information:
     *  - Data type: int(11)
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var int $amount
     */
    private $amount;

    /**
     * Class attribute for mapping table field from_acct
     *
     * Comment for field from_acct: Not specified.<br>
     * Field information:
     *  - Data type: int(11)
     *  - Null : YES
     *  - DB Index: MUL
     *  - Default: 
     *  - Extra:  
     * @var int $fromAcct
     */
    private $fromAcct;

    /**
     * Class attribute for mapping table field doc_id
     *
     * Comment for field doc_id: Not specified.<br>
     * Field information:
     *  - Data type: int(11)
     *  - Null : NO
     *  - DB Index: MUL
     *  - Default: 
     *  - Extra:  
     * @var int $docId
     */
    private $docId;

    /**
     * Class attribute for storing the SQL DDL of table requisition
     * @var string base64 encoded string for DDL
     */
    private $ddl = "Q1JFQVRFIFRBQkxFIGByZXF1aXNpdGlvbmAgKAogIGByZXFfaWRgIGludCgxMSkgTk9UIE5VTEwgQVVUT19JTkNSRU1FTlQsCiAgYHJlcV9uYW1lYCB2YXJjaGFyKDEwMCkgREVGQVVMVCBOVUxMLAogIGByZXFfdHlwZWAgdmFyY2hhcig0NSkgREVGQVVMVCBOVUxMLAogIGBkZXRhaWxzYCB2YXJjaGFyKDMwMCkgREVGQVVMVCBOVUxMLAogIGByZXFfZGF0ZWAgZGF0ZXRpbWUgREVGQVVMVCBOVUxMLAogIGBhbW91bnRgIGludCgxMSkgREVGQVVMVCBOVUxMLAogIGBmcm9tX2FjY3RgIGludCgxMSkgREVGQVVMVCBOVUxMLAogIGBkb2NfaWRgIGludCgxMSkgTk9UIE5VTEwsCiAgUFJJTUFSWSBLRVkgKGByZXFfaWRgKSwKICBLRVkgYGRvY19pZGAgKGBkb2NfaWRgKSwKICBLRVkgYGZyb21fYWNjdGAgKGBmcm9tX2FjY3RgKQopIEVOR0lORT1NeUlTQU0gREVGQVVMVCBDSEFSU0VUPWxhdGluMQ==";

    /**
     * setReqId Sets the class attribute reqId with a given value
     *
     * The attribute reqId maps the field req_id defined as int(11).<br>
     * Comment for field req_id: Not specified.<br>
     * @param int $reqId
     * @category Modifier
     */
    public function setReqId($reqId)
    {
        $this->reqId = (int)$reqId;
    }

    /**
     * setReqName Sets the class attribute reqName with a given value
     *
     * The attribute reqName maps the field req_name defined as varchar(100).<br>
     * Comment for field req_name: Not specified.<br>
     * @param string $reqName
     * @category Modifier
     */
    public function setReqName($reqName)
    {
        $this->reqName = (string)$reqName;
    }

    /**
     * setReqType Sets the class attribute reqType with a given value
     *
     * The attribute reqType maps the field req_type defined as varchar(45).<br>
     * Comment for field req_type: Not specified.<br>
     * @param string $reqType
     * @category Modifier
     */
    public function setReqType($reqType)
    {
        $this->reqType = (string)$reqType;
    }

    /**
     * setDetails Sets the class attribute details with a given value
     *
     * The attribute details maps the field details defined as varchar(300).<br>
     * Comment for field details: Not specified.<br>
     * @param string $details
     * @category Modifier
     */
    public function setDetails($details)
    {
        $this->details = (string)$details;
    }

    /**
     * setReqDate Sets the class attribute reqDate with a given value
     *
     * The attribute reqDate maps the field req_date defined as datetime.<br>
     * Comment for field req_date: Not specified.<br>
     * @param string $reqDate
     * @category Modifier
     */
    public function setReqDate($reqDate)
    {
        $this->reqDate = (string)$reqDate;
    }

    /**
     * setAmount Sets the class attribute amount with a given value
     *
     * The attribute amount maps the field amount defined as int(11).<br>
     * Comment for field amount: Not specified.<br>
     * @param int $amount
     * @category Modifier
     */
    public function setAmount($amount)
    {
        $this->amount = (int)$amount;
    }

    /**
     * setFromAcct Sets the class attribute fromAcct with a given value
     *
     * The attribute fromAcct maps the field from_acct defined as int(11).<br>
     * Comment for field from_acct: Not specified.<br>
     * @param int $fromAcct
     * @category Modifier
     */
    public function setFromAcct($fromAcct)
    {
        $this->fromAcct = (int)$fromAcct;
    }

    /**
     * setDocId Sets the class attribute docId with a given value
     *
     * The attribute docId maps the field doc_id defined as int(11).<br>
     * Comment for field doc_id: Not specified.<br>
     * @param int $docId
     * @category Modifier
     */
    public function setDocId($docId)
    {
        $this->docId = (int)$docId;
    }

    /**
     * getReqId gets the class attribute reqId value
     *
     * The attribute reqId maps the field req_id defined as int(11).<br>
     * Comment for field req_id: Not specified.
     * @return int $reqId
     * @category Accessor of $reqId
     */
    public function getReqId()
    {
        return $this->reqId;
    }

    /**
     * getReqName gets the class attribute reqName value
     *
     * The attribute reqName maps the field req_name defined as varchar(100).<br>
     * Comment for field req_name: Not specified.
     * @return string $reqName
     * @category Accessor of $reqName
     */
    public function getReqName()
    {
        return $this->reqName;
    }

    /**
     * getReqType gets the class attribute reqType value
     *
     * The attribute reqType maps the field req_type defined as varchar(45).<br>
     * Comment for field req_type: Not specified.
     * @return string $reqType
     * @category Accessor of $reqType
     */
    public function getReqType()
    {
        return $this->reqType;
    }

    /**
     * getDetails gets the class attribute details value
     *
     * The attribute details maps the field details defined as varchar(300).<br>
     * Comment for field details: Not specified.
     * @return string $details
     * @category Accessor of $details
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * getReqDate gets the class attribute reqDate value
     *
     * The attribute reqDate maps the field req_date defined as datetime.<br>
     * Comment for field req_date: Not specified.
     * @return string $reqDate
     * @category Accessor of $reqDate
     */
    public function getReqDate()
    {
        return $this->reqDate;
    }

    /**
     * getAmount gets the class attribute amount value
     *
     * The attribute amount maps the field amount defined as int(11).<br>
     * Comment for field amount: Not specified.
     * @return int $amount
     * @category Accessor of $amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * getFromAcct gets the class attribute fromAcct value
     *
     * The attribute fromAcct maps the field from_acct defined as int(11).<br>
     * Comment for field from_acct: Not specified.
     * @return int $fromAcct
     * @category Accessor of $fromAcct
     */
    public function getFromAcct()
    {
        return $this->fromAcct;
    }

    /**
     * getDocId gets the class attribute docId value
     *
     * The attribute docId maps the field doc_id defined as int(11).<br>
     * Comment for field doc_id: Not specified.
     * @return int $docId
     * @category Accessor of $docId
     */
    public function getDocId()
    {
        return $this->docId;
    }

    /**
     * Gets DDL SQL code of the table requisition
     * @return string
     * @category Accessor
     */
    public function getDdl()
    {
        return base64_decode($this->ddl);
    }

    /**
    * Gets the name of the managed table
    * @return string
    * @category Accessor
    */
    public function getTableName()
    {
        return "requisition";
    }

    /**
     * The BeanRequisition constructor
     *
     * It creates and initializes an object in two way:
     *  - with null (not fetched) data if none $reqId is given.
     *  - with a fetched data row from the table requisition having req_id=$reqId
     * @param int $reqId. If omitted an empty (not fetched) instance is created.
     * @return BeanRequisition Object
     */
    public function __construct($reqId = null)
    {
        parent::__construct();
        if (!empty($reqId)) {
            $this->select($reqId);
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
        unset($this);
    }

    /**
     * Fetchs a table row of requisition into the object.
     *
     * Fetched table fields values are assigned to class attributes and they can be managed by using
     * the accessors/modifiers methods of the class.
     * @param int $reqId the primary key req_id value of table requisition which identifies the row to select.
     * @return int affected selected row
     * @category DML
     */
    public function select($reqId)
    {
        $sql =  "SELECT * FROM requisition WHERE req_id={$this->parseValue($reqId,'int')}";
        $this->resetLastSqlError();
        $result =  $this->query($sql);
        $this->resultSet=$result;
        $this->lastSql = $sql;
        if ($result){
            $rowObject = $result->fetch_object();
            @$this->reqId = (integer)$rowObject->req_id;
            @$this->reqName = $this->replaceAposBackSlash($rowObject->req_name);
            @$this->reqType = $this->replaceAposBackSlash($rowObject->req_type);
            @$this->details = $this->replaceAposBackSlash($rowObject->details);
            @$this->reqDate = empty($rowObject->req_date) ? null : date(FETCHED_DATETIME_FORMAT,strtotime($rowObject->req_date));
            @$this->amount = (integer)$rowObject->amount;
            @$this->fromAcct = (integer)$rowObject->from_acct;
            @$this->docId = (integer)$rowObject->doc_id;
            $this->allowUpdate = true;
        } else {
            $this->lastSqlError = $this->sqlstate . " - ". $this->error;
        }
        return $this->affected_rows;
    }

    /**
     * Deletes a specific row from the table requisition
     * @param int $reqId the primary key req_id value of table requisition which identifies the row to delete.
     * @return int affected deleted row
     * @category DML
     */
    public function delete($reqId)
    {
        $sql = "DELETE FROM requisition WHERE req_id={$this->parseValue($reqId,'int')}";
        $this->resetLastSqlError();
        $result = $this->query($sql);
        $this->lastSql = $sql;
        if (!$result) {
            $this->lastSqlError = $this->sqlstate . " - ". $this->error;
        }
        return $this->affected_rows;
    }

    /**
     * Insert the current object into a new table row of requisition
     *
     * All class attributes values defined for mapping all table fields are automatically used during inserting
     * @return mixed MySQL insert result
     * @category DML
     */
    public function insert()
    {
        if ($this->isPkAutoIncrement) {
            $this->reqId = "";
        }
        // $constants = get_defined_constants();
        $sql = <<< SQL
            INSERT INTO requisition
            (req_name,req_type,details,req_date,amount,from_acct,doc_id)
            VALUES(
			{$this->parseValue($this->reqName,'notNumber')},
			{$this->parseValue($this->reqType,'notNumber')},
			{$this->parseValue($this->details,'notNumber')},
			{$this->parseValue($this->reqDate,'datetime')},
			{$this->parseValue($this->amount)},
			{$this->parseValue($this->fromAcct)},
			{$this->parseValue($this->docId)})
SQL;
        $this->resetLastSqlError();
        $result = $this->query($sql);
        $this->lastSql = $sql;
        if (!$result) {
            $this->lastSqlError = $this->sqlstate . " - ". $this->error;
        } else {
            $this->allowUpdate = true;
            if ($this->isPkAutoIncrement) {
                $this->reqId = $this->insert_id;
            }
        }
        return $result;
    }

    /**
     * Updates a specific row from the table requisition with the values of the current object.
     *
     * All class attribute values defined for mapping all table fields are automatically used during updating of selected row.<br>
     * Null values are used for all attributes not previously setted.
     * @param int $reqId the primary key req_id value of table requisition which identifies the row to update.
     * @return mixed MySQL update result
     * @category DML
     */
    public function update($reqId)
    {
        // $constants = get_defined_constants();
        if ($this->allowUpdate) {
            $sql = <<< SQL
            UPDATE
                requisition
            SET 
				req_name={$this->parseValue($this->reqName,'notNumber')},
				req_type={$this->parseValue($this->reqType,'notNumber')},
				details={$this->parseValue($this->details,'notNumber')},
				req_date={$this->parseValue($this->reqDate,'datetime')},
				amount={$this->parseValue($this->amount)},
				from_acct={$this->parseValue($this->fromAcct)},
				doc_id={$this->parseValue($this->docId)}
            WHERE
                req_id={$this->parseValue($reqId,'int')}
SQL;
            $this->resetLastSqlError();
            $result = $this->query($sql);
            if (!$result) {
                $this->lastSqlError = $this->sqlstate . " - ". $this->error;
            } else {
                $this->select($reqId);
                $this->lastSql = $sql;
                return $result;
            }
        } else {
            return false;
        }
    }

    /**
     * Facility for updating a row of requisition previously loaded.
     *
     * All class attribute values defined for mapping all table fields are automatically used during updating.
     * @category DML Helper
     * @return mixed MySQLi update result
     */
    public function updateCurrent()
    {
        if ($this->reqId != "") {
            return $this->update($this->reqId);
        } else {
            return false;
        }
    }

}
?>
