/***********************************************************************************************
 ***** GLOBAL VARIABLES allAreas
 ***********************************************************************************************/
var allAreas = {
  polygonsVertLatLng: [],
  numberPolygons:     0,
  circlesCenterRad:   [],
  numberCircles:      0
};



function post(path, params, method='post') {

//esta função dava para ser mais pequena mas ela explode misteriosamente quando a tento encortar
//o ajax post nao dava visto que implicava ou request assincronos ou uma pagina que estivesse permanentemente a actulizar 
//mais tarde fasso uma para o get
  const form = document.createElement('form');
  form.method = method;
  form.action = path;

  for (const key in params) {
    if (params.hasOwnProperty(key)) {
      const hiddenField = document.createElement('input');
      hiddenField.type = 'hidden';
      hiddenField.name = key;
      hiddenField.value = params[key];

      form.appendChild(hiddenField);
    }
  }

  document.body.appendChild(form);
  form.submit();
}


function getinicialdata(path) {
	$.ajax({
					method: 'POST',
					url: path,
					data:{iarea:0},
					success: function(data){
					console.log(data);
						if (data!="0") {
							var parse=JSON.parse(data.substr(0));
							console.log(parse);
							//alert(parse["polygonsVertLatLng"]["0"]["vertices"].values());
							var numberpoly=parse["numberPolygons"]-1;
							var vertices= parse["polygonsVertLatLng"][numberpoly]["vertices"];
							console.log(vertices);
							var arry = [];
							for (var i = 0; i < parse["polygonsVertLatLng"][numberpoly]["numberVertices"]; i++) {
								  arry.push(Object.values(vertices[i]));
								   // more statements
								}
								console.log(arry);
							 var initpolygon = L.polygon([
								arry
							]).addTo(map);
						}	
						else{
							//alert(data);
						}
											
					},
					error: function(xhr, desc, err){
						console.log(err);
					}
				});
}

