<div class="container-fluid p-0">




<!-- ABOUT -->

<?php

//-----------------------------------------------------------------
// Affichage (SELECT) :
$result = $mysqli->query("SELECT * FROM profil WHERE prenom='Alexis'");
$profil = $result->fetch_assoc(); 
//-----------------------------------------------------------------
?>

<section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="about">
  <div class="w-100">
    <h1 class="mb-0"><?php echo "$profil[nom]";?>
      <span class="text-primary"><?php echo "$profil[prenom]";?></span>
    </h1>
    <div class="subheading mb-5"><?php echo "$profil[adresse]";?>
      <a href="mailto:name@email.com"><?php echo "$profil[mail]";?></a>
    </div>
    <p class="lead mb-5"><?php echo "$profil[description]";?></p>
    <div class="social-icons">
      <a href="#">
        <i class="fab fa-linkedin-in"></i>
      </a>
      <a href="#">
        <i class="fab fa-github"></i>
      </a>
      <a href="#">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="#">
        <i class="fab fa-facebook-f"></i>
      </a>
    </div>
  </div>
</section>

<hr class="m-0">