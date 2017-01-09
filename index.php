<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Workforce
 */

get_header();

?><div id="primary" class="content-area content-sidebar">
	<main id="main" role="main"><?php

	if ( have_posts() ) :

		/**
		 * The workforce_content_while_before action hook
		 *
		 * @hooked 		title_single_post
		 */
		do_action( 'workforce_content_while_before' );

		/* Start the Loop */
		while ( have_posts() ) : the_post();

			/**
			 * The workforce_entry_before action hook
			 */
			do_action( 'workforce_entry_before' );

			/*
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part( 'template-parts/content', get_post_format() );

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
	
?></div><!-- #primary --><?php

get_footer();