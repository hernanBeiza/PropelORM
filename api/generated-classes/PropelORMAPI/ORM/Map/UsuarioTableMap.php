<?php

namespace PropelORMAPI\ORM\Map;

use PropelORMAPI\ORM\Usuario;
use PropelORMAPI\ORM\UsuarioQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'usuario' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class UsuarioTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'PropelORMAPI.ORM.Map.UsuarioTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'tareaconnection';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'usuario';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\PropelORMAPI\\ORM\\Usuario';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'PropelORMAPI.ORM.Usuario';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the idusuario field
     */
    const COL_IDUSUARIO = 'usuario.idusuario';

    /**
     * the column name for the nombre field
     */
    const COL_NOMBRE = 'usuario.nombre';

    /**
     * the column name for the apellido field
     */
    const COL_APELLIDO = 'usuario.apellido';

    /**
     * the column name for the usuario field
     */
    const COL_USUARIO = 'usuario.usuario';

    /**
     * the column name for the contrasena field
     */
    const COL_CONTRASENA = 'usuario.contrasena';

    /**
     * the column name for the timestamp field
     */
    const COL_TIMESTAMP = 'usuario.timestamp';

    /**
     * the column name for the valid field
     */
    const COL_VALID = 'usuario.valid';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Idusuario', 'Nombre', 'Apellido', 'Usuario', 'Contrasena', 'Timestamp', 'Valid', ),
        self::TYPE_CAMELNAME     => array('idusuario', 'nombre', 'apellido', 'usuario', 'contrasena', 'timestamp', 'valid', ),
        self::TYPE_COLNAME       => array(UsuarioTableMap::COL_IDUSUARIO, UsuarioTableMap::COL_NOMBRE, UsuarioTableMap::COL_APELLIDO, UsuarioTableMap::COL_USUARIO, UsuarioTableMap::COL_CONTRASENA, UsuarioTableMap::COL_TIMESTAMP, UsuarioTableMap::COL_VALID, ),
        self::TYPE_FIELDNAME     => array('idusuario', 'nombre', 'apellido', 'usuario', 'contrasena', 'timestamp', 'valid', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Idusuario' => 0, 'Nombre' => 1, 'Apellido' => 2, 'Usuario' => 3, 'Contrasena' => 4, 'Timestamp' => 5, 'Valid' => 6, ),
        self::TYPE_CAMELNAME     => array('idusuario' => 0, 'nombre' => 1, 'apellido' => 2, 'usuario' => 3, 'contrasena' => 4, 'timestamp' => 5, 'valid' => 6, ),
        self::TYPE_COLNAME       => array(UsuarioTableMap::COL_IDUSUARIO => 0, UsuarioTableMap::COL_NOMBRE => 1, UsuarioTableMap::COL_APELLIDO => 2, UsuarioTableMap::COL_USUARIO => 3, UsuarioTableMap::COL_CONTRASENA => 4, UsuarioTableMap::COL_TIMESTAMP => 5, UsuarioTableMap::COL_VALID => 6, ),
        self::TYPE_FIELDNAME     => array('idusuario' => 0, 'nombre' => 1, 'apellido' => 2, 'usuario' => 3, 'contrasena' => 4, 'timestamp' => 5, 'valid' => 6, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('usuario');
        $this->setPhpName('Usuario');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\PropelORMAPI\\ORM\\Usuario');
        $this->setPackage('PropelORMAPI.ORM');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('idusuario', 'Idusuario', 'INTEGER', true, null, null);
        $this->addColumn('nombre', 'Nombre', 'VARCHAR', true, 45, null);
        $this->addColumn('apellido', 'Apellido', 'VARCHAR', false, 45, null);
        $this->addColumn('usuario', 'Usuario', 'VARCHAR', true, 45, null);
        $this->addColumn('contrasena', 'Contrasena', 'VARCHAR', true, 45, null);
        $this->addColumn('timestamp', 'Timestamp', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('valid', 'Valid', 'TINYINT', true, null, 1);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Usuariotarea', '\\PropelORMAPI\\ORM\\Usuariotarea', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':idusuario',
    1 => ':idusuario',
  ),
), null, null, 'Usuariotareas', false);
        $this->addRelation('Tarea', '\\PropelORMAPI\\ORM\\Tarea', RelationMap::MANY_TO_MANY, array(), null, null, 'Tareas');
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idusuario', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idusuario', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idusuario', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idusuario', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idusuario', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idusuario', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Idusuario', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? UsuarioTableMap::CLASS_DEFAULT : UsuarioTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Usuario object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = UsuarioTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UsuarioTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UsuarioTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UsuarioTableMap::OM_CLASS;
            /** @var Usuario $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UsuarioTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = UsuarioTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UsuarioTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Usuario $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UsuarioTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(UsuarioTableMap::COL_IDUSUARIO);
            $criteria->addSelectColumn(UsuarioTableMap::COL_NOMBRE);
            $criteria->addSelectColumn(UsuarioTableMap::COL_APELLIDO);
            $criteria->addSelectColumn(UsuarioTableMap::COL_USUARIO);
            $criteria->addSelectColumn(UsuarioTableMap::COL_CONTRASENA);
            $criteria->addSelectColumn(UsuarioTableMap::COL_TIMESTAMP);
            $criteria->addSelectColumn(UsuarioTableMap::COL_VALID);
        } else {
            $criteria->addSelectColumn($alias . '.idusuario');
            $criteria->addSelectColumn($alias . '.nombre');
            $criteria->addSelectColumn($alias . '.apellido');
            $criteria->addSelectColumn($alias . '.usuario');
            $criteria->addSelectColumn($alias . '.contrasena');
            $criteria->addSelectColumn($alias . '.timestamp');
            $criteria->addSelectColumn($alias . '.valid');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(UsuarioTableMap::DATABASE_NAME)->getTable(UsuarioTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(UsuarioTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(UsuarioTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new UsuarioTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Usuario or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Usuario object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsuarioTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \PropelORMAPI\ORM\Usuario) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UsuarioTableMap::DATABASE_NAME);
            $criteria->add(UsuarioTableMap::COL_IDUSUARIO, (array) $values, Criteria::IN);
        }

        $query = UsuarioQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UsuarioTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UsuarioTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the usuario table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return UsuarioQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Usuario or Criteria object.
     *
     * @param mixed               $criteria Criteria or Usuario object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsuarioTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Usuario object
        }

        if ($criteria->containsKey(UsuarioTableMap::COL_IDUSUARIO) && $criteria->keyContainsValue(UsuarioTableMap::COL_IDUSUARIO) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UsuarioTableMap::COL_IDUSUARIO.')');
        }


        // Set the correct dbName
        $query = UsuarioQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // UsuarioTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
UsuarioTableMap::buildTableMap();
