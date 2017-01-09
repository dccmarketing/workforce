<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Workforce
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) { return; }

/**
 * The workforce_sidebars_before action hook
 */
do_action( 'workforce_sidebars_before' );

?><aside id="secondary" class="widget-area" role="complementary"><?php

	/**
	 * The workforce_sidebar_top action hook
	 */
	do_action( 'workforce_sidebar_top' );

	dynamic_sidebar( 'sidebar-1' );

	/**
	 * The workforce_sidebar_bottom action hook
	 */
	do_action( 'workforce_sidebar_bottom' );

?></aside><!-- #secondary --><?php

/**
 * The workforce_sidebars_after action hook
 */
do_action( 'workforce_sidebars_after' );