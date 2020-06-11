
        <?php
        is_connect();
        $users = getData()[$_SESSION['id']];
        $data = getData();
        $joueurs = []; $scores = [];
        for($i=0; isset($data[$i]); $i++){
            if($data[$i]['profil']=='joueur'){
                //on recupère tous les joueurs d'abord
                $joueurs[] = $data[$i];
                // on recupère ensuite tous les scores des joueurs
                $scores[] = $data[$i]['score'];
            }
        }
        function is_compare($a,$b)
        {
            if ($a["score"] === $b["score"]) return 0;
            return($a["score"] > $b["score"]) ? -1 : 1;
        }
        usort($joueurs,"is_compare");
        $topScores = [];
        $topScores = array_slice($joueurs,0,5);

        $ask = getData('question/question');
        $nombre = getData('question/nbrDequestion');
        $questParpage = 1 ;
        $Globquestion = count($ask);
        $nbrDepage = ceil($Globquestion/$questParpage);
        if (!isset($_GET['ask'])) {
        $pageActuelle = 1 ;
        }else {
            $pageActuelle = $_GET['ask'];
            if ($pageActuelle >= $nbrDepage) {
                $pageActuelle = $nbrDepage;
            }elseif ($pageActuelle <= 1) {
                $pageActuelle = 1 ;
            }
        } 
        $min = ($pageActuelle - 1 ) * $questParpage;
        $max = $min + $questParpage;

        ?>
        <style>
            .username
            {
                float:left;
                color: #fff;
                font-weight: bold;
                margin-top: 4.8rem;
                margin-left: -4rem
            }
            .score 
            {
                position:  relative;
                float: top;
                top: -30rem;
                display: block;
                background-size: cover;
                height: 25rem;
                width: 23%;
                padding: 12px;
                left: 62rem;
                background-color:#fff;
                box-shadow:  4px  3px 4px 2px grey;
                border-radius: 8px;  
            }
            a{
                text-decoration: none;
            }
            h5{
                color: blue
            }
            #navigation{
                position: absolute;
                width: 100%;
                height: 2rem;
                padding: 5rem 0rem;
                position: static;
                color: #fff;
                display:flex;
                justify-content: space-around;
            }
            .ok{
                background-color: turquoise;
                border: none;
                height: 2.3rem;
                width: 6rem;
                margin-top: -1rem;
                font-weight: bold;
                font-size: 18px;
            }
            .prev{
                margin-right: 40rem;
            }
            .score nav ul li{
                display: inline-block
            }
            .affichage{
                font-size: 1.2rem;
                font-weight: bolder;
                padding: .7rem
            }
            .nav-pills{
                position: relative;
                width: 19rem;
                height: 3rem;
                left: -.8rem;
                margin-top: -.8rem;
            }
            .nav-item{
                width: 45%
            }
            .nav-pills .nav-link{
                font-weight: bold;
                font-weight: bold;
                padding-top: 13px;
                text-align: center;
                background: #343436;
                color: #fff;
                border-radius: 30px;
                height: 100px;
            }
            .nav-pills .nav-link.active{
                background: #fff;
                color: #000;
            }
        
        
        </style>


