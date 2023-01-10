<?php
session_start();
require_once '../controlers/subscribeControler.php';
require_once '../blades/header.php';

?>

<div class="dashbard">
  <div class="side-nav" id="dashboard-side-nav">
    <?php include '../blades/side_nav.php';  ?>
  </div>

  <div class="main-nav">
    <h1 class="sz-h2 wt-black text-left non_ck text-center" <?php $element->is_editable(current_page_table, 'page_title_phrase', 'text'); ?>><?php echo $page_title_phrase; ?></h1>

    <?php
    if ($element->page_editable) {
    ?>
      <br><br>
      <p class="text-center">Customize free trial tokens awarded for every user</p>
      <p class="text-center bold fa-3x" <?php $element->is_editable('subscribe', 'free_tokens', 'text'); ?>><?php echo $free_tokens; ?></p>
      <p class="text-center">How many days should free tokens last?</p>
      <p class="text-center bold fa-3x" <?php $element->is_editable('subscribe', 'free_tokens_last', 'text'); ?>><?php echo $free_tokens_last; ?></p>


    <?php
    }
    ?>


    <div class="row home__pricing pricing-cards-section padding-top-2">
      <div class="column bk-min-12 bk-5-offset-1 bk-5-10 bk-7-8 bk-7-offset-2 bk-11-4 bk-11-offset-0">
        <h4 class="pricing-title small-padding-bottom-4 non_ck" <?php $element->is_editable(current_page_table, 'home_text_40', 'text'); ?>><?php echo $home_text_40; ?></h4>
        <div class="pricing-card">

          <div class="pricing-card__price  sml">
            $<span class="non_ck" <?php $element->is_editable(current_page_table, 'cheapest_plan', 'text'); ?>><?php echo $cheapest_plan; ?></span>
          </div>
          <p class="pricing-card__per-month">
            per
          </p>

          <div class="text-center non_ck fa-2x" <?php $element->is_editable(current_page_table, 'home_text_444', 'text'); ?>><?php echo $home_text_444; ?></div>
          
          <p class="pricing-card__per-month">
            tokens
          </p>

          <div class="text-center non_ck fa-2x" <?php $element->is_editable(current_page_table, 'home_text_444_last', 'text'); ?>><?php echo $home_text_444_last; ?></div>
          <p class="pricing-card__per-month">Days </p>
          <form action="<?php base_path . "subscribe"; ?>" type="post" class="ajax">
            <input type="hidden" value="cheapest_plan" name="price">
            <input type="hidden" value="home_text_444" name="tokens">
            <input type="hidden" value="home_text_444_last" name="days">
            <input type="hidden" value="<?php echo csrf_token; ?>" name="csrf_token">
          </form>
          <a href="#" class="subs btn-base btn--white-ghost pricing-btn non_ck" <?php $element->is_editable(current_page_table, 'home_text_43p', 'text'); ?>><?php echo $home_text_43p; ?></a>
          <a href="<?php echo base_path . 'pricing'; ?>" class="btn-base btn--white-ghost pricing-btn non_ck" <?php $element->is_editable(current_page_table, 'home_text_43pm', 'text'); ?>><?php echo $home_text_43pm; ?></a>
        </div>
      </div>

      <div class="column bk-min-12 bk-5-offset-1 bk-5-10 bk-7-8 bk-7-offset-2 bk-11-4 bk-11-offset-0">
        <h4 class="pricing-title small-padding-bottom-4 non_ck" <?php $element->is_editable(current_page_table, 'home_text_41', 'text'); ?>><?php echo $home_text_41; ?></h4>
        <div class="pricing-card price-card--highlighted">
          <div class="pricing-card__price sml">
            $<span class="non_ck" <?php $element->is_editable(current_page_table, 'cheaper_plan', 'text'); ?>><?php echo $cheaper_plan; ?></span>
          </div>
          <p class="pricing-card__per-month">per </p>
          <div class="text-center non_ck fa-2x" <?php $element->is_editable(current_page_table, 'home_text_45', 'text'); ?>><?php echo $home_text_45; ?></div>
          <p class="pricing-card__per-month">Tokens </p>

          <div class="text-center non_ck fa-2x" <?php $element->is_editable(current_page_table, 'home_text_45_last', 'text'); ?>><?php echo $home_text_45_last; ?></div>
          <p class="pricing-card__per-month">Days </p>
          <form action="<?php base_path . "subscribe"; ?>" type="post" class="ajax">
            <input type="hidden" value="cheaper_plan" name="price">
            <input type="hidden" value="home_text_45" name="tokens">
            <input type="hidden" value="home_text_45_last" name="days">
            <input type="hidden" value="<?php echo csrf_token; ?>" name="csrf_token">
          </form>
          <a href="#" class="subs btn-base btn--white-ghost pricing-btn non_ck" <?php $element->is_editable(current_page_table, 'home_text_43p', 'text'); ?>><?php echo $home_text_43p; ?></a>
          <a href="<?php echo base_path . 'pricing'; ?>" class="btn-base btn--white-ghost pricing-btn non_ck" <?php $element->is_editable(current_page_table, 'home_text_43pm', 'text'); ?>><?php echo $home_text_43pm; ?></a>
        </div>
      </div>
      <div class="column bk-min-12 bk-5-offset-1 bk-5-10 bk-7-8 bk-7-offset-2 bk-11-4 bk-11-offset-0">
        <h4 class="pricing-title small-padding-bottom-4 non_ck" <?php $element->is_editable(current_page_table, 'home_text_42', 'text'); ?>><?php echo $home_text_42; ?></h4>
        <div class="pricing-card">
          <div class="pricing-card__price sml">
            $<span class="non_ck" <?php $element->is_editable(current_page_table, 'cheap_plan', 'text'); ?>><?php echo $cheap_plan; ?></span>
          </div>
          <p class="pricing-card__per-month">
            per
          </p>
          <div class="text-center non_ck fa-2x" <?php $element->is_editable(current_page_table, 'home_text_46', 'text'); ?>><?php echo $home_text_46; ?></div>
          <p class="pricing-card__per-month">Tokens </p>

          <div class="text-center non_ck fa-2x" <?php $element->is_editable(current_page_table, 'home_text_46_last', 'text'); ?>><?php echo $home_text_46_last; ?></div>
          <p class="pricing-card__per-month">Days </p>
          <form action="<?php base_path . "subscribe"; ?>" type="post" class="ajax">
            <input type="hidden" value="cheap_plan" name="price">
            <input type="hidden" value="home_text_46" name="tokens">
            <input type="hidden" value="home_text_46_last" name="days">
            <input type="hidden" value="<?php echo csrf_token; ?>" name="csrf_token">
          </form>
          <a href="#" class="subs btn-base btn--white-ghost pricing-btn non_ck" <?php $element->is_editable(current_page_table, 'home_text_43p', 'text'); ?>><?php echo $home_text_43p; ?></a>
          <a href="<?php echo base_path . 'pricing'; ?>" class="btn-base btn--white-ghost pricing-btn non_ck" <?php $element->is_editable(current_page_table, 'home_text_43pm', 'text'); ?>><?php echo $home_text_43pm; ?></a>
        </div>
      </div>

    </div>

  </div>

</div>


<?php
require_once '../blades/footer.php';
?>