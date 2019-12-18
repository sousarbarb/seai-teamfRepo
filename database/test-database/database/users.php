<?php

 //loginValidation('example');
    //users_id | username | password | active | admin_id | service_provider_id | service_client_id                        
    //     1   | example  | 123456   | t      |          |                     |                 3                       

                |
    function loginValidation($username){
        global $conn;
       
        $stm = $conn->prepare("
            SELECT username,
                   password
            FROM users
            FULL OUTER JOIN admin            ON users.id = admin.user_id
            FULL OUTER JOIN service_provider ON users.id = service_provider.user_id
            FULL OUTER JOIN service_client   ON users.id = service_client.user_id
            WHERE username = ?");
        $stm->execute(array($username));
        
        return $stm->fetchAll();
    }


    function createServiceProvider($entity_name, $address,  $phone_number, $official_representative,  $mail_representative,
    $phone_number_representative, $logo_path, $password, $username, $e_mail){
        global $conn;
        $stm = $conn->prepare("
            INSERT INTO users (
                username,
                e_mail,
                password,
                status,
                id_crypt
            )
            VALUES (?, ?, ?, ?, ?)");
        $stm->execute(array($username, $mail, sha1($password), "Waiting e-mail confirmation", sha1($username)));
        /*status:
         * - Active
         * - Inactive
         * - Waiting e-mail confirmation
         */
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
