<?php 

if ( ! defined( 'ABSPATH' ) ) exit;

/* Get all cats.in this part you can set of your settings too,be carefull */
class wprndpst_cats_rnd
{
	function set_func_cat(){
		$querycat = array(
			'show_option_all'    => '',
			'orderby'            => 'name',
			'order'              => 'ASC',
			'style'              => 'list',
			'show_count'         => 0,
			'hide_empty'         => 0,
			'use_desc_for_title' => 1,
			'child_of'           => 0,
			'feed'               => '',
			'feed_type'          => '',
			'feed_image'         => '',
			'exclude'            => '',
			'exclude_tree'       => '',
			'include'            => '',
			'hierarchical'       => 1,
			'title_li'           => __( 'Categories' ),
			'show_option_none'   => __( '' ),
			'number'             => null,
			'echo'               => 1,
			'depth'              => 0,
			'current_category'   => 0,
			'pad_counts'         => 0,
			'taxonomy'           => 'category',
			'walker'             => null
			);
		return $querycat;
	}
}

class  wprndpst_GetPostData
{
	private $wprndpstgetdata = array();
	function wprndpstgetdata(){
		
		/*get cats saved*/
		$this->wprndpstgetdata['cats']=get_option('cats');
		/*get post types saved*/
		$this->wprndpstgetdata['pst_types']= get_option('pst_types');  
		/*get counts saved*/
		$this->wprndpstgetdata['rnd_number']=get_option('rnd_number');
		/*get thumbnail saved*/
		$this->wprndpstgetdata['rnd_thumbnail']=get_option('rnd_thumbnail');
		/*get dates saved*/
		$this->wprndpstgetdata['rnd_dates']=get_option('rnd_dates');
		/*get content saved*/
		$this->wprndpstgetdata['rnd_content']=get_option('rnd_content');

		return $this->wprndpstgetdata;
	}

}

