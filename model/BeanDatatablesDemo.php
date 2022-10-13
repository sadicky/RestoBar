<?php
include_once("bean.config.php");

/**
 * Class BeanDatatablesDemo
 * Bean class for object oriented management of the MySQL table datatables_demo
 *
 * Comment of the managed table datatables_demo: Not specified.
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
 * @filesource BeanDatatablesDemo.php
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

class BeanDatatablesDemo extends MySqlRecord
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
     * Class attribute for mapping the primary key id of table datatables_demo
     *
     * Comment for field id: Not specified<br>
     * @var int $id
     */
    private $id;

    /**
     * A class attribute for evaluating if the table has an autoincrement primary key
     * @var bool $isPkAutoIncrement
     */
    private $isPkAutoIncrement = true;

    /**
     * Class attribute for mapping table field first_name
     *
     * Comment for field first_name: Not specified.<br>
     * Field information:
     *  - Data type: varchar(250)
     *  - Null : NO
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $firstName
     */
    private $firstName;

    /**
     * Class attribute for mapping table field last_name
     *
     * Comment for field last_name: Not specified.<br>
     * Field information:
     *  - Data type: varchar(250)
     *  - Null : NO
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $lastName
     */
    private $lastName;

    /**
     * Class attribute for mapping table field position
     *
     * Comment for field position: Not specified.<br>
     * Field information:
     *  - Data type: varchar(250)
     *  - Null : NO
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $position
     */
    private $position;

    /**
     * Class attribute for mapping table field email
     *
     * Comment for field email: Not specified.<br>
     * Field information:
     *  - Data type: varchar(250)
     *  - Null : NO
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $email
     */
    private $email;

    /**
     * Class attribute for mapping table field office
     *
     * Comment for field office: Not specified.<br>
     * Field information:
     *  - Data type: varchar(250)
     *  - Null : NO
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $office
     */
    private $office;

    /**
     * Class attribute for mapping table field start_date
     *
     * Comment for field start_date: Not specified.<br>
     * Field information:
     *  - Data type: datetime
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $startDate
     */
    private $startDate;

    /**
     * Class attribute for mapping table field age
     *
     * Comment for field age: Not specified.<br>
     * Field information:
     *  - Data type: int(8)
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var int $age
     */
    private $age;

    /**
     * Class attribute for mapping table field salary
     *
     * Comment for field salary: Not specified.<br>
     * Field information:
     *  - Data type: int(8)
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var int $salary
     */
    private $salary;

    /**
     * Class attribute for mapping table field seq
     *
     * Comment for field seq: Not specified.<br>
     * Field information:
     *  - Data type: int(8)
     *  - Null : YES
     *  - DB Index: MUL
     *  - Default: 
     *  - Extra:  
     * @var int $seq
     */
    private $seq;

    /**
     * Class attribute for mapping table field extn
     *
     * Comment for field extn: Not specified.<br>
     * Field information:
     *  - Data type: varchar(8)
     *  - Null : NO
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $extn
     */
    private $extn;

    /**
     * Class attribute for storing the SQL DDL of table datatables_demo
     * @var string base64 encoded string for DDL
     */
    private $ddl = "Q1JFQVRFIFRBQkxFIGBkYXRhdGFibGVzX2RlbW9gICgKICBgaWRgIGludCgxMCkgTk9UIE5VTEwgQVVUT19JTkNSRU1FTlQsCiAgYGZpcnN0X25hbWVgIHZhcmNoYXIoMjUwKSBOT1QgTlVMTCBERUZBVUxUICcnLAogIGBsYXN0X25hbWVgIHZhcmNoYXIoMjUwKSBOT1QgTlVMTCBERUZBVUxUICcnLAogIGBwb3NpdGlvbmAgdmFyY2hhcigyNTApIE5PVCBOVUxMIERFRkFVTFQgJycsCiAgYGVtYWlsYCB2YXJjaGFyKDI1MCkgTk9UIE5VTEwgREVGQVVMVCAnJywKICBgb2ZmaWNlYCB2YXJjaGFyKDI1MCkgTk9UIE5VTEwgREVGQVVMVCAnJywKICBgc3RhcnRfZGF0ZWAgZGF0ZXRpbWUgREVGQVVMVCBOVUxMLAogIGBhZ2VgIGludCg4KSBERUZBVUxUIE5VTEwsCiAgYHNhbGFyeWAgaW50KDgpIERFRkFVTFQgTlVMTCwKICBgc2VxYCBpbnQoOCkgREVGQVVMVCBOVUxMLAogIGBleHRuYCB2YXJjaGFyKDgpIE5PVCBOVUxMIERFRkFVTFQgJycsCiAgUFJJTUFSWSBLRVkgKGBpZGApLAogIEtFWSBgc2VxYCAoYHNlcWApCikgRU5HSU5FPU15SVNBTSBBVVRPX0lOQ1JFTUVOVD02MiBERUZBVUxUIENIQVJTRVQ9bGF0aW4x";

    /**
     * setId Sets the class attribute id with a given value
     *
     * The attribute id maps the field id defined as int(10).<br>
     * Comment for field id: Not specified.<br>
     * @param int $id
     * @category Modifier
     */
    public function setId($id)
    {
        $this->id = (int)$id;
    }

    /**
     * setFirstName Sets the class attribute firstName with a given value
     *
     * The attribute firstName maps the field first_name defined as varchar(250).<br>
     * Comment for field first_name: Not specified.<br>
     * @param string $firstName
     * @category Modifier
     */
    public function setFirstName($firstName)
    {
        $this->firstName = (string)$firstName;
    }

    /**
     * setLastName Sets the class attribute lastName with a given value
     *
     * The attribute lastName maps the field last_name defined as varchar(250).<br>
     * Comment for field last_name: Not specified.<br>
     * @param string $lastName
     * @category Modifier
     */
    public function setLastName($lastName)
    {
        $this->lastName = (string)$lastName;
    }

    /**
     * setPosition Sets the class attribute position with a given value
     *
     * The attribute position maps the field position defined as varchar(250).<br>
     * Comment for field position: Not specified.<br>
     * @param string $position
     * @category Modifier
     */
    public function setPosition($position)
    {
        $this->position = (string)$position;
    }

    /**
     * setEmail Sets the class attribute email with a given value
     *
     * The attribute email maps the field email defined as varchar(250).<br>
     * Comment for field email: Not specified.<br>
     * @param string $email
     * @category Modifier
     */
    public function setEmail($email)
    {
        $this->email = (string)$email;
    }

    /**
     * setOffice Sets the class attribute office with a given value
     *
     * The attribute office maps the field office defined as varchar(250).<br>
     * Comment for field office: Not specified.<br>
     * @param string $office
     * @category Modifier
     */
    public function setOffice($office)
    {
        $this->office = (string)$office;
    }

    /**
     * setStartDate Sets the class attribute startDate with a given value
     *
     * The attribute startDate maps the field start_date defined as datetime.<br>
     * Comment for field start_date: Not specified.<br>
     * @param string $startDate
     * @category Modifier
     */
    public function setStartDate($startDate)
    {
        $this->startDate = (string)$startDate;
    }

    /**
     * setAge Sets the class attribute age with a given value
     *
     * The attribute age maps the field age defined as int(8).<br>
     * Comment for field age: Not specified.<br>
     * @param int $age
     * @category Modifier
     */
    public function setAge($age)
    {
        $this->age = (int)$age;
    }

    /**
     * setSalary Sets the class attribute salary with a given value
     *
     * The attribute salary maps the field salary defined as int(8).<br>
     * Comment for field salary: Not specified.<br>
     * @param int $salary
     * @category Modifier
     */
    public function setSalary($salary)
    {
        $this->salary = (int)$salary;
    }

    /**
     * setSeq Sets the class attribute seq with a given value
     *
     * The attribute seq maps the field seq defined as int(8).<br>
     * Comment for field seq: Not specified.<br>
     * @param int $seq
     * @category Modifier
     */
    public function setSeq($seq)
    {
        $this->seq = (int)$seq;
    }

    /**
     * setExtn Sets the class attribute extn with a given value
     *
     * The attribute extn maps the field extn defined as varchar(8).<br>
     * Comment for field extn: Not specified.<br>
     * @param string $extn
     * @category Modifier
     */
    public function setExtn($extn)
    {
        $this->extn = (string)$extn;
    }

    /**
     * getId gets the class attribute id value
     *
     * The attribute id maps the field id defined as int(10).<br>
     * Comment for field id: Not specified.
     * @return int $id
     * @category Accessor of $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * getFirstName gets the class attribute firstName value
     *
     * The attribute firstName maps the field first_name defined as varchar(250).<br>
     * Comment for field first_name: Not specified.
     * @return string $firstName
     * @category Accessor of $firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * getLastName gets the class attribute lastName value
     *
     * The attribute lastName maps the field last_name defined as varchar(250).<br>
     * Comment for field last_name: Not specified.
     * @return string $lastName
     * @category Accessor of $lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * getPosition gets the class attribute position value
     *
     * The attribute position maps the field position defined as varchar(250).<br>
     * Comment for field position: Not specified.
     * @return string $position
     * @category Accessor of $position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * getEmail gets the class attribute email value
     *
     * The attribute email maps the field email defined as varchar(250).<br>
     * Comment for field email: Not specified.
     * @return string $email
     * @category Accessor of $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * getOffice gets the class attribute office value
     *
     * The attribute office maps the field office defined as varchar(250).<br>
     * Comment for field office: Not specified.
     * @return string $office
     * @category Accessor of $office
     */
    public function getOffice()
    {
        return $this->office;
    }

    /**
     * getStartDate gets the class attribute startDate value
     *
     * The attribute startDate maps the field start_date defined as datetime.<br>
     * Comment for field start_date: Not specified.
     * @return string $startDate
     * @category Accessor of $startDate
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * getAge gets the class attribute age value
     *
     * The attribute age maps the field age defined as int(8).<br>
     * Comment for field age: Not specified.
     * @return int $age
     * @category Accessor of $age
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * getSalary gets the class attribute salary value
     *
     * The attribute salary maps the field salary defined as int(8).<br>
     * Comment for field salary: Not specified.
     * @return int $salary
     * @category Accessor of $salary
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * getSeq gets the class attribute seq value
     *
     * The attribute seq maps the field seq defined as int(8).<br>
     * Comment for field seq: Not specified.
     * @return int $seq
     * @category Accessor of $seq
     */
    public function getSeq()
    {
        return $this->seq;
    }

    /**
     * getExtn gets the class attribute extn value
     *
     * The attribute extn maps the field extn defined as varchar(8).<br>
     * Comment for field extn: Not specified.
     * @return string $extn
     * @category Accessor of $extn
     */
    public function getExtn()
    {
        return $this->extn;
    }

    /**
     * Gets DDL SQL code of the table datatables_demo
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
        return "datatables_demo";
    }

    /**
     * The BeanDatatablesDemo constructor
     *
     * It creates and initializes an object in two way:
     *  - with null (not fetched) data if none $id is given.
     *  - with a fetched data row from the table datatables_demo having id=$id
     * @param int $id. If omitted an empty (not fetched) instance is created.
     * @return BeanDatatablesDemo Object
     */
    public function __construct($id = null)
    {
        parent::__construct();
        if (!empty($id)) {
            $this->select($id);
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
     * Fetchs a table row of datatables_demo into the object.
     *
     * Fetched table fields values are assigned to class attributes and they can be managed by using
     * the accessors/modifiers methods of the class.
     * @param int $id the primary key id value of table datatables_demo which identifies the row to select.
     * @return int affected selected row
     * @category DML
     */
    public function select($id)
    {
        $sql =  "SELECT * FROM datatables_demo WHERE id={$this->parseValue($id,'int')}";
        $this->resetLastSqlError();
        $result =  $this->query($sql);
        $this->resultSet=$result;
        $this->lastSql = $sql;
        if ($result){
            $rowObject = $result->fetch_object();
            @$this->id = (integer)$rowObject->id;
            @$this->firstName = $this->replaceAposBackSlash($rowObject->first_name);
            @$this->lastName = $this->replaceAposBackSlash($rowObject->last_name);
            @$this->position = $this->replaceAposBackSlash($rowObject->position);
            @$this->email = $this->replaceAposBackSlash($rowObject->email);
            @$this->office = $this->replaceAposBackSlash($rowObject->office);
            @$this->startDate = empty($rowObject->start_date) ? null : date(FETCHED_DATETIME_FORMAT,strtotime($rowObject->start_date));
            @$this->age = (integer)$rowObject->age;
            @$this->salary = (integer)$rowObject->salary;
            @$this->seq = (integer)$rowObject->seq;
            @$this->extn = $this->replaceAposBackSlash($rowObject->extn);
            $this->allowUpdate = true;
        } else {
            $this->lastSqlError = $this->sqlstate . " - ". $this->error;
        }
        return $this->affected_rows;
    }

    /**
     * Deletes a specific row from the table datatables_demo
     * @param int $id the primary key id value of table datatables_demo which identifies the row to delete.
     * @return int affected deleted row
     * @category DML
     */
    public function delete($id)
    {
        $sql = "DELETE FROM datatables_demo WHERE id={$this->parseValue($id,'int')}";
        $this->resetLastSqlError();
        $result = $this->query($sql);
        $this->lastSql = $sql;
        if (!$result) {
            $this->lastSqlError = $this->sqlstate . " - ". $this->error;
        }
        return $this->affected_rows;
    }

    /**
     * Insert the current object into a new table row of datatables_demo
     *
     * All class attributes values defined for mapping all table fields are automatically used during inserting
     * @return mixed MySQL insert result
     * @category DML
     */
    public function insert()
    {
        if ($this->isPkAutoIncrement) {
            $this->id = "";
        }
        // $constants = get_defined_constants();
        $sql = <<< SQL
            INSERT INTO datatables_demo
            (first_name,last_name,position,email,office,start_date,age,salary,seq,extn)
            VALUES(
			{$this->parseValue($this->firstName,'notNumber')},
			{$this->parseValue($this->lastName,'notNumber')},
			{$this->parseValue($this->position,'notNumber')},
			{$this->parseValue($this->email,'notNumber')},
			{$this->parseValue($this->office,'notNumber')},
			{$this->parseValue($this->startDate,'datetime')},
			{$this->parseValue($this->age)},
			{$this->parseValue($this->salary)},
			{$this->parseValue($this->seq)},
			{$this->parseValue($this->extn,'notNumber')})
SQL;
        $this->resetLastSqlError();
        $result = $this->query($sql);
        $this->lastSql = $sql;
        if (!$result) {
            $this->lastSqlError = $this->sqlstate . " - ". $this->error;
        } else {
            $this->allowUpdate = true;
            if ($this->isPkAutoIncrement) {
                $this->id = $this->insert_id;
            }
        }
        return $result;
    }

    /**
     * Updates a specific row from the table datatables_demo with the values of the current object.
     *
     * All class attribute values defined for mapping all table fields are automatically used during updating of selected row.<br>
     * Null values are used for all attributes not previously setted.
     * @param int $id the primary key id value of table datatables_demo which identifies the row to update.
     * @return mixed MySQL update result
     * @category DML
     */
    public function update($id)
    {
        // $constants = get_defined_constants();
        if ($this->allowUpdate) {
            $sql = <<< SQL
            UPDATE
                datatables_demo
            SET 
				first_name={$this->parseValue($this->firstName,'notNumber')},
				last_name={$this->parseValue($this->lastName,'notNumber')},
				position={$this->parseValue($this->position,'notNumber')},
				email={$this->parseValue($this->email,'notNumber')},
				office={$this->parseValue($this->office,'notNumber')},
				start_date={$this->parseValue($this->startDate,'datetime')},
				age={$this->parseValue($this->age)},
				salary={$this->parseValue($this->salary)},
				seq={$this->parseValue($this->seq)},
				extn={$this->parseValue($this->extn,'notNumber')}
            WHERE
                id={$this->parseValue($id,'int')}
SQL;
            $this->resetLastSqlError();
            $result = $this->query($sql);
            if (!$result) {
                $this->lastSqlError = $this->sqlstate . " - ". $this->error;
            } else {
                $this->select($id);
                $this->lastSql = $sql;
                return $result;
            }
        } else {
            return false;
        }
    }

    /**
     * Facility for updating a row of datatables_demo previously loaded.
     *
     * All class attribute values defined for mapping all table fields are automatically used during updating.
     * @category DML Helper
     * @return mixed MySQLi update result
     */
    public function updateCurrent()
    {
        if ($this->id != "") {
            return $this->update($this->id);
        } else {
            return false;
        }
    }

}
?>
