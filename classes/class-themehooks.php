<?php

/**
 * A class of methods using hooks in the theme.
 *
 * @package Workforce
 * @author DCC Marketing <web@dccmarketing.com>
 */
class workforce_Themehooks {

	/**
	 * Constructor
	 */
	public function __construct() {} // __construct()

	/**
	 * Loads all filter and action calls
	 */
	public function hooks() {

		add_action( 'workforce_header_top', 					array( $this, 'header_wrap_start' ), 10 );
		add_action( 'workforce_header_top', 					array( $this, 'site_branding_start' ), 15 );

		add_action( 'workforce_header_content', 			array( $this, 'title_site' ), 10 );

		add_action( 'workforce_header_bottom', 				array( $this, 'site_branding_end' ), 85 );
		add_action( 'workforce_header_bottom', 				array( $this, 'header_wrap_end' ), 90 );

		add_action( 'workforce_header_after', 				array( $this, 'menu_primary' ), 10);

		add_action( 'workforce_content_before', 				array( $this, 'page_builder' ), 20 );
		add_action( 'wp_head', 									array( $this, 'page_builder_header' ) );
		//add_action( 'workforce_content_before', 				array( $this, 'block_home_top' ), 10 );
		//add_action( 'workforce_content_before', 				array( $this, 'block_home_img1' ), 30 );
		//add_action( 'workforce_content_before', 				array( $this, 'blocks_home' ), 40 );
		//add_action( 'workforce_content_before', 				array( $this, 'block_home_img2' ), 50 );

		add_action( 'workforce_body_top', 					array( $this, 'analytics_code' ), 10 );
		add_action( 'workforce_body_top', 					array( $this, 'add_hidden_search' ), 15 );
		add_action( 'workforce_body_top', 					array( $this, 'skip_link' ), 20 );

		add_action( 'workforce_content_while_before', 		array( $this, 'title_archive' ) );
		add_action( 'workforce_content_while_before', 		array( $this, 'title_single_post' ) );
		add_action( 'workforce_content_while_before', 		array( $this, 'title_search' ) );

		add_action( 'workforce_content_while_after', 			array( $this, 'posts_nav' ) );

		add_action( 'workforce_content_top', 					array( $this, 'breadcrumbs' ) );

		add_action( 'workforce_entry_after', 					array( $this, 'comments' ), 10 );

		add_action( 'workforce_404_before', 				array( $this, 'title_404' ), 10 );

		add_action( 'workforce_404_content', 				array( $this, 'add_search' ), 10 );
		add_action( 'workforce_404_content', 				array( $this, 'four_04_posts_widget' ), 15 );
		add_action( 'workforce_404_content', 				array( $this, 'four_04_categories' ), 20 );
		add_action( 'workforce_404_content', 				array( $this, 'four_04_archives' ), 25 );
		add_action( 'workforce_404_content', 				array( $this, 'four_04_tag_cloud' ), 30 );

		add_action( 'workforce_entry_header_content', 			array( $this, 'title_entry' ), 10 );
		add_action( 'workforce_entry_header_content', 			array( $this, 'title_page' ), 10 );
		add_action( 'workforce_entry_header_content', 			array( $this, 'title_search' ), 10 );
		add_action( 'workforce_entry_header_content', 			array( $this, 'posted_on' ), 20 );
		
		add_action( 'workforce_entry_footer_content', 	array( $this, 'entry_categories_links' ), 10 );
		add_action( 'workforce_entry_footer_content', 	array( $this, 'entry_tags_links' ), 15 );
		add_action( 'workforce_entry_footer_content', 	array( $this, 'entry_comments_links' ), 20 );
		add_action( 'workforce_entry_footer_content', 	array( $this, 'entry_edit_link' ), 25 );

		add_action( 'workforce_footer_top', 					array( $this, 'footer_wrap_begin' ) );
		add_action( 'workforce_footer_content', 			array( $this, 'site_description' ), 10 );
		add_action( 'workforce_footer_content', 			array( $this, 'footer_locations' ), 15 );
		add_action( 'workforce_footer_content', 			array( $this, 'footer_content' ), 20 );
		add_action( 'workforce_footer_bottom', 				array( $this, 'footer_wrap_end' ) );

	} // hooks()

