<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Workforce
 */

get_header();

?><section id="primary" class="content-area">
	<main id="main" role="main"><?php

	if ( have_posts() ) :

		/**
		 * The workforce_content_while_before action hook
		 *
		 * @hooked 		title_search
		 */
		do_action( 'workforce_content_while_before' );

		/* Start the Loop */
		while ( have_posts() ) : the_post();

			/**
			 * The workforce_entry_before action hook
			 */
			do_action( 'workforce_entry_before' );

			/**
			 * Run the loop for the search to output the results.
			 * If you want to overload this in a child theme then include a file
			 * called content-search.php and that will be used instead.
			 */
			get_template_part( 'template-parts/content', 'search' );

			/**
			 * The workforce_entry_after action hook
			 */
			do_action( 'workforce_entry_after' );

		endwhile;

		/**
		 * The workforce_content_while_after action hook
		 *
		 * @hooked 		posts_nav
		 */
		do_action( 'workforce_content_while_after' );

	else :

		/**
		 * The workforce_entry_before action hook
		 */
		do_action( 'workforce_entry_before' );

		get_template_part( 'template-parts/content', 'none' );

		/**
		 * The workforce_entry_after action hook
		 */
		do_action( 'workforce_entry_after' );

	endif;

	?></main><!-- #main --><?php 

	get_sidebar();
	
?></section><!-- #primary --><?php

get_footer();