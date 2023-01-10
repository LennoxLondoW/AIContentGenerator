<?php
session_start();
require_once '../controlers/documentsControler.php';
require_once '../blades/header.php';
?>
<div class="dashbard">
  <div class="side-nav" id="dashboard-side-nav">
    <?php include '../blades/side_nav.php';  ?>
  </div>

  <div class="main-nav">

    <!-- here is html field to hold instructions -->
    <div class="d_none" id="document_rules"><?php echo $document_rules; ?></div>
    <?php
    if (isset($_SESSION['sub']) && $_SESSION['sub'] === "set") {
    ?>
      <div class="sub_me">
        <a href="<?php echo base_path . 'square_setup'; ?>">Click here to subscribe and get free tokens.</a>
        <a href="<?php echo $_SERVER['REQUEST_URI'] . '/cancel/true';  ?>" class="close">&times;</a>
      </div>
    <?php
    }
    ?>
    <div class="saech_field">
      <form action="<?php echo base_path . 'documents'; ?>" class="search">
        <input type="text" placeholder="Search your documents" name="search" id="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : "";  ?>">
      </form>
    </div><br><br>
    <p style="font-weight: bold;;" <?php $element->is_editable(current_page_table, 'page_title_phrase', 'text'); ?>><?php echo $page_title_phrase; ?></p><br>

    <div class="my_documents">
      <!-- add new document  -->
      <button>
        <a href="<?php echo base_path . 'new_document'; ?>">
          <i class="fa fa-plus fa-5x"></i>
          <p>Add New</p>
        </a>
      </button>
      <?php
      foreach ($documents_data as $value) {
        echo '<button class="ctx">
        <div class="cover">
        <textarea  style="display:none;" id="document_content">' . $value['document_content'] . '</textarea>
        <div class="wrap">
                <span style="border:solid .25px var(--site-primary-color);margin:7px;" class="actions" onclick="download_pdf(`document_content`)">
                   PDF <i class="fa fa-download"></i>
                </span>


                <span style="border:solid .25px var(--site-primary-color);margin:7px;" class="actions" onclick="download_txt(`document_content`)">
                   TXT <i class="fa fa-download"></i>
                </span>

                <span style="border:solid .25px var(--site-primary-color);margin:7px;" class="actions" onclick="download_ms(`document_content`)">
                   MS-WORD <i class="fa fa-download"></i>
                </span>

                <span style="border:solid .25px var(--site-primary-color);margin:7px;" class="actions" onclick="$(this).parents(`.cover`).hide();">
                   close <i class="fa fa-times"></i>
                </span>
        </div>
        
        
        </div>
            <a href="' . base_path . 'view_document/document_id/' . $value['document_id'] . '">
              <i class="fa fa-file fa-5x"></i>
              <p>' . substr($value['document_name'], 0, 15)  . '...</p>
            </a>
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