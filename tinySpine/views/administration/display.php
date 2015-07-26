<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<script src="//use.typekit.net/wxg3lnd.js"></script>
<script>try{Typekit.load();}catch(e){}</script>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Admin - Find Guidelines - The fastest way to brand assets.</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1" />
  <meta name="description" content="Find guidelines on the web. The fastest way to brand assets.">
  <link rel="icon" href="http://findguidelin.es/img/favicon.ico" />
  <link rel="stylesheet" href="<?php echo BASEURL; ?>css/style_administration.css">


  </head>

  <body>
    <?php Controller::exec('Administration', 'header'); ?>
    <?php Controller::exec($module, $action); ?>
    <?php Controller::exec('Administration', 'footer'); ?>
    <!-- Javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo(BASEURL); ?>bootstrap/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            $('.deleteLink').bind('click', function(e){
               if(!confirm('Do you want to delete this user?')){
                 e.preventDefault();
               }
            });
        });
   </script>
  </body>
</html>
