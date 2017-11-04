<?php

/* 
 * Database connection settings.
 */
class connect {
    function connectDB(){
        $config = new \Doctrine\DBAL\Configuration();

        $connectionParams = array(
            'dbname' => 'demo',
            'user' => '',
            'password' => '',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        );
        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
        return $conn;
    }
}