<?php
include_once("bean.config.php");

/**
 * Class BeanStaff
 * Bean class for object oriented management of the MySQL table staff
 *
 * Comment of the managed table staff: Not specified.
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
 * @filesource BeanStaff.php
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

class BeanStaff extends MySqlRecord
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
     * Class attribute for mapping the primary key staff_id of table staff
     *
     * Comment for field staff_id: Not specified<br>
     * @var int $staffId
     */
    private $staffId;

    /**
     * A class attribute for evaluating if the table has an autoincrement primary key
     * @var bool $isPkAutoIncrement
     */
    private $isPkAutoIncrement = true;

    /**
     * Class attribute for mapping table field staff_role
     *
     * Comment for field staff_role: Not specified.<br>
     * Field information:
     *  - Data type: varchar(45)
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $staffRole
     */
    private $staffRole;

    /**
     * Class attribute for mapping table field created_date
     *
     * Comment for field created_date: Not specified.<br>
     * Field information:
     *  - Data type: varchar(45)
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $createdDate
     */
    private $createdDate;

    /**
     * Class attribute for mapping table field personne_id
     *
     * Comment for field personne_id: Not specified.<br>
     * Field information:
     *  - Data type: int(11)
     *  - Null : NO
     *  - DB Index: MUL
     *  - Default: 
     *  - Extra:  
     * @var int $personneId
     */
    private $personneId;

    /**
     * Class attribute for storing the SQL DDL of table staff
     * @var string base64 encoded string for DDL
     */
    private $ddl = "Q1JFQVRFIFRBQkxFIGBzdGFmZmAgKAogIGBzdGFmZl9pZGAgaW50KDExKSBOT1QgTlVMTCBBVVRPX0lOQ1JFTUVOVCwKICBgc3RhZmZfcm9sZWAgdmFyY2hhcig0NSkgREVGQVVMVCBOVUxMLAogIGBjcmVhdGVkX2RhdGVgIHZhcmNoYXIoNDUpIERFRkFVTFQgTlVMTCwKICBgcGVyc29ubmVfaWRgIGludCgxMSkgTk9UIE5VTEwsCiAgUFJJTUFSWSBLRVkgKGBzdGFmZl9pZGApLAogIEtFWSBgcGVyc29ubmVfaWRgIChgcGVyc29ubmVfaWRgKQopIEVOR0lORT1NeUlTQU0gQVVUT19JTkNSRU1FTlQ9NSBERUZBVUxUIENIQVJTRVQ9bGF0aW4x";

    /**
     * setStaffId Sets the class attribute staffId with a given value
     *
     * The attribute staffId maps the field staff_id defined as int(11).<br>
     * Comment for field staff_id: Not specified.<br>
     * @param int $staffId
     * @category Modifier
     */
    public function setStaffId($staffId)
    {
        $this->staffId = (int)$staffId;
    }

    /**
     * setStaffRole Sets the class attribute staffRole with a given value
     *
     * The attribute staffRole maps the field staff_role defined as varchar(45).<br>
     * Comment for field staff_role: Not specified.<br>
     * @param string $staffRole
     * @category Modifier
     */
    public function setStaffRole($staffRole)
    {
        $this->staffRole = (string)$staffRole;
    }

    /**
     * setCreatedDate Sets the class attribute createdDate with a given value
     *
     * The attribute createdDate maps the field created_date defined as varchar(45).<br>
     * Comment for field created_date: Not specified.<br>
     * @param string $createdDate
     * @category Modifier
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = (string)$createdDate;
    }

    /**
     * setPersonneId Sets the class attribute personneId with a given value
     *
     * The attribute personneId maps the field personne_id defined as int(11).<br>
     * Comment for field personne_id: Not specified.<br>
     * @param int $personneId
     * @category Modifier
     */
    public function setPersonneId($personneId)
    {
        $this->personneId = (int)$personneId;
    }

    /**
     * getStaffId gets the class attribute staffId value
     *
     * The attribute staffId maps the field staff_id defined as int(11).<br>
     * Comment for field staff_id: Not specified.
     * @return int $staffId
     * @category Accessor of $staffId
     */
    public function getStaffId()
    {
        return $this->staffId;
    }

    /**
     * getStaffRole gets the class attribute staffRole value
     *
     * The attribute staffRole maps the field staff_role defined as varchar(45).<br>
     * Comment for field staff_role: Not specified.
     * @return string $staffRole
     * @category Accessor of $staffRole
     */
    public function getStaffRole()
    {
        return $this->staffRole;
    }

    /**
     * getCreatedDate gets the class attribute createdDate value
     *
     * The attribute createdDate maps the field created_date defined as varchar(45).<br>
     * Comment for field created_date: Not specified.
     * @return string $createdDate
     * @category Accessor of $createdDate
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * getPersonneId gets the class attribute personneId value
     *
     * The attribute personneId maps the field personne_id defined as int(11).<br>
     * Comment for field personne_id: Not specified.
     * @return int $personneId
     * @category Accessor of $personneId
     */
    public function getPersonneId()
    {
        return $this->personneId;
    }

    /**
     * Gets DDL SQL code of the table staff
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
        return "staff";
    }

    /**
     * The BeanStaff constructor
     *
     * It creates and initializes an object in two way:
     *  - with null (not fetched) data if none $staffId is given.
     *  - with a fetched data row from the table staff having staff_id=$staffId
     * @param int $staffId. If omitted an empty (not fetched) instance is created.
     * @return BeanStaff Object
     */
    public function __construct($staffId = null)
    {
        parent::__construct();
        if (!empty($staffId)) {
            $this->select($staffId);
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
     * Fetchs a table row of staff into the object.
     *
     * Fetched table fields values are assigned to class attributes and they can be managed by using
     * the accessors/modifiers methods of the class.
     * @param int $staffId the primary key staff_id value of table staff which identifies the row to select.
     * @return int affected selected row
     * @category DML
     */
    public function select($staffId)
    {
        $sql =  "SELECT * FROM staff WHERE staff_id={$this->parseValue($staffId,'int')}";
        $this->resetLastSqlError();
        $result =  $this->query($sql);
        $this->resultSet=$result;
        $this->lastSql = $sql;
        if ($result){
            $rowObject = $result->fetch_object();
            @$this->staffId = (integer)$rowObject->staff_id;
            @$this->staffRole = $this->replaceAposBackSlash($rowObject->staff_role);
            @$this->createdDate = $this->replaceAposBackSlash($rowObject->created_date);
            @$this->personneId = (integer)$rowObject->personne_id;
            $this->allowUpdate = true;
        } else {
            $this->lastSqlError = $this->sqlstate . " - ". $this->error;
        }
        return $this->affected_rows;
    }

    /**
     * Deletes a specific row from the table staff
     * @param int $staffId the primary key staff_id value of table staff which identifies the row to delete.
     * @return int affected deleted row
     * @category DML
     */
    public function delete($staffId)
    {
        $sql = "DELETE FROM staff WHERE staff_id={$this->parseValue($staffId,'int')}";
        $this->resetLastSqlError();
        $result = $this->query($sql);
        $this->lastSql = $sql;
        if (!$result) {
            $this->lastSqlError = $this->sqlstate . " - ". $this->error;
        }
        return $this->affected_rows;
    }

    /**
     * Insert the current object into a new table row of staff
     *
     * All class attributes values defined for mapping all table fields are automatically used during inserting
     * @return mixed MySQL insert result
     * @category DML
     */
    public function insert()
    {
        if ($this->isPkAutoIncrement) {
            $this->staffId = "";
        }
        // $constants = get_defined_constants();
        $sql = <<< SQL
            INSERT INTO staff
            (staff_role,created_date,personne_id)
            VALUES(
			{$this->parseValue($this->staffRole,'notNumber')},
			{$this->parseValue($this->createdDate,'notNumber')},
			{$this->parseValue($this->personneId)})
SQL;
        $this->resetLastSqlError();
        $result = $this->query($sql);
        $this->lastSql = $sql;
        if (!$result) {
            $this->lastSqlError = $this->sqlstate . " - ". $this->error;
        } else {
            $this->allowUpdate = true;
            if ($this->isPkAutoIncrement) {
                $this->staffId = $this->insert_id;
            }
        }
        return $result;
    }

    /**
     * Updates a specific row from the table staff with the values of the current object.
     *
     * All class attribute values defined for mapping all table fields are automatically used during updating of selected row.<br>
     * Null values are used for all attributes not previously setted.
     * @param int $staffId the primary key staff_id value of table staff which identifies the row to update.
     * @return mixed MySQL update result
     * @category DML
     */
    public function update($staffId)
    {
        // $constants = get_defined_constants();
        if ($this->allowUpdate) {
            $sql = <<< SQL
            UPDATE
                staff
            SET 
				staff_role={$this->parseValue($this->staffRole,'notNumber')},
				created_date={$this->parseValue($this->createdDate,'notNumber')},
				personne_id={$this->parseValue($this->personneId)}
            WHERE
                staff_id={$this->parseValue($staffId,'int')}
SQL;
            $this->resetLastSqlError();
            $result = $this->query($sql);
            if (!$result) {
                $this->lastSqlError = $this->sqlstate . " - ". $this->error;
            } else {
                $this->select($staffId);
                $this->lastSql = $sql;
                return $result;
            }
        } else {
            return false;
        }
    }

    /**
     * Facility for updating a row of staff previously loaded.
     *
     * All class attribute values defined for mapping all table fields are automatically used during updating.
     * @category DML Helper
     * @return mixed MySQLi update result
     */
    public function updateCurrent()
    {
        if ($this->staffId != "") {
            return $this->update($this->staffId);
        } else {
            return false;
        }
    }

}
?>
