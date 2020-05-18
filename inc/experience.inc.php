    <!-- EXPERIENCE -->

    <section class="resume-section p-3 p-lg-5 d-flex justify-content-center" id="experience">
      <div class="w-100">
        <h2 class="mb-5">Experience</h2>

        <?php 

        // Affichage (SELECT) :
        $result = $mysqli->query("SELECT * FROM experience");
        while($experience = $result->fetch_assoc()){ ?>
          <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5">
            <div class="resume-content">
              <h3 class="mb-0"><?php echo "$experience[poste]"?></h3>
              <div class="subheading mb-3"><?php echo "$experience[employeur]"?></div>
              <p><?php echo "$experience[info]"?></p>
            </div>
            <div class="resume-date text-md-right">
              <span class="text-primary"><?php echo "$experience[duree]"?></span>
            </div>
          </div>

          <?php
        }?>
      </div>

      <?php
      if($_POST and isset($_POST['ajouter']))
      {
        $result = $mysqli->query("INSERT INTO experience (poste, employeur, duree, info) VALUES ('$_POST[poste]', '$_POST[employeur]', '$_POST[duree]', '$_POST[info]')");
      }
      ?>
 
      <form method="post">
        <label for="poste">Poste</label><br>
        <input type="text" name="poste" placeholder="poste" id="poste" required=""><br><br>
        <label for="employeur">Employeur</label><br>
        <input type="text" name="employeur" placeholder="employeur" id="employeur" required=""><br><br>
        <label for="duree">Duree</label><br>
        <input type="text" name="duree" placeholder="duree" id="duree" required=""><br><br>
        <label for="info">Description</label><br>
        <input type="text" name="info" placeholder="info" id="info" required=""><br><br>
        <input type="submit" name="ajouter" value="Ajouter experience"><br><br>
      </form>



    </section>

    <hr class="m-0">