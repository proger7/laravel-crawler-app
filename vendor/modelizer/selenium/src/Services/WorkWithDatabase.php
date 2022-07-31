<?php

namespace Modelizer\Selenium\Services;

trait WorkWithDatabase
{
    /**
     * Assert that a given where condition exists in the database.
     *
     * @param string $table
     * @param array  $data
     * @param string $connection
     *
     * @return $this
     */
    protected function seeInDatabase($table, array $data, $connection = null)
    {
        if (is_null($this->app)) {
            return; // don't run when there is no application
        }

        $database = $this->app->make('db');

        $connection = $connection ?: $database->getDefaultConnection();

        $count = $database->connection($connection)->table($table)->where($data)->count();

        $this->assertGreaterThan(0, $count, sprintf(
            'Unable to find row in database table [%s] that matched attributes [%s].', $table, json_encode($data)
        ));

        return $this;
    }

    /**
     * Assert that a given where condition does not exist in the database.
     *
     * @param string $table
     * @param array  $data
     * @param string $connection
     *
     * @return $this
     */
    protected function missingFromDatabase($table, array $data, $connection = null)
    {
        return $this->notSeeInDatabase($table, $data, $connection);
    }

    /**
     * Assert that a given where condition does not exist in the database.
     *
     * @param string $table
     * @param array  $data
     * @param string $connection
     *
     * @return $this
     */
    protected function dontSeeInDatabase($table, array $data, $connection = null)
    {
        return $this->notSeeInDatabase($table, $data, $connection);
    }

    /**
     * Assert that a given where condition does not exist in the database.
     *
     * @param string $table
     * @param array  $data
     * @param string $connection
     *
     * @return $this
     */
    protected function notSeeInDatabase($table, array $data, $connection = null)
    {
        if (is_null($this->app)) {
            return; // don't run when there is no application
        }

        $database = $this->app->make('db');

        $connection = $connection ?: $database->getDefaultConnection();

        $count = $database->connection($connection)->table($table)->where($data)->count();

        $this->assertEquals(0, $count, sprintf(
            'Found unexpected records in database table [%s] that matched attributes [%s].', $table, json_encode($data)
        ));

        return $this;
    }
}
