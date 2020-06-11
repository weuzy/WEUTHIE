
<?php
$message_erorr = '';
	if (isset($_POST['valider'])) 
	{
		if($_POST['Password'] == $_POST['ConfirmedPassword'])
			{
				$users = getData();
				$exist = false;
				for ($i=0; isset($users[$i]) ; $i++) 
				{ 
					if ($_POST['Login'] == $users[$i]['login']) 
						{
							$exist = true;
					break;
						}
				}
				if (!$exist) 
				{
					$avatar = $_FILES['avatar'];
					$name = explode('.',$avatar['name']);
					$extension = end($name);
					if (in_array(strtolower($extension),['jpg','jpeg','png'])) 
						{
							if ($avatar['error'] == 0) 
							{
								# S'il n'y a aucune erreur sur le fichier
								if (explode('/',$avatar['type'])[0] == 'image') 
								{
									# Si le dossier uploadé est vraiment une image
										// $img est l'image que l'on va crée dans le dossier photos.
										//  C'est pourquoi on a mis "../data/photos/" pour qu'il soit dans le dossier photo .
										// l'avatar aura le meme nom que le login pour éviter les doublons. 
										// on y ajoute ensuite l'extension du fichier
										$img = "./data/photos/".$_POST['Login'].".$extension";
										 //move_uploaded_file est une fonction qui déplace l'image qu'on a uploadé 
										//  (fichier tampon) dans le chemin qu'on lui a précisé.
										//  Elle prend en argument le fichier tampon et le chemin dans lequel on va le créer. 
										// on affecte le tout à la variable $upload
										$upload = move_uploaded_file($avatar['tmp_name'],$img);
										if($upload)
											{//si le fichier a bien été uploadé, on fait la redirection vers la page d'accueil
												if(isset($_SESSION['admin']))
												  {
													$users[] = ['prenom'=>$_POST['Prenom'], 'nom'=>$_POST['Nom'], 'login'=>$_POST['Login'], 'password'=>$_POST['Password'], 'profil'=>'admin','photo'=>$img];
													file_put_contents("./data/utilisateur.json",json_encode($users,JSON_PRETTY_PRINT));
													header("location:index.php?lien=accueil&page=joueur");
												  }
												else
												  {
													// on ajoute les infos du nouvel utilisateur dans la table $users qui contient tous les utilisateurs
													$users[] = ['prenom'=>$_POST['Prenom'],'nom'=>$_POST['Nom'],'login'=>$_POST['Login'],'password'=>$_POST['Password'],'profil'=>'joueur','photo'=>$img,'score'=>0];
													
													// file_put_contents c'est la fonction qui va mettre à jour notre fichier json
													// json_encode va transformer $users en objet pour qu'il puisse être écrit dans le fichier json
													// le paramètre JSON_PRETTY_PRINT sera pour l'indentation du fichier json (il est facultatif mais permet une meilleure lisibilité du fichier json)
													file_put_contents("./data/utilisateur.json",json_encode($users,JSON_PRETTY_PRINT));
													header("location:index.php");
												  }
											}
										else
											{
												$message_erorr = "Echec lors de la transmission du fichier";
											}
									}
								else
									{
										$message_erorr = "L'avatar doit être une image.";
									}
							}
							else
								{
									$message_erorr = "Erreur sur le fichier";
								}					
						} 
					else
						{
							$message_erorr = "extension invalide";
						}	
				}
				else
				{
					$message_erorr = "veuilez saisir un login valide";
				}		
			}
		else 
			{
				$message_erorr = "les deux mots de passe doivent etre identiques";
			}
	}
?>






<div class="in" >
<style>
  .in{
    right: <?php echo $right_in;?>;
    top:  <?php echo $top_in;?>;
	padding:  <?php echo $padding_in;?>;
	 }
   #img{
	height: 100%;
	width: 100%;
	border-radius: 100%;
	  }
	#avatar{
		color: #fff;
	}
	.input-validation{
		position: relative;
		font-size: 80%;
		left: 20%;
		color: red;
	}
	.in-form
	{
		position: relative;
		height: 55px;
		margin: 15px 10px; 
	
	}
	input[type="file"] 
	{
    display: none;
	}
	.file-load {
		position: relative;
		left: 28%;
		top: -1rem;
		border: none;
		display: inline-block;
		padding: 6px 9px;
		cursor: pointer;
		color: #fff;
		background-color: #3ad4f0;
	}
</style>

    <div class="in-header">
        <div class="side">s'inscrire</div>
          <b><?php echo $title;?></b>
        <div class="divider"></div>
        <div class="img-form">
            <img src="" id="img" alt="">
            <h5><?php echo $nomAvatar;?></h5>
        </div>
    </div>
    <div class="in-body">
            <form method="POST" id="form-connexion" enctype="multipart/form-data">
            <div class="in-form">
              <div class="direct"> Prénom</div>
              <input type="text" class="in-control" name="Prenom" error="error-1" value="<?php if ( isset ( $_POST['Prenom'])){ echo$_POST['Prenom'];}?>" id="" > 
              <div class="input-validation" id="error-1"></div>
            </div>
            <div class="in-form">
            <div class="direct"> Nom</div>
              <input type="text" class="in-control" name="Nom" error="error-2" value="<?php if ( isset ( $_POST['Nom'])){ echo$_POST['Nom'];}?>" id="" > 
              <div class="input-validation" id="error-2"></div>
            </div>   
            <div class="in-form">
            <div class="direct"> Login</div>
              <input type="text" class="in-control" name="Login" error="error-3" value="<?php if ( isset ( $_POST['Login'])){ echo$_POST['Login'];}?>" id="" > 
              <div class="input-validation" id="error-3"></div>
            </div>   
            <div class="in-form">
            <div class="direct"> Password</div>
              <input type="password" class="in-control" name="Password" error="error-4" id="" > 
              <div class="input-validation" id="error-4"></div>
            </div>   
            <div class="in-form">
            <div class="direct"> Confirmer Password</div>
              <input type="password" class="in-control" name="ConfirmedPassword" error="error-5" id="" > 
              <div class="input-validation" id="error-5"></div>
            </div> 
			<h5>Avatar</h5> 
			<label class="file-load">
			<input onchange="affichageAvatar(this)" name="avatar" type="file" id="avatar">
			<i></i>choisir un fichier
			</label>
            <div><button type="submit" class="compte dec" name="valider" id="" value="">
			 Créer compte</button></div>
				 <p><?= $message_erorr ?></p>     
            </form>
     </div>
</div>

<script type="text/javascript">
	document.getElementById("form-connexion").addEventListener("submit",function(e){
		const inputs= document.getElementsByTagName("input");
		var error=false;
		for(input of inputs){
			if(input.hasAttribute("error")){
				var idDivError=input.getAttribute("error");
			if(!input.value){
				document.getElementById(idDivError).innerText="Ce champ est obligatoire"
				error=true;
				}
			}
		}
		if(error){
			e.preventDefault();
			return false;
		}
	})
	const inputs= document.getElementsByTagName("input");
	for(input of inputs){
		input.addEventListener("keyup",function(e){
			if (e.target.hasAttribute("error")){
				var idDivError=e.target.getAttribute("error");
				document.getElementById(idDivError).innerText=""
			}
		})
	}
	var avatarSection=document.getElementById("avatarSection");
	function affichageAvatar(input){
		if (input.files && input.files[0]) {
			var lireAvatar = new FileReader();
			lireAvatar.onload = function(e){
				document.getElementById('img').src = e.target.result;
				
			}
			lireAvatar.readAsDataURL(input.files[0]);
		}
	}
	
	
</script>