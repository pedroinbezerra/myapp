<?php

class mOrder extends mConnection
{
    public function getAllOrders()
    {
        $sql = "SELECT * FROM SALE_ORDER INNER JOIN SALE_DETAILS ON SALE_DETAILS.FK_ID_ORDER = SALE_ORDER.ID";
        $con = $this->Connect();
        $stmt = $con->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderById($ID_ORDER)
    {
        $sql = "SELECT * FROM SALE_ORDER INNER JOIN SALE_DETAILS ON SALE_DETAILS.FK_ID_ORDER = SALE_ORDER.ID WHERE ID = :ID_ORDER";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":DESCRIPTION", $DESCRIPTION, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOrderByClient($ID_ORDER)
    {
        $sql = "SELECT * FROM SALE_ORDER INNER JOIN SALE_DETAILS ON SALE_DETAILS.FK_ID_ORDER = SALE_ORDER.ID WHERE ID = :ID_ORDER";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":ID_ORDER", $ID_ORDER, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOrderByDate($DATE)
    {
        $DATE = $DATE . "%";
        $sql = "SELECT * FROM SALE_ORDER INNER JOIN SALE_DETAILS ON SALE_DETAILS.FK_ID_ORDER = SALE_ORDER.ID WHERE CREATED_ON LIKE :DATE";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":DATE", $DATE, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
