<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Workforce
 */

get_header();

?><div id="primary" class="content-area">
	<main id="main" role="main"><?php

	if ( have_posts() ) :

		/**
		 * The workforce_content_while_before action hook
		 *
		 * @hooked 		title_archive
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

	?></main><?php 

	get_sidebar();
	
?></div><!-- .content-area --><?php

get_footer();