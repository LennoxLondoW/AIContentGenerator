<?php
session_start();
require_once '../controlers/paypalControler.php';
require_once '../blades/header.php';
?>

<div class="dashbard">
  <div class="side-nav" id="dashboard-side-nav">
    <?php include '../blades/side_nav.php';  ?>
  </div>

  <div class="main-nav">
    <h1 class="sz-h2 wt-black text-left non_ck text-center" <?php $element->is_editable(current_page_table, 'page_title_phrase', 'text'); ?>><?php echo $page_title_phrase; ?></h1>
    <br>
    <?php
    if ($element->page_editable) {
    ?>
      <?php
      $settings = new App();
      $settings->activeTable = "lentec_paypal_credentials";
      $settings->comparisons = [];
      $settings->joiners = [''];
      $settings->order = " BY id ASC ";
      $settings->cols = "section_id, section_title";
      $settings->limit = 2000;
      $settings->offset = 0;


      ?>
      <div class="edit_div">
        <table>
          <caption>
            <h3>Set Your Paypal Credentials</h3>
          </caption>
          <thead>
            <tr>
              <th>Object</th>
              <th>Data</th>
            </tr>
          </thead>
          <tbody>
            <?php

            foreach ($settings->getData() as $key => $value) {
              echo '<tr>
                          <td >' . ucwords($value['section_id']) . '</td>
                          <td> 
                            <span class="non_ck" ' . $element->is_editable('lentec_paypal_credentials', $value['section_id'], 'text', true) . '>' . $value['section_title'] . '</span>
                          </td>
                      </tr>';
            }
            ?>
          </tbody>
        </table>
      </div>

    <?php
      //pick email settings from table
    }
    ?>


    <form class="common_form bg-yellow" action="<?php echo base_path . "plugins/paypal/charge.php" ?>" method="post" enctype="multipart/form-data">

      <div class="round-holder">
        <img class="round" <?php $element->is_editable(current_page_table, 'image_1', 'image'); ?> src="<?php echo base_path . $image_1; ?>" alt="Paypal">
      </div>


      <div class="form-group">
        <label>Account ID</label>
        <input class="form-control" type="text" name="client_id" value="<?php echo $_SESSION['email']; ?>" readonly />
      </div>

      <div class="form-group">
        <label>Amount</label>
        <input class="form-control" type="text" name="amount" placeholder="1500" />
      </div>

      <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Top Up" />
      </div>
    </form>
  </div>

</div>


<?php
require_once '../blades/footer.php';
?>