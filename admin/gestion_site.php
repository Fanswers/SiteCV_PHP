<?php
require_once("../inc/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if(!internauteEstConnecteEtEstAdmin()) header("location:../index.php");
echo'Admin connecté<br>';
//--- SUPPRESSION EXPERIENCE ---//
if(isset($_GET['action']) && $_GET['action'] == "suppression")
{   // $contenu .= $_GET['id_produit']
    $resultat = executeRequete("SELECT * FROM experience WHERE id=$_GET[id_produit]");
    $experience_a_supprimer = $resultat->fetch_assoc();
    $chemin_photo_a_supprimer = $_SERVER['DOCUMENT_ROOT'] . $experience_a_supprimer['photo'];
    if(!empty($experience_a_supprimer['photo']) && file_exists($chemin_photo_a_supprimer)) unlink($chemin_photo_a_supprimer);
    executeRequete("DELETE FROM experience WHERE id=$_GET[id_produit]");
    $contenu .= '<div class="validation">Suppression du produit : ' . $_GET['id_produit'] . '</div>';
    $_GET['action'] = 'affichage';
}
//--- ENREGISTREMENT EXPERIENCES ---//
if($_POST and isset($_POST['ajouterExperience']))
      {
        $result = $mysqli->query("INSERT INTO experience (poste, employeur, duree, info) VALUES ('$_POST[poste]', '$_POST[employeur]', '$_POST[duree]', '$_POST[info]')");
      }

//--- LIENS ---//
$contenu .= '<a href="?action=affichage">Afficher</a><br>';
$contenu .= '<a href="?action=ajout">Ajouter</a><br><br><hr><br>';
//--- AFFICHAGE EXPERIENCES ---//
if(isset($_GET['action']) && $_GET['action'] == "affichage")
{
    $resultat = executeRequete("SELECT * FROM experience");
     
    $contenu .= '<h2> Affichage des Experiences </h2>';
    $contenu .= '<table border="1"><tr>';
     
    while($colonne = $resultat->fetch_field())
    {    
        $contenu .= '<th>' . $colonne->name . '</th>';
    }
    $contenu .= '<th>Modification</th>';
    $contenu .= '<th>Supression</th>';
    $contenu .= '</tr>';
 
    while ($ligne = $resultat->fetch_assoc())
    {
        $contenu .= '<tr>';
        foreach ($ligne as $indice => $information)
        {
            if($indice == "photo")
            {
                $contenu .= '<td><img src="' . $information . '" ="70" height="70"></td>';
            }
            else
            {
                $contenu .= '<td>' . $information . '</td>';
            }
        }
        $contenu .= '<td><a href="?action=modification&id_produit=' . $ligne['id'] .'"><img src="../inc/img/edit.png"></a></td>';
        $contenu .= '<td><a href="?action=suppression&id_produit=' . $ligne['id'] .'" OnClick="return(confirm(\'En êtes vous certain ?\'));"><img src="../inc/img/delete.png"></a></td>';
        $contenu .= '</tr>';
    }
    $contenu .= '</table><br><hr><br>';
}

//--------------------------------- AFFICHAGE HTML ---------------------------------//
echo $contenu;
if(isset($_GET['action']) && $_GET['action'] == "ajout"){
    echo'
    <form method="post">
    <label for="poste">Poste</label><br>
    <input type="text" name="poste" placeholder="poste" id="poste" required=""><br><br>
    <label for="employeur">Employeur</label><br>
    <input type="text" name="employeur" placeholder="employeur" id="employeur" required=""><br><br>
    <label for="duree">Duree</label><br>
    <input type="text" name="duree" placeholder="duree" id="duree" required=""><br><br>
    <label for="info">Description</label><br>
    <input type="text" name="info" placeholder="info" id="info" required=""><br><br>
    <input type="submit" name="ajouterExperience" value="Ajouter experience"><br><br>
    </form>
    ';
}
?>