	/**
	 * Adds a hidden search field
	 *
	 * @hooked 		workforce_body_top 		15
	 *
	 * @return 		mixed 				The HTML markup for a search field
	 */
	public function add_hidden_search() {

		?><div aria-hidden="true" class="hidden-search-top" id="hidden-search-top">
			<div class="wrap"><?php

			get_search_form();

			?></div>
		</div><?php

	} // add_hidden_search()

	/**
	 * Adds a search form
	 *
	 * @hooked 		workforce_404_content 		15
	 *
	 * @return 		mixed 		Search form markup
	 */
	public function add_search() {

		get_search_form();

	} // add_search()

	/**
	 * Inserts Google Tag manager code after body tag
	 *
	 * @hooked 		workforce_body_top 		10
	 *
	 * @return 		mixed 				The inserted Google Tag Manager code
	 */
	public function analytics_code() {

		$tag = get_theme_mod( 'tag_manager' );

		if ( empty( $tag ) ) { return; }

		echo '<!-- Google Tag Manager -->';
		echo $tag;
		echo '<!-- Google Tag Manager -->';

	} // analytics_code()

	/**
	 * Displays the home blocks
	 *
	 * @return 		mixed 			The home blocks
	 */
	public function blocks_home() {

		if ( ! is_front_page() ) { return; }

		$blocks 	= get_field( 'three_blocks' );
		$fullblocks = ! empty( $blocks[0]['block_content'] ) || ! empty( $blocks[1]['block_content'] ) || ! empty( $blocks[2]['block_content'] );

		if ( $fullblocks ) :

			?><div class="blocks"><?php

		endif;

		foreach ( range( 0, 2 ) as $i ) :

			if ( empty( $blocks[$i]['block_content'] ) ) { continue; }

			?><div class="block"><?php

				if ( ! empty( $blocks[$i]['block_icon'] ) ) :

					?><p class="home-block-icon fa <?php echo esc_attr( $blocks[$i]['block_icon'] ); ?>" id="home-block-icon-<?php echo $i ?>"></p><?php

				endif;

				if ( ! empty( $blocks[$i]['block_title'] ) ) :

					?><h3 class="home-block-title"><?php echo esc_html( $blocks[$i]['block_title'] ); ?></h3><?php

				endif;

				?><p id="home-block-content-<?php echo $i ?>"><?php echo apply_filters( 'the_content', $blocks[$i]['block_content'] ); ?></p>
			</div><?php

		endforeach;

		if ( $fullblocks ) :

			?></div><!-- .blocks --><?php

		endif;

	} // blocks_home()

	public function block_home_img1() {

		if ( ! is_front_page() ) { return; }

		?><div class="block-home-img" id="bhi1"></div><?php

	} // block_home_img1()

	public function block_home_img2() {

		if ( ! is_front_page() ) { return; }

		?><div class="block-home-img"  id="bhi2"></div><?php

	} // block_home_img2()

	/**
	 * Displays the top home block
	 *
	 * @return 		mixed 			The top home block
	 */
	public function block_home_top() {

		if ( ! is_front_page() ) { return; }

		$block = get_field( 'top_home_block' );

		if ( empty( $block ) ) { return; }

		?><div class="block-home-top"><?php

			echo apply_filters( 'the_content', $block );

		?></div><?php

	} // block_home_top()

