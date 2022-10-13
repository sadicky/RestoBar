<?php
include_once("bean.config.php");

/**
 * Class BeanEntretienVoiture
 * Bean class for object oriented management of the MySQL table entretien_voiture
 *
 * Comment of the managed table entretien_voiture: Not specified.
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
 * @filesource BeanEntretienVoiture.php
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

class BeanEntretienVoiture extends MySqlRecord
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
     * Class attribute for mapping the primary key identretien_voiture of table entretien_voiture
     *
     * Comment for field identretien_voiture: Not specified<br>
     * @var int $identretienVoiture
     */
    private $identretienVoiture;

    /**
     * A class attribute for evaluating if the table has an autoincrement primary key
     * @var bool $isPkAutoIncrement
     */
    private $isPkAutoIncrement = true;

    /**
     * Class attribute for mapping table field date_
     *
     * Comment for field date_: Not specified.<br>
     * Field information:
     *  - Data type: varchar(45)
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $date_
     */
    private $date_;

    /**
     * Class attribute for mapping table field km
     *
     * Comment for field km: Not specified.<br>
     * Field information:
     *  - Data type: varchar(45)
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $km
     */
    private $km;

    /**
     * Class attribute for mapping table field operation
     *
     * Comment for field operation: Not specified.<br>
     * Field information:
     *  - Data type: varchar(45)
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $operation
     */
    private $operation;

    /**
     * Class attribute for mapping table field designation
     *
     * Comment for field designation: Not specified.<br>
     * Field information:
     *  - Data type: varchar(45)
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $designation
     */
    private $designation;

    /**
     * Class attribute for mapping table field amount
     *
     * Comment for field amount: Not specified.<br>
     * Field information:
     *  - Data type: varchar(45)
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $amount
     */
    private $amount;

    /**
     * Class attribute for mapping table field voiture_id
     *
     * Comment for field voiture_id: Not specified.<br>
     * Field information:
     *  - Data type: int(11)
     *  - Null : YES
     *  - DB Index: MUL
     *  - Default: 
     *  - Extra:  
     * @var int $voitureId
     */
    private $voitureId;

    /**
     * Class attribute for storing the SQL DDL of table entretien_voiture
     * @var string base64 encoded string for DDL
     */
    private $ddl = "Q1JFQVRFIFRBQkxFIGBlbnRyZXRpZW5fdm9pdHVyZWAgKAogIGBpZGVudHJldGllbl92b2l0dXJlYCBpbnQoMTEpIE5PVCBOVUxMIEFVVE9fSU5DUkVNRU5ULAogIGBkYXRlX2AgdmFyY2hhcig0NSkgREVGQVVMVCBOVUxMLAogIGBrbWAgdmFyY2hhcig0NSkgREVGQVVMVCBOVUxMLAogIGBvcGVyYXRpb25gIHZhcmNoYXIoNDUpIERFRkFVTFQgTlVMTCwKICBgZGVzaWduYXRpb25gIHZhcmNoYXIoNDUpIERFRkFVTFQgTlVMTCwKICBgYW1vdW50YCB2YXJjaGFyKDQ1KSBERUZBVUxUIE5VTEwsCiAgYHZvaXR1cmVfaWRgIGludCgxMSkgREVGQVVMVCBOVUxMLAogIFBSSU1BUlkgS0VZIChgaWRlbnRyZXRpZW5fdm9pdHVyZWApLAogIEtFWSBgdm9pdHVyZV9pZGAgKGB2b2l0dXJlX2lkYCkKKSBFTkdJTkU9TXlJU0FNIERFRkFVTFQgQ0hBUlNFVD1sYXRpbjE=";

    /**
     * setIdentretienVoiture Sets the class attribute identretienVoiture with a given value
     *
     * The attribute identretienVoiture maps the field identretien_voiture defined as int(11).<br>
     * Comment for field identretien_voiture: Not specified.<br>
     * @param int $identretienVoiture
     * @category Modifier
     */
    public function setIdentretienVoiture($identretienVoiture)
    {
        $this->identretienVoiture = (int)$identretienVoiture;
    }

    /**
     * setDate_ Sets the class attribute date_ with a given value
     *
     * The attribute date_ maps the field date_ defined as varchar(45).<br>
     * Comment for field date_: Not specified.<br>
     * @param string $date_
     * @category Modifier
     */
    public function setDate_($date_)
    {
        $this->date_ = (string)$date_;
    }

    /**
     * setKm Sets the class attribute km with a given value
     *
     * The attribute km maps the field km defined as varchar(45).<br>
     * Comment for field km: Not specified.<br>
     * @param string $km
     * @category Modifier
     */
    public function setKm($km)
    {
        $this->km = (string)$km;
    }

    /**
     * setOperation Sets the class attribute operation with a given value
     *
     * The attribute operation maps the field operation defined as varchar(45).<br>
     * Comment for field operation: Not specified.<br>
     * @param string $operation
     * @category Modifier
     */
    public function setOperation($operation)
    {
        $this->operation = (string)$operation;
    }

    /**
     * setDesignation Sets the class attribute designation with a given value
     *
     * The attribute designation maps the field designation defined as varchar(45).<br>
     * Comment for field designation: Not specified.<br>
     * @param string $designation
     * @category Modifier
     */
    public function setDesignation($designation)
    {
        $this->designation = (string)$designation;
    }

    /**
     * setAmount Sets the class attribute amount with a given value
     *
     * The attribute amount maps the field amount defined as varchar(45).<br>
     * Comment for field amount: Not specified.<br>
     * @param string $amount
     * @category Modifier
     */
    public function setAmount($amount)
    {
        $this->amount = (string)$amount;
    }

    /**
     * setVoitureId Sets the class attribute voitureId with a given value
     *
     * The attribute voitureId maps the field voiture_id defined as int(11).<br>
     * Comment for field voiture_id: Not specified.<br>
     * @param int $voitureId
     * @category Modifier
     */
    public function setVoitureId($voitureId)
    {
        $this->voitureId = (int)$voitureId;
    }

    /**
     * getIdentretienVoiture gets the class attribute identretienVoiture value
     *
     * The attribute identretienVoiture maps the field identretien_voiture defined as int(11).<br>
     * Comment for field identretien_voiture: Not specified.
     * @return int $identretienVoiture
     * @category Accessor of $identretienVoiture
     */
    public function getIdentretienVoiture()
    {
        return $this->identretienVoiture;
    }

    /**
     * getDate_ gets the class attribute date_ value
     *
     * The attribute date_ maps the field date_ defined as varchar(45).<br>
     * Comment for field date_: Not specified.
     * @return string $date_
     * @category Accessor of $date_
     */
    public function getDate_()
    {
        return $this->date_;
    }

    /**
     * getKm gets the class attribute km value
     *
     * The attribute km maps the field km defined as varchar(45).<br>
     * Comment for field km: Not specified.
     * @return string $km
     * @category Accessor of $km
     */
    public function getKm()
    {
        return $this->km;
    }

    /**
     * getOperation gets the class attribute operation value
     *
     * The attribute operation maps the field operation defined as varchar(45).<br>
     * Comment for field operation: Not specified.
     * @return string $operation
     * @category Accessor of $operation
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * getDesignation gets the class attribute designation value
     *
     * The attribute designation maps the field designation defined as varchar(45).<br>
     * Comment for field designation: Not specified.
     * @return string $designation
     * @category Accessor of $designation
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * getAmount gets the class attribute amount value
     *
     * The attribute amount maps the field amount defined as varchar(45).<br>
     * Comment for field amount: Not specified.
     * @return string $amount
     * @category Accessor of $amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * getVoitureId gets the class attribute voitureId value
     *
     * The attribute voitureId maps the field voiture_id defined as int(11).<br>
     * Comment for field voiture_id: Not specified.
     * @return int $voitureId
     * @category Accessor of $voitureId
     */
    public function getVoitureId()
    {
        return $this->voitureId;
    }

    /**
     * Gets DDL SQL code of the table entretien_voiture
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
        return "entretien_voiture";
    }

    /**
     * The BeanEntretienVoiture constructor
     *
     * It creates and initializes an object in two way:
     *  - with null (not fetched) data if none $identretienVoiture is given.
     *  - with a fetched data row from the table entretien_voiture having identretien_voiture=$identretienVoiture
     * @param int $identretienVoiture. If omitted an empty (not fetched) instance is created.
     * @return BeanEntretienVoiture Object
     */
    public function __construct($identretienVoiture = null)
    {
        parent::__construct();
        if (!empty($identretienVoiture)) {
            $this->select($identretienVoiture);
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
     * Fetchs a table row of entretien_voiture into the object.
     *
     * Fetched table fields values are assigned to class attributes and they can be managed by using
     * the accessors/modifiers methods of the class.
     * @param int $identretienVoiture the primary key identretien_voiture value of table entretien_voiture which identifies the row to select.
     * @return int affected selected row
     * @category DML
     */
    public function select($identretienVoiture)
    {
        $sql =  "SELECT * FROM entretien_voiture WHERE identretien_voiture={$this->parseValue($identretienVoiture,'int')}";
        $this->resetLastSqlError();
        $result =  $this->query($sql);
        $this->resultSet=$result;
        $this->lastSql = $sql;
        if ($result){
            $rowObject = $result->fetch_object();
            @$this->identretienVoiture = (integer)$rowObject->identretien_voiture;
            @$this->date_ = $this->replaceAposBackSlash($rowObject->date_);
            @$this->km = $this->replaceAposBackSlash($rowObject->km);
            @$this->operation = $this->replaceAposBackSlash($rowObject->operation);
            @$this->designation = $this->replaceAposBackSlash($rowObject->designation);
            @$this->amount = $this->replaceAposBackSlash($rowObject->amount);
            @$this->voitureId = (integer)$rowObject->voiture_id;
            $this->allowUpdate = true;
        } else {
            $this->lastSqlError = $this->sqlstate . " - ". $this->error;
        }
        return $this->affected_rows;
    }

    /**
     * Deletes a specific row from the table entretien_voiture
     * @param int $identretienVoiture the primary key identretien_voiture value of table entretien_voiture which identifies the row to delete.
     * @return int affected deleted row
     * @category DML
     */
    public function delete($identretienVoiture)
    {
        $sql = "DELETE FROM entretien_voiture WHERE identretien_voiture={$this->parseValue($identretienVoiture,'int')}";
        $this->resetLastSqlError();
        $result = $this->query($sql);
        $this->lastSql = $sql;
        if (!$result) {
            $this->lastSqlError = $this->sqlstate . " - ". $this->error;
        }
        return $this->affected_rows;
    }

    /**
     * Insert the current object into a new table row of entretien_voiture
     *
     * All class attributes values defined for mapping all table fields are automatically used during inserting
     * @return mixed MySQL insert result
     * @category DML
     */
    public function insert()
    {
        if ($this->isPkAutoIncrement) {
            $this->identretienVoiture = "";
        }
        // $constants = get_defined_constants();
        $sql = <<< SQL
            INSERT INTO entretien_voiture
            (date_,km,operation,designation,amount,voiture_id)
            VALUES(
			{$this->parseValue($this->date_,'notNumber')},
			{$this->parseValue($this->km,'notNumber')},
			{$this->parseValue($this->operation,'notNumber')},
			{$this->parseValue($this->designation,'notNumber')},
			{$this->parseValue($this->amount,'notNumber')},
			{$this->parseValue($this->voitureId)})
SQL;
        $this->resetLastSqlError();
        $result = $this->query($sql);
        $this->lastSql = $sql;
        if (!$result) {
            $this->lastSqlError = $this->sqlstate . " - ". $this->error;
        } else {
            $this->allowUpdate = true;
            if ($this->isPkAutoIncrement) {
                $this->identretienVoiture = $this->insert_id;
            }
        }
        return $result;
    }

    /**
     * Updates a specific row from the table entretien_voiture with the values of the current object.
     *
     * All class attribute values defined for mapping all table fields are automatically used during updating of selected row.<br>
     * Null values are used for all attributes not previously setted.
     * @param int $identretienVoiture the primary key identretien_voiture value of table entretien_voiture which identifies the row to update.
     * @return mixed MySQL update result
     * @category DML
     */
    public function update($identretienVoiture)
    {
        // $constants = get_defined_constants();
        if ($this->allowUpdate) {
            $sql = <<< SQL
            UPDATE
                entretien_voiture
            SET 
				date_={$this->parseValue($this->date_,'notNumber')},
				km={$this->parseValue($this->km,'notNumber')},
				operation={$this->parseValue($this->operation,'notNumber')},
				designation={$this->parseValue($this->designation,'notNumber')},
				amount={$this->parseValue($this->amount,'notNumber')},
				voiture_id={$this->parseValue($this->voitureId)}
            WHERE
                identretien_voiture={$this->parseValue($identretienVoiture,'int')}
SQL;
            $this->resetLastSqlError();
            $result = $this->query($sql);
            if (!$result) {
                $this->lastSqlError = $this->sqlstate . " - ". $this->error;
            } else {
                $this->select($identretienVoiture);
                $this->lastSql = $sql;
                return $result;
            }
        } else {
            return false;
        }
    }

    /**
     * Facility for updating a row of entretien_voiture previously loaded.
     *
     * All class attribute values defined for mapping all table fields are automatically used during updating.
     * @category DML Helper
     * @return mixed MySQLi update result
     */
    public function updateCurrent()
    {
        if ($this->identretienVoiture != "") {
            return $this->update($this->identretienVoiture);
        } else {
            return false;
        }
    }

}
?>
