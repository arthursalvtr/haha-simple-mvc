<?php
/**
 * User: 1040339
 * Date: 7/27/2018
 * Time: 4:55 PM
 */

namespace Core\Abstracts;

use Core\Contracts\DatabaseConnection AS ConnectionContract;
use PDO;

abstract class DatabaseConnection implements ConnectionContract
{
    /**
     * @var array
     */
    protected $config = [];

    /**
     * @var string
     */
    protected $user;

    /**
     * @var string
     */
    protected $pass;

    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @var \PDOStatement
     */
    protected $pdoStatement;

    /**
     * Connect the database
     * @return mixed
     */
    public function connect()
    {
        if ($this->isConnected()) {
            return $this->pdo;
        }
        $connectionString = constring_maker($this->config);
        $pdo = new PDO($connectionString, $this->user, $this->pass);
        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $this->pdo = $pdo;
        return $this;
    }

    /**
     * Determine if database is still connected
     *
     * @return bool
     */
    public function isConnected(): bool
    {
        return isset($this->pdo);
    }
}