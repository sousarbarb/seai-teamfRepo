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
  <script src="../js/Leaflet.Editable.js"></script>

  <!-- Maps Library -->
  <script src="../js/mapsLib.js"></script>

  <!-- Style specific of the map and tooltip (it can be in a css file, for example -> DON'T CHANGE THE CLASS / ID NAMES) -->
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

<!-- Divisions related with the map itself -->
<div id="mapid" style="width: 100%; height: 800px;"></div>
<div id="tooltip"></div>

<!-- Script to call and configurate the map -->
<script>
  var map, tooltip, deleteShape;
  mapConfiguration();
</script>

<!-- Debug section -->
<p id="info"></p>

</body>