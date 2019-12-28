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
        agreement_client  ,
        restricted
      )
      VALUES ( ? , ? , ? , ? , 'FALSE' )
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
   * comments        : comments if needed;
   * restricted      : boolean variable that defines if the user wants to keep the data only to
   *                   himself.
   * 
   * OUTPUT ARGUMENTS:
   *   0: operation concluded with success;
   *  -1: the user is not registed in the platform or it isn't a service client;
   *  -2: the client isn't an Active user;
   *  -3: the sensor type specified isn't valid;
   *  -4: the resolution value specified isn't valid;
   *  -5: the combination between sensor_type and resolution_value isn't valid;
   *  -6: date format isn't valid. The correct one is 'DD/MM/AAAA';
   *  -7: deadline must be a date after today;
   *  -8: area variable is NULL;
   *  -9: the area polygon must be defined by at least three vertices;
   * -10: inserting the new area was not possible;
   * -11: inserting the new request was not possible.
   ****************************************************************************************************/
  function newRequestForNewData($area, $client_username, $sensor_type, $resolution_value, $deadline, $comments, $restricted){
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

      if( count($deadline_string_array) != 3 )
        return-6;

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
      
      $stm = $conn->prepare("
        SELECT CURRENT_TIMESTAMP < ? AS deadline_validation;
      ");
      $stm     = $conn->execute(array( "TO_TIMESTAMP('$day $month $year 20' , 'DD MM YYYY HH24')" ));
      $results = $stm->fetch();

      if( $results['deadline_validation'] == FALSE )
        return -7;
    }
    
    // ----------------------------------------
    // Fomulation of string for area definition
    if($area == NULL)
      return -8;
    if($area['polygonsVertLatLng']['numerodevertices'] < 3)
      return -9;
    
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
      return -10;
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
        agreement_client  ,
        restricted
      )
      VALUES ( ? , ? , ? , ? , ? , ? , ? , ? , ? )
    ");
    try{
      $stm->execute(array($deadline==NULL? NULL:"TO_TIMESTAMP('$day $month $year 20' , 'DD MM YYYY HH24')",
                          $area_id,
                          $client_id,
                          $comments,
                          $sensor_type,
                          $resolution_value,
                          'FALSE',
                          'FALSE',
                          $restricted? 'TRUE':'FALSE'
      ));
    } catch(PDOexception $e) {
      // Eliminates the area already created
      $stm = $conn->prepare("
        DELETE FROM area
        WHERE  id = ?
      ");
      $stm->execute(array($area_id));
      return -11;
    }

    // Returns 0 in case of success
    return 0;
  }
  
  /****************************************************************************************************
   ****** CREATENEWMISSION
   ****************************************************************************************************
   * This function creates, from the service provider point of view, a new mission. This is relative 
   * to a certain request that the provider has the capabilities to candidate.
   * It should be noted that CREATENEWMISSION assumes that the vehicle, sensor and resolution belongs 
   * to the service provider. However, it checks if the combination between this three variables is 
   * valid.
   *
   * INPUT ARGUMENTS:
   * :
   * 
   * OUTPUT ARGUMENTS:
   *   0: operation concluded with success;
   *  -1: the user is not registed in the platform or it isn't a service provider;
   *  -2: the provider isn't an Active user;
   *  -3: the service provider has yet to be approved by administration;
   *  -4: date format isn't valid. The correct one is 'DD/MM/AAAA';
   *  -5: estimate start and finish must be a date after today;
   *  -6: estimated finish date must be after estimated start date;
   *  -7: request id does not exist;
   *  -8: the vehicle specified was not founded in the service provider list of vehicles;
   *  -9: the vehicle isn't active;
   * -10: the vehicle doesn't have administration approval;
   * -11: the sensor_name doesn't belong to the vehicle or the type of sensor required to execute 
   *      the mission isn't satisfied;
   * -12: the sensor specified isn't active;
   * -13: the resolution required for the request doesn't match with the selected one by provider;
   * -14: the resolution doesn't math with sensor specified;
   * -15: the resolution selected isn't active;
   * -16: inserting the new mission was not possible;
   * -17: relating the mission with the request was not possible.
   ****************************************************************************************************/
  function createNewMission($request_id, $est_starting_time, $est_finished_time, $price, $provider_username, $vehicle_name, $sensor_name, $resolution_value, $path_pdf){
    // Global variable: connection to the database
    global $conn;

    // ----------------------------------------
    // Checks variable $provider_username
    $stm = $conn->prepare("
      SELECT  users.username               AS provider_username,
              users.status                 AS status           ,
              service_provider.id          AS provider_id      ,
              service_provider.entity_name AS provider_name    ,
              service_provider.approval    AS provider_approval
      FROM  users
      INNER JOIN service_provider
        ON service_provider.user_id = users.username
      WHERE users.username = ?
    ");
    $conn->execute(array($provider_username));
    $results = $stm->fetch();

    if($results == FALSE)
      return -1;
    else if($results['status'] != 'Active')
      return -2;
    else if($results['provider_approval'] == FALSE )
      return -2;
    $provider_id   = $results['provider_id'];
    $provider_name = $results['provider_name'];

    // ----------------------------------------
    // Checks variables $est_starting_time and $est_finished_time
    if($est_starting_time != NULL){
      $starting_date_string = explode( '/' , $est_starting_time , 3 );
      if( count($starting_date_string) != 3 )
        return -4;
      // -> DAY
      $start_day   = $starting_date_string[0];
      // -> MONTH
      $start_month = $starting_date_string[1];
      // -> YEAR
      $start_year  = $starting_date_string[2];

      if( (intval($start_day) <= 0) || (intval($start_month) <= 0) || (intval($start_year) <= 0) )
        return -4;
      if( (intval($start_day) < 1) || (intval($start_day) > 31) )
        return -4;
      if( (intval($start_month) < 1) || (intval($start_month) > 12) )
        return -4;
      if( (intval($start_year) < 1) )
        return -4;

      $stm = $conn->prepare("
        SELECT CURRENT_TIMESTAMP < ? AS date_validation;
      ");
      $stm     = $conn->execute(array( "TO_TIMESTAMP('$start_day $start_month $start_year 20' , 'DD MM YYYY HH24')" ));
      $results = $stm->fetch();
      if( $results['date_validation'] == FALSE )
        return -5;
    }

    if($est_finished_time != NULL){
      $finishing_date_string = explode( '/' , $est_finished_time , 3 );
      if( count($finishing_date_string) != 3 )
        return -4;
      // -> DAY
      $finish_day   = $finishing_date_string[0];
      // -> MONTH
      $finish_month = $finishing_date_string[1];
      // -> YEAR
      $finish_year  = $finishing_date_string[2];

      if( (intval($finish_day) <= 0) || (intval($finish_month) <= 0) || (intval($finish_year) <= 0) )
        return -4;
      if( (intval($finish_day) < 1) || (intval($finish_day) > 31) )
        return -4;
      if( (intval($finish_month) < 1) || (intval($finish_month) > 12) )
        return -4;
      if( (intval($finish_year) < 1) )
        return -4;

      $stm = $conn->prepare("
        SELECT CURRENT_TIMESTAMP < ? AS date_validation;
      ");
      $stm     = $conn->execute(array( "TO_TIMESTAMP('$finish_day $finish_month $finish_year 20' , 'DD MM YYYY HH24')" ));
      $results = $stm->fetch();
      if( $results['date_validation'] == FALSE )
        return -5;
    }
    if(($est_starting_time != NULL) && ($est_finished_time != NULL)){
      $stm = $conn->prepare("
        SELECT ? < ? AS date_validation;
      ");
      $stm     = $conn->execute(array( "TO_TIMESTAMP('$start_day  $start_month  $start_year  20' , 'DD MM YYYY HH24')",
                                      "TO_TIMESTAMP('$finish_day $finish_month $finish_year 20' , 'DD MM YYYY HH24')" 
      ));
      $results = $stm->fetch();
      if( $results['date_validation'] == FALSE )
        return -6;
    }
    

    // ----------------------------------------
    // Check variable $request_id
    $stm = $conn->prepare("
      SELECT * 
      FROM   request
      WHERE  id = ?
    ");
    $stm->execute(array($request_id));
    $results = $stm->fetch();

    if($results == FALSE)
      return -7;
    
    $area_id                 = $results['area_id'];
    $sensor_type_wanted      = $results['sensor_type'];
    $resolution_value_wanted = $results['resolution_type'];

    // ----------------------------------------
    // Checks variables $vehicle_name, $sensor_type and $resolution_value
    // 1: $vehicle_name
    $stm = $conn->prepare("
      SELECT  id,
              vehicle_name,
              active,
              approval
      FROM  vehicle
      WHERE service_provider_id = ? AND
            vehicle_name        = ?
    ");
    $stm->execute(array($provider_id, $vehicle_name));
    $results = $stm->fetch();

    if( $results == FALSE )
      return -8;
    if( $results['active'] == FALSE )
      return -9;
    if( $results['approval'] == FALSE )
      return -10;
    
    $vehicle_id = $results['id'];
    
    // 2: $sensor_name
    $stm = $conn->prepare("
      SELECT  id,
              sensor_type,
              sensor_name,
              active
      FROM  sensor
      WHERE sensor.sensor_name = ? AND
            sensor.vehicle_id  = ? AND
            sensor.sensor_type = ?
    ");
    $stm->execute(array($sensor_name, $vehicle_id, $sensor_type_wanted));


    if( $results == FALSE )
      return -11;
    if( $results['active'] == FALSE )
      return -12;

    $sensor_id = $results['id'];

    // 3: $resolution_value
    $stm = $conn->prepare("
      SELECT  *
      FROM  resolution
      WHERE sensor_id = ? AND
            value     = ?
    ");
    $stm->execute(array($sensor_id, $resolution_value));
    $results = $stm->fetch();

    if( $resolution_value_wanted != $resolution_value )           // [resolution] = cm
      return -13;
    if( $results == FALSE )
      return -14;
    if( $results['active'] == FALSE )
      return -15;
    
    $resolution_id          = $results['id'];
    $resolution_consumption = floatval($results['consumption']);  // ?????
    $resolution_velocity    = floatval($results['vel_sampling']); // m/s that AUV can accomplish running at resolution specified
    $resolution_cost        = floatval($results['cost']);         // €/h
    $resolution_swath       = floatval($results['swath']);        // m

    // ----------------------------------------
    // Inserts into table mission a new entry
    $stm = $conn->prepare("
      INSERT INTO mission (
        status,
        est_starting_time,
        est_finished_time,
        price,
        provider_id,
        resolution_id,
        area_id,
        path_pdf
      )
      VALUES ( ? , ? , ? , ? , ? , ? , ? , ? )
      RETURNING id
    ");
    try{
      $stm->execute(array('Proposal',
                                  $est_starting_time==NULL? NULL:"TO_TIMESTAMP('$start_day $start_month $start_year 20' , 'DD MM YYYY HH24')",
                                  $est_finished_time==NULL? NULL:"TO_TIMESTAMP('$finish_day $finish_month $finish_year 20' , 'DD MM YYYY HH24')",
                                  $price,
                                  $provider_id,
                                  $resolution_id,
                                  $area_id,
                                  $path_pdf
      ));
    } catch(PDOexception $e) {
      return -16;
    }

    $results    = $stm->fetch();
    $mission_id = $results['id'];

    // Inserts in table request_mission a new entry
    $stm = $conn->prepare("
      INSERT INTO request_mission (request_id, mission_id)
      VALUES ( ? , ? )
    ");
    try{
      $stm->execute(array($request_id, $mission_id));
    } catch(PDOexception $e) {
      // Deletes the new mission already present in table mission
      $stm = $conn->prepare("
        DELETE FROM request
        WHERE  id = ?
      ");
      $stm->execute(array($mission_id));
      return -17;
    }

    // ----------------------------------------
    // Notifies the client of new proposal available
    $stm = $prepare("
      SELECT  *
      FROM    service_client
      WHERE   id = ?
    ");
    $stm->execute(array($client_id));
    $results         = $stm->fetch();
    $client_username = $results['user_id'];

    notifyServiceClientNewProposalAvailable($client_username, $provider_name, $provider_username, $request_id, $mission_id);

    // Returns 0 in case of success
    return 0;
  }
  function notifyServiceClientNewProposalAvailable($client_username, $provider_name, $provider_username, $request_id, $mission_id){
    // Global variable: connection to the database
    global $conn;

    // Notification text
    $notification_info = "Service Provider $provider_name ($provider_username) made a new proposal (mission id: $mission_id) for your request (request id: $request_id)";

    // Send to service client that a new proposal is available
    $stm = $conn->prepare("
      INSERT INTO notification( date , information , acknowledged , user_id , mission_id , request_id )
      VALUES ( CURRENT_TIMESTAMP(0) , ? , ? , ? , ? )
    ");
    try{
      $stm->execute(array($notification_info,
                          'FALSE',
                          $client_username,
                          $mission_id,
                          $request_id
      ));
    } catch (PDOexception $e) {
      // Error creating the new notification
      return -1;
    }

    // Success creating the new notification
    return 0;
  }
  


?>