<?php
session_start();
require_once '../controlers/aboutControler.php';
require_once '../blades/header.php';
?>

<div class="row padding-bottom-4 padding-top-0">
  <div class="column bk-min-12 bk-9-10 bk-9-offset-1   pos--relative ck">
    <h4 class="sz-h2 wt-black padding-bottom-3 bk-7-padding-bottom-4 non_ck" <?php $element->is_editable(current_page_table, 'title', 'text'); ?>><?php echo $title; ?></h4>
    <div class="listed" <?php $element->is_editable(current_page_table, 'content', 'text'); ?>><?php echo $content; ?></div>
  </div>
</div>


<?php
require_once '../blades/footer.php';
?>