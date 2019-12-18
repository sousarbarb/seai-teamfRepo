<?php
    function loginValidation($username){
        global $conn;

        $stm = $conn->prepare("
            SELECT users.username,
                   users.password,
                   users.status,
                   admin.id            AS admin_id,
                   service_provider.id AS service_provider_id,
                   service_client.id   AS service_client_id 
            FROM users
            FULL OUTER JOIN admin            ON users.username = admin.user_id
            FULL OUTER JOIN service_provider ON users.username = service_provider.user_id
            FULL OUTER JOIN service_client   ON users.username = service_client.user_id
            WHERE username = ?");
        $stm->execute(array($username));
        
        return $stm->fetchAll();
    }

    function createServiceProvider($entity_name, $address, $phone_number, $official_representative,  $mail_representative,
    $phone_number_representative, $logo_path, $password, $username, $e_mail){
        global $conn;

        $stm = $conn->prepare("
            SELECT * FROM users WHERE username = ? OR e_mail = ?");
        $stm->execute(array($username, $e_mail));
        $results = $stm->fetch();
        if($results != FALSE){
            if(strcmp($results['username'], $username) == 0)
                return -1;
            else if(strcmp($results['e_mail'], $e_mail) == 0)
                return -2;
        }
        $stm = $conn->prepare("
            SELECT * FROM service_provider WHERE entity_name = ?");
        $stm->execute(array($entity_name));
        if($stm->fetch() == TRUE){
            return -3;
        }
        
        $stm = $conn->prepare("
            INSERT INTO users (
                username,
                e_mail,
                password,
                status,
                id_crypt
            )
            VALUES (?, ?, ?, ?, ?)");
        $stm->execute(array($username, $e_mail, sha1($password), "Waiting e-mail confirmation", sha1($username)));
        /*status:
         * - Active
         * - Inactive
         * - Waiting e-mail confirmation
         */
        $stm = $conn->prepare("
            INSERT INTO service_provider (
                entity_name, 
                address, 
                phone_number, 
                official_representative,  
                mail_representative,
                phone_number_representative, 
                logo_path, 
                user_id,
                approval)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stm->execute(array($entity_name, $address, $phone_number, $official_representative, $mail_representative, 
            $phone_number_representative, $logo_path, $username, boolval(FALSE)));

        return ($stm->fetch()==true);
    }

    function createServiceClient($e_mail, $username, $password, $address, $phone_number, $client_name){
        global $conn;

        $stm = $conn->prepare("
            SELECT * FROM users WHERE username = ? OR e_mail = ?");
        $stm->execute(array($username, $e_mail));
        $results = $stm->fetch();
        if($results != FALSE){
            if(strcmp($results['username'], $username) == 0)
                return -1;
            else if(strcmp($results['e_mail'], $e_mail) == 0)
                return -2;
        }
        $stm = $conn->prepare("
            SELECT * FROM service_client WHERE client_name = ?");
        $stm->execute(array($client_name));
        if($stm->fetch() == TRUE){
            return -3;
        }

        $stm = $conn->prepare("
            INSERT INTO users (
                username,
                e_mail,
                password,
                status,
                id_crypt
            )
            VALUES (?, ?, ?, ?, ?)");
        $stm->execute(array($username, $e_mail, sha1($password), "Waiting e-mail confirmation", sha1($username)));
        /*status:
         * - Active
         * - Inactive
         * - Waiting e-mail confirmation
         */
        
        $stm = $conn->prepare("
            INSERT INTO service_client (
                user_id, 
                client_name,
                address, 
                phone_number)
            VALUES (?, ?, ?, ?) ");

        $stm->execute(array($username, $client_name, $address, $phone_number));

        return $stm->fetch() == true;    
    }

    function editUserStatus($username, $status){
        global $conn;
        
        $stm = $conn->prepare("
            UPDATE users
            SET status = ?
            WHERE username = ?");
        
        $stm->execute(array($status, $username));

        return $stm->fetch() == true;    
    }

    function editServiceProviderApproval($entity_name, $approval){
        global $conn;
        
        $stm = $conn->prepare("
            UPDATE service_provider
            SET approval = ?
            WHERE entity_name = ?");
        
        $stm->execute(array(boolvar($approval), $entity_name));
        
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


?>
