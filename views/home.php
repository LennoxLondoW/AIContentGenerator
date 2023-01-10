<?php
session_start();
require_once '../controlers/homeControler.php';
require_once '../blades/header.php';
?>

<section>
	<div class="padding-top-2 padding-bottom-6 bk-7-padding-y-6" data-bg-color="<?php echo $site_more_c_1; ?>">
		<div class="home__landing row">
			<div class="column bk-min-10 bk-min-offset-1 bk-7-4 bk-7-order-2">
				<img <?php $element->is_editable(current_page_table, 'home_pic_1', 'image'); ?> src="<?php echo base_path . $home_pic_1;  ?>" alt="<?php echo $page_title; ?>">
			</div>
			<div class="column bk-7-6 bk-7-order-1">
				<h1 class="sz-h1 wt-black non_ck" <?php $element->is_editable(current_page_table, 'home_text_1', 'text'); ?>><?php echo $home_text_1; ?></h1>
				<p class="small-padding-y-3 non_ck" <?php $element->is_editable(current_page_table, 'home_text_2', 'text'); ?>><?php echo $home_text_2; ?></p>
				<div class="column bk-min-12">
					<a href="<?php echo base_path; ?>new_document" class="btn-base btn--teal-primary home__cta-row__register-btn non_ck" data-try-btn <?php $element->is_editable(current_page_table, 'home_text_3', 'text'); ?>><?php echo $home_text_3; ?></a>
				</div>
			</div>
		</div>
	</div>
</section>





<!-- Description Sub -->
<section data-bg-color="<?php echo $site_more_c_2; ?>">
	<div class="padding-y-4 bk-7-padding-y-5">
		<div class="home__testimonials">
			<h4 class="row padding-bottom-4 bk-9-padding-bottom-5">
				<div class="column bk-min-12">
					<h4 class="sz-h2 wt-black text-center non_ck" <?php $element->is_editable(current_page_table, 'home_text_7', 'text'); ?>><?php echo $home_text_7; ?></h4>
				</div>
			</h4>
			<div class="row padding-bottom-3 we-value-content">
				<div class="column bk-min-12 bk-5-10 bk-5-offset-1 bk-7-4 bk-7-offset-0 small-padding-bottom-6 bk-7-small-padding-bottom-0">
					<h6 class="sz-h3 wt-black small-padding-bottom-2 non_ck" <?php $element->is_editable(current_page_table, 'home_text_8', 'text'); ?>><?php echo $home_text_8; ?></h6>
					<div <?php $element->is_editable(current_page_table, 'home_text_9', 'text'); ?>><?php echo $home_text_9; ?></div>
				</div>
				<div class="column bk-min-12 bk-5-10 bk-5-offset-1 bk-7-4 bk-7-offset-0 small-padding-bottom-6 bk-7-small-padding-bottom-0">
					<h6 class="sz-h3 wt-black small-padding-bottom-2 non_ck" <?php $element->is_editable(current_page_table, 'home_text_10', 'text'); ?>><?php echo $home_text_10; ?></h6>
					<div <?php $element->is_editable(current_page_table, 'home_text_11', 'text'); ?>><?php echo $home_text_11; ?></div>
				</div>
				<div class="column bk-min-12 bk-5-10 bk-5-offset-1 bk-7-4 bk-7-offset-0 small-padding-bottom-6 bk-7-small-padding-bottom-0">
					<h6 class="sz-h3 wt-black small-padding-bottom-2 non_ck" <?php $element->is_editable(current_page_table, 'home_text_12', 'text'); ?>><?php echo $home_text_12; ?></h6>
					<div <?php $element->is_editable(current_page_table, 'home_text_13', 'text'); ?>><?php echo $home_text_13; ?></div>
				</div>
			</div>
		</div>
	</div>
</section>



