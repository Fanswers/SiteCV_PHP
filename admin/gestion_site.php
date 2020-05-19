<?php
require_once("../inc/init.inc.php");

//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if(!internauteEstConnecteEtEstAdmin()) header("location:../index.php");

//--- SUPPRESSION TABLES ---//
if(isset($_GET['action']) && $_GET['action'] == "suppressionExperience")
{   
    executeRequete("DELETE FROM experience WHERE id=$_GET[id_produit]");
    $contenu .= '<div class="validation">Suppression experience : ' . $_GET['id_produit'] . '</div>';
    $_GET['action'] = 'affichage';
}
elseif(isset($_GET['action']) && $_GET['action'] == "suppressionEducation")
{   
    executeRequete("DELETE FROM education WHERE id=$_GET[id_produit]");
    $contenu .= '<div class="validation">Suppression education : ' . $_GET['id_produit'] . '</div>';
    $_GET['action'] = 'affichage';
}
elseif(isset($_GET['action']) && $_GET['action'] == "suppressionSkill")
{   
    executeRequete("DELETE FROM skills WHERE id=$_GET[id_produit]");
    $contenu .= '<div class="validation">Suppression skill : ' . $_GET['id_produit'] . '</div>';
    $_GET['action'] = 'affichage';
}
elseif(isset($_GET['action']) && $_GET['action'] == "suppressionInterest")
{   
    executeRequete("DELETE FROM interest WHERE id=$_GET[id_produit]");
    $contenu .= '<div class="validation">Suppression interest : ' . $_GET['id_produit'] . '</div>';
    $_GET['action'] = 'affichage';
}
elseif(isset($_GET['action']) && $_GET['action'] == "suppressionAwards")
{   
    executeRequete("DELETE FROM awards WHERE id=$_GET[id_produit]");
    $contenu .= '<div class="validation">Suppression award : ' . $_GET['id_produit'] . '</div>';
    $_GET['action'] = 'affichage';
} //--- MODIFICATION TABLES ---//
elseif($_POST and isset($_POST['validModifExperience']))
{
    executeRequete("UPDATE experience SET poste='$_POST[poste]', employeur='$_POST[employeur]', duree='$_POST[duree]', info='$_POST[info]' WHERE id=$_GET[id_produit]");
}
elseif($_POST and isset($_POST['validModifEducation']))
{
    executeRequete("UPDATE education SET etablissement='$_POST[etablissement]',formation='$_POST[formation]', duree='$_POST[duree]', info='$_POST[info]' WHERE id=$_GET[id_produit]");
}
elseif($_POST and isset($_POST['validModifSkill']))
{
    executeRequete("UPDATE skills SET info='$_POST[info]' WHERE id=$_GET[id_produit]");
}
elseif($_POST and isset($_POST['validModifInterest']))
{
    executeRequete("UPDATE interest SET info='$_POST[info]' WHERE id=$_GET[id_produit]");
}
elseif($_POST and isset($_POST['validModifAwards']))
{
    executeRequete("UPDATE awards SET info='$_POST[info]' WHERE id=$_GET[id_produit]");
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
elseif($_POST and isset($_POST['ajouterInterest']))
    {
        $result = $mysqli->query("INSERT INTO interest (info) VALUES ('$_POST[info]')");
    }
elseif($_POST and isset($_POST['ajouterAwards']))
    {
        $result = $mysqli->query("INSERT INTO awards (info) VALUES ('$_POST[info]')");
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
        $contenu .= '<td><a href="?action=modificationExperience&id_produit=' . $ligne['id'] .'">Modifier';
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
        $contenu .= '<td><a href="?action=modificationEducation&id_produit=' . $ligne['id'] .'">Modifier';
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
        $contenu .= '<td><a href="?action=modificationSkill&id_produit=' . $ligne['id'] .'">Modifier';
        $contenu .= '<td><a href="?action=suppressionSkill&id_produit=' . $ligne['id'] .'" OnClick="return(confirm(\'En êtes vous certain ?\'));">Supprimer';
        $contenu .= '</tr>';
    }
    $contenu .= '</table><br><hr><br>';

    //-- Interests --//
    $resultat = executeRequete("SELECT * FROM interest");
     
    $contenu .= '<h2> Interests </h2>';
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
        $contenu .= '<td><a href="?action=modificationInterest&id_produit=' . $ligne['id'] .'">Modifier';
        $contenu .= '<td><a href="?action=suppressionInterest&id_produit=' . $ligne['id'] .'" OnClick="return(confirm(\'En êtes vous certain ?\'));">Supprimer';
        $contenu .= '</tr>';
    }
    $contenu .= '</table><br><hr><br>';

    //-- Awards --//
    $resultat = executeRequete("SELECT * FROM awards");
     
    $contenu .= '<h2> Awards </h2>';
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
        $contenu .= '<td><a href="?action=modificationAwards&id_produit=' . $ligne['id'] .'">Modifier';
        $contenu .= '<td><a href="?action=suppressionAwards&id_produit=' . $ligne['id'] .'" OnClick="return(confirm(\'En êtes vous certain ?\'));">Supprimer';
        $contenu .= '</tr>';
    }
    $contenu .= '</table><br><hr><br>';
}


//--------------------------------- FORMULAIRE Ajouter ---------------------------------//
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

    <h2>INTERESTS</h2>
    <form method="post">
    <lable for="info">Info</label><br>
    <input type="text" name="info" placeholder="info" id="info" required=""><br><br>
    <input type="submit" name="ajouterInterest" value="Ajouter interest"><br><br>
    </form>

    <h2>AWARDS</h2>
    <form method="post">
    <lable for="info">Info</label><br>
    <input type="text" name="info" placeholder="info" id="info" required=""><br><br>
    <input type="submit" name="ajouterAwards" value="Ajouter award"><br><br>
    </form>
    ';
}//--- FORMULAIRE Modifier ---//
elseif(isset($_GET['action']) && $_GET['action'] == "modificationExperience"){
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
    <input type="submit" name="validModifExperience" value="Modifier experience"><br><br>
    </form>';
}
elseif(isset($_GET['action']) && $_GET['action'] == "modificationEducation"){
    echo'
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
    <input type="submit" name="validModifEducation" value="Modifier education"><br><br>
    </form>';
}
elseif(isset($_GET['action']) && $_GET['action'] == "modificationSkill"){
    echo'
    <h2>SKILLS</h2>
    <form method="post">
    <label for="info">Info</label><br>
    <input type="text" name="info" placeholder="info" id="info" required=""><br><br>
    <input type="submit" name="validModifSkill" value="Modifier skill"><br><br>
    </form>
    ';
}
elseif(isset($_GET['action']) && $_GET['action'] == "modificationInterest"){
    echo'
    <h2>INTERESTS</h2>
    <form method="post">
    <lable for="info">Info</label><br>
    <input type="text" name="info" placeholder="info" id="info" required=""><br><br>
    <input type="submit" name="validModifInterest" value="Ajouter interest"><br><br>
    </form>
    ';
}
elseif(isset($_GET['action']) && $_GET['action'] == "modificationAwards"){
    echo'
    <h2>AWARDS</h2>
    <form method="post">
    <lable for="info">Info</label><br>
    <input type="text" name="info" placeholder="info" id="info" required=""><br><br>
    <input type="submit" name="validModifAwards" value="Ajouter interest"><br><br>
    </form>
    ';
}
?>

