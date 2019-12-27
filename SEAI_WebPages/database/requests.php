<?php
  /****************************************************************************************************
   ****** NEWREQUESTOLDDATA
   ****************************************************************************************************
   * This function creates a new request to acquire data already present in the platform. It should 
   * be noted that the payment agreement is only after choosing a specific data to acquire.
   * Also, after that, just like the request for a mission, the two sides must reach an agreement.
   * 
   * INPUT ARGUMENTS:
   * client_username: client username. This can be obtain by $_SESSION['username'] if set (means the 
   *                  logged in username);
   * mission_id     : integer that equals tothe mission id intended. Also, this probably can be 
   *                  obtain by accessing the mission_id colunm in the query used to display missions
   *                  that match client's criterias.
   * 
   * OUTPUT ARGUMENTS:
   *  0: operation concluded with success;
   * -1: the user is not registed in the platform or it isn't a service client;
   * -2: the client isn't an Active user;
   * -3: mission id isn't valid;
   * -4: mission has yet to be concluded;
   * -5: the data acquired in the mission is restricted to the service client who requested it;
   * -6: the area related to the mission of acquiring data was not founded;
   * -7: inserting the new request was not possible;
   * -8: it was not possible to link the request to the mission in question.
   ****************************************************************************************************/
  function newRequestOldData($client_username, $mission_id){
    // Global variable: connection to the database
    global $conn;

    // ----------------------------------------
    // Checks variable $client_username
    $stm = $conn->prepare("
      SELECT  users.username             AS client_username,
              users.status               AS status         ,
              service_client.id          AS client_id      ,
              service_client.client_name AS client_name
      FROM  users
      INNER JOIN service_client
        ON service_client.user_id = users.username
      WHERE users.username = ?
    ");
    $conn->execute(array($client_username));
    $results = $stm->fetch();

    if($results == FALSE)
      return -1;
    else if($results['status'] != 'Active')
      return -2;
    $client_id = $results['client_id'];
    
    // ----------------------------------------
    // Checks variable $mission_id
    $stm = $conn->prepare("
      SELECT  id,
              status,
              restricted
      FROM  mission
      WHERE id = ?
    ");
    $conn->execute(array($mission_id));
    $results = $stm->fetch();

    if($results == FALSE)
      return -3;
    else if($results['status'] != 'Finish')
      return -4;
    else if($results['restricted'] == TRUE)
      return -5;
    
    // ----------------------------------------
    // Gets area id relative to the mission specified
    // (resolution_type,sensor_type = NULL <=> )
    $stm = $conn->prepare("
      SELECT  area.id    AS area_id   ,
              request.id AS request_id
      FROM  area
      INNER JOIN request
        ON request.area_id = area.id
      INNER JOIN request_mission
        ON request_mission.request_id = request.id
      INNER JOIN mission
        ON mission.id = request_mission.mission_id
      WHERE request.resolution_type IS NOT NULL AND
            request.sensor_type     IS NOT NULL AND
            mission.id = ?
    ");
    $conn->execute(array($mission_id));
    $results = $stm->fetch();

    if($results == FALSE)
      return -6;
    $area_id = $results['area_id'];
    
    // ----------------------------------------
    // Creates the new request
    $stm = $conn->prepare("
      INSERT INTO request (
        area_id           ,
        client_id         ,
        agreement_provider,
        agreement_client
      )
      VALUES ( ? , ? , ? , ? )
      RETURNING id
    ");
    try{
      $stm->execute(array($area_id  ,
                          $client_id,
                          'FALSE'   ,
                          'FALSE'
      ));
    } catch(PDOexception $e) {
      return -7;
    }
    $results = $stm->fetch();
    $request_id = $results['id'];

    // Creates a new entry in table request_mission (relationship * to *)
    $stm = $conn->prepare("
      INSERT INTO request_mission (
        request_id,
        mission_id
      ) 
      VALUES ( ? , ? )
    ");
    try{
      $stm->execute(array($request_id,
                          $mission_id
      ));
    } catch(PDOexception $e) {
      // Eliminates the entry in requests already made
      $stm = $conn->prepare("
        DELETE FROM request
        WHERE request.id = ?
      ");
      $stm->execute(array($request_id));
      return -8;
    }

    // Returns 0 in case of success
    return 0;
  }
  
  /****************************************************************************************************
   ****** NEWREQUESTFORNEWDATA
   ****************************************************************************************************
   * 
   ****************************************************************************************************/
?>