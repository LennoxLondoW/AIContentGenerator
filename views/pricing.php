<?php
session_start();
require_once '../controlers/pricingControler.php';
require_once '../blades/header.php';



// /ets fetch the pricing data 
$pricing = new Element();
$pricing->activeTable = "lentec_subscribe";
$pricing->comparisons = [
  ["section_id", " = ", 'free_tokens'],
  ["section_id", " = ", 'free_tokens_last'],


  ["section_id", " = ", 'home_text_40'],
  ["section_id", " = ", 'cheapest_plan'],
  ["section_id", " = ", 'home_text_444'],
  ["section_id", " = ", 'home_text_444_last'],
  ["section_id", " = ", 'home_text_444c'],

  ["section_id", " = ", 'home_text_41'],
  ["section_id", " = ", 'cheaper_plan'],
  ["section_id", " = ", 'home_text_45'],
  ["section_id", " = ", 'home_text_45_last'],
  ["section_id", " = ", 'home_text_45c'],


  ["section_id", " = ", 'home_text_42'],
  ["section_id", " = ", 'cheap_plan'],
  ["section_id", " = ", 'home_text_46'],
  ["section_id", " = ", 'home_text_46_last'],
  ["section_id", " = ", 'home_text_46c'],

  ["section_id", " = ", 'home_text_43p']
];
$pricing->joiners = ['', ' || ', ' || ', ' || ', ' || ', ' || ', ' || ', ' || ', ' || ', ' || ', ' || ', ' || ', ' || ', ' || ', ' || ', ' || ', ' || ', ' || '];
$pricing->order = " BY id DESC ";
$pricing->cols = "section_id, section_title";
$pricing->limit = 1000;
$pricing->offset = 0;
/*get_data*/
$data = $pricing->GetElementData();

?>

<!-- Pricing -->
<section>
  <div class="padding-top-2 padding-bottom-4  pos--relative">

    <div class="padding-y-3 bk-7-padding-y-5">
      <div class="home__dif-and-outcome">
        <h4 class="row">
          <div class="column bk-min-12 text-center">
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

          </div>
        </h4>
      </div>
    </div>





    <div class="row home__pricing pricing-cards-section padding-top-2">
      <div class="column bk-min-12 bk-5-offset-1 bk-5-10 bk-7-8 bk-7-offset-2 bk-11-4 bk-11-offset-0">
        <h4 class="pricing-title small-padding-bottom-4 non_ck" <?php $element->is_editable('subscribe', 'home_text_40', 'text'); ?>><?php echo $home_text_40; ?></h4>
        <div class="pricing-card">
          <div class="pricing-card__price">
            $<span class="non_ck" <?php $element->is_editable('subscribe', 'cheapest_plan', 'text'); ?>><?php echo $cheapest_plan; ?></span>
          </div>
          <p class="pricing-card__per-month">
            per
          </p>
          <div class="text-center non_ck fa-2x" <?php $element->is_editable('subscribe', 'home_text_444', 'text'); ?>><?php echo $home_text_444; ?></div>
          <p class="pricing-card__per-month">Tokens </p>

          <div class="text-center non_ck fa-2x" <?php $element->is_editable(current_page_table, 'home_text_444_last', 'text'); ?>><?php echo $home_text_444_last; ?></div>
          <p class="pricing-card__per-month">Days </p>


          <div <?php $element->is_editable('subscribe', 'home_text_444c', 'text'); ?>><?php echo $home_text_444c; ?></div>
          <a href="<?php echo base_path . 'subscribe'; ?>" class="btn-base btn--white-ghost pricing-btn non_ck" <?php $element->is_editable('subscribe', 'home_text_43p', 'text'); ?>><?php echo $home_text_43p; ?></a>
        </div>
      </div>

      <div class="column bk-min-12 bk-5-offset-1 bk-5-10 bk-7-8 bk-7-offset-2 bk-11-4 bk-11-offset-0">
        <h4 class="pricing-title small-padding-bottom-4 non_ck" <?php $element->is_editable('subscribe', 'home_text_41', 'text'); ?>><?php echo $home_text_41; ?></h4>
        <div class="pricing-card price-card--highlighted">
          <div class="pricing-card__price">
            $<span class="non_ck" <?php $element->is_editable('subscribe', 'cheaper_plan', 'text'); ?>><?php echo $cheaper_plan; ?></span>
          </div>
          <p class="pricing-card__per-month">per </p>
          <div class="text-center non_ck fa-2x" <?php $element->is_editable('subscribe', 'home_text_45', 'text'); ?>><?php echo $home_text_45; ?></div>
          <p class="pricing-card__per-month">Tokens </p>


          <div class="text-center non_ck fa-2x" <?php $element->is_editable(current_page_table, 'home_text_45_last', 'text'); ?>><?php echo $home_text_45_last; ?></div>
          <p class="pricing-card__per-month">Days </p>


          <div <?php $element->is_editable('subscribe', 'home_text_45c', 'text'); ?>><?php echo $home_text_45c; ?></div>

          <a href="<?php echo base_path . 'subscribe'; ?>" class="btn-base btn--white-ghost pricing-btn non_ck" <?php $element->is_editable('subscribe', 'home_text_43p', 'text'); ?>><?php echo $home_text_43p; ?></a>
        </div>
      </div>
      <div class="column bk-min-12 bk-5-offset-1 bk-5-10 bk-7-8 bk-7-offset-2 bk-11-4 bk-11-offset-0">
        <h4 class="pricing-title small-padding-bottom-4 non_ck" <?php $element->is_editable('subscribe', 'home_text_42', 'text'); ?>><?php echo $home_text_42; ?></h4>
        <div class="pricing-card">
          <div class="pricing-card__price">
            $<span class="non_ck" <?php $element->is_editable('subscribe', 'cheap_plan', 'text'); ?>><?php echo $cheap_plan; ?></span>
          </div>
          <p class="pricing-card__per-month">
            per
          </p>
          <div class="text-center non_ck fa-2x" <?php $element->is_editable('subscribe', 'home_text_46', 'text'); ?>><?php echo $home_text_46; ?></div>
          <p class="pricing-card__per-month">Tokens </p>

          <div class="text-center non_ck fa-2x" <?php $element->is_editable(current_page_table, 'home_text_46_last', 'text'); ?>><?php echo $home_text_46_last; ?></div>
          <p class="pricing-card__per-month">Days </p>


          <div <?php $element->is_editable('subscribe', 'home_text_46c', 'text'); ?>><?php echo $home_text_46c; ?></div>

          <a href="<?php echo base_path . 'subscribe'; ?>" class="btn-base btn--white-ghost pricing-btn non_ck" <?php $element->is_editable('subscribe', 'home_text_43p', 'text'); ?>><?php echo $home_text_43p; ?></a>
        </div>
      </div>

    </div>
  </div>



</section>


<?php
require_once '../blades/footer.php';
?>