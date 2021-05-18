<?php

namespace PropelORMAPI\ORM\Base;

use \Exception;
use \PDO;
use PropelORMAPI\ORM\Tarea as ChildTarea;
use PropelORMAPI\ORM\TareaQuery as ChildTareaQuery;
use PropelORMAPI\ORM\Map\TareaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'tarea' table.
 *
 *
 *
 * @method     ChildTareaQuery orderByIdtarea($order = Criteria::ASC) Order by the idtarea column
 * @method     ChildTareaQuery orderByTitulo($order = Criteria::ASC) Order by the titulo column
 * @method     ChildTareaQuery orderByTimestamp($order = Criteria::ASC) Order by the timestamp column
 * @method     ChildTareaQuery orderByValid($order = Criteria::ASC) Order by the valid column
 *
 * @method     ChildTareaQuery groupByIdtarea() Group by the idtarea column
 * @method     ChildTareaQuery groupByTitulo() Group by the titulo column
 * @method     ChildTareaQuery groupByTimestamp() Group by the timestamp column
 * @method     ChildTareaQuery groupByValid() Group by the valid column
 *
 * @method     ChildTareaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTareaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTareaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTareaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTareaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTareaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTareaQuery leftJoinUsuariotarea($relationAlias = null) Adds a LEFT JOIN clause to the query using the Usuariotarea relation
 * @method     ChildTareaQuery rightJoinUsuariotarea($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Usuariotarea relation
 * @method     ChildTareaQuery innerJoinUsuariotarea($relationAlias = null) Adds a INNER JOIN clause to the query using the Usuariotarea relation
 *
 * @method     ChildTareaQuery joinWithUsuariotarea($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Usuariotarea relation
 *
 * @method     ChildTareaQuery leftJoinWithUsuariotarea() Adds a LEFT JOIN clause and with to the query using the Usuariotarea relation
 * @method     ChildTareaQuery rightJoinWithUsuariotarea() Adds a RIGHT JOIN clause and with to the query using the Usuariotarea relation
 * @method     ChildTareaQuery innerJoinWithUsuariotarea() Adds a INNER JOIN clause and with to the query using the Usuariotarea relation
 *
 * @method     \PropelORMAPI\ORM\UsuariotareaQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTarea findOne(ConnectionInterface $con = null) Return the first ChildTarea matching the query
 * @method     ChildTarea findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTarea matching the query, or a new ChildTarea object populated from the query conditions when no match is found
 *
 * @method     ChildTarea findOneByIdtarea(int $idtarea) Return the first ChildTarea filtered by the idtarea column
 * @method     ChildTarea findOneByTitulo(string $titulo) Return the first ChildTarea filtered by the titulo column
 * @method     ChildTarea findOneByTimestamp(string $timestamp) Return the first ChildTarea filtered by the timestamp column
 * @method     ChildTarea findOneByValid(int $valid) Return the first ChildTarea filtered by the valid column *

 * @method     ChildTarea requirePk($key, ConnectionInterface $con = null) Return the ChildTarea by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTarea requireOne(ConnectionInterface $con = null) Return the first ChildTarea matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTarea requireOneByIdtarea(int $idtarea) Return the first ChildTarea filtered by the idtarea column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTarea requireOneByTitulo(string $titulo) Return the first ChildTarea filtered by the titulo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTarea requireOneByTimestamp(string $timestamp) Return the first ChildTarea filtered by the timestamp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTarea requireOneByValid(int $valid) Return the first ChildTarea filtered by the valid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTarea[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTarea objects based on current ModelCriteria
 * @method     ChildTarea[]|ObjectCollection findByIdtarea(int $idtarea) Return ChildTarea objects filtered by the idtarea column
 * @method     ChildTarea[]|ObjectCollection findByTitulo(string $titulo) Return ChildTarea objects filtered by the titulo column
 * @method     ChildTarea[]|ObjectCollection findByTimestamp(string $timestamp) Return ChildTarea objects filtered by the timestamp column
 * @method     ChildTarea[]|ObjectCollection findByValid(int $valid) Return ChildTarea objects filtered by the valid column
 * @method     ChildTarea[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TareaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \PropelORMAPI\ORM\Base\TareaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\PropelORMAPI\\ORM\\Tarea', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTareaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTareaQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTareaQuery) {
            return $criteria;
        }
        $query = new ChildTareaQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildTarea|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TareaTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TareaTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTarea A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idtarea, titulo, timestamp, valid FROM tarea WHERE idtarea = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildTarea $obj */
            $obj = new ChildTarea();
            $obj->hydrate($row);
            TareaTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildTarea|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildTareaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TareaTableMap::COL_IDTAREA, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTareaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TareaTableMap::COL_IDTAREA, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the idtarea column
     *
     * Example usage:
     * <code>
     * $query->filterByIdtarea(1234); // WHERE idtarea = 1234
     * $query->filterByIdtarea(array(12, 34)); // WHERE idtarea IN (12, 34)
     * $query->filterByIdtarea(array('min' => 12)); // WHERE idtarea > 12
     * </code>
     *
     * @param     mixed $idtarea The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTareaQuery The current query, for fluid interface
     */
    public function filterByIdtarea($idtarea = null, $comparison = null)
    {
        if (is_array($idtarea)) {
            $useMinMax = false;
            if (isset($idtarea['min'])) {
                $this->addUsingAlias(TareaTableMap::COL_IDTAREA, $idtarea['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idtarea['max'])) {
                $this->addUsingAlias(TareaTableMap::COL_IDTAREA, $idtarea['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TareaTableMap::COL_IDTAREA, $idtarea, $comparison);
    }

    /**
     * Filter the query on the titulo column
     *
     * Example usage:
     * <code>
     * $query->filterByTitulo('fooValue');   // WHERE titulo = 'fooValue'
     * $query->filterByTitulo('%fooValue%', Criteria::LIKE); // WHERE titulo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $titulo The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTareaQuery The current query, for fluid interface
     */
    public function filterByTitulo($titulo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($titulo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TareaTableMap::COL_TITULO, $titulo, $comparison);
    }

    /**
     * Filter the query on the timestamp column
     *
     * Example usage:
     * <code>
     * $query->filterByTimestamp('2011-03-14'); // WHERE timestamp = '2011-03-14'
     * $query->filterByTimestamp('now'); // WHERE timestamp = '2011-03-14'
     * $query->filterByTimestamp(array('max' => 'yesterday')); // WHERE timestamp > '2011-03-13'
     * </code>
     *
     * @param     mixed $timestamp The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTareaQuery The current query, for fluid interface
     */
    public function filterByTimestamp($timestamp = null, $comparison = null)
    {
        if (is_array($timestamp)) {
            $useMinMax = false;
            if (isset($timestamp['min'])) {
                $this->addUsingAlias(TareaTableMap::COL_TIMESTAMP, $timestamp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($timestamp['max'])) {
                $this->addUsingAlias(TareaTableMap::COL_TIMESTAMP, $timestamp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TareaTableMap::COL_TIMESTAMP, $timestamp, $comparison);
    }

    /**
     * Filter the query on the valid column
     *
     * Example usage:
     * <code>
     * $query->filterByValid(1234); // WHERE valid = 1234
     * $query->filterByValid(array(12, 34)); // WHERE valid IN (12, 34)
     * $query->filterByValid(array('min' => 12)); // WHERE valid > 12
     * </code>
     *
     * @param     mixed $valid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTareaQuery The current query, for fluid interface
     */
    public function filterByValid($valid = null, $comparison = null)
    {
        if (is_array($valid)) {
            $useMinMax = false;
            if (isset($valid['min'])) {
                $this->addUsingAlias(TareaTableMap::COL_VALID, $valid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($valid['max'])) {
                $this->addUsingAlias(TareaTableMap::COL_VALID, $valid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TareaTableMap::COL_VALID, $valid, $comparison);
    }

    /**
     * Filter the query by a related \PropelORMAPI\ORM\Usuariotarea object
     *
     * @param \PropelORMAPI\ORM\Usuariotarea|ObjectCollection $usuariotarea the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTareaQuery The current query, for fluid interface
     */
    public function filterByUsuariotarea($usuariotarea, $comparison = null)
    {
        if ($usuariotarea instanceof \PropelORMAPI\ORM\Usuariotarea) {
            return $this
                ->addUsingAlias(TareaTableMap::COL_IDTAREA, $usuariotarea->getIdtarea(), $comparison);
        } elseif ($usuariotarea instanceof ObjectCollection) {
            return $this
                ->useUsuariotareaQuery()
                ->filterByPrimaryKeys($usuariotarea->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUsuariotarea() only accepts arguments of type \PropelORMAPI\ORM\Usuariotarea or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Usuariotarea relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTareaQuery The current query, for fluid interface
     */
    public function joinUsuariotarea($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Usuariotarea');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Usuariotarea');
        }

        return $this;
    }

    /**
     * Use the Usuariotarea relation Usuariotarea object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PropelORMAPI\ORM\UsuariotareaQuery A secondary query class using the current class as primary query
     */
    public function useUsuariotareaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsuariotarea($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Usuariotarea', '\PropelORMAPI\ORM\UsuariotareaQuery');
    }

    /**
     * Filter the query by a related Usuario object
     * using the usuariotarea table as cross reference
     *
     * @param Usuario $usuario the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTareaQuery The current query, for fluid interface
     */
    public function filterByUsuario($usuario, $comparison = Criteria::EQUAL)
    {
        return $this
            ->useUsuariotareaQuery()
            ->filterByUsuario($usuario, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   ChildTarea $tarea Object to remove from the list of results
     *
     * @return $this|ChildTareaQuery The current query, for fluid interface
     */
    public function prune($tarea = null)
    {
        if ($tarea) {
            $this->addUsingAlias(TareaTableMap::COL_IDTAREA, $tarea->getIdtarea(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the tarea table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TareaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TareaTableMap::clearInstancePool();
            TareaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TareaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TareaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TareaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TareaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // TareaQuery
