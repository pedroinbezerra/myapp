<?php

class mTransaction extends mConnection
{

    public function createTransaction($FK_ID_ORDER, $PAYMENT_TOKEN, $PAYMENT_METHOD, $CREATED_BY)
    {
        $sql = "INSERT INTO TRANSACTION (FK_ID_ORDER, PAYMENT_TOKEN, PAYMENT_METHOD, CREATED_BY, CREATED_ON) VALUES (:FK_ID_ORDER, :PAYMENT_TOKEN, :PAYMENT_METHOD, :CREATED_BY, NOW())";
        $con = $this->Connect();
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":FK_ID_ORDER", $FK_ID_ORDER, PDO::PARAM_INT);
        $stmt->bindParam(":PAYMENT_TOKEN", $PAYMENT_TOKEN, PDO::PARAM_STR);
        $stmt->bindParam(":PAYMENT_METHOD", $PAYMENT_METHOD, PDO::PARAM_STR);
        $stmt->bindParam(":CREATED_BY", $CREATED_BY, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
