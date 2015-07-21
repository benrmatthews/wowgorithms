<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Findguidelin.es - administration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo(BASEURL); ?>bootstrap/css/bootstrap.css" rel="stylesheet">

    <link href="<?php echo(BASEURL); ?>bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="../assets/ico/favicon.png">

  </head>

  <body>
    <?php Controller::exec('Administration', 'header'); ?>
    <?php Controller::exec($module, $action); ?>
    <hr>
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
