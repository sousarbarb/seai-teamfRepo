<?php

    function loginValidation($username){
        global $conn;
       
        $stm = $conn->prepare("
            SELECT id, 
                username, 
                password 
            FROM users
            WHERE username = ?");
        
        $stm->execute(array($username));
        
        return $stm->fetchAll();    
    }

    function createAdmin($e_mail, $username, $password, $active){
        global $conn;
        
        $stm = $conn->prepare("
            INSERT INTO users (e_mail, 
                username,
                password, 
                active)
            VALUES (?, ?, ?, ?) 
            RETURNING id");
        
        $stm->execute(array($mail), array($username), sha1($password), boolval($active));
        
        $user_id = $stm->fetchAll(); 
        
        $stm = $conn->prepare("
            INSERT INTO admin (user_id)
            VALUES (?) 
            RETURNING id, user_id");
       
            $stm->execute($user_id['id']));

        return $stm->fetchAll();    

    }

    function createServiceClient($e_mail, $username, $password, $address, $phone_number, $client_name){
        global $conn;

        $stmt = $conn->prepare("
            INSERT INTO users (e_mail, 
                username,
                password)
            VALUES (?, ?, ?) 
            RETURNING id");

        $stmt->execute(array($mail), array($username), sha1($password));
        
        $user_id = $stmt->fetchAll();
        
        $stm = $conn->prepare("
            INSERT INTO service_client (user_id, 
                client_name,
                address, 
                phone_number)
            VALUES (?, ?, ?, ?) 
            RETURNING id, user_id");

        $stm->execute($user_id['id']), array($client_name), array($address), array($phone_number));

        return $stm->fetchAll();    
    }

    function updateServiceClient($address, $phone_number, $client_name){
        global $conn;
        
        $stm = $conn->prepare("
            UPDATE service_client
            SET client_name = ?, 
                address = ?, 
                phone_number = ?
            WHERE client_name = ?
            RETURNING * ");
        
        $stm->execute(array($client_name), array($address), array($phone_number), array($client_name));
        
        return $stm->fetchAll();    
    }

    

    function createServiceProvider($entity_name, $address,  $phone_number, $official_representative,  $mail_representative,
    $phone_number_representative, $logo_path, $password, $username, $e_mail){
        global $conn;
        $stm = $conn->prepare("
            INSERT INTO users (e_mail, 
                username, 
                password)
            VALUES (?, ?, ?)
            RETURNING id");
        $stm->execute(array($mail), array($username), sha1($password));
        $user_id = $stm->fetchAll();
        
        $stm = $conn->prepare("
            INSERT INTO service_provider (entity_name, 
                address, 
                phone_number, 
                official_representative,  
                mail_representative,
                phone_number_representative, 
                logo_path, 
                user_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?) 
            RETURNING id, user_id");
        $stm->execute(array($entity_name), array($address), array($phone_number), array($official_representative),
            array($mail_representative), array ($phone_number_representative), array($logo_path), $user_id['id']));

        return $stm->fetchAll();
    }

    function updateServiceProvider($entity_name, $address,  $phone_number, $official_representative,  $mail_representative,
        $phone_number_representative, $logo_path){
        
        global $conn;
        
        $stm = $conn->prepare("
            UPDATE service_provider 
            SET entity_name = ?, 
                address = ?, 
                phone_number = ?, 
                official_representative = ?,  
                mail_representative = ?, 
                phone_number_representative = ?, 
                logo_path = ?
            WHERE entity_name = ?
            RETURNING * ");
        
        $stm->execute(array($entity_name), array($address), array($phone_number), array($official_representative),
            array($mail_representative), array ($phone_number_representative), array($logo_path), array($entity_name));
        
        return $stm->fetchAll();
    }

    function editPassword ($username, $newPassword){
        global $conn;
        
        $stm = $conn->prepare("
            UPDATE users
            SET password = ?
            WHERE username = ?
            RETURNING * ");
        
        $stm->execute(sha1($newPassword), array($username));

        return $stmt->fetchAll();
    }

    function  editActiveUser ($username, $active){
        global $conn;
        
        $stm = $conn->prepare("
            UPDATE users
            SET active = ?
            WHERE username = ?
            RETURNING * ");
        
        $stm->execute(boolval($active), array($username));

        return $stm->fetchAll();    
    }
?>