function getsurveydata(path) {
	$.ajax({
					method: 'POST',
					url: path,
					data:{iarea:0},
					success: function(data){
					console.log(data);
						if (data!="0") {
							var parse=(data.substr(0));
							var area_t=parse.split(/POLYGON/);
							var t = []; 
							var clean =[];
							for (var i = 0; i < area_t.length; i++) {
								  t.push(area_t[i].split(/\,/));
							}
							t.shift();
							console.log(t);
							for (var i = 0; i < t.length; i++) {
								clean[i]=[];
								for (var j = 0; j < t[i].length; j++) {
								clean[i].push(t[i][j].split(" "));
								//console.log(clean[i]);
								//clean[i][j].shift();
								//clean[i][j].pop();
								for (var z = 0; z < clean[i][j].length; z++) {
								clean[i][j][z]=clean[i][j][z].replace(/[|&;$%@"<>()+,]/g,"");
							}
							
							}
							}
							console.log(clean[0]);
							for (var i = 0; i < clean.length; i++) {
									for(var j = 0; j < clean[i].length; j++){
											for(var z = 0; z < clean[i][j].length; z++){
											clean[i][j][z]=parseFloat(clean[i][j][z]);
											}
											clean[i][j]=clean[i][j].reverse();
									}
							}
							for (var i = 0; i < clean.length-1; i++) {
								clean[i].pop();
							}
							console.log(clean);
						
							for (var i = 0; i < clean.length; i++) {
							var initpolygon = L.polygon([
								clean[i]
							], {color:'green'}).addTo(map).disableEdit();
							}
							
						}	
						else{
							alert(data);
						}
											
					},
					error: function(xhr, desc, err){
						console.log(err);
					}
				});
}



/***********************************************************************************************
 ***** MAPCONFIGURATION(  )
 ***********************************************************************************************
 * INITIAL CONFIGURATION FOR THE MAP - initial configuration of the map itself that sets, for
 *   example, the initial point to center and at witch volume.
 * MENU ADDING TO THE MAP OBJECTS ( other layers ) - menu that accomodates all the options that
 *   a user can choose and interact with the map in different ways.
 * EVENTS CONTROL FOR SHORTCUTS - here the code developed is concentrated in shortcuts or ways
 *   to facilitate the users interaction with the web platform.
 ***********************************************************************************************/
function mapConfiguration() {
  // ---------------------------------------------------------------------------
  // -------------------- INITIAL CONFIGURATION FOR THE MAP --------------------
  // Starting point for the map AND set zoom between 0 and 18
  var startPoint = [41.1780053,-8.5987102], zoom = 9;

  // Creating map and associate the Open Street Layer to the map
  window.map = window.L.map('mapid', {editable: true}).setView(startPoint, zoom);
  window.L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    maxZoom: 18,
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
      '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
      'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    id: 'mapbox/streets-v11'
  }).addTo(window.map);


  // -----------------------------------------------------------------------------------------
  // -------------------- MENU ADDING TO THE MAP OBJECTS ( other layers ) --------------------
  // Display controls in the map
  window.L.EditControl = window.L.Control.extend({
    options: {
        position: 'topleft',
        callback: null,
        kind: '',
        html: ''
    },
    onAdd: function (map) {
        var container = L.DomUtil.create('div', 'leaflet-control leaflet-bar'),
            link = L.DomUtil.create('a', '', container);

        link.href = '#';
        link.title = 'Create a new ' + this.options.kind;
        link.innerHTML = this.options.html;
        L.DomEvent.on(link, 'click', L.DomEvent.stop)
                  .on(link, 'click', function () {
                    window.LAYER = this.options.callback.call(map.editTools);
                  }, this);

        return container;
    }
  });

  // Creating new controls for the menu
  var controlPath = false, 
      controlRect = true,
      controlCirc = false,
      controlMark = false,
      controlPoly = true,
      controlDelA = true,
      controlGetA = true;

  // Control Menu: draw a path with multiple points in the map (CREATING LINES)
  if( controlPath ) {
    window.L.NewLineControl = window.L.EditControl.extend({
      options: {
        position: 'topleft'
      },
      onAdd: function (map) {
        var container = L.DomUtil.create('div', 'leaflet-control leaflet-bar'),
            link = L.DomUtil.create('a', '', container);

        link.href = '#';
        link.title = 'Create a new line';
        link.innerHTML = '\\/\\';
        L.DomEvent.on(link, 'click', L.DomEvent.stop)
                  .on(link, 'click', function () {
                    // Method associated with the clicking event in icon
                    window.map.editTools.startPolyline();
                  });

        return container;
      }
    });
  }

  // Control Menu: erase all layers / objects drwan in the map (ERASE ALL LAYERS)
  if( controlDelA ) {
    window.L.NewEraseAllControl = window.L.Control.extend({
      options: {
        position: 'topleft'
      },
      onAdd: function (map) {
        var container = L.DomUtil.create('div', 'leaflet-control leaflet-bar'),
            link = L.DomUtil.create('a', '', container);

        link.href = '#';
        link.title = 'Erase all layers';
        link.innerHTML = 'DEL';
        L.DomEvent.on(link, 'click', L.DomEvent.stop)
                  .on(link, 'click', function () {
                    // Method associated with the clicking event in icon
                    window.clearMap(map);
                  });

        return container;
      }
    });
  }

  // Control Menu: draw a polygon with variable number of vertices in the map (CREATING POLYGONS)
  if( controlPoly ) {
    window.L.NewPolygonControl = window.L.Control.extend({
      options: {
        position: 'topleft'
      },
      onAdd: function (map) {
        var container = L.DomUtil.create('div', 'leaflet-control leaflet-bar'),
            link = L.DomUtil.create('a', '', container);

        link.href = '#';
        link.title = 'Create a new polygon';
        link.innerHTML = '▰';
        L.DomEvent.on(link, 'click', L.DomEvent.stop)
                  .on(link, 'click', function () {
                    // Method associated with the clicking event in icon
                    window.map.editTools.startPolygon();
                  });

        return container;
      }
    });
  }

  // Control Menu: put a marker in a specific coordinate in the map (CREATING MARKERS)
  if( controlMark ) {
    window.L.NewMarkerControl = window.L.EditControl.extend({
      options: {
        position: 'topleft'
      },
      onAdd: function (map) {
        var container = L.DomUtil.create('div', 'leaflet-control leaflet-bar'),
            link = L.DomUtil.create('a', '', container);

        link.href = '#';
        link.title = 'Create a new marker';
        link.innerHTML = '🖈';
        L.DomEvent.on(link, 'click', L.DomEvent.stop)
                  .on(link, 'click', function () {
                    // Method associated with the clicking event in icon
                    window.map.editTools.startMarker();
                  });

        return container;
      }
    });
  }

  // Control Menu: draw a rectangle in the map (CREATING RECTANGLES)
  if( controlRect ) {
    window.L.NewRectangleControl = window.L.EditControl.extend({
      options: {
        position: 'topleft'
      },
      onAdd: function (map) {
        var container = L.DomUtil.create('div', 'leaflet-control leaflet-bar'),
            link = L.DomUtil.create('a', '', container);

        link.href = '#';
        link.title = 'Create a new rectangle';
        link.innerHTML = '⬛';
        L.DomEvent.on(link, 'click', L.DomEvent.stop)
                  .on(link, 'click', function () {
                    // Method associated with the clicking event in icon
                    window.map.editTools.startRectangle();
                  });

        return container;
      }
    });
    
  }

  // Control Menu: draw a circle in the map (CREATING CIRCLES)
  if( controlCirc ) {
    window.L.NewCircleControl = window.L.EditControl.extend({
      options: {
        position: 'topleft'
      },
      onAdd: function (map) {
        var container = L.DomUtil.create('div', 'leaflet-control leaflet-bar'),
            link = L.DomUtil.create('a', '', container);

        link.href = '#';
        link.title = 'Create a new circle';
        link.innerHTML = '⬤';
        L.DomEvent.on(link, 'click', L.DomEvent.stop)
                  .on(link, 'click', function () {
                    // Method associated with the clicking event in icon
                    window.map.editTools.startCircle();
                  });

        return container;
      }
    });
  }

  // Control Menu: get all areas / objects present in the map (GET ALL AREAS INFORMATIONS)
  if( controlGetA ) {
    window.L.NewGetAllAreasInfo = window.L.Control.extend({
      options: {
        position: 'topleft'
      },
      onAdd: function (map) {
        var container = L.DomUtil.create('div', 'leaflet-control leaflet-bar'),
          link = L.DomUtil.create('a', '', container);
  
        link.href = '#';
        link.title = 'Get informations of all areas';
        link.innerHTML = 'GET';
        L.DomEvent.on(link, 'click', L.DomEvent.stop)
                  .on(link, 'click', function () {
                    // Method associated with the clicking event in icon
                    window.getAllAreasInfo(window.map, "info");
                  });
  
        return container;
      }
    });
  }

  // Set order that will be displayed in the menu
  if( controlDelA ) window.map.addControl(new window.L.NewEraseAllControl());
  if( controlMark ) window.map.addControl(new window.L.NewMarkerControl());
  if( controlPath ) window.map.addControl(new window.L.NewLineControl());
  if( controlPoly ) window.map.addControl(new window.L.NewPolygonControl());
  if( controlRect ) window.map.addControl(new window.L.NewRectangleControl());
  if( controlCirc ) window.map.addControl(new window.L.NewCircleControl());
  if( controlGetA ) window.map.addControl(new window.L.NewGetAllAreasInfo());


  // ----------------------------------------------------------------------
  // -------------------- EVENTS CONTROL FOR SHORTCUTS --------------------
  // Tooltip when drawing in the map
  window.tooltip = window.L.DomUtil.get('tooltip');
  function moveTooltip (e) {
    window.tooltip.style.left = e.clientX + 20 + 'px';
    window.tooltip.style.top  = e.clientY - 10 + 'px';
  }
  function addTooltip (e) {
    window.tooltip.innerHTML     = e.latlng;
    window.tooltip.style.display = 'block';
    window.L.DomEvent.on(document, 'mousemove', moveTooltip);
    window.map.on('editable:drawing:move', updateTooltip);
  }
  function removeTooltip (e) {
    window.tooltip.innerHTML     = '';
    window.tooltip.style.display = 'none';
    window.L.DomEvent.off(document, 'mousemove', moveTooltip);
    window.map.off('editable:drawing:move', updateTooltip);
  }
  function updateTooltip (e) {
    window.tooltip.innerHTML = e.latlng;
  }
  window.map.on('editable:drawing:start', addTooltip);
  window.map.on('editable:drawing:move', updateTooltip);
  window.map.on('editable:drawing:end', removeTooltip);
  window.map.on('editable:vertex:dragstart', addTooltip);
  window.map.on('editable:vertex:drag', updateTooltip);
  window.map.on('editable:vertex:dragend', removeTooltip);

  // Delete Shape: Ctrl + click in shape (does not work with circles - issue report at GitHub)
  window.deleteShape = function (e) {
    if ((e.originalEvent.ctrlKey || e.originalEvent.metaKey) && this.editEnabled()) this.editor.deleteShapeAt(e.latlng);
  };
  window.map.on('layeradd', function (e) {
    if (e.layer instanceof L.Path) e.layer.on('click', window.L.DomEvent.stop).on('click', deleteShape, e.layer);
  });

  // Toggle Edition mode in map (to prevent bugs)
  window.map.on('layeradd', function (e) {
    if (e.layer instanceof window.L.Polygon) e.layer.on('dblclick', window.L.DomEvent.stop).on('dblclick', e.layer.toggleEdit);
  });
  window.map.on('layerremove', function (e) {
    if (e.layer instanceof window.L.Polygon) e.layer.off('dblclick', window.L.DomEvent.stop).off('dblclick', e.layer.toggleEdit);
  });
  window.map.editTools.on('editable:enable', function (e) {
    if (this.currentPolygon) this.currentPolygon.disableEdit();
    this.currentPolygon = e.layer;
    this.fire('editable:enabled');
  });
  window.map.editTools.on('editable:disable', function (e) {
    delete this.currentPolygon;
  });


  
  return;
}