	/**
	 * Returns the appropriate breadcrumbs.
	 *
	 * @hooked		workforce_wrap_content
	 *
	 * @return 		mixed 				WooCommerce breadcrumbs, then Yoast breadcrumbs
	 */
	public function breadcrumbs() {

		if ( is_front_page() ) { return; }

		?><div class="breadcrumbs">
			<div class="wrap-crumbs"><?php

				if ( function_exists( 'woocommerce_breadcrumb' ) ) {

					$args['after'] 			= '</span>';
					$args['before'] 		= '<span rel="v:child" typeof="v:Breadcrumb">';
					$args['delimiter'] 		= '&nbsp;>&nbsp;';
					$args['home'] 			= esc_html_x( 'Home', 'breadcrumb', 'workforce' );
					$args['wrap_after'] 	= '</span></span></nav>';
					$args['wrap_before'] 	= '<nav class="woocommerce-breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '><span xmlns:v="http://rdf.data-vocabulary.org/#"><span typeof="v:Breadcrumb">';

					woocommerce_breadcrumb( $args );

				} elseif ( function_exists( 'yoast_breadcrumb' ) ) {

					yoast_breadcrumb();

				}

			?></div><!-- .wrap-crumbs -->
		</div><!-- .breadcrumbs --><?php

	} // breadcrumbs()

	/**
	 * The comments markup
	 *
	 * If comments are open or we have at least one comment, load up the comment template.
	 *
	 * @hooked 		workforce_entry_after 		10
	 *
	 * @return 		mixed 					The comments markup
	 */
	public function comments() {

		if ( ! comments_open() || get_comments_number() <= 0 ) { return; }

		comments_template();

	} // comments()
	
