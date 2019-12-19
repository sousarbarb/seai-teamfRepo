<?php
  /****************************************************************************************************
   ***** LOGINVALIDATION
   ****************************************************************************************************
   * Validates the login by retrieving all the camps necessary to verify if the credentials entered 
   * in the login form are correct.
   * In addition to this, this function also retireves the possible user type in order to identity 
   * immediately the user type to generate the different menus associated with each.
   * 
   * Output example without the WHERE constrain (the result with WHERE should be 1 or 0 rows!):
   *      username     |                 password                 |           status            | admin_id | service_provider_id | service_provider_admin_perm | service_client_id
   * ------------------+------------------------------------------+-----------------------------+----------+---------------------+-----------------------------+-------------------
   *  admin            | admin                                    | Active                      |        1 |                     |                             |
   *  example_diffpass | 7c4a8d09ca3762af61e59520943dc26494f8941b | Waiting e-mail confirmation |          |                     |                             |                 2
   *  sousarbarb       | 3fd1bce0b82200789b6b11c1f5eb66d5dfd5a35d | Waiting e-mail confirmation |          |                   1 | f                           |
   *  sousazzz         | abaa521e4971336549ade2a63911104235374da8 | Waiting e-mail confirmation |          |                     |                             |                 1
   ****************************************************************************************************/
  function loginValidation($username){
    // Global variable: connection to the database
    global $conn;

    // Search the username in the database
    $stm = $conn->prepare("
      SELECT users.username,
             users.password,
             users.status,
             admin.id                   AS admin_id,
             service_provider.id        AS service_provider_id,
             service_provider.approval  AS service_provider_admin_perm,
             service_client.id          AS service_client_id 
      FROM users
      FULL OUTER JOIN admin             ON users.username = admin.user_id
      FULL OUTER JOIN service_provider  ON users.username = service_provider.user_id
      FULL OUTER JOIN service_client    ON users.username = service_client.user_id
      WHERE username = ?");
    $stm->execute(array($username));
    
    return $stm->fetch();
  }

  /****************************************************************************************************
   ****** CREATESERVICEPROVIDER
   ****************************************************************************************************
   * Creates a new service provider accordlyng with informatios passed in function arguments. Also,
   * it is checked the credentials searching if there is already an entity with some of these 
   * informations registered in the platform.
   * 
   * NOTE: possible values for user status:
   * - Waiting e-mail confirmation : after registing the user into the platform, he must confirm, in 
   *                                 his e-mail, the credentials inserted;
   * - Active                      : in this state, the service_provider has all the capabilities to 
   *                                 acces the plataform;
   * - Inactive                    : after account removal, by the user itself or by an administrator, 
   *                                 the account passes to inactive (to maintain the data coerency).
   * 
   * ERRORS CONSIDERED:
   * -1: Username already exists in the platform;
   * -2: Entity e-mail already is registered in the platform;
   * -3: Entity name already is defined in the database;
   * -4: Insertion in the database was not possible.
   ****************************************************************************************************/
  function createServiceProvider($username, $password, 
                                 $entity_name, $entity_email, $entity_address, $entity_phone_number, $entity_logo_path,
                                 $represent_name, $represent_email, $represent_phone_number) {
    // Global variable: connection to the database
    global $conn;

    // Validation of service provider credentials
    // 1: check if there is already an e-mail ou username registed in the platform
    $stm = $conn->prepare("
      SELECT *
      FROM   users
      WHERE  username = ? OR
             e_mail   = ?
    ");
    $stm->execute(array( $username , $entity_email ));
    $results = $stm->fetch();
    if( $results != FALSE ){
      if(strcmp($results['username'], $username) == 0)
        return -1;  // Username already exist in the platform
      if(strcmp($results['e_mail'], $entity_email) == 0)
        return -2;  // E-mail already registed in the platform
    }

    // 2: check if the service provider informations are valid and unique in the database
    $stm = $conn->prepare("
      SELECT *
      FROM   service_provider
      WHERE  entity_name = ?
    ");
    $stm->execute(array( $entity_name ));
    if( $stm->fetch() == TRUE ){
      return -3;    // Entity name already registed in the platform
    }

    // Creation of a new service provider in the database
    // 1: Insertion in the users table
    // Possible user status:
    // - Active
    // - Inactive
    // - Waiting e-mail confirmation
    $stm = $conn->prepare("
      INSERT INTO users (
        username,
        e_mail,
        password,
        status,
        id_crypt
      )
      VALUES ( ? , ? , ? , ? , ? )
    ");
    $stm->execute(array($username,
                        $entity_email, 
                        sha1($password), 
                        "Waiting e-mail confirmation", 
                        sha1($username)));

    // 2: Insertion in the service_provider table
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
        approval
      )
      VALUES ( ? , ? , ? , ? , ? , ? , ? , ? , ? )
    ");

    // If any error occours, it is deleted the user from users table
    try{
      $stm->execute(array($entity_name,
                          $entity_address,
                          $entity_phone_number,
                          $represent_name,
                          $represent_email,
                          $represent_phone_number,
                          $entity_logo_path,
                          $username,
                          'FALSE'));
    } catch (PDOException $e) {
      $stm = $conn->prepare("
        DELETE FROM users
        WHERE username = ?
      ");
      $stm->execute(array($username));
      return -4;    // Insertion was not completed successfully!
    }
    
    // Return boolean to report a successful or insuccess user insertion into database
    return 0;
  }

  /****************************************************************************************************
   ***** CREATESERVICECLIENT
   ****************************************************************************************************
   * Creates a service client with the informations provided by the function arguments. Also, checks
   * these informations searching in the database if there is any match to not allow duplicated 
   * registration credentials.
   * 
   * NOTE: possible values for user status:
   * - Waiting e-mail confirmation : after registing the user into the platform, he must confirm, in 
   *                                 his e-mail, the credentials inserted;
   * - Active                      : in this state, the service_provider has all the capabilities to 
   *                                 acces the plataform;
   * - Inactive                    : after account removal, by the user itself or by an administrator, 
   *                                 the account passes to inactive (to maintain the data coerency).
   * 
   * ERRORS CONSIDERED:
   * -1: Username already exists in the platform;
   * -2: Client e-mail already is registered in the platform;
   * -3: Client name already is defined in the database;
   * -4: Insertion in the database was not possible.
   ****************************************************************************************************/
  function createServiceClient($username, $password, 
                               $client_name, $client_email, $client_address, $client_phone) {
    // Global variable: connection to the database
    global $conn;

    // Validation of service client credentials
    // 1: check if there is already an e-mail ou username registed in the platform
    $stm = $conn->prepare("
      SELECT *
      FROM   users
      WHERE  username = ? OR
             e_mail   = ?
    ");
    $stm->execute(array( $username , $client_email ));
    $results = $stm->fetch();
    if( $results != FALSE ){
      if(strcmp($results['username'], $username) == 0)
        return -1;  // Username already exist in the platform
      if(strcmp($results['e_mail'], $client_email) == 0)
        return -2;  // E-mail already registed in the platform
    }

    // 2: check if the service client informations are valid and unique in the database
    $stm = $conn->prepare("
      SELECT *
      FROM   service_client
      WHERE  client_name = ?
    ");
    $stm->execute(array( $client_name ));
    if( $stm->fetch() == TRUE ){
      return -3;    // Client name already registed in the platform
    }

    // Creation of a new service client in the database
    // 1: Insertion in the users table
    // Possible user status:
    // - Active
    // - Inactive
    // - Waiting e-mail confirmation
    $stm = $conn->prepare("
      INSERT INTO users (
        username,
        e_mail,
        password,
        status,
        id_crypt
      )
      VALUES ( ? , ? , ? , ? , ? )
    ");
    $stm->execute(array($username,
                        $client_email, 
                        sha1($password), 
                        "Waiting e-mail confirmation", 
                        sha1($username)));

    // 2: Insertion in the service_provider table
    $stm = $conn->prepare("
      INSERT INTO service_client (
        client_name, 
        address, 
        phone_number,
        user_id
      )
      VALUES ( ? , ? , ? , ? )
    ");
    
    // If any error occours, it is deleted the user from users table
    try{
      $stm->execute(array($client_name,
                          $client_address,
                          $client_phone,
                          $username));
    } catch (PDOException $e) {
      $stm = $conn->prepare("
        DELETE FROM users
        WHERE username = ?
      ");
      $stm->execute(array($username));
      return -4;    // Insertion was not completed successfully!
    }
    
    // Return boolean to report a successful or insuccess user insertion into database
    return 0;
  }

  /****************************************************************************************************
   ***** EDITUSERSTATUS
   ****************************************************************************************************
   * Given an unsername and a possible status for the specific user, his status is updated in the 
   * database.
   * 
   * The possible status, for now available, are the following ones:
   * - Waiting e-mail confirmation : after registing the user into the platform, he must confirm, in 
   *                                 his e-mail, the credentials inserted;
   * - Active                      : in this state, the service_provider has all the capabilities to 
   *                                 acces the plataform;
   * - Inactive                    : after account removal, by the user itself or by an administrator, 
   *                                 the account passes to inactive (to maintain the data coerency).
   ****************************************************************************************************/
  function editUserStatus($username, $status){
    // Global variable: connection to the database
    global $conn;
    
    // Update status (assuming that the username is valid!)
    $stm = $conn->prepare("
        UPDATE users
        SET    status   = ?
        WHERE  username = ?");
    $stm->execute(array($status, $username));

    // Return the number of affected rows in this query (!! it works !!)
    return $stm->rowCount();
  }

  /****************************************************************************************************
   ***** EDITSERVICEPROVIDERAPPROVAL
   ****************************************************************************************************
   * This function has the main goal of altering the approval boolean value of a specific service
   * provider.
   * If the return is GREATER than 0, the querie was successfully executed. If not, some error occured
   * durint the querie execution.
   ****************************************************************************************************/
  function editServiceProviderApproval($entity_name, $approval) {
    // Global variable: connection to the database
    global $conn;
    
    // Update status (assuming that the entity_name is valid!)
    $stm = $conn->prepare("
        UPDATE service_provider
        SET    approval = ?
        WHERE  entity_name = ?");
    $stm->execute(array($approval? 'TRUE':'FALSE', $entity_name));

    // Return the number of affected rows in this query (!! it works !!)
    return $stm->rowCount();
  }
  
  /****************************************************************************************************
   ***** emailVerificationValidation
   ****************************************************************************************************
   * This function has the main goal returning the information of the user based on its crypt key
   ****************************************************************************************************/
  
  function emailVerificationValidation($id_crypt) {
	  global $conn;
		  $stm = $conn->prepare('
			SELECT *
			FROM   users
			WHERE  id_crypt = ?
			RETURNING username
		  ');
		  $stm->execute(array($id_crypt));
		  $nresults = $stm->rowCount;
		if($nresults == 0)
		  return -1;
		else
			return $stm->fetch();
}
  
  
?>