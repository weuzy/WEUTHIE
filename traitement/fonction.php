<?php

function connexion($login,$pwd){
    $users = getData();// getData c'est pour recupérer tous les éléments du fichiers Json
    foreach ($users as $key => $users) {
              if($users["login"] === $login && $users["password"] === $pwd){
                $_SESSION['id'] = $key; // $_SESSION['id'] c'est la position de l'utilisateur dans le fichier json
                  if ($users["profil"] === "admin") {
                      return "accueil";
                  }else {
                      return "jeux";
                  }
              }
    }
    return "error";
}
function is_connect(){


    if (!isset($_SESSION['admin']) && !isset($_SESSION['joueur'])) {
        header("location:index.php");
    }
}

function deconnexion(){
        session_destroy();
}

function getData($filename = "utilisateur"){
            return json_decode(file_get_contents("./data/".$filename.".json"),true);
}
?>