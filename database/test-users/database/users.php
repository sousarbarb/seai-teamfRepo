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
      WHERE username = ?
    ");
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
      WHERE  username = ?
    ");
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
      WHERE  entity_name = ?
    ");
    $stm->execute(array($approval? 'TRUE':'FALSE', $entity_name));

    // Return the number of affected rows in this query (!! it works !!)
    return $stm->rowCount();
  }

  /****************************************************************************************************
   ***** EMAILVERIFICATIONVALIDATION
   ****************************************************************************************************
   * This function has the main goal OF returning the user information based on username encription.
   ****************************************************************************************************/
  function emailVerificationValidation($id_crypt) {
    // Global variable: connection to the database
	  global $conn;

    // Get user information by username sha1 encryption
    $stm = $conn->prepare("
			SELECT *
			FROM   users
			WHERE  id_crypt = ?
		");
		$stm->execute(array($id_crypt));
		$nresults = $stm->rowCount();

    // Returns the row with user informations or an error identifying the case where user or doesn't exist or e-mail isn't validated
    if($nresults == 0)
		  return -1;
		else
			return $stm->fetch();
  }

  /****************************************************************************************************
   ***** GETSPECIFICSERVICEPROVIDERINFO
   ****************************************************************************************************
   * This function returns the information saved in the database relative to a specific service
   * provider.
   * The column names in the fetched row are the following ones:
   * - username          : user's username;
   * - entity_email      : email to contact the entity / service provider;
   * - entity_name       : entity name;
   * - entity_address    : entity address;
   * - entity_phonenumber: entity phonenumber to contact directly the service provider;
   * - repres_name       : representative name of the service provicer;
   * - repres_email      : representative email of the service provicer;
   * - repres_phonenumber: representative phone number of the service provicer;
   * - entity_logopath   : path in the web server of entity logo.
   ****************************************************************************************************/
  function getSpecificServiceProviderInfo($username) {
    // Global variable: connection to the database
    global $conn;

    // Get service provider information
    $stm = $conn->prepare("
      SELECT username                    AS username,
             e_mail                      AS entity_email,
             entity_name                 AS entity_name,
             address                     AS entity_address,
             phone_number                AS entity_phonenumber,
             official_representative     AS repres_name,
             mail_representative         AS repres_email,
             phone_number_representative AS repres_phonenumber,
             logo_path                   AS entity_logopath
      FROM   users, service_provider
      WHERE  users.username = service_provider.user_id AND
             users.username = ?
    ");
    $stm->execute(array($username));

    // Return user information
    return $stm->fetch();
  }

  /****************************************************************************************************
   ***** GETSPECIFICSERVICECLIENTINFO
   ****************************************************************************************************
   * This function returns the information saved in the database relative to a specific service
   * client.
   * The column names in the fetched row are the following ones:
   * - username          : user's username;
   * - client_email      : email to contact the service client;
   * - client_name       : client name;
   * - client_address    : client address;
   * - client_phonenumber: client phonenumber.
   ****************************************************************************************************/
  function getSpecificServiceClientInfo($username) {
    // Global variable: connection to the database
	  global $conn;

    // Get service client information
    $stm = $conn->prepare("
      SELECT username     AS username,
             e_mail       AS client_email,
             client_name  AS client_name,
             address      AS client_address,
             phone_number AS client_phonenumber
      FROM   users, service_client
      WHERE  users.username = service_client.user_id AND
             users.username = ?
    ");
    $stm->execute(array($username));

    // Return user information
    return $stm->fetch();
  }

  /****************************************************************************************************
   ***** GETSPECIFICADMINISTRATORINFO
   ****************************************************************************************************
   * This function returns all the information saved relative to a specific platform administrator.
   ****************************************************************************************************/
  function getSpecificAdministratorInfo($username) {
    // Global variable: connection to the database
	  global $conn;

    // Get administrator information
    $stm = $conn->prepare("
      SELECT username     AS username,
             e_mail       AS admin_email
      FROM   users, admin
      WHERE  users.username = admin.user_id AND
             users.username = ?
    ");
    $stm->execute(array($username));

    // Return user information
    return $stm->fetch();
  }

  /****************************************************************************************************
   ***** EDITSPECIFICSERVICEPROVIDERINFO
   ****************************************************************************************************
   * This function has the main goal to allow the user editing his personnal informations. In this
   * case, the type of user considerer is a service provider.
   ****************************************************************************************************/
  function editSpecificServiceProviderInfo($username, $entity_name, $entity_email, $entity_address, $entity_phone_number, $entity_logo_path,
                                           $represent_name, $represent_email, $represent_phone_number) {
    // Global variable: connection to the database
    global $conn;

    // Update service provider information
    $stm = $conn->prepare("
      UPDATE users
      SET    e_mail    = ?
      WHERE  username = ?
    ");
    $stm->execute(array($entity_email, $username));

    $stm = $conn->prepare("
      UPDATE service_provider
      SET    entity_name                 = ?,
             address                     = ?,
             phone_number                = ?,
             official_representative     = ?,
             mail_representative         = ?,
             phone_number_representative = ?
      WHERE  user_id = ?
    ");
    $stm->execute(array($entity_name, $entity_address, $entity_phone_number, $represent_name, $represent_email, $represent_phone_number, $username));

    // Return in the function -> IF RETURN > 0 THEN QUERIE WAS A SUCCESS!
    return $stm->rowCount();
  }

  /****************************************************************************************************
   ***** EDITSPECIFICSERVICECLIENTINFO
   ****************************************************************************************************
   * This function has the main goal to allow the user editing his personnal informations. In this
   * case, the type of user considerer is a service client.
   ****************************************************************************************************/
  function editSpecificServiceClientInfo($username, $client_name, $client_email, $client_address, $client_phone) {
    // Global variable: connection to the database
	  global $conn;

    // Update service client information
    $stm = $conn->prepare("
      UPDATE users
      SET    e_mail    = ?
      WHERE  username = ?
    ");
    $stm->execute(array($client_email, $username));

    $stm = $conn->prepare("
      UPDATE service_client
      SET    client_name  = ?,
             address      = ?,
             phone_number = ?
      WHERE  user_id = ?
    ");
    $stm->execute(array($client_name, $client_address, $client_phone, $username));

    // Return in the function -> IF RETURN > 0 THEN QUERIE WAS A SUCCESS!
    return $stm->rowCount();
  }

  /****************************************************************************************************
   ***** EDITSPECIFICADMINISTRATORINFO
   ****************************************************************************************************
   * This function has the main goal to allow the user editing his personnal informations. In this
   * case, the type of user considerer is a administrator.
   ****************************************************************************************************/
  function editSpecificAdministratorInfo($username, $admin_email) {
    // Global variable: connection to the database
	  global $conn;

    // Update administrator information
    $stm = $conn->prepare("
      UPDATE users
      SET    e_mail    = ?
      WHERE  user_id = ?
    ");
    $stm->execute(array($admin_email, $username));

    // Return in the function -> IF RETURN > 0 THEN QUERIE WAS A SUCCESS!
    return $stm->rowCount();
  }

  /****************************************************************************************************
   ***** EDITSPECIFICUSERPASS
   ****************************************************************************************************
   * Edit the password of a specific user given his username.
   ****************************************************************************************************/
  function editSpecificUserPass($username, $password) {
    // Global variable: connection to the database
	  global $conn;

    // Update administrator information
    $stm = $conn->prepare("
      UPDATE users
      SET    password = ?
      WHERE  username = ?
    ");
    $stm->execute(array(sha1($password), $username));

    // Return in the function -> IF RETURN > 0 THEN QUERIE WAS A SUCCESS!
    return $stm->rowCount();
  }

  /****************************************************************************************************
   ***** GETALLNOTINACTIVEUSERS
   ****************************************************************************************************
   * This function returns all users that are active or waiting e-mail confirmation by the admin. A 
   * suggestion is to do a foreach that prints the different information depending which type of user.
   * A table in the webpage could look like this:
   * 
   *   Username | E-mail | Status | Name | Admin Approval
   * -----------|--------|--------|------|-----------------
   *     ...    |   ...  |   ...  |  ... |        ...
   * 
   * To print the information, we could do the following (NOT TESTED):
   * - no ficheiro php:
   *     ...
   *     $users_results = getAllNotInactiveUsers();
   *     $smarty->assign( 'users_results' , $users_results );
   *     ...
   * - no ficheiro tpl:
   *     ...
   *     <table>
   *       <tr>
   *         <th>Username</th>
   *         <th>E-mail</th>
   *         <th>Status</th>
   *         <th>Name</th>
   *         <th>Admin Approval (Service PRovider)</th>
   *       </tr>
   *       {foreach $users_results as $user}
   *       <tr>
   *         <td>{$user['user_username']}</td>
   *         <td>{$user['user_email']}</td>
   *         <td>{$user['user_status']}</td>
   *       {if $user['client_name'] == NULL}
   *         <td>{$user['entity_name']}</td>
   *         <td>{if $user['admin_approval']}Yes{else}No{/if}</td>
   *       {else}
   *         <td>{$user['client_name']}</td>
   *         <td>&#8208;</td>    <!-- Hyphen code to indicate that colunm not valid in this case -->
   *       {/if}
   *       </tr>
   *       {/foreach}
   *     </table>
   ****************************************************************************************************/
  function getAllNotInactiveUsers(){
    // Global variable: connection to the database
    global $conn;
    
    // Get all not inactive users
    $stm = $conn->prepare("
      SELECT
        users.username               AS user_username ,
        users.e_mail                 AS user_email    ,
        users.status                 AS user_status   ,
        service_client.client_name   AS client_name   ,
        service_provider.entity_name AS entity_name   ,
        service_provider.approval    AS admin_approval
      FROM users
      FULL OUTER JOIN service_provider
        ON service_provider.user_id = users.username
      FULL OUTER JOIN service_client
        ON service_client.user_id   = users.username
      WHERE users.status             <> 'Inactive'  AND
        (service_client.client_name  IS NOT NULL    OR 
        service_provider.entity_name IS NOT NULL  )
      ORDER BY user_username ASC
    ");
    $stm->execute();

    // Return all active ou waiting e-mail confirmation users
    return $stm->fetchAll();
  }

?>