<!-- Description Main -->
<section data-bg-color="<?php echo $site_more_c_1; ?>">
	<div class="padding-y-3 bk-7-padding-y-5">
		<div class="anchor-element" id="dif-outcome-section">
		</div>
		<div class="home__dif-and-outcome">
			<h4 class="row">
				<div class="column bk-min-12 text-center">
					<h4 class="sz-h2 wt-black padding-bottom-3 bk-7-padding-bottom-4 non_ck" <?php $element->is_editable(current_page_table, 'home_text_5', 'text'); ?>><?php echo $home_text_5; ?></h4>
				</div>
			</h4>
			<div class="row">
				<div class="column bk-min-10 bk-min-offset-1 bk-7-5 bk-7-offset-0 bk-9-4 bk-9-offset-1 padding-bottom-2 bk-7-padding-bottom-0">
					<img <?php $element->is_editable(current_page_table, 'home_pic_6', 'image'); ?> src="<?php echo base_path . $home_pic_6;  ?>" alt="<?php echo $page_title; ?>">
				</div>
				<div class="column bk-7-6 bk-7-offset-1 bk-9-5 info-column" <?php $element->is_editable(current_page_table, 'home_text_6', 'text'); ?>><?php echo $home_text_6; ?></div>
			</div>
		</div>
	</div>
</section>













