<?php

class mProvider extends mConnection {

    public function createProvider($TYPE, $NAME, $PHONE, $MAIL, $CPF_CNPJ, $ZIPCODE, $STREET, $NUMBER, $NEIGHBORHOOD, $CITY_STATE, $CREATED_BY) {
        $sql = "INSERT INTO PROVIDER(TYPE, NAME, PHONE, MAIL, CPF_CNPJ, ZIPCODE, STREET, NUMBER, NEIGHBORHOOD, CITY_STATE, ACTIVE, CREATED_BY) VALUES(:TYPE, :NAME, :PHONE, :MAIL, :CPF_CNPJ, :ZIPCODE, :STREET, :NUMBER, :NEIGHBORHOOD, :CITY_STATE, 1, :CREATED_BY)";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":TYPE", $TYPE, PDO::PARAM_STR);
        $stmt->bindParam(":NAME", $NAME, PDO::PARAM_STR);
        $stmt->bindParam(":PHONE", $PHONE, PDO::PARAM_STR);
        $stmt->bindParam(":MAIL", $MAIL, PDO::PARAM_STR);
        $stmt->bindParam(":CPF_CNPJ", $CPF_CNPJ, PDO::PARAM_STR);
        $stmt->bindParam(":ZIPCODE", $ZIPCODE, PDO::PARAM_STR);
        $stmt->bindParam(":STREET", $STREET, PDO::PARAM_STR);
        $stmt->bindParam(":NUMBER", $NUMBER, PDO::PARAM_INT);
        $stmt->bindParam(":NEIGHBORHOOD", $NEIGHBORHOOD, PDO::PARAM_STR);
        $stmt->bindParam(":CITY_STATE", $CITY_STATE, PDO::PARAM_STR);
        $stmt->bindParam(":CREATED_BY", $CREATED_BY, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function editProvider($ID, $TYPE, $NAME, $PHONE, $MAIL, $CPF_CNPJ, $ZIPCODE, $STREET, $NUMBER, $NEIGHBORHOOD, $CITY_STATE, $MODIFIED_BY) {
        $sql = "UPDATE PROVIDER SET TYPE = :TYPE, NAME = :NAME, PHONE = :PHONE, MAIL = :MAIL, CPF_CNPJ = :CPF_CNPJ, ZIPCODE = :ZIPCODE, STREET = :STREET, NUMBER = :NUMBER, NEIGHBORHOOD = :NEIGHBORHOOD, CITY_STATE = :CITY_STATE, MODIFIED_BY = :MODIFIED_BY, MODIFIED_ON = NOW() WHERE ID = :ID";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
        $stmt->bindParam(":TYPE", $TYPE, PDO::PARAM_STR);
        $stmt->bindParam(":NAME", $NAME, PDO::PARAM_STR);
        $stmt->bindParam(":PHONE", $PHONE, PDO::PARAM_STR);
        $stmt->bindParam(":MAIL", $MAIL, PDO::PARAM_STR);
        $stmt->bindParam(":CPF_CNPJ", $CPF_CNPJ, PDO::PARAM_STR);
        $stmt->bindParam(":ZIPCODE", $ZIPCODE, PDO::PARAM_STR);
        $stmt->bindParam(":STREET", $STREET, PDO::PARAM_STR);
        $stmt->bindParam(":NUMBER", $NUMBER, PDO::PARAM_INT);
        $stmt->bindParam(":NEIGHBORHOOD", $NEIGHBORHOOD, PDO::PARAM_STR);
        $stmt->bindParam(":CITY_STATE", $CITY_STATE, PDO::PARAM_STR);
        $stmt->bindParam(":MODIFIED_BY", $MODIFIED_BY, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updateStatusProvider($ID, $STATUS, $MODIFIED_BY) {
        $sql = "UPDATE PROVIDER SET ACTIVE = :STATUS, MODIFIED_BY = :MODIFIED_BY, MODIFIED_ON = NOW() WHERE ID = :ID";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
        $stmt->bindParam(":STATUS", $STATUS, PDO::PARAM_INT);
        $stmt->bindParam(":MODIFIED_BY", $MODIFIED_BY, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    public function deleteProvider($ID) {
        $sql = "DELETE FROM PROVIDER WHERE ID = :ID";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
        return $stmt->execute();
    }


    public function getProviders() {
        $sql = "SELECT * FROM PROVIDER";
        $con = $this->Connect();
        $stmt = $con->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProvider($ID) {
        $sql = "SELECT * FROM PROVIDER WHERE ID = :ID";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
