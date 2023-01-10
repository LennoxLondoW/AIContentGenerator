<?php
if (!isAjax) {
	echo '</main>';
	if ($element->page_editable) {
		$current_page = basename(str_replace(".php", "", $_SERVER["PHP_SELF"]));
?>

		<div class="edit_div">
			<table>
				<caption>
					<h3>Customize Page Meta Tags</h3>
				</caption>
				<thead>
					<tr>
						<th>Object</th>
						<th>Data</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Page Title</td>
						<td><span class="non_ck" <?php $element->is_editable(current_page_table, 'page_title', 'text'); ?>><?php echo $page_title;  ?> </span></td>
					</tr>
					<tr>
						<td>Page Description</td>
						<td><span class="non_ck" <?php $element->is_editable(current_page_table, 'page_description', 'text'); ?>><?php echo $page_description;  ?> </span></td>
					</tr>
					<tr>
						<td>Page Keywords</td>
						<td><span class="non_ck" <?php $element->is_editable(current_page_table, 'page_keywords', 'text'); ?>><?php echo $page_keywords;  ?> </span></td>
					</tr>
					<tr>
						<td>Site Location</td>
						<td><span class="non_ck" <?php $element->is_editable('navbar', 'site_location', 'text'); ?>><?php echo $site_location;  ?></td>
					</tr>
					<tr>
						<td>Site 404</td>
						<td><span class="non_ck" <?php $element->is_editable('navbar', 'site_404', 'text'); ?>><?php echo $site_404;  ?> </span></td>
					</tr>
					<tr>
						<td>Og:locale</td>
						<td><span class="non_ck" <?php $element->is_editable('navbar', 'og_locale', 'text'); ?>><?php echo $og_locale;  ?> </span></td>
					</tr>
					<tr>
						<td>Og:site_name</td>
						<td><span class="non_ck" <?php $element->is_editable('navbar', 'og_sitename', 'text'); ?>><?php echo $og_sitename;  ?> </span></td>
					</tr>
					<tr>
						<td>Og:type</td>
						<td><span class="non_ck" <?php $element->is_editable('navbar', 'og_type', 'text'); ?>><?php echo $og_type;  ?> </span></td>
					</tr>
					<tr>
						<td>Twitter:card</td>
						<td><span class="non_ck" <?php $element->is_editable('navbar', 'og_twittercard', 'text'); ?>><?php echo $og_twittercard;  ?> </span></td>
					</tr>
					<tr>
						<td>Page Icon</td>
						<td><span> <img style="height:20px; width:20px;" <?php $element->is_editable(current_page_table, 'page_icon', 'image'); ?> src="<?php echo base_path . $page_icon; ?>"></span></td>
					</tr>


					<tr>
						<td>Primary Color</td>
						<td><span class="non_ck" <?php $element->is_editable('navbar', 'site_primary_c', 'text'); ?>><?php echo $site_primary_c;  ?> </span>
							<button style="margin-left:10px;border:solid .25px black; background-color: <?php echo $site_primary_c; ?>">.</button>
						</td>
					</tr>

					<tr>
						<td>Secondary Color</td>
						<td><span class="non_ck" <?php $element->is_editable('navbar', 'site_secondary_c', 'text'); ?>><?php echo $site_secondary_c;  ?> </span>
							<button style="margin-left:10px;border:solid .25px black; background-color: <?php echo $site_secondary_c; ?>">.</button>
						</td>
					</tr>

					<tr>
						<td>Tertiary Color</td>
						<td><span class="non_ck" <?php $element->is_editable('navbar', 'site_tertiary_c', 'text'); ?>><?php echo $site_tertiary_c;  ?> </span>
							<button style="margin-left:10px;border:solid .25px black; background-color: <?php echo $site_tertiary_c; ?>">.</button>
						</td>
					</tr>

					<tr>
						<td>Extra Color 1</td>
						<td><span class="non_ck" <?php $element->is_editable('navbar', 'site_more_c_1', 'text'); ?>><?php echo $site_more_c_1;  ?> </span>
							<button style="margin-left:10px;border:solid .25px black; background-color: <?php echo $site_more_c_1; ?>">.</button>
						</td>
					</tr>

					<tr>
						<td>Extra Color 2</td>
						<td><span class="non_ck" <?php $element->is_editable('navbar', 'site_more_c_2', 'text'); ?>><?php echo $site_more_c_2;  ?> </span>
							<button style="margin-left:10px;border:solid .25px black; background-color: <?php echo $site_more_c_2; ?>">.</button>
						</td>
					</tr>

					<tr>
						<td>Extra Color 3</td>
						<td><span class="non_ck" <?php $element->is_editable('navbar', 'site_more_c_3', 'text'); ?>><?php echo $site_more_c_3;  ?> </span>
							<button style="margin-left:10px;border:solid .25px black; background-color: <?php echo $site_more_c_3; ?>">.</button>
						</td>
					</tr>


				</tbody>
			</table>
		</div>

	<?php
	}
	?>



	<div class="footer">
		<footer class="footer__inner row padding-y-6">
			<div class="column bk-5-5 bk-7-4 bk-9-3 bk-min-padding-bottom-4 bk-5-padding-bottom-0">
				<div class="footer_logo" href>
					<img <?php $element->is_editable('navbar', 'site_icon', 'image'); ?> src="<?php echo base_path . $site_icon; ?>" alt="<?php echo $site_title; ?>">

				</div>
				<div class="footer__info" <?php $element->is_editable('navbar', 'footer__info', 'text'); ?>><?php echo $footer__info; ?></div>
			</div>
			<div class="column bk-min-6 bk-5-3 bk-5-offset-1 bk-7-2 bk-7-offset-3 bk-7-offset-4footer__nav-column">
				<ul>
					<li class="footer__nav-item">
						<a href="<?php echo base_path; ?>privacy_policy">
							Privacy Policy
						</a>
					</li>

					<li class="footer__nav-item">
						<a href="<?php echo base_path; ?>terms_and_conditions">
							Terms of Service
						</a>
					</li>

				</ul>
			</div>
			<div class="column bk-min-6 bk-5-3 bk-7-2 footer__nav-column">
				<ul>
					<li class="footer__nav-item">
						<a href="<?php echo base_path; ?>about">
							About
						</a>
					</li>

					<li class="footer__nav-item">
						<a href="<?php echo base_path; ?>contact">
							Contact Us
						</a>
					</li>

				</ul>
			</div>
		</footer>
	</div>


	<div class="footer-copy-bar padding-y-2 text-center">
		<a href="<?php echo base_path . "home"; ?>">
			&copy;<?php echo date("Y"); ?> <span class="non_ck" <?php $element->is_editable('navbar', 'og_sitename', 'text'); ?>><?php echo $og_sitename; ?></span>
		</a>

		<a href="<?php echo base_path . "home"; ?>" class="non_spa"> | </a>

		<a href="https://www.lennox.anchortrends.com/" class="non_spa" target="_blank">
			Designed By LenTec
		</a>
	</div>






	<!-- app js  -->
	<script src="<?php echo base_path; ?>js/app.js/jquery.min.js?v=2.9"></script>
	<script src="https://cdn.ckeditor.com/4.19.1/full/ckeditor.js"></script>
	<script src="<?php echo base_path; ?>js/app.js/sweetalert.js?v=2.9"></script>
	<script src="<?php echo base_path; ?>js/app.js/spa.js?v=3.94"></script>
	<script src="<?php echo base_path; ?>js/app.js/functions.js?v=2.915"></script>
	<!-- <script src="<?php echo base_path; ?>js/app.js/helper.js?v=2.9"></script> -->
	<!-- <script src="<?php echo base_path; ?>plugins/apk/application.js?v=5"></script> -->
	<!-- <i class="add-to" style="position: fixed; right: 10px; bottom: 150px; background: #FF8D1B; border-radius: 5px; padding: 5px; color: #fff; cursor: pointer; display: none;"> <i class="fa fa-download settings add-to-btn"></i></i> -->
	<!-- app js  -->

	<!-- shapes animation js  -->
	<script src="<?php echo base_path; ?>js/shape_animation.js?v=1.3"></script>
	<script src="<?php echo base_path; ?>js/main.js?v=1.9"></script>
	<script src="<?php echo base_path; ?>js/ai.js?v=1.8"></script>
	</body>

	</html>
<?php } ?>