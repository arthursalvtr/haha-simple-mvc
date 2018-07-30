<?php
/**
 * User: 1040339
 * Date: 7/27/2018
 * Time: 5:37 PM
 */

namespace App\Models;

use Core\Contracts\Database;
use Core\Contracts\QueryBuilder;

class BaseModel implements QueryBuilder
{
    /**
     * @var Database
     */
    private $database;

    protected $table;

    protected $driver = 'mysql';

    /**
     * BaseModel constructor.
     * @param Database $database
     */
    public function __construct()
    {
        $this->setDatabase(app($this->driver));
        $this->setTable($this->getTableName());
    }

    public function setDatabase(Database $database)
    {
        $this->database = $database;
        return $this;
    }

    public function getTableName(): string
    {
        $names = explode('\\', static::class);
        return $this->table ?? strtolower(end($names));
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
        // TODO: Implement get() method.
    }

    /**
     * Select statement
     *
     * @return mixed
     */
    public function select()
    {
        // TODO: Implement select() method.
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
        // TODO: Implement exec() method.
    }

    /**
     * Prepare Query statement
     *
     * @param string $sql
     * @return mixed
     */
    public function query(string $sql)
    {
        // TODO: Implement query() method.
    }

    /**
     * Set table name
     *
     * @param string $table
     * @return mixed
     */
    public function setTable(string $table)
    {
        $this->table = $table;
        return $this;
    }
}