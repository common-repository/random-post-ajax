<?php 

/*
*   Main class for random posts 
*
*/


if (! class_exists('random_post')):

    class random_posts{


        // function Construct for class random posts
        function __construct(){
            add_action('admin_menu',array($this,'random_posts_register_menu') );
            add_filter('plugin_action_links', array($this,'wprndpst_add_action_plugin') , 10, 5 );
            add_action('wp_head', array($this, 'Rndpst_ajaxurl' ) );
            add_action('admin_init', array($this ,'register_rndpst_settings' ) );
            add_action('wprndpst_settings',array($this,'fnc_rnd_stngs' ) );
            add_action('admin_init',array($this,'random_post_enqueue'));
            add_action('wp_enqueue_scripts', array($this,'random_post_enqueue') );
        }


        // include all we need css & js files
        public function random_post_enqueue()
        {
            wp_register_style( 'randompostscss', plugin_dir_url(__FILE__) . 'assets/css/main.css' );
            wp_enqueue_style( 'randompostscss');

            wp_enqueue_script('jquery');
            wp_enqueue_script ( 'main', plugin_dir_url(__FILE__) . 'inc/js/main.js'); 
        }




        // Register menu in wp admin panel
        function random_posts_register_menu(){
            add_menu_page( 
                __( 'Random Posts', 'random-post-ajax' ),
                __( 'Random Posts', 'random-post-ajax' ),
                'manage_options',
                'random_posts_settings',
                'rndpst_my_rndpst_submenu_page_callback',
                plugins_url( 'inc/img/icon.png', __FILE__ ),
                7
                ); 
        }


        // Add support icon to random-post plugin in pluign list page 
        function wprndpst_add_action_plugin( $actions, $plugin_file ) 
        {
            static $plugin;
            if (!isset($plugin))
                $plugin = plugin_basename(__FILE__);
            if ($plugin == $plugin_file) {
                $site_link = array('support' => '<a href="http://wpmen.ir" target="_blank">Support</a>');
                $actions = array_merge($site_link, $actions); 
            }

            return $actions;
        }


        // Hook ajax to header 
        function Rndpst_ajaxurl() {
            ?>
            <script type="text/javascript">
                var ajaxurl = '<?php echo admin_url("admin-ajax.php"); ?>';
            </script>
            <?php
        }




        // Register Random posts Settings to wp database
        function register_rndpst_settings() {
            register_setting( 'rndpst-settings-group', 'pst_types' );
            register_setting( 'rndpst-settings-group', 'cats' );
            register_setting( 'rndpst-settings-group', 'rnd_number' );
            register_setting( 'rndpst-settings-group', 'rnd_thumbnail' );
            register_setting( 'rndpst-settings-group', 'rnd_dates' );
            register_setting( 'rndpst-settings-group', 'rnd_content' );
        }




       //   Show post when Create page and Ajaxify show more post
        function fnc_rnd_stngs(){

            ?>
            <div id="showcontent">
                <?php
                /* Get the data*/
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
                            <?php if($rnd_thumbnail=='on') {
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
                        </div>
                        <?php if ($query->have_posts()) { ; ?><button id="refresh">more Random </button><?php }else ?>

                        <?php
                    }







                }
                endif;


                

                  // when include this file , made a object from class random_posts autommaticaly
                return new random_posts();
                ?>