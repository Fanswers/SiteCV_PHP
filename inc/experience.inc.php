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
              <p><?php echo "$experience[description]"?></p>
            </div>
            <div class="resume-date text-md-right">
              <span class="text-primary"><?php echo "$experience[duree]"?></span>
            </div>
          </div>
          <?php
        }?>
      </div>

    </section>

    <hr class="m-0">