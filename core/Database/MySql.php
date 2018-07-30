<?php
/**
 * User: 1040339
 * Date: 7/27/2018
 * Time: 4:15 PM
 */

namespace Core\Database;

use Core\Abstracts\DatabaseConnection;
use Core\Contracts\Database;
use PDO;

class MySql extends DatabaseConnection implements Database
{
    protected $config = [
        'mysql:host' => '',
        'dbname' => '',
    ];

    protected $table = '';

    protected $sql = [
        'SELECT' => [],
        'WHERE' => [],
        'FROM' => [],
        'JOIN' => [],
        'ORDER_BY' => [],
        'GROUP_BY' => [],
    ];

    public function __construct(string $host, string $db, string $user, string $pass)
    {
        $this->config['mysql:host'] = $host;
        $this->config['dbname'] = $db;
        $this->user = $user;
        $this->pass = $pass;
        $this->connect();
    }

    /**
     * Get the first result of row
     *
     * @return mixed
     */
    public function first()
    {
        // TODO: Implement first() method.
    }

    /**
     * Get all rows
     *
     * @return mixed
     */
    public function get()
    {
        return $this->pdoStatement->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Select statement
     *
     * @return mixed
     */
    public function select()
    {
        return $this->setSQLByKey('SELECT', ...func_get_args());
    }

    /**
     * Where statement
     *
     * @return mixed
     */
    public function where()
    {
        // TODO: Implement where() method.
    }

    /**
     * OrderBy statement
     *
     * @return mixed
     */
    public function orderBy()
    {
        // TODO: Implement orderBy() method.
    }

    /**
     * Join statement
     *
     * @return mixed
     */
    public function join()
    {
        // TODO: Implement join() method.
    }

    /**
     * Insert to database
     *
     * @return mixed
     */
    public function insert()
    {
        // TODO: Implement insert() method.
    }

    /**
     * Update database
     *
     * @return mixed
     */
    public function update()
    {
        // TODO: Implement update() method.
    }

    /**
     * Execute query statement
     *
     * @return mixed
     */
    public function exec()
    {
        $this->pdoStatement->execute();
        return $this;
    }

    /**
     * Prepare Query statement
     *
     * @param string $sql
     * @return mixed
     */
    public function query(string $sql)
    {
        $this->pdoStatement = $this->pdo->prepare($sql);
        return $this->exec();
    }

    private function setSQLByKey($key, ...$params)
    {
        if (is_array($params[0])) {
            $this->sql[$key] = $params[0];
            return $this;
        }
        $this->sql[$key] = $params;
        return $this;
    }

    public function setTable(string $table)
    {
        $this->table = $table;
    }
}