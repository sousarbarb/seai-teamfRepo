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

  // Create the map
  var map = L.map('mapid', {editable: true}).setView(startPoint, 5);

  // Set up the OSM layer
  var baseLayer1 = L.tileLayer(
    'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 18,
      name: "Base layer 1"
    }).addTo(map);

  function clickHandler(e) {
    var clickBounds = L.latLngBounds(e.latlng, e.latlng);

    var intersectingFeatures = [];
    for (var l in map._layers) {
      var overlay = map._layers[l];
      if (overlay._layers) {
        for (var f in overlay._layers) {
          var feature = overlay._layers[f];
          var bounds;
          if (feature.getBounds) bounds = feature.getBounds();
          else if (feature._latlng) {
            bounds = L.latLngBounds(feature._latlng, feature._latlng);
          }
          if (bounds && clickBounds.intersects(bounds)) {
            intersectingFeatures.push(feature);
          }
        }
      }
    }
    // if at least one feature found, show it
    if (intersectingFeatures.length) {
      var html = "Found features: " + intersectingFeatures.length + "<br/>" + intersectingFeatures.map(function(o) {
        return o.properties.type
      }).join('<br/>');

      map.openPopup(html, e.latlng, {
        offset: L.point(0, -24)
      });
    }
  }

  map.on("click", clickHandler);

  // add some markers
  function createMarker(lat, lng) {
    var marker = L.marker([lat, lng]);
    marker.on("click", clickHandler);
    marker.properties = {
      type: "point"
    }; // add some dummy properties; usually would be geojson
    return marker;
  }
  var markers = [createMarker(36.9, -2.45), createMarker(36.9, -2.659), createMarker(36.83711, -2.464459)];

  // create group to hold markers, it will be added as an overlay
  var overlay = L.featureGroup(markers).addTo(map);

  // show features
  map.fitBounds(overlay.getBounds(), {
    maxZoom: 11
  });

  // create another layer for shapes or whatever
  var circle = L.circle([36.9, -2.45], 2250, {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5
  });
  circle.on('click', clickHandler);
  circle.properties = {
    type: "circle"
  };
  var overlay2 = L.featureGroup([circle]).addTo(map);



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