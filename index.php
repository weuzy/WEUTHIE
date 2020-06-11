<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MINI_PROJET_QUIZZ</title>
    <link rel="stylesheet" href="./public/css/quizz.css">
</head>
<body>
    <div class="header">
    <div class="logo"></div>
    <div class="header-text">Le plaisir de jouer</div>
     </div>
    <div class="content">
        <?php
        session_start();
            require_once("./traitement/fonction.php");



            if(isset($_GET['lien'])){
                // *accueil* est le lien de la page Admin
                // *jeux* est le lien de la page où l'utilisateur va jouer 
                // *inscription* est le lien de la page où l'utilisateur va s'inscrire pour jouer
                switch($_GET['lien']){
                    case "accueil":
                        // titre principal de la page Admin
                        $texte = "créer et paramètrer vos quizz";
                        // titre de la partie inscrire pour la création compte Admin
                        $title = "Pour proposer vos quizz";
                        $nomAvatar = "Avatar Admin";
                        // style de la partie création compte Admin de la page admin.php
                        $top_in = "6%";
                        $padding_in = "20px";
                          require_once("./pages/admin.php");  
                    break;
                    case "jeux":
                        // titre principal de la page jeux
                        $texte = "BIENVENUE SUR LA PLATEFORME DE JEU DE QUIZZ<br><br>JOUER ET TESTER VOTRE NIVEAU DE CULTURE GENERALE";
                          require_once("./pages/jeux.php");
                    break;
                    case "inscription":
                        // titre de la partie inscrire pour la création compte Joueur
                        $title = "Pour tester votre niveau de culture générale";
                        $nomAvatar = "Avatar du joueur";
                        // style de la partie création compte Joueur de la page Inscription.php
                        $right_in = "-28%";
                          require_once("./pages/Inscription.php");
                    break; 
                } 
            }else {
                if (isset($_GET['statut']) && $_GET['statut']==="logout") {
                    deconnexion();
                }
                require_once("./pages/connexion.php");
            }
           
        ?>
    </div>
    
</body>
</html>