<?php
/**
 * User: 1040339
 * Date: 7/27/2018
 * Time: 4:10 PM
 */

namespace Core\Contracts;


interface DatabaseConnection
{
    /**
     * Connect the database
     * @return mixed
     */
    public function connect();

    /**
     * Determine if database is still connected
     *
     * @return bool
     */
    public function isConnected():bool;
}