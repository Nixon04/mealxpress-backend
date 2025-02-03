<!DOCTYPE html>
<html>
  <head>
    <script src="https://unpkg.com/vue-multiselect"></script>
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect/dist/vue-multiselect.min.css"> 
<link rel="icon" type="image/*" href="../../landingimages/favicon.png"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @vite('resources/js/app.js')
    @inertiaHead
  </head>
  <body>
    @inertia
  </body>
</html>