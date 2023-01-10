<?php
session_start();
require_once '../controlers/square_paymentControler.php';
require_once '../blades/header.php';
?>

<div class="row padding-bottom-4 padding-top-0">
  <div class="column bk-min-12 bk-9-10 bk-9-offset-1   pos--relative ck">
    <!-- here is where card data is collected, users are not necessarily charged  -->
    <?php include  '../plugins/square/include_files/card_pay.php'; ?>
  </div>
</div>


<?php
require_once '../blades/footer.php';
?>