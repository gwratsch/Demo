<?php

/* 
 * Database connection settings.
 */
class connect {
    function connectDB(){
        $config = new \Doctrine\DBAL\Configuration();

        $connectionParams = array(
            'dbname' => 'demoDB',
            'user' => 'demouser',
            'password' => 'secret',
            'host' => 'mysql',
            'driver' => 'pdo_mysql',
        );
        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
        return $conn;
    }
}