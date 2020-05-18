    <!-- SKILLS -->

    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="skills">
      <div class="w-100">
        <h2 class="mb-5">Skills</h2>

        <?php 

        $result = $mysqli->query("SELECT * FROM education");

        while($education = $result->fetch_assoc()){ ?>
        <ul class="fa-ul mb-0">
          <li>
            <i class="fa-li fa fa-check"></i>
            <?php echo "$education[info]"?>
          </li>
        </ul><?php
        }?>

      </div>
    </section>

    <hr class="m-0">