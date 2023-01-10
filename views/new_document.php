<?php
session_start();
require_once '../controlers/new_documentControler.php';
require_once '../blades/header.php';
?>



<div class="dashbard">
  <div class="side-nav" id="dashboard-side-nav">
    <?php include '../blades/side_nav.php';  ?>
  </div>
  <div class="main-nav" style="margin-bottom: 300px;">
    <?php
    if ($element->page_editable) {
    ?>
      <p style="font-weight: bold;;">Click to update the title of the page</b><br><br>
      <h1 class="non_ck" <?php $element->is_editable(current_page_table, 'page_title_phrase', 'text'); ?>><?php echo $page_title_phrase; ?></h1><br><br>
      <p style="font-weight: bold;;">Click to update python ai path</b><br><br>
      <p class="non_ck" <?php $element->is_editable(current_page_table, 'python_app', 'text'); ?>><?php echo $python_app; ?></p><br><br>
      <p style="font-weight: bold;;">Please click content below to update your json instrucions.<br> NB: Requires knowledge with json</b><br><br>
      <div style="height: 80vh; min-height:500px!important; overflow-y:auto; padding-bottom:100px;" class="non_ck" <?php $element->is_editable(current_page_table, 'document_rules', 'text'); ?>><?php echo $document_rules; ?></div>
      <br>


    <?php
    } else {

    ?>
      <!-- here is html field to hold instructions -->
      <div class="d_none" id="document_rules"><?php echo $document_rules; ?></div>
      <!-- document craetion field  -->
      <div class="documents">
        <?php
        if (isset($_SESSION['sub']) && $_SESSION['sub'] === "set") {
          ?>
            <div class="sub_me">
              <a href="<?php echo base_path.'square_setup'; ?>">Click here to subscribe and get free tokens.</a>
              <a href="<?php  echo $_SERVER['REQUEST_URI'].'/cancel/true';  ?>" class="close">&times;</a>
            </div>
          <?php
        }
        ?>
        <h1 class="sz-h2 wt-black text-center non_ck" <?php $element->is_editable(current_page_table, 'page_title_phrase', 'text'); ?>><?php echo $page_title_phrase; ?></h1>
        <div class="ai_div" id="ai_div">

        </div>
        <br><br><br><br>
      </div>

    <?php
    }

    ?>

  </div>

</div>

<?php
require_once '../blades/footer.php';
?>