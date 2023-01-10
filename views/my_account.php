<?php
session_start();
require_once '../controlers/my_accountControler.php';
require_once '../blades/header.php';



function abreviate($value, $p=1)
{
  if ($value >=  1000000000000) {
    $value = round($value / 1000000000000, $p) . "T";
  } elseif ($value >=  1000000000) {
    $value = round($value / 1000000000, $p) . "B";
  } elseif ($value >=  1000000) {
    $value = round($value / 1000000, $p) . "M";
  } elseif ($value >=  1000) {
    $value = round($value / 1000, $p) . "K";
  }

  return $value;
}

?>


<div class="dashbard">
  <div class="side-nav" id="dashboard-side-nav">
    <?php include '../blades/side_nav.php';  ?>
  </div>

  <div class="main-nav">
    <h1 class="sz-h2 wt-black text-left non_ck text-center" <?php $element->is_editable(current_page_table, 'page_title_phrase', 'text'); ?>><?php echo $page_title_phrase; ?></h1>
    <div class="labels">

      

      <button class="label">
        <a href="<?php echo base_path . "subscribe"; ?>">
          <p class="t" <?php $element->is_editable(current_page_table, 'page_title_phrase2', 'text'); ?>><?php echo $page_title_phrase2; ?></p>
          <span><i class="fa fa-bolt"></i></span> <i class="fa  fa-3x"><?php echo abreviate($tokens);   ?></i>
        </a>
      </button>

      <button class="label">
        <a href="<?php echo base_path . "subscribe"; ?>">
          <p class="t" <?php $element->is_editable(current_page_table, 'page_title_phrase2a', 'text'); ?>><?php echo $page_title_phrase2a; ?></p>
          <span><i class="fa fa-bolt"></i></span> <i class="fa  fa-3x"><?php echo abreviate($tokens * 0.75 , 0);   ?></i>
        </a>
      </button>

      <button class="label">
        <a href="<?php echo base_path . "documents"; ?>">
          <p class="t" <?php $element->is_editable(current_page_table, 'page_title_phrase3', 'text'); ?>><?php echo $page_title_phrase3; ?></p>
          <span><i class="fa fa-file"></i></span> <i class="fa  fa-3x"><?php echo abreviate($my_documents);   ?></i>
        </a>
      </button>

      <button class="label">
        <a href="<?php echo base_path . "trash"; ?>">
          <p class="t" <?php $element->is_editable(current_page_table, 'page_title_phrase4', 'text'); ?>><?php echo $page_title_phrase4; ?></p>
          <span><i class="fa fa-trash"></i></span> <i class="fa  fa-3x"><?php echo abreviate($trash);   ?></i>
        </a>
      </button>

      <button class="label">
        <a href="<?php echo base_path . "purchase"; ?>">
          <p class="t" <?php $element->is_editable(current_page_table, 'page_title_phrase1', 'text'); ?>><?php echo $page_title_phrase1; ?></p>
          <span><i class="fa fa-dollar"></i></span> <i class="fa  fa-3x"><?php echo abreviate($balance);   ?></i>
        </a>
      </button>

      <style>
        .l table {
          width: 100%;
          border-collapse: collapse;
          background: var(--site-secondary-color);
          color: var(--site-tertiary-color);
        }

        .l table th,
        .l table td {
          padding: 15px;
          border: solid .25px var(--site-tertiary-color);
        }

        .l h3 {
          margin: 30px auto;
          color: var(--site-secondary-color);
          font-weight: 600;
        }
      </style>

      <div class="l">
        <h3 class="non_ck" <?php $element->is_editable(current_page_table, 'page_title_phrase4_5', 'text'); ?>><?php echo $page_title_phrase4_5; ?></h3>
        <table>
          <thead>
            <tr>
              <th class="non_ck" <?php $element->is_editable(current_page_table, 'page_title_phrase4_6', 'text'); ?>><?php echo $page_title_phrase4_6; ?></th>
              <th class="non_ck" <?php $element->is_editable(current_page_table, 'page_title_phrase4_7', 'text'); ?>><?php echo $page_title_phrase4_7; ?></th>
            </tr>
          </thead>
          <tbody>
            <?php

            foreach ($active_subscription as $key => $value) {
              echo "<tr><td>" . $value['tokens'] . "</td> <td>" . $value['expire'] . "</td></tr>";
            }

            ?>
          </tbody>
        </table>
        <br><br><br>
      </div>

    </div>
  </div>

</div>



<?php
require_once '../blades/footer.php';
?>