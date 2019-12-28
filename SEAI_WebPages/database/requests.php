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
   * This function is relative to creating a new request to acquire data not present in the platform. 
   * Note that the sensor type and resolution value are always requires in order to the request be a 
   * valid one.
   * 
   * INPUT ARGUMENTS:
   * area:           : PHP structure that contains all the points of the area selected by the user;
   * client_username : client username. This can be obtain by $_SESSION['username'] if set (means the 
   *                   logged in username);
   * sensor_type     : one of the sensor types that are present in the platform;
   * resolution_value: one of the resolution values that are present in the platform;
   * deadline        : date in the following format -> 'DD/MM/AAAA'. This camp isn't always required
   *                   (just when the user wants to specify a date to obtain the data);
   * comments        : comments if needed.
   * 
   * OUTPUT ARGUMENTS:
   *   0: operation concluded with success;
   *  -1: the user is not registed in the platform or it isn't a service client;
   *  -2: the client isn't an Active user;
   *  -3: the sensor type specified isn't valid;
   *  -4: the resolution value specified isn't valid;
   *  -5: the combination between sensor_type and resolution_value isn't valid;
   *  -6: date format isn't valid. The correct one is 'DD/MM/AAAA';
   *  -7: area variable is NULL;
   *  -8: the area polygon must be defined by at least three vertices;
   *  -9: inserting the new area was not possible;
   * -10:
   ****************************************************************************************************/
  function newRequestForNewData($area, $client_username, $sensor_type, $resolution_value, $deadline, $comments){
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
    // Checks sensor type and resolution value
    // 1: checks sensor type
    $stm = $conn->prepare("
      SELECT  *
      FROM    sensor
      WHERE   active      = 'TRUE' AND
              sensor_type = ?
    ");
    $stm->execute(array($sensor_type));
    $results = $stm->fetchAll();

    if($results == FALSE)
      return -3;
    
    // 2: checks resolution value
    $stm = $conn->prepare("
      SELECT  *
      FROM    resolution
      WHERE   active = 'TRUE' AND
              value  = ?
    ");
    $stm->execute(array($resolution_value));
    $results = $stm->fetchAll();

    if($results == FALSE)
      return -4;

    // 3: checks if the combination sensor_type @ res_value is valid
    $stm = $conn->prepare("
      SELECT  sensor.id          AS sensor_id        ,
              sensor.sensor_type AS sensor_type      ,
              sensor.active      AS sensor_active    ,
              resolution.id      AS resolution_id    ,
              resolution.value   AS resolution_value ,
              resolution.active  AS resolution_active
      FROM  resolution
      INNER JOIN sensor
        ON  resolution.sensor_id = sensor.id
      WHERE sensor.active      = 'TRUE' AND
            resolution.active  = 'TRUE' AND
            sensor.sensor_type = ?      AND
            resolution.value   = ?
    ");
    $stm->execute(array($sensor_type,
                        $resolution_value
    ));

    if($results == FALSE)
      return -5;
    
    // ----------------------------------------
    // Checks $deadline variable
    // (desired format: 'DD/MM/AAAA')
    if($deadline != NULL){
      $deadline_string_array = explode( '/' , $deadline , 3 );
      // DAY
      $day = $deadline_string_array[0];
      // MONTH
      $month = $deadline_string_array[1];
      // YEAR
      $year = $deadline_string_array[2];

      // Check if values are valid
      if( (intval($day) <= 0) || (intval($month) <= 0) || (intval($year) <= 0) )
        return -6;
      if( (intval($day) < 1) || (intval($day) > 31) )
        return -6;
      if( (intval($month) < 1) || (intval($month) > 12) )
        return -6;
      if( (intval($year) < 1) )
        return -6;
    }
    
    // ----------------------------------------
    // Fomulation of string for area definition
    if($area == NULL)
      return -7;
    if($area['polygonsVertLatLng']['numerodevertices'] < 3)
      return -8;
    
    $polygon = "ST_GeographyFromText( 'POLYGON( ( ";

    $polygon .= $area['polygonsVertLatLng']['vertices'][0]['long'];
    $polygon .= "   ";
    $polygon .= $area['polygonsVertLatLng']['vertices'][0]['lat'];

    for($i = 1 ; $i < $area['polygonsVertLatLng']['numerodevertices'] ; $i++){
      $polygon .= " , ";
      $polygon .= $area['polygonsVertLatLng']['vertices'][$i]['long'];
      $polygon .= "   ";
      $polygon .= $area['polygonsVertLatLng']['vertices'][$i]['lat'];
    }

    $polygon .= ") ) ' )";
    
    // ----------------------------------------
    // Create a new area
    $stm = $conn->prepare("
      INSERT INTO area ( polygon )
      VALUES    ( ? )
      RETURNING id
    ");
    try{
      $stm->execute(array($polygon));
    } catch(PDOexception $e) {
      return -9;
    }

    $results = $stm->fetch();
    $area_id = $results['id'];
    
    // ----------------------------------------
    // Create a new request
    $stm = $conn->prepare("
      INSERT INTO request (
        deadline          ,
        area_id           ,
        client_id         ,
        comments          ,
        sensor_type       ,
        resolution_type   ,
        agreement_provider,
        agreement_client
      )
      VALUES ( ? , ? , ? , ? , ? , ? , ? , ? )
    ");
    try{
      $stm->execute(array($deadline==NULL? NULL:"TO_TIMESTAMP('$day $month $year' , 'DD MM YYYY HH24')",
                          $area_id,
                          $client_id,
                          $comments,
                          $sensor_type,
                          $resolution_value,
                          'FALSE',
                          'FALSE'
      ));
    } catch(PDOexception $e) {
      // Eliminates the area already created
      $stm = $conn->prepare("
        DELETE FROM area
        WHERE  id = ?
      ");
      $stm->execute(array($area_id));
      return -10;
    }

    // Returns 0 in case of success
    return 0;
  }
?>