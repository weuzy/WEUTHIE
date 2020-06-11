<?php
$questions = getData('question/question');
define(@NBRVALEURPARPAGE,5);
$TOTALVALEUR = count($questions);
$nbrPage = ceil( $TOTALVALEUR/NBRVALEURPARPAGE);
if (!isset($_GET['questions'])) 
    {
        $pageActuelle = 1 ;
    }
else{
        $pageActuelle = $_GET['questions'];
        if ($pageActuelle >= $nbrPage) 
        {
            $pageActuelle = $nbrPage ;
        }
     elseif($pageActuelle <= 1)
        {
            $pageActuelle = 1 ;
        }
    } 
    $min = ($pageActuelle -1 ) * NBRVALEURPARPAGE;
    $max = $min + NBRVALEURPARPAGE;
       
?>

<style>
    #liste{
    position: relative;
    background-size: cover;
    height: 28rem;
    width: 45rem;
    padding: 20px;
    top: 1rem;
    right: -43%;
    background-color:#fff;
    border-radius: 8px;
    }
    .liste-header{
    font-size: 1.4rem;
    text-align: center;
    color: grey;
    }
    .nombre{
    width: 5%;
    height: 1.5rem;
    font-size: 1.2rem;
    font-weight: bold;
    text-align: center;
    color: grey;
    }
    .liste-border{
    height:23rem;
    width: 96%;
    margin-top: 2%;
    background-color: #fff;
    background-size: cover;
    border-style: solid;
    border-color: gainsboro;
    border-radius: 8px;
    }
    #navigation{
        width: 100%;
        height: 1.5rem;
        display:flex;
        justify-content: space-around;
        
    }
    .nav
    {
        background-color: turquoise;
        font-weight: bold;
    }
    p {
        display: block;
        margin-top: -2em;
        margin-bottom: 1em;
        margin-left: 0;
        margin-right: 0;
    }
</style>


<div id="liste">
    <div class="liste-header">Nbre de question/jeu 
        <input type="number" class="nombre" id="nombre" name="nbr_question"  min=5 value="5">
        <button type="submit" onclick="my_validate()" name="fix_nbr_question" style="margin-left:1rem; border:none;
         padding:.4rem; background-color:blue; color:#fff">OK</button>
    </div>
    <div class="liste-border" id="displays">
        <?php 
          if($pageActuelle!=$nbrPage)
          {
           for($i =$min; $i < $max; $i++)
             { ?>
                 
                    <h5 style="font-weight:bold; font-size:18px; color:gray; margin-top:.3rem "><?php echo ($i+1)." . ".$questions[$i]['enonce']?></h5>  
                    <?php if ($questions[$i]['type'] == 'text') 
                                { ?>
                                  <input type="text" style="width:12rem; height:2rem; margin-left:2rem" value="">
                    <?php       } 
                            if ($questions[$i]['type'] == 'qcs') 
                            {
                                for ($j=0; $j <count($questions[$i]['reponses']); $j++) 
                                { ?>
                                   <p style="font-size:15px;top:1.9rem;font-style:normal;left:7%;color:black;text-transform:none"><?php echo $questions[$i]['reponses'][$j]?></p>  
                                <input style="margin-left:5%" type="radio" <?php if (in_array($questions[$i]['reponses'][$j],$questions[$i]['reponsesVraies'])){?> checked <?php }?> name="rd<?php echo $i?>">
                    <?php       }
                            }
                            if ($questions[$i]['type'] == 'qcm') 
                            {
                                for ($j=0; $j <count($questions[$i]['reponses']); $j++) 
                                { ?>
                                <p style="font-size: 15px;color:black;left:7%;top:1.9rem"><?php echo $questions[$i]['reponses'][$j]?></p> 
                                 <input style="margin-left:5%" type="checkbox" name="cb<?php echo $i?>" <?php if (in_array($questions[$i]['reponses'][$j],$questions[$i]['reponsesVraies'])){?> checked <?php }?>>  
                    <?php       }
                            }
                ?>
       
        <?php
                    }
                }
                else{
                    for($i =$min; isset($questions[$i]); $i++)
                    { ?>
                 
                        <h5 style="font-weight:bold; font-size:18px; color:gray; margin-top:.3rem "><?php echo $i." . ".$questions[$i]['enonce']?></h5>  
                        <?php if ($questions[$i]['type'] == 'text') 
                                    { ?>
                                      <input type="text" style="width:12rem; height:2rem; margin-left:2rem" value="">
                        <?php       } 
                                if ($questions[$i]['type'] == 'qcs') 
                                {
                                    for ($j=0; $j <count($questions[$i]['reponses']); $j++) 
                                    { ?>
                                       <p style="font-size:15px;top:1.9rem;font-style:normal;left:7%;color:black;text-transform:none"><?php echo $questions[$i]['reponses'][$j]?></p>  
                                    <input style="margin-left:5%" type="radio" <?php if (in_array($questions[$i]['reponses'][$j],$questions[$i]['reponsesVraies'])){?> checked <?php }?> name="rd<?php echo $i?>">
                        <?php       }
                                }
                                if ($questions[$i]['type'] == 'qcm') 
                                {
                                    for ($j=0; $j <count($questions[$i]['reponses']); $j++) 
                                    { ?>
                                    <p style="font-size: 15px;color:black;left:7%;top:1.9rem"><?php echo $questions[$i]['reponses'][$j]?></p> 
                                     <input style="margin-left:5%" type="checkbox" name="cb<?php echo $i?>" <?php if (in_array($questions[$i]['reponses'][$j],$questions[$i]['reponsesVraies'])){?> checked <?php }?>>  
                        <?php       }
                                }
                    ?>
            <?php
                    }
                }
        ?>   
    </div>
    <div id="navigation">
    <button type="submit" class="nav" name="btn_submit" id="" value=""><a href="index.php?lien=accueil&page=liste&questions=<?= $pageActuelle-1 ?>" class="dec">Précédent</a></button>
    <button type="submit" class="nav" name="btn_submit" id="" value=""><a href="index.php?lien=accueil&page=liste&questions=<?= $pageActuelle+1 ?>" class="dec">Suivant</a></button>
</div>
</div>
<script>
    // validation: le nombre de question doit supérieur ou égal à 5
    function my_validate()
    {
        var  action = document.getElementById('nombre').value;
        if(!action)
        {
            alert("erreur: ce champ doit être rempli!!");
            return false;
        }else if(!Number.isInteger(+action))
        {
            alert("erreur: la valeur doit être un nombre!!");
            return false;
        }else if(action<5)
        {
            alert("erreur: le nombre doit être supérieur ou égal à 5 !!");
        return false
        }
        return true ;
    }
</script>