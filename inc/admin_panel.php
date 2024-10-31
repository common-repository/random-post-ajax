<?php

function rndpst_my_rndpst_submenu_page_callback(){

	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}


	$values=new wprndpst_GetPostData();
	$value=$values->wprndpstgetdata();
	$getpst_types=$value['pst_types'];
	$getCats=$value['cats'];
	$rnd_number=$value['rnd_number'];
	$rnd_thumbnail=$value['rnd_thumbnail'];
	$rnd_dates=$value['rnd_dates'];
	$rnd_content=$value['rnd_content'];
	?>

	<!-- begin change layout  -->

	<form method="post" action="options.php">

		<?php
			// Get setting from database
		settings_fields( 'rndpst-settings-group' );
		do_settings_sections( 'rndpst-settings-group' );
		?>
		<div class="mother-of-base">


			<div class="header-of-mother">

				<div class="right">
					<?php echo __('Welcome To ','random-post-ajax'); ?><b> Random Posts  <small>with Ajax</small></b>
				</div>

				<div class="left">
					<div>
						<?php echo __('Version','random-post-ajax'); ?>  <?php echo randompost_Version; ?>
						<span class="prudly">
							proudly dedicated to: Lotfi A. Zadeh
						</span>
					</div>
				</div>
			</div>
			<div class="tabs">
				<ul class="tab-links">
					<li class="active"><a href="#tab1"><?php echo __('Relation', 'random-post-ajax'); ?></a></li>
					<li><a href="#tab2"><?php echo __('Extra Settings', 'random-post-ajax'); ?></a></li>
					<li><a href="#tab3"><?php echo __('Help' ,'random-post-ajax'); ?></a></li>
					<li><a href="#tab4"><?php echo  __('About' ,'random-post-ajax') ?></a></li>
					<li> <?php submit_button(); ?> </li>
				</ul>









				<div class="tab-content">
					<div id="tab1" class="tab active" style="text-align: center;">
						<div class="box box-inline" style="border-right: 1px rgba(0, 0, 0, 0.09) solid;">
							<!-- <h4>
								<b>- <?php  _e('Choose the Post_type for show in random post','random-post-ajax'); ?></b>
							</h4> -->
							<div>
								<label> <?php echo __("Select 'Post_Types' ( for multiple choice, hold ctrl key ) ","random-post-ajax"); ?> </label>
							</div>

							<?php
								// Get list of category
							$cats = new wprndpst_cats_rnd();
							$queries = $cats->set_func_cat();
							?>
							<select name="pst_types[]" id="pst_types" c multiple="">
								<?php
								/*show post types*/
								foreach ( get_post_types( '', 'names' ) as $post_type ) {
									echo '<p>' . $post_type . '</p>';
									if(isset($post_type) && ($post_type!=NULL)) { ?>
									<option value="<?php echo $post_type ?>" <?php if($getpst_types!=NULL && in_array($post_type,$getpst_types)){?> selected="selected" <?php } ?> ><?php echo $post_type;?></option>
									<?php }
									else{
										?>
										<option value="<?php echo $post_type ?>" ><?php echo $post_type;?></option>
										<?php
									}
								}
								?>
							</select>
						</div>
						<div class="box box-inline">
							<div><label class="label label-default" ><?php echo __("Select 'Categories' ( for multiple choice, hold ctrl key )","random-post-ajax"); ?></label></div>
							<?php
							/*get cats in oop in the functions */
							$cats=new wprndpst_cats_rnd();
							$queries=$cats->set_func_cat();
							?>
							<select name="cats[]" id="cats" class="cats selectpicker" multiple="" data-style="btn-success" data-actions-box="true">
								<?php
								foreach (get_categories($queries) as $cat) {

									$catSlug=$cat->term_id;

									?>
									<?php if(isset($getCats) && ($getCats!=NULL)) { ?>
									<option value="<?php echo $cat->term_id; ?>" <?php if($getCats!=NULL &&in_array($catSlug,$getCats)){?> selected="selected" <?php } ?> ><?php echo $cat->name;?></option>
									<?php }
									else{
										?>
										<option value="<?php echo $cat->term_id ?>" ><?php echo $cat->name;?></option>
										<?php
									}
								}
								?>
							</select>
						</div>
					</div>





					<!-- Begin Second Tab -->
					<div id="tab2" class="tab">
						<div class="well box">
							<div>
								<h4>
									<label for="rnd_content">
										<b>- <?php _e('Show Content ( Excerpt ) ' , 'random-post-ajax'); ?>  </b>
									</label>
									<input
									<?php
									if(isset($rnd_content) && ($rnd_content!=NULL)) echo $rnd_content=='on' ? 'checked' : '';
									?>
									type="checkbox"
									name="rnd_content"
									>
								</h4>
							</div>
						</div>
						<div class="box">
							<div>
								<h4>
									<label for="rnd_number">
										<b>- <?php _e('How many display', 'random-post-ajax'); ?> </b>
									</label>
									<input name="rnd_number" type="number" min="-1" max="50" value="<?php
									if(isset($rnd_number) && ($rnd_number!=NULL)) {
										echo $rnd_number;
									}
									else{
										echo 0;
									}
									?>" >
								</h4>
							</div>
						</div>
						<div class="box">
							<div>
								<h4>
									<b>
										<label for="rnd_thumbnail">
											<b>- <?php _e('Show Thumbnail of posts', 'random-post-ajax'); ?></b>
										</label>
									</b>
									<input name="rnd_thumbnail"
									<?php
									if(isset($rnd_thumbnail) && ($rnd_thumbnail!=NULL)) echo $rnd_thumbnail=='on' ? 'checked' : '';
									?>
									type="checkbox">
								</h4>
							</div>
						</div>


						<div class="box">
							<div>
								<h4>
									<label for="rnd_dates">
										<b>- <?php _e('Show Date', 'random-post-ajax'); ?> </b>

									</label>
									<input type="checkbox" name="rnd_dates"
									<?php
									if(isset($rnd_dates) && ($rnd_dates!=NULL))  echo $rnd_dates=='on' ? 'checked' : ''; // get TRUE ?>
									>
								</h4>
							</div>
						</div>
					</div>
					<!-- End Second Tab -->




					<div id="tab3" class="tab">
						<div class="box">
							<b>	- <?php echo  __('For show the Random post copy below shortcode and paste where to show Random post !' , 'random-post-ajax' ); ?> </b>
							<pre> do_action('wprndpst_settings');</pre>
						</div>
					</div>

					<div id="tab4" class="tab">

						<div class="about-us">
							<div class="description">
								<?php echo __('Combining beauty and efficiency to display random posts','random-post-ajax'); ?> <br>
								<b><?php echo __('Authors','random-post-ajax'); ?>: </b> <a href="https://wpmen.ir">WPMEN </a> <br>
								<b><?php echo __(' Version','random-post-ajax'); ?>: </b> <?php echo randompost_Version; ?> <br>
								<b><?php echo __('This version is proudly dedicated to','random-post-ajax'); ?>:</b><a href="<?php echo randompost_CodeName_link; ?>"> <?php echo randompost_CodeName; ?> </a><br>

							</div>
							<div class="legend">
								<img src="<?php echo Rndposts__PLUGIN_URL.'assets/img/Lotfi.Zadeh.jpg' ?>" />

								<span class="more-detail">
									<?php echo __('
										Lotfi Aliasker Zadeh ( born February 4, 1921),<br> is a mathematician, computer scientist, electrical engineer, artificial intelligence researcher and professor emeritus of computer science at the University of California, Berkeley.
									</br>
									He is best known for proposing the fuzzy mathematics consisting of those fuzzy related concepts:<br>
									fuzzy sets,<br>
									fuzzy logic,<br>
									fuzzy algorithms,<br>
									fuzzy semantics,<br>
									fuzzy languages,<br>
									fuzzy control,<br>
									fuzzy systems,<br>
									fuzzy probabilities,<br>
									fuzzy events,<br>
									and fuzzy information.<br>
									He is a founding member of Eurasian Academy.
									' , 'random-post-ajax'); ?>
								</span>
							</div>

						</div>

					</div>
				</div>
			</div>
			<div class="copyright">
				<?php echo __('Created With','random-post-ajax'); ?> <span class="love"> &#10084; </span> <?php echo __('By','random-post-ajax'); ?> <a href="https://wpmen.ir">WPMEN </a>
			</div>


		</div>


	</form>

	<!-- End change layout  -->


	<?php
}
