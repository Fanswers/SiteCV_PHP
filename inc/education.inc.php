    <!-- EDUCATION -->

    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="education">
      <div class="w-100">
        <h2 class="mb-5">Education</h2>

        <?php 

        $result = $mysqli->query("SELECT * FROM education");

        while($education = $result->fetch_assoc()){ ?>
          <div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5">
            <div class="resume-content">
              <h3 class="mb-0"><?php echo "$education[etablissement]"?></h3>
              <div class="subheading mb-3"><?php echo "$education[formation]"?></div>
              <div><?php echo "$education[info]"?></div>
            </div>
            <div class="resume-date text-md-right">
              <span class="text-primary"><?php echo "$education[duree]"?></span>
            </div>
          </div>

          <?php
        }?>
      </div>
    </section>

    <hr class="m-0">