<?php
/**
 * The sidebar for the Sidrbar Content page template
 *
 * @package Workforce
 */

if ( ! is_active_sidebar( 'sidebar-left' ) ) { return; }

/**
 * The workforce_sidebars_before action hook
 */
do_action( 'workforce_sidebars_before' );

?><aside id="secondary" class="widget-area sidebar-left" role="complementary"><?php

	/**
	 * The workforce_sidebar_top action hook
	 */
	do_action( 'workforce_sidebar_top' );

	dynamic_sidebar( 'sidebar-left' );

	/**
	 * The workforce_sidebar_bottom action hook
	 */
	do_action( 'workforce_sidebar_bottom' );

?></aside><!-- #secondary --><?php

/**
 * The workforce_sidebars_after action hook
 */
do_action( 'workforce_sidebars_after' );