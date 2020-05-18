<?php
require_once("../inc/init.inc.php");

//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if(!internauteEstConnecteEtEstAdmin()) header("location:../index.php");

//--- SUPPRESSION TABLES ---//
if(isset($_GET['action']) && $_GET['action'] == "suppressionExperience")
{   // $contenu .= $_GET['id_produit']
    $resultat = executeRequete("SELECT * FROM experience WHERE id=$_GET[id_produit]");
    $experience_a_supprimer = $resultat->fetch_assoc();
    if(!empty($experience_a_supprimer['photo']) && file_exists($chemin_photo_a_supprimer)) unlink($chemin_photo_a_supprimer);
    executeRequete("DELETE FROM experience WHERE id=$_GET[id_produit]");
    $contenu .= '<div class="validation">Suppression du produit : ' . $_GET['id_produit'] . '</div>';
    $_GET['action'] = 'affichage';
}
elseif(isset($_GET['action']) && $_GET['action'] == "suppressionEducation")
{   // $contenu .= $_GET['id_produit']
    $resultat = executeRequete("SELECT * FROM education WHERE id=$_GET[id_produit]");
    $education_a_supprimer = $resultat->fetch_assoc();
    if(!empty($education_a_supprimer['photo']) && file_exists($chemin_photo_a_supprimer)) unlink($chemin_photo_a_supprimer);
    executeRequete("DELETE FROM education WHERE id=$_GET[id_produit]");
    $contenu .= '<div class="validation">Suppression du produit : ' . $_GET['id_produit'] . '</div>';
    $_GET['action'] = 'affichage';
}
elseif(isset($_GET['action']) && $_GET['action'] == "suppressionSkill")
{   // $contenu .= $_GET['id_produit']
    $resultat = executeRequete("SELECT * FROM skills WHERE id=$_GET[id_produit]");
    $skill_a_supprimer = $resultat->fetch_assoc();
    if(!empty($skill_a_supprimer['photo']) && file_exists($chemin_photo_a_supprimer)) unlink($chemin_photo_a_supprimer);
    executeRequete("DELETE FROM skills WHERE id=$_GET[id_produit]");
    $contenu .= '<div class="validation">Suppression du produit : ' . $_GET['id_produit'] . '</div>';
    $_GET['action'] = 'affichage';
}


//--- ENREGISTREMENT TABLES ---//
if($_POST and isset($_POST['ajouterExperience']))
      {
        $result = $mysqli->query("INSERT INTO experience (poste, employeur, duree, info) VALUES ('$_POST[poste]', '$_POST[employeur]', '$_POST[duree]', '$_POST[info]')");
      }
elseif($_POST and isset($_POST['ajouterEducation']))
      {
        $result = $mysqli->query("INSERT INTO education (etablissement, formation, duree, info) VALUES ('$_POST[etablissement]', '$_POST[formation]', '$_POST[duree]', '$_POST[info]')");
      }
elseif($_POST and isset($_POST['ajouterSkill']))
      {
        $result = $mysqli->query("INSERT INTO skills (info) VALUES ('$_POST[info]')");
      }



//--- LIENS ---//
$contenu .= '<a href="?action=affichage">Afficher</a><br>';
$contenu .= '<a href="?action=ajout">Ajouter</a><br><br><hr><br>';


//--- AFFICHAGE DES TABLES ---//
if(isset($_GET['action']) && $_GET['action'] == "affichage")
{
    //-- Experiences --//
    $resultat = executeRequete("SELECT * FROM experience");
     
    $contenu .= '<h2> Experiences </h2>';
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
        $contenu .= '<td><a href="?action=modificationExperience&id_produit=' . $ligne['id'] .'"><img src="../inc/img/edit.png"></a></td>';
        $contenu .= '<td><a href="?action=suppressionExperience&id_produit=' . $ligne['id'] .'" OnClick="return(confirm(\'En êtes vous certain ?\'));">Supprimer';
        $contenu .= '</tr>';
    }
    $contenu .= '</table><br><hr><br>';

    //-- Education --//
    $resultat = executeRequete("SELECT * FROM education");
     
    $contenu .= '<h2> Education </h2>';
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
        $contenu .= '<td><a href="?action=modificationEducation&id_produit=' . $ligne['id'] .'"><img src="../inc/img/edit.png"></a></td>';
        $contenu .= '<td><a href="?action=suppressionEducation&id_produit=' . $ligne['id'] .'" OnClick="return(confirm(\'En êtes vous certain ?\'));">Supprimer';
        $contenu .= '</tr>';
    }
    $contenu .= '</table><br><hr><br>';

    //-- Skills --//
    $resultat = executeRequete("SELECT * FROM skills");
     
    $contenu .= '<h2> Skills </h2>';
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
        $contenu .= '<td><a href="?action=modificationSkill&id_produit=' . $ligne['id'] .'"><img src="../inc/img/edit.png"></a></td>';
        $contenu .= '<td><a href="?action=suppressionSkill&id_produit=' . $ligne['id'] .'" OnClick="return(confirm(\'En êtes vous certain ?\'));">Supprimer';
        $contenu .= '</tr>';
    }
    $contenu .= '</table><br><hr><br>';
}


//--------------------------------- AFFICHAGE HTML ---------------------------------//
echo $contenu;
if(isset($_GET['action']) && $_GET['action'] == "ajout"){
    echo'
    <h2>EXPERIENCES</h2>
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

    <h2>EDUCATION</h2>
    <form method="post">
    <label for="etablissement">Etablissement</label><br>
    <input type="text" name="etablissement" placeholder="etablissement" id="etablissement" required=""><br><br>
    <label for="formation">Formation</label><br>
    <input type="text" name="formation" placeholder="formation" id="formation" required=""><br><br>
    <label for="duree">Duree</label><br>
    <input type="text" name="duree" placeholder="duree" id="duree" required=""><br><br>
    <label for="info">Description</label><br>
    <input type="text" name="info" placeholder="info" id="info" required=""><br><br>
    <input type="submit" name="ajouterEducation" value="Ajouter education"><br><br>
    </form>

    <h2>SKILLS</h2>
    <form method="post">
    <label for="info">Info</label><br>
    <input type="text" name="info" placeholder="info" id="info" required=""><br><br>
    <input type="submit" name="ajouterSkill" value="Ajouter skill"><br><br>
    </form>
    ';
}
?>


