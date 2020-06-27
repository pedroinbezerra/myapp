<?php

class mOrder extends mConnection
{
    public function getOrders()
    {
        $sql = "SELECT * FROM SALE_ORDER";
        $con = $this->Connect();
        $stmt = $con->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSaleDetails($ORDER_ID)
    {
        $sql = "SELECT * FROM SALE_DETAIL WHERE FK_ID_ORDER = :FK_ID_ORDER";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":FK_ID_ORDER", $ORDER_ID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderTotalCost($ORDER_ID)
    {
        $sql = "SELECT SUM(TOTAL_COST) TOTAL FROM SALE_DETAIL WHERE FK_ID_ORDER = :FK_ID_ORDER";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":FK_ID_ORDER", $ORDER_ID, PDO::PARAM_INT);
        $stmt->execute();
        $total = $stmt->fetch(PDO::FETCH_ASSOC)['TOTAL'];
        $total = explode('.', $total);
        if (isset($total[1])) {
            return $total = $total[0] . "." . substr($total[1], 0, 2);
        } else {
            return $total = $total[0] . ".00";
        }
    }

    public function getOrder($ID_ORDER)
    {
        $sql = "SELECT * FROM SALE_ORDER WHERE ID = :ID";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":ID", $ID_ORDER, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOrderByClient($ID_ORDER)
    {
        $sql = "SELECT * FROM SALE_ORDER INNER JOIN SALE_DETAIL ON SALE_DETAIL.FK_ID_ORDER = SALE_ORDER.ID WHERE ID = :ID_ORDER";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":ID_ORDER", $ID_ORDER, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOrderByDate($DATE)
    {
        $DATE = $DATE . "%";
        $sql = "SELECT * FROM SALE_ORDER INNER JOIN SALE_DETAIL ON SALE_DETAIL.FK_ID_ORDER = SALE_ORDER.ID WHERE CREATED_ON LIKE :DATE";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":DATE", $DATE, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
