<?php

class mProduct extends mConnection {

    public function createProduct($DESCRIPTION, $QUANTITY, $LOW_STOCK, $FK_ID_UNITY, $MEASURE, $COST, $SALE_VALUE, $FK_ID_PROVIDER, $OBSERVATION, $CREATED_BY) {
        $sql = "INSERT INTO PRODUCT(DESCRIPTION, QUANTITY, LOW_STOCK, FK_ID_UNITY, MEASURE, COST, SALE_VALUE, FK_ID_PROVIDER, OBSERVATION, CREATED_BY) VALUES(:DESCRIPTION, :QUANTITY, :LOW_STOCK, :FK_ID_UNITY, :MEASURE, :COST, :SALE_VALUE, :FK_ID_PROVIDER, :OBSERVATION, :CREATED_BY)";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":DESCRIPTION", $DESCRIPTION, PDO::PARAM_STR);
        $stmt->bindParam(":QUANTITY", $QUANTITY, PDO::PARAM_INT);
        $stmt->bindParam(":LOW_STOCK", $LOW_STOCK, PDO::PARAM_INT);
        $stmt->bindParam(":FK_ID_UNITY", $FK_ID_UNITY, PDO::PARAM_INT);
        $stmt->bindParam(":MEASURE", $MEASURE, PDO::PARAM_STR);
        $stmt->bindParam(":COST", $COST, PDO::PARAM_STR);
        $stmt->bindParam(":SALE_VALUE", $SALE_VALUE, PDO::PARAM_STR);
        $stmt->bindParam(":FK_ID_PROVIDER", $FK_ID_PROVIDER, PDO::PARAM_INT);
        $stmt->bindParam(":OBSERVATION", $OBSERVATION, PDO::PARAM_STR);
        $stmt->bindParam(":CREATED_BY", $CREATED_BY, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function editProduct($DESCRIPTION, $QUANTITY, $LOW_STOCK, $FK_ID_UNITY, $MEASURE, $COST, $SALE_VALUE, $FK_ID_PROVIDER, $OBSERVATION, $UPDATED_BY, $ID) {
        $sql = "UPDATE PRODUCT SET DESCRIPTION = :DESCRIPTION, QUANTITY = :QUANTITY, LOW_STOCK = :LOW_STOCK, FK_ID_UNITY = :FK_ID_UNITY, MEASURE = :MEASURE, COST = :COST, SALE_VALUE = :SALE_VALUE, FK_ID_PROVIDER = :FK_ID_PROVIDER, OBSERVATION = :OBSERVATION, MODIFIED_BY = :MODIFIED_BY, MODIFIED_ON = NOW() WHERE ID = :ID";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":DESCRIPTION", $DESCRIPTION, PDO::PARAM_STR);
        $stmt->bindParam(":QUANTITY", $QUANTITY, PDO::PARAM_STR);
        $stmt->bindParam(":LOW_STOCK", $LOW_STOCK, PDO::PARAM_STR);
        $stmt->bindParam(":FK_ID_UNITY", $FK_ID_UNITY, PDO::PARAM_INT);
        $stmt->bindParam(":MEASURE", $MEASURE, PDO::PARAM_STR);
        $stmt->bindParam(":COST", $COST, PDO::PARAM_STR);
        $stmt->bindParam(":SALE_VALUE", $SALE_VALUE, PDO::PARAM_STR);
        $stmt->bindParam(":FK_ID_PROVIDER", $FK_ID_PROVIDER, PDO::PARAM_INT);
        $stmt->bindParam(":OBSERVATION", $OBSERVATION, PDO::PARAM_STR);
        $stmt->bindParam(":MODIFIED_BY", $UPDATED_BY, PDO::PARAM_INT);
        $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getProducts() {
        $sql = "SELECT * FROM PRODUCT";
        $con = $this->Connect();
        $stmt = $con->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProduct($ID) {
        $sql = "SELECT PRODUCT.ID, DESCRIPTION, QUANTITY, LOW_STOCK, FK_ID_UNITY, COST, SALE_VALUE, FK_ID_PROVIDER, OBSERVATION, PRODUCT.CREATED_BY, PRODUCT.CREATED_ON, PRODUCT.MODIFIED_BY, PRODUCT.MODIFIED_ON, UNITY.NAME, ABREVIATION  FROM PRODUCT INNER JOIN UNITY ON UNITY.ID = PRODUCT.FK_ID_UNITY WHERE PRODUCT.ID = :ID";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUnity() {
        $sql = "SELECT * FROM UNITY WHERE ACTIVE = 1";
        $con = $this->Connect();
        $stmt = $con->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProviders() {
        $sql = "SELECT * FROM PROVIDER WHERE ACTIVE = 1";
        $con = $this->Connect();
        $stmt = $con->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProviderName($ID) {
        $sql = "SELECT NAME FROM PROVIDER WHERE ID = :ID";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['NAME'];
    }

    public function createProvider($NAME, $PHONE, $MAIL, $CPF_CNPJ, $ZIPCODE, $STREET, $NUMBER, $NEIGHBORHOOD, $CITY_STATE, $CREATED_BY) {
        $sql = "INSERT INTO PROVIDER(NAME, PHONE, MAIL, CPF_CNPJ, ZIPCODE, STREET, NUMBER, NEIGHBORHOOD, CITY_STATE, ACTIVE, CREATED_BY) VALUES(:NAME, :PHONE, :MAIL, :CPF_CNPJ, :ZIPCODE, :STREET, :NUMBER, :NEIGHBORHOOD, :CITY_STATE, 1, :CREATED_BY)";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
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

    public function getAbrevMeasure($ID) {
        $sql = "SELECT ABREVIATION FROM UNITY WHERE ID = :ID";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['ABREVIATION'];
    }

    public function deleteProduct($ID) {
        $sql = "DELETE FROM PRODUCT WHERE ID = :ID";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
        return $stmt->execute();
    }

}
