<?php
session_start();
require_once '../controlers/donateControler.php';
require_once '../blades/header.php';
?>

<div class="container ck">
  <h1  <?php $element->is_editable(current_page_table, 'page_title_phrase', 'text'); ?>><?php echo $page_title_phrase; ?></h1>
  <div style="min-height:70vh; padding:50px 20px;">
    <div <?php $element->is_editable(current_page_table, 'page_text_phrase', 'text'); ?>><?php echo $page_text_phrase; ?></div>
  </div>
</div>


<?php
require_once '../blades/footer.php';
?>

