<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Workforce
 */

		/**
		 * The workforce_content_bottom action hook
		 */
		do_action( 'workforce_content_bottom' );

	?></div><!-- #content --><?php

	/**
	 * The workforce_content_after action hook
	 */
	do_action( 'workforce_content_after' );

	/**
	 * The workforce_footer_before action hook
	 */
	do_action( 'workforce_footer_before' );

	?><footer class="site-footer" id="colophon" role="contentinfo"><?php

		/**
		 * The workforce_footer_top action hook
		 */
		do_action( 'workforce_footer_top' );

		/**
		 * The workforce_footer_content action hook
		 *
		 * @hooked 		footer_content
		 */
		do_action( 'workforce_footer_content' );

		/**
		 * The workforce_footer_bottom action hook
		 */
		do_action( 'workforce_footer_bottom' );

	?></footer><!-- #colophon --><?php

	/**
	 * The workforce_footer_after action hook
	 */
	do_action( 'workforce_footer_after' );

?></div><!-- #page --><?php

wp_footer();

/**
 * The workforce_body_bottom action hook
 */
do_action( 'workforce_body_bottom' );

?></body>
</html>