<?php

class mSale extends mConnection
{

    public function createOrder($FK_ID_CLIENT, $CREATED_BY)
    {
        $sql = "INSERT INTO SALE_ORDER (FK_ID_CLIENT, STATUS, CREATED_BY, CREATED_ON) VALUES (:FK_ID_CLIENT,'0',:CREATED_BY,NOW())";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":FK_ID_CLIENT", $FK_ID_CLIENT, PDO::PARAM_INT);
        $stmt->bindParam(":CREATED_BY", $CREATED_BY, PDO::PARAM_INT);
        $stmt->execute();
        return $con->lastInsertId();
    }

    public function insertOrderDetail($FK_ID_ORDER, $FK_ID_PRODUCT, $QTD, $SALE_VALUE, $TOTAL_COST, $CREATED_BY)
    {
        $sql = "INSERT INTO SALE_DETAIL(FK_ID_ORDER, FK_ID_PRODUCT, QTD, SALE_VALUE, TOTAL_COST, CREATED_BY, CREATED_ON) VALUES (:FK_ID_ORDER, :FK_ID_PRODUCT, :QTD, :SALE_VALUE, :TOTAL_COST, :CREATED_BY, NOW())";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":FK_ID_ORDER", $FK_ID_ORDER, PDO::PARAM_INT);
        $stmt->bindParam(":FK_ID_PRODUCT", $FK_ID_PRODUCT, PDO::PARAM_INT);
        $stmt->bindParam(":QTD", $QTD, PDO::PARAM_STR);
        $stmt->bindParam(":SALE_VALUE", $SALE_VALUE, PDO::PARAM_STR);
        $stmt->bindParam(":TOTAL_COST", $TOTAL_COST, PDO::PARAM_STR);
        $stmt->bindParam(":CREATED_BY", $CREATED_BY, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getOrderDetail($FK_ID_ORDER)
    {
        $sql = "SELECT SALE_DETAIL.ID, PRODUCT.DESCRIPTION, QTD, SALE_DETAIL.SALE_VALUE, TOTAL_COST FROM SALE_DETAIL INNER JOIN PRODUCT ON PRODUCT.ID = SALE_DETAIL.FK_ID_PRODUCT WHERE FK_ID_ORDER = :FK_ID_ORDER";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":FK_ID_ORDER", $FK_ID_ORDER, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editProduct($DESCRIPTION, $QUANTITY, $LOW_STOCK, $FK_ID_UNITY, $MEASURE, $COST, $SALE_VALUE, $ON_DEMAND, $FK_ID_PROVIDER, $OBSERVATION, $UPDATED_BY, $ID)
    {
        $sql = "UPDATE PRODUCT SET DESCRIPTION = :DESCRIPTION, QUANTITY = :QUANTITY, LOW_STOCK = :LOW_STOCK, FK_ID_UNITY = :FK_ID_UNITY, MEASURE = :MEASURE, COST = :COST, SALE_VALUE = :SALE_VALUE, ON_DEMAND = :ON_DEMAND, FK_ID_PROVIDER = :FK_ID_PROVIDER, OBSERVATION = :OBSERVATION, MODIFIED_BY = :MODIFIED_BY, MODIFIED_ON = NOW() WHERE ID = :ID";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":DESCRIPTION", $DESCRIPTION, PDO::PARAM_STR);
        $stmt->bindParam(":QUANTITY", $QUANTITY, PDO::PARAM_STR);
        $stmt->bindParam(":LOW_STOCK", $LOW_STOCK, PDO::PARAM_INT);
        $stmt->bindParam(":FK_ID_UNITY", $FK_ID_UNITY, PDO::PARAM_INT);
        $stmt->bindParam(":MEASURE", $MEASURE, PDO::PARAM_STR);
        $stmt->bindParam(":COST", $COST, PDO::PARAM_STR);
        $stmt->bindParam(":SALE_VALUE", $SALE_VALUE, PDO::PARAM_STR);
        $stmt->bindParam(":ON_DEMAND", $ON_DEMAND, PDO::PARAM_INT);
        $stmt->bindParam(":FK_ID_PROVIDER", $FK_ID_PROVIDER, PDO::PARAM_INT);
        $stmt->bindParam(":OBSERVATION", $OBSERVATION, PDO::PARAM_STR);
        $stmt->bindParam(":MODIFIED_BY", $UPDATED_BY, PDO::PARAM_INT);
        $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getProducts($limit = 20)
    {
        if($limit == 0){
            $sql_limit = "";
        } else {
            $sql_limit = " LIMIT " . $limit; 
        }
        $sql = "SELECT * FROM PRODUCT" . $sql_limit;
        $con = $this->Connect();
        $stmt = $con->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProduct($ID)
    {
        $sql = "SELECT * FROM PRODUCT INNER JOIN UNITY ON UNITY.ID = PRODUCT.FK_ID_UNITY WHERE PRODUCT.ID = :ID";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUnity()
    {
        $sql = "SELECT * FROM UNITY WHERE ACTIVE = 1";
        $con = $this->Connect();
        $stmt = $con->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProviders()
    {
        $sql = "SELECT * FROM PROVIDER WHERE ACTIVE = 1";
        $con = $this->Connect();
        $stmt = $con->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProviderName($ID)
    {
        $sql = "SELECT NAME FROM PROVIDER WHERE ID = :ID";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['NAME'];
    }

    public function createProvider($NAME, $PHONE, $MAIL, $CPF_CNPJ, $ZIPCODE, $STREET, $NUMBER, $NEIGHBORHOOD, $CITY_STATE, $CREATED_BY)
    {
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

    public function getAbrevMeasure($ID)
    {
        $sql = "SELECT ABREVIATION FROM UNITY WHERE ID = :ID";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['ABREVIATION'];
    }

    public function deleteProduct($ID)
    {
        $sql = "DELETE FROM PRODUCT WHERE ID = :ID";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":ID", $ID, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getSaleDetails($ID_SALE_ORDER)
    {
        $sql = "SELECT * FROM sale_order INNER JOIN SALE_DETAIL ON SALE_DETAIL.FK_ID_ORDER = :ID_SALE_ORDER WHERE STATUS = 0";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":ID", $ID_SALE_ORDER, PDO::PARAM_INT);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getIdOrderByClient($FK_ID_CLIENT)
    {
        $sql = "SELECT ID FROM sale_order WHERE STATUS = 0 AND FK_ID_CLIENT = :FK_ID_CLIENT";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":FK_ID_CLIENT", $FK_ID_CLIENT, PDO::PARAM_INT);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setSaleDetail($FK_ID_ORDER, $FK_ID_PRODUCT, $QTD, $SALE_VALUE, $TOTAL_COST, $CREATED_BY)
    {
        $sql = "INSERT INTO sale_detail (ID, FK_ID_ORDER, FK_ID_PRODUCT, QTD, SALE_VALUE, TOTAL_COST, CREATED_BY, CREATED_ON) VALUES (:FK_ID_ORDER, :FK_ID_PRODUCT, :QTD, :SALE_VALUE, :TOTAL_COST, :CREATED_BY)";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":FK_ID_ORDER", $FK_ID_ORDER, PDO::PARAM_INT);
        $stmt->bindParam(":FK_ID_PRODUCT", $FK_ID_PRODUCT, PDO::PARAM_INT);
        $stmt->bindParam(":QTD", $QTD, PDO::PARAM_STR);
        $stmt->bindParam(":SALE_VALUE", $SALE_VALUE, PDO::PARAM_STR);
        $stmt->bindParam(":TOTAL_COST", $TOTAL_COST, PDO::PARAM_STR);
        $stmt->bindParam(":CREATED_BY", $CREATED_BY, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function getReservedProducts($PRODUCT_ID) 
    {
        $sql = "SELECT SUM(QTD) AS TOTAL FROM sale_detail INNER JOIN SALE_ORDER ON SALE_ORDER.ID = SALE_DETAIL.FK_ID_ORDER WHERE SALE_ORDER.STATUS = 0 AND FK_ID_PRODUCT = :PRODUCT_ID";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":PRODUCT_ID", $PRODUCT_ID, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function removeItemSaleDetail($ID_ITEM)
    {
        $sql = "DELETE FROM sale_detail WHERE ID = :ID_ITEM";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":ID_ITEM", $ID_ITEM, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function removeOrder($ORDER_ID)
    {   
        $sql = "DELETE FROM sale_detail WHERE FK_ID_ORDER = :ORDER_ID";

        $con = $this->Connect();
        $con->beginTransaction();

        $stmt = $con->prepare($sql);
        $stmt->bindParam(":ORDER_ID", $ORDER_ID, PDO::PARAM_INT);
        
        if($stmt->execute()){
            $con->commit();
        } else{
            $con->rollBack();
        }

        $sql = "DELETE FROM sale_order WHERE ID = :ORDER_ID";

        $con = $this->Connect();
        $con->beginTransaction();

        $stmt = $con->prepare($sql);
        $stmt->bindParam(":ORDER_ID", $ORDER_ID, PDO::PARAM_INT);

        if($stmt->execute()){
            $con->commit();
        } else{
            $con->rollBack();
        }
    }
}
