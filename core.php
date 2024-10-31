<?php 

if ( ! defined( 'ABSPATH' ) ) exit;

/* Define plugin name */
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'add_action_links' );
define( 'Rndposts__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'Rndposts__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );


// Call random post class
require_once('random-post-class.php');


/* Get and set queries */
require_once(Rndposts__PLUGIN_DIR.'inc/functions.php');


// Admin panel
require_once(Rndposts__PLUGIN_DIR.'inc/admin_panel.php');

/* ajax posts */
add_action("wp_ajax_wprndpst_Sorting", "wprndpst_Sorting");
add_action("wp_ajax_nopriv_wprndpst_Sorting", "wprndpst_Sorting");

function wprndpst_Sorting(){
	/* Get the data */
	$values=new wprndpst_GetPostData();
	$value=$values->wprndpstgetdata();
	$getpst_types=$value['pst_types'];
	$getCats=$value['cats'];
	$rnd_number=$value['rnd_number'];
	$rnd_thumbnail=$value['rnd_thumbnail'];
	$rnd_dates=$value['rnd_dates'];
	$rnd_content=$value['rnd_content'];

	$args = array(
		'post_type' => $getpst_types,
		'orderby' =>
		'rand',
		'showposts' => $rnd_number,
		'tax_query' => array(
			'relation' => 'OR',
			array(
				'category__in' =>$getCats
				),
			)
		);

	$query = new WP_Query( $args );
	?>
	<div>
		<div>
			<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();?>
				<p><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php if($rnd_thumbnail=="on") {
						$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
						$url = $thumb['0'];
						if ($url==''){}else{?>
						<img src="<?php echo $url; ?>" alt="<?php the_title(); ?>">
						<?php } } if($rnd_content=="on") {?>
						<p><?php the_excerpt(); ?></p>
						<?php } ?>
						<?php if ($rnd_dates=="on") {?><p><date><?php the_time('j F Y') ?></date></p><?php } ?>
					</p>
					<?php

					endwhile;
					endif;
					?>
				</div>
			</div>
			<?php
			wp_die();
		}


