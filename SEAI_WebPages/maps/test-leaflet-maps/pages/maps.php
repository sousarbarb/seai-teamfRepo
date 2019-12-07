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
</head>

<body>
<div id="mapid" style="width: 1000px; height: 800px;">
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
  ***********************************************************************/
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


</script>
</div>
</body>