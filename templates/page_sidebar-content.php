<?php
/**
 * Template Name: Sidebar Content
 *
 * Description: Page template with sidebar on the left-side
 *
 * @package Workforce
 */

get_header();
get_sidebar( 'left' );

	?><div id="primary" class="content-area sidebar-content">
		<main id="main" role="main"><?php

			/**
			 * The workforce_content_while_before action hook
			 */
			do_action( 'workforce_content_while_before' );

			while ( have_posts() ) : the_post();

				/**
				 * The workforce_entry_before action hook
				 */
				do_action( 'workforce_entry_before' );

				get_template_part( 'template-parts/content', 'page' );

				/**
				 * The workforce_entry_after action hook
				 *
				 * @hooked 		comments 		10
				 */
				do_action( 'workforce_entry_after' );

			endwhile; // loop

			/**
			 * The workforce_content_while_after action hook
			 */
			do_action( 'workforce_content_while_after' );

		?></main><!-- #main -->
	</div><!-- #primary --><?php

get_footer();