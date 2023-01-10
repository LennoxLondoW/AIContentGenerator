<?php
session_start();
require_once '../controlers/purchaseControler.php';
require_once '../blades/header.php';
?>

<div class="dashbard">
  <div class="side-nav" id="dashboard-side-nav">
    <?php include '../blades/side_nav.php';  ?>
  </div>

  <div class="main-nav">
    <h1 class="sz-h2 wt-black text-left non_ck" <?php $element->is_editable(current_page_table, 'page_title_phrase', 'text'); ?>><?php echo $page_title_phrase; ?></h1>
    <br>
    <div class="payment_cards">
      <button class="pay_card">
        <a href="<?php echo base_path . 'paypal'; ?>">
          <img <?php $element->is_editable(current_page_table, 'image_1', 'image'); ?> src="<?php echo base_path . $image_1; ?>" alt="Paypal">
          <p>Paypal</p>
        </a>
      </button>


      <button class="pay_card">
        <a href="<?php echo base_path . 'square_payments'; ?>">
          <img <?php $element->is_editable(current_page_table, 'image_2', 'image'); ?> src="<?php echo base_path . $image_2; ?>" alt="square">
          <p>Credit Card</p>
        </a>
      </button>
    </div>
  </div>

</div>


<?php
require_once '../blades/footer.php';
?>