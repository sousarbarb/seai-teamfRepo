<!DOCTYPE html>
<html>
<head>
  <title>Leaflet - JavaScript library for interactive maps</title>
  <meta charset="utf-8"/>
  <!-- Leaflet CSS file -->
  <link rel="stylesheet" 
        href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin=""/>
  <!-- Leaflet JavaScript file -->
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
          integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
          crossorigin=""></script>
  <script src="https://npmcdn.com/leaflet.path.drag/src/Path.Drag.js"></script>
  <!-- Leaflet Polygon Editable -->
  <script src="../src/Leaflet.Editable.js"></script>

  <style type='text/css'>
      body { margin:0; padding:0; }
      #map { position:absolute; top:0; bottom:0; right: 0; left: 0; width:100%; }
      #tooltip {
        display: none;
        position: absolute;
        background: #666;
        color: white;
        opacity: 0.5;
        padding: 10px;
        border: 1px dashed #999;
        font-family: sans-serif;
        font-size: 12px;
        height: 20px;
        line-height: 20px;
        z-index: 1000;
      }
  </style>
</head>

<body>
<div id="mapid" style="width: 100%; height: 800px;"></div>
<div id="tooltip"></div>

<script>
  // Starting point in the map
  var startPoint = [41.1780053,-8.5987102];

  // Display map center in geographical coordinates 41.1780053,-8.5987102
  // Zoom: 0 to 18 (max)
  var map = L.map('mapid', {editable: true}).setView(startPoint, 14);
  
  // Map footer with author rights
  L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    maxZoom: 18,
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
      '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
      'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    id: 'mapbox/streets-v11'
  }).addTo(map);

  // Display controls in map
  L.EditControl = L.Control.extend({  // MENU POLYGON EDITOR
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

  /***********************************************************************
  L.NewLineControl = L.EditControl.extend({       // CREATING LINES
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
                    map.editTools.startPolyline();
                  });

        return container;
    }
  });
  map.addControl(new L.NewLineControl());
map.eachLayer(function (layer) {
    map.removeLayer(layer);
});
  ***********************************************************************/

  function clearMap() {
    for(i in map._layers) {
      if(map._layers[i]._path != undefined) {
        try {
          map.removeLayer(map._layers[i]);
        }
        catch(e) {
          console.log("problem with " + e + map._layers[i]);
        }
      }
    }
  }

  L.NewEraseAllControl = L.Control.extend({       // ERASE ALL LAYERS
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
                    clearMap();
                  });

        return container;
    }
  });
  map.addControl(new L.NewEraseAllControl());

  L.NewPolygonControl = L.Control.extend({        // CREATING POLYGONS
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
                    map.editTools.startPolygon();
                  });

        return container;
    }
  });
  map.addControl(new L.NewPolygonControl());

  /***********************************************************************
  L.NewMarkerControl = L.EditControl.extend({     // CREATING MARKERS
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
                    map.editTools.startMarker();
                  });

        return container;
    }
  });
  map.addControl(new L.NewMarkerControl());
  ***********************************************************************/

  L.NewRectangleControl = L.EditControl.extend({  // CREATING RECTANGLES
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
                    map.editTools.startRectangle();
                  });

        return container;
    }
  });
  map.addControl(new L.NewRectangleControl());

  L.NewCircleControl = L.EditControl.extend({     // CREATING CIRCLES
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
                    map.editTools.startCircle();
                  });

        return container;
    }
  });
  map.addControl(new L.NewCircleControl());

  // Delete Shape: Ctrl + click in shape (does not work with circles - issue report at GitHub)
  var deleteShape = function (e) {
    if ((e.originalEvent.ctrlKey || e.originalEvent.metaKey) && this.editEnabled()) this.editor.deleteShapeAt(e.latlng);
  };
  map.on('layeradd', function (e) {
    if (e.layer instanceof L.Path) e.layer.on('click', L.DomEvent.stop).on('click', deleteShape, e.layer);
  });

  // ------------------------------------------
  // ---------- DISPLAYING A TOOLTIP ----------
  var tooltip = L.DomUtil.get('tooltip');
  function moveTooltip (e) {
    tooltip.style.left = e.clientX + 20 + 'px';
    tooltip.style.top = e.clientY - 10 + 'px';
  }
  function addTooltip (e) {
    L.DomEvent.on(document, 'mousemove', moveTooltip);
    tooltip.innerHTML = e.latlng;
    tooltip.style.display = 'block';
    map.on('editable:drawing:move', updateTooltip);
  }
  function removeTooltip (e) {
    tooltip.innerHTML = '';
    tooltip.style.display = 'none';
    L.DomEvent.off(document, 'mousemove', moveTooltip);
    map.off('editable:drawing:move', updateTooltip);
  }
  function updateTooltip (e) {
    tooltip.innerHTML = e.latlng;
  }
  map.on('editable:drawing:start', addTooltip);
  map.on('editable:drawing:move', updateTooltip);
  map.on('editable:drawing:end', removeTooltip);
  map.on('editable:vertex:dragstart', addTooltip);
  map.on('editable:vertex:drag', updateTooltip);
  map.on('editable:vertex:dragend', removeTooltip);

  //--------------------------------------------------
  //---------- EDITABLE TOGGLE EDITION MODE ----------
  map.on('layeradd', function (e) {
    if (e.layer instanceof L.Polygon) e.layer.on('dblclick', L.DomEvent.stop).on('dblclick', e.layer.toggleEdit);
  });
  map.on('layerremove', function (e) {
    if (e.layer instanceof L.Polygon) e.layer.off('dblclick', L.DomEvent.stop).off('dblclick', e.layer.toggleEdit);
  });
  map.editTools.on('editable:enable', function (e) {
    if (this.currentPolygon) this.currentPolygon.disableEdit();
    this.currentPolygon = e.layer;
    this.fire('editable:enabled');
  });
  map.editTools.on('editable:disable', function (e) {
    delete this.currentPolygon;
  });

  //-------------------------------------------
  //---------- GET AREA INFORMATIONS ----------
  function getAllAreasInfo() {
    j = 0;
    stringAllPoints = "DISPLAYING AREAS\n";
    stringAllPointsHTML = "DISPLAYING AREAS<br>";
    for(i in map._layers) {
      if(map._layers[i]._path != undefined && map._layers[i]._latlngs != undefined) {   // POLYGONS AND RECTANGLES
        try {
          stringAllPoints = stringAllPoints + "["+j+"] Points of Polygon " + "(layer "+ i +")" + ":\n";
          stringAllPointsHTML = stringAllPointsHTML + "["+j+"] Points of Polygon " + "(layer "+ i +")" + ":<br>";
          points = map._layers[i]._latlngs;
          for(k=0; points[0][k] != undefined; k++){
            stringAllPoints = stringAllPoints + "  -->"+k+": latitude="+points[0][k].lat+" longitude="+points[0][k].lng+"\n";
            stringAllPointsHTML = stringAllPointsHTML + "  -->"+k+": latitude="+points[0][k].lat+" longitude="+points[0][k].lng+"<br>";
          }
          j=j+1;
        }
        catch(e) {
          console.log("problem with " + e + map._layers[i]);
        }
      }
      // Using map._layers[603]._latlngs[0][3].distanceTo({lat:41.18714849868492, lng: -8.619246482849123}) confirms
      // the correct radius measure by getRadius!!!
      // In Excel:
      //   --> distance = sqrt( (41.1871484986849  - 41.1896312438617 )^2 
      //                      + (-8.61924648284912 +  8.61630141735077)^2 ) * 100 000 = 385.1939044
      // It differs from getRadius -> 370.0641341837011
      if(map._layers[i]._path != undefined && map._layers[i]._latlng != undefined) {   // CIRCLES
        try {
          stringAllPoints = stringAllPoints + "["+j+"] Circle " + "(layer "+ i +")" + ":\n";
          stringAllPointsHTML = stringAllPointsHTML + "["+j+"] Circle " + "(layer "+ i +")" + ":<br>";
          points = map._layers[i].getLatLng();
          stringAllPoints = stringAllPoints + "  -->CENTER: latitude="+points.lat+" longitude="+points.lng+"\n";
          stringAllPoints = stringAllPoints + "  -->RADIUS: " + map._layers[i].getRadius()+"\n";
          stringAllPointsHTML = stringAllPointsHTML + "  -->CENTER: latitude="+points.lat+" longitude="+points.lng+"<br>";
          stringAllPointsHTML = stringAllPointsHTML + "  -->RADIUS: " + map._layers[i].getRadius()+"<br>";
          j=j+1;
        }
        catch(e) {
          console.log("problem with " + e + map._layers[i]);
        }
      }
    }
    if(j>0){console.log(stringAllPoints);document.getElementById("info").innerHTML = stringAllPointsHTML;}
    else   {console.log("!!!No areas were found in the current map!!!");document.getElementById("info").innerHTML = "!!!No areas were found in the current map!!!";}
  }

  L.NewGetAllAreasInfo = L.Control.extend({       // GET ALL AREAS INFORMATIONS
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
                  getAllAreasInfo();
                });

      return container;
    }
  });
  map.addControl(new L.NewGetAllAreasInfo());

</script>

<p id="info"></p>

</body>