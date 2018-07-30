<?php
/**
 * User: 1040339
 * Date: 7/27/2018
 * Time: 4:13 PM
 */

namespace Core\Contracts;


interface QueryBuilder
{
    /**
     * Get the first result of row
     *
     * @return mixed
     */
    public function first();

    /**
     * Get all rows
     *
     * @return mixed
     */
    public function get();

    /**
     * Select statement
     *
     * @return mixed
     */
    public function select();

    /**
     * Where statement
     *
     * @return mixed
     */
    public function where();

    /**
     * OrderBy statement
     *
     * @return mixed
     */
    public function orderBy();

    /**
     * Join statement
     *
     * @return mixed
     */
    public function join();


    /**
     * Insert to database
     *
     * @return mixed
     */
    public function insert();

    /**
     * Update database
     *
     * @return mixed
     */
    public function update();

    /**
     * Execute query statement
     *
     * @return mixed
     */
    public function exec();

    /**
     * Prepare Query statement
     *
     * @param string $sql
     * @return mixed
     */
    public function query(string $sql);

    /**
     * Set table name
     *
     * @param string $table
     * @return mixed
     */
    public function setTable(string $table);
}