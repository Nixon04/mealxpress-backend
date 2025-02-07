<!DOCTYPE html>
<html>
  <head>
    <script src="https://unpkg.com/vue-multiselect"></script>
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect/dist/vue-multiselect.min.css"> 
    <link rel="icon" type="image/*" href="../../landingimages/favicon.png"/>
    <meta name="description" content="We are No 1 leading in various states such as delta, bayelsa and portharcourt, leading in delivery of foods ordering to various clients. we are fast and reliable">
    <meta name="author" content="Mealxpress.ng">
    <meta property="og:title" content="Delivering the best there is">
    <meta property="og:description" content="We are the best">
    <meta property="og:image" content="https://mealxpress.ng/landingimages/logo.png">
    <meta property="og:url" content="https://instagram.com/mealxpress_ng">
    <meta property="og:type" content="https://mealxpress.ng">

{{-- <meta name="twitter:card" content=""> --}}
    <meta name="twitter:title" content="Mealxpress">
    <meta name="twitter:description" content="We are No 1 leading in various states such as delta, bayelsa and portharcourt, leading in delivery of foods ordering to various clients. we are fast and reliable">
    <meta name="twitter:image" content="https://mealxpress.ng/landingimages/logo.png">
    <meta name="twitter:site" content="@mealxpress_ng">


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