<div class="wrapper">
      <div class="wrapper-header">
        <img src="<?php echo $users['photo'];?>" class="picture-form" style="float:left; margin-left:1rem; margin-top:.6rem; width:66px; height:66px; border-color:#fff">
        <div class="username"><?php echo "" .$users['prenom']." ".$users['nom']. "";?></div>
        <div class="up-title" style="padding: 20px; font-size: 23px;"><?php echo $texte;?></div>
        <div>
        <div><a href="index.php?statut=logout" class="btn-position deconnexion" style=" top: -85px;">
         Deconnexion</a></div>
        </div>
      </div>
 <div class="wrapper-body">
     <div class="interface">
        <div class="ask">
            <div class="head-in" style="background:rgb(222, 228, 231);margin-top:1%;margin-left:1.5%;margin-right:1.5%;height:9rem">
                <h2 style="position:relative;text-align:center;padding:1rem;top:1.5rem;font-style:italic;text-decoration:underline;font-size: 2rem">
                   Question <?= $pageActuelle."/".$nombre['nombre']?>:</h2>
                    <h3 style="text-align:center;margin-top:1rem;font-weight:unset;font-size:25px ">
                       <?php echo $ask[$pageActuelle]['enonce'] ?></h3>
                         </div>
                            <div style="height:3rem;width:5rem;margin-top:.5rem;float:right;margin-right:1.5%;background:rgb(222, 228, 231)">
                              <h3 style="text-align:center;;margin-top:1rem;font-weight:unset;font-size:23px">
                                <?php echo $ask[$pageActuelle]['points']." pts" ?></h3>
                                  </div>
             <div class="under">
                <form action="" method="POST" id="play">
                   <?php 
                     if ($pageActuelle != $nbrDepage) {
                        for ($i = $min; $i < $max ; $i++) { 
                           if ($ask[$pageActuelle]['type'] == 'text') {?>
                             <textarea name="" id="" cols="50" rows="5"style="margin-top:10%;margin-left:15rem;font-size:20px"></textarea>
                               <?php   }
                            elseif ($ask[$pageActuelle]['type'] == 'qcs') {
                                for ($j=0; $j < count($ask[$pageActuelle]['reponses']) ; $j++) { ?>
                                    <p style=" margin-top:2%;font-size:28px;top:1.9rem;font-style:normal;left:20%;color:black;text-transform:none">
                                        <?php echo $ask[$pageActuelle]['reponses'][$j]?></p>
                                            <input type="radio" style="margin-left:15%;width:2rem;height:2rem" name="rd<?php echo $pageActuelle?>">  
                                                <?php    }
                                }
                            elseif ($ask[$pageActuelle]['type'] == 'qcm') {
                                for ($j=0; $j < count($ask[$pageActuelle]['reponses']) ; $j++) { ?>
                                    <p style=" margin-top:2%;font-size:28px;top:1.9rem;font-style:normal;left:20%;color:black;text-transform:none">
                                        <?php echo $ask[$pageActuelle]['reponses'][$j]?></p>
                                            <input type="checkbox" style="margin-left:15%;width:2rem;height:2rem;" name="cb<?php echo $pageActuelle?>">
                                                <?php }
                                                    }?>
                                <?php }
                            }
                     else {
                        for ($i=$min; isset($ask[$pageActuelle]); $i++) { 
                            if ($ask[$pageActuelle]['type'] == 'text') {?>
                                <textarea name="" id="" cols="50" rows="5"style="margin-top:10%;margin-left:15rem;font-size:20px"></textarea>
                                    <?php   }
                            elseif ($ask[$pageActuelle]['type'] == 'qcs') {
                                for ($j=0; $j < count($ask[$pageActuelle]['reponses']) ; $j++) { ?>
                                    <p style=" margin-top:3%;font-size:28px;top:1.9rem;font-style:normal;left:20%;color:black;text-transform:none">
                                        <?php echo $ask[$pageActuelle]['reponses'][$j]?></p>
                                            <input type="radio" style="margin-left:15%;width:2rem;height:2rem" name="rd<?php echo $pageActuelle?>">  
                                                <?php    }
                                }
                            elseif ($ask[$pageActuelle]['type'] == 'qcm') {
                                for ($j=0; $j < count($ask[$pageActuelle]['reponses']) ; $j++) { ?>
                                    <p style=" margin-top:3%;font-size:28px;top:1.9rem;font-style:normal;left:20%;color:black;text-transform:none">
                                        <?php echo $ask[$pageActuelle]['reponses'][$j]?></p>
                                            <input type="checkbox" style="margin-left:15%;width:2rem;height:2rem;" name="cb<?php echo $pageActuelle?>">
                                                <?php       }
                                                    }?>
                    <?php       }
                            }?>
				    <div id="navigation">
                        <?php if ($pageActuelle == 1 ) {?>
                                <button type="submit" class="ok prev" name="btn_submit" disabled style="background-color:grey;color:#fff" id="" value="prev">
                                 Précédent</button>
                                <button type="submit" class="ok next" name="btn_submit" id="" value="next">
                                <a href="index.php?lien=jeux&onglet=top&ask=<?= $pageActuelle+1 ?>" class="dec">Suivant</a>
                                </button>
                    <?php   }
                            elseif ($pageActuelle > 1 && $pageActuelle < $nombre['nombre']) {?>
                                <button type="submit" class="ok prev" name="btn_submit" id="" value="prev">
                                <a href="index.php?lien=jeux&onglet=top&ask=<?= $pageActuelle-1 ?>" class="dec">Précédent</a>
                                </button>
                                <button type="submit" class="ok next" name="btn_submit" id="" value="next">
                                <a href="index.php?lien=jeux&onglet=top&ask=<?= $pageActuelle+1 ?>" class="dec">Suivant</a>
                                </button>
                    <?php   }
                            elseif ($pageActuelle == $nombre['nombre']) {?>
                                <button type="submit" class="ok prev" name="btn_submit" id="" value="prev">
                                <a href="index.php?lien=jeux&onglet=top&ask=<?= $pageActuelle-1 ?>" class="dec">Précédent</a>
                                </button>
                                <button type="submit" class="ok next" name="btn_submit" id="" value="end" style="background-color:red">
                                <a href="index.php?lien=jeux&onglet=top&ask=<?= $pageActuelle ?>" class="dec">terminer</a>
                                </button>
                    <?php   } ?>
                    </div>
                </form>
             </div>
          </div>
          <div class="score">
             <nav> 
                 <ul class="nav-pills" role="tablist">
                   <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="index.php?lien=jeux&onglet=top">
                          <h5>Top scores</h5></a>
                   </li>
                   <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="index.php?lien=jeux&onglet=best">
                          <h5>Mon meilleur score</h5></a>
                   </li>
                 </ul>
             </nav>
              <?php
               if (isset($_GET['onglet'])) 
                    {
                     if ($_GET['onglet'] == 'top') 
                     {
                      for ($i = 0 ; $i < 5 ; $i++) 
                        { 
                          ?>
                          <div class="affichage"><?php echo $joueurs[$i]['prenom'].' '.$joueurs[$i]['nom'].' '.$joueurs[$i]['score'] ?> pts</div>
              <?php     }      
                     }elseif ($_GET['onglet'] == 'best') 
                        { ?>
                          <div class="affichage"><?= $users['prenom'].' '.$users['nom'].' '.$users['score'] ?> pts</div>  
              <?php     }
                    }
                ?>  
          </div> 
     </div>
 </div>
</div>