<!-- Features -->
<section data-bg-color="<?php echo $site_more_c_2; ?>" id="features">
	<div class="padding-y-4 bk-7-padding-y-5 pos--relative">
		<div class="home__product-features">
			<h4 class="row padding-bottom-3">
				<div class="column bk-min-12 text-center">
					<h4 class="sz-h2 wt-black non_ck" <?php $element->is_editable(current_page_table, 'home_text_14', 'text'); ?>><?php echo $home_text_14; ?></h4>
				</div>
			</h4>

			<div class="product-feature row padding-bottom-2">
				<div class="column product-feature__image-column padding-bottom-2 bk-padding-bottom-0">
					<div class="layered-animations">
						<svg class="shape" viewBox="0 0 96 96">
							<circle cx="48" cy="48" r="28" fill="var(--site-primary-color)" stroke="var(--site-primary-color)" fill-rule="evenodd" stroke-linecap="square" />
						</svg>
						<svg class="shape" viewBox="0 0 96 96">
							<circle cx="48" cy="48" r="28" fill="var(--site-primary-color)" stroke="var(--site-primary-color)" fill-rule="evenodd" stroke-linecap="square" />
						</svg>
						<svg class="shape" viewBox="0 0 96 96">
							<circle cx="48" cy="48" r="28" fill="var(--site-primary-color)" stroke="var(--site-primary-color)" fill-rule="evenodd" stroke-linecap="square" />
						</svg>
					</div>
				</div>
				<div class="column product-feature__text-column" <?php $element->is_editable(current_page_table, 'home_text_15', 'text'); ?>><?php echo $home_text_15; ?></div>
			</div>


			<div class="product-feature row product-feature--reverse padding-bottom-2">
				<div class="column product-feature__image-column padding-bottom-2 bk-padding-bottom-0">
					<div class="layered-animations">
						<svg class="shape" viewBox="0 0 96 96">
							<polygon fill-rule="evenodd" fill="var(--site-primary-color)" stroke="var(--site-primary-color)" points="48 17.28 86.4 80.11584 9.6 80.11584" stroke-linecap="square" />
						</svg>
						<svg class="shape" viewBox="0 0 96 96">
							<polygon fill-rule="evenodd" fill="var(--site-primary-color)" stroke="var(--site-primary-color)" points="48 17.28 86.4 80.11584 9.6 80.11584" stroke-linecap="square" />
						</svg>
						<svg class="shape" viewBox="0 0 96 96">
							<polygon fill-rule="evenodd" fill="var(--site-primary-color)" stroke="var(--site-primary-color)" points="48 17.28 86.4 80.11584 9.6 80.11584" stroke-linecap="square" />
						</svg>
					</div>
				</div>

				<div class="column product-feature__text-column" <?php $element->is_editable(current_page_table, 'home_text_16', 'text'); ?>><?php echo $home_text_16; ?></div>
			</div>

			<div class="product-feature row padding-bottom-2">
				<div class="column product-feature__image-column padding-bottom-2 bk-padding-bottom-0">
					<div class="layered-animations">
						<svg class="shape" viewBox="0 0 96 96">
							<rect width="48" height="48" x="24" y="24" fill="var(--site-primary-color)" stroke="var(--site-primary-color)" fill-rule="evenodd" stroke-linecap="square" />
						</svg>
						<svg class="shape" viewBox="0 0 96 96">
							<rect width="48" height="48" x="24" y="24" fill="var(--site-primary-color)" stroke="var(--site-primary-color)" fill-rule="evenodd" stroke-linecap="square" />
						</svg>
						<svg class="shape" viewBox="0 0 96 96">
							<rect width="48" height="48" x="24" y="24" fill="var(--site-primary-color)" stroke="var(--site-primary-color)" fill-rule="evenodd" stroke-linecap="square" />
						</svg>
					</div>
				</div>
				<div class="column product-feature__text-column" <?php $element->is_editable(current_page_table, 'home_text_17', 'text'); ?>><?php echo $home_text_17; ?></div>
			</div>
			<div class="product-feature row product-feature--reverse padding-bottom-2">
				<div class="column product-feature__image-column padding-bottom-2 bk-padding-bottom-0">
					<div class="layered-animations">
						<svg class="shape" viewBox="0 0 96 96">
							<circle cx="48" cy="48" r="28" fill="var(--site-primary-color)" stroke="var(--site-primary-color)" fill-rule="evenodd" stroke-linecap="square" />
						</svg>
						<svg class="shape" viewBox="0 0 96 96">
							<circle cx="48" cy="48" r="28" fill="var(--site-primary-color)" stroke="var(--site-primary-color)" fill-rule="evenodd" stroke-linecap="square" />
						</svg>
						<svg class="shape" viewBox="0 0 96 96">
							<circle cx="48" cy="48" r="28" fill="var(--site-primary-color)" stroke="var(--site-primary-color)" fill-rule="evenodd" stroke-linecap="square" />
						</svg>
					</div>
				</div>

				<div class="column product-feature__text-column" <?php $element->is_editable(current_page_table, 'home_text_18', 'text'); ?>><?php echo $home_text_18; ?></div>
			</div>

			<div class="product-feature row padding-bottom-2">
				<div class="column product-feature__image-column padding-bottom-2 bk-padding-bottom-0">
					<div class="layered-animations">
						<svg class="shape" viewBox="0 0 96 96">
							<polygon fill-rule="evenodd" fill="var(--site-primary-color)" stroke="var(--site-primary-color)" points="48 17.28 86.4 80.11584 9.6 80.11584" stroke-linecap="square" />
						</svg>
						<svg class="shape" viewBox="0 0 96 96">
							<polygon fill-rule="evenodd" fill="var(--site-primary-color)" stroke="var(--site-primary-color)" points="48 17.28 86.4 80.11584 9.6 80.11584" stroke-linecap="square" />
						</svg>
						<svg class="shape" viewBox="0 0 96 96">
							<polygon fill-rule="evenodd" fill="var(--site-primary-color)" stroke="var(--site-primary-color)" points="48 17.28 86.4 80.11584 9.6 80.11584" stroke-linecap="square" />
						</svg>
					</div>
				</div>
				<div class="column product-feature__text-column" <?php $element->is_editable(current_page_table, 'home_text_19', 'text'); ?>><?php echo $home_text_19; ?></div>
			</div>
			<!-- <div class="product-feature row product-feature--reverse padding-bottom-2">
				<div class="column product-feature__image-column padding-bottom-2 bk-padding-bottom-0">
					<div class="layered-animations">
						<svg class="shape" viewBox="0 0 96 96">
							<rect width="48" height="48" x="24" y="24" fill="var(--site-primary-color)" stroke="var(--site-primary-color)" fill-rule="evenodd" stroke-linecap="square" />
						</svg>
						<svg class="shape" viewBox="0 0 96 96">
							<rect width="48" height="48" x="24" y="24" fill="var(--site-primary-color)" stroke="var(--site-primary-color)" fill-rule="evenodd" stroke-linecap="square" />
						</svg>
						<svg class="shape" viewBox="0 0 96 96">
							<rect width="48" height="48" x="24" y="24" fill="var(--site-primary-color)" stroke="var(--site-primary-color)" fill-rule="evenodd" stroke-linecap="square" />
						</svg>
					</div>
				</div>

				<div class="column product-feature__text-column" <?php $element->is_editable(current_page_table, 'home_text_20', 'text'); ?>><?php echo $home_text_20; ?></div>
			</div> -->
		</div>
	</div>
