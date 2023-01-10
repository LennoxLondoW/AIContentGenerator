<?php
session_start();
require_once '../controlers/view_documentControler.php';
require_once '../blades/header.php';


?>
<div class="dashbard">
  <div class="side-nav" id="dashboard-side-nav">
    <?php include '../blades/side_nav.php';  ?>
  </div>
  <div class="main-nav" style="margin-bottom: 300px;">
    <?php
    if (!$document_id) {
    ?>
      <!-- 404 document    -->
      <div class="_404"><?php echo $document_content; ?></div>
    <?php
    } else {

    ?>
      <!-- document craetion field  -->
      <div class="documents">
        <div class="ai_div" id="ai_div">
          <h1 class="sz-h2 wt-black text-left non_ck"><?php echo ucfirst($document_name); ?></h1>
          <div class='output'>
            <p style="font-weight: bold;;" <?php $element->is_editable(current_page_table, 'content1', 'text'); ?>><?php echo $content1; ?></p>
            <form id="copyText" class="multiline ai_cont ajax" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
              <textarea required style='background:inherit; color:inherit;border:solid .25px var(--site-primary-color);height:400px; outline:none;margin-top:-30px;' class="text_area" name='document_content' id="document_content"><?php echo $document_content; ?></textarea>
              <input type='hidden' readonly name='document_id' value="<?php echo $document_id; ?>">
              <input type="hidden" value="<?php echo csrf_token; ?>" name="csrf_token">
              <input type="hidden" value="<?php echo $document_name; ?>" name="document_name_prev">
              <p style="font-weight: bold;margin-top:-50px;" <?php $element->is_editable(current_page_table, 'content2', 'text'); ?>><?php echo $content2; ?></p>
              <input type='text' required name='document_name' value='<?php echo $document_name; ?>' style='background:inherit;margin-top:-20px; color:inherit;border:solid .25px var(--site-primary-color);'>
              <input type='submit' value='Save Changes' class="submit" name='edit_and_save'>
            </form><br>

            <p><small>
                <button style="border:solid .25px var(--site-primary-color);margin:7px;" class="actions" onclick="copy_text()">
                  Copy Text <i class="fa fa-copy"></i>
                </button>

                <button style="border:solid .25px var(--site-primary-color);margin:7px;" class="actions" onclick="download_pdf('document_content')">
                  Download PDF <i class="fa fa-download"></i>
                </button>


                <button style="border:solid .25px var(--site-primary-color);margin:7px;" class="actions" onclick="download_txt('document_content')">
                  Download TXT <i class="fa fa-download"></i>
                </button>

                <button style="border:solid .25px var(--site-primary-color);margin:7px;" class="actions" onclick="download_ms('document_content')">
                  Download MS-WORD <i class="fa fa-download"></i>
                </button>


                <button style="border:solid .25px var(--site-primary-color);margin:7px;" class="actions relocator2" href="#more">
                  More <i class="fa fa-ellipsis-h"></i>
                </button>
              </small>
            </p><br>

          </div>


          <div class='output'>
            <p style="font-weight: bold;;" <?php $element->is_editable(current_page_table, 'content3', 'text'); ?>><?php echo $content3; ?></p>
            <p><small <?php $element->is_editable(current_page_table, 'content4', 'text'); ?>><?php echo $content4; ?></small></p><br><br>
            <!-- edit form  -->
            <form action="<?php echo base_path . "new_document"; ?>" method="post" class="ajax">
              <textarea style='background:inherit; color:inherit;border:solid .25px var(--site-primary-color);' class="text_area" name='genetator_instructions'><?php echo $document_question; ?></textarea><br><br>
              <input type='hidden' readonly name='document_name' value="<?php echo $document_name; ?>">
              <input type='hidden' readonly name='update_document' value="update_document">
              <input type="hidden" value="<?php echo csrf_token; ?>" name="csrf_token">
              <label id="more">Finish reason: <?php echo $finish_reason; ?> </label><br><br>
              <label id="more">Tokens Used: <?php echo $total_tokens; ?></label><br><br>
              <label id="more" class="non_ck" <?php $element->is_editable(current_page_table, 'content45', 'text'); ?>><?php echo $content45; ?></label><br><br>
              <input type='number' min='0' required name='tokens' value='<?php echo $tokens; ?>' style='background:inherit;  color:inherit;border:solid .25px var(--site-primary-color);'>
              <br>
              <input type='submit' value='Regenerate' class="submit" name='generate'>
            </form><br>
            <!-- delete form  -->
            <form action="" method="post" class="ajax" >
              <input type='hidden' readonly name='document_id' value="<?php echo $document_id; ?>">
              <input type="hidden" value="<?php echo csrf_token; ?>" name="csrf_token">
              <input type='submit' value='Delete' class="submit delete" name='delete'>
            </form><br>

            <!-- duplicating  -->
            <form action="" method="post" class="ajax" >
              <input type='hidden' readonly name='document_id' value="<?php echo $document_id; ?>">
              <input type="hidden" value="<?php echo csrf_token; ?>" name="csrf_token">
              <input type='submit' value='Duplicate Document' class="submit" name='duplicate'>
            </form>
          </div>


        </div>
      </div>

      <br><br>

    <?php
    }

    ?>

  </div>

</div>




<?php
require_once '../blades/footer.php';
?>