<?php


    function updateSpecification($specification_type, $value, $comments, $id){ 
        global $conn;
        $stmt = $conn->prepare("
            UPDATE specification
            SET specification_type = ?,
                value = ?,
                comments = ?
            WHERE id = ?");
        $stmt->execute(array($specification_type, $value, $comments, $id));
        return $stmt->fetchAll();
    }

    function createCommunication($communication_type){
        global $conn;
        $stmt = $conn->prepare("
            INSERT INTO communication (communication_type)
            VALUES (?)");
        $stmt->execute(array($communication_type));
        return $stmt->fetchAll();
    }

    function communicationTypes(){
        global $conn;
        $stmt = $conn->prepare("
            SELECT DISTINCT communication_type
            FROM communication");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function specificationTypes(){
        global $conn;
        $stmt = $conn->prepare("
            SELECT DISTINCT specification_type
            FROM specification");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function sensorTypes(){
        global $conn;
        $stmt = $conn->prepare("
            SELECT DISTINCT sensor_type
            FROM sensor");
        $stmt->execute();
        return $stmt->fetchAll();
    }
?>
