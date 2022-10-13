<?php
include_once("bean.config.php");

/**
 * Class BeanVoiture
 * Bean class for object oriented management of the MySQL table voiture
 *
 * Comment of the managed table voiture: Not specified.
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
 * @filesource BeanVoiture.php
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

class BeanVoiture extends MySqlRecord
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
     * Class attribute for mapping the primary key voiture_id of table voiture
     *
     * Comment for field voiture_id: Not specified<br>
     * @var int $voitureId
     */
    private $voitureId;

    /**
     * A class attribute for evaluating if the table has an autoincrement primary key
     * @var bool $isPkAutoIncrement
     */
    private $isPkAutoIncrement = true;

    /**
     * Class attribute for mapping table field plaque
     *
     * Comment for field plaque: Not specified.<br>
     * Field information:
     *  - Data type: varchar(45)
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $plaque
     */
    private $plaque;

    /**
     * Class attribute for mapping table field chassis
     *
     * Comment for field chassis: Not specified.<br>
     * Field information:
     *  - Data type: varchar(45)
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $chassis
     */
    private $chassis;

    /**
     * Class attribute for mapping table field marque
     *
     * Comment for field marque: Not specified.<br>
     * Field information:
     *  - Data type: varchar(45)
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $marque
     */
    private $marque;

    /**
     * Class attribute for mapping table field modele
     *
     * Comment for field modele: Not specified.<br>
     * Field information:
     *  - Data type: varchar(45)
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $modele
     */
    private $modele;

    /**
     * Class attribute for mapping table field kilometrage
     *
     * Comment for field kilometrage: Not specified.<br>
     * Field information:
     *  - Data type: varchar(45)
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $kilometrage
     */
    private $kilometrage;

    /**
     * Class attribute for mapping table field carburant
     *
     * Comment for field carburant: Not specified.<br>
     * Field information:
     *  - Data type: varchar(45)
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $carburant
     */
    private $carburant;

    /**
     * Class attribute for mapping table field last_controle_tech
     *
     * Comment for field last_controle_tech: Not specified.<br>
     * Field information:
     *  - Data type: string|date
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $lastControleTech
     */
    private $lastControleTech;

    /**
     * Class attribute for mapping table field next_controle_tech
     *
     * Comment for field next_controle_tech: Not specified.<br>
     * Field information:
     *  - Data type: string|date
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $nextControleTech
     */
    private $nextControleTech;

    /**
     * Class attribute for mapping table field photo
     *
     * Comment for field photo: Not specified.<br>
     * Field information:
     *  - Data type: varchar(45)
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var string $photo
     */
    private $photo;

    /**
     * Class attribute for mapping table field owner
     *
     * Comment for field owner: Not specified.<br>
     * Field information:
     *  - Data type: int(11)
     *  - Null : YES
     *  - DB Index: 
     *  - Default: 
     *  - Extra:  
     * @var int $owner
     */
    private $owner;

    /**
     * Class attribute for storing the SQL DDL of table voiture
     * @var string base64 encoded string for DDL
     */
    private $ddl = "Q1JFQVRFIFRBQkxFIGB2b2l0dXJlYCAoCiAgYHZvaXR1cmVfaWRgIGludCgxMSkgTk9UIE5VTEwgQVVUT19JTkNSRU1FTlQsCiAgYHBsYXF1ZWAgdmFyY2hhcig0NSkgREVGQVVMVCBOVUxMLAogIGBjaGFzc2lzYCB2YXJjaGFyKDQ1KSBERUZBVUxUIE5VTEwsCiAgYG1hcnF1ZWAgdmFyY2hhcig0NSkgREVGQVVMVCBOVUxMLAogIGBtb2RlbGVgIHZhcmNoYXIoNDUpIERFRkFVTFQgTlVMTCwKICBga2lsb21ldHJhZ2VgIHZhcmNoYXIoNDUpIERFRkFVTFQgTlVMTCwKICBgY2FyYnVyYW50YCB2YXJjaGFyKDQ1KSBERUZBVUxUIE5VTEwsCiAgYGxhc3RfY29udHJvbGVfdGVjaGAgZGF0ZSBERUZBVUxUIE5VTEwsCiAgYG5leHRfY29udHJvbGVfdGVjaGAgZGF0ZSBERUZBVUxUIE5VTEwsCiAgYHBob3RvYCB2YXJjaGFyKDQ1KSBERUZBVUxUIE5VTEwsCiAgYG93bmVyYCBpbnQoMTEpIERFRkFVTFQgTlVMTCwKICBQUklNQVJZIEtFWSAoYHZvaXR1cmVfaWRgKQopIEVOR0lORT1NeUlTQU0gREVGQVVMVCBDSEFSU0VUPWxhdGluMQ==";

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
     * setPlaque Sets the class attribute plaque with a given value
     *
     * The attribute plaque maps the field plaque defined as varchar(45).<br>
     * Comment for field plaque: Not specified.<br>
     * @param string $plaque
     * @category Modifier
     */
    public function setPlaque($plaque)
    {
        $this->plaque = (string)$plaque;
    }

    /**
     * setChassis Sets the class attribute chassis with a given value
     *
     * The attribute chassis maps the field chassis defined as varchar(45).<br>
     * Comment for field chassis: Not specified.<br>
     * @param string $chassis
     * @category Modifier
     */
    public function setChassis($chassis)
    {
        $this->chassis = (string)$chassis;
    }

    /**
     * setMarque Sets the class attribute marque with a given value
     *
     * The attribute marque maps the field marque defined as varchar(45).<br>
     * Comment for field marque: Not specified.<br>
     * @param string $marque
     * @category Modifier
     */
    public function setMarque($marque)
    {
        $this->marque = (string)$marque;
    }

    /**
     * setModele Sets the class attribute modele with a given value
     *
     * The attribute modele maps the field modele defined as varchar(45).<br>
     * Comment for field modele: Not specified.<br>
     * @param string $modele
     * @category Modifier
     */
    public function setModele($modele)
    {
        $this->modele = (string)$modele;
    }

    /**
     * setKilometrage Sets the class attribute kilometrage with a given value
     *
     * The attribute kilometrage maps the field kilometrage defined as varchar(45).<br>
     * Comment for field kilometrage: Not specified.<br>
     * @param string $kilometrage
     * @category Modifier
     */
    public function setKilometrage($kilometrage)
    {
        $this->kilometrage = (string)$kilometrage;
    }

    /**
     * setCarburant Sets the class attribute carburant with a given value
     *
     * The attribute carburant maps the field carburant defined as varchar(45).<br>
     * Comment for field carburant: Not specified.<br>
     * @param string $carburant
     * @category Modifier
     */
    public function setCarburant($carburant)
    {
        $this->carburant = (string)$carburant;
    }

    /**
     * setLastControleTech Sets the class attribute lastControleTech with a given value
     *
     * The attribute lastControleTech maps the field last_controle_tech defined as string|date.<br>
     * Comment for field last_controle_tech: Not specified.<br>
     * @param string $lastControleTech
     * @category Modifier
     */
    public function setLastControleTech($lastControleTech)
    {
        $this->lastControleTech = (string)$lastControleTech;
    }

    /**
     * setNextControleTech Sets the class attribute nextControleTech with a given value
     *
     * The attribute nextControleTech maps the field next_controle_tech defined as string|date.<br>
     * Comment for field next_controle_tech: Not specified.<br>
     * @param string $nextControleTech
     * @category Modifier
     */
    public function setNextControleTech($nextControleTech)
    {
        $this->nextControleTech = (string)$nextControleTech;
    }

    /**
     * setPhoto Sets the class attribute photo with a given value
     *
     * The attribute photo maps the field photo defined as varchar(45).<br>
     * Comment for field photo: Not specified.<br>
     * @param string $photo
     * @category Modifier
     */
    public function setPhoto($photo)
    {
        $this->photo = (string)$photo;
    }

    /**
     * setOwner Sets the class attribute owner with a given value
     *
     * The attribute owner maps the field owner defined as int(11).<br>
     * Comment for field owner: Not specified.<br>
     * @param int $owner
     * @category Modifier
     */
    public function setOwner($owner)
    {
        $this->owner = (int)$owner;
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
     * getPlaque gets the class attribute plaque value
     *
     * The attribute plaque maps the field plaque defined as varchar(45).<br>
     * Comment for field plaque: Not specified.
     * @return string $plaque
     * @category Accessor of $plaque
     */
    public function getPlaque()
    {
        return $this->plaque;
    }

    /**
     * getChassis gets the class attribute chassis value
     *
     * The attribute chassis maps the field chassis defined as varchar(45).<br>
     * Comment for field chassis: Not specified.
     * @return string $chassis
     * @category Accessor of $chassis
     */
    public function getChassis()
    {
        return $this->chassis;
    }

    /**
     * getMarque gets the class attribute marque value
     *
     * The attribute marque maps the field marque defined as varchar(45).<br>
     * Comment for field marque: Not specified.
     * @return string $marque
     * @category Accessor of $marque
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * getModele gets the class attribute modele value
     *
     * The attribute modele maps the field modele defined as varchar(45).<br>
     * Comment for field modele: Not specified.
     * @return string $modele
     * @category Accessor of $modele
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * getKilometrage gets the class attribute kilometrage value
     *
     * The attribute kilometrage maps the field kilometrage defined as varchar(45).<br>
     * Comment for field kilometrage: Not specified.
     * @return string $kilometrage
     * @category Accessor of $kilometrage
     */
    public function getKilometrage()
    {
        return $this->kilometrage;
    }

    /**
     * getCarburant gets the class attribute carburant value
     *
     * The attribute carburant maps the field carburant defined as varchar(45).<br>
     * Comment for field carburant: Not specified.
     * @return string $carburant
     * @category Accessor of $carburant
     */
    public function getCarburant()
    {
        return $this->carburant;
    }

    /**
     * getLastControleTech gets the class attribute lastControleTech value
     *
     * The attribute lastControleTech maps the field last_controle_tech defined as string|date.<br>
     * Comment for field last_controle_tech: Not specified.
     * @return string $lastControleTech
     * @category Accessor of $lastControleTech
     */
    public function getLastControleTech()
    {
        return $this->lastControleTech;
    }

    /**
     * getNextControleTech gets the class attribute nextControleTech value
     *
     * The attribute nextControleTech maps the field next_controle_tech defined as string|date.<br>
     * Comment for field next_controle_tech: Not specified.
     * @return string $nextControleTech
     * @category Accessor of $nextControleTech
     */
    public function getNextControleTech()
    {
        return $this->nextControleTech;
    }

    /**
     * getPhoto gets the class attribute photo value
     *
     * The attribute photo maps the field photo defined as varchar(45).<br>
     * Comment for field photo: Not specified.
     * @return string $photo
     * @category Accessor of $photo
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * getOwner gets the class attribute owner value
     *
     * The attribute owner maps the field owner defined as int(11).<br>
     * Comment for field owner: Not specified.
     * @return int $owner
     * @category Accessor of $owner
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Gets DDL SQL code of the table voiture
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
        return "voiture";
    }

    /**
     * The BeanVoiture constructor
     *
     * It creates and initializes an object in two way:
     *  - with null (not fetched) data if none $voitureId is given.
     *  - with a fetched data row from the table voiture having voiture_id=$voitureId
     * @param int $voitureId. If omitted an empty (not fetched) instance is created.
     * @return BeanVoiture Object
     */
    public function __construct($voitureId = null)
    {
        parent::__construct();
        if (!empty($voitureId)) {
            $this->select($voitureId);
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
     * Fetchs a table row of voiture into the object.
     *
     * Fetched table fields values are assigned to class attributes and they can be managed by using
     * the accessors/modifiers methods of the class.
     * @param int $voitureId the primary key voiture_id value of table voiture which identifies the row to select.
     * @return int affected selected row
     * @category DML
     */
    public function select($voitureId)
    {
        $sql =  "SELECT * FROM voiture WHERE voiture_id={$this->parseValue($voitureId,'int')}";
        $this->resetLastSqlError();
        $result =  $this->query($sql);
        $this->resultSet=$result;
        $this->lastSql = $sql;
        if ($result){
            $rowObject = $result->fetch_object();
            @$this->voitureId = (integer)$rowObject->voiture_id;
            @$this->plaque = $this->replaceAposBackSlash($rowObject->plaque);
            @$this->chassis = $this->replaceAposBackSlash($rowObject->chassis);
            @$this->marque = $this->replaceAposBackSlash($rowObject->marque);
            @$this->modele = $this->replaceAposBackSlash($rowObject->modele);
            @$this->kilometrage = $this->replaceAposBackSlash($rowObject->kilometrage);
            @$this->carburant = $this->replaceAposBackSlash($rowObject->carburant);
            @$this->lastControleTech = empty($rowObject->last_controle_tech) ? null : date(FETCHED_DATE_FORMAT,strtotime($rowObject->last_controle_tech));
            @$this->nextControleTech = empty($rowObject->next_controle_tech) ? null : date(FETCHED_DATE_FORMAT,strtotime($rowObject->next_controle_tech));
            @$this->photo = $this->replaceAposBackSlash($rowObject->photo);
            @$this->owner = (integer)$rowObject->owner;
            $this->allowUpdate = true;
        } else {
            $this->lastSqlError = $this->sqlstate . " - ". $this->error;
        }
        return $this->affected_rows;
    }

    /**
     * Deletes a specific row from the table voiture
     * @param int $voitureId the primary key voiture_id value of table voiture which identifies the row to delete.
     * @return int affected deleted row
     * @category DML
     */
    public function delete($voitureId)
    {
        $sql = "DELETE FROM voiture WHERE voiture_id={$this->parseValue($voitureId,'int')}";
        $this->resetLastSqlError();
        $result = $this->query($sql);
        $this->lastSql = $sql;
        if (!$result) {
            $this->lastSqlError = $this->sqlstate . " - ". $this->error;
        }
        return $this->affected_rows;
    }

    /**
     * Insert the current object into a new table row of voiture
     *
     * All class attributes values defined for mapping all table fields are automatically used during inserting
     * @return mixed MySQL insert result
     * @category DML
     */
    public function insert()
    {
        if ($this->isPkAutoIncrement) {
            $this->voitureId = "";
        }
        // $constants = get_defined_constants();
        $sql = <<< SQL
            INSERT INTO voiture
            (plaque,chassis,marque,modele,kilometrage,carburant,last_controle_tech,next_controle_tech,photo,owner)
            VALUES(
			{$this->parseValue($this->plaque,'notNumber')},
			{$this->parseValue($this->chassis,'notNumber')},
			{$this->parseValue($this->marque,'notNumber')},
			{$this->parseValue($this->modele,'notNumber')},
			{$this->parseValue($this->kilometrage,'notNumber')},
			{$this->parseValue($this->carburant,'notNumber')},
			{$this->parseValue($this->lastControleTech,'date')},
			{$this->parseValue($this->nextControleTech,'date')},
			{$this->parseValue($this->photo,'notNumber')},
			{$this->parseValue($this->owner)})
SQL;
        $this->resetLastSqlError();
        $result = $this->query($sql);
        $this->lastSql = $sql;
        if (!$result) {
            $this->lastSqlError = $this->sqlstate . " - ". $this->error;
        } else {
            $this->allowUpdate = true;
            if ($this->isPkAutoIncrement) {
                $this->voitureId = $this->insert_id;
            }
        }
        return $result;
    }

    /**
     * Updates a specific row from the table voiture with the values of the current object.
     *
     * All class attribute values defined for mapping all table fields are automatically used during updating of selected row.<br>
     * Null values are used for all attributes not previously setted.
     * @param int $voitureId the primary key voiture_id value of table voiture which identifies the row to update.
     * @return mixed MySQL update result
     * @category DML
     */
    public function update($voitureId)
    {
        // $constants = get_defined_constants();
        if ($this->allowUpdate) {
            $sql = <<< SQL
            UPDATE
                voiture
            SET 
				plaque={$this->parseValue($this->plaque,'notNumber')},
				chassis={$this->parseValue($this->chassis,'notNumber')},
				marque={$this->parseValue($this->marque,'notNumber')},
				modele={$this->parseValue($this->modele,'notNumber')},
				kilometrage={$this->parseValue($this->kilometrage,'notNumber')},
				carburant={$this->parseValue($this->carburant,'notNumber')},
				last_controle_tech={$this->parseValue($this->lastControleTech,'date')},
				next_controle_tech={$this->parseValue($this->nextControleTech,'date')},
				photo={$this->parseValue($this->photo,'notNumber')},
				owner={$this->parseValue($this->owner)}
            WHERE
                voiture_id={$this->parseValue($voitureId,'int')}
SQL;
            $this->resetLastSqlError();
            $result = $this->query($sql);
            if (!$result) {
                $this->lastSqlError = $this->sqlstate . " - ". $this->error;
            } else {
                $this->select($voitureId);
                $this->lastSql = $sql;
                return $result;
            }
        } else {
            return false;
        }
    }

    /**
     * Facility for updating a row of voiture previously loaded.
     *
     * All class attribute values defined for mapping all table fields are automatically used during updating.
     * @category DML Helper
     * @return mixed MySQLi update result
     */
    public function updateCurrent()
    {
        if ($this->voitureId != "") {
            return $this->update($this->voitureId);
        } else {
            return false;
        }
    }

}
?>
