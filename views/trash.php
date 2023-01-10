<?php
session_start();
require_once '../controlers/trashControler.php';
require_once '../blades/header.php';
?>

<div class="dashbard">
  <div class="side-nav" id="dashboard-side-nav">
    <?php include '../blades/side_nav.php';  ?>
  </div>

  <div class="main-nav">

    <!-- here is html field to hold instructions -->
    <div class="d_none" id="document_rules"><?php echo $document_rules; ?></div>
    <div class="saech_field">
      <form action="<?php echo base_path . 'trash'; ?>" class="search trash">
        <input type="text" placeholder="Search trash documents" name="search" id="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : "";  ?>">
      </form>
    </div><br><br>
    <p style="font-weight: bold;;" <?php $element->is_editable(current_page_table, 'page_title_phrase', 'text'); ?>><?php echo $page_title_phrase; ?></p><br>

    <div class="my_documents">
      <?php
      foreach ($documents_data as $value) {
        echo '<button class="bigger">
              <i class="fa fa-file fa-5x"></i>
              <p>' . substr($value['document_name'], 0, 15) . '...</p>
              <p class="spaced">
                <form class="ajax restore" method="post" action="">
                  <input type="hidden" value="' . $value['document_id'] . '" name="restore">
                  <input type="hidden" value="' . csrf_token . '" name="csrf_token">
                  <a href="#" class="butns restore">Restore</a></p>
                </form>
              <p>
              
              <p class="spaced">
                <form class="ajax delete" method="post" action="">
                  <input type="hidden" value="' . $value['document_id'] . '" name="delete">
                  <input type="hidden" value="' . csrf_token . '" name="csrf_token">
                  <a href="#" class="butns delete">Delete</a>
                </form>
              </p>


              
        </button>';
      }

      if (count($documents_data) === 0) {
        echo "<br><br><br><br><br><br><br><div class='text-center' style='width: 600px; margin:auto; max-width:96%; padding:20px; color: var(--site-secondary-color);'>Sorry! There is nothing here!</div>";
      }

      ?>
    </div>
  </div>

</div>


<?php
require_once '../blades/footer.php';
?>