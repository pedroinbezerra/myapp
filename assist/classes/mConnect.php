<?php

Class mConnection
{
    protected function Connect()
    {
        $dsn = 'mysql:dbname=myapp;host=localhost';
        $user = 'admin';
        $password = 'root';

        try {
            $conn = new PDO($dsn, $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
}