	/**
	 * Displays the entry category links.
	 *
	 * @exits 		If its a page.
	 * @exits 		If its not the 'post' post type.
	 * @return 		mixed 		Entry categories markup.
	 */
	public function entry_categories_links() {

		if ( is_page() ) { return; }
		if ( 'post' !== get_post_type() ) { return; }

		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'workforce' ) );
		if ( $categories_list && workforce_categorized_blog() ) {

			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'workforce' ) . '</span>', $categories_list );  // WPCS: XSS OK.

		}

	} // entry_categories_links()

	/**
	 * Displays the entry comments links.
	 *
	 * @exits 		If its a page.
	 * @exits 		If its not the 'post' post type.
	 * @exits 		If its a single post, its password protected, and either the comments aren't open or there aren't comments.
	 * @return 		mixed 		Entry comments markup.
	 */
	public function entry_comments_links() {

		if ( is_page() ) { return; }
		if ( 'post' !== get_post_type() ) { return; }
		if ( ! is_single() ) { return; }
		if ( post_password_required() ) { return; }
		if ( ! comments_open() || ! get_comments_number() ) { return; }

		?><span class="comments-link"><?php

		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'workforce' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) ); // translators: %s: post title

		?></span><?php

	} // entry_comments_links()

	/**
	 * Displays the entry edit link.
	 *
	 * @exits 		If its a page.
	 * @exits 		If its not the 'post' post type.
	 * @return 		mixed 		Entry comments markup.
	 */
	public function entry_edit_link() {

		if ( is_page() ) { return; }
		if ( 'post' !== get_post_type() ) { return; }

		edit_post_link( esc_html__( 'Edit', 'workforce' ), '<span class="edit-link">', '</span>' );

	} // entry_edit_link()

	/**
	 * Displays the entry tags links.
	 *
	 * @exits 		If its a page.
	 * @exits 		If its not the 'post' post type.
	 * @exits 		If the tags list is empty.
	 * @return 		mixed 		Entry tags markup.
	 */
	public function entry_tags_links() {

		if ( is_page() ) { return; }
		if ( 'post' !== get_post_type() ) { return; }

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'workforce' ) );

		if ( empty( $tags_list ) ) { return; }

		printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'workforce' ) . '</span>', $tags_list );  // WPCS: XSS OK.

	} // entry_tags_links()

	/**
	 * Adds the copyright and credits to the footer content.
	 *
	 * @hooked 		workforce_footer_content
	 *
	 * @return 		mixed 									The footer markup
	 */
	public function footer_content() {

		?><section class="site-info">
			<div class="copyright">&copy <?php echo date( 'Y' ); ?> <a href="<?php echo esc_url( get_admin_url(), 'workforce' ); ?>"><?php echo get_bloginfo( 'name' ); ?></a> <?php esc_html_e( 'All Rights Reserved.', 'workforce' ); ?></div>
			<div><?php

				$menu_args['theme_location']	= 'legal';
				$menu_args['container'] 		= false;
				$menu_args['menu_id']         	= 'nav-legal';
				$menu_args['menu_class']      	= 'nav-legal-items nav-legal-items-0';
				$menu_args['depth']           	= 1;
				$menu_args['walker'] 			= new workforce_Menu_Walker();
				
				wp_nav_menu( $menu_args );

			?></div>
			<div class="credits"><?php printf( esc_html__( 'Site created by %1$s', 'workforce' ), '<a href="https://dccmarketing.com/" rel="nofollow" target="_blank">DCC Marketing</a>' ); ?></div>
		</section><!-- .site-info --><?php

	} // footer_content()

	/**
	 * Displays the Footer Middle sidebar
	 */
	public function footer_widget_middle() {

		if ( ! is_active_sidebar( 'footer-middle' ) ) { return; }

		dynamic_sidebar( 'footer-middle' );

	} // footer_widget_middle()

	/**
	 * Displays the Footer Right sidebar
	 */
	public function footer_widget_right() {

		if ( ! is_active_sidebar( 'footer-right' ) ) { return; }

		dynamic_sidebar( 'footer-right' );

	} // footer_widget_right()

	/**
	 * Displays a list of all locations
	 *
	 * @return 		mixed 			List of locations
	 */
	public function footer_locations() {

		$locations 			= array();
		$locs_args['order'] = 'ASC';
		$locations 			= workforce_get_posts( 'sm-location', $locs_args, 'footerlocs' );

		if ( empty( $locations ) ) { return; }

		?><section class="footer-locs">
			<ul class="locs blocks"><?php

			foreach ( $locations->posts as $location ) :

				$meta = get_post_meta( $location->ID );

				?><li class="loc block">
					<h3 class="loc-title"><?php echo esc_html( $location->post_title ); ?></h3>
					<p class="loc-phone"><?php echo workforce_make_phone_link( $meta['location_phone'][0] ); ?></p>
				</li><?php

			endforeach;

			?></ul>
		</section><!-- .footer-locs --><?php

	} // footer_locations()

	public function footer_wrap_begin() {

		?><div class="wrap wrap-footer"><?php

	} // footer_wrap_begin()

	public function footer_wrap_end() {

		?></div><!-- wrap-footer --><?php

	} // footer_wrap_end()

	/**
	 * Adds the  to the 404 page content.
	 *
	 * @hooked 		workforce_404_content		25
	 *
	 * @return 		mixed 							Markup for the archives
	 */
	public function four_04_archives() {

		if ( ! is_404() ) { return; }

		/* translators: %1$s: smiley */
		$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'workforce' ), convert_smilies( ':)' ) ) . '</p>';

		the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );

	} // four_04_archives()

	/**
	 * Adds the  to the 404 page content.
	 *
	 * @hooked 		workforce_404_content		20
	 *
	 * @return 		mixed 							The categories widget
	 */
	public function four_04_categories() {

		if ( ! workforce_categorized_blog() ) { return; }
		if ( ! is_404() ) { return; }

		?><div class="widget widget_categories">
			<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'workforce' ); ?></h2>
			<ul><?php

				wp_list_categories( array(
					'orderby'    => 'count',
					'order'      => 'DESC',
					'show_count' => 1,
					'title_li'   => '',
					'number'     => 10,
				) );

			?></ul>
		</div><!-- .widget --><?php

	} // four_04_categories()

	/**
	 * Adds the Recent Posts widget to the 404 page.
	 *
	 * @hooked 		workforce_404_content 		15
	 *
	 * @return 		mixed 							The Recent Posts widget
	 */
	public function four_04_posts_widget() {

		if ( ! is_404() ) { return; }

		the_widget( 'WP_Widget_Recent_Posts' );

	} // four_04_posts_widget()

	/**
	 * Adds the  to the 404 page content.
	 *
	 * @hooked 		workforce_404_content		30
	 *
	 * @return 		mixed 							The tag cloud widget
	 */
	public function four_04_tag_cloud() {

		if ( ! is_404() ) { return; }

		the_widget( 'WP_Widget_Tag_Cloud' );

	} // four_04_tag_cloud()

	/**
	 * The header wrap markup
	 *
	 * @hooked  	workforce_header_bottom 		90
	 *
	 * @return 		mixed 					The header wrap markup
	 */
	public function header_wrap_end() {

		?></div><!-- .wrap-header --><?php

	} // header_wrap_end()

	/**
	 * The header wrap markup
	 *
	 * @hooked 		workforce_header_top 		10
	 *
	 * @return 		mixed 				The header wrap markup
	 */
	public function header_wrap_start() {

		?><div class="wrap wrap-header"><?php

	} // header_wrap_start()

	/**
	 * Adds the primary menu
	 *
	 * @hooked 		workforce_header_bottom 		95
	 *
	 * @return 		mixed 					The primary menu markup
	 */
	public function menu_primary() {

		?><nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle menu-primary-toggle" aria-controls="primary-menu" aria-expanded="false">
				<span class="diamond"></span><?php esc_html_e( 'Menu', 'workforce' ); ?></button><?php

				$menu_args['container'] 		= false;
				$menu_args['container_class'] 	= 'menu-primary-wrap';
				$menu_args['items_wrap'] 		= '<ul id="%1$s" class="%2$s"><button class="close-tablet-menu-btn"><span class="close-btn-text">Close Menu</span></button>%3$s</ul>';
				$menu_args['menu_class']      	= 'primary-menu-items primary-menu-items-0';
				$menu_args['menu_id'] 			= 'primary-menu';
				$menu_args['theme_location'] 	= 'primary';
				$menu_args['walker']  			= new workforce_Menu_Walker();

				wp_nav_menu( $menu_args );

		?></nav><!-- #site-navigation --><?php

	} // menu_primary()

	/**
	 * Adds the primary menu
	 *
	 * @hooked 		workforce_header_bottom 		65
	 *
	 * @return 		mixed 					The social links menu markup
	 */
	public function menu_social() {

		//if (  ) { return; }

		if ( ! has_nav_menu( 'social' ) ) { return; }

		$menu_args['theme_location']	= 'social';
		$menu_args['container'] 		= false;
		$menu_args['menu_id']         	= 'social-menu';
		$menu_args['menu_class']      	= 'social-menu-items social-menu-items-0';
		$menu_args['depth']           	= 1;
		$menu_args['walker']  			= new workforce_Menu_Walker();

		wp_nav_menu( $menu_args );

	} // menu_social()
	
	public function page_builder() {
		
		$contents = get_field( 'builder' );
		
		if ( empty( $contents ) || ! is_array( $contents ) ) { return; }
		
		//echo '<pre>'; print_r( $contents ); echo '</pre>';
		
		for ( $i = 0; $i < count( $contents ); $i++ ) :
			
			?><section class="section-<?php echo $i; 
			
				if ( 'Full-Width Image' === $contents[$i]['type'] ) {
				
					echo ' block-home-img';
					
				} else {
					
					echo ' blocks';
					
				}
			
				?>"><?php
			
				if ( 'Full-Width Image' === $contents[$i]['type'] ) {
					
					// do not add anything here, these are background images
					
				} elseif ( 'Text' === $contents[$i]['type'] ) {
					
					if ( empty( $contents[$i]['text'] ) ) { continue; }
					
					?><div class="section-<?php echo $i; ?>-content"><?php
					
						echo apply_filters( 'the_content', $contents[$i]['text'] );
					
					?></div><?php
					
				} elseif ( 'Content Blocks' === $contents[$i]['type'] ) {
					
					if ( empty( $contents[$i]['content_blocks'] ) || ! is_array( $contents[$i]['content_blocks'] ) ) { continue; }
					
					?><div class="blocks"><?php
					
						echo $this->page_builder_content_blocks( $contents[$i]['content_blocks'] );
					
					?></div><?php
					
				}
			
			?></section><?php
			
		endfor;
				
	} // page_builder()
	
	public function page_builder_content_blocks( $blocks ) {
		
		if ( empty( $blocks ) || ! is_array( $blocks ) ) { return; }
		
		//echo '<pre>'; print_r( $blocks ); echo '</pre>';
		
		for ( $i = 0; $i < count( $blocks ); $i++ ) :
			
			?><div class="block"><?php
			
			if ( 'Icon, Headline, Text' === $blocks[$i]['type'] ) :
			
				if ( empty( $blocks[$i]['block_content'] ) ) { continue; }

					if ( ! empty( $blocks[$i]['block_icon'] ) ) :

						?><p class="home-block-icon fa <?php echo esc_attr( $blocks[$i]['block_icon'] ); ?>" id="home-block-icon-<?php echo $i ?>"></p><?php

					endif;

					if ( ! empty( $blocks[$i]['block_title'] ) ) :

						?><h3 class="home-block-title"><?php echo esc_html( $blocks[$i]['block_title'] ); ?></h3><?php

					endif;

					?><p id="home-block-content-<?php echo $i ?>"><?php echo apply_filters( 'the_content', $blocks[$i]['block_content'] ); ?></p><?php
				
			elseif ( 'Map' === $blocks[$i]['type'] ) :
				
				?><div class="acf-map"><?php
								
					if ( ! empty( $blocks[$i]['map']['lat'] ) && ! empty( $blocks[$i]['map']['lng'] ) ) :
						
						?><div class="marker" data-lat="<?php 
						
							echo esc_attr( $blocks[$i]['map']['lat'] ); 
							
						?>" data-lng="<?php
						
							echo esc_attr( $blocks[$i]['map']['lng'] ); 
						
						?>"></div><?php
						
					endif;
				
				?></div><?php
				
			endif;
			
			?></div><?php
			
		endfor;
		
	} // page_builder_content_blocks()
	
	public function page_builder_header() {
		
		$contents = get_field( 'builder' );
		
		if ( empty( $contents ) || ! is_array( $contents ) ) { return; }
		
		?><style><?php
		
		for ( $i = 0; $i < count( $contents ); $i++ ) :
		
			if ( 'Full-Width Image' !== $contents[$i]['type'] ) { continue; }
			if ( empty( $contents[$i]['full-width_image'] ) ) { continue; }
			
			?>
			@media screen and (min-width:600px){
				.section-<?php echo $i; ?>{background-image:url(<?php echo esc_url( $contents[$i]['full-width_image'] ); ?>);
			}
			<?php
			
		endfor;
		
		?></style><!-- Page Builder Images --><?php
		
	} // page_builder_header()

	/**
	 * Adds the posted_on post meta.
	 *
	 * @return 		mixed 			The posted_on post meta.
	 */
	public function posted_on() {

		if ( 'post' != get_post_type() ) { return; }
		if ( ! is_search() ) { return; }

		?><div class="entry-meta"><?php

			workforce_posted_on();

		?></div><!-- .entry-meta --><?php

	} // posted_on()

	/**
	 * Adds the post navigation to the archive pages
	 *
	 * @hooked 		workforce_content_while_after
	 *
	 * @return 		mixed 							The posts navigation
	 */
	public function posts_nav() {

		if (
			! is_home()
			|| ! is_archive()
		) { return; }

		the_posts_navigation();

	} // posts_nav()

	/**
	 * Adds the starting site branding markup
	 *
	 * @hooked 		workforce_header_bottom			85
	 *
	 * @return 		mixed 						HTML markup
	 */
	public function site_branding_end() {

		?></div><!-- .site-branding --><?php

	} // site_branding_end()

	/**
	 * Adds the starting site branding markup
	 *
	 * @hooked 		workforce_header_top				15
	 *
	 * @return 		mixed 						HTML markup
	 */
	public function site_branding_start() {

		?><div class="site-branding"><?php

	} // site_branding_start()

	/**
	 * Adds the site description markup
	 *
	 * @hooked 		workforce_header_content 		15
	 *
	 * @return 		mixed 								The site description markup
	 */
	public function site_description() {

		$description = get_bloginfo( 'description', 'display' );

		if ( $description || is_customize_preview() ) :

			?><p class="site-description font-opens"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p><?php

		endif;

	} // site_description()



	/**
	 * Adds the a11y skip link markup
	 *
	 * @hooked 		workforce_body_top 		20
	 *
	 * @return 		mixed 				Skip link markup
	 */
	public function skip_link() {

		?><a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'workforce' ); ?></a><?php

	} // skip_link()

	/**
	 * The 404 page title markup
	 *
	 * @hooked 		workforce_404_content 		10
	 *
	 * @return 		mixed 							The 440 page title
	 */
	public function title_404() {

		if ( ! is_404() ) { return; }

		?><header class="page-header">
			<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'workforce' ); ?></h1>
		</header><!-- .page-header -->
		<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'workforce' ); ?></p><?php

	} // title_404()

	/**
	 * Adds the page title to an archive page
	 *
	 * @hooked 		workforce_content_while_before
	 *
	 * @return 		mixed 							The archive page title
	 */
	public function title_archive() {

		if ( ! is_archive() ) { return; }

		?><header class="page-header"><?php

			the_archive_title( '<h1 class="page-title title-archive">', '</h1>' );
			the_archive_description( '<div class="taxonomy-description">', '</div>' );

		?></header><!-- .page-header --><?php

	} // title_archive()

	/**
	 * Returns the entry title
	 *
	 * @hooked 		workforce_content_while_before 		10
	 *
	 * @return 		mixed 							The entry title
	 */
	public function title_entry() {

		if ( is_front_page() ) { return; }
		if ( is_page() ) { return; }

		if ( is_single() ) {

			the_title( '<h1 class="entry-title">', '</h1>' );

		} else {

			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

		}

	} // title_entry()

	/**
	 * Returns the page title
	 *
	 * @hooked 		workforce_content_while_before 		10
	 *
	 * @return 		mixed 							The entry title
	 */
	public function title_page() {

		if ( is_front_page() ) { return; }
		if ( ! is_page() ) { return; }

		the_title( '<h1 class="page-title">', '</h1>' );

	} // title_page()

	/**
	 * The search title markup
	 *
	 * @hooked 		workforce_content_while_before
	 *
	 * @return 		mixed 							Search title markup
	 */
	public function title_search() {

		if ( ! is_search() ) { return; }

		?><header class="page-header">
			<h1 class="page-title"><?php

				printf( esc_html__( 'Search Results for: %s', 'workforce' ), '<span>' . get_search_query() . '</span>' );

			?></h1>
		</header><!-- .page-header --><?php

	} // title_search()

	/**
	 * Adds the single post title to the index
	 *
	 * @hooked 		workforce_content_while_before
	 *
	 * @return 		mixed 							The single post title
	 */
	public function title_single_post() {

		if ( ! is_home() && is_front_page() ) { return; }
		if ( ! is_single() ) { return; }

		?><header>
			<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
		</header><?php

	} // title_single_post()

	/**
	 * Adds the site title markup
	 *
	 * @hooked 		workforce_header_content 		10
	 *
	 * @return 		mixed 						The site title markup
	 */
	public function title_site() {

		if ( is_front_page() && is_home() ) {

			?><h1 class="site-title"><?php the_custom_logo(); ?></h1><?php

		} else {

			?><p class="site-title"><?php the_custom_logo(); ?></p><?php

		}

	} // title_site()

} // class
