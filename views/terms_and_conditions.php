<?php
session_start();
require_once '../controlers/terms_and_conditionsControler.php';
require_once '../blades/header.php';
?>

<div class="row padding-bottom-4 padding-top-0">
  <div class="column bk-min-12 bk-9-10 bk-9-offset-1  pos--relative ck">
    <div class="privacy listed" <?php $element->is_editable(current_page_table, 'terms_and_conditions', 'text'); ?>><?php echo $terms_and_conditions; ?></div>
  </div>
</div>



<?php
require_once '../blades/footer.php';
?>