<?php

 //loginValidation('example');
    //users_id | username | password | active | admin_id | service_provider_id | service_client_id                        
    //     1   | example  | 123456   | t      |          |                     |                 3                       

                |
    function loginValidation($username){
        global $conn;
       
        $stm = $conn->prepare("
            SELECT users.id AS users_id, 
                users.username, 
       	        users.password, 
       	        users.active, 
       	        admin.id            AS admin_id,
       	        service_provider.id AS service_provider_id,
       	        service_client.id   AS service_client_id
            FROM users
            FULL OUTER JOIN admin            ON users.id = admin.user_id
            FULL OUTER JOIN service_provider ON users.id = service_provider.user_id
            FULL OUTER JOIN service_client   ON users.id = service_client.user_id
            WHERE username = ?");
        $stm->execute(array($username));
        
        return $stm->fetch();    
    }

    //createAdmin('ex_admin@example.com','ex_admin', '123456', true)
        //INSERT 0 1
    function createAdmin($e_mail, $username, $password, $active){
        global $conn;
        
        $stm = $conn->prepare("
        INSERT INTO users (e_mail, 
            username,
            password, 
            active)
        VALUES (?, ?, ?, ?) 
        RETURNING id");
        
        $stm->execute(array($mail, $username, sha1($password), boolval($active)));
        
        $user_id = $stm->fetch(); 
        
        $stm = $conn->prepare("
            INSERT INTO admin (user_id)
            VALUES (?)");
       
        $stm->execute(array ($user_id['id'])));

        return $stm->fetch() == true;    

    }

    function createServiceClient($e_mail, $username, $password, $address, $phone_number, $client_name, $active){
        global $conn;

        $stmt = $conn->prepare("
            INSERT INTO users (e_mail, 
                username,
                password,
                active)
            VALUES (?, ?, ?, ?) 
            RETURNING id");

        $stmt->execute(array($mail, $username, sha1($password), boolval($active)));
        
        $user_id = $stmt->fetch();
        
        $stm = $conn->prepare("
            INSERT INTO service_client (user_id, 
                client_name,
                address, 
                phone_number)
            VALUES (?, ?, ?, ?) ");

        $stm->execute(array( array($user_id['id']), $client_name, $address, $phone_number));

        return $stm->fetch() == true;    
    }

    function updateServiceClient($address, $phone_number, $client_name){
        global $conn;
        
        $stm = $conn->prepare("
            UPDATE service_client
            SET client_name = ?, 
                address = ?, 
                phone_number = ?
            WHERE client_name = ?");
        
        $stm->execute(array ($client_name, $address, $phone_number, $client_name));
        
        return $stm->fetch() == true;    
    }

    

    function createServiceProvider($entity_name, $address,  $phone_number, $official_representative,  $mail_representative,
    $phone_number_representative, $logo_path, $password, $username, $e_mail){
        global $conn;
        $stm = $conn->prepare("
            INSERT INTO users (e_mail, 
                username, 
                password
                active)
            VALUES (?, ?, ?, ?)
            RETURNING id");
        $stm->execute(array($mail, $username, sha1($password), boolval($active)));
        $user_id = $stm->fetch();
        
        $stm = $conn->prepare("
            INSERT INTO service_provider (entity_name, 
                address, 
                phone_number, 
                official_representative,  
                mail_representative,
                phone_number_representative, 
                logo_path, 
                user_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?) ");
        $stm->execute(array($entity_name, $address, $phone_number, $official_representative,
            $mail_representative, $phone_number_representative, $logo_path, array ($user_id['id'])));

        return $stm->fetch() == true;
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
            WHERE entity_name = ? ");
        
        $stm->execute(array($entity_name, $address, $phone_number, $official_representative,
            $mail_representative,$phone_number_representative, $logo_path, $entity_name));
        
        return $stm->fetch() == true;
    }

    function editPassword ($username, $newPassword){
        global $conn;
        
        $stm = $conn->prepare("
            UPDATE users
            SET password = ?
            WHERE username = ? ");
        
        $stm->execute(array(sha1($newPassword), $username));

        return $stmt->fetch() == true;
    }

    function  editActiveUser ($username, $active){
        global $conn;
        
        $stm = $conn->prepare("
            UPDATE users
            SET active = ?
            WHERE username = ?");
        
        $stm->execute(array(boolval($active), $username ));

        return $stm->fetch() == true;    
    }
?>
