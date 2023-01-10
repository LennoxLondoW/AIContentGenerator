<div class="hambuger">
  <a href="#" onclick="toggle_nav()"><i class="fa fa-bars"></i></a>
</div>
<div id="child">
 
  <!-- <div class="side-logo">
    <img <?php $element->is_editable(current_page_table, current_page_table, 'image'); ?> src="<?php echo base_path . $GLOBALS[current_page_table]; ?>" alt="logo">
  </div> -->

  <ul class="links">
    <li><a href="<?php echo base_path; ?>documents"><i class="fa fa-file"></i> Documents</a></li>
    <li><a href="<?php echo base_path; ?>trash"><i class="fa fa-trash"></i> Trash</a></li>
    <li><a href="<?php echo base_path; ?>my_account"><i class="fa fa-user"></i> Account</a></li>
    <li><a href="<?php echo base_path; ?>subscribe"><i class="fa fa-credit-card"></i> Purchase</a></li>
    <li><a href="<?php echo base_path; ?>purchase"><i class="fa fa-dollar"></i> Top Up</a></li>
  </ul>

  <ul class="links bottom-links">
    <li><a href="<?php echo base_path; ?>contact"><i class="fa fa-exclamation-circle"></i> Support</a></li>
    <li><a href="<?php echo base_path; ?>change_password"><i class="fa fa-cog"></i> Settings</a></li>
    <li><a class="non_spa" href="<?php echo base_path; ?>home/logout/true"><i class="fa fa-sign-out"></i> Logout</a></li>
  </ul>
</div>