/***********************************************************************************************
 ***** GETALLAREASINFO( _MYMAP, _DEBUGELEMENTID ) 
 ***********************************************************************************************
 * Inputs:
 *   _mymap: variable map created by L.map('mapid', {editable: true}).setView(startPoint, 14);
 *   _debugElementId: string that identifies HTML id for debug section / division.
 * Outputs:
 *   JSON object with the following structure:
 *   allAreas = {
 *     polygonsVertLatLng: [] = {
 *       vertices: [] = {
 *         lat: ,
 *         lng:
 *       },
 *       numberVertices: 
 *     },
 *     numberPolygons: ,
 *     circlesCenterRad: [] = {
 *       center: {
 *         lat: ,
 *         lng:
 *       },
 *       radius: 
 *     },
 *     numberCircles
 *   }
 ***********************************************************************************************/
function getAllAreasInfo(_mymap, _debugElementId) {
  j=0;
  stringAllPoints = "DISPLAYING AREAS\n";
  stringAllPointsHTML = "DISPLAYING AREAS<br>";

  // Get all areas drawn in the interactive map
  for(i in _mymap._layers) {
    // POLYGONS
    if(_mymap._layers[i]._path != undefined && _mymap._layers[i]._latlngs != undefined && _mymap._layers[i]._latlngs[0] != undefined && _mymap._layers[i]._latlngs[0][0] != undefined) {
      try {
        // Declaration of JSON object to save polygons informations
        allAreas.polygonsVertLatLng[allAreas.numberPolygons] = {
          vertices:       [],
          numberVertices: 0
        };

        // DEBUG: updating strings with area informations
        stringAllPoints = stringAllPoints + "["+j+"] Points of Polygon " + "(layer "+ i +")" + ":\n";
        stringAllPointsHTML = stringAllPointsHTML + "["+j+"]&nbsp;Points of Polygon " + "(layer "+ i +")" + ":<br>";

        for(k=0; _mymap._layers[i]._latlngs[0][k] != undefined; k++){
          // Updating area information with new vertice
          allAreas.polygonsVertLatLng[allAreas.numberPolygons].vertices[k] = {
            lat: _mymap._layers[i]._latlngs[0][k].lat,
            lng: _mymap._layers[i]._latlngs[0][k].lng
          };
          allAreas.polygonsVertLatLng[allAreas.numberPolygons].numberVertices++;

          // DEBUG: updating strings with area informations -> adding new vertice to debug
          stringAllPoints = stringAllPoints + "--> "+k+": latitude="+_mymap._layers[i]._latlngs[0][k].lat+" longitude="+_mymap._layers[i]._latlngs[0][k].lng+"\n";
          stringAllPointsHTML = stringAllPointsHTML + "-->&nbsp;"+k+":&nbsp;latitude="+_mymap._layers[i]._latlngs[0][k].lat+"&nbsp;longitude="+_mymap._layers[i]._latlngs[0][k].lng+"<br>";
        }

        // Updating number of polygons
        allAreas.numberPolygons++;
        j++;
      } catch(e){
        console.log("ERROR: detecting polygons (rectangles and generic polygons).\n-> Problem with "+e+_mymap._layers[i]);
      }
    }

    // CIRCLES
    if(_mymap._layers[i]._path != undefined && _mymap._layers[i]._latlng != undefined) {
      try {
        // Declaration of JSON object to save circles informations
        allAreas.circlesCenterRad[allAreas.numberCircles] = {
          center: {
            lat: _mymap._layers[i].getLatLng().lat,
            lng: _mymap._layers[i].getLatLng().lng
          },
          radius: _mymap._layers[i].getRadius()
        };

        // DEBUG: updating strings with area informations
        stringAllPoints = stringAllPoints + "["+j+"] Circle " + "(layer "+ i +")" + ":\n";
        stringAllPoints = stringAllPoints + "--> CENTER: latitude="+_mymap._layers[i].getLatLng().lat+" longitude="+_mymap._layers[i].getLatLng().lng+"\n";
        stringAllPoints = stringAllPoints + "--> RADIUS: " + _mymap._layers[i].getRadius()+"\n";
        stringAllPointsHTML = stringAllPointsHTML + "["+j+"]&nbsp;Circle " + "(layer "+ i +")" + ":<br>";
        stringAllPointsHTML = stringAllPointsHTML + "-->&nbsp;CENTER:&nbsp;latitude="+_mymap._layers[i].getLatLng().lat+"&nbsp;longitude="+_mymap._layers[i].getLatLng().lng+"<br>";
        stringAllPointsHTML = stringAllPointsHTML + "-->&nbsp;RADIUS:&nbsp;" + _mymap._layers[i].getRadius()+"<br>";

        // Updating number of circles and auxiliar variables
        allAreas.numberCircles++;
        j++;
      } catch(e){
        console.log("ERROR: detecting circles.\n-> Problem with "+e+_mymap._layers[i]);
      }
    }
  }

  // Return of informations
  // -- DEBUG
  if( j>0 ){
	
	
	//$.post("https://paginas.fe.up.pt/~up201503216/seai_git/actions/action_get_area.php", stringAllPointsHTML);
   // document.getElementById(_debugElementId).innerHTML = stringAllPointsHTML;
  }
  else {
    console.log("!!!No areas were found in the current map!!!");
    document.getElementById(_debugElementId).innerHTML = "!!!No areas were found in the current map!!!";
  }
 // console.log(allAreas);
	postVar = JSON.stringify(allAreas);
    console.log(postVar);
    post('../actions/action_get_area.php',{parea: postVar});


/*  $.ajax({
                method: 'POST',
                url: 'https://paginas.fe.up.pt/~up201503216/seai_git/actions/action_get_area.php',
                data: {postVar},
                success: function(data){
                    alert(data);
                },
                error: function(xhr, desc, err){
                    console.log(err);
                }
            });
//window.location = 'https://paginas.fe.up.pt/~up201503216/seai_git/actions/action_get_area.php';
			
  /*$.post("https://paginas.fe.up.pt/~up201503216/seai_git/actions/action_get_area.php",{json: postVar},function(response){}).fail(function(xhr, status, error) {
    alert( "error" );
	$("#message").html("Result: " + status + " " + error + " " + xhr.status + " " + xhr.statusText);
  });*/
  // -- data return
 // $.post(".../.../actions/action_get_area.php", allAreas);
  return allAreas;
}


/***********************************************************************************************
 ***** CLEARMAP(  )
 ***********************************************************************************************
 * Clears all objects drawn in the map.
 ***********************************************************************************************/
function clearMap() {
  for(i in window.map._layers) {
    if(window.map._layers[i]._path != undefined) {
      try {
        window.map.removeLayer(window.map._layers[i]);
      }
      catch(e) {
        console.log("problem with " + e + window.map._layers[i]);
      }
    }
  }
}


