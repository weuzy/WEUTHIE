<?php 
             session_start();
            //  require_once('traitement/fonction.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <title>weuzy_QUIZZ_SA</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- CSS DU PROJET -->
    <link rel="stylesheet" href="public/css/general.css">
  </head>

  <body>
    <div class="container-fluid" id="heading" >
      <header class="row p-0 ">
            <div class="col-2 " id="logo">
            </div>
            <div class="col-8  text-center d-flex justify-content-center align-items-center">
            <p class="titre">bienvenu au jeu de quizz</p>
            </div>
            <div class="col-2 ">
            </div>
      </header>
      <div id="content" class="content">
        <?php
            // require_once('pages/connexion.php');

        ?>
      </div>
    </div>
   
    <!-- jQuery first,  bootpag -->
    <script src="public/js/jquery.js"></script>
    <script src="public/js/bootpag.js"></script>
    <!-- Optional JavaScript -->
    <script src="public/js/load.js"></script>   
  </body>
  
</html>
