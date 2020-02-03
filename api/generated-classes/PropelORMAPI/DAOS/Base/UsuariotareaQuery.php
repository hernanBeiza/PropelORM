<?php

namespace PropelORMAPI\DAOS\Base;

use \Exception;
use \PDO;
use PropelORMAPI\DAOS\Usuariotarea as ChildUsuariotarea;
use PropelORMAPI\DAOS\UsuariotareaQuery as ChildUsuariotareaQuery;
use PropelORMAPI\DAOS\Map\UsuariotareaTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'usuariotarea' table.
 *
 *
 *
 * @method     ChildUsuariotareaQuery orderByIdusuariotarea($order = Criteria::ASC) Order by the idusuariotarea column
 * @method     ChildUsuariotareaQuery orderByIdusuario($order = Criteria::ASC) Order by the idusuario column
 * @method     ChildUsuariotareaQuery orderByIdtarea($order = Criteria::ASC) Order by the idtarea column
 * @method     ChildUsuariotareaQuery orderByTimestamp($order = Criteria::ASC) Order by the timestamp column
 * @method     ChildUsuariotareaQuery orderByValid($order = Criteria::ASC) Order by the valid column
 *
 * @method     ChildUsuariotareaQuery groupByIdusuariotarea() Group by the idusuariotarea column
 * @method     ChildUsuariotareaQuery groupByIdusuario() Group by the idusuario column
 * @method     ChildUsuariotareaQuery groupByIdtarea() Group by the idtarea column
 * @method     ChildUsuariotareaQuery groupByTimestamp() Group by the timestamp column
 * @method     ChildUsuariotareaQuery groupByValid() Group by the valid column
 *
 * @method     ChildUsuariotareaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsuariotareaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsuariotareaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsuariotareaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUsuariotareaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUsuariotareaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUsuariotareaQuery leftJoinTarea($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tarea relation
 * @method     ChildUsuariotareaQuery rightJoinTarea($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tarea relation
 * @method     ChildUsuariotareaQuery innerJoinTarea($relationAlias = null) Adds a INNER JOIN clause to the query using the Tarea relation
 *
 * @method     ChildUsuariotareaQuery joinWithTarea($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Tarea relation
 *
 * @method     ChildUsuariotareaQuery leftJoinWithTarea() Adds a LEFT JOIN clause and with to the query using the Tarea relation
 * @method     ChildUsuariotareaQuery rightJoinWithTarea() Adds a RIGHT JOIN clause and with to the query using the Tarea relation
 * @method     ChildUsuariotareaQuery innerJoinWithTarea() Adds a INNER JOIN clause and with to the query using the Tarea relation
 *
 * @method     ChildUsuariotareaQuery leftJoinUsuario($relationAlias = null) Adds a LEFT JOIN clause to the query using the Usuario relation
 * @method     ChildUsuariotareaQuery rightJoinUsuario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Usuario relation
 * @method     ChildUsuariotareaQuery innerJoinUsuario($relationAlias = null) Adds a INNER JOIN clause to the query using the Usuario relation
 *
 * @method     ChildUsuariotareaQuery joinWithUsuario($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Usuario relation
 *
 * @method     ChildUsuariotareaQuery leftJoinWithUsuario() Adds a LEFT JOIN clause and with to the query using the Usuario relation
 * @method     ChildUsuariotareaQuery rightJoinWithUsuario() Adds a RIGHT JOIN clause and with to the query using the Usuario relation
 * @method     ChildUsuariotareaQuery innerJoinWithUsuario() Adds a INNER JOIN clause and with to the query using the Usuario relation
 *
 * @method     \PropelORMAPI\DAOS\TareaQuery|\PropelORMAPI\DAOS\UsuarioQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUsuariotarea findOne(ConnectionInterface $con = null) Return the first ChildUsuariotarea matching the query
 * @method     ChildUsuariotarea findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUsuariotarea matching the query, or a new ChildUsuariotarea object populated from the query conditions when no match is found
 *
 * @method     ChildUsuariotarea findOneByIdusuariotarea(int $idusuariotarea) Return the first ChildUsuariotarea filtered by the idusuariotarea column
 * @method     ChildUsuariotarea findOneByIdusuario(int $idusuario) Return the first ChildUsuariotarea filtered by the idusuario column
 * @method     ChildUsuariotarea findOneByIdtarea(int $idtarea) Return the first ChildUsuariotarea filtered by the idtarea column
 * @method     ChildUsuariotarea findOneByTimestamp(string $timestamp) Return the first ChildUsuariotarea filtered by the timestamp column
 * @method     ChildUsuariotarea findOneByValid(int $valid) Return the first ChildUsuariotarea filtered by the valid column *

 * @method     ChildUsuariotarea requirePk($key, ConnectionInterface $con = null) Return the ChildUsuariotarea by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuariotarea requireOne(ConnectionInterface $con = null) Return the first ChildUsuariotarea matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsuariotarea requireOneByIdusuariotarea(int $idusuariotarea) Return the first ChildUsuariotarea filtered by the idusuariotarea column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuariotarea requireOneByIdusuario(int $idusuario) Return the first ChildUsuariotarea filtered by the idusuario column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuariotarea requireOneByIdtarea(int $idtarea) Return the first ChildUsuariotarea filtered by the idtarea column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuariotarea requireOneByTimestamp(string $timestamp) Return the first ChildUsuariotarea filtered by the timestamp column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsuariotarea requireOneByValid(int $valid) Return the first ChildUsuariotarea filtered by the valid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsuariotarea[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUsuariotarea objects based on current ModelCriteria
 * @method     ChildUsuariotarea[]|ObjectCollection findByIdusuariotarea(int $idusuariotarea) Return ChildUsuariotarea objects filtered by the idusuariotarea column
 * @method     ChildUsuariotarea[]|ObjectCollection findByIdusuario(int $idusuario) Return ChildUsuariotarea objects filtered by the idusuario column
 * @method     ChildUsuariotarea[]|ObjectCollection findByIdtarea(int $idtarea) Return ChildUsuariotarea objects filtered by the idtarea column
 * @method     ChildUsuariotarea[]|ObjectCollection findByTimestamp(string $timestamp) Return ChildUsuariotarea objects filtered by the timestamp column
 * @method     ChildUsuariotarea[]|ObjectCollection findByValid(int $valid) Return ChildUsuariotarea objects filtered by the valid column
 * @method     ChildUsuariotarea[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsuariotareaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \PropelORMAPI\DAOS\Base\UsuariotareaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'tareaconnection', $modelName = '\\PropelORMAPI\\DAOS\\Usuariotarea', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsuariotareaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsuariotareaQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUsuariotareaQuery) {
            return $criteria;
        }
        $query = new ChildUsuariotareaQuery();
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
     * $obj = $c->findPk(array(12, 34, 56), $con);
     * </code>
     *
     * @param array[$idusuariotarea, $idusuario, $idtarea] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildUsuariotarea|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsuariotareaTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UsuariotareaTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1]), (null === $key[2] || is_scalar($key[2]) || is_callable([$key[2], '__toString']) ? (string) $key[2] : $key[2])]))))) {
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
     * @return ChildUsuariotarea A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idusuariotarea, idusuario, idtarea, timestamp, valid FROM usuariotarea WHERE idusuariotarea = :p0 AND idusuario = :p1 AND idtarea = :p2';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->bindValue(':p2', $key[2], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildUsuariotarea $obj */
            $obj = new ChildUsuariotarea();
            $obj->hydrate($row);
            UsuariotareaTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1]), (null === $key[2] || is_scalar($key[2]) || is_callable([$key[2], '__toString']) ? (string) $key[2] : $key[2])]));
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
     * @return ChildUsuariotarea|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildUsuariotareaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(UsuariotareaTableMap::COL_IDUSUARIOTAREA, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(UsuariotareaTableMap::COL_IDUSUARIO, $key[1], Criteria::EQUAL);
        $this->addUsingAlias(UsuariotareaTableMap::COL_IDTAREA, $key[2], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUsuariotareaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(UsuariotareaTableMap::COL_IDUSUARIOTAREA, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(UsuariotareaTableMap::COL_IDUSUARIO, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $cton2 = $this->getNewCriterion(UsuariotareaTableMap::COL_IDTAREA, $key[2], Criteria::EQUAL);
            $cton0->addAnd($cton2);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the idusuariotarea column
     *
     * Example usage:
     * <code>
     * $query->filterByIdusuariotarea(1234); // WHERE idusuariotarea = 1234
     * $query->filterByIdusuariotarea(array(12, 34)); // WHERE idusuariotarea IN (12, 34)
     * $query->filterByIdusuariotarea(array('min' => 12)); // WHERE idusuariotarea > 12
     * </code>
     *
     * @param     mixed $idusuariotarea The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuariotareaQuery The current query, for fluid interface
     */
    public function filterByIdusuariotarea($idusuariotarea = null, $comparison = null)
    {
        if (is_array($idusuariotarea)) {
            $useMinMax = false;
            if (isset($idusuariotarea['min'])) {
                $this->addUsingAlias(UsuariotareaTableMap::COL_IDUSUARIOTAREA, $idusuariotarea['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idusuariotarea['max'])) {
                $this->addUsingAlias(UsuariotareaTableMap::COL_IDUSUARIOTAREA, $idusuariotarea['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuariotareaTableMap::COL_IDUSUARIOTAREA, $idusuariotarea, $comparison);
    }

    /**
     * Filter the query on the idusuario column
     *
     * Example usage:
     * <code>
     * $query->filterByIdusuario(1234); // WHERE idusuario = 1234
     * $query->filterByIdusuario(array(12, 34)); // WHERE idusuario IN (12, 34)
     * $query->filterByIdusuario(array('min' => 12)); // WHERE idusuario > 12
     * </code>
     *
     * @see       filterByUsuario()
     *
     * @param     mixed $idusuario The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuariotareaQuery The current query, for fluid interface
     */
    public function filterByIdusuario($idusuario = null, $comparison = null)
    {
        if (is_array($idusuario)) {
            $useMinMax = false;
            if (isset($idusuario['min'])) {
                $this->addUsingAlias(UsuariotareaTableMap::COL_IDUSUARIO, $idusuario['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idusuario['max'])) {
                $this->addUsingAlias(UsuariotareaTableMap::COL_IDUSUARIO, $idusuario['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuariotareaTableMap::COL_IDUSUARIO, $idusuario, $comparison);
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
     * @see       filterByTarea()
     *
     * @param     mixed $idtarea The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsuariotareaQuery The current query, for fluid interface
     */
    public function filterByIdtarea($idtarea = null, $comparison = null)
    {
        if (is_array($idtarea)) {
            $useMinMax = false;
            if (isset($idtarea['min'])) {
                $this->addUsingAlias(UsuariotareaTableMap::COL_IDTAREA, $idtarea['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idtarea['max'])) {
                $this->addUsingAlias(UsuariotareaTableMap::COL_IDTAREA, $idtarea['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuariotareaTableMap::COL_IDTAREA, $idtarea, $comparison);
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
     * @return $this|ChildUsuariotareaQuery The current query, for fluid interface
     */
    public function filterByTimestamp($timestamp = null, $comparison = null)
    {
        if (is_array($timestamp)) {
            $useMinMax = false;
            if (isset($timestamp['min'])) {
                $this->addUsingAlias(UsuariotareaTableMap::COL_TIMESTAMP, $timestamp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($timestamp['max'])) {
                $this->addUsingAlias(UsuariotareaTableMap::COL_TIMESTAMP, $timestamp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuariotareaTableMap::COL_TIMESTAMP, $timestamp, $comparison);
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
     * @return $this|ChildUsuariotareaQuery The current query, for fluid interface
     */
    public function filterByValid($valid = null, $comparison = null)
    {
        if (is_array($valid)) {
            $useMinMax = false;
            if (isset($valid['min'])) {
                $this->addUsingAlias(UsuariotareaTableMap::COL_VALID, $valid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($valid['max'])) {
                $this->addUsingAlias(UsuariotareaTableMap::COL_VALID, $valid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuariotareaTableMap::COL_VALID, $valid, $comparison);
    }

    /**
     * Filter the query by a related \PropelORMAPI\DAOS\Tarea object
     *
     * @param \PropelORMAPI\DAOS\Tarea|ObjectCollection $tarea The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUsuariotareaQuery The current query, for fluid interface
     */
    public function filterByTarea($tarea, $comparison = null)
    {
        if ($tarea instanceof \PropelORMAPI\DAOS\Tarea) {
            return $this
                ->addUsingAlias(UsuariotareaTableMap::COL_IDTAREA, $tarea->getIdtarea(), $comparison);
        } elseif ($tarea instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UsuariotareaTableMap::COL_IDTAREA, $tarea->toKeyValue('PrimaryKey', 'Idtarea'), $comparison);
        } else {
            throw new PropelException('filterByTarea() only accepts arguments of type \PropelORMAPI\DAOS\Tarea or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Tarea relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsuariotareaQuery The current query, for fluid interface
     */
    public function joinTarea($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Tarea');

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
            $this->addJoinObject($join, 'Tarea');
        }

        return $this;
    }

    /**
     * Use the Tarea relation Tarea object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PropelORMAPI\DAOS\TareaQuery A secondary query class using the current class as primary query
     */
    public function useTareaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTarea($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Tarea', '\PropelORMAPI\DAOS\TareaQuery');
    }

    /**
     * Filter the query by a related \PropelORMAPI\DAOS\Usuario object
     *
     * @param \PropelORMAPI\DAOS\Usuario|ObjectCollection $usuario The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUsuariotareaQuery The current query, for fluid interface
     */
    public function filterByUsuario($usuario, $comparison = null)
    {
        if ($usuario instanceof \PropelORMAPI\DAOS\Usuario) {
            return $this
                ->addUsingAlias(UsuariotareaTableMap::COL_IDUSUARIO, $usuario->getIdusuario(), $comparison);
        } elseif ($usuario instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UsuariotareaTableMap::COL_IDUSUARIO, $usuario->toKeyValue('PrimaryKey', 'Idusuario'), $comparison);
        } else {
            throw new PropelException('filterByUsuario() only accepts arguments of type \PropelORMAPI\DAOS\Usuario or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Usuario relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsuariotareaQuery The current query, for fluid interface
     */
    public function joinUsuario($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Usuario');

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
            $this->addJoinObject($join, 'Usuario');
        }

        return $this;
    }

    /**
     * Use the Usuario relation Usuario object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PropelORMAPI\DAOS\UsuarioQuery A secondary query class using the current class as primary query
     */
    public function useUsuarioQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsuario($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Usuario', '\PropelORMAPI\DAOS\UsuarioQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUsuariotarea $usuariotarea Object to remove from the list of results
     *
     * @return $this|ChildUsuariotareaQuery The current query, for fluid interface
     */
    public function prune($usuariotarea = null)
    {
        if ($usuariotarea) {
            $this->addCond('pruneCond0', $this->getAliasedColName(UsuariotareaTableMap::COL_IDUSUARIOTAREA), $usuariotarea->getIdusuariotarea(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(UsuariotareaTableMap::COL_IDUSUARIO), $usuariotarea->getIdusuario(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond2', $this->getAliasedColName(UsuariotareaTableMap::COL_IDTAREA), $usuariotarea->getIdtarea(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the usuariotarea table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsuariotareaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsuariotareaTableMap::clearInstancePool();
            UsuariotareaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsuariotareaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsuariotareaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsuariotareaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsuariotareaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UsuariotareaQuery
