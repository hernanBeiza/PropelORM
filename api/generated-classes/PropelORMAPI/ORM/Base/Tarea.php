<?php

namespace PropelORMAPI\ORM\Base;

use \DateTime;
use \Exception;
use \PDO;
use PropelORMAPI\ORM\Tarea as ChildTarea;
use PropelORMAPI\ORM\TareaQuery as ChildTareaQuery;
use PropelORMAPI\ORM\Usuario as ChildUsuario;
use PropelORMAPI\ORM\UsuarioQuery as ChildUsuarioQuery;
use PropelORMAPI\ORM\Usuariotarea as ChildUsuariotarea;
use PropelORMAPI\ORM\UsuariotareaQuery as ChildUsuariotareaQuery;
use PropelORMAPI\ORM\Map\TareaTableMap;
use PropelORMAPI\ORM\Map\UsuariotareaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Collection\ObjectCombinationCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'tarea' table.
 *
 *
 *
 * @package    propel.generator.PropelORMAPI.ORM.Base
 */
abstract class Tarea implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\PropelORMAPI\\ORM\\Map\\TareaTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the idtarea field.
     *
     * @var        int
     */
    protected $idtarea;

    /**
     * The value for the titulo field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $titulo;

    /**
     * The value for the timestamp field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $timestamp;

    /**
     * The value for the valid field.
     *
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $valid;

    /**
     * @var        ObjectCollection|ChildUsuariotarea[] Collection to store aggregation of ChildUsuariotarea objects.
     */
    protected $collUsuariotareas;
    protected $collUsuariotareasPartial;

    /**
     * @var ObjectCombinationCollection Cross CombinationCollection to store aggregation of ChildUsuario combinations.
     */
    protected $combinationCollUsuarioIdusuariotareas;

    /**
     * @var bool
     */
    protected $combinationCollUsuarioIdusuariotareasPartial;

    /**
     * @var        ObjectCollection|ChildUsuario[] Cross Collection to store aggregation of ChildUsuario objects.
     */
    protected $collUsuarios;

    /**
     * @var bool
     */
    protected $collUsuariosPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * @var ObjectCombinationCollection Cross CombinationCollection to store aggregation of ChildUsuario combinations.
     */
    protected $combinationCollUsuarioIdusuariotareasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUsuariotarea[]
     */
    protected $usuariotareasScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->titulo = '';
        $this->valid = 1;
    }

    /**
     * Initializes internal state of PropelORMAPI\ORM\Base\Tarea object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Tarea</code> instance.  If
     * <code>obj</code> is an instance of <code>Tarea</code>, delegates to
     * <code>equals(Tarea)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Tarea The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [idtarea] column value.
     *
     * @return int
     */
    public function getIdtarea()
    {
        return $this->idtarea;
    }

    /**
     * Get the [titulo] column value.
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Get the [optionally formatted] temporal [timestamp] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getTimestamp($format = NULL)
    {
        if ($format === null) {
            return $this->timestamp;
        } else {
            return $this->timestamp instanceof \DateTimeInterface ? $this->timestamp->format($format) : null;
        }
    }

    /**
     * Get the [valid] column value.
     *
     * @return int
     */
    public function getValid()
    {
        return $this->valid;
    }

    /**
     * Set the value of [idtarea] column.
     *
     * @param int $v new value
     * @return $this|\PropelORMAPI\ORM\Tarea The current object (for fluent API support)
     */
    public function setIdtarea($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->idtarea !== $v) {
            $this->idtarea = $v;
            $this->modifiedColumns[TareaTableMap::COL_IDTAREA] = true;
        }

        return $this;
    } // setIdtarea()

    /**
     * Set the value of [titulo] column.
     *
     * @param string $v new value
     * @return $this|\PropelORMAPI\ORM\Tarea The current object (for fluent API support)
     */
    public function setTitulo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->titulo !== $v) {
            $this->titulo = $v;
            $this->modifiedColumns[TareaTableMap::COL_TITULO] = true;
        }

        return $this;
    } // setTitulo()

    /**
     * Sets the value of [timestamp] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\PropelORMAPI\ORM\Tarea The current object (for fluent API support)
     */
    public function setTimestamp($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->timestamp !== null || $dt !== null) {
            if ($this->timestamp === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->timestamp->format("Y-m-d H:i:s.u")) {
                $this->timestamp = $dt === null ? null : clone $dt;
                $this->modifiedColumns[TareaTableMap::COL_TIMESTAMP] = true;
            }
        } // if either are not null

        return $this;
    } // setTimestamp()

    /**
     * Set the value of [valid] column.
     *
     * @param int $v new value
     * @return $this|\PropelORMAPI\ORM\Tarea The current object (for fluent API support)
     */
    public function setValid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->valid !== $v) {
            $this->valid = $v;
            $this->modifiedColumns[TareaTableMap::COL_VALID] = true;
        }

        return $this;
    } // setValid()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->titulo !== '') {
                return false;
            }

            if ($this->valid !== 1) {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : TareaTableMap::translateFieldName('Idtarea', TableMap::TYPE_PHPNAME, $indexType)];
            $this->idtarea = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : TareaTableMap::translateFieldName('Titulo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->titulo = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : TareaTableMap::translateFieldName('Timestamp', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->timestamp = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : TareaTableMap::translateFieldName('Valid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->valid = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 4; // 4 = TareaTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\PropelORMAPI\\ORM\\Tarea'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TareaTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildTareaQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collUsuariotareas = null;

            $this->collUsuarioIdusuariotareas = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Tarea::setDeleted()
     * @see Tarea::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(TareaTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildTareaQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(TareaTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                TareaTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->combinationCollUsuarioIdusuariotareasScheduledForDeletion !== null) {
                if (!$this->combinationCollUsuarioIdusuariotareasScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    foreach ($this->combinationCollUsuarioIdusuariotareasScheduledForDeletion as $combination) {
                        $entryPk = [];

                        $entryPk[2] = $this->getIdtarea();
                        $entryPk[1] = $combination[0]->getIdusuario();
                        //$combination[1] = Idusuariotarea;
                        $entryPk[0] = $combination[1];

                        $pks[] = $entryPk;
                    }

                    \PropelORMAPI\ORM\UsuariotareaQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);

                    $this->combinationCollUsuarioIdusuariotareasScheduledForDeletion = null;
                }

            }

            if (null !== $this->combinationCollUsuarioIdusuariotareas) {
                foreach ($this->combinationCollUsuarioIdusuariotareas as $combination) {

                    //$combination[0] = Usuario (fkusuariotareaidusuario)
                    if (!$combination[0]->isDeleted() && ($combination[0]->isNew() || $combination[0]->isModified())) {
                        $combination[0]->save($con);
                    }

                    //$combination[1] = Idusuariotarea; Nothing to save.
                }
            }


            if ($this->usuariotareasScheduledForDeletion !== null) {
                if (!$this->usuariotareasScheduledForDeletion->isEmpty()) {
                    \PropelORMAPI\ORM\UsuariotareaQuery::create()
                        ->filterByPrimaryKeys($this->usuariotareasScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->usuariotareasScheduledForDeletion = null;
                }
            }

            if ($this->collUsuariotareas !== null) {
                foreach ($this->collUsuariotareas as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[TareaTableMap::COL_IDTAREA] = true;
        if (null !== $this->idtarea) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . TareaTableMap::COL_IDTAREA . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TareaTableMap::COL_IDTAREA)) {
            $modifiedColumns[':p' . $index++]  = 'idtarea';
        }
        if ($this->isColumnModified(TareaTableMap::COL_TITULO)) {
            $modifiedColumns[':p' . $index++]  = 'titulo';
        }
        if ($this->isColumnModified(TareaTableMap::COL_TIMESTAMP)) {
            $modifiedColumns[':p' . $index++]  = 'timestamp';
        }
        if ($this->isColumnModified(TareaTableMap::COL_VALID)) {
            $modifiedColumns[':p' . $index++]  = 'valid';
        }

        $sql = sprintf(
            'INSERT INTO tarea (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'idtarea':
                        $stmt->bindValue($identifier, $this->idtarea, PDO::PARAM_INT);
                        break;
                    case 'titulo':
                        $stmt->bindValue($identifier, $this->titulo, PDO::PARAM_STR);
                        break;
                    case 'timestamp':
                        $stmt->bindValue($identifier, $this->timestamp ? $this->timestamp->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'valid':
                        $stmt->bindValue($identifier, $this->valid, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdtarea($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = TareaTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getIdtarea();
                break;
            case 1:
                return $this->getTitulo();
                break;
            case 2:
                return $this->getTimestamp();
                break;
            case 3:
                return $this->getValid();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Tarea'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Tarea'][$this->hashCode()] = true;
        $keys = TareaTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdtarea(),
            $keys[1] => $this->getTitulo(),
            $keys[2] => $this->getTimestamp(),
            $keys[3] => $this->getValid(),
        );
        if ($result[$keys[2]] instanceof \DateTimeInterface) {
            $result[$keys[2]] = $result[$keys[2]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collUsuariotareas) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'usuariotareas';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'usuariotareas';
                        break;
                    default:
                        $key = 'Usuariotareas';
                }

                $result[$key] = $this->collUsuariotareas->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\PropelORMAPI\ORM\Tarea
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = TareaTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\PropelORMAPI\ORM\Tarea
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdtarea($value);
                break;
            case 1:
                $this->setTitulo($value);
                break;
            case 2:
                $this->setTimestamp($value);
                break;
            case 3:
                $this->setValid($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = TareaTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdtarea($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setTitulo($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setTimestamp($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setValid($arr[$keys[3]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\PropelORMAPI\ORM\Tarea The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(TareaTableMap::DATABASE_NAME);

        if ($this->isColumnModified(TareaTableMap::COL_IDTAREA)) {
            $criteria->add(TareaTableMap::COL_IDTAREA, $this->idtarea);
        }
        if ($this->isColumnModified(TareaTableMap::COL_TITULO)) {
            $criteria->add(TareaTableMap::COL_TITULO, $this->titulo);
        }
        if ($this->isColumnModified(TareaTableMap::COL_TIMESTAMP)) {
            $criteria->add(TareaTableMap::COL_TIMESTAMP, $this->timestamp);
        }
        if ($this->isColumnModified(TareaTableMap::COL_VALID)) {
            $criteria->add(TareaTableMap::COL_VALID, $this->valid);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildTareaQuery::create();
        $criteria->add(TareaTableMap::COL_IDTAREA, $this->idtarea);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getIdtarea();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getIdtarea();
    }

    /**
     * Generic method to set the primary key (idtarea column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdtarea($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getIdtarea();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \PropelORMAPI\ORM\Tarea (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTitulo($this->getTitulo());
        $copyObj->setTimestamp($this->getTimestamp());
        $copyObj->setValid($this->getValid());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getUsuariotareas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUsuariotarea($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdtarea(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \PropelORMAPI\ORM\Tarea Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Usuariotarea' == $relationName) {
            $this->initUsuariotareas();
            return;
        }
    }

    /**
     * Clears out the collUsuariotareas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUsuariotareas()
     */
    public function clearUsuariotareas()
    {
        $this->collUsuariotareas = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collUsuariotareas collection loaded partially.
     */
    public function resetPartialUsuariotareas($v = true)
    {
        $this->collUsuariotareasPartial = $v;
    }

    /**
     * Initializes the collUsuariotareas collection.
     *
     * By default this just sets the collUsuariotareas collection to an empty array (like clearcollUsuariotareas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUsuariotareas($overrideExisting = true)
    {
        if (null !== $this->collUsuariotareas && !$overrideExisting) {
            return;
        }

        $collectionClassName = UsuariotareaTableMap::getTableMap()->getCollectionClassName();

        $this->collUsuariotareas = new $collectionClassName;
        $this->collUsuariotareas->setModel('\PropelORMAPI\ORM\Usuariotarea');
    }

    /**
     * Gets an array of ChildUsuariotarea objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildTarea is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUsuariotarea[] List of ChildUsuariotarea objects
     * @throws PropelException
     */
    public function getUsuariotareas(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collUsuariotareasPartial && !$this->isNew();
        if (null === $this->collUsuariotareas || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUsuariotareas) {
                // return empty collection
                $this->initUsuariotareas();
            } else {
                $collUsuariotareas = ChildUsuariotareaQuery::create(null, $criteria)
                    ->filterByTarea($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUsuariotareasPartial && count($collUsuariotareas)) {
                        $this->initUsuariotareas(false);

                        foreach ($collUsuariotareas as $obj) {
                            if (false == $this->collUsuariotareas->contains($obj)) {
                                $this->collUsuariotareas->append($obj);
                            }
                        }

                        $this->collUsuariotareasPartial = true;
                    }

                    return $collUsuariotareas;
                }

                if ($partial && $this->collUsuariotareas) {
                    foreach ($this->collUsuariotareas as $obj) {
                        if ($obj->isNew()) {
                            $collUsuariotareas[] = $obj;
                        }
                    }
                }

                $this->collUsuariotareas = $collUsuariotareas;
                $this->collUsuariotareasPartial = false;
            }
        }

        return $this->collUsuariotareas;
    }

    /**
     * Sets a collection of ChildUsuariotarea objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $usuariotareas A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildTarea The current object (for fluent API support)
     */
    public function setUsuariotareas(Collection $usuariotareas, ConnectionInterface $con = null)
    {
        /** @var ChildUsuariotarea[] $usuariotareasToDelete */
        $usuariotareasToDelete = $this->getUsuariotareas(new Criteria(), $con)->diff($usuariotareas);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->usuariotareasScheduledForDeletion = clone $usuariotareasToDelete;

        foreach ($usuariotareasToDelete as $usuariotareaRemoved) {
            $usuariotareaRemoved->setTarea(null);
        }

        $this->collUsuariotareas = null;
        foreach ($usuariotareas as $usuariotarea) {
            $this->addUsuariotarea($usuariotarea);
        }

        $this->collUsuariotareas = $usuariotareas;
        $this->collUsuariotareasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Usuariotarea objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Usuariotarea objects.
     * @throws PropelException
     */
    public function countUsuariotareas(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collUsuariotareasPartial && !$this->isNew();
        if (null === $this->collUsuariotareas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUsuariotareas) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUsuariotareas());
            }

            $query = ChildUsuariotareaQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTarea($this)
                ->count($con);
        }

        return count($this->collUsuariotareas);
    }

    /**
     * Method called to associate a ChildUsuariotarea object to this object
     * through the ChildUsuariotarea foreign key attribute.
     *
     * @param  ChildUsuariotarea $l ChildUsuariotarea
     * @return $this|\PropelORMAPI\ORM\Tarea The current object (for fluent API support)
     */
    public function addUsuariotarea(ChildUsuariotarea $l)
    {
        if ($this->collUsuariotareas === null) {
            $this->initUsuariotareas();
            $this->collUsuariotareasPartial = true;
        }

        if (!$this->collUsuariotareas->contains($l)) {
            $this->doAddUsuariotarea($l);

            if ($this->usuariotareasScheduledForDeletion and $this->usuariotareasScheduledForDeletion->contains($l)) {
                $this->usuariotareasScheduledForDeletion->remove($this->usuariotareasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildUsuariotarea $usuariotarea The ChildUsuariotarea object to add.
     */
    protected function doAddUsuariotarea(ChildUsuariotarea $usuariotarea)
    {
        $this->collUsuariotareas[]= $usuariotarea;
        $usuariotarea->setTarea($this);
    }

    /**
     * @param  ChildUsuariotarea $usuariotarea The ChildUsuariotarea object to remove.
     * @return $this|ChildTarea The current object (for fluent API support)
     */
    public function removeUsuariotarea(ChildUsuariotarea $usuariotarea)
    {
        if ($this->getUsuariotareas()->contains($usuariotarea)) {
            $pos = $this->collUsuariotareas->search($usuariotarea);
            $this->collUsuariotareas->remove($pos);
            if (null === $this->usuariotareasScheduledForDeletion) {
                $this->usuariotareasScheduledForDeletion = clone $this->collUsuariotareas;
                $this->usuariotareasScheduledForDeletion->clear();
            }
            $this->usuariotareasScheduledForDeletion[]= clone $usuariotarea;
            $usuariotarea->setTarea(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Tarea is new, it will return
     * an empty collection; or if this Tarea has previously
     * been saved, it will retrieve related Usuariotareas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Tarea.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUsuariotarea[] List of ChildUsuariotarea objects
     */
    public function getUsuariotareasJoinUsuario(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUsuariotareaQuery::create(null, $criteria);
        $query->joinWith('Usuario', $joinBehavior);

        return $this->getUsuariotareas($query, $con);
    }

    /**
     * Clears out the collUsuarioIdusuariotareas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUsuarioIdusuariotareas()
     */
    public function clearUsuarioIdusuariotareas()
    {
        $this->collUsuarioIdusuariotareas = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Initializes the combinationCollUsuarioIdusuariotareas crossRef collection.
     *
     * By default this just sets the combinationCollUsuarioIdusuariotareas collection to an empty collection (like clearUsuarioIdusuariotareas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initUsuarioIdusuariotareas()
    {
        $this->combinationCollUsuarioIdusuariotareas = new ObjectCombinationCollection;
        $this->combinationCollUsuarioIdusuariotareasPartial = true;
    }

    /**
     * Checks if the combinationCollUsuarioIdusuariotareas collection is loaded.
     *
     * @return bool
     */
    public function isUsuarioIdusuariotareasLoaded()
    {
        return null !== $this->combinationCollUsuarioIdusuariotareas;
    }

    /**
     * Returns a new query object pre configured with filters from current object and given arguments to query the database.
     *
     * @param int $idusuariotarea
     * @param Criteria $criteria
     *
     * @return ChildUsuarioQuery
     */
    public function createUsuariosQuery($idusuariotarea = null, Criteria $criteria = null)
    {
        $criteria = ChildUsuarioQuery::create($criteria)
            ->filterByTarea($this);

        $usuariotareaQuery = $criteria->useUsuariotareaQuery();

        if (null !== $idusuariotarea) {
            $usuariotareaQuery->filterByIdusuariotarea($idusuariotarea);
        }

        $usuariotareaQuery->endUse();

        return $criteria;
    }

    /**
     * Gets a combined collection of ChildUsuario objects related by a many-to-many relationship
     * to the current object by way of the usuariotarea cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildTarea is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return ObjectCombinationCollection Combination list of ChildUsuario objects
     */
    public function getUsuarioIdusuariotareas($criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->combinationCollUsuarioIdusuariotareasPartial && !$this->isNew();
        if (null === $this->combinationCollUsuarioIdusuariotareas || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->combinationCollUsuarioIdusuariotareas) {
                    $this->initUsuarioIdusuariotareas();
                }
            } else {

                $query = ChildUsuariotareaQuery::create(null, $criteria)
                    ->filterByTarea($this)
                    ->joinUsuario()
                ;

                $items = $query->find($con);
                $combinationCollUsuarioIdusuariotareas = new ObjectCombinationCollection();
                foreach ($items as $item) {
                    $combination = [];

                    $combination[] = $item->getUsuario();
                    $combination[] = $item->getIdusuariotarea();
                    $combinationCollUsuarioIdusuariotareas[] = $combination;
                }

                if (null !== $criteria) {
                    return $combinationCollUsuarioIdusuariotareas;
                }

                if ($partial && $this->combinationCollUsuarioIdusuariotareas) {
                    //make sure that already added objects gets added to the list of the database.
                    foreach ($this->combinationCollUsuarioIdusuariotareas as $obj) {
                        if (!call_user_func_array([$combinationCollUsuarioIdusuariotareas, 'contains'], $obj)) {
                            $combinationCollUsuarioIdusuariotareas[] = $obj;
                        }
                    }
                }

                $this->combinationCollUsuarioIdusuariotareas = $combinationCollUsuarioIdusuariotareas;
                $this->combinationCollUsuarioIdusuariotareasPartial = false;
            }
        }

        return $this->combinationCollUsuarioIdusuariotareas;
    }

    /**
     * Returns a not cached ObjectCollection of ChildUsuario objects. This will hit always the databases.
     * If you have attached new ChildUsuario object to this object you need to call `save` first to get
     * the correct return value. Use getUsuarioIdusuariotareas() to get the current internal state.
     *
     * @param int $idusuariotarea
     * @param Criteria $criteria
     * @param ConnectionInterface $con
     *
     * @return ChildUsuario[]|ObjectCollection
     */
    public function getUsuarios($idusuariotarea = null, Criteria $criteria = null, ConnectionInterface $con = null)
    {
        return $this->createUsuariosQuery($idusuariotarea, $criteria)->find($con);
    }

    /**
     * Sets a collection of ChildUsuario objects related by a many-to-many relationship
     * to the current object by way of the usuariotarea cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param  Collection $usuarioIdusuariotareas A Propel collection.
     * @param  ConnectionInterface $con Optional connection object
     * @return $this|ChildTarea The current object (for fluent API support)
     */
    public function setUsuarioIdusuariotareas(Collection $usuarioIdusuariotareas, ConnectionInterface $con = null)
    {
        $this->clearUsuarioIdusuariotareas();
        $currentUsuarioIdusuariotareas = $this->getUsuarioIdusuariotareas();

        $combinationCollUsuarioIdusuariotareasScheduledForDeletion = $currentUsuarioIdusuariotareas->diff($usuarioIdusuariotareas);

        foreach ($combinationCollUsuarioIdusuariotareasScheduledForDeletion as $toDelete) {
            call_user_func_array([$this, 'removeUsuarioIdusuariotarea'], $toDelete);
        }

        foreach ($usuarioIdusuariotareas as $usuarioIdusuariotarea) {
            if (!call_user_func_array([$currentUsuarioIdusuariotareas, 'contains'], $usuarioIdusuariotarea)) {
                call_user_func_array([$this, 'doAddUsuarioIdusuariotarea'], $usuarioIdusuariotarea);
            }
        }

        $this->combinationCollUsuarioIdusuariotareasPartial = false;
        $this->combinationCollUsuarioIdusuariotareas = $usuarioIdusuariotareas;

        return $this;
    }

    /**
     * Gets the number of ChildUsuario objects related by a many-to-many relationship
     * to the current object by way of the usuariotarea cross-reference table.
     *
     * @param      Criteria $criteria Optional query object to filter the query
     * @param      boolean $distinct Set to true to force count distinct
     * @param      ConnectionInterface $con Optional connection object
     *
     * @return int the number of related ChildUsuario objects
     */
    public function countUsuarioIdusuariotareas(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->combinationCollUsuarioIdusuariotareasPartial && !$this->isNew();
        if (null === $this->combinationCollUsuarioIdusuariotareas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->combinationCollUsuarioIdusuariotareas) {
                return 0;
            } else {

                if ($partial && !$criteria) {
                    return count($this->getUsuarioIdusuariotareas());
                }

                $query = ChildUsuariotareaQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTarea($this)
                    ->count($con);
            }
        } else {
            return count($this->combinationCollUsuarioIdusuariotareas);
        }
    }

    /**
     * Returns the not cached count of ChildUsuario objects. This will hit always the databases.
     * If you have attached new ChildUsuario object to this object you need to call `save` first to get
     * the correct return value. Use getUsuarioIdusuariotareas() to get the current internal state.
     *
     * @param int $idusuariotarea
     * @param Criteria $criteria
     * @param ConnectionInterface $con
     *
     * @return integer
     */
    public function countUsuarios($idusuariotarea = null, Criteria $criteria = null, ConnectionInterface $con = null)
    {
        return $this->createUsuariosQuery($idusuariotarea, $criteria)->count($con);
    }

    /**
     * Associate a ChildUsuario to this object
     * through the usuariotarea cross reference table.
     *
     * @param ChildUsuario $usuario,
     * @param int $idusuariotarea
     * @return ChildTarea The current object (for fluent API support)
     */
    public function addUsuario(ChildUsuario $usuario, $idusuariotarea)
    {
        if ($this->combinationCollUsuarioIdusuariotareas === null) {
            $this->initUsuarioIdusuariotareas();
        }

        if (!$this->getUsuarioIdusuariotareas()->contains($usuario, $idusuariotarea)) {
            // only add it if the **same** object is not already associated
            $this->combinationCollUsuarioIdusuariotareas->push($usuario, $idusuariotarea);
            $this->doAddUsuarioIdusuariotarea($usuario, $idusuariotarea);
        }

        return $this;
    }

    /**
     *
     * @param ChildUsuario $usuario,
     * @param int $idusuariotarea
     */
    protected function doAddUsuarioIdusuariotarea(ChildUsuario $usuario, $idusuariotarea)
    {
        $usuariotarea = new ChildUsuariotarea();

        $usuariotarea->setUsuario($usuario);
        $usuariotarea->setIdusuariotarea($idusuariotarea);


        $usuariotarea->setTarea($this);

        $this->addUsuariotarea($usuariotarea);

        // set the back reference to this object directly as using provided method either results
        // in endless loop or in multiple relations
        if ($usuario->isTareaIdusuariotareasLoaded()) {
            $usuario->initTareaIdusuariotareas();
            $usuario->getTareaIdusuariotareas()->push($this, $idusuariotarea);
        } elseif (!$usuario->getTareaIdusuariotareas()->contains($this, $idusuariotarea)) {
            $usuario->getTareaIdusuariotareas()->push($this, $idusuariotarea);
        }

    }

    /**
     * Remove usuario, idusuariotarea of this object
     * through the usuariotarea cross reference table.
     *
     * @param ChildUsuario $usuario,
     * @param int $idusuariotarea
     * @return ChildTarea The current object (for fluent API support)
     */
    public function removeUsuarioIdusuariotarea(ChildUsuario $usuario, $idusuariotarea)
    {
        if ($this->getUsuarioIdusuariotareas()->contains($usuario, $idusuariotarea)) {
            $usuariotarea = new ChildUsuariotarea();
            $usuariotarea->setUsuario($usuario);
            if ($usuario->isTareaIdusuariotareasLoaded()) {
                //remove the back reference if available
                $usuario->getTareaIdusuariotareas()->removeObject($this, $idusuariotarea);
            }

            $usuariotarea->setIdusuariotarea($idusuariotarea);
            $usuariotarea->setTarea($this);
            $this->removeUsuariotarea(clone $usuariotarea);
            $usuariotarea->clear();

            $this->combinationCollUsuarioIdusuariotareas->remove($this->combinationCollUsuarioIdusuariotareas->search($usuario, $idusuariotarea));

            if (null === $this->combinationCollUsuarioIdusuariotareasScheduledForDeletion) {
                $this->combinationCollUsuarioIdusuariotareasScheduledForDeletion = clone $this->combinationCollUsuarioIdusuariotareas;
                $this->combinationCollUsuarioIdusuariotareasScheduledForDeletion->clear();
            }

            $this->combinationCollUsuarioIdusuariotareasScheduledForDeletion->push($usuario, $idusuariotarea);
        }


        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->idtarea = null;
        $this->titulo = null;
        $this->timestamp = null;
        $this->valid = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collUsuariotareas) {
                foreach ($this->collUsuariotareas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->combinationCollUsuarioIdusuariotareas) {
                foreach ($this->combinationCollUsuarioIdusuariotareas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collUsuariotareas = null;
        $this->combinationCollUsuarioIdusuariotareas = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TareaTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
