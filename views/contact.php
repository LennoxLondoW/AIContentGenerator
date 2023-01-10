<?php
session_start();
require_once '../controlers/contactControler.php';
require_once '../blades/header.php';
?>



<div class="contact-section">
  <h1 class="non_ck" <?php $element->is_editable(current_page_table, 'contact_title', 'text'); ?>><?php echo $contact_title; ?></h1>
  <p>
    <span <?php $element->is_editable(current_page_table, 'contact_text', 'text'); ?>><?php echo $contact_text; ?></span><br>
    <span <?php $element->is_editable(current_page_table, 'contact_email', 'text'); ?>><?php echo $contact_email; ?></span>:
    <span <?php $element->is_editable(current_page_table, 'contact_email_address', 'text'); ?>><?php echo $contact_email_address; ?></span>
  </p>

  <?php
  if ($element->page_editable) {
  ?>
    <h3 class="mb-sm-4 mb-3">Update Email</h3>
    <?php
    //pick email settings from table
    $settings = new App();
    $settings->activeTable = "lentec_email_settings";
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
          <h3>Set Your Emails</h3>
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
                              <td >' . ucwords(str_replace("email_", " ", $value['section_id'])) . '</td>
                              <td> 
                              ' . ($value['section_id'] === 'email_company_logo' ?
              '<img style="height:30px; object-fit:contain;" src="' . base_path . $value['section_title'] . '" alt="logo" ' . $element->is_editable('email_settings', $value['section_id'], 'image', true) . '>' :
              '<span class="non_ck" ' . $element->is_editable('email_settings', $value['section_id'], 'text', true) . '>' . $value['section_title'] . '</span>'
            ) . '
                            </td>
                        </tr>';
          }
          ?>


        </tbody>
      </table>
      <button class="preview" onclick="Swal.fire({html: `<br><br><iframe style='width:90%; height:80vh; border:none; outline:none;' src='<?php echo base_path; ?>contact/preview/true'></iframe>`,customClass:'swal-wide'})" class='sc_button sc_button_default sc_button_size_normal sc_button_icon_left preview'>Preview
        Template</button>
    </div>

  <?php
    //pick email settings from table
  } else {
  ?>

    <form action="contact.php" method="post" class="ajax common_form">
      <label for="ask_name">Name:</label><br>
      <input type="text" id="name" name="ask_name"><br>
      <label for="ask_email">Email:</label><br>
      <input type="text" id="email" name="ask_email"><br>

      <label for="ask_tel">Telephone:</label><br>
      <input type="tel" id="ask_tel" name="ask_tel"><br>

      <label for="ask_subject">Subject:</label><br>
      <input type="text" id="subject" name="ask_subject"><br>

      <label for="ask_message">Message:</label><br>
      <textarea id="message" name="ask_message" rows="5" cols="50"></textarea><br><br>
      <div class="form-group">
        <input type="hidden" name="ask_date" readonly="" value="<?php echo date("Ymd"); ?>">
        <input type="hidden" name="ask_admin_email" readonly="" value="<?php echo $contact_email_address;  ?>">
        <input type="hidden" name="csrf_token" readonly="" value="<?php echo csrf_token;  ?>">
      </div>
      <button type="submit">Send</button>
    </form>
</div>
<?php
  }
?>
</div>
</div>



<?php
require_once '../blades/footer.php';
?>