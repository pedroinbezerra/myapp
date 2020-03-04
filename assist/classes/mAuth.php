<?php

Class mAuth extends mConnection
{

    public function validate($username, $password)
    {
        $sql = "SELECT COUNT(1) CONT FROM USER WHERE USERNAME = :USERNAME AND PASSWORD = :PASSWORD";
        $con = $this->connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':USERNAME', $username, PDO::PARAM_STR);
        $stmt->bindParam(':PASSWORD', $password, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['CONT'];
    }

    public function getUserData($username)
    {
        $sql = "SELECT * FROM USER WHERE USERNAME = :USERNAME";
        $con = $this->connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':USERNAME', $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function isValid($username){
         $sql = "SELECT COUNT(1) CONT FROM USER WHERE USERNAME = :USERNAME";
        $con = $this->connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':USERNAME', $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['CONT'];
    }
}
