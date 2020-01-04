<?php
  /****************************************************************************************************
   ***** GETREQUESTINFO
   ****************************************************************************************************/
  function getRequestInfo( $request_id ){
    // Global variable: connection to the database
    global $conn;

    // Get request information
    $stm = $conn->prepare("
    WITH request_mission_link AS (
      SELECT
        request_mission.request_id   AS request_temp_id  ,
        mission.id                   AS mission_id       ,
        mission.status               AS mission_status   ,
        mission.path_pdf             AS mission_path_pdf ,
        service_provider.entity_name AS provider_name    ,
        service_provider.user_id     AS provider_username
      FROM mission
      INNER JOIN request_mission
        ON request_mission.mission_id = mission.id
      INNER JOIN service_provider
        ON service_provider.id = mission.provider_id
      WHERE
        mission.status <> 'Proposal' AND
        mission.status <> 'Refused'
    )
      SELECT
        service_client.client_name AS client_name        ,
        service_client.user_id     AS client_username    ,
        request.id                 AS request_id         ,
        request.sensor_type        AS request_sensor_type,
        request.resolution_type    AS request_res_value  ,
        request.comments           AS request_comments   ,
        request.restricted         AS request_restricted ,
        ST_AsText(area.polygon)    AS area_polygon       ,
        data.price                 AS data_price         ,
        data.date                  AS data_date          ,
        data.file_type             AS data_file_type     ,
        request_mission_link.mission_id        AS mission_id       ,
        request_mission_link.mission_status    AS mission_status   ,
        request_mission_link.mission_path_pdf  AS mission_details  ,
        request_mission_link.provider_name     AS provider_name    ,
        request_mission_link.provider_username AS provider_username
      FROM request
      INNER JOIN service_client
        ON service_client.id = request.client_id
      INNER JOIN area
        ON area.id = request.area_id
      LEFT JOIN data
        ON data.id = area.data_id
      FULL OUTER JOIN request_mission_link
        ON request_mission_link.request_temp_id = request.id
      WHERE request.id = ?
    ");
    $stm->execute(array($request_id));

    // Return all requests
    return $stm->fetch();
  }

  /****************************************************************************************************
   ***** GETREQUESTSWAITINGPROPOSALS
   ****************************************************************************************************/
  function getRequestsWaitingProposals( $client_id ){
    // Global variable: connection to the database
    global $conn;

    // Get all request waiting proposals
    $stm = $conn->prepare("
      SELECT DISTINCT
        request.id                 AS request_id         ,
        request.deadline           AS request_deadline   ,
        request.area_id            AS request_area_id    ,
        request.comments           AS request_comments   ,
        request.sensor_type        AS request_sensor_type,
        request.resolution_type    AS request_res_value  ,
        request.restricted         AS request_restricted
      FROM request
      FULL OUTER JOIN request_mission
        ON request_mission.request_id = request.id
      FULL OUTER JOIN mission
        ON mission.id = request_mission.mission_id
      WHERE
        request.sensor_type     IS NOT NULL AND
        request.resolution_type IS NOT NULL AND
        ( mission.status    = 'Proposal'    OR
          mission.status    = 'Refused'     OR
          mission.status    IS NULL       ) AND
        request.client_id = ?
    ");
    $stm->execute(array($client_id));

    // Return results
    return $stm->fetchAll();
  }

  /****************************************************************************************************
   ***** GETALLMISSIONROPOSAL
   ****************************************************************************************************/
  function getAllMissionsProposal( $request_id ){
    // Global variable: connection to the database
    global $conn;

    // Get all areas relative to data already present in database
    $stm = $conn->prepare("
      SELECT
        mission.id                   AS mission_id              ,
        mission.est_starting_time    AS mission_estimated_start ,
        mission.est_finished_time    AS mission_estimated_finish,
        mission.price                AS mission_price           ,
        mission.path_pdf             AS mission_path_pdf        ,
        mission.provider_id          AS provider_id             ,
        service_provider.entity_name AS provider_name           ,
        service_provider.user_id     AS provider_username
      FROM request
      INNER JOIN request_mission
        ON request_mission.request_id = request.id
      INNER JOIN mission
        ON mission.id = request_mission.mission_id
      INNER JOIN service_provider
        ON service_provider.id = mission.provider_id
      WHERE
        mission.status            = 'Proposal' AND
        service_provider.approval = TRUE       AND
        request.id = ?
    ");
    $stm->execute(array($request_id));

    // Return results
    return $stm->fetchAll();
  }
  function ServiceProviderIgnoreAvailableRequest( $request_id, $provider_id ){
    // Global variable: connection to the database
    global $conn;

    // Delete line from provider_request
    $stm = $conn->prepare("
      DELETE FROM provider_request
      WHERE request_id  = ? AND
            provider_id = ?
    ");
    $stm->execute(array($request_id, $provider_id));
  }

  /****************************************************************************************************
   ***** GETALLREQUESTS
   ****************************************************************************************************/
  function getAllRequests( $provider_id ) {
    // Global variable: connection to the database
    global $conn;

    // Get all areas relative to data already present in database
    $stm = $conn->prepare("
      SELECT
        request.id                 AS request_id         ,
        request.deadline           AS request_deadline   ,
        request.area_id            AS request_area_id    ,
        request.comments           AS request_comments   ,
        request.sensor_type        AS request_sensor_type,
        request.resolution_type    AS request_res_value  ,
        request.restricted         AS request_restricted ,
        request.client_id          AS client_id          ,
        service_client.client_name AS client_name        ,
        service_client.user_id     AS client_username
      FROM request
      INNER JOIN service_client
        ON service_client.id = request.client_id
      INNER JOIN provider_request
        ON provider_request.request_id = request.id
      WHERE
        request.sensor_type     IS NOT NULL AND
        request.resolution_type IS NOT NULL AND
        provider_request.provider_id   = ?
    ");
    $stm->execute(array($provider_id));

    // Return results
    return $stm->fetchAll();
  }

  /****************************************************************************************************
   ****** GETALLDATASTOREDAREAS
   ****************************************************************************************************
   * Gets all areas relative to public data stored in the platform. The primary use for this function
   * is to display these areas in the map when the user is selecting the intended area.
   *
   * INPUT ARGUMENTS:
   * None.
   *
   * OUTPUT ARGUMENTS:
   * Querie with all areas OR NULL (if the platform has no data to show / sell).
   ****************************************************************************************************/
  function getAllDataStoredAreas(){
    // Global variable: connection to the database
    global $conn;

    // Get all areas relative to data already present in database
    $stm = $conn->prepare("
      SELECT
        request.id                    AS request_id         ,
        request.sensor_type           AS request_sensor_type,
        request.resolution_type       AS request_res_value  ,
        request.comments              AS request_comments   ,
        data.path                     AS data_filepath      ,
        data.price                    AS data_price         ,
        data.date                     AS data_date          ,
        data.file_type                AS data_filetype      ,
        ST_AsText(area.polygon)       AS area_polygon
      FROM request
      INNER JOIN area
        ON  area.id = request.area_id
      INNER JOIN data
        ON  data.id = area.data_id
      WHERE
        request.restricted      = 'FALSE'   AND
        request.sensor_type     IS NOT NULL AND
        request.resolution_type IS NOT NULL AND
        area.data_id            IS NOT NULL
    ");
    $stm->execute();

    // Return results
    return $stm->fetchAll();
  }

  function getAllStoredAreas(){
    // Global variable: connection to the database
    global $conn;

    // Get all areas relative to data already present in database
    $stm = $conn->prepare("
      SELECT
        ST_AsText(area.polygon)       AS area_polygon
      FROM request
      INNER JOIN area
        ON  area.id = request.area_id
      INNER JOIN data
        ON  data.id = area.data_id
      WHERE
        request.restricted      = 'FALSE'   AND
        request.sensor_type     IS NOT NULL AND
        request.resolution_type IS NOT NULL AND
        area.data_id            IS NOT NULL
    ");
    $stm->execute();

    // Return results
    return $stm->fetchAll();
  }


  /****************************************************************************************************
   ****** SEARCHDATAWITHFILTER
   ****************************************************************************************************
   * Function that explores all data present in database and retrieves which ones intersects with
   * area selected by the service client. Also, the querie takes into account the restricted property
   * that, when is set TRUE, the respective data can't show.
   *
   * INPUT ARGUMENTS:
   * area                : PHP structure containin all vertices that defines the area selected by a
   *                       service client;
   * sensors_selected    : array containing the sensors types selected (see how its done
   *                       in git/database/test-vehicles);
   * resolutions_selected: array containing the resolution values selected (see how its done
   *                       in git/database/test-vehicles);
   * filetypes_selected  : array containing the file types selected (see how its done
   *                       in git/database/test-vehicles).
   *
   * OUTPUT ARGUMENTS:
   * -1: the PHP structure representing the area is not defined;
   * -2: minimum number of vertice to define a polygon must be greater or equal to three;
   ****************************************************************************************************
   ****** PROCESSPOLYGONGETSTRING
   ****************************************************************************************************
   ****** GETDATAFILTERFILETYPE
   ****************************************************************************************************/
  function searchDataWithFilters($area, $sensors_selected, $resolutions_selected, $filetypes_selected){
    // Global variable: connection to the database
    global $conn;

    // --------------------------------------------------------------------------------
    // PROCESS AREA
    if($area == NULL)
      return -1;
    if($area['polygonsVertLatLng'][0]['numberVertices'] < 3)
      return -2;
    $polygon = processPolygonGetString($area);

    // --------------------------------------------------------------------------------
    // PROCESSING FILTERS
    // Inital query
    $sql_prepare = [];
    $sql ="
      SELECT
        service_provider.entity_name  AS provider_name      ,
        service_provider.user_id      AS provider_username  ,
        mission.id                    AS mission_id         ,
        mission.path_pdf              AS mission_details_pdf,
        request.id                    AS request_id         ,
        request.sensor_type           AS request_sensor_type,
        request.resolution_type       AS request_res_value  ,
        request.comments              AS request_comments   ,
        data.path                     AS data_filepath      ,
        data.price                    AS data_price         ,
        data.date                     AS data_date          ,
        data.file_type                AS data_filetype      ,
        ST_AsText(area.polygon)       AS area_polygon       ,
        ST_Intersects(
          ?            :: geography,
          area.polygon :: geography
        )                             AS area_boolintersects,
        ST_Area(ST_Intersection( ?::geography , area.polygon::geography )::geography, true)
        /
        ST_Area( ?::geography,true )  AS area_ratio         ,
        CAST(data.price AS double precision)
        / ST_Area( area.polygon::geography, true )
                                      AS price_area_ratio
      FROM  mission
      INNER JOIN service_provider
        ON  service_provider.id = mission.provider_id
      INNER JOIN request_mission
        ON  request_mission.mission_id = mission.id
      INNER JOIN request
        ON  request.id = request_mission.request_id
      INNER JOIN area
        ON  area.id = request.area_id
      INNER JOIN data
        ON  data.id = area.data_id
      WHERE
        mission.status          = 'Finish'  AND
        request.restricted      = 'FALSE'   AND
        request.sensor_type     IS NOT NULL AND
        request.resolution_type IS NOT NULL AND
        area.data_id            IS NOT NULL AND
        ST_Intersects(
          ?            :: geography,
          area.polygon :: geography
        )                        = 'TRUE'
    ";
    array_push( $sql_prepare , $polygon );
    array_push( $sql_prepare , $polygon );
    array_push( $sql_prepare , $polygon );
    array_push( $sql_prepare , $polygon );

    // SETTING UP FILTERS
    // Sensor Type
    if(!empty($sensors_selected)){
      $sql .= " AND (";
      foreach($sensors_selected as $selected){
        $select_stripTags = strip_tags( $selected );
        $sql .= " request.sensor_type = ? OR ";
        array_push( $sql_prepare , $select_stripTags );
      }
      $sql .= " 'FALSE' ) ";
    }
    // Resolution Value
    if(!empty($resolutions_selected)){
      $sql .= " AND (";
      foreach($resolutions_selected as $selected){
        $select_stripTags = strip_tags( $selected );
        $sql .= " request.resolution_type = ? OR ";
        array_push( $sql_prepare , $select_stripTags );
      }
      $sql .= " 'FALSE' ) ";
    }
    // File Type
    if(!empty($filetypes_selected)){
      $sql .= " AND (";
      foreach($filetypes_selected as $selected){
        $select_stripTags = strip_tags( $selected );
        $sql .= " data.file_type = ? OR ";
        array_push( $sql_prepare , $select_stripTags );
      }
      $sql .= " 'FALSE' ) ";
    }

    // --------------------------------------------------------------------------------
    // EXECUTING QUERY
    $stm = $conn->prepare($sql);
    $stm->execute($sql_prepare);

    // Return results
    return $stm->fetchAll();
  }
  function processPolygonGetString($area){
    // Initial string necessary for query
    $polygon = "POLYGON( ( ";
	  $n_poly =$area['numberPolygons'];
    // Add to polygon the points vertices defined by the user
    $polygon .= $area['polygonsVertLatLng'][$n_poly-1]['vertices'][0]['lng'];
    $polygon .= "   ";
    $polygon .= $area['polygonsVertLatLng'][$n_poly-1]['vertices'][0]['lat'];

    for($i = 1 ; $i < $area['polygonsVertLatLng'][$n_poly-1]['numberVertices'] ; $i++){
      $polygon .= " , ";
      $polygon .= $area['polygonsVertLatLng'][$n_poly-1]['vertices'][$i]['lng'];
      $polygon .= "   ";
      $polygon .= $area['polygonsVertLatLng'][$n_poly-1]['vertices'][$i]['lat'];
    }

    // Closing polygon
    $polygon .= " , ";
    $polygon .= $area['polygonsVertLatLng'][$n_poly-1]['vertices'][0]['lng'];
    $polygon .= "   ";
    $polygon .= $area['polygonsVertLatLng'][$n_poly-1]['vertices'][0]['lat'];

    // Clossing string
    $polygon .= ") ) ";

    // Returns string
    return $polygon;
  }
  function getDataFilterFileType(){
    // Global variable: connection to the database
    global $conn;

    // Get all distinct file types
    $stm = $conn->prepare("
      SELECT DISTINCT file_type
      FROM            data
      ORDER BY file_type ASC
    ");
	  $stm->execute();

    // Return all distinct file types
    return $stm->fetchAll();
  }


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
    $results = verifyServiceClientUsername($client_username);
    if( $results < 0 )
      return $results + 0;
    $results   = getServiceClientInformation($client_username);
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
    $stm->execute(array($mission_id));
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
    $stm->execute(array($mission_id));
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
   * -11: inserting the new request was not possible;
   * -12: there aren't any service providers capable of satisfying the request;
   * -20: area doesn't obey the land or sea restriction;
   ****************************************************************************************************
   ****** PROCESSAREAGETSTRING
   ****************************************************************************************************
   ****** SELECTPOSSIBLESERVICEPROVIDERSTOAPPLYFORREQUEST
   ****************************************************************************************************
   * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
   * NOT MADE YET
   * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
   * Function to select automatically service providers when a new request is made by a client. It
   * should be noted that, for the specific request, this selection will never be updated again.
   ****************************************************************************************************/
  function newRequestForNewData($area, $client_username, $sensor_type, $resolution_value, $deadline, $comments, $restricted){
    // Global variable: connection to the database
    global $conn;

    // ----------------------------------------
    // Checks variable $client_username
    $results = verifyServiceClientUsername($client_username);
    if( $results < 0 )
      return $results + 0;
    $results   = getServiceClientInformation($client_username);
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
      $results = verifyDateTimeValidation($deadline);
      if( $results < 0 )
        return $result - 5;
    }

    // ----------------------------------------
    // Fomulation of string for area definition
    if($area == NULL)
      return -8;
    if($area['polygonsVertLatLng'][0]['numberVertices'] < 3)
      return -9;

    $polygon = processPolygonGetString($area);


    // ----------------------------------------
    // ----------------------------------------
    // PUT HERE OTHER ARGUMENTS VALIDATION
    // ----------------------------------------
    // ----------------------------------------
    // Check if area belongs to land or water.
    if( verifyLandOrSeaRestriction($area) == FALSE )
      return -20;

    // ----------------------------------------
    // ----------------------------------------


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
    if($deadline == NULL){
      $stm = $conn->prepare("
        INSERT INTO request (
          area_id           ,
          client_id         ,
          comments          ,
          sensor_type       ,
          resolution_type   ,
          agreement_provider,
          agreement_client  ,
          restricted
        )
        VALUES ( ? , ? , ? , ? , ? , ? , ? , ? )
        RETURNING id
      ");
      try{
        $stm->execute(array($area_id,
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
    }
    else {
      $deadline_day    = getDayFromDateTime($deadline);
      $deadline_month  = getMonthFromDateTime($deadline);
      $deadline_year   = getYearFromDateTime($deadline);

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
        VALUES ( TO_TIMESTAMP( ? , 'DD MM YYYY HH24' ) , ? , ? , ? , ? , ? , ? , ? , ? )
        RETURNING id
      ");
      try{
        $stm->execute(array("$deadline_day $deadline_month $deadline_year 20",
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
    }
    $results    = $stm->fetch();
    $request_id = $results['id'];


    // ----------------------------------------
    // ----------------------------------------
    // PUT HERE OTHER ARGUMENTS VALIDATION
    // ----------------------------------------
    // ----------------------------------------
    // Checks if service provider is present in table PROVIDER_REQUEST relative to the request in question
    $results = selectPossibleServiceProvidersToApplyForRequest($request_id, $area_id, $sensor_type, $resolution_value);
    if( $results < 0 ){
      // Eliminates the request already created
      $stm = $conn->prepare("
        DELETE FROM request
        WHERE  id = ?
      ");
      $stm->execute(array($request_id));

      // Eliminates the area already created
      $stm = $conn->prepare("
        DELETE FROM area
        WHERE  id = ?
      ");
      $stm->execute(array($area_id));

      // Returns errors
      return $results - 11;
    }
    // ----------------------------------------
    // ----------------------------------------

    // Returns 0 in case of success
    return 0;
  }
  function selectPossibleServiceProvidersToApplyForRequest($request_id, $area_id, $sensor_type, $resolution_value){
    // Global variable: connection to the database
    global $conn;

    // ----------------------------------------
    // Get DEPTH MIN and DEPTH MAX relative to request area
    $results = getMinMaxDepthAreaSelected($area_id);

    $value_min = floatval($results['depth_min']);
    $value_max = floatval($results['depth_max']);
	
	

    // ----------------------------------------
    // Get possible service providers capable of satisfying the request in question
    $stm = $conn->prepare("
      WITH filtersensorresolution AS (
        SELECT  service_provider.id              AS provider_id      ,
                service_provider.user_id         AS provider_username,
                service_provider.approval        AS user_approval    ,
                vehicle.vehicle_name             AS vehicle_name     ,
                vehicle.approval                 AS vehicle_approval ,
                sensor.sensor_name               AS sensor_name      ,
                sensor.sensor_type               AS sensor_type      ,
                sensor.active                    AS sensor_active    ,
                resolution.id                    AS resolution_id    ,
                resolution.value                 AS resolution_value ,
                resolution.active                AS resolution_active,
                specification.specification_type AS spec_type        ,
                specification.value_min          AS spec_min         ,
                specification.value_max          AS spec_max
        FROM service_provider
        FULL OUTER JOIN vehicle
          ON vehicle.service_provider_id = service_provider.id
        FULL OUTER JOIN sensor
          ON vehicle.id = sensor.vehicle_id
        FULL OUTER JOIN resolution
          ON resolution.sensor_id = sensor.id
        FULL OUTER JOIN specification
          ON specification.vehicle_id = vehicle.id
        WHERE service_provider.approval = true AND
              vehicle.approval          = true AND
              sensor.active             = true AND
              resolution.active         = true AND
              specification.active      = true AND
              sensor.sensor_type        =   ?  AND
              CAST(resolution.value AS double precision)         = CAST(? AS double precision) AND
              specification.specification_type = 'Depth'             AND
              CAST(specification.value_min AS double precision) <= CAST(? AS double precision) AND
              CAST(specification.value_max AS double precision) >= CAST(? AS double precision)
      )
      SELECT DISTINCT
        filtersensorresolution.provider_username,
        filtersensorresolution.provider_id
      FROM filtersensorresolution
    ");
    $stm->execute(array($sensor_type, strval($resolution_value), strval($value_min), strval($value_max)));
    $results = $stm->fetchAll();

    if( $results == FALSE ) // There isn't no Service Providers capable of executing that request
      return -1;

    // ----------------------------------------
    // Insert the combination provider_id & request_id in table provider_request
    // Notify all service providers capable of apply for specific request
    foreach ($results as $result){
      insertServiceProviderAndRequestInTableProviderRequest($result['provider_id'], $request_id);
      notifyProviderNewPossibleRequestToApply($result['provider_username'], $request_id);
    }

    // Returns 0 in case of success
    return 0;
  }
  function getMinMaxDepthAreaSelected($area_id){
    // Global variable: connection to the database
    global $conn;

    // Search intersections with depth_grid polygons
    $stm = $conn->prepare("
      WITH grid_intersections AS (
        SELECT
          ST_Intersects(
            depth_grid.grid_item :: geography,
            area.polygon         :: geography
          )                AS intersection_areas,
          depth_grid.depth AS depth_area
        FROM
          area, depth_grid
        WHERE
          area.id = ?              AND
          ST_Intersects(
            depth_grid.grid_item :: geography,
            area.polygon         :: geography
          )                        = 'TRUE'
      )
      SELECT
        MIN(depth_area) AS depth_min,
        MAX(depth_area) AS depth_max
      FROM  grid_intersections
    ");
    $stm->execute(array($area_id));

    // Return results
    return $stm->fetch();
  }
  function getMinMaxDepthAreaFromStructure($area){
    // Global variable: connection to the database
    global $conn;

    // Get string that defines a area
    $polygon = processPolygonGetString($area);

    // Get min and max depth
    $stm = $conn->prepare("
      WITH grid_intersections AS (
        SELECT
          ST_Intersects(
            depth_grid.grid_item :: geography,
            ?                    :: geography
          )                AS intersection_areas,
          depth_grid.depth AS depth_area
        FROM
          depth_grid
        WHERE
          ST_Intersects(
            depth_grid.grid_item :: geography,
            ?                    :: geography
          )                        = 'TRUE'
      )
      SELECT
        MIN(depth_area) AS depth_min,
        MAX(depth_area) AS depth_max
      FROM  grid_intersections
    ");
    $stm->execute(array($polygon,$polygon));

    // Return results
    return $stm->fetch();
  }
  function verifyLandOrSeaRestriction($area){
    // Global variable: connection to the database
    global $conn;

    // Setting up the polygon
    $polygon = processPolygonGetString($area);

    // Get number of land polygons
    $stm = $conn->prepare("
      SELECT  COUNT(land_poly) AS land_poly_count
      FROM    land
    ");
    $stm->execute();
    $result   = $stm->fetch();
    $LANDPOLY = $result['land_poly_count'];
    if( $LANDPOLY === 0 )
      return TRUE;                // Without any extra information, we assume area is OK

    // Get number of TRUE and FALSE intersections with land
    $sql_prepare = [];
    $stm = $conn->prepare("
      SELECT
        COUNT(
        ST_Intersects(
          ?         :: geography,
          land_poly :: geography
        ))                        AS true_count
      FROM land
      WHERE
        ST_Intersects(
          ?         :: geography,
          land_poly :: geography
        )                         = 'TRUE'
    ");
    array_push( $sql_prepare , $polygon );
    array_push( $sql_prepare , $polygon );
    $stm->execute($sql_prepare);
    $result        = $stm->fetch();
    $TRUEINTERSECT = $result['true_count'];

    // Returns TRUE OR FALSE
    if( $TRUEINTERSECT == 0 )
      return TRUE;                // Area is either on sea
    else
      return FALSE;               // Area is between land and sea
  }
  function notifyProviderNewPossibleRequestToApply($provider_username, $request_id){
    // Global variable: connection to the database
    global $conn;

    // Notification text
    $information = "New request ($request_id) available to apply";

    // Sends the notification for the service provider of a new valid request to apply
    $stm = $conn->prepare("
      INSERT INTO notification( date , information , acknowledged , user_id, request_id )
      VALUES ( CURRENT_TIMESTAMP(0) , ? , ? , ? , ? )
    ");
    try{
      $stm->execute(array($information,
                          'FALSE',
                          $provider_username,
                          $request_id
      ));
    } catch (PDOexception $e) {
      // Error creating the new notification
      return -1;
    }

    // Success creating the new notification
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
   * request_id       : integer representing the request's id;
   * est_starting_time: date in the following format -> 'DD/MM/AAAA'. This camp isn't always required
   *                    (just when the provider wants to specify an estimated start date for the
   *                    mission);
   * est_finished_time: date in the following format -> 'DD/MM/AAAA'. This camp isn't always required
   *                    (just when the provider wants to specify an estimated finish date for the
   *                    mission);
   * price            : cost determinated by service provider of the request proposal to submit;
   * provider_username: provider's username;
   * vehicle_name     : vehicle name that, in database, is an unique key for vehicle table;
   * sensor_name      : sensor name (NOT SENSOR TYPE NEITHER SENSOR ID);
   * resolution_value : resolution value (NOT RESOLUTION ID);
   * path_pdf         : path_pdf in the server for aditional informations.
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
   * -14: the resolution doesn't match with sensor specified;
   * -15: the resolution selected isn't active;
   * -16: inserting the new mission was not possible;
   * -17: relating the mission with the request was not possible;
   * -20: vehicle doesn't satisfies the depth requirements to execute the mission;
   * -21: service provider can't guarantee that mission will be concluded on time.
   *      (estimate finish time > finish time specified by service provider)
   ****************************************************************************************************
   ***** NOTIFYSERVICECLIENTNEWPROPOSALAVAILABLE
   ****************************************************************************************************/
  function createNewMission($request_id, $est_starting_time, $est_finished_time, $price, $provider_username, $vehicle_name, $sensor_name, $resolution_value, $path_pdf){
    // Global variable: connection to the database
    global $conn;

    // ----------------------------------------
    // Checks variable $provider_username
    $results = verifyServiceProviderUsername($provider_username);
    if( $results < 0 )
      return $results + 0;
    $results = getServiceProviderInformation($provider_username);
    $provider_id   = $results['provider_id'];
    $provider_name = $results['provider_name'];

    // ----------------------------------------
    // Checks variables $est_starting_time and $est_finished_time
    if($est_starting_time != NULL){
      $results = verifyDateTimeValidation($est_starting_time);
      if( $results < 0 )
        return $results - 3;
    }
    if($est_finished_time != NULL){
      $results = verifyDateTimeValidation($est_finished_time);
      if( $results < 0 )
        return $results - 3;
    }
    if(($est_starting_time != NULL) && ($est_finished_time != NULL)){
      $stm = $conn->prepare("
        SELECT TO_TIMESTAMP( ? , 'DD MM YYYY HH24' ) < TO_TIMESTAMP( ? , 'DD MM YYYY HH24' ) AS date_validation;
      ");
      $start_day    = getDayFromDateTime($est_starting_time);
      $start_month  = getMonthFromDateTime($est_starting_time);
      $start_year   = getYearFromDateTime($est_starting_time);
      $finish_day   = getDayFromDateTime($est_finished_time);
      $finish_month = getMonthFromDateTime($est_finished_time);
      $finish_year  = getYearFromDateTime($est_finished_time);
      $stm->execute(array("$start_day $start_month $start_year 20",
                          "$finish_day $finish_month $finish_year 20"
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

    $client_id               = $results['client_id'];
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
    $results = $stm->fetch();

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

    if( floatval($resolution_value_wanted) != floatval($resolution_value) )           // [resolution] = cm
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
    // ----------------------------------------
    // PUT HERE OTHER ARGUMENTS VALIDATION
    // ----------------------------------------
    // ----------------------------------------
    // Checks if service provider is present in table PROVIDER_REQUEST relative to the request in question
    if( verifyServiceProviderIsPresentInTableProviderRequest($provider_id, $request_id) == FALSE )
      return -16;

    // Its necessary to check if the vehicle still has the capability of executing the request
    // (for now, sensor_type and resolution_value has been checked )
    $results   = getMinMaxDepthAreaSelected($area_id);
    $depth_min = $results['depth_min'];
    $depth_max = $results['depth_max'];
    $stm = $conn->prepare("
      SELECT
        vehicle.id                       AS vehicle_id,
        vehicle.vehicle_name             AS vehicle_name,
        specification.specification_type AS spec_type   ,
        specification.value_min          AS value_min   ,
        specification.value_max          AS value_max
      FROM vehicle
      INNER JOIN specification
        ON specification.vehicle_id = vehicle.id
      WHERE
        specification.specification_type = 'Depth' AND
        vehicle.id                       = ?       AND
        CAST(specification.value_min AS double precision) <= CAST( ? AS double precision) AND
        CAST(specification.value_max AS double precision) >= CAST( ? AS double precision)
    ");
    $stm->execute(array($vehicle_id, strval($depth_min), strval($depth_max)));
    $results = $stm->fetch();
    if( $results == FALSE )
      return -20;

    // Estimates costs and evaluates if the estimated finished time is valid
    if($est_finished_time != NULL){
      if(verifyServiceProviderEstimatedFinishTime($area_id,
                                                  $est_starting_time, $est_finished_time,
                                                  $resolution_velocity, $resolution_swath) == FALSE)
        return -21;
    }

    // ----------------------------------------
    // ----------------------------------------


    // ----------------------------------------
    // Inserts into table mission a new entry
    $sql_prepare = [];
    $sql = "
      INSERT INTO mission (
        status,
    ";
    if($est_starting_time!=NULL)
      $sql .= " est_starting_time, ";
    if($est_finished_time!=NULL)
      $sql .= " est_finished_time, ";
    $sql .= "
        price,
        provider_id,
        resolution_id,
        area_id,
        path_pdf
      )
      VALUES (
        ? ,
    ";
    array_push($sql_prepare,'Proposal');
    if($est_starting_time!=NULL){
      $sql .= " TO_TIMESTAMP( ? , 'DD MM YYYY HH24' ) , ";
      array_push($sql_prepare,"$start_day  $start_month  $start_year  20");
    }
    if($est_finished_time!=NULL){
      $sql .= " TO_TIMESTAMP( ? , 'DD MM YYYY HH24' ) , ";
      array_push($sql_prepare,"$finish_day $finish_month $finish_year 20");
    }
    $sql .= " ? , ? , ? , ? , ? ) RETURNING id";
    array_push($sql_prepare,$price);
    array_push($sql_prepare,$provider_id);
    array_push($sql_prepare,$resolution_id);
    array_push($sql_prepare,$area_id);
    array_push($sql_prepare,$path_pdf);

    $stm = $conn->prepare($sql);
    try{
      $stm->execute($sql_prepare);
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
    $stm = $conn->prepare("
      SELECT  *
      FROM    service_client
      WHERE   id = ?
    ");
    $stm->execute(array($client_id));
    $results         = $stm->fetch();
    $client_username = $results['user_id'];
    notifyServiceClientNewProposalAvailable($client_username, $provider_name, $provider_username, $request_id, $mission_id);

    // Returns 0 in case of success
    return $mission_id;
  }
  function notifyServiceClientNewProposalAvailable($client_username, $provider_name, $provider_username, $request_id, $mission_id){
    // Global variable: connection to the database
    global $conn;

    // Notification text
    $notification_info = "Service Provider $provider_name ($provider_username) made a new proposal (mission id: $mission_id) for your request (request id: $request_id)";

    // Send to service client that a new proposal is available
    $stm = $conn->prepare("
      INSERT INTO notification( date , information , acknowledged , user_id , mission_id , request_id )
      VALUES ( CURRENT_TIMESTAMP(0) , ? , ? , ? , ? , ? )
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
      $string = $e->getMessage();
    }

    // Success creating the new notification
    return 0;
  }
  function verifyServiceProviderEstimatedFinishTime($area_id,
                                                    $est_starting_time, $est_finished_time,
                                                    $resolution_velocity, $resolution_swath){
    // Global variable: connection to the database
    global $conn;

    // Get area value
    $stm = $conn->prepare("
      SELECT  ST_Area(polygon::geography, true) AS area_metersquare
      FROM    area
      WHERE   id = ?
    ");
    $stm->execute(array($area_id));
    $results = $stm->fetch();
    $area     = floatval($results['area_metersquare']); //m^2
    $swath    = floatval($resolution_swath);            //m
    $velocity = floatval($resolution_velocity);         //m/2

    // ALGORITHM
    $total_distance = ceil( sqrt( $area ) / $swath) * sqrt( $area )
                    + (ceil(sqrt( $area ) / $swath) - 1) * $swath;
    $estimated_duration = ( $total_distance / $velocity ) * ( 1/3600 );

    // Verifies if it's okay
    if($est_starting_time != NULL){
      // Convert DD/MM/YYYY to numbers
      $start_day    = getDayFromDateTime($est_starting_time);
      $start_month  = getMonthFromDateTime($est_starting_time);
      $start_year   = getYearFromDateTime($est_starting_time);
      $finish_day   = getDayFromDateTime($est_finished_time);
      $finish_month = getMonthFromDateTime($est_finished_time);
      $finish_year  = getYearFromDateTime($est_finished_time);

      $stm = $conn->prepare("
        SELECT
          TO_TIMESTAMP( ? , 'DD MM YYYY HH24' )
          >
          TO_TIMESTAMP( ? , 'DD MM YYYY HH24' ) + INTERVAL '1 hour' * CAST( ? AS double precision)
          AS validation
      ");
      $stm->execute(array("$finish_day $finish_month $finish_year 20",
                          "$start_day  $start_month  $start_year  20",
                          strval($estimated_duration)
      ));
    }
    else{
      // Convert DD/MM/YYYY to numbers
      $finish_day   = getDayFromDateTime($est_finished_time);
      $finish_month = getMonthFromDateTime($est_finished_time);
      $finish_year  = getYearFromDateTime($est_finished_time);

      $stm = $conn->prepare("
        SELECT
          ?
          >
          CURRENT_TIMESTAMP(0) + INTERVAL '1 hour' *DOUBLE PRECISION CAST( ? AS double precision)
          AS validation
      ");
      $stm->execute(array("$finish_day $finish_month $finish_year 20",
                          strval($estimated_duration)
      ));
    }

    $results = $stm->fetch();
    if($results['validation'] == TRUE )
      return TRUE;
    else{
      $_SESSION['error_messages'][] = "Estimated Mission Duration: " . ceil($estimated_duration) . " hours";
      return FALSE;
    }
  }

  /****************************************************************************************************
   ****** UPDATEMISSIONSTATUS
   ****************************************************************************************************
   * Function to update the mission status.
   *
   * INPUT ARGUMENTS:
   * request_id    : integer representing the request id. This request is relative to the mission that
   *                 is being executed;
   * mission_id    : integer representing the mission id;
   * mission_status: string that represents the mission current status. The status posible are the
   *                 following ones:
   *                 - 'Proposal' - there is no need to update the status mission (it is its default
   *                                status)
   *                 - 'Refused'
   *                 - 'Waiting Agreement'
   *                 - 'In progress'
   *                 - 'Expired'
   *                 - 'Finish'
   *
   * OUTPUT ARGUMENTS:
   *  1: operation executed successfully;
   *  0: insuccess in updating executing the mission;
   * -1: status not valid.
   ****************************************************************************************************/
  function updateMissionStatus($mission_id, $mission_status){
    // Global variable: connection to the database
    global $conn;

    // Updating status
    switch ($variable) {
      case 'Refused':
        $stm = $conn->prepare("
          UPDATE  mission
          SET   status = ?
          WHERE id     = ?
        ");
        $stm->execute(array($mission_status,$mission_id));
      break;

      case 'Waiting Agreement':
        $stm = $conn->prepare("
          UPDATE  mission
          SET   status = ?
          WHERE id     = ?
        ");
        $stm->execute(array($mission_status,$mission_id));
      break;

      case 'In progress':
        $stm = $conn->prepare("
          UPDATE  mission
          SET   starting_time = CURRENT_TIMESTAMP(0),
                status        = ?
          WHERE id     = ?
        ");
        $stm->execute(array($mission_status,$mission_id));
      break;

      case 'Expired':
        $stm = $conn->prepare("
          UPDATE  mission
          SET   status = ?
          WHERE id     = ?
        ");
        $stm->execute(array($mission_status,$mission_id));
      break;

      case 'Finish':
        $stm = $conn->prepare("
          UPDATE  mission
          SET   finished_time = CURRENT_TIMESTAMP(0),
                status        = ?
          WHERE id     = ?
        ");
        $stm->execute(array($mission_status,$mission_id));
      break;

      default:
        return -1;
    }

    // Notify Service Client and Service Provider
    notifyServiceClientMissionStatus($mission_id, $mission_status);
    notifyServiceProviderMissionStatus($mission_id, $mission_status);

    // Return 0 or 1
    return $stm->rowCount();
  }
  function notifyServiceClientMissionStatus($mission_id, $mission_status){
    // Global variable: connection to the database
    global $conn;

    // Get service client information
    $stm = $conn->prepare("
      SELECT  mission.id                 AS mission_id,
              request.id                 AS request_id,
              request.sensor_type        AS request_sensor_type,
              request.resolution_type    AS request_res_value,
              service_client.id          AS client_id,
              service_client.client_name AS client_name,
              service_client.user_id     AS client_username
      FROM  mission
      INNER JOIN request_mission
        ON  request_mission.mission_id = mission.id
      INNER JOIN request
        ON  request.id = request_mission.request_id
      INNER JOIN service_client
        ON  service_client.id = request.id
      WHERE request.sensor_type     IS NOT NULL AND
            request.resolution_type IS NOT NULL AND
            mission.id   =   ?
    ");
    $stm->execute(array($mission_id));
    $results_1 = $stm->fetch();

    // Get service provider information
    $stm = $conn->prepare("
      SELECT  mission.id                   AS mission_id,
              service_provider.id          AS provider_id,
              service_provider.entity_name AS provider_name,
              service_provider.user_id     AS provider_username
      FROM  mission
      INNER JOIN service_provider
        ON  service_provider.id = mission.provider_id
      WHERE mission.id = ?
    ");
    $stm->execute(array($mission_id));
    $results_2 = $stm->fetch();

    $request_id        = $results_1['request_id'];
    $client_name       = $results_1['client_name'];
    $client_username   = $results_1['client_username'];
    $provider_name     = $results_2['provider_name'];
    $provider_username = $results_2['provider_username'];

    // Send Service Client Notification
    $notification_info = "Mission status (mission id: $mission_id) executed by $provider_name ($provider_username) from request $request_id changed: $mission_status";

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
  function notifyServiceProviderMissionStatus($mission_id, $mission_status){
    // Global variable: connection to the database
    global $conn;

    // Get service client information
    $stm = $conn->prepare("
      SELECT  mission.id                 AS mission_id,
              request.id                 AS request_id,
              request.sensor_type        AS request_sensor_type,
              request.resolution_type    AS request_res_value,
              service_client.id          AS client_id,
              service_client.client_name AS client_name,
              service_client.user_id     AS client_username
      FROM  mission
      INNER JOIN request_mission
        ON  request_mission.mission_id = mission.id
      INNER JOIN request
        ON  request.id = request_mission.request_id
      INNER JOIN service_client
        ON  service_client.id = request.id
      WHERE request.sensor_type     IS NOT NULL AND
            request.resolution_type IS NOT NULL AND
            mission.id   =   ?
    ");
    $stm->execute(array($mission_id));
    $results_1 = $stm->fetch();

    // Get service provider information
    $stm = $conn->prepare("
      SELECT  mission.id                   AS mission_id,
              service_provider.id          AS provider_id,
              service_provider.entity_name AS provider_name,
              service_provider.user_id     AS provider_username
      FROM  mission
      INNER JOIN service_provider
        ON  service_provider.id = mission.provider_id
      WHERE mission.id = ?
    ");
    $stm->execute(array($mission_id));
    $results_2 = $stm->fetch();

    $request_id        = $results_1['request_id'];
    $client_name       = $results_1['client_name'];
    $client_username   = $results_1['client_username'];
    $provider_name     = $results_2['provider_name'];
    $provider_username = $results_2['provider_username'];

    // Send Service provider Notification
    $notification_info = "Mission status (mission id: $mission_id) from request $request_id made by $client_name ($client_username) changed: $mission_status";

    $stm = $conn->prepare("
      INSERT INTO notification( date , information , acknowledged , user_id , mission_id , request_id )
      VALUES ( CURRENT_TIMESTAMP(0) , ? , ? , ? , ? )
    ");
    try{
      $stm->execute(array($notification_info,
                          'FALSE',
                          $provider_username,
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

  /****************************************************************************************************
   ****** UPDATEAGREEMENTPAYMENT
   ****************************************************************************************************
   * Function that updates the boolean variables present in request table. These means that either
   * sides (client and provider) confirms their stand relative to payment agreement.
   *
   * INPUT ARGUMENTS:
   * request_id        : integer that represents request id OR NULL if not specified;
   * mission_id        : integer that represents request id OR NULL if not specified;
   * agreement_client  : boolean variable true/false OR NULL if not specified (if null => do not alter);
   * agreement_provider: boolean variable true/false OR NULL if not specified (if null => do not alter).
   *
   * OUTPUT ARGUMENTS:
   * 1: operation executed successfully;
   * 0: insuccess in updating executing the agreement variables.
   *
   * NOTES:
   * - the $request_id and $mission_id can't ve simultaneously NULL;
   * - specificy the boolean variables NULL if you don't want to alter them;
   * - we can't alter the client and provider agreement at the same time!!!
   *   (... T/F,NULL OR ... NULL,T/F).
   ****************************************************************************************************/
  function updateAgreementPayment($request_id, $mission_id, $agreement_client, $agreement_provider){
    // Global variable: connection to the database
    global $conn;

    // Get mission_id or request_id
    if( $mission_id != NULL ) {
      $stm = $conn->prepare("
        SELECT  request.id AS request_id,
                mission.id AS mission_id
        FROM  mission
        INNER JOIN request_mission
          ON  request_mission.mission_id = mission.id
        INNER JOIN request
          ON  request.id = request_mission.request_id
        WHERE mission.status <> 'Proposal' AND
              mission.status <> 'Refused'  AND
              mission.status <> 'Expired'  AND
              mission.status <> 'Finish'   AND
              mission.status <> 'In progress'    AND
              request.sensor_type     IS NOT NULL AND
              request.resolution_type IS NOT NULL AND
              mission.id   =   ?
      ");
      $stm->execute(array($mission_id));
      $result     = $stm->fetch();
      $mission_id = $result['mission_id'];
      $request_id = $result['request_id'];
    }
    else if( ($mission_id == NULL) && ($request_id != NULL) ) {
      $stm = $conn->prepare("
        SELECT  request.id AS request_id,
                mission.id AS mission_id
        FROM  request
        INNER JOIN request_mission
          ON  request_mission.request_id = request.id
        INNER JOIN mission
          ON  mission.id = request_mission.mission_id
        WHERE mission.status <> 'Proposal' AND
              mission.status <> 'Refused'  AND
              mission.status <> 'Expired'  AND
              mission.status <> 'Finish'   AND
              mission.status <> 'In progress'    AND
              request.sensor_type     IS NOT NULL AND
              request.resolution_type IS NOT NULL AND
              request.id   =   ?
      ");
      $stm->execute(array($mission_id));
      $result     = $stm->fetch();
      $mission_id = $result['mission_id'];
      $request_id = $result['request_id'];
    }
    else {
      return 0;
    }

    // Updates agreements
    if( ($agreement_client != NULL) && ($agreement_provider != NULL) )
      return 0;
    else if ($agreement_client != NULL) {
      $stm = $conn->prepare("
        UPDATE request
        SET    agreement_client = ?
        WHERE  id = ?
      ");
      $stm->execute(array($agreement_client? 'TRUE':'FALSE',$request_id));

      // Notify Service Provider
      notifyServiceProviderOfServiceClientAgreementStatus($mission_id, $agreement_client);
    }
    else if ($agreement_provider != NULL) {
      $stm = $conn->prepare("
        UPDATE request
        SET    agreement_provider = ?
        WHERE  id = ?
      ");
      $stm->execute(array($agreement_provider? 'TRUE':'FALSE',$request_id));

      // Notify Service Client
      notifyServiceClientOfServiceProviderAgreementStatus($mission_id, $agreement_provider);
    }
    else
      return 0;

    // Returns 1 in case of success
    return $stm->rowCount();
  }
  function notifyServiceClientOfServiceProviderAgreementStatus($mission_id, $agreement_status){
    // Global variable: connection to the database
    global $conn;

    // Get service client information
    $stm = $conn->prepare("
      SELECT  mission.id                 AS mission_id,
              request.id                 AS request_id,
              request.sensor_type        AS request_sensor_type,
              request.resolution_type    AS request_res_value,
              service_client.id          AS client_id,
              service_client.client_name AS client_name,
              service_client.user_id     AS client_username
      FROM  mission
      INNER JOIN request_mission
        ON  request_mission.mission_id = mission.id
      INNER JOIN request
        ON  request.id = request_mission.request_id
      INNER JOIN service_client
        ON  service_client.id = request.id
      WHERE request.sensor_type     IS NOT NULL AND
            request.resolution_type IS NOT NULL AND
            mission.id   =   ?
    ");
    $stm->execute(array($mission_id));
    $results_1 = $stm->fetch();

    // Get service provider information
    $stm = $conn->prepare("
      SELECT  mission.id                   AS mission_id,
              service_provider.id          AS provider_id,
              service_provider.entity_name AS provider_name,
              service_provider.user_id     AS provider_username
      FROM  mission
      INNER JOIN service_provider
        ON  service_provider.id = mission.provider_id
      WHERE mission.id = ?
    ");
    $stm->execute(array($mission_id));
    $results_2 = $stm->fetch();

    $request_id        = $results_1['request_id'];
    $client_name       = $results_1['client_name'];
    $client_username   = $results_1['client_username'];
    $provider_name     = $results_2['provider_name'];
    $provider_username = $results_2['provider_username'];

    // Send Service Client Notification
    $AGGSTATUS = $agreement_status ? 'YES' : 'NO';
    $notification_info = "$provider_name ($provider_username) has changed his agreement status relative to request $request_id: $AGGSTATUS";

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
  function notifyServiceProviderOfServiceClientAgreementStatus($mission_id, $agreement_status){
    // Global variable: connection to the database
    global $conn;

    // Get service client information
    $stm = $conn->prepare("
      SELECT  mission.id                 AS mission_id,
              request.id                 AS request_id,
              request.sensor_type        AS request_sensor_type,
              request.resolution_type    AS request_res_value,
              service_client.id          AS client_id,
              service_client.client_name AS client_name,
              service_client.user_id     AS client_username
      FROM  mission
      INNER JOIN request_mission
        ON  request_mission.mission_id = mission.id
      INNER JOIN request
        ON  request.id = request_mission.request_id
      INNER JOIN service_client
        ON  service_client.id = request.id
      WHERE request.sensor_type     IS NOT NULL AND
            request.resolution_type IS NOT NULL AND
            mission.id   =   ?
    ");
    $stm->execute(array($mission_id));
    $results_1 = $stm->fetch();

    // Get service provider information
    $stm = $conn->prepare("
      SELECT  mission.id                   AS mission_id,
              service_provider.id          AS provider_id,
              service_provider.entity_name AS provider_name,
              service_provider.user_id     AS provider_username
      FROM  mission
      INNER JOIN service_provider
        ON  service_provider.id = mission.provider_id
      WHERE mission.id = ?
    ");
    $stm->execute(array($mission_id));
    $results_2 = $stm->fetch();

    $request_id        = $results_1['request_id'];
    $client_name       = $results_1['client_name'];
    $client_username   = $results_1['client_username'];
    $provider_name     = $results_2['provider_name'];
    $provider_username = $results_2['provider_username'];

    // Send Service Provider Notification
    $AGGSTATUS = $agreement_status ? 'YES' : 'NO';
    $notification_info = "$client_name ($client_username) has changed his agreement status relative to request $request_id: $AGGSTATUS";

    $stm = $conn->prepare("
      INSERT INTO notification( date , information , acknowledged , user_id , mission_id , request_id )
      VALUES ( CURRENT_TIMESTAMP(0) , ? , ? , ? , ? )
    ");
    try{
      $stm->execute(array($notification_info,
                          'FALSE',
                          $provider_username,
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


  /****************************************************************************************************
   ****** VERIFYSERVICECLIENTUSERNAME
   ****************************************************************************************************
   * INPUT ARGUMENTS:
   * client_username
   *
   * OUTPUT ARGUMENTS:
   *  0: service client ok;
   * -1: the user is not registed in the platform or it isn't a service client;
   * -2: the client isn't an Active user.
   ****************************************************************************************************
   ****** GETSERVICECLIENTINFORMATION
   ****************************************************************************************************/
  function verifyServiceClientUsername($client_username){
    // Global variable: connection to the database
    global $conn;

    // Verifies the client info
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
    $stm->execute(array($client_username));
    $results = $stm->fetch();

    // Error returning
    if($results == FALSE)
      return -1;
    if($results['status'] != 'Active')
      return -2;

      // Returns 0 if Service Client is OK
      return 0;
  }
  function getServiceClientInformation($client_username){
    // Global variable: connection to the database
    global $conn;

    // Gets the client info
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
    $stm->execute(array($client_username));

    // Returns Service Client information
    return $stm->fetch();
  }

  /****************************************************************************************************
   ****** VERIFYSERVICEPROVIDERUSERNAME
   ****************************************************************************************************
   * INPUT ARGUMENTS:
   * provider_username
   *
   * OUTPUT ARGUMENTS:
   *  0: service provider ok;
   * -1: the user is not registed in the platform or it isn't a service provider;
   * -2: the provider isn't an Active user;
   * -3: the service provider has yet to be approved by administration.
   ****************************************************************************************************
   ****** GETSERVICEPROVIDERINFORMATION
   ****************************************************************************************************/
  function verifyServiceProviderUsername($provider_username){
    // Global variable: connection to the database
    global $conn;

    // Verifies the provider info
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
    $stm->execute(array($provider_username));
    $results = $stm->fetch();

    // Error returning
    if($results == FALSE)
      return -1;
    if($results['status'] != 'Active')
      return -2;
    if($results['provider_approval'] == FALSE )
      return -3;

    // Returns 0 if Service Provider is OK
    return 0;
  }
  function getServiceProviderInformation($provider_username){
    // Global variable: connection to the database
    global $conn;

    // Gets the provider info
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
    $stm->execute(array($provider_username));

    // Returns Service Provider information
    return $stm->fetch();
  }

  /****************************************************************************************************
   ****** VERIFYDATETIMEVALIDATION
   ****************************************************************************************************
   * INPUT ARGUMENTS:
   * date_time: string in the following format 'DD MM YYYY'
   *
   * OUTPUT ARGUMENTS:
   *  0: date_time ok;
   * -1: date format isn't valid. The correct one is 'DD/MM/AAAA';
   * -2: date after today;
   ****************************************************************************************************/
  function verifyDateTimeValidation($date_time){
    // Global variable: connection to the database
    global $conn;

    // Checks date_time format
    $date_time_array = explode( '-' , $date_time , 3 );
    if( count($date_time_array) != 3 )  // Date isn't in right format
      return -1;
    // -> day
    $day   = $date_time_array[2];
    // -> month
    $month = $date_time_array[1];
    // -> year
    $year  = $date_time_array[0];

    // Check values validation
    if( (intval($day) <= 0) || (intval($month) <= 0) || (intval($year) <= 0) )
      return -1;
    if( (intval($day) < 1) || (intval($day) > 31) )
      return -1;
    if( (intval($month) < 1) || (intval($month) > 12) )
      return -1;
    if( (intval($year) < 1) )
      return -1;

    $stm = $conn->prepare("
      SELECT CURRENT_TIMESTAMP < TO_TIMESTAMP( ? , 'DD MM YYYY HH24' ) AS date_validation;
    ");
    $stm->execute(array( "$day $month $year 20" ));
    $results = $stm->fetch();
    if( $results['date_validation'] == FALSE )
      return -2;

    // Returns 0 if date_time is OK
    return 0;
  }
  function getDayFromDateTime($date_time){
    // Global variable: connection to the database
    global $conn;

    // String formating
    $date_time_array = explode( '-' , $date_time , 3 );
    // -> day
    return $date_time_array[2];
  }
  function getMonthFromDateTime($date_time){
    // Global variable: connection to the database
    global $conn;

    // String formating
    $date_time_array = explode( '-' , $date_time , 3 );
    // -> month
    return $date_time_array[1];
  }
  function getYearFromDateTime($date_time){
    // Global variable: connection to the database
    global $conn;

    // String formating
    $date_time_array = explode( '-' , $date_time , 3 );
    // -> year
    return $date_time_array[0];
  }

  /****************************************************************************************************
   ****** VERIFYSERVICEPROVIDERISPRESENTINTABLEPROVIDERREQUEST
   ****************************************************************************************************
   * This function verifies if, in the moment of request creation the service provider was capable of
   * executing the request.
   *
   * INPUT ARGUMENTS:
   * provider_id: integer representing provider's id;
   * request_id : integer representing request's id.
   *
   * OUTPUT ARGUMENTS (boolean):
   * TRUE : the combination provider_id @ $request_id is present in table provider_request;
   * FALSE: it's not present.
   ****************************************************************************************************
   ****** DELETESERVICEPROVIDERANDREQUESTFROMTABLEPROVIDERREQUEST
   ****************************************************************************************************
   * Function to delete the combination of provider_id with request_id from table provider_request.
   *
   * INPUT ARGUMENTS:
   * provider_id: integer representing provider's id;
   * request_id : integer representing request's id.
   *
   * OUTPUT ARGUMENTS:
   * 1: operation executed with success;
   * 0: the combination provider_id @ $request_id was not present in table provider_request.
   ****************************************************************************************************
   ****** INSERTSERVICEPROVIDERANDREQUESTINTABLEPROVIDERREQUEST
   ****************************************************************************************************/
  function verifyServiceProviderIsPresentInTableProviderRequest($provider_id, $request_id){
    // Global variable: connection to the database
    global $conn;

    // Search for combination $provider_id @ $request_id
    $stm = $conn->prepare("
      SELECT  *
      FROM  provider_request
      WHERE provider_id = ? AND
            request_id  = ?
    ");
    $stm->execute(array($provider_id, $request_id));

    // Return TRUE / FALSE
    return ($stm->fetch() == TRUE);
  }
  function deleteServiceProviderAndRequestFromTableProviderRequest($provider_id, $request_id){
    // Global variable: connection to the database
    global $conn;

    // Deletes from table
    $stm = $conn->prepare("
      DELETE FROM provider_request
      WHERE provider_id = ? AND
            request_id  = ?
    ");
    $stm->execute(array($provider_id, $request_id));

    // Returns affeted rows by delete
    return $stm->rowCount();
  }
  function insertServiceProviderAndRequestInTableProviderRequest($provider_id, $request_id){
    // Global variable: connection to the database
    global $conn;

    // Inserts in table
    $stm = $conn->prepare("
      INSERT INTO provider_request (provider_id, request_id)
      VALUES ( ? , ? )
    ");
    try{
      $stm->execute(array($provider_id, $request_id));
    } catch(PDOexception $e) {
      return -1;
    }

    // Returns 0 in case of success
    return 0;
  }
?>