</section>





<!-- how it works -->
<section data-bg-color="<?php echo $site_more_c_1; ?>" id="how_it_works">
	<div class="padding-top-6 padding-bottom-4 bk-7-padding-y-6">
		<div class="home__register row">
			<h4 class="row padding-bottom-3">
				<div class="column bk-min-12 text-center">
					<h4 class="sz-h2 wt-black non_ck" <?php $element->is_editable(current_page_table, 'home_text_a_23', 'text'); ?>><?php echo $home_text_a_23; ?></h4>
				</div>
			</h4>
			<div class="column bk-min-12 bk-5-10 bk-5-offset-1 bk-7-5 bk-7-offset-0 padding-bottom-4 bk-7-padding-bottom-0 column-vertical-center">
				<div <?php $element->is_editable(current_page_table, 'home_text_a_24', 'text'); ?>><?php echo $home_text_a_24; ?></div>
			</div>
			<div class="column bk-min-12 bk-5-10 bk-5-offset-1 bk-7-6">
				<div class="anchor-element" id="register-card">
				</div>
				<div class="register-card">
					<h5 class="sz-h3 wt-black register-card__title small-padding-bottom-4 non_ck" <?php $element->is_editable(current_page_table, 'home_text_35', 'text'); ?>><?php echo $home_text_35; ?></h5>

					<div style="justify-content: center;">
						<center>
							<a href="<?php echo base_path; ?>new_document" class="btn-base btn--teal-ghost non_ck" <?php $element->is_editable(current_page_table, 'home_text_36', 'text'); ?>><?php echo $home_text_36; ?></a>
						</center>
						<br>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>











<!-- examples -->
<section data-bg-color="<?php echo $site_more_c_2; ?>" id="samples">
	<div class="padding-y-4 bk-7-padding-y-5 pos--relative">
		<div class="home__product-features">
			<h4 class="row padding-bottom-3">
				<div class="column bk-min-12 text-center">
					<h4 class="sz-h2 wt-black non_ck" <?php $element->is_editable(current_page_table, 'home_text_14s', 'text'); ?>><?php echo $home_text_14s; ?></h4>
				</div>
			</h4>

			<div class="product-feature row padding-bottom-2 " data-bg-color="<?php echo $site_tertiary_c; ?>">
				<div class="column product-feature__text-column" <?php $element->is_editable(current_page_table, 'home_text_22c', 'text'); ?>><?php echo $home_text_22c; ?></div>
				<div class="column product-feature__text-column" <?php $element->is_editable(current_page_table, 'home_text_15sc', 'text'); ?>><?php echo $home_text_15sc; ?></div>
			</div>

<br><br>
			<div class="product-feature row padding-bottom-2" data-bg-color="<?php echo $site_tertiary_c; ?>">
				<div class="column product-feature__text-column" <?php $element->is_editable(current_page_table, 'home_text_15s2', 'text'); ?>><?php echo $home_text_15s2; ?></div>
				<div class="column product-feature__text-column" <?php $element->is_editable(current_page_table, 'home_text_222', 'text'); ?>><?php echo $home_text_222; ?></div>
			</div>

		</div>
	</div>
</section>









<?php
require_once '../blades/footer.php';
?>