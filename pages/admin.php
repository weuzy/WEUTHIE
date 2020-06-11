
<?php
is_connect();
// getData c'est pour recupérer tous les éléments du fichiers Json
// $_SESSION['id'] c'est la position de l'utilisateur dans le fichier json
// $users c'est la table qui contient toutes les informations sur l'utilisateur connecté

$users = getData()[$_SESSION['id']];
$listQ = '';
$creerA = '';
$listJ = '';
$creerQ = '';
$_SESSION['listQ']= '';
$_SESSION['creerA'] = '';
$_SESSION['listJ']= '';
$_SESSION['creerQ'] = '';
// Récupération de la classe *-active* qui marque la différence 
// de l'icone cliqué par rapport aux autres icones dans la partie du menu 
    if ($_GET['page'] == 'inscription') 
    {
        $_SESSION['creerA'] ='-active';
        $creerA = $_SESSION['creerA'];
    }
    elseif($_GET['page'] == 'joueur') 
    {
        $_SESSION['listJ'] ='-active';
        $listJ = $_SESSION['listJ'];
    } 
    elseif($_GET['page'] == 'liste') 
    {
        $_SESSION['listQ'] ='-active';
        $listQ = $_SESSION['listQ'];
    } 
    elseif($_GET['page'] == 'question') 
    {
        $_SESSION['creerQ'] ='-active';
        $creerQ = $_SESSION['creerQ'];
    }     
?>

    <!-- Structuration de l'HTML de la page ADMIN -->
<div class="wrapper">
    <div class="wrapper-header">
    <!-- $texte est le titre de la page qui est la seule différence au niveau de la partie header à celle de jeux.php-->
        <div class="up-title"><?php echo $texte;?></div> 
        <div>
        <div><a href="index.php?statut=logout" class="btn-position deconnexion">Deconnexion</a></div>
        
        </div>
    <div class="wrapper-body">
      <div class="create">
          <div class="create-header">
              <img src="<?= $users['photo'] ?>" style="position:relative; left:0" class="picture-form">
              <div style="color:#fff;margin-top:2rem;margin-left:2%;font-style:italic;font-weight:bold"><?php echo $users['prenom']."<br>".$users['nom']?></div>
          </div>
          <div class="list" style="box-sizing: border-box;">
                <ul style="box-sizing: border-box;">
                    <li class="liste-icon-form <?= $listQ ?>" style="background-image: url('./public/icones/ic-liste<?= $listQ ?>.png');"><a href="index.php?lien=accueil&page=liste">Liste Questions</a></li>
                    <li class="liste-icon-form <?= $creerA ?>" style="background-image: url('./public/icones/ic-ajout<?= $creerA ?>.png');"><a href="index.php?lien=accueil&page=inscription">Créer Admin</a></li>
                    <li class="liste-icon-form <?= $listJ ?>" style="background-image: url('./public/icones/ic-liste<?= $listJ ?>.png');"><a href="index.php?lien=accueil&page=joueur">Liste Joueurs</a></li>
                    <li class="liste-icon-form <?= $creerQ ?>" style="background-image: url('./public/icones/ic-ajout<?= $creerQ ?>.png');"><a href="index.php?lien=accueil&page=question">Créer Questions</a></li>
                </ul>
         </div>
      </div>
      
 </div>   
</div>

<?php
    // inclusion des pages qui nous permet d'afficher une partie du menu 
    // une fois cliquer sur le lien souhaiter dans la page Admin
    if ($_GET['page'] == 'inscription') 
    {
        include("Inscription.php");
    }
elseif ($_GET['page'] == 'joueur') 
    {
        include("Joueur.php");
    }    
 elseif ($_GET['page'] == 'question') 
    {
        include("question.php");
    } 
 elseif ($_GET['page'] == 'liste') 
    {
        include("listeQuestion.php");
    }   



?>