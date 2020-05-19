    <!-- INTERESTS -->

    <section class="resume-section p-3 p-lg-5 d-flex align-items-center" id="interests">
      <div class="w-100">
        <h2 class="mb-5">Interests</h2>

        <?php 

        $result = $mysqli->query("SELECT * FROM interest");

        while($interest = $result->fetch_assoc()){ ?>
        <ul class="fa-ul mb-0">
          <li>
            <i class="fa-li fa fa-check"></i>
            <?php echo "$interest[info]"?>
          </li>
        </ul><?php
        }?>
      </div>
    </section>

    <hr class="m-